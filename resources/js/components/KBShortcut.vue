<template>
  <div
    class="flex w-full items-center space-x-2"
    v-for="(key, index) in shortcutKey">
    <kbd
      class="itemse-center inline-flex rounded-md py-0.5 px-2 text-2xs dark:border-jovieDark-border dark:bg-jovieDark-600 dark:text-white"
      >{{ key }}</kbd
    >
    <span
      class="items-center text-[8px] dark:text-slate-200"
      v-if="index < shortcutKey.length - 1">
      +
    </span>
  </div>
</template>

<script>
export default {
  props: {
    shortcutKey: {
      type: Array,
      required: true,
    },
  },
};
</script>
