<template>
  <td
    @focus="setFocus"
    tabindex="freezeColumn ? -1 : 0"
    @keydown="onKeyDown"
    v-if="freezeColumn || neverHide || visibleColumns.includes(column.key)"
    :class="[
      currentContact.id == creator.id
        ? ' bg-slate-100 text-slate-700 dark:bg-jovieDark-700 dark:text-slate-100'
        : 'bg-white text-slate-600 dark:bg-jovieDark-900 dark:text-slate-200  ',
      freezeColumn
        ? 'fcous:ring-0 sticky isolate z-20 font-bold focus:border-none focus:outline-none'
        : 'border-x',
      cellActive ? 'border-indigo-500' : '',
      columnWidth ? `w-${columnWidth}` : '',
    ]"
    class="overflow-auto whitespace-nowrap border-slate-300 text-center text-xs font-medium focus:border-none focus:outline-indigo-500 focus:ring-0 dark:border-jovieDark-border before:dark:border-jovieDark-border">
    <slot>
      <component
        ref="cellInput"
        tabindex="0"
        :is="inputComponent"
        :fieldId="fieldId"
        @blur="onBlur"
        :placeholder="columnName"
        v-model="modelValue" />
      <!--  <star-rating
        v-if="dataType == 'rating'"
        class="w-20"
        :star-size="12"
        :increment="0.5"
        v-model:rating="modelValue"
        @blur="onBlur" />
      <CheckboxInput v-if="dataType == 'checkbox'" v-model="modelValue" />
      <DataGridCellTextInput
        v-else
        :fieldId="fieldId"
        @blur="onBlur"
        :placeholder="columnName"
        v-model="modelValue" /> -->
    </slot>
  </td>
</template>

<script>
import CheckboxInput from './CheckboxInput.vue';
import DataGridCellTextInput from './DataGridCellTextInput.vue';
import StarRating from 'vue-star-rating';
export default {
  name: 'DataGridCell',
  components: {
    DataGridCellTextInput,
    StarRating,
    CheckboxInput,
  },
  emits: ['update:modelValue', 'blur', 'move'],
  methods: {
    onBlur() {
      this.$emit('blur');
    },
  },
  onKeyDown(event) {
    switch (event.key) {
      case 'ArrowRight':
        this.$emit('move', 'right');
        break;
      case 'ArrowLeft':
        this.$emit('move', 'left');
        break;
      case 'ArrowUp':
        this.$emit('move', 'up');
        break;
      case 'ArrowDown':
        this.$emit('move', 'down');
        break;
    }
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
    setFocus() {
      //focus on the cell input
      this.$refs.cellInput.focus();
      console.log(this.$refs.cellInput);
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
    selectedCreators: Array,
    freezeColumn: Boolean,

    fieldId: String,

    visibleColumns: Array,
    neverHide: Boolean,
    cellActive: Boolean,
    column: Object,
    rowIndex: Number,
    dataType: String,
    modelValue: String,
  },
};
</script>
