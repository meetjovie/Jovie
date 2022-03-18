<template>
  <TabPanels>
    <TabPanel>
      <DiscoveryCreatorTable />
    </TabPanel>
    <TabPanel>Shortlist Table</TabPanel>
    <TabPanel>Reject Table</TabPanel>
  </TabPanels>
</template>

<script>
import { TabPanels, TabPanel } from '@headlessui/vue';
import DiscoveryCreatorTable from '../Discovery/DiscoveryCreatorTable.vue';

export default {
  components: {
    DiscoveryCreatorTable,
    TabPanels,
    TabPanel,
  },
};
</script>
