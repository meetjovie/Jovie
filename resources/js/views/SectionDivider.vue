<template>
  <div class="relative">
    <div class="absolute inset-0 flex items-center" aria-hidden="true">
      <div class="w-full border-t border-gray-300" />
    </div>
    <div v-if="text" class="relative flex justify-center">
      <span class="bg-white px-2 text-sm text-gray-500">{{text}}</span>
    </div>
  </div>
</template>
<script>
export default {
    props: {
        text: {
            type: String,
            required: false,
        },
    },

}
</script>