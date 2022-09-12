<template>
  <form action="#">
    <label for="comment" class="sr-only">Comment</label>
    <div>
      <textarea rows="5"
                v-model="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                @blur="$emit('blur')"
                name="comment" id="comment" class="shadow-sm text-neutral-400 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Add a note..." />
    </div>
  </form>
</template>

<script>
export default {
    props: {
        modelValue: {
            type: String
        }
    }
};
</script>
