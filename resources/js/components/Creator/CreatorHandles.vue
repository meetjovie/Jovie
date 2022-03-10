<template>
  <div>
    <div class="relative mt-1 rounded-md shadow-sm">
      <div
        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <ChevronDownIcon class="h-5 w-5 text-gray-700" />
      </div>
      <input
        type="email"
        name="email"
        id="email"
        class="block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        :placeholder="placeholder" />
    </div>
  </div>
</template>

<script>
import { MailIcon, ChevronDownIcon } from '@heroicons/vue/solid';
import { FacebookIcon, TwitterIcon } from 'vue-simple-icons';

export default {
  components: {
    MailIcon,
    TwitterIcon,
    FacebookIcon,
    ChevronDownIcon,
  },
  props: {
    icon: {
      type: String,
      default: 'MailIcon',
    },
    placeholder: {
      type: String,
      default: '',
    },
  },
};
</script>
