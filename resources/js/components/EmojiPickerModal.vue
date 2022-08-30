<template>
  <Menu as="div" class="relative inline-block text-left">
    <div>
      <MenuButton
        class="flex items-center rounded-full bg-gray-100 text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100">
        <span class="sr-only">Open options</span>
        <slot><DotsVerticalIcon class="h-5 w-5" aria-hidden="true" /></slot>
      </MenuButton>
    </div>

    <transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95">
      <MenuItems
        class="right-18 absolute z-50 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
        <div class="py-1">
          <emoji-picker
            style="
              emoji-picker {
                width: 100%;
                height: 100%;
              }
            "
            class="light"></emoji-picker>
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>

<script>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { DotsVerticalIcon } from '@heroicons/vue/solid';
import 'emoji-picker-element';

export default {
  components: {
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    DotsVerticalIcon,
  },
  data() {
    return {
      open: '',
    };
  },
  props: {
    open: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    emoji() {
      document
        .querySelector('emoji-picker')
        .addEventListener('emoji-click', (event) => console.log(event.detail));
    },
  },
};
</script>
