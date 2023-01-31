<template>
  <div>
    <span
      class="inline-block h-2 w-2 flex-shrink-0 rounded-full"
      :class="colorClass"></span>
  </div>
</template>
<script>
export default {
  props: {
    color: {
      type: String,
      default: 'blue',
      required: true,
    },
  },
  computed: {
    colorClass() {
      return `bg-${this.color}-500`;
    },
  },
};
</script>
