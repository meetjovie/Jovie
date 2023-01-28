<template>
  <!--  <label v-if="name">{{ name }}</label> -->
  <template v-if="type === 'text' || type === 'number' || type === 'url'">
    <DataInputGroup
      :type="type"
      :placeholder="name"
      :label="name"
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
      <!--  <label :for="option.id">{{ option.name }}</label> -->
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
      class="peer-focus:text-[8px]] absolute -top-2.5 left-0 ml-2 block cursor-text rounded-t-md border-t border-transparent bg-white px-1 pl-5 text-xs font-medium text-slate-400 transition-all group-hover:bg-slate-50 group-hover:text-slate-500 peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-slate-400 peer-focus:left-0 peer-focus:-top-2 peer-focus:font-medium dark:bg-jovieDark-900 dark:text-jovieDark-200 dark:hover:bg-jovieDark-800 group-hover:dark:border-jovieDark-border dark:group-hover:bg-jovieDark-800 dark:group-hover:text-slate-200 dark:peer-placeholder-shown:text-slate-200"
      >{{ name }}</label
    >
    <vue-tailwind-datepicker class="isolate z-40" v-model="date" />
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
  watch: {
    date: function (val) {
      if (val.startDate) {
        this.$emit('update:modelValue', val.startDate);
        this.$emit('blur');
      }
    },
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
    } else if (this.type === 'date') {
      this.date.startDate = this.modelValue;
      this.date.endDate = this.modelValue;
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
