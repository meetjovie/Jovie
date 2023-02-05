<template>
  <span
    class="inline-block h-2 w-2 flex-shrink-0 rounded-full"
    :class="colorClass"></span>
</template>
<script>
import { defineComponent } from 'vue';

export default defineComponent({
  props: {
    color: {
      type: String,
      required: true,
    },
  },
  computed: {
    colorClass() {
      return `bg-${this.color}-500`;
    },
  },
});
</script>
