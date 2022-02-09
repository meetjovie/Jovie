<template>
    <div>
        <label v-if="label" :for="name" class="block text-sm font-medium text-gray-700">{{ label }}</label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <div v-if="icon" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <component :is="icon" class="h-5 w-5 text-gray-400" />
            </div>
            <input :type="type" :name="name" :id="name" :disabled="disabled" :value="modelValue ?? value" @input="$emit('update:modelValue', $event.target.value)"
                   class="focus-visible:ring-indigo-500 focus-visible:border-indigo-500 block w-full text-neutral-700 py-2 text-sm border-gray-300 rounded-md"
                   :class="[icon ? 'pl-10' : '']"
                   :placeholder="placeholder"/>
            <p v-if="error" class="text-sm text-red-600 mt-2">{{ error }}</p>
        </div>
    </div>
</template>

<script>
import { SearchIcon, MailIcon, PhotographIcon, LocationMarkerIcon, TrendingUpIcon, TrendingDownIcon, TagIcon, UserIcon, UsersIcon, ArrowSmUpIcon, ArrowSmDownIcon, BriefcaseIcon } from '@heroicons/vue/solid'

export default {
    name: 'InputGroup',
    props: {
        label: {
            type: String
        },
        name: String,
        type: {
            type: String,
            default: 'text'
        },
        placeholder: String,
        disabled: Boolean,
        icon: String,
        value: String,
        modelValue: {},
        error: String,
        rounded: String,
    },
    components: {
        MailIcon,
        SearchIcon,
        PhotographIcon,
        LocationMarkerIcon,
        TrendingUpIcon,
        TrendingDownIcon,
        TagIcon,
        UserIcon,
        UsersIcon,
        ArrowSmUpIcon,
        ArrowSmDownIcon,
        BriefcaseIcon
    }
}
</script>
