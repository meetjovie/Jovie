<template>
  <JovieSpinner spinnerColor="orange" spinnerSize="md" />
</template>
<script>
import JovieSpinner from './JovieSpinner.vue';

export default {
  story: {
    category: 'Spinners',
    name: 'JovieSpinner',
  },
  components: { JovieSpinner },
  props: {
    spinnerSize: {
      type: String,
      default: 'sm',
    },
    spinnerColor: {
      type: String,
      default: 'indigo',
    },
  },
};
</script>
