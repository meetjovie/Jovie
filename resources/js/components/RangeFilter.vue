<template>
  <div>
    <div class="relative">
      <div class="absolute inset-0 flex items-center" aria-hidden="true">
        <div class="w-full border-t border-slate-300" />
      </div>
      <div class="relative flex justify-start">
        <span class="bg-slate-50 pr-2 text-xs text-slate-500">
          {{ label }}</span
        >
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
        :icon="maXMarkIcon"
        :placeholder="maxtext" />
    </div>
    <div class="flex items-center justify-between">
      <span class="relative z-0 mx-auto inline-flex w-full text-center">
        <ButtonGroup
          rounded="bl"
          size="xs"
          design="secondary"
          class="w-full"
          :text="preset1"></ButtonGroup>
        <ButtonGroup
          rounded="none"
          size="xs"
          design="secondary"
          class="w-full"
          :text="preset2"></ButtonGroup>
        <ButtonGroup
          rounded="br"
          size="xs"
          class="w-full"
          design="secondary"
          :text="preset3"></ButtonGroup>
      </span>
    </div>
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
    maXMarkIcon: {
      type: String,
      default: null,
    },
    label: {
      type: String,
      default: 'Filter',
    },
    preset1: {
      type: String,
      default: 'Preset 1',
    },
    preset2: {
      type: String,
      default: 'Preset 2',
    },
    preset3: {
      type: String,
      default: 'Preset 3',
    },
  },
  components: {
    InputGroup,
    ButtonGroup,
  },
};
</script>
