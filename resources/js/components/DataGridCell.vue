<template>
  <td
    v-if="freezeColumn || neverHide || (column && visibleColumns.includes(column.key))"
    :class="[
      cellActive ? ' border border-indigo-500 bg-red-500' : '',
      currentContact.id == creator.id
        ? ' bg-slate-100 text-slate-700 dark:bg-jovieDark-700 dark:text-slate-100'
        : 'bg-white text-slate-600 dark:bg-jovieDark-900 dark:text-slate-200  ',

      freezeColumn
        ? 'fcous:ring-0 sticky isolate z-20 font-bold focus:border-none focus:outline-none'
        : 'border-x',

      columnWidth ? `w-${columnWidth}` : '',
    ]"
    class="overflow-auto whitespace-nowrap border-slate-300 text-center text-xs font-medium focus:border-none focus:outline-indigo-500 focus:ring-0 dark:border-jovieDark-border before:dark:border-jovieDark-border">
    <slot></slot>
    <!--   <component
        ref="cellInput"
        tabindex="0"
        :is="inputComponent"
        :fieldId="fieldId"
        @blur="onBlur"
        :placeholder="columnName"
        v-model="modelValue" /> -->
    <div v-if="!freezeColumn">
      <span v-if="cellActive">Active</span>
      <star-rating
        v-if="column.dataType == 'rating'"
        class="w-20"
        :star-size="12"
        :increment="0.5"
        v-model:rating="creator.crm_record_by_user.rating"
        @update:rating="
          $emit('updateCreator', {
            id: key,
            index: index,
            key: `crm_record_by_user.rating`,
            value: creator.crm_record_by_user.rating,
          })
        "
      />
      <CheckboxInput v-else-if="dataType == 'checkbox'" v-model="modelValue" />
      <DataGridCellTextInput
        v-else-if="['text', 'email', 'currency'].includes(column.dataType)"
        :fieldId="fieldId"
        @blur="onBlur"
        :dataType="column.dataType"
        :placeholder="columnName"
        v-model="modelValue" />
      <DataGridSocialLinksCell :creator="creator" :networks="networks" v-else-if="column.dataType == 'socialLinks'" />
        <ContactStageMenu
            v-else-if="column.dataType == 'singleSelect'"
            :creator="creator"
            :key="key"
            :open="showContactStageMenu[index]"
            @close="toggleContactStageMenu(index)"
            :stages="stages"
            :index="index"
            @updateCreator="$emit('updateCreator', $event)" />
      <span v-else
        >Data Type:
        {{ column.dataType }}
      </span>
    </div>
  </td>
</template>

<script>
import CheckboxInput from './CheckboxInput.vue';
import DataGridCellTextInput from './DataGridCellTextInput.vue';
import StarRating from 'vue-star-rating';
import SocialIcons from "./SocialIcons.vue";
import DataGridSocialLinksCell from "./DataGridSocialLinksCell.vue";
import ContactStageMenu from "./ContactStageMenu.vue";
export default {
  name: 'DataGridCell',
  components: {
      ContactStageMenu,
      DataGridSocialLinksCell,
      SocialIcons,
    DataGridCellTextInput,
    StarRating,
    CheckboxInput,
  },
  emits: ['update:modelValue', 'blur', 'move'],
    mounted() {
        console.log(this.column);
    },
    data() {
      return {
          showContactStageMenu: [],
      }
    },
  methods: {
      toggleContactStageMenu(index) {
          this.showContactStageMenu[index] = !this.showContactStageMenu[index];
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
      const column = this.visibleColumns.find(
        (col) => col.name === this.columnName
      );
      // If the object was found, return its width. Otherwise, return an empty string.
      return column ? column.width : '';
    },
  },
  props: {
    currentContact: Object,
    creator: Object,
    index: Number,
    key: Number,
    selectedCreators: Array,
    freezeColumn: Boolean,
    fieldId: String,
    visibleColumns: Array,
    neverHide: Boolean,
    column: Object,
    rowIndex: Number,
    columnIndex: Number,
    modelValue: String,
    currentCell: Object,
    cellActive: Boolean,
    networks: Array,
    stages: Array,
  },
};
</script>
