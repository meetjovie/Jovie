<template>
  <div class="group">
    <slot>Trigger Goes Here</slot>
  </div>
  <div
    class="absolute -top-2 -right-3 z-50 hidden w-auto translate-x-full flex-col items-center justify-between rounded-md border border-gray-200 bg-gray-800 px-2 py-1 text-xs text-gray-50 shadow-lg group-hover:flex group-hover:flex">
    <div class="font-bold">{{ text }}</div>
    <div>
      <slot name="content"></slot>
    </div>
  </div>
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
        this.show = true;
      }, 200);
      /* //after 10 seconds, hide the tooltip
      setTimeout(() => {
        this.show = false;
      }, 10000); */
      //also hide the tooltip if another tooltip is opened
    },
    setHideTooltip() {
      this.show = false;
    },
  },
  props: {
    text: {
      type: String,
      default: 'Helpful tooltip text',
    },
    placement: {
      type: String,
      default: 'right',
    },
    arrow: {
      type: Boolean,
      default: false,
    },

    shortcutKeys: {
      type: Array,
      default: () => ['Ctrl', 'Shift', 'I'],
    },
  },
};
</script>
