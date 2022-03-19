<template>
  <div
    class="flex h-6 items-center rounded-full px-3 text-2xs font-semibold"
    :class="`bg-${color}-100 text-${color}-700`">
    <span class="mr-1 h-2 w-2 rounded-full" :class="`bg-${color}-400`"></span>
    <span>
      <slot></slot>
    </span>
  </div>
</template>
<script>
export default {
  props: {
    color: {
      type: String,
      default: 'red',
    },
  },
};
</script>
