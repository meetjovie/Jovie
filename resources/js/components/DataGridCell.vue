<template>
  <td
    tabindex="0"
    @keydown="onKeyDown"
    v-if="freezeColumn || neverHide || visibleColumns.includes(columnName)"
    :class="[
      currentContact.id == creator.id
        ? ' bg-slate-100 text-slate-500 dark:bg-jovieDark-700 dark:text-slate-400'
        : 'darK bg-white text-slate-200 text-slate-300 dark:bg-jovieDark-900  ',
      freezeColumn ? 'sticky isolate z-20 font-bold focus:outline-none' : '',
      cellActive ? 'border-indigo-500' : '',
      columnWidth ? `w-${columnWidth}` : '',
    ]"
    class="overflow-auto whitespace-nowrap border-y border-slate-300 text-center text-xs font-medium focus:outline-indigo-500 dark:border-jovieDark-border before:dark:border-jovieDark-border">
    <slot>
      <star-rating
        v-if="dataType == 'rating'"
        class="w-20"
        :star-size="12"
        :increment="0.5"
        v-model:rating="modelValue"
        @blur="onBlur" />
      <DataGridCellTextInput
        v-else
        :fieldId="fieldId"
        @blur="onBlur"
        :placeholder="columnName"
        v-model="modelValue" />
    </slot>
  </td>
</template>

<script>
import DataGridCellTextInput from './DataGridCellTextInput.vue';
import StarRating from 'vue-star-rating';
export default {
  name: 'DataGridCell',
  components: {
    DataGridCellTextInput,
    StarRating,
  },
  emits: ['update:modelValue', 'blur', 'move'],
  methods: {
    onBlur() {
      this.$emit('blur');
    },
  },
  onKeyDown(event) {
    if (event.key === 'ArrowRight') {
      // Emit a "move" event with the direction "right"
      this.$emit('move', 'right');
    } else if (event.key === 'ArrowLeft') {
      // Emit a "move" event with the direction "left"
      this.$emit('move', 'left');
    } else if (event.key === 'ArrowUp') {
      // Emit a "move" event with the direction "up"
      this.$emit('move', 'up');
    } else if (event.key === 'ArrowDown') {
      // Emit a "move" event with the direction "down"
      this.$emit('move', 'down');
    }
  },
  computed: {
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
