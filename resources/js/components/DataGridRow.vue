<template>
  <tr
    class="border-1 group w-full flex-row overflow-y-visible border border-slate-300 focus-visible:ring-indigo-700 dark:border-jovieDark-border"
    :class="[
      currentContact.id == creator.id
        ? 'border border-jovieDark-300 bg-slate-100 dark:border-jovieDark-border dark:bg-jovieDark-700'
        : 'bg-white dark:bg-jovieDark-900',
    ]">
    <slot> Content Here </slot>
  </tr>
</template>
//add props
<script>
export default {
  name: 'DataGridRow',
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
