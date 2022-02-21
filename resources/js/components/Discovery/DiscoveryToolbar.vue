<template>
  <div class="flex justify-between py-2">
    <div>
      <Popover class="relative">
        <PopoverButton
          as="div"
          class="relative inline-flex w-32 cursor-pointer items-center justify-between rounded-md border border-gray-300 bg-white px-4 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:bg-indigo-700 active:text-white active:text-white"
          >Actions
          <ChevronDownIcon class="h-5 w-5"></ChevronDownIcon>
        </PopoverButton>
        <transition
          enter-active-class="transition duration-200 ease-out"
          enter-from-class="scale-95 opacity-0"
          enter-to-class="scale-100 opacity-100"
          leave-active-class="transition duration-150 ease-in"
          leave-from-class="scale-100 opacity-100"
          leave-to-class="scale-95 opacity-0">
          <PopoverPanel
            class="absolute z-10 mt-2 rounded-md bg-white/90 shadow-2xl backdrop-blur-xl backdrop-filter">
            <div
              v-for="action in actions"
              :key="action"
              class="group grid w-64 grid-cols-1 rounded-md">
              <div
                class="flex cursor-pointer items-center justify-between px-4 py-1 text-xs text-neutral-700 first:rounded-t-md first:pt-2 last:rounded-b-md last:pb-2 even:border-2 even:border-b hover:bg-indigo-700 hover:text-white"
                href="#">
                <div class="inline-flex items-center">
                  <Component :is="action.icon" class="mr-2 h-4 w-4"></Component>
                  {{ action.name }}
                </div>
                <div v-if="action.haschild">
                  <ChevronRightIcon class="h-4 w-4" />
                </div>
              </div>
            </div>

            <img src="/solutions.jpg" alt="" />
          </PopoverPanel>
        </transition>
      </Popover>
    </div>
    <div>
      <TabList>
        <Tab
          v-slot="{ selected }"
          as="div"
          :class="[
            selected
              ? 'bg-indigo-700 text-white'
              : 'relative inline-flex cursor-pointer  items-center rounded-l-md border border-gray-300 bg-white px-4 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:bg-indigo-700 active:text-white active:text-white',
          ]"
          >All Results</Tab
        >
        <Tab
          v-slot="{ selected }"
          as="div"
          :class="[
            selected
              ? 'bg-indigo-700 text-white'
              : 'relative inline-flex cursor-pointer  items-center border border-gray-300 bg-white px-4 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:text-white',
          ]"
          >Shortlist</Tab
        >
        <Tab
          v-slot="{ selected }"
          as="div"
          :class="[
            selected
              ? 'bg-indigo-700 text-white'
              : 'relative inline-flex cursor-pointer  items-center rounded-r-md border border-gray-300 bg-white px-4 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:text-white',
          ]"
          >Rejected</Tab
        >
      </TabList>
    </div>
    <div class="items-center">
      <Popover v-slot="{ open }" class="relative z-20 inline">
        <ButtonGroup style="secondary" size="xs" rounded="left" text="Export" />
        <ButtonGroup
          size="xs"
          rounded="right"
          style="secondary"
          icon="ChevronRightIcon" />

        <PopoverButton
          as="button"
          class="relative inline-flex cursor-pointer items-center rounded-r-md border border-gray-300 bg-white px-4 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:bg-indigo-700 active:text-white active:text-white">
          <ChevronRightIcon class="h-5 w-5"></ChevronRightIcon>
        </PopoverButton>
        <DiscoverySidebar></DiscoverySidebar>
        <PopoverOverlay
          class="bg-black"
          :class="
            open
              ? 'fixed inset-0 z-20 h-full opacity-30 backdrop-blur-2xl backdrop-filter'
              : 'opacity-0'
          " />
      </Popover>
    </div>
  </div>
</template>
<script>
import { TabList, Tab } from '@headlessui/vue';
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverOverlay,
} from '@headlessui/vue';
import {
  StarIcon,
  ChevronRightIcon,
  SwitchHorizontalIcon,
  ChevronDownIcon,
  ThumbUpIcon,
  ThumbDownIcon,
  HeartIcon,
  BanIcon,
  RefreshIcon,
  TagIcon,
  ClipboardListIcon,
} from '@heroicons/vue/solid';
import DiscoverySidebar from './DiscoverySidebar.vue';
import ButtonGroup from '../ButtonGroup.vue';

export default {
  components: {
    StarIcon,
    ChevronRightIcon,
    ChevronDownIcon,
    TabList,
    Tab,
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverOverlay,
    ThumbUpIcon,
    ThumbDownIcon,
    HeartIcon,
    BanIcon,
    RefreshIcon,
    TagIcon,
    ClipboardListIcon,
    SwitchHorizontalIcon,
    DiscoverySidebar,
    ButtonGroup,
  },
  data() {
    return {
      actions: [
        {
          name: 'Shortlist',
          icon: 'ThumbUpIcon',
        },
        {
          name: 'Reject',
          icon: 'ThumbDownIcon',
        },
        {
          name: 'Favorite',
          icon: 'HeartIcon',
        },
        {
          name: 'Mute',
          icon: 'BanIcon',
        },
        {
          name: 'Update',
          icon: 'RefreshIcon',
        },
        {
          name: 'Add to list',
          icon: 'ClipboardListIcon',
          haschild: true,
        },
        {
          name: 'Add tag',
          icon: 'TagIcon',
          haschild: true,
        },
        {
          name: 'Switch type',
          icon: 'SwitchHorizontalIcon',
          haschild: false,
        },
      ],
    };
  },
};
</script>
