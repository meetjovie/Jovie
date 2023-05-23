<template>
  <Popover class="relative">
    <Float portal :offset="8" :placement="tooltipPlacement">
      <PopoverButton
        v-slot="{ open }"
        :class="open ? '' : 'text-opacity-90'"
        class="w-full"
        @mouseover="mouseover()"
        @mouseleave="mouseleave()">
        <slot>Trigger</slot>
      </PopoverButton>

      <transition
        v-show="open && tooltipText"
        enter="transition-opacity duration-75"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="transition-opacity duration-150"
        leave-from="opacity-100"
        leave-to="opacity-0">
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
    return { open: false, timer: null };
  },
  methods: {
    mouseover() {
      clearTimeout(this.timer);
      this.timer = setTimeout(() => {
        this.open = true;
      }, 500);
    },
    mouseleave() {
      clearTimeout(this.timer);
      this.open = false;
    },
  },
};
</script>
