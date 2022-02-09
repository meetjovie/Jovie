<template>
    <div class="flex justify-between py-2">
        <div>
         <Popover class="relative">
            <PopoverButton as="div" class="relative active:bg-indigo-700 active:text-white  active:bg-indigo-700 active:text-white inline-flex items-center px-4 py-1 rounded-md border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 w-32 justify-between cursor-pointer">Actions
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
            <PopoverPanel class="absolute z-10 bg-white/90 backdrop-filter backdrop-blur-xl shadow-2xl rounded-md mt-2">
            <div v-for="action in actions" :key="action" class="grid grid-cols-1  w-64 rounded-md group">
                <div class="flex justify-between even:border-b text-neutral-700 text-xs items-center even:border-2 first:rounded-t-md last:rounded-b-md first:pt-2 last:pb-2 hover:bg-indigo-700 hover:text-white px-4 py-1 cursor-pointer" href="#">
                    <div class="inline-flex items-center">
                    <Component :is="action.icon" class="h-4 w-4 mr-2" ></Component> 
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
                <Tab  v-slot="{ selected }" as="div" :class="[selected ? 'bg-indigo-700 text-white' : 'relative active:bg-indigo-700 active:text-white  active:bg-indigo-700 active:text-white inline-flex items-center px-4 py-1 rounded-l-md border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer']">All Results</Tab>
                <Tab  v-slot="{ selected }" as= "div" :class="[selected ? 'bg-indigo-700 text-white' : 'relative active:bg-indigo-700 active:text-white  inline-flex items-center px-4 py-1 border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer']">Shortlist</Tab>
                <Tab  v-slot="{ selected }" as="div" :class="[selected ? 'bg-indigo-700 text-white' : 'relative active:bg-indigo-700 active:text-white  inline-flex items-center px-4 py-1 rounded-r-md border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer']">Rejected</Tab>
            </TabList>
        </div>
        <div class="items-center">
            <button as="div" class="inline relative active:bg-indigo-700 active:text-white  active:bg-indigo-700 active:text-white inline-flex items-center px-4 py-1 rounded-md border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer">Export</button>
           <Popover v-slot="{ open }" class="inline relative z-20">
            <PopoverButton as="div" class="relative active:bg-indigo-700 active:text-white  active:bg-indigo-700 active:text-white inline-flex items-center px-4 py-1 rounded-md border border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer">
                <ChevronRightIcon class="h-5 w-5"></ChevronRightIcon>
            </PopoverButton>
            <DiscoverySidebar></DiscoverySidebar>
           <PopoverOverlay
                class="bg-black "
                :class='open ? "opacity-30 backdrop-filter backdrop-blur-2xl z-20 fixed h-full inset-0" : "opacity-0"'
                /> 
            
        </Popover>
        </div>
    </div>
</template>
<script>
import { TabList, Tab,  } from '@headlessui/vue'
import { Popover, PopoverButton, PopoverPanel, PopoverOverlay } from '@headlessui/vue'
import { StarIcon, ChevronRightIcon, SwitchHorizontalIcon, ChevronDownIcon, ThumbUpIcon, ThumbDownIcon, HeartIcon, BanIcon, RefreshIcon, TagIcon, ClipboardListIcon } from '@heroicons/vue/solid'
import DiscoverySidebar from './DiscoverySidebar.vue'


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
        DiscoverySidebar
        
    
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

                }

            ]
        }
    },
  }
</script>