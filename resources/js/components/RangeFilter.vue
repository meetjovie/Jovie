<template>
<div class="grid grid-cols-2">
    <InputGroup placeholder="Min ER%" />
    <InputGroup placeholder="Max ER%" />
    </div>
    <div class="flex items-center justify-between">
        <span class="flex relative mx-auto text-center z-0 w-full inline-flex">
            <button v-for="preset in presets" :key="preset.value" type="button"
                    class="relative inline-flex items-center px-6 w-full text-center py-1 first:rounded-bl-md last:rounded-br-md border border-neutral-300 font-medium bg-indigo-500 text-xs font-medium text-neutral-50 hover:bg-indigo-600 focus-visible:z-10 active:bg-indigo-700 active:text-neutral-100 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500">
                {{preset.minvalue}}%
            </button>
        </span>
    </div>
</template>
<script>
import InputGroup from './InputGroup.vue'

export default {
    components: {
        InputGroup,
    },
    data() {
        return {
            presets: [
                {
                    minvalue: '1',
                },
                {
                    minvalue: '2',
                },
                {
                    minvalue: '5',
                },
            ],
        }
    },
}
</script>