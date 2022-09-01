<template>
  <Popover class="relative w-full">
    <Float fixed placement="bottom-end">
      <PopoverButton class="w-full">
        <slot>Trigger Goes Here</slot>
      </PopoverButton>

      <PopoverPanel
        @mouseleave="close()"
        static
        class="absolute top-0 right-0 z-50">
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
