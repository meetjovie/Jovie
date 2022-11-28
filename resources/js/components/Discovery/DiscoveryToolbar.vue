<template>
  <div class="flex justify-between py-2">
    <div>
      <Popover class="relative">
        <PopoverButton
          as="div"
          class="relative inline-flex w-32 cursor-pointer items-center justify-between rounded-md border border-slate-300 bg-white px-4 py-1 text-xs font-medium text-slate-700 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:bg-indigo-700 active:text-white active:text-white"
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
            as="div"
            class="absolute z-10 mt-2 rounded-md bg-white/70 shadow-2xl backdrop-blur-md backdrop-saturate-150 backdrop-filter">
            <div
              v-for="action in actions"
              :key="action"
              class="group grid w-64 grid-cols-1 rounded-t-md">
              <div
                class="flex cursor-pointer items-center justify-between px-4 py-1 text-xs text-slate-700 first:pt-2 last:pb-2 even:border-2 even:border-b hover:bg-indigo-700 hover:text-white"
                href="#">
                <div class="inline-flex items-center">
                  <Component :is="action.icon" class="mr-2 h-4 w-4"></Component>
                  {{ action.name }}
                </div>
                <div v-if="action.haschild">
                  <ChevronRightIcon class="h-4 w-4" />
                </div>
                <div
                  v-for="child in action.children"
                  :key="child"
                  class="absolute left-64 hidden w-60 items-center justify-between rounded-r-md bg-white/70 px-4 py-2 text-xs text-slate-700 backdrop-blur-xl backdrop-saturate-150 backdrop-filter first:pt-2 hover:bg-indigo-700 hover:text-white group-hover:flex">
                  <div class="inline-flex items-center">
                    <Component
                      :is="child.icon"
                      class="mr-2 h-4 w-4"></Component>
                    {{ child.name }}
                  </div>
                </div>
              </div>
            </div>

            <img src="/solutions.jpg" alt="" />
          </PopoverPanel>
        </transition>
      </Popover>
    </div>
    <div>
      <TabGroup @change="$emit('changeTab', $event)">
        <TabList>
          <Tab v-slot="{ selected }" as="template"
            ><span
              :class="[
                selected
                  ? 'relative inline-flex cursor-pointer items-center rounded-l-md border bg-indigo-700 px-4 py-1 text-xs font-medium text-white  focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:bg-indigo-700 active:text-white active:text-white'
                  : 'relative inline-flex cursor-pointer  items-center rounded-l-md border border-slate-300 bg-white px-4 py-1 text-xs font-medium text-slate-700   hover:bg-slate-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:bg-indigo-700 active:text-white active:text-white',
              ]"
              >All Results</span
            ></Tab
          >
          <Tab v-slot="{ selected }" as="template"
            ><span
              :class="[
                selected
                  ? 'relative inline-flex cursor-pointer items-center border bg-indigo-700 px-4 py-1 text-xs font-medium text-white  focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:text-white'
                  : 'relative inline-flex cursor-pointer  items-center border border-slate-300 bg-white px-4 py-1 text-xs font-medium text-slate-700   hover:bg-slate-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:text-white',
              ]"
              >Shortlist</span
            ></Tab
          >
          <Tab v-slot="{ selected }" as="template"
            ><span
              :class="[
                selected
                  ? 'relative inline-flex cursor-pointer items-center rounded-r-md border bg-indigo-700 px-4 py-1 text-xs font-medium text-white  focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:text-white'
                  : 'relative inline-flex cursor-pointer items-center rounded-r-md border border-slate-300 bg-white px-4 py-1 text-xs font-medium text-slate-700   hover:bg-slate-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 active:bg-indigo-700 active:text-white',
              ]"
              >Rejected</span
            ></Tab
          >
        </TabList>
      </TabGroup>
    </div>
    <div class="items-center">
      <span class="inline-flex items-center">
        <ButtonGroup
          design="secondary"
          size="sm"
          rounded="left"
          text="Export" />
      </span>
    </div>
  </div>
</template>
<script>
import { TabList, Tab, TabGroup } from '@headlessui/vue';
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverOverlay,
} from '@headlessui/vue';
import {
  StarIcon,
  ChevronRightIcon,
  AdjustmentsHorizontalIcon,
  ChevronDownIcon,
  HandThumbUpIcon,
  HandThumbDownIcon,
  HeartIcon,
  NoSymbolIcon,
  ArrowPathIcon,
  TagIcon,
  ClipboardDocumentListIcon,
} from '@heroicons/vue/24/solid';
import DiscoverySidebar from './DiscoverySidebar.vue';
import ButtonGroup from '../ButtonGroup.vue';

export default {
  components: {
    StarIcon,
    ChevronRightIcon,
    ChevronDownIcon,
    TabList,
    Tab,
    TabGroup,
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverOverlay,
    HandThumbUpIcon,
    HandThumbDownIcon,
    HeartIcon,
    NoSymbolIcon,
    ArrowPathIcon,
    TagIcon,
    ClipboardDocumentListIcon,
    AdjustmentsHorizontalIcon,
    DiscoverySidebar,
    ButtonGroup,
  },
  data() {
    return {
      actions: [
        {
          name: 'Shortlist',
          icon: 'HandThumbUpIcon',
        },
        {
          name: 'Reject',
          icon: 'HandThumbDownIcon',
        },
        {
          name: 'Favorite',
          icon: 'HeartIcon',
        },
        {
          name: 'Mute',
          icon: 'NoSymbolIcon',
        },
        {
          name: 'Update',
          icon: 'ArrowPathIcon',
        },
        {
          name: 'Add to list',
          icon: 'ClipboardDocumentListIcon',
          haschild: true,
        },
        {
          name: 'Add tag',
          icon: 'TagIcon',
          haschild: true,
          children: [
            {
              name: 'Tag 2',
              icon: 'TagIcon',
            },
            {
              name: 'Tag 3',
              icon: 'TagIcon',
            },
          ],
        },
        {
          name: 'Switch type',
          icon: 'AdjustmentsHorizontalIcon',
          haschild: false,
        },
      ],
    };
  },
};
</script>
