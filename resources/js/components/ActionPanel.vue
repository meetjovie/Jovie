<template>
  <div class="mt-4">
    <div class="py-5">
      <div class="sm:flex sm:items-start sm:justify-between">
        <div>
          <h3
            class="text-base font-semibold leading-6 text-slate-900 dark:text-jovieDark-100">
            {{ title }}
          </h3>
          <div
            class="mt-2 max-w-xl text-sm text-slate-500 dark:text-jovieDark-400">
            <p>{{ description }}</p>
          </div>
        </div>
        <div
          class="mt-5 sm:ml-6 sm:mt-0 sm:flex sm:flex-shrink-0 sm:items-center">
          <ButtonGroup
            :loading="loading"
            :design="buttonStyle"
            @click="onActionClick"
            :text="buttonText" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ButtonGroup from './ButtonGroup.vue';
export default {
  components: {
    ButtonGroup,
  },
  props: {
    title: {
      type: String,
      required: true,
      default: 'Title goes here',
    },
    description: {
      type: String,
      required: false,
    },
    buttonText: {
      type: String,
      required: false,
    },
    loading: {
      type: Boolean,
      required: false,
      default: false,
    },
    buttonStyle: {
      type: String,
      required: false,
      default: 'compact',
    },
  },
  methods: {
    onActionClick() {
      this.$emit('action-click');
    },
  },
};
</script>
