<template>
  <div
    class="sticky top-0 z-10 flex items-center justify-between bg-slate-100 py-4 dark:bg-jovieDark-900">
    <div class="items-center text-sm text-slate-600 dark:text-jovieDark-100">
      <ColorDot class="mr-2" :styleColor="list.color" />
      {{ list.name }}
    </div>
    <div class="flex">
      <div class="font-medium text-slate-500 dark:text-jovieDark-200">
        <div
          class="cursor-pointer rounded p-1 hover:bg-slate-200 dark:hover:bg-jovieDark-700">
          <PlusIcon class="h-4 w-4 rounded text-slate-500" />
        </div>
      </div>
      <div class="font-medium text-slate-500 dark:text-jovieDark-200">
        <div
          class="cursor-pointer rounded p-1 hover:bg-slate-200 dark:hover:bg-jovieDark-700">
          <EllipsisHorizontalIcon class="h-4 w-4 rounded text-slate-500" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ColorDot from './ColorDot.vue';
import { PlusIcon, EllipsisHorizontalIcon } from '@heroicons/vue/24/solid';

export default {
  name: 'ListHeader',
  props: {
    list: {
      type: Object,
      required: true,
    },
  },
  components: {
    ColorDot,
    PlusIcon,
    EllipsisHorizontalIcon,
  },
};
</script>
