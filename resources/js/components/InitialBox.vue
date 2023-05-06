<template>
  <div
    class="flex items-center justify-center rounded-md bg-indigo-300 p-1 dark:bg-jovieDark-400"
    :style="{ height: `${height}px`, width: `${height}px` }">
    <span class="items-center text-xs text-white">{{ firstLetter }}</span>
  </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true,
    },
    height: {
      type: Number,
      required: true,
    },
  },
  computed: {
    firstLetter() {
      return this.name.charAt(0).toUpperCase();
    },
    boxStyle() {
      return 'rounded-lg bg-blue-500 flex items-center justify-center';
    },
  },
};
</script>
