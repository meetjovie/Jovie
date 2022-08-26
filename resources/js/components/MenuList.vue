<template>
  <div>
    <div
      @click="toggleShowMenu()"
      class="group flex cursor-pointer items-center justify-between rounded-md py-1 px-2 hover:bg-neutral-200">
      <div
        class="cursor-pointer text-sm font-bold text-neutral-400 group-hover:text-neutral-500">
        {{ menuName }}
      </div>
      <div>
        <ChevronDownIcon
          v-if="showMenu"
          class="h-5 w-5 text-gray-400 group-hover:text-neutral-500" />
        <ChevronRightIcon
          v-else
          class="h-5 w-5 text-gray-400 group-hover:text-neutral-500" />
      </div>
    </div>
    <ul v-if="showMenu" class="pl-2">
      <div v-for="item in menuItems">
        <li
          class="group cursor-pointer rounded-md px-2 line-clamp-1 hover:bg-neutral-200">
          <span class="mr-4 text-xs">{{ item.emoji || '😆' }}</span>
          <span
            class="text-xs font-semibold text-neutral-400 group-hover:text-neutral-500"
            >{{ item.name }}</span
          >
        </li>
      </div>
    </ul>
  </div>
</template>
<script>
import { ChevronRightIcon, ChevronDownIcon } from '@heroicons/vue/solid';

export default {
  data() {
    return {
      showMenu: false,
    };
  },
  methods: {
    toggleShowMenu() {
      this.showMenu = !this.showMenu;
    },
  },
  components: {
    ChevronRightIcon,
    ChevronDownIcon,
  },
  props: {
    menuName: {
      type: String,
      default: 'MenuName',
    },
    menuItems: {
      type: Array,
      default: [
        { name: 'item 1', emoji: '😍' },
        { name: 'item 2', emoji: '🎥' },
        { name: 'item 3', emoji: '👍' },
      ],
    },
  },
};
</script>
