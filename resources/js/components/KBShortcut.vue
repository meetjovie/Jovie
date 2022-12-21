<template>
  <div class="flex">
    <div
      class="flex items-center text-slate-300 dark:text-jovieDark-400"
      :key="key"
      v-for="(key, index) in shortcutKey">
      <kbd
        :class="{
          'rounded-md bg-slate-100 px-2 dark:bg-jovieDark-500': hasBg,
          'border-slate-200 dark:border-jovieDark-border': !hasBg,
        }"
        class="inline-flex items-center text-xs font-bold uppercase dark:border-jovieDark-border"
        >{{ key }}</kbd
      >
      <span
        class="-mt-0.5 items-center px-1 text-xs opacity-50"
        v-if="index < shortcutKey.length - 1 && !sequence">
        +
      </span>
      <span
        class="-mt-0.5 items-center px-1 text-xs opacity-50"
        v-else-if="index < shortcutKey.length - 1 && sequence">
        then
      </span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    shortcutKey: {
      type: Array,
      required: true,
    },
    hasBg: {
      type: Boolean,
      default: false,
    },
    sequemce: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
