<template>
  <QuestionMarkIcon class="h-4 w-4 text-gray-500" />
</template>
<script>
import JovieTooltip from './JovieTooltip.vue';
import QuestionMarkIcon from '@heroicons/vue/solid/24/QuestionMarkCircleIcon';

export default {
  name: 'HelpTag',
  components: {
    JovieTooltip,
    QuestionMarkIcon,
  },
  props: {
    text: {
      type: String,
      default:
        'This is help text to explain a feature. It can be quite long and wrap over multiple lines.',
      required: true,
    },
    placement: {
      type: String,
      default: 'bottom',
    },
  },
};
</script>
