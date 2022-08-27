<template>
  <div>
    <div
      @click="toggleShowMenu()"
      class="group flex cursor-pointer items-center justify-between rounded-md py-1 hover:bg-neutral-200">
      <div
        class="flex cursor-pointer items-center text-sm font-bold text-neutral-400 group-hover:text-neutral-500">
        <ChevronDownIcon
          v-if="showMenu"
          class="mt-0.5 h-4 w-4 text-gray-400 group-hover:text-neutral-500" />
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
    <ul v-if="showMenu" class="">
      <div v-for="item in menuItems" :key="item.id">
        <div
          class="inline-flex w-full items-center justify-between rounded-md transition-all hover:bg-neutral-200">
          <div
            class="group w-4 flex-none cursor-grab items-center hover:bg-neutral-200">
            <MenuIcon
              class="h-4 w-4 text-gray-400/0 group-hover:text-gray-400"></MenuIcon>
          </div>

          <div class="flex w-full">
            <div
              class="cursor-pointer rounded-md p-1 text-xs hover:bg-gray-400">
              {{ item.emoji || '😆' }}
            </div>
            <div>
              <span
                v-if="!item.editName"
                @dblclick="enableEditName(item)"
                class="text-xs font-semibold text-neutral-400 line-clamp-1 group-hover:text-neutral-500"
                >{{ item.name }}</span
              >
              <input
                v-model="item.name"
                @blur="disableEditName(item)"
                @keyup.enter="disableEditName(item)"
                v-else
                class="text-xs font-semibold text-neutral-400 group-hover:text-neutral-500" />
            </div>
          </div>
          <div
            class="w-6 flex-none cursor-pointer rounded-md p-1 hover:bg-gray-300 hover:text-gray-50">
            <span
              class="text-xs font-semibold text-neutral-400 group-hover:hidden group-hover:text-neutral-500"
              >{{ item.count }}</span
            >
            <DotsVerticalIcon
              class="hidden h-4 w-4 text-gray-400 hover:text-gray-50 group-hover:block"></DotsVerticalIcon>
          </div>
        </div>
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
  DotsVerticalIcon,
} from '@heroicons/vue/solid';

export default {
  data() {
    return {
      showMenu: true,
      editName: false,
    };
  },
  methods: {
    toggleShowMenu() {
      this.showMenu = !this.showMenu;
    },
    enableEditName(item) {
      item.editName = true;
    },
    disableEditName(item) {
      item.editName = false;
    },
  },
  components: {
    ChevronRightIcon,
    ChevronDownIcon,
    DotsVerticalIcon,
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
        { name: 'item 1', emoji: '😍', id: 1, count: 34 },
        { name: 'item 2', emoji: '🎥', id: 2, count: 39 },
        { name: 'item 3', emoji: '👍', id: 3, count: 23 },
      ],
    },
  },
};
</script>
