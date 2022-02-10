<template>
  <TabGroup>
    <TabList class="grid grid-cols-3 px-2 py-1"  :defaultIndex="2">
        <Tab v-slot="{ selected }" as="template">
            <button :class="[selected ? 'inline-flex text-2xs font-bold underline decoration-2 decoration-indigo-700 underline-offset-4 text-center items-center justify-center text-indigo-700' : 'inline-flex text-2xs font-bold text-center items-center justify-center']">
          <img height="12" width="12" class="mr-1" src="https://unpkg.com/simple-icons@v6/icons/instagram.svg" />
          Instagram
          </button>
        </Tab>
       <Tab v-slot="{ selected }" as="template">
            <button :class="[selected ? 'inline-flex text-2xs font-bold underline decoration-2 decoration-indigo-700 underline-offset-4 text-center items-center justify-center text-indigo-700' : 'inline-flex text-2xs font-bold text-center items-center justify-center']">
          <img height="12" width="12" class="mr-1" src="https://unpkg.com/simple-icons@v6/icons/tiktok.svg" />
          Tiktok
          </button>
        </Tab>
        <Tab v-slot="{ selected }" as="template">
            <button :class="[selected ? 'inline-flex text-2xs font-bold underline decoration-2 decoration-indigo-700 underline-offset-4 text-center items-center justify-center text-indigo-700' : 'inline-flex text-2xs font-bold text-center items-center justify-center']">
          <img height="12" width="12" class="mr-1" src="https://unpkg.com/simple-icons@v6/icons/youtube.svg" />
          Youtube
          </button>
        </Tab>
    </TabList>
    <TabPanels>
      <TabPanel><DiscoverySearchInstagram /></TabPanel>
      <TabPanel><DiscoverySearchTiktok /></TabPanel>
      <TabPanel><DiscoverySearchYoutube /></TabPanel>
    </TabPanels>
  </TabGroup>
</template>

<script>
    import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
    import DiscoverySearchTiktok from '../Discovery/DiscoverySearchTiktok.vue'
    import DiscoverySearchYoutube from '../Discovery/DiscoverySearchYoutube.vue'
    import DiscoverySearchInstagram from '../Discovery/DiscoverySearchInstagram.vue'
  

  export default {
    components: {
      TabGroup,
      TabList,
      Tab,
      TabPanels,
      TabPanel,
      DiscoverySearchTiktok,
        DiscoverySearchYoutube,
        DiscoverySearchInstagram,
    },
  }
</script>