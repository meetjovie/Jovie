<template>
 <div class="relative">
    <div class="absolute inset-0 flex items-center" aria-hidden="true">
      <div class="w-full border-t border-gray-300" />
    </div>
    <div class="relative flex justify-start">
      <span class="pr-2 bg-white text-xs text-gray-500"> {{label}}</span>
    </div>
  </div>
<div class="grid grid-cols-2">
    <InputGroup  :icon="minicon" :placeholder="mintext" />
    <InputGroup :icon="maxicon" :placeholder="maxtext" />
    </div>
    <div class="flex items-center justify-between">
        <span class="flex relative mx-auto text-center z-0 w-full inline-flex">
            <button type="button"
                    class="relative inline-flex items-center px-2 justify-center w-full text-center py-.05 first:rounded-bl-md last:rounded-br-md border border-neutral-300 font-medium bg-indigo-500 text-xs font-medium text-neutral-50 hover:bg-indigo-600 focus-visible:z-10 active:bg-indigo-700 active:text-neutral-100 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500">
                {{preset1}}
            </button>
            <button type="button"
                    class="relative inline-flex items-center px-2 justify-center w-full text-center py-.05 first:rounded-bl-md last:rounded-br-md border border-neutral-300 font-medium bg-indigo-500 text-xs font-medium text-neutral-50 hover:bg-indigo-600 focus-visible:z-10 active:bg-indigo-700 active:text-neutral-100 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500">
                {{preset2}}
            </button>
            <button type="button"
                    class="relative inline-flex items-center px-2 justify-center w-full text-center py-.05 first:rounded-bl-md last:rounded-br-md border border-neutral-300 font-medium bg-indigo-500 text-xs font-medium text-neutral-50 hover:bg-indigo-600 focus-visible:z-10 active:bg-indigo-700 active:text-neutral-100 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500">
                {{preset3}}
            </button>
        </span>
    </div>
</template>
<script>
import InputGroup from './InputGroup.vue'

export default {
    name: 'RangeFilter',
    props: {
        mintext: {
            type: String,
            default: 'Min'
        },
        maxtext: {
            type: String,
            default: 'Max'
        },
        minicon: {
            type: String,
            default: null
        },
        maxicon: {
            type: String,
            default: null
        },
        label: {
            type: String,
            default: 'Filter'
        },
        preset1: {
            type: Array,
            default: 'Preset 1'
        },
        preset2: {
            type: Array,
            default: 'Preset 2'
        },
        preset3: {
            type: Array,
            default: 'Preset 3'
        },
    },
    components: {
        InputGroup,
    },
}
</script>