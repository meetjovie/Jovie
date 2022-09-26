<template>
  <kbd
    class="inline-flex items-center rounded border border-gray-200 px-2 font-sans text-2xs font-medium text-gray-400"
    >{{ text }}</kbd
  >
</template>
<script>
export default {
  name: 'KeyboardShortcut',
  props: {
    text: {
      type: String,
      default: '⌘K',
    },
  },
};
</script>
