<template>
  <kbd
    class="inline-flex items-center rounded border border-gray-200 px-2 font-sans text-2xs font-medium text-gray-400 group-hover:bg-slate-100"
    >{{ shortcutKey }}</kbd
  >
</template>
<script>
export default {
  props: {
    shortcutKey: {
      type: String,
      required: true,
    },
  },
};
</script>
