<template>
    <div class="px-4 py-5 border-b border-gray-200 rounded-t-lg sm:px-6">
        <div class="-ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
            <div class="ml-4 mt-4">
                <h3 v-if="title" class="text-lg leading-6 font-medium text-gray-900">{{ title }}</h3>
                <p v-if="subtitle" class="mt-1 text-sm text-gray-500">{{ subtitle }}</p>
            </div>    
            <div class="ml-4 mt-4 flex-shrink-0">
                <slot></slot>
            </div>
        </div>
    </div>
</template>
<script>
import ButtonGroup from "./ButtonGroup.vue";

export default {

    name: 'CardHeading',
    components: {
        ButtonGroup,
    },
    props: {
        title: {
            type: String,
            default: null,
        },
        subtitle: {
            type: String,
            default: null,
        },
        buttontext: {
            type: String,
            default: null,
        },
    },
}
</script>

