<template>
  <td
    v-if="freezeColumn || visibleColumns.includes(columnName)"
    :class="[
      currentContact.id == creator.id
        ? ' bg-slate-100 dark:bg-jovieDark-700'
        : 'bg-white dark:bg-jovieDark-900',
      freezeColumn ? 'sticky isolate z-20' : '',
      { [`w-${width}`]: width }, // Add this object
    ]"
    class="overflow-auto whitespace-nowrap border-y border-slate-300 py-0.5 text-center text-xs font-bold text-slate-300 group-hover:text-slate-500 dark:border-jovieDark-border before:dark:border-jovieDark-border dark:group-hover:text-slate-400">
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
  },
};
</script>
