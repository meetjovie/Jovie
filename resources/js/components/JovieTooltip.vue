<template>
  <!-- <Popover class="w-full">
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
      :placement="placement"
      portal
      :arrow="arrow">
      <PopoverButton
        @mouseover="setShowTooltip()"
        @mouseleave="setHideTooltip()"
        class="w-full">
        <slot>Trigger Goes Here</slot>
      </PopoverButton>

      <PopoverPanel @mouseleave="close()" static class="right-0 z-50">
        <div
          class="backfdrop-filter w-auto flex-col items-center justify-between rounded-md border border-neutral-200 bg-neutral-800 px-2 py-1 text-xs text-neutral-50 shadow-lg backdrop-blur-2xl backdrop-saturate-150">
          <div class="font-bold">{{ text }}</div>
          <div>
            <slot name="content"></slot>
          </div>
        </div>
      </PopoverPanel>
    </Float>
  </Popover> -->

  <slot class="group">Trigger Goes Here</slot>

  <div
    class="backfdrop-filter absolute z-50 hidden w-auto flex-col items-center justify-between rounded-md border border-neutral-200 bg-neutral-800 px-2 py-1 text-xs text-neutral-50 shadow-lg backdrop-blur-2xl backdrop-saturate-150 group-hover:flex">
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
