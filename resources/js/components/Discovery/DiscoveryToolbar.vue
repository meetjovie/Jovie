<template>
    <div class="flex justify-between py-2">
        <div>
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
            <PopoverPanel class="absolute z-20 bg-white/50 backdrop-blur-xl shadow-xl rounded-md mt-2">
            <div v-for="action in actions" :key="action" class="grid grid-cols-1  w-80 rounded-md group">
                <div class="flex justify-between first:rounded-t-md last:rounded-b-md first:pt-2 last:pb-2 hover:bg-indigo-700 hover:text-white px-4 py-1 cursor-pointer" href="#">
                    <div class="inline-flex items-center">
                    <HeartIcon class="h-5 w-5 mr-2" /> 
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
        </div>
        <div>
            <TabList>
                <Tab  v-slot="{ selected }" as="div" :class="[selected ? 'bg-indigo-700 text-white' : 'relative active:bg-indigo-700 active:text-white  active:bg-indigo-700 active:text-white inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer']">All Results</Tab>
                <Tab  v-slot="{ selected }" as= "div" :class="[selected ? 'bg-indigo-700 text-white' : 'relative active:bg-indigo-700 active:text-white  inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer']">Shortlist</Tab>
                <Tab  v-slot="{ selected }" as="div" :class="[selected ? 'bg-indigo-700 text-white' : 'relative active:bg-indigo-700 active:text-white  inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer']">Rejected</Tab>
            </TabList>
        </div>
        <div>
           <Popover class="relative">
            <PopoverButton as="div" class="relative active:bg-indigo-700 active:text-white  active:bg-indigo-700 active:text-white inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer">Export</PopoverButton>
            <PopoverOverlay
                class="bg-black"
                :class='open ? "opacity-30 fixed inset-0" : "opacity-0"'
                />
            <PopoverPanel class="absolute right-0 middle-0 w-96 z-20">
            <div class="grid grid-cols-1 px-4 py-4 bg-white/90 backdrop-filter backdrop-blur-xl shadow-xl w-80 mt-2 rounded-md">
                <div>Hello</div>
            </div>

            <img src="/solutions.jpg" alt="" />
            </PopoverPanel>
        </Popover>
        </div>
    </div>
</template>
<script>
import { TabList, Tab,  } from '@headlessui/vue'
import { Popover, PopoverButton, PopoverPanel, PopoverOverlay } from '@headlessui/vue'
import { StarIcon, ChevronRightIcon, ChevronDownIcon, ThumbUpIcon, ThumbDownIcon, HeartIcon, BanIcon, RefreshIcon } from '@heroicons/vue/solid'



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
        RefreshIcon
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
                    icon: 'Heart',

                },
                {
                    name: 'Mute',
                    icon: 'Ban',

                },
                {
                    name: 'Update',
                    icon: 'Refresh',

                },
            ]
        }
    },
  }
</script>