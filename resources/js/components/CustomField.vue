<template>
  <!--  <label v-if="name">{{ name }}</label> -->
  <template v-if="type === 'text' || type === 'number' || type === 'url'">
    <DataInputGroup
      :type="type"
      :placeholder="name"
      :label="name"
      :icon="
        type === 'url'
          ? 'LinkIcon'
          : type === 'text'
          ? 'DocumentTextIcon'
          : 'CalculatorIcon'
      "
      v-model="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      @blur="$emit('blur')" />
  </template>
  <template v-if="type === 'currency'">
    <!--        use datagrid cell for input currency design-->
    <DataInputGroup
      type="number"
      :label="name"
      currency
      :placeholder="name"
      icon="CurrencyDollarIcon"
      v-model="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      @blur="$emit('blur')" />
  </template>
  <template v-if="type === 'checkbox'">
    <template v-for="option in options">
      <label
        :for="option.id"
        class="flex cursor-text items-center justify-between px-2 py-0.5 pl-5 text-xs font-medium text-slate-400 transition-all"
        >{{ option.name }}</label
      >
      <div class="relative flex items-start">
        <div class="flex h-5 items-center">
          <input
            :id="option.id"
            :value="option.id"
            :name="option.id"
            v-model="multiOptions"
            @change="setMultiOptionsModel"
            type="checkbox"
            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
        </div>
        <div class="ml-3 text-sm">
          <label :for="option.id" class="font-medium text-gray-700">
            {{ option.value }}
          </label>
        </div>
      </div>
    </template>
  </template>
  <template v-else-if="type === 'date'">
    <label
      v-if="name"
      class="flex cursor-text items-center justify-between px-2 py-0.5 pl-5 text-xs font-medium text-slate-400 transition-all"
      >{{ name }}</label
    >
    <DataInputGroup
      type="date"
      :label="name"
      :placeholder="name"
      icon="CalendarDaysIcon"
      v-model="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      @blur="$emit('blur')"
    />
  </template>
  <template v-else-if="type === 'select' || type === 'multi_select'">
    <label
      v-if="name"
      class="flex cursor-text items-center justify-between px-2 py-0.5 pl-5 text-xs font-medium text-slate-400 transition-all"
      >{{ name }}</label
    >

    <InputLists
      nameKey="value"
      showLabel
      :currentList="options"
      @itemRemoved="itemRemoved($event)"
      @itemClicked="setMultiOptionsModel($event)"
      :lists="multiOptions"
      :options="options"
      :isSelect="true"
      searchText="Find an option..." />
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
  data() {
    return {
      multiOptions: [],
      date: {},
    };
  },
  mounted() {
    if (this.type === 'checkbox' && this.modelValue) {
      this.multiOptions = this.modelValue;
    } else if (
      (this.type === 'select' || this.type === 'multi_select') &&
      this.modelValue
    ) {
      this.multiOptions = this.options.filter((option) => {
        return this.modelValue.includes(option.id);
      });
    }
  },
  methods: {
    setMultiOptionsModel(id = null) {
      if (id) {
        // from input list
        let option = this.options.find((o) => o.id == id);
        if (this.multiOptions.filter((o) => o.id == option.id).length) {
          return;
        }
        if (this.type == 'select') {
          this.multiOptions = [option];
          this.$emit('update:modelValue', this.multiOptions[0].id);
        } else {
          this.multiOptions.push(option);
          this.$emit(
            'update:modelValue',
            this.multiOptions.map((o) => o.id)
          );
        }
      } else {
        this.$emit('update:modelValue', this.multiOptions);
      }
      this.$emit('blur');
    },
    itemRemoved(id) {
      if (this.type == 'select') {
        this.multiOptions = [];
        this.$emit('update:modelValue', null);
      } else {
        this.multiOptions = this.multiOptions.filter((o) => o.id != id);
        this.$emit(
          'update:modelValue',
          this.multiOptions.map((o) => o.id)
        );
      }
      this.$emit('blur');
    },
  },
};
</script>

<style scoped></style>
