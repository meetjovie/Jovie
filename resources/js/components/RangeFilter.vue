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
    <InputGroup unround="right" :icon="minicon" :placeholder="mintext" />
    <InputGroup unround="left" :icon="maxicon" :placeholder="maxtext" />
  </div>
  <div class="flex items-center justify-between">
    <span class="relative z-0 mx-auto flex inline-flex w-full text-center">
      <button
        type="button"
        class="py-.05 relative inline-flex w-full items-center justify-center border border-neutral-300 bg-indigo-500 px-2 text-center text-xs font-medium font-medium text-neutral-50 first:rounded-bl-md last:rounded-br-md hover:bg-indigo-600 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:text-neutral-100">
        {{ preset1 }}
      </button>
      <button
        type="button"
        class="py-.05 relative inline-flex w-full items-center justify-center border border-neutral-300 bg-indigo-500 px-2 text-center text-xs font-medium font-medium text-neutral-50 first:rounded-bl-md last:rounded-br-md hover:bg-indigo-600 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:text-neutral-100">
        {{ preset2 }}
      </button>
      <button
        type="button"
        class="py-.05 relative inline-flex w-full items-center justify-center border border-neutral-300 bg-indigo-500 px-2 text-center text-xs font-medium font-medium text-neutral-50 first:rounded-bl-md last:rounded-br-md hover:bg-indigo-600 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:text-neutral-100">
        {{ preset3 }}
      </button>
    </span>
  </div>
</template>
<script>
import InputGroup from './InputGroup.vue';

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
  },
};
</script>
