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
            :value="option.id"
            @change="$emit('updateModelValue', $event.target.value)"
            type="checkbox"
            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
        </div>
        <div class="ml-3 text-sm">
          <label for="comments" class="font-medium text-gray-700">
            {{ option.value }}
          </label>
        </div>
      </div>
    </template>
  </template>
  <template v-else-if="type === 'date'">
      <label
          v-if="name"
          class="peer-focus:text-[8px]] absolute -top-2.5 left-0 ml-2 block cursor-text rounded-t-md border-t border-transparent bg-white px-1 pl-5 text-xs font-medium text-slate-400 transition-all group-hover:bg-slate-50 group-hover:text-slate-500 peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-slate-400 peer-focus:left-0 peer-focus:-top-2 peer-focus:font-medium dark:bg-jovieDark-900 dark:text-jovieDark-200 dark:hover:bg-jovieDark-800 group-hover:dark:border-jovieDark-border dark:group-hover:bg-jovieDark-800 dark:group-hover:text-slate-200 dark:peer-placeholder-shown:text-slate-200"
      >{{ name }}</label
      >
    <vue-tailwind-datepicker
      class="isolate z-40"
      v-model="modelValue"
      @change="$emit('updateModelValue', $event.target.value)" />
  </template>
  <template v-else-if="type === 'select' || type === 'multi_select'">
      <label
          v-if="name"
          class="peer-focus:text-[8px]] absolute -top-2.5 left-0 ml-2 block cursor-text rounded-t-md border-t border-transparent bg-white px-1 pl-5 text-xs font-medium text-slate-400 transition-all group-hover:bg-slate-50 group-hover:text-slate-500 peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-slate-400 peer-focus:left-0 peer-focus:-top-2 peer-focus:font-medium dark:bg-jovieDark-900 dark:text-jovieDark-200 dark:hover:bg-jovieDark-800 group-hover:dark:border-jovieDark-border dark:group-hover:bg-jovieDark-800 dark:group-hover:text-slate-200 dark:peer-placeholder-shown:text-slate-200"
      >{{ name }}</label
      >
    <InputLists
        nameKey="value"
      :currentList="options"
      @update="$emit('updateModelValue', $event.target.value)"
      :lists="options"
      :options="options"
        :isSelect="true"
    />
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
