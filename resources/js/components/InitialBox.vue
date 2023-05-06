<template>
  <div
    class="flex items-center justify-center bg-purple-700 dark:bg-jovieDark-400 rounded-md"
    :style="{ height: `${height}px`, width: `${height}px` }">
    <span class="text-lg text-white">{{ firstLetter }}</span>
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
