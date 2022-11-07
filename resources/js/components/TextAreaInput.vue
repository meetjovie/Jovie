<template>
  <form action="#">
    <label for="comment" class="sr-only">Note</label>
    <div>
      <textarea
        rows="5"
        v-model="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        @blur="$emit('blur')"
        name="comment"
        id="comment"
        class="block w-full rounded-md border-gray-300 text-neutral-700 shadow-sm placeholder:text-neutral-500 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-sm"
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
};
</script>
