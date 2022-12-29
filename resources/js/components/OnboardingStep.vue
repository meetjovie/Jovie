<template>
  <div
    class="mx-auto flex h-full max-w-7xl flex-col justify-center py-12 text-center font-bold text-slate-600 dark:text-jovieDark-200">
    <h1 class="text-2xl font-bold text-slate-900 dark:text-jovieDark-100">
      {{ header }}
    </h1>

    <h2
      class="text-lg font-normal tracking-wide text-slate-600 dark:text-jovieDark-300">
      {{ subheader }}
    </h2>

    <slot></slot>
  </div>
</template>
<script>
export default {
  props: {
    header: {
      type: String,
      required: true,
    },
    subheader: {
      type: String,
      required: true,
    },
  },
};
</script>
