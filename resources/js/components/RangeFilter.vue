<template>
  <div class="relative">
    <div class="absolute inset-0 flex items-center" aria-hidden="true">
      <div class="w-full border-t border-gray-300" />
    </div>
    <div class="relative flex justify-start">
      <span class="bg-white pr-2 text-xs text-gray-500"> {{ label }}</span>
    </div>
  </div>
  <div class="grid grid-cols-2">
    <InputGroup
      size="sm"
      rounded="top-left"
      :icon="minicon"
      :placeholder="mintext" />
    <InputGroup
      size="sm"
      rounded="top-right"
      :icon="maxicon"
      :placeholder="maxtext" />
  </div>
  <div class="flex items-center justify-between">
    <span class="relative z-0 mx-auto inline-flex w-full text-center">
      <ButtonGroup
        rounded="bl"
        size="xs"
        style="secondary"
        class="w-full"
        :text="preset1"></ButtonGroup>
      <ButtonGroup
        rounded="none"
        size="xs"
        style="secondary"
        class="w-full"
        :text="preset2"></ButtonGroup>
      <ButtonGroup
        rounded="br"
        size="xs"
        class="w-full"
        style="secondary"
        :text="preset3"></ButtonGroup>
    </span>
  </div>
</template>
<script>
import InputGroup from './InputGroup.vue';
import ButtonGroup from './ButtonGroup.vue';

export default {
  name: 'RangeFilter',
  props: {
    mintext: {
      type: String,
      default: 'Min',
    },
    maxtext: {
      type: String,
      default: 'Max',
    },
    minicon: {
      type: String,
      default: null,
    },
    maxicon: {
      type: String,
      default: null,
    },
    label: {
      type: String,
      default: 'Filter',
    },
    preset1: {
      type: Array,
      default: 'Preset 1',
    },
    preset2: {
      type: Array,
      default: 'Preset 2',
    },
    preset3: {
      type: Array,
      default: 'Preset 3',
    },
  },
  components: {
    InputGroup,
    ButtonGroup,
  },
};
</script>
