<template>
    <div class="flex justify-between py-2">
        <div>
            <DiscoveryActionsMenu></DiscoveryActionsMenu>
        </div>
        <div>
            <TabList>
                <Tab  v-slot="{ selected }" as="div" :class="[selected ? 'bg-indigo-700 text-white' : 'relative active:bg-indigo-700 active:text-white  active:bg-indigo-700 active:text-white inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer']">All Results</Tab>
                <Tab  v-slot="{ selected }" as= "div" :class="[selected ? 'bg-indigo-700 text-white' : 'relative active:bg-indigo-700 active:text-white  inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer']">Shortlist</Tab>
                <Tab  v-slot="{ selected }" as="div" :class="[selected ? 'bg-indigo-700 text-white' : 'relative active:bg-indigo-700 active:text-white  inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus-visible:z-10 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 focus-visible:border-indigo-500 cursor-pointer']">Rejected</Tab>
            </TabList>
        </div>
        <div>
            Right
        </div>
    </div>
</template>
<script>
import { TabList, Tab,  } from '@headlessui/vue'
import { DiscoveryActionsMenu } from '../components/Discovery/DiscoveryActionsMenu.vue'

export default {
    components: {
      TabList,
      Tab,
      DiscoveryActionsMenu,
    },
  }
</script>