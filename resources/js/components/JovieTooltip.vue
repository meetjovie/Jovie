<template>
  <Popover class="relative w-full">
    <Float
      enter="transition duration-200 ease-out"
      enter-from="scale-95 opacity-0"
      enter-to="scale-100 opacity-100"
      leave="transition duration-150 ease-in"
      leave-from="scale-100 opacity-100"
      leave-to="scale-95 opacity-0"
      tailwindcss-origin-class
      auto-placement
      fixed
      placement="right-end"
      :offset="4">
      <PopoverButton class="w-full">
        <slot>Trigger Goes Here</slot>
      </PopoverButton>

      <PopoverPanel @mouseleave="close()" static class="right-0 z-50">
        <div
          class="backfdrop-filter shadown-xl w-40 rounded-md border border-neutral-200 bg-neutral-200/60 px-2 py-1 text-xs text-indigo-700 backdrop-blur-2xl backdrop-saturate-150">
          {{ text }}
        </div>
      </PopoverPanel>
    </Float>
  </Popover>
</template>

<script>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import { Float } from '@headlessui-float/vue';

export default {
  components: {
    Popover,
    PopoverButton,
    PopoverPanel,
    Float,
  },
  props: {
    text: {
      type: String,
      default: 'Helpful tooltip text',
    },
    keyboardShortcut: {
      type: String,
      default: 'Ctrl + Shift + I',
    },
  },
};
</script>
