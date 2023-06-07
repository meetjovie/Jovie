<template>
  <div
    class="flex items-center justify-center rounded bg-indigo-300 p-1 dark:bg-jovieDark-400"
    :style="{ height: `${height}px`, width: `${height}px` }">
    <span
      :class="[
        'items-center',
        height < 14 ? 'text-[8px]' : 'text-xs',
        'text-white',
      ]"
      >{{ emoji || firstLetter }}</span
    >
  </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true,
    },
    emoji: {
      type: String,
      required: false,
      default: null,
    },
    height: {
      type: Number,
      required: false,
      default: 18,
    },
  },
  computed: {
    firstLetter() {
      return this.name.charAt(0).toUpperCase();
    },
  },
};
</script>
