<template>
  <TransitionRoot
    :show="searchopen"
    enter="transition-opacity duration-75"
    enter-from="opacity-0"
    enter-to="opacity-100"
    leave="transition-opacity duration-150"
    leave-from="opacity-100"
    leave-to="opacity-0">
    <TabGroup>
      <TabList class="grid grid-cols-3 px-2 py-0" :defaultIndex="2">
        <Tab v-slot="{ selected }" as="template">
          <button
            :class="[
              selected
                ? 'inline-flex items-center justify-center text-center text-2xs font-bold text-indigo-700 underline decoration-indigo-700 decoration-2 underline-offset-4'
                : 'inline-flex items-center justify-center text-center text-2xs font-bold',
            ]">
            <img
              height="8"
              width="8"
              class="mr-1"
              src="https://unpkg.com/simple-icons@v6/icons/instagram.svg" />
            <span class="font-medium">Instagram</span>
          </button>
        </Tab>
        <Tab v-slot="{ selected }" as="template">
          <button
            :class="[
              selected
                ? 'inline-flex items-center justify-center text-center text-2xs font-bold text-indigo-700 underline decoration-indigo-700 decoration-2 underline-offset-4'
                : 'inline-flex items-center justify-center text-center text-2xs font-bold',
            ]">
            <img
              height="8"
              width="8"
              class="mr-1"
              src="https://unpkg.com/simple-icons@v6/icons/tiktok.svg" />
            <span class="font-medium">Tiktok</span>
          </button>
        </Tab>
        <Tab v-slot="{ selected }" as="template">
          <button
            :class="[
              selected
                ? 'inline-flex items-center justify-center text-center text-2xs font-bold text-indigo-700 underline decoration-indigo-700 decoration-2 underline-offset-4'
                : 'inline-flex items-center justify-center text-center text-2xs font-bold',
            ]">
            <img
              height="8"
              width="8"
              class="mr-1"
              src="https://unpkg.com/simple-icons@v6/icons/youtube.svg" />
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
  </TransitionRoot>
</template>

<script>
import {
  TabGroup,
  TabList,
  Tab,
  TabPanels,
  TabPanel,
  TransitionRoot,
} from '@headlessui/vue';
import DiscoverySearchTiktok from '../Discovery/DiscoverySearchTiktok.vue';
import DiscoverySearchYoutube from '../Discovery/DiscoverySearchYoutube.vue';
import DiscoverySearchInstagram from '../Discovery/DiscoverySearchInstagram.vue';

export default {
  props: {
    searchopen: {
      type: Boolean,
      default: false,
    },
  },
  components: {
    TabGroup,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
    TransitionRoot,
    DiscoverySearchTiktok,
    DiscoverySearchYoutube,
    DiscoverySearchInstagram,
  },
};
</script>
