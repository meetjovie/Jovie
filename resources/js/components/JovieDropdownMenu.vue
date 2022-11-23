<template>
  <Menu
    as="div"
    v-slot="{ open }"
    class="relative z-10 inline-block w-full items-center text-left">
    <Float portal :offset="0" shift placement="bottom-start">
      <MenuButton @click="open" ref="menuButton">
        <slot name="triggerButton"> </slot>
      </MenuButton>

      <TransitionRoot
        :show="open"
        enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-75 ease-in"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0">
        <MenuItems
          static
          @focus="focusMenuSearch()"
          as="div"
          class="z-30 mt-2 max-h-80 w-40 origin-top-right divide-y divide-gray-100 rounded-lg border border-gray-200 bg-white/60 bg-clip-padding pb-2 pt-1 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-xl backdrop-saturate-150 backdrop-filter focus-visible:outline-none">
          <div class="px-1">
            <MenuItem as="div">
              <div class="relative flex items-center">
                <input
                  ref="menuSearchInput"
                  v-model="searchQuery"
                  :placeholder="searchText"
                  class="w-full border-0 border-none border-transparent bg-transparent px-1 py-2 text-xs font-medium text-gray-600 outline-0 ring-0 placeholder:font-light placeholder:text-gray-400 focus:border-transparent focus:ring-0 focus:ring-transparent focus:ring-offset-0" />
                <!-- <div class="absolute inset-y-0 right-0 flex py-2 pr-1.5">
                  <kbd
                    class="inline-flex items-center rounded border border-gray-200 px-1 font-sans text-2xs font-medium text-gray-400"
                    >S</kbd
                  >
                </div> -->
              </div>
            </MenuItem>
          </div>

          <div class="border-t border-gray-200 px-2">
            <template v-for="(item, key) in filteredItems" :key="item">
              <MenuItem
                @click="itemClicked(item.id)"
                as="div"
                v-slot="{ active }">
                <div
                  class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-gray-600"
                  :class="{
                    'bg-gray-300 text-gray-700': active,
                  }">
                  <div class="flex">
                    <!--  <div class="mr-2 w-3 text-xs font-bold opacity-50">
                    <CheckIcon
                      v-if="item === creator.crm_record_by_user.stage_name"
                      class="h-4 w-4 font-bold text-gray-600 hover:text-gray-700" />
                  </div> -->
                    <div class="mr-2 text-xs font-bold">
                      {{ item.emoji }}
                    </div>

                    <div class="text-xs font-medium">{{ item.name }}</div>
                  </div>
                </div>
              </MenuItem>
            </template>

            <MenuItem
              disabled
              as="div"
              v-slot="{ active }"
              v-if="filteredItems.length === 0">
              <div
                :class="{ 'bg-gray-200': active }"
                class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-gray-600">
                <div class="mx-auto flex">
                  <div class="text-center text-xs font-medium text-gray-300">
                    No match
                  </div>
                </div>
              </div>
            </MenuItem>

            <MenuItem
              as="div"
              v-slot="{ active }"
              :class="{ 'text-gray-700': active }"
              v-if="searchQuery"
              :disabled="!searchQuery"
              @click="searchQuery = ''"
              class="group mt-1 flex w-full cursor-pointer items-center border-t border-neutral-200 px-2 py-1 text-xs text-gray-600 hover:text-gray-600">
              <div class="mx-auto flex items-center text-center">
                <div class="text-center text-2xs font-semibold text-gray-300">
                  Clear search
                </div>
              </div>
            </MenuItem>
          </div>
        </MenuItems>
      </TransitionRoot>
    </Float>
  </Menu>
</template>

<script>
import {
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
  TransitionRoot,
} from '@headlessui/vue';
import { ChevronDownIcon, CheckIcon, XMarkIcon } from '@heroicons/vue/24/solid';
import { Float } from '@headlessui-float/vue';

export default {
  components: {
    TransitionRoot,
    Menu,
    XMarkIcon,
    MenuItem,
    ChevronDownIcon,
    CheckIcon,
    Float,
    MenuButton,
    MenuItems,
  },
  data() {
    return {
      open: false,
      searchQuery: '',
      /*  items: [
        {
          id: 1,
          name: 'item one',
          color: 'blue',
          emoji: '👍',
        },
        {
          id: 2,
          name: 'Chloe',
          color: 'pink',
          emoji: '👍',
        },
      ], */
    };
  },
  props: {
    searchText: {
      type: String,
      default: 'Search',
    },
    items: {
      type: Object,
      default: () => [],
    },
  },
  computed: {
    filteredItems() {
      return this.items.filter((item) =>
        item.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
  },
  methods: {
    itemClicked(item) {
      this.$emit('itemClicked', item);
      this.open = false;
    },
    focusMenuSearch() {
      this.$nextTick(() => {
        this.$refs.menuSearchInput.focus();
      });
    },
  },
};
</script>
