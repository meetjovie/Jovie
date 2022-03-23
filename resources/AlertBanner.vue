<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="relative bg-indigo-600">
    <div class="mx-auto max-w-7xl py-3 px-3 sm:px-6 lg:px-8">
      <div class="pr-16 sm:px-16 sm:text-center">
        <p class="font-medium text-white">
          <span class="md:hidden"> {{ textshort }} </span>
          <span class="hidden md:inline">
            {{ text }}
          </span>
          <span class="block sm:ml-2 sm:inline-block">
            <a href="#" class="font-bold text-white underline">
              {{ cta }} <span aria-hidden="true">&rarr;</span></a
            >
          </span>
        </p>
      </div>
      <div
        class="absolute inset-y-0 right-0 flex items-start pt-1 pr-1 sm:items-start sm:pt-1 sm:pr-2">
        <button
          type="button"
          class="flex rounded-md p-2 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white">
          <span class="sr-only">Dismiss</span>
          <XIcon class="h-6 w-6 text-white" aria-hidden="true" />
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { XIcon } from '@heroicons/vue/outline';

export default {
  props: {
    cta: {
      type: String,
      required: false,
    },
    text: {
      type: String,
      required: false,
    },
    textshort: {
      type: String,
      required: false,
    },
  },
  components: {
    XIcon,
  },
};
</script>
