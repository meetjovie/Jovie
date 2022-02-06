<template>
    <div>
        <label v-if="label" :for="name" class="block text-sm font-medium text-gray-700">{{ label }}</label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <div v-if="icon" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <MailIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
            </div>
            <input :type="type" :name="name" :id="name" :disabled="disabled" :value="modelValue ?? value" @input="$emit('update:modelValue', $event.target.value)"
                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                   :class="[icon ? 'pl-10' : '']"
                   :placeholder="placeholder"/>
            <p v-if="error" class="text-sm text-red-600 mt-2">{{ error }}</p>
        </div>
    </div>
</template>

<script>
import { MailIcon } from '@heroicons/vue/solid'

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
        error: String
    },
    components: {
        MailIcon
    }
}
</script>
