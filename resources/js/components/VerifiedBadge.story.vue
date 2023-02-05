<template>
  <VerifiedBadge />
</template>
<script>
import Vue from 'vue';
import { storiesOf } from '@storybook/vue';
import { action } from '@storybook/addon-actions';
import VerifiedBadge from './VerifiedBadge.vue';

export default {
  story: {
    category: 'Labels',
    name: 'VerifiedBadge',
  },
  components: { VerifiedBadge },
};
</script>
