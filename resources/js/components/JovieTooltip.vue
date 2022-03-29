<template>
  <div
    class="absolute right-32 hidden rounded-md bg-white/90 py-0.5 px-4 text-neutral-700 shadow-lg backdrop-blur-2xl backdrop-saturate-150 backdrop-filter group-hover:block">
    {{ text }}
  </div>
</template>
<script>
export default {
  props: {
    text: {
      type: String,
      required: true,
    },
  },
};
</script>
