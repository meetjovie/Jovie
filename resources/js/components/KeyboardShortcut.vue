<template>
  <kbd
    class="inline-flex items-center rounded border border-slate-200 px-2 font-sans text-2xs font-medium text-slate-400"
    >{{ text }}</kbd
  >
</template>
<script>
export default {
  name: 'KeyboardShortcut.vue',
  props: {
    text: {
      type: String,
      default: '⌘K',
    },
  },
};
</script>
