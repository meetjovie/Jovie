<template>
  <TabGroup>
    <TabList class="grid grid-cols-3 px-2 py-1"  :defaultIndex="1">
        <Tab  class="inline-flex text-2xs font-bold text-center items-center justify-center"
            :class="[selected ? 'bg-indigo-500 text-white' : 'bg-white text-black']">
          <img height="12" width="12" class="mr-1" src="https://unpkg.com/simple-icons@v6/icons/instagram.svg" />
          Instagram
        </Tab>
        <Tab class="inline-flex text-2xs font-bold text-center items-center justify-center"
             :class="[selected ? 'bg-indigo-500 text-white' : 'bg-white text-black']">
          <img height="12" width="12" class="mr-1" src="https://unpkg.com/simple-icons@v6/icons/tiktok.svg" />
          Tiktok
        </Tab>
        <Tab class="inline-flex text-2xs font-bold text-center items-center justify-center"
         :class="[selected ? 'bg-indigo-500 text-white' : 'bg-white text-black']">
          <img height="12" width="12" class="mr-1" src="https://unpkg.com/simple-icons@v6/icons/youtube.svg" />
          Youtube
        </Tab>
    </TabList>
    <TabPanels>
      <TabPanel><DiscoverySearchTiktok></DiscoverySearchTiktok></TabPanel>
      <TabPanel>Content 2</TabPanel>
      <TabPanel>Content 3</TabPanel>
    </TabPanels>
  </TabGroup>
</template>

<script>
  import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
  import DiscoverySearchTiktok from '../Discovery/DiscoverySearchTiktok.vue'
  

  export default {
    components: {
      TabGroup,
      TabList,
      Tab,
      TabPanels,
      TabPanel,
      DiscoverySearchTiktok,
    },
  }
</script>