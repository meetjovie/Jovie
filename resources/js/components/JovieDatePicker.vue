<template>
  <Popover as="div" class="relative">
    <Float :z-index="999" placement="bottom-end" portal shift>
      <PopoverButton class="items-center">
        <CalendarDaysIcon
          class="h-5 w-5 cursor-pointer text-slate-400 dark:text-jovieDark-600 dark:active:text-slate-100 dark:group-hover/action:text-slate-400" />
      </PopoverButton>

      <PopoverPanel>
        <GlassmorphismContainer>
          <div
            class="rounded-md bg-white shadow-lg dark:bg-jovieDark-900 dark:text-jovieDark-100">
            <div class="p-2">
              <vue-tailwind-datepicker
                as-single
                class=""
                no-input
                v-model="date"
                @change="$emit('update:modelValue', $event.target.value)" />
            </div>
          </div>
        </GlassmorphismContainer>
      </PopoverPanel>
    </Float>
  </Popover>
</template>
<script>
//@ts-check
import { CalendarDaysIcon } from '@heroicons/vue/24/solid';
import VueTailwindDatepicker from 'vue-tailwind-datepicker';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import { Float } from '@headlessui-float/vue';
import GlassmorphismContainer from './GlassmorphismContainer.vue';

export default {
  name: 'JovieDatePicker',
  components: {
    CalendarDaysIcon,
    VueTailwindDatepicker,
    Popover,
    PopoverButton,
    PopoverPanel,
    Float,
    GlassmorphismContainer,
  },
  props: {
    modelValue: {},
  },
  data() {
    return {
      date: [],
    };
  },
  watch: {
    // date: function (val) {
    //     this.$emit('change', val);
    // },
  },
  mounted() {
    if (this.modelValue) {
      this.date = [this.modelValue];
    }
  },
};
</script>
