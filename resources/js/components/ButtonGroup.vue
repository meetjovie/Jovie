<template>
  <button
    type="button"
    :disabled="disabled"
    class="inline-flex items-center border border-transparent bg-indigo-500 px-4 py-2 text-sm font-medium text-white shadow-sm first:rounded-l-md last:rounded-r-md only-of-type:rounded-md hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
    :class="{ 'py-0 text-2xs': size == 'xs' }">
    <component
      :is="icon"
      class="absolute -ml-1 mr-3 h-5 w-5"
      aria-hidden="true" />
    <p
      v-if="text"
      class="mx-auto text-center text-sm text-white"
      :class="{ 'text-2xs': size == 'xs' }">
      {{ text }}
    </p>
  </button>
</template>

<script>
import { MailIcon, SearchIcon, BanIcon } from '@heroicons/vue/solid';

export default {
  props: {
    text: {
      type: String,
      required: true,
    },
    icon: {
      type: String,
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    size: {
      type: String,
      default: 'md',
    },
  },
  components: {
    MailIcon,
    SearchIcon,
    BanIcon,
  },
};
</script>
