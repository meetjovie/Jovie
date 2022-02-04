<template>
    <div class="flex justify-between py-2">
        <div>
         <Popover class="relative">
            <PopoverButton as="div" class="relative active:bg-indigo-700 active:text-white  active:bg-indigo-700 active:text-white inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer">Actions</PopoverButton>

            <PopoverPanel class="absolute z-10">
            <div class="grid grid-cols-1 bg-white/90 backdrop-blur-md shadow-xl w-80 mt-2 rounded-md group">
                <div class="first:rounded-t-md last:rounded-b-md first:pt-2 last:pb-2 hover:bg-indigo-700 hover:text-white px-4 py-1" href="#">Shortlist</div>
                <div class="first:rounded-t-md last:rounded-b-md first:pt-2 last:pb-2 hover:bg-indigo-700 hover:text-white px-4 py-1" href="#">Reject</div>
                <div class="first:rounded-t-md last:rounded-b-md first:pt-2 last:pb-2 hover:bg-indigo-700 hover:text-white px-4 py-1" href="#">Favorite</div>
                <div class="first:rounded-t-md last:rounded-b-md first:pt-2 last:pb-2 hover:bg-indigo-700 hover:text-white px-4 py-1" href="#">Mute</div>
                <div class="first:rounded-t-md last:rounded-b-md first:pt-2 last:pb-2 hover:bg-indigo-700 hover:text-white px-4 py-1" href="#">Update</div>
            </div>

            <img src="/solutions.jpg" alt="" />
            </PopoverPanel>
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
            <PopoverPanel class="absolute right-0 top-0 w-96 h-screen z-10">
            <div class="grid grid-cols-1 px-4 py-4 bg-white/90 backdrop-blur-xl shadow-xl w-80 mt-2 rounded-md">
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



export default {
    components: {
        TabList,
        Tab,
        Popover,
        PopoverButton,
        PopoverPanel,
        PopoverOverlay,
    },
  }
</script>