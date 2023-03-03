<template>
  <form action="#">
    <label for="comment" class="sr-only">Note</label>
    <div>
      <textarea
        rows="5"
        v-model="textAreaModel"
        @input="$emit('update:modelValue', $event.target.value)"
        @blur="$emit('blur')"
        name="comment"
        id="comment"
        class="block w-full rounded-md border-slate-300 text-slate-700 shadow-sm placeholder:text-slate-500 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 dark:border-jovieDark-border dark:bg-jovieDark-800 dark:text-jovieDark-300 sm:text-sm"
        placeholder="Add a note..." />
    </div>
  </form>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: String,
    },
  },
    computed: {
        textAreaModel: {
            get() {
                return this.modelValue;
            },
            set(val) {
                this.$emit('update:modelValue', val);
            },
        },
    }
};
</script>
