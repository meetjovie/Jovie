<template>
    <label v-if="name">{{ name }}</label>
    <template v-if="type == 'text'">
        <input type="text" v-model="modelValue" @change="$emit('updateModelValue', $event.target.value)">
    </template>
    <template v-if="type == 'select' || type == 'multi_select'">
        <select @change="$emit('updateModelValue', $event.target.value)" :multiple="type == 'multi_select'">
            <option v-for="option in options" :value="option.id">{{ option.value }}</option>
        </select>
    </template>
</template>

<script>
export default {
    name: "CustomField",
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
