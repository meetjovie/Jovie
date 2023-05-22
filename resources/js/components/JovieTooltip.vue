<template>
  <Popover class="relative">
    <Float portal :offset="16" :placement="tooltipPlacement">
      <PopoverButton
        v-slot="{ open }"
        :class="open ? '' : 'text-opacity-90'"
        class=""
        @mouseover="open = true"
        @mouseleave="open = false">
        <slot>Trigger</slot>
      </PopoverButton>

      <transition
        v-show="open && tooltipText"
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="translate-y-1 opacity-0"
        enter-to-class="translate-y-0 opacity-100"
        leave-active-class="transition duration-150 ease-in"
        leave-from-class="translate-y-0 opacity-100"
        leave-to-class="translate-y-1 opacity-0">
        <PopoverPanel static>
          <GlassmorphismContainer
            size="lg"
            class="px-4 py-2 text-xs font-medium text-slate-600 dark:text-jovieDark-200">
            {{ tooltipText }}
          </GlassmorphismContainer>
        </PopoverPanel>
      </transition>
    </Float>
  </Popover>
</template>

<script setup>
import { Float } from '@headlessui-float/vue';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import { ChevronDownIcon } from '@heroicons/vue/20/solid';
import GlassmorphismContainer from '../components/GlassmorphismContainer.vue';
</script>
<script>
export default {
  props: {
    tooltipText: {
      type: String,
      default: 'Tooltip Text',
    },
    tooltipPlacement: {
      type: String,
      default: 'right',
    },
  },
  data() {
    return {
      open: false,
    };
  },
};
</script>
