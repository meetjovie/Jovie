<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <span class="inline-flex items-center py-0.5 pl-2 mr-1 pr-0.5 rounded-md text-2xs font-medium bg-indigo-100 text-indigo-700">
     {{text}}
    <button type="button" class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus-visible:outline-none focus-visible:bg-indigo-500 focus-visible:text-white">
      <span class="sr-only">Remove  {{text}}</span>
      <XIcon class="h-3 w-3" />
    </button>
  </span>
  <span v-if="size === large" class="inline-flex rounded-full items-center py-0.5 pl-2.5 pr-1 text-sm font-medium bg-indigo-100 text-indigo-700">
   {{text}}
    <button type="button" class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus-visible:outline-none focus-visible:bg-indigo-500 focus-visible:text-white">
      <span class="sr-only">Remove {{text}}</span>
      <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
        <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
      </svg>
    </button>
  </span>
</template>
<script>
import { XIcon } from '@heroicons/vue/outline'
export default {
    components: {
        XIcon
    },
    props: {
        text: {
            type: String,
            required: true,
            default: 'Tag',
        },
        size: {
            type: String,
            default: "small",
        },
    }
}

</script>