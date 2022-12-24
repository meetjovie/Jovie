<template>
  <input
    type="checkbox"
    v-bind:checked="checked"
    v-on:input="$emit('input', $event.target.checked)"
    class="h-3 w-3 rounded border-slate-300 text-indigo-600 focus-visible:ring-indigo-500 dark:border-jovieDark-border dark:text-indigo-400 sm:left-6" />
</template>

<script>
export default {
  props: {
    checked: {
      type: Boolean,
      default: false,
      required: true,
    },
  },
};
</script>
