<template>
  <!--  <label v-if="name">{{ name }}</label> -->
  <template v-if="type === 'text' || type === 'number' || type === 'url'">
    <DataInputGroup
      :type="type"
      :placeholder="name"
      :label="name"
      v-model="modelValue"
      @change="$emit('updateModelValue', $event.target.value)" />
  </template>
  <template v-if="type === 'currency'">
    <!--        use datagrid cell for input currency design-->
    <DataInputGroup
      type="number"
      label="$"
      placeholder="$"
      v-model="modelValue"
      @change="$emit('updateModelValue', $event.target.value)" />
  </template>
  <template v-if="type === 'checkbox'">
    <template v-for="option in options">
      <!--  <label :for="option.id">{{ option.name }}</label> -->
      <div class="relative flex items-start">
        <div class="flex h-5 items-center">
          <input
            :id="option.id"
            :label="option.name"
            :value="option.id"
            :name="name"
            @change="$emit('updateModelValue', $event.target.value)"
            type="checkbox"
            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
        </div>
        <div class="ml-3 text-sm">
          <label for="comments" class="font-medium text-gray-700">
            {{ option.name }}
          </label>
        </div>
      </div>
    </template>
  </template>
  <template v-else-if="type === 'date'">
    <vue-tailwind-datepicker
      class="isolate z-40"
      v-model="modelValue"
      @change="$emit('updateModelValue', $event.target.value)" />
  </template>
  <template v-else-if="type === 'select' || type === 'multi_select'">
    <InputLists
      :currentList="options"
      @update="$emit('updateModelValue', $event.target.value)"
      :lists="options" />
    <!--  <select
      @change="$emit('updateModelValue', $event.target.value)"
      :multiple="type === 'multi_select'">
      <option v-for="option in options" :value="option.id">
        {{ option.value }}
      </option>
    </select> -->
  </template>
</template>

<script>
import VueTailwindDatepicker from 'vue-tailwind-datepicker';
import DataInputGroup from './DataInputGroup.vue';
import InputLists from './InputLists.vue';

export default {
  name: 'CustomField',
  components: {
    VueTailwindDatepicker,
    DataInputGroup,
    InputLists,
  },
  props: {
    name: {
      type: String,
    },
    description: {
      type: String,
    },
    type: {
      type: String,
      default: 'text',
    },
    options: {
      type: Object,
      default: null,
    },
    modelValue: {},
  },
};
</script>

<style scoped></style>
