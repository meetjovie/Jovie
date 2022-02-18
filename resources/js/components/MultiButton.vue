<template>
  <div class="relative z-0 inline-flex max-w-full rounded-md shadow-sm">
    <button
      v-for="button in buttons"
      :key="button.name"
      type="button"
      class="group max-w-28 relative inline-flex items-center justify-between truncate border border-gray-300 bg-white px-2 text-xs font-medium text-gray-700 first:rounded-l-md last:rounded-r-md hover:bg-indigo-700 hover:text-white focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:text-white"
      :class="{
        'bg-red-500 py-0.5': xs,
        'py-1': button.size == 'md',
      }">
      <component :is="button.icon" class="mr-1 h-3 w-3"></component>
      <span class="max-w-8 line-clamp-1">{{ button.name }}</span>
      <span
        class="max-w-12 ml-1 rounded-lg bg-indigo-200 px-1 text-indigo-700 group-hover:bg-indigo-700 group-hover:text-white"
        >{{ button.value }}</span
      >
    </button>
  </div>
</template>
<script>
import { CakeIcon, SearchIcon } from '@heroicons/vue/solid';

export default {
  props: {
    buttons: {
      type: Object,
      required: true,
    },
    xs: {
      type: Boolean,
      default: false,
    },
  },
  components: {
    CakeIcon,
    SearchIcon,
  },
};
</script>
