<template>
  <Menu
    as="div"
    v-slot="{ open }"
    class="relative z-10 inline-block w-full items-center text-left">
    <Float portal :offset="0" shift :placement="placement">
      <MenuButton class="w-full cursor-pointer" @click="open" ref="menuButton">
        <slot name="triggerButton"> Button Goes Here</slot>
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
          :class="[{ 'w-40': size == 'md' }, { 'w-80': size == 'lg' }]"
          class="z-30 mt-2 max-h-80 origin-top-right items-center divide-y divide-slate-100 overflow-auto rounded-lg border border-slate-200 bg-white/60 bg-clip-padding pb-2 pt-1 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-xl backdrop-saturate-150 backdrop-filter focus-visible:outline-none dark:divide-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-800/60">
          <slot name="menuTop"></slot>
          <div v-if="searchable" class="sticky top-0 px-1">
            <MenuItem
              as="div"
              class="border border-slate-200 dark:border-jovieDark-border">
              <div class="relative flex items-center">
                <input
                  ref="menuSearchInput"
                  v-model="searchQuery"
                  :placeholder="searchText"
                  class="w-full border-0 border-none border-transparent bg-transparent px-1 py-2 text-xs font-medium text-slate-600 outline-0 ring-0 placeholder:font-light placeholder:text-slate-400 focus:border-transparent focus:ring-0 focus:ring-transparent focus:ring-offset-0" />
                <!-- <div
                  v-if="item.shortcut"
                  class="absolute inset-y-0 right-0 flex py-2 pr-1.5">
                  <kbd
                    class="inline-flex items-center rounded border border-slate-200 px-1 font-sans text-2xs font-medium text-slate-400 dark:border-jovieDark-border"
                    >{{ item.shortcut }}</kbd
                  >
                </div> -->
              </div>
            </MenuItem>
          </div>

          <div
            class="overflow-y-scroll border-t border-slate-200 px-2 dark:border-jovieDark-border">
            <div v-if="items">
              <template v-for="(item, key) in filteredItems" :key="item.name">
                <MenuItem
                  v-if="item.route"
                  @click="itemClicked(item.id)"
                  as="div"
                  v-slot="{ active }">
                  <router-link :to="item.route">
                    <div
                      class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-slate-600 dark:text-jovieDark-200"
                      :class="{
                        'bg-slate-200 text-slate-700 dark:bg-jovieDark-700 dark:text-jovieDark-100':
                          active,
                      }">
                      <div class="flex items-center truncate">
                        <!--  <div class="mr-2 w-3 text-xs font-bold opacity-50">
                    <CheckIcon
                      v-if="item === creator.crm_record_by_user.stage_name"
                      class="h-4 w-4 font-bold text-slate-600 hover:text-slate-700" />
                  </div> -->
                        <div v-if="item.emoji" class="mr-2 text-xs font-bold">
                          {{ item.emoji }}
                        </div>
                        <div v-if="numbered" class="mr-2 text-xs font-bold">
                          1
                        </div>
                        <div
                          v-else-if="item.icon"
                          class="mr-2 items-center text-xs font-bold">
                          <component :is="item.icon" class="h-3 w-3" />
                        </div>
                        <div v-else></div>

                        <div class="text-xs font-medium">{{ item.name }}</div>
                      </div>
                    </div>
                  </router-link>
                </MenuItem>
                <MenuItem
                  v-else
                  @click="itemClicked(item.id)"
                  as="div"
                  v-slot="{ active }">
                  <div
                    class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-slate-600 dark:text-jovieDark-200"
                    :class="{
                      'bg-slate-200 text-slate-700 dark:bg-jovieDark-700 dark:text-jovieDark-100':
                        active,
                    }">
                    <div class="flex items-center">
                      <!--  <div class="mr-2 w-3 text-xs font-bold opacity-50">
                    <CheckIcon
                      v-if="item === creator.crm_record_by_user.stage_name"
                      class="h-4 w-4 font-bold text-slate-600 hover:text-slate-700" />
                  </div> -->
                      <div v-if="item.emoji" class="mr-2 text-xs font-bold">
                        {{ item.emoji }}
                      </div>
                      <div
                        v-else-if="item.icon"
                        class="mr-2 items-center text-xs font-bold">
                        <component :is="item.icon" class="h-3 w-3" />
                      </div>
                      <div v-else></div>

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
                  :class="{ 'bg-slate-200 dark:bg-jovieDark-700': active }"
                  class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-slate-600 dark:text-jovieDark-200">
                  <div class="mx-auto flex">
                    <div
                      v-if="createIfNotFound"
                      @click="createItem(searchQuery)"
                      class="text-center text-xs font-medium text-slate-600 dark:text-jovieDark-200">
                      Create "{{ searchQuery }}"
                    </div>
                    <div
                      v-else
                      class="text-center text-xs font-medium text-slate-300 dark:text-jovieDark-400">
                      No match
                    </div>
                  </div>
                </div>
              </MenuItem>

              <MenuItem
                as="div"
                v-slot="{ active }"
                :class="{ 'text-slate-700': active }"
                v-if="searchQuery"
                :disabled="!searchQuery"
                @click="searchQuery = ''"
                class="group mt-1 flex w-full cursor-pointer items-center border-t border-slate-200 px-2 py-1 text-xs text-slate-600 hover:text-slate-600 dark:border-jovieDark-border dark:text-jovieDark-200">
                <div class="mx-auto flex items-center text-center">
                  <div
                    class="text-center text-2xs font-semibold text-slate-300 dark:text-jovieDark-100">
                    Clear search
                  </div>
                </div>
              </MenuItem>
            </div>
            <slot name="menuBottom"></slot>
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
import {
  ChevronDownIcon,
  CheckIcon,
  XMarkIcon,
  CogIcon,
  BellIcon,
  UserIcon,
  CreditCardIcon,
  ArrowLeftOnRectangleIcon,
  LifebuoyIcon,
  CloudArrowDownIcon,
} from '@heroicons/vue/24/solid';
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
    CogIcon,
    BellIcon,
    UserIcon,
    CreditCardIcon,
    ArrowLeftOnRectangleIcon,
    CloudArrowDownIcon,
    LifebuoyIcon,
  },
  data() {
    return {
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
    size: {
      type: String,
      default: 'md',
    },
    items: {
      type: Object,
      default: () => [],
    },
    createIfNotFound: {
      type: Boolean,
      default: false,
    },
    searchable: {
      type: Boolean,
      default: true,
    },
    numbered: {
      type: Boolean,
      default: false,
    },
    shortcut: {
      type: String,
      required: false,
      default: '',
    },
    open: {
      type: Boolean,
      required: false,
      default: false,
    },
    placement: {
      type: String,
      required: false,
      default: 'right-start',
    },
    offset: {
      type: Number,
      required: false,
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
    },
    createItem(name) {
      this.$emit('createItem', name);
    },
    focusMenuSearch() {
      this.$nextTick(() => {
        this.$refs.menuSearchInput.focus();
      });
    },
  },
};
</script>
