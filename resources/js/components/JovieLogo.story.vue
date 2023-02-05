<template>
  <JovieLogo />
</template>

<script>
import JovieLogo from './JovieLogo.vue';

export default {
  story: {
    category: 'Brand',
    name: 'JovieLogo',
  },
  props: {
    width: {
      type: String,
      default: 'auto',
    },
    height: {
      type: String,
      default: '170px',
    },
    color: {
      type: String,
      default: 'currentColor',
    },
    link: {
      type: String,
      default: '/',
    },
  },
  components: { JovieLogo },
};
</script>
