<template>
  <td
    class="isolate border-collapse items-center overflow-auto whitespace-nowrap border border-slate-200 text-center text-xs font-medium text-slate-600 dark:border-jovieDark-border dark:text-jovieDark-200"
    ref="cell_area"
    :class="[
      cellActive ? 'ring-2 ring-inset' : '',
      userColor === 'red' ? 'ring-red-500 dark:ring-red-300' : '',
      userColor === 'green' ? 'ring-green-500 dark:ring-green-300' : '',
      userColor === 'blue' ? 'ring-blue-500 dark:ring-blue-300' : '',
      userColor === 'yellow' ? 'ring-yellow-500 dark:ring-yellow-300' : '',
      userColor === 'indigo' ? 'ring-indigo-500 dark:ring-indigo-300' : '',
      userColor === 'purple' ? 'ring-purple-500 dark:ring-purple-300' : '',
      userColor === 'pink' ? 'ring-pink-500 dark:ring-pink-300' : '',
      userColor === 'orange' ? 'ring-orange-500 dark:ring-orange-300' : '',
      userColor === 'rose' ? 'ring-rose-500 dark:ring-rose-300' : '',
      userColor === 'fuchsia' ? 'ring-fuchsia-500 dark:ring-fuchsia-300' : '',
      userColor === 'sky' ? 'ring-sky-500 dark:ring-sky-300' : '',
      userColor === 'cyan' ? 'ring-cyan-500 dark:ring-cyan-300' : '',
      userColor === 'teal' ? 'ring-teal-500 dark:ring-teal-300' : '',
      userColor === 'emerald' ? 'ring-emerald-500 dark:ring-emerald-300' : '',
    ]"
    :key="rerenderKey"
    v-if="
      freezeColumn ||
      neverHide ||
      (column && visibleColumns.includes(column.key))
    ">
    <slot></slot>

    <div @click.self="setFocus()" v-if="!freezeColumn">
      <div class="mx-auto flex w-20" v-if="column.type == 'rating'">
        <star-rating
          class="mx-auto"
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
      </div>
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
            class="block w-full border-none bg-transparent pr-12 placeholder-slate-400 outline-none focus-visible:border-none dark:placeholder-slate-200 sm:text-sm" />
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
      <div
        class="scrollbar:!w-1.5 scrollbar:!h-1.5 scrollbar:bg-transparent scrollbar-track:!bg-slate-100 scrollbar-thumb:!rounded scrollbar-thumb:!bg-slate-300 scrollbar-track:!rounded dark:scrollbar-track:!bg-jovieDark-500/[0.16] dark:scrollbar-thumb:!bg-jovieDark-500/50 lg:supports-scrollbars:pr-2 w-80 overflow-x-scroll"
        v-else-if="column.type == 'multi_select' && column.name == 'Lists'">
        <InputLists
          @updateLists="$emit('updateContactLists', $event)"
          @setFilterList="$emit('setFilterList', $event)"
          :contactId="contact.id ?? 0"
          :listItems="userLists"
          :lists="contact.user_lists"
          :currentList="contact.current_list" />
      </div>
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
    colorClass() {
      return `bg-${this.color}-100 dark:bg-${this.color}-700`;
    },
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
          .value;
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
    //add color prop with default value of organge
    color: {
      type: String,
      default: 'orange',
    },
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
    userColor: {
      type: String,
      default: 'blue',
    },
  },
};
</script>
