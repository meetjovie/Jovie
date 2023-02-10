<template>
  <!--  @click="toggleSortingOrder()" -->
  <div class="group/header w-60" v-if="column">
    <JovieDropdownMenu
      :items="dropdownItems"
      size="lg"
      @contextmenu.prevent="openMenu"
      @itemClicked="itemClicked"
      :open="menuOpen"
      placement="bottom-start">
      <template #triggerButton>
        <div class="w-full">
          <div
            class="text-medium group flex h-full w-full items-center justify-between py-2 pl-1 pr-2 tracking-wider"
            :class="[
              {
                ' cursor-pointer hover:bg-slate-200 active:bg-slate-300 dark:hover:bg-jovieDark-800':
                  sortable,
              },
            ]">
            <div
              @contextmenu.prevent="openMenu()"
              class="text-medium flex w-full items-center tracking-wider">
              <component
                class="mr-1 h-4 w-4 text-slate-400 dark:text-jovieDark-200"
                :class="{
                  'text-slate-600 dark:text-jovieDark-200': sortable,
                }"
                :is="column.icon"></component>
              <span
                class="text-medium tracking-wider line-clamp-1 dark:text-jovieDark-200">
                {{ column.name }}
              </span>
            </div>
            <div
              @click="
                $emit('sortData', {
                  sortBy: column.key,
                  sortOrder: column.sortOrder,
                })
              "
              v-if="column.sortable"
              class="cursor-pointer text-slate-400 dark:text-jovieDark-600">
              <svg
                v-if="!column.sortOrder"
                xmlns="http://www.w3.org/2000/svg"
                class="ml-1 h-3 w-3 text-slate-500/0 group-hover/header:text-slate-500 dark:group-hover/header:text-slate-400"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 320 512">
                <path
                  d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
              </svg>
              <ChevronDownIcon
                v-else-if="column.sortOrder === 'desc'"
                class="ml-1 h-3 w-3 text-slate-500/0 group-hover/header:text-slate-500 dark:group-hover/header:text-slate-400" />
              <ChevronUpIcon
                v-else
                class="ml-1 h-3 w-3 text-slate-500/0 group-hover/header:text-slate-500 dark:group-hover/header:text-slate-400" />
            </div>
          </div>
        </div>
      </template>
        <template #menuItem #item="{element, index }">
            <div
                 class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-slate-600 dark:text-jovieDark-200"
                 :class="{
                        'bg-slate-200 text-slate-700 dark:bg-jovieDark-500 dark:text-jovieDark-100':
                          active,
                      }">
                <div class="flex items-center">
                    <div v-if="item.emoji" class="mr-2 text-xs font-bold">
                        {{ item.emoji }}
                    </div>
                    <div
                        v-else-if="item.icon"
                        class="mr-2 items-center text-xs font-bold">
                        <component :is="item.icon" class="h-3 w-3" />
                    </div>
                    <div v-else></div>

                    <div class="text-xs font-normal tracking-wider">
                        {{ item[nameKey] }}
                    </div>
                </div>
            </div>
            <CustomFieldsMenu class="" @getHeaders="$emit('getHeaders')" />
        </template>
    </JovieDropdownMenu>
    <!--  <PopoverPanel
      static
      class="w-48 items-center rounded-md border border-gray-200 bg-white/60 bg-clip-padding text-slate-900 shadow-md backdrop-blur-xl backdrop-filter dark:border-gray-700 dark:bg-jovieDark-900/60 dark:text-jovieDark-100">
      <div
        @click="$emit('hide-column')"
        class="flex cursor-pointer rounded-md py-2 px-2 text-xs font-medium text-slate-900 hover:bg-slate-300 dark:text-jovieDark-100"
        v-for="item in dropdownItems"
        :key="item.name">
        <component :is="item.icon" class="mr-2 h-4 w-4" />
        {{ item.name }}
      </div>
    </PopoverPanel> -->
  </div>
</template>
<script>
import { Float } from '@headlessui-float/vue';
import JovieDropdownMenu from './JovieDropdownMenu';
import {
  ChevronDownIcon,
  ChevronUpIcon,
  Bars3BottomLeftIcon,
  AtSymbolIcon,
  CurrencyDollarIcon,
  LinkIcon,
  CalendarDaysIcon,
  ArrowDownCircleIcon,
  StarIcon,
  BriefcaseIcon,
  UserIcon,
  ChartBarIcon,
  EyeSlashIcon,
} from '@heroicons/vue/20/solid';
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  TransitionRoot,
} from '@headlessui/vue';
import CustomFieldsMenu from './CustomFieldsMenu.vue';

export default {
  components: {
    ChevronDownIcon,
    ChevronUpIcon,
    Bars3BottomLeftIcon,
    AtSymbolIcon,
    CurrencyDollarIcon,
    StarIcon,
    CalendarDaysIcon,
    ArrowDownCircleIcon,
    LinkIcon,
    BriefcaseIcon,
    UserIcon,
    ChartBarIcon,
    EyeSlashIcon,
    JovieDropdownMenu,
    Popover,
    PopoverButton,
    PopoverPanel,
    TransitionRoot,
    Float,
      CustomFieldsMenu,
  },
  data() {
    return {
      open: true,
    };
  },
  methods: {
    openMenu() {
      this.open = true;
      console.log('open menu');
    },
      itemClicked(id) {
          let item = this.dropdownItems.find(item => item.id == id)
      }
  },
  props: {
    column: {
      type: Object,
    },
    menuOpen: {
      type: Boolean,
      default: false,
    },
    dropdownItems: {
      type: Array,
      default: () => [
        {
            id: 1,
          name: 'Hide Column',
          icon: 'EyeSlashIcon',
          emit: 'hideColumn',
          menu: true,
        },
        {
            id: 2,
          name: 'Edit Field',
          icon: 'PencilIcon',
          emit: 'editField',
          menu: true,
        },
        {
            id: 3,
          name: 'Sort Ascending',
          icon: 'ChevronUpIcon',
          emit: 'sortAscending',
          menu: true,
        },
        {
            id: 4,
          name: 'Sort Descending',
          icon: 'ChevronDownIcon',
          emit: 'sortDescending',
          menu: true,
        },
        {
            id: 5,
          name: 'Delete Field',
          icon: 'TrashIcon',
          emit: 'deleteField',
          menu: true,
          color: 'red',
        },
      ],
    },
  },
};
</script>
