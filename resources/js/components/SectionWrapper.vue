<template>
  <div
    class="border-y border-gray-200 py-12 leading-4 dark:border-jovieDark-border">
    <h3
      class="text-lg font-medium leading-6 text-slate-900 dark:text-jovieDark-100">
      {{ header }}
    </h3>
    <p class="mt-2 max-w-4xl text-sm text-slate-600 dark:text-jovieDark-400">
      {{ subheader }}
    </p>
    <slot></slot>
  </div>
</template>
<script>
export default {
  name: 'SectionHeader',
  props: {
    header: {
      type: String,
      required: true,
      default: 'Header here',
    },
    subheader: {
      type: String,
      required: false,
    },
  },
};
</script>
