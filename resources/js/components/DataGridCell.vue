<template>
  <td
    v-if="freezeColumn || neverHide || visibleColumns.includes(columnName)"
    :class="[
      currentContact.id == creator.id
        ? ' bg-slate-100 text-slate-500 dark:bg-jovieDark-700 dark:text-slate-400'
        : 'darK bg-white text-slate-200 text-slate-300 dark:bg-jovieDark-900  ',
      freezeColumn ? 'sticky isolate z-20 font-bold focus:outline-none' : '',
      cellActive ? 'border-indigo-500' : '',
      width ? `w-${width}` : '',
    ]"
    class="overflow-auto whitespace-nowrap border-y border-slate-300 text-center text-xs font-medium focus:outline-indigo-500 dark:border-jovieDark-border before:dark:border-jovieDark-border">
    <slot> Content Here </slot>
  </td>
</template>

<script>
export default {
  name: 'DataGridCell',
  props: {
    currentContact: Object,
    creator: Object,
    index: Number,
    selectedCreators: Array,
    freezeColumn: Boolean,
    width: String,
    columnName: String,
    visibleColumns: Array,
    neverHide: Boolean,
    cellActive: Boolean,
  },
};
</script>
