<template>
  <div class="">
    <div class="px-4 py-5 sm:p-6">
      <div class="sm:flex sm:items-start sm:justify-between">
        <div>
          <h3 class="text-base font-semibold leading-6 text-gray-900">
            {{ title }}
          </h3>
          <div class="mt-2 max-w-xl text-sm text-gray-500">
            <p>{{ description }}</p>
          </div>
        </div>
        <div
          class="mt-5 sm:ml-6 sm:mt-0 sm:flex sm:flex-shrink-0 sm:items-center">
          <ButtonGroup
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
    buttonStyle: {
      type: String,
      required: false,
    },
  },
  methods: {
    onActionClick() {
      this.$emit('action-click');
    },
  },
};
</script>
