<template>
  <button type="button" :disabled="disabled" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-base font-medium first:rounded-l-md last:rounded-r-md only:rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500">
    <component :is="icon" class="absolute -ml-1 mr-3 h-5 w-5" aria-hidden="true" />
   <p v-if="text" class="text-sm text-center mx-auto text-white">{{ text }}</p>
  </button>
 
</template>

<script>
import { MailIcon, SearchIcon, BanIcon } from '@heroicons/vue/solid'


export default {
    props: {
        text: {
            type: String,
            required: true,
        },
        icon: {
            type: String,
            default: null,
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
  components: {
    MailIcon,
    SearchIcon,
    BanIcon

  },
}
</script>
