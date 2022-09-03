<template>
  <div
    class="flex w-full overflow-x-scroll rounded-md border-2 border-neutral-200 bg-gray-50 px-2 py-1">
    <div v-for="item in lists" class="flex">
      <div
        class="mr-1 flex items-center justify-between rounded bg-gray-100 px-1 text-xs font-medium text-gray-800">
        <div class="flex">
          <span class="mr-1 text-2xs">{{ item.emoji }}</span>
          <span class="text-2xs line-clamp-1">{{ item.name }}</span>
        </div>
        <XMarkIcon
          class="h-3 w-3 cursor-pointer text-gray-400 hover:text-gray-500"></XMarkIcon>
      </div>
    </div>
  </div>
</template>
<script>
import { XMarkIcon } from '@heroicons/vue/24/solid';
export default {
  components: {
    XMarkIcon,
  },
  data() {
    return {
      lists: [],
    };
  },
  props: {
    lists: {
      type: Array,
      default: [
        { name: 'item 1', emoji: '😍', id: 1, count: 34, index: 4 },
        { name: 'item 2', emoji: '🎥', id: 2, count: 39, index: 2 },
        {
          name: 'item 3 with a crazy long name that might cause problems better feal with that',
          emoji: '👍',
          id: 3,
          count: 23,
          index: 3,
        },
        { name: 'item 4', emoji: '💰', id: 4, count: 23, index: 1 },
        { name: 'item 5', emoji: '💰', id: 5, count: 23, index: 0 },
      ],
    },
  },
};
</script>
