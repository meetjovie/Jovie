<template>
  <Popover class="w-full">
    <Float
      :show="show"
      enter="transition duration-200 ease-out"
      enter-from="scale-95 opacity-0"
      enter-to="scale-100 opacity-100"
      leave="transition duration-150 ease-in"
      leave-from="scale-100 opacity-100"
      leave-to="scale-95 opacity-0"
      tailwindcss-origin-class
      flip
      :offset="10"
      placement="right"
      shift
      portal
      arrow>
      <PopoverButton class="w-full">
        <slot>Trigger Goes Here</slot>
      </PopoverButton>

      <PopoverPanel @mouseleave="close()" static class="right-0 z-50">
        <div
          class="backfdrop-filter flex w-auto items-center justify-between rounded-md border border-neutral-200 bg-neutral-800 px-2 py-1 text-xs text-neutral-50 shadow-lg backdrop-blur-2xl backdrop-saturate-150">
          <div>{{ text }}</div>
          <div class="px-2 text-2xs text-white" v-if="shortcut.key">
            <kbd
              class="py-.5 rounded-lg border border-gray-200 bg-gray-100 px-1 text-2xs font-semibold text-gray-800 dark:border-gray-500 dark:bg-gray-600 dark:text-gray-100">
              {{ shortcut.modifier }}</kbd
            >
            +
            <kbd
              class="py-.5 rounded-lg border border-gray-200 bg-gray-100 px-1 text-2xs font-semibold text-gray-800 dark:border-gray-500 dark:bg-gray-600 dark:text-gray-100">
              {{ shortcut.key }}</kbd
            >
          </div>
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
  data() {
    return {
      show: false,
    };
  },
  methods: {
    setShowTooltip() {
      //wait .2 seconds then show the tooltip
      setTimeout(() => {
        this.showTooltip = true;
      }, 200);
    },
    setHideTooltip() {
      this.showTooltip = false;
    },
  },
  props: {
    text: {
      type: String,
      default: 'Helpful tooltip text',
    },
    show: {
      type: Boolean,
      default: false,
    },
    keyboardShortcut: {
      type: String,
      default: 'Ctrl + Shift + I',
    },
    shortcut: {
      type: Object,
      default: () => {
        return {
          modifier: null,
          key: null,
        };
      },
    },
  },
};
</script>
