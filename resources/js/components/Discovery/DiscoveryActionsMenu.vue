<template>
  <Popover class="relative">
              <PopoverButton as="div" class="relative active:bg-indigo-700 active:text-white  active:bg-indigo-700 active:text-white inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 w-32 justify-between cursor-pointer">Actions
                  <ChevronDownIcon class="h-5 w-5"></ChevronDownIcon>
              </PopoverButton>
              <transition
                  enter-active-class="transition duration-200 ease-out"
                  enter-from-class="scale-95 opacity-0"
                  enter-to-class="scale-100 opacity-100"
                  leave-active-class="transition duration-150 ease-in"
                  leave-from-class="scale-100 opacity-100"
                  leave-to-class="scale-95 opacity-0"
                >
              <PopoverPanel class="absolute z-10 bg-white/90 backdrop-blur-xl shadow-2xl rounded-md mt-2">
              <div v-for="action in actions" :key="action" class="grid grid-cols-1  w-64 rounded-md group">
                  <div class="flex justify-between even:border-b even:border-2 first:rounded-t-md last:rounded-b-md first:pt-2 last:pb-2 hover:bg-indigo-700 hover:text-white px-4 py-1 cursor-pointer" href="#">
                      <div class="inline-flex items-center">
                      <Component :is="action.icon" class="h-5 w-5 mr-2" ></Component> 
                      {{ action.name }}
                      </div>
                      <div>
                          <ChevronRightIcon class="h-5 w-5" />
                      </div>
                  </div>

              </div>

              <img src="/solutions.jpg" alt="" />
              </PopoverPanel>
              </transition>
  </Popover>
</template>
<script>
import { Popover, PopoverButton, PopoverPanel, PopoverOverlay } from '@headlessui/vue'
import { StarIcon, ChevronRightIcon, ChevronDownIcon, HandThumbUpIcon, HandThumbDownIcon, HeartIcon, NoSymbolIcon, RefreshIcon, TagIcon, ClipboardListIcon } from '@heroicons/vue/24/solid'

export default {
  components: {
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverOverlay,
    StarIcon,
    ChevronRightIcon,
    ChevronDownIcon,
    HandThumbUpIcon,
    HandThumbDownIcon,
    HeartIcon,
    NoSymbolIcon,
    RefreshIcon,
    TagIcon,
    ClipboardListIcon,
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
                    icon: 'RefreshIcon',

                },
                {
                    name: 'Add to list',
                    icon: 'ClipboardListIcon',
                },
                {
                    name: 'Add tag',
                    icon: 'TagIcon',
                }
            ]
        }
    },
}