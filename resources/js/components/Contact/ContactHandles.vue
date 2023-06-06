<template>
  <div>
    <!--sse-->
    <div class="relative mt-1 rounded-md shadow-sm">
      <div
        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <ChevronDownIcon class="h-5 w-5 text-slate-700" />
      </div>
      <input
        type="email"
        name="email"
        id="email"
        class="block w-full rounded-md border-slate-300 pl-10 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-sm"
        :placeholder="placeholder" />
    </div>
    <!--/sse-->
  </div>
</template>

<script>
import { EnvelopeIcon, ChevronDownIcon } from '@heroicons/vue/24/solid';
import { FacebookIcon, TwitterIcon } from 'vue-simple-icons';

export default {
  components: {
    EnvelopeIcon,
    TwitterIcon,
    FacebookIcon,
    ChevronDownIcon,
  },
  props: {
    icon: {
      type: String,
      default: 'EnvelopeIcon',
    },
    placeholder: {
      type: String,
      default: '',
    },
  },
};
</script>
