<template>
    <label v-if="name">{{ name }}</label>
    <template v-if="type === 'text' || type === 'number' || type === 'url'">
        <input :type="type" v-model="modelValue" @change="$emit('updateModelValue', $event.target.value)">
    </template>
    <template v-if="type === 'currency'">
<!--        use datagrid cell for input currency design-->
        <input type="number" v-model="modelValue" @change="$emit('updateModelValue', $event.target.value)">
    </template>
    <template v-if="type === 'checkbox'">
        <template v-for="option in options">
            <label :for="option.id">{{ option.name }}</label>
            <input :id="option.id" type="checkbox" :value="option.id" :name="name" @change="$emit('updateModelValue', $event.target.value)">
        </template>
    </template>
    <template v-else-if="type === 'date'">
        <vue-tailwind-datepicker
            v-model="modelValue" @change="$emit('updateModelValue', $event.target.value)" />
    </template>
    <template v-else-if="type === 'select' || type === 'multi_select'">
        <select @change="$emit('updateModelValue', $event.target.value)" :multiple="type === 'multi_select'">
            <option v-for="option in options" :value="option.id">{{ option.value }}</option>
        </select>
    </template>
</template>

<script>

import VueTailwindDatepicker from 'vue-tailwind-datepicker';

export default {
    name: "CustomField",
    components: {
        VueTailwindDatepicker
    },
    props: {
        name: {
            type: String,
        },
        description: {
            type: String
        },
        type: {
            type: String,
            default: 'text'
        },
        options: {
            type: Object,
            default: null
        },
        modelValue: {}
    }
}
</script>

<style scoped>

</style>
