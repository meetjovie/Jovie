<template>
  <Menu>
    <MenuItems static>
      <div class="flex w-full flex-col space-y-1 px-2">
        <JovieMenuItem
          v-for="item in items"
          :key="item.name"
          :path="item.path"
          :icon="item.icon"
          :name="item.name" />
      </div>
    </MenuItems>
  </Menu>
</template>
<script>
import JovieMenuItem from './JovieMenuItem.vue';
import { Menu, MenuItems } from '@headlessui/vue';
export default {
  components: {
    JovieMenuItem,
    Menu,
    MenuItems,
  },
  props: {
    items: {
      type: Array,
      required: true,
    },
  },
};
</script>
