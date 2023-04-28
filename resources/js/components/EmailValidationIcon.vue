<template>
  <Popover v-slot="{ open }" class="relative">
    <Float placement="right-start" shift portal>
      <PopoverButton
        class="cursor-pointer"
        tabindex="-1"
        @mouseover="open = true">
        <JovieSpinner
          v-if="validatingEmail && !passesValidation && !errorMessage"
          tabindex="-1"
          class="h-5 w-5 text-slate-500" />
        <CheckCircleIcon
          v-if="passesValidation"
          class="h-5 w-5 text-slate-500 dark:text-jovieDark-300"
          tooltip="Appears to be valid"
          aria-hidden="true" />
        <ExclamationCircleIcon
          v-if="errorMessage"
          tooltip="Email may be invalid"
          class="h-5 w-5 text-red-600 dark:text-red-400"
          aria-hidden="true" />
      </PopoverButton>
      <TransitionRoot
        :show="open"
        enter="transition ease-out duration-100"
        enter-from="transform opacity-0 scale-95"
        enter-to="transform opacity-100 scale-100"
        leave="transition ease-in duration-75"
        leave-from="transform opacity-100 scale-100">
        <PopoverPanel static class="">
          <GlassmorphismContainer>
            <ul class="py-4">
              <li>Basic Check</li>
              <li>DNS Check</li>
              <li v-if="passedValidationMethod.includes('full')">
                <CheckCircleIcon
                  class="mr-2 h-5 w-5 text-slate-500 dark:text-jovieDark-300"
                  aria-hidden="true" />
                Full Validation
              </li>
            </ul>
          </GlassmorphismContainer>
        </PopoverPanel>
      </TransitionRoot>
    </Float>
  </Popover>
</template>

<script>
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  TransitionRoot,
} from '@headlessui/vue';
import { Float } from '@headlessui-float/vue';
import JovieSpinner from '../components/JovieSpinner.vue';
import {
  ExclamationCircleIcon,
  CheckCircleIcon,
} from '@heroicons/vue/24/solid';
import GlassmorphismContainer from './GlassmorphismContainer.vue';

export default {
  components: {
    JovieSpinner,
    Float,
    Popover,
    PopoverButton,
    PopoverPanel,
    ExclamationCircleIcon,
    CheckCircleIcon,
    TransitionRoot,
    GlassmorphismContainer,
  },
  data() {
    return {
      passedValidationMethods: [],
      open: true,
    };
  },
  props: ['validatingEmail', 'passesValidation', 'errorMessage'],
};
</script>
