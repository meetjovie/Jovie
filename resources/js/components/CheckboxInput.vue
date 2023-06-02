<template>
  <input
    type="checkbox"
    :id="name"
    :name="name"
    v-bind:checked="checked"
    v-on:change="
      $emit('update:modelValue', $event.target.checked);
      $emit('markCheck');
    "
    class="dark:focus-ring-0 h-3 w-3 rounded border-slate-300 bg-slate-100 text-indigo-600 focus-visible:border-0 focus-visible:outline-none focus-visible:ring-0 dark:border-jovieDark-border dark:bg-slate-900 dark:text-indigo-700 dark:focus-visible:outline-none sm:left-6" />
</template>

<script>
export default {
  props: {
    checked: {
      type: Boolean,
      required: false,
      default: false,
    },
    modelValue: {},
    name,
  },
};
</script>
