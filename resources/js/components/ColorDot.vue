<template>
  <span
    class="inline-block h-2 w-2 flex-shrink-0 rounded-full"
    :class="colorClass"></span>
</template>
<script>
export default {
  props: {
    color: {
      type: String,
      required: true,
    },
  },
  computed: {
    colorClass() {
      return `bg-${this.color}-500 dark:bg-${this.color}-700`;
    },
  },
};
</script>
