<template>
  <Menu>
    <MenuItems static>
      <div class="ml-2 flex w-full flex-col space-y-1 px-4">
        <JovieMenuItem
          v-for="item in items"
          :key="item.name"
          :description="item.description"
          :component="item.component"
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
