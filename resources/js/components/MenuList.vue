<template>
  <div>
    <div
      @click="toggleShowMenu()"
      class="group flex cursor-pointer items-center justify-between rounded-md py-1 hover:bg-neutral-200">
      <div
        class="flex cursor-pointer items-center text-sm font-bold text-neutral-400 group-hover:text-neutral-500">
        <ChevronDownIcon
          v-if="showMenu"
          class="h-4 w-4 text-gray-400 group-hover:text-neutral-500" />
        <ChevronRightIcon
          v-else
          class="h-4 w-4 text-gray-400 group-hover:text-neutral-500" />
        {{ menuName }}
      </div>
      <div class="flex items-center">
        <div class="group rounded-md p-1 hover:bg-gray-500 hover:text-gray-50">
          <PlusIcon class="h-4 w-4 text-gray-400 hover:text-gray-50"></PlusIcon>
        </div>
      </div>
    </div>
    <ul v-if="showMenu" class="ml-2">
      <div v-for="item in menuItems" :key="item.id">
        <li
          class="group flex cursor-pointer justify-between rounded-md hover:bg-neutral-200">
          <div>
            <span class="mr-4 text-xs">{{ item.emoji || '😆' }}</span>
            <span
              class="text-xs font-semibold text-neutral-400 group-hover:text-neutral-500"
              >{{ item.name }}</span
            >
          </div>
          <div class="rounded-md p-1 hover:bg-gray-500 hover:text-gray-50">
            <MenuIcon
              class="h-4 w-4 text-gray-400 hover:text-gray-50"></MenuIcon>
          </div>
        </li>
      </div>
    </ul>
  </div>
</template>
<script>
import {
  ChevronRightIcon,
  ChevronDownIcon,
  PlusIcon,
  MenuIcon,
} from '@heroicons/vue/solid';

export default {
  data() {
    return {
      showMenu: true,
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
    PlusIcon,
    MenuIcon,
  },
  props: {
    menuName: {
      type: String,
      default: 'MenuName',
    },
    menuItems: {
      type: Array,
      default: [
        { name: 'item 1', emoji: '😍', id: 1 },
        { name: 'item 2', emoji: '🎥', id: 2 },
        { name: 'item 3', emoji: '👍', id: 3 },
      ],
    },
  },
};
</script>
