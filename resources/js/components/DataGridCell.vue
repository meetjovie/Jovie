<template>
  <td
    ref="cell_area"
    :class="[
      'border-collapse items-center overflow-auto whitespace-nowrap border border-slate-300 text-center text-xs font-medium dark:border-jovieDark-border',

      freezeColumn
        ? 'overflow-x-noscroll sticky isolate z-40 border-none border-transparent  font-bold first:border-l last:border-r '
        : '',

      freezeColumn && currentContact.id == contact.id
        ? 'bg-slate-100 text-slate-800 dark:bg-jovieDark-700 dark:text-slate-100'
        : 'text-slate-600 dark:text-slate-200',
      cellActive
        ? 'bg-indigo-50  ring-2 ring-indigo-500  dark:bg-jovieDark-600 dark:ring-indigo-500'
        : '',
    ]"
    :key="rerenderKey"
    v-if="
      freezeColumn ||
      neverHide ||
      (column && visibleColumns.includes(column.key))
    ">
    <slot></slot>

    <div @click.self="setFocus()" v-if="!freezeColumn">
      <star-rating
        v-if="column.type == 'rating'"
        class="mx-auto px-2"
        :star-size="12"
        :increment="0.5"
        v-model:rating="contact.rating"
        @update:rating="
          $emit('updateContact', {
            id: contact.id,
            index: row,
            key: column.key,
            value: contact.rating,
          })
        " />

      <DataGridCellTextInput
        v-else-if="
          ['text', 'email', 'currency', 'number', 'url', 'phone'].includes(
            column.type
          )
        "
        :ref="cellActive"
        :fieldId="fieldId"
        @blur="updateData"
        :dataType="column.type"
        v-model="localModelValue" />
      <ContactStageMenu
        v-else-if="column.type == 'select' && column.name == 'Stage'"
        :contact="contact"
        :key="row ?? 0"
        :open="showContactStageMenu[row] ?? false"
        @close="toggleContactStageMenu(row)"
        :stages="stages"
        :index="row"
        @updateContact="$emit('updateContact', $event)" />
      <ContactSelectMenu
        v-else-if="column.type == 'select' && column.name == 'Gender'"
        :contact="contact"
        :key="row ?? 0"
        attributekey="gender"
        :open="toggleContactSelectMenu[row] ?? false"
        @close="toggleContactSelectMenu(row)"
        :options="genderOptions"
        :index="row"
        @updateContact="$emit('updateContact', $event)" />
      <DataGridSocialLinksCell
        @updateContact="$emit('updateContact', $event)"
        :contactId="contact.id"
        :row="row"
        :socialLinks="contact.social_links_with_followers"
        :show-count="showFollowersCount"
        v-else-if="column.type == 'socialLinks'" />
      <div v-else-if="column.type == 'date'">
        <div class="relative flex items-center">
          <input
            ref="input"
            type="text"
            :placeholder="'mm/dd/yyyy'"
            name="date"
            @input="handleInput"
            :value="localModelValue"
            pattern="\d{1,2}/\d{1,2}/\d{4}"
            id="date"
            class="block w-full border-none bg-transparent pr-12 placeholder-slate-400 outline-none focus:border-none dark:placeholder-slate-200 sm:text-sm" />
          <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
            <JovieDatePicker
              :value="localModelValue"
              @update:modelValue="
                $emit('update:modelValue', $event);
                updateData();
              "
              class="isolate z-50" />
          </div>
        </div>
      </div>
      <Suspense
        v-else-if="column.type == 'multi_select' && column.name == 'Lists'">
        <template #default>
          <InputLists
            @updateLists="$emit('updateContactLists', $event)"
            :contactId="contact.id ?? 0"
            :listItems="userLists"
            :lists="contact.user_lists"
            :currentList="contact.current_list" />
        </template>
        <template #fallback> Loading...</template>
      </Suspense>
      <CheckboxInput
        v-else-if="column.type == 'checkbox'"
        :name="`checkbox_${fieldId}_${contact.id}`"
        v-model="localModelValue"
        :checked="localModelValue"
        @markCheck="updateData" />
      <CustomField
        v-else-if="
          (column.type == 'multi_select' || column.type == 'select') &&
          column.custom
        "
        @blur="updateData"
        :type="column.type"
        :options="column.custom_field_options"
        v-model="contact[column.code]" />
      <span v-else
        >Data Type:
        {{ column.type }}
      </span>
    </div>
  </td>
</template>

<script>
import CheckboxInput from './CheckboxInput.vue';
import DataGridCellTextInput from './DataGridCellTextInput.vue';
import StarRating from 'vue-star-rating';
import SocialIcons from './SocialIcons.vue';
import DataGridSocialLinksCell from './DataGridSocialLinksCell.vue';
import ContactStageMenu from './ContactStageMenu.vue';
import VueTailwindDatepicker from 'vue-tailwind-datepicker';
import InputLists from './InputLists.vue';
import JovieDatePicker from './JovieDatePicker.vue';
import CustomField from './CustomField.vue';
import ContactSelectMenu from './ContactSelectMenu.vue';

export default {
  name: 'DataGridCell',
  components: {
    InputLists,
    ContactStageMenu,
    DataGridSocialLinksCell,
    SocialIcons,
    DataGridCellTextInput,
    StarRating,
    JovieDatePicker,
    CheckboxInput,
    VueTailwindDatepicker,
    CustomField,
    ContactSelectMenu,
  },
  emits: ['update:modelValue', 'blur', 'move'],
  data() {
    return {
      showContactStageMenu: [],
      date: {},
      genderOptions: ['Male', 'Female', 'Other', 'Unknown'],
      rerenderKey: 0,
    };
  },
  watch: {
    contact: {
      deep: true,
      handler: function (val) {
        this.rerenderKey += 1;
      },
    },
  },
  mounted() {
    this.date.startDate = this.localModelValue;
    this.date.endDate = this.localModelValue;
  },
  methods: {
    updateData(value = null) {
      this.$nextTick(() => {
        this.$emit('update:modelValue', this.localModelValue);
        let key = this.column.key;
        this.$emit('updateContact', {
          id: this.contact.id,
          index: this.row,
          key: key,
          value: this.localModelValue ?? value,
        });
      });
    },
    handleInput(event) {
      const dateRegex =
        /^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/([0-9]{4})$/;
      if (dateRegex.test(event.target.value)) {
        this.localModelValue = event.target.value;
      }
    },
    toggleContactStageMenu(index) {
      this.showContactStageMenu[index] = !this.showContactStageMenu[index];
    },
    toggleContactSelectMenu(index) {
      this.toggleContactSelectMenu[index] =
        !this.toggleContactSelectMenu[index];
    },
    setActiveColumn() {
      this.$emit('update:activeColumn', this.columnIndex);
    },
    onBlur() {
      this.$emit('blur');
    },
    setFocus() {
      this.$emit('update:currentCell', {
        row: this.rowIndex,
        column: this.columnIndex,
      });
    },
  },
  computed: {
    localModelValue: {
      get() {
        return this.modelValue;
      },
      set(val) {
        this.$emit('update:modelValue', val);
      },
    },
    showFollowersCount() {
      try {
        if (!this.settings) {
          return false;
        }
        return this.settings.find((set) => set.key === 'show_follower_count')
          .visible;
      } catch (e) {
        return false;
      }
    },
    inputComponent() {
      switch (this.dataType) {
        case 'rating':
          return 'star-rating';
        case 'checkbox':
          return 'checkbox-input';
        default:
          return 'data-grid-cell-text-input';
      }
    },
    columnWidth() {
      // Find the object in the visibleColumns array that represents the current column
      const column = this.visibleColumns.find((col) =>
        col.name === this.column ? this.column.name : ''
      );
      // If the object was found, return its width. Otherwise, return an empty string.
      return column ? column.width : '';
    },
  },
  props: {
    userLists: Array,
    currentContact: Object,
    contact: Object,
    selectedCreators: Array,
    freezeColumn: Boolean,
    fieldId: String,
    visibleColumns: Array,
    settings: Object,
    neverHide: Boolean,
    row: Number,
    column: {
      type: Object,
      default: {},
    },
    modelValue: {},
    currentCell: Object,
    cellActive: Boolean | String,
    networks: Array,
    stages: Array,
  },
};
</script>
