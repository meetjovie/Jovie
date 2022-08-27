<template>
  <div
    class="flex w-full overflow-x-scroll rounded-md border-2 border-neutral-200 bg-gray-50 px-4 py-2">
    <div v-for="item in lists" class="flex" :ley="lists.index">
      <div class="mr-1 flex">
        <div
          class="inline-flex items-center rounded bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-800">
          <span class="mr-2">{{ item.emoji }}</span>

          {{ item.name }}
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
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
        { name: 'item 3', emoji: '👍', id: 3, count: 23, index: 3 },
        { name: 'item 4', emoji: '💰', id: 4, count: 23, index: 1 },
        { name: 'item 5', emoji: '💰', id: 5, count: 23, index: 0 },
      ],
    },
  },
};
</script>
