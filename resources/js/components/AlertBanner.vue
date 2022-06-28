<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div
    v-if="!dismissed"
    class="relative"
    :class="[
      { 'bg-indigo-500': design == 'primary' },
      { 'bg-red-500 ': design == 'danger' },
    ]">
    <div class="mx-auto max-w-7xl py-3 px-3 text-center sm:px-6 lg:px-8">
      <div class="inline-flex pr-16 sm:px-16 sm:text-center">
        <p class="text-sm font-medium text-white">
          <span class="md:hidden"> {{ mobiletitle }} </span>
          <span class="hidden md:inline">
            {{ title }}
          </span>
          <span v-if="cta" class="block sm:ml-2 sm:inline-block">
            <a
              :href="ctalink"
              class="cursor-pointer font-bold text-white underline">
              {{ cta }}<span aria-hidden="true">&rarr;</span></a
            >
          </span>
        </p>
        <slot></slot>
      </div>

      <div
        v-if="dismissable"
        class="absolute inset-y-0 right-0 flex items-start pt-1 pr-1 sm:items-start sm:pt-1 sm:pr-2">
        <button
          @click="dismissed = true"
          type="button"
          class="group flex rounded-md p-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white">
          <span class="sr-only">Dismiss</span>
          <XIcon
            class="active:text-neutal-100 h-6 w-6 rounded-full p-1 font-medium text-neutral-50 transition duration-300 ease-in-out active:bg-neutral-100/30 active:text-neutral-400 group-hover:font-bold group-hover:text-white"
            aria-hidden="true" />
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { XIcon } from '@heroicons/vue/outline';

export default {
  data() {
    return {
      dismissed: false,
    };
  },
  props: {
    design: {
      type: String,
      default: 'primary',
    },
    title: {
      type: String,
      default: '',
    },
    mobiletitle: {
      type: String,
      default: '',
    },
    cta: {
      type: String,
      default: '',
    },
    ctaLink: {
      type: String,
      default: '',
    },
    dismissable: {
      type: Boolean,
      default: true,
    },
    dismissed: {
      type: Boolean,
      default: false,
    },
  },
  components: {
    XIcon,
  },
};
</script>
