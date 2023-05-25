<template>
  <div
    class="border-y border-gray-200 py-12 leading-4 dark:border-jovieDark-border">
    <SectionHeader
      :border="false"
      size="lg"
      :callToAction="callToAction"
      :header="header"
      :subheader="subheader" />
    <div class="spacey-4 mt-2 flex flex-col">
      <slot> </slot>
    </div>
  </div>
</template>
<script>
import SectionHeader from './SectionHeader.vue';
export default {
  name: 'SectionWrapper',
  components: {
    SectionHeader,
  },
  props: {
    callToAction: {
      type: String,
      required: false,
    },
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
