<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div
    class="relative"
    :class="[
      { 'bg-indigo-500': design == 'primary' },
      { 'bg-red-500': design == 'danger' },
    ]">
    <div class="mx-auto max-w-7xl py-3 px-3 sm:px-6 lg:px-8">
      <div class="pr-16 sm:px-16 sm:text-center">
        <p class="text-sm font-medium text-white">
          <span class="md:hidden"> {{ mobiletitle }} </span>
          <span class="hidden md:inline">
            {{ title }}
          </span>
          <span class="block sm:ml-2 sm:inline-block">
            <a :href="ctalink" class="font-bold text-white underline">
              {{ cta }}<span aria-hidden="true">&rarr;</span></a
            >
          </span>
        </p>
      </div>
      <div
        class="absolute inset-y-0 right-0 flex items-start pt-1 pr-1 sm:items-start sm:pt-1 sm:pr-2">
        <button
          type="button"
          class="group flex rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-white">
          <span class="sr-only">Dismiss</span>
          <XIcon
            class="h-6 w-6 text-neutral-100 group-hover:text-white"
            aria-hidden="true" />
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { XIcon } from '@heroicons/vue/outline';

export default {
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
  },
  components: {
    XIcon,
  },
};
</script>
