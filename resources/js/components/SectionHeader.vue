<template>
  <div
    :class="
      border
        ? 'border-b border-gray-200 py-6 pb-5 leading-4 dark:border-jovieDark-border'
        : 'border-none'
    "
    class="flex items-center justify-between">
    <div class="leading-4">
      <h3
        :class="size === 'lg' ? 'text-lg' : 'text-2xl'"
        class="text-2xl font-medium leading-6 text-slate-900 dark:text-jovieDark-100">
        {{ header }}
      </h3>
      <p class="mt-2 max-w-4xl text-sm text-slate-600 dark:text-jovieDark-400">
        {{ subheader }}
      </p>
    </div>
    <div v-if="callToAction" class="py-4">
      <ButtonGroup style="compact" :text="callToAction" />
    </div>
  </div>
</template>
<script>
import ButtonGroup from './ButtonGroup.vue';
export default {
  name: 'SectionHeader',
  components: {
    ButtonGroup,
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
    border: {
      type: Boolean,
      required: false,
      default: true,
    },
    subheader: {
      type: String,
      required: false,
    },
    size: {
      type: String,
      required: false,
      default: '2xl',
    },
  },
};
</script>
