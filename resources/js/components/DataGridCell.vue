<template>
  <td
      ref="cell_area"
    :class="[
      'border-collapse items-center overflow-auto whitespace-nowrap border border-slate-300 text-center text-xs font-medium dark:border-jovieDark-border',

      freezeColumn
        ? 'overflow-x-noscroll sticky isolate z-40 border-none border-transparent bg-white font-bold first:border-l last:border-r dark:bg-jovieDark-900'
        : '',

      freezeColumn && currentContact.id == creator.id
        ? 'bg-slate-100 text-slate-800 dark:bg-jovieDark-700 dark:text-slate-100'
        : 'text-slate-600 dark:text-slate-200',
      cellActive
        ? 'bg-indigo-50 outline-2 outline-indigo-500 ring-2 ring-indigo-500 dark:ring-indigo-500'
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
        v-model:rating="creator.crm_record_by_user.rating"
        @update:rating="
          $emit('updateCreator', {
            id: creator.id,
            index: row,
            key: `crm_record_by_user.rating`,
            value: creator.crm_record_by_user.rating,
          })
        " />
      <CheckboxInput
        v-else-if="column.type == 'checkbox'"
        :name="`checkbox_${fieldId}_${creator.id}`"
        v-model="modelValue"
        :checked="modelValue"
        @blur="updateData" />

      <DataGridCellTextInput
        v-else-if="
          ['text', 'email', 'currency', 'number', 'url'].includes(column.type)
        "
        :ref="cellActive"
        :fieldId="fieldId"
        @blur="updateData"
        :dataType="column.type"
        v-model="modelValue" />

      <DataGridSocialLinksCell
        :creator="creator"
        :networks="networks"
        :show-count="true"
        v-else-if="column.type == 'socialLinks'" />
      <ContactStageMenu
        v-else-if="column.type == 'select' && column.name == 'Stage'"
        :creator="creator"
        :key="row"
        :open="showContactStageMenu[row]"
        @close="toggleContactStageMenu(row)"
        :stages="stages"
        :index="row"
        @updateCreator="$emit('updateCreator', $event)" />
      <DataGridSocialLinksCell
        :creator="creator"
        :networks="networks"
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
            :value="modelValue"
            pattern="\d{1,2}/\d{1,2}/\d{4}"
            id="date"
            class="block w-full border-none bg-transparent pr-12 placeholder-slate-400 outline-none focus:border-none dark:placeholder-slate-200 sm:text-sm" />
          <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
            <JovieDatePicker
              :value="modelValue"
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
            @updateLists="$emit('updateCreatorLists', $event)"
            :creatorId="creator.id ?? 0"
            :listItems="userLists"
            :lists="creator.lists"
            :currentList="creator.current_list" />
        </template>
        <template #fallback> Loading... </template>
      </Suspense>
      <CustomField
        v-else-if="
          (column.type == 'multi_select' || column.type == 'select') &&
          column.custom
        "
        @blur="updateData"
        :type="column.type"
        :options="column.custom_field_options"
        v-model="creator.crm_record_by_user[column.code]" />
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
  },
  emits: ['update:modelValue', 'blur', 'move'],
  data() {
    return {
      showContactStageMenu: [],
      date: {},
      rerenderKey: 0,
    };
  },
  watch: {
    creator: {
      deep: true,
      handler: function (val) {
        this.rerenderKey += 1;
      },
    },
  },
  mounted() {
    this.date.startDate = this.modelValue;
    this.date.endDate = this.modelValue;
  },
  methods: {
    updateData(value = null) {
      this.nextTick(() => {
        this.$emit('update:modelValue', this.modelValue);
        if (this.column.meta) {
          this.$emit('updateCrmMeta', this.creator);
        } else {
          let key = this.column.key;
          if (this.column.custom) {
            key = `crm_record_by_user.${key}`;
          }
          this.$emit('updateCreator', {
            id: this.creator.id,
            index: this.row,
            key: key,
            value: value ?? this.modelValue,
          });
        }
      });
    },
    handleInput(event) {
      const dateRegex =
        /^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/([0-9]{4})$/;
      if (dateRegex.test(event.target.value)) {
        this.modelValue = event.target.value;
      }
    },
    toggleContactStageMenu(index) {
      this.showContactStageMenu[index] = !this.showContactStageMenu[index];
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
    creator: Object,
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
    modelValue: String,
    currentCell: Object,
    cellActive: Boolean,
    networks: Array,
    stages: Array,
  },
};
</script>
