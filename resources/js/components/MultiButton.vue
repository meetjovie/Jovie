<template>
  <div  class="relative z-0 inline-flex shadow-sm rounded-md max-w-full">
    <button v-for="button in buttons" :key="button.name" type="button" class="group max-w-28 justify-between truncate relative inline-flex items-center px-2 py-1 first:rounded-l-md last:rounded-r-md border border-gray-300 bg-white hover:bg-indigo-700 hover:text-white active:text-white active:bg-indigo-700 text-xs font-medium text-gray-700 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500">
    <component :is="button.icon" class="h-3 w-3 mr-1"></component>
     <span class="line-clamp-1 max-w-8">{{button.name}}</span>
     <span class="ml-1 max-w-12 bg-indigo-200 text-indigo-700 group-hover:bg-indigo-700 group-hover:text-white rounded-lg px-1">{{button.value}}</span>
    </button>
    
  </div>
</template>
<script>
import { CakeIcon, SearchIcon } from '@heroicons/vue/solid'

export default {
    props: {
        buttons: {
            type: Array,
            required: true,
        },
    },
    components: {
        CakeIcon,
        SearchIcon

    },
}
</script>

