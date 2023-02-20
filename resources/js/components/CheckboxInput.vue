<template>
  <input
    type="checkbox"
    :id="name"
    :name="name"
    v-bind:checked="checked"
    v-on:change="$emit('update:modelValue', $event.target.checked); $emit('blur')"
    class="h-3 w-3 rounded border-slate-300 text-indigo-600 focus-visible:ring-indigo-500 dark:border-jovieDark-border dark:text-indigo-400 sm:left-6" />
</template>

<script>
export default {
  props: {
    checked: {
      type: Boolean,
      required: true,
    },
      modelValue: {},
      name
  },
};
</script>
