<template>
  <!--  @click="toggleSortingOrder()" -->
  <div class="w-full">
    <Popover class="w-full">
      <Float placement="bottom-start" portal shift>
        <PopoverButton class="w-full">
          <div
            class="group flex h-full w-full cursor-pointer select-none items-center justify-between py-2 pl-1 pr-2 hover:bg-neutral-200 active:bg-neutral-300">
            <div class="flex w-full items-center">
              <component
                class="mr-1 h-4 w-4 text-neutral-300 group-hover:text-neutral-400"
                :is="icon"></component>
              <span class="line-clamp-1">{{ name }}</span>
            </div>
            <div
              v-if="sortable"
              class="cursor-pointer group-hover:text-neutral-400"
              :class="[
                { 'text-neutral-200': sortingOrder },
                'text-neutral-200/0',
              ]">
              <svg
                v-if="!sortingOrder"
                xmlns="http://www.w3.org/2000/svg"
                class="ml-1 h-3 w-3"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 320 512">
                <path
                  d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
              </svg>
              <ChevronDownIcon
                v-else-if="sortingOrder === 'desc'"
                class="ml-1 h-3 w-3" />
              <ChevronUpIcon v-else class="ml-1 h-3 w-3" />
            </div>
          </div>
        </PopoverButton>
        <PopoverPanel
          class="text-50 w-40 items-center rounded-md bg-neutral-700 shadow-md">
          <div
            @click="$emit('hide-column')"
            class="flex cursor-pointer py-2 px-2 text-xs font-medium text-white first:rounded-t-md last:rounded-b-md hover:bg-neutral-600"
            v-for="item in dropdownItems">
            <component :is="item.icon" class="mr-2 h-4 w-4" />
            {{ item.name }}
          </div>
        </PopoverPanel>
      </Float>
    </Popover>
  </div>
</template>
<script>
import { Float } from '@headlessui-float/vue';
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
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
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
    Popover,
    PopoverButton,
    PopoverPanel,
    Float,
  },
  data() {
    return {
      sortingOrder: '',
    };
  },
  methods: {
    toggleSortingOrder() {
      //toggle sorting order between asc, desc, and null
      if (this.sortingOrder === 'asc') {
        this.sortingOrder = 'desc';
      } else if (this.sortingOrder === 'desc') {
        this.sortingOrder = null;
      } else {
        this.sortingOrder = 'asc';
      }
    },
  },
  props: {
    name: {
      type: String,
      default: 'Column Name',
    },
    icon: {
      type: String,
      default: 'ArrowDownCircleIcon',
    },
    sortable: {
      type: Boolean,
      default: false,
    },
    dropdownItems: {
      type: Array,
      default: () => [
        {
          name: 'Hide Column',
          icon: 'EyeSlashIcon',
          emit: 'hide-column',
          menu: true,
        },
      ],
    },
  },
};
</script>
