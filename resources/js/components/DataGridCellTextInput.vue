<template>
  <div class="h-full w-full">
    <input
      :value="value"
      @update:value="updateValue"
      @blur="updateValue"
      @keyup.enter="selectNextCreator"
      autocomplete="off"
      type="creator-email"
      name="creator-email"
      id="creator-email"
      class="block h-full w-full rounded-md bg-white/0 px-2 placeholder-slate-300 focus:outline-none dark:bg-jovieDark-900/0 dark:placeholder-slate-500 sm:text-xs"
      placeholder="someone@gmail.com"
      aria-describedby="email-description" />
  </div>
</template>

<script>
export default {
  name: 'DataGridCellTextInput',
  props: {
    value: {
      type: String,
      required: true,
    },
  },
  methods: {
    updateValue(newValue) {
      this.$emit('update:value', newValue);
    },
    selectNextCreator() {
      this.$emit('select-next-creator');
    },
  },
};
</script>
