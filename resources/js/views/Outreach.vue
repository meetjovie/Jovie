<template>
  <div class="">
    <TabGroup as="div" class="">
      <div class="flex items-center justify-between border-b bg-white px-4">
        <TabList as="div" class="flex justify-between border-b pt-2">
          <SubNav :tabs="tabs"></SubNav>
        </TabList>
        <div class="items-center text-xs"></div>
      </div>
      <TabPanels>
        <TabPanel>
          <Sequences></Sequences>
        </TabPanel>
        <TabPanel>
          <Emails></Emails>
        </TabPanel>
        <TabPanel>
          <Templates></Templates>
        </TabPanel>
        <TabPanel>
          <Mailboxes></Mailboxes>
        </TabPanel>
        <TabPanel>
          <Settings></Settings>
        </TabPanel>
      </TabPanels>
    </TabGroup>
  </div>
</template>

<script>
import SubNav from '../components/SubNav.vue';
import Sequences from '../views/Outreach/Sequences.vue';
import Emails from '../views/Outreach/Emails.vue';
import Templates from '../views/Outreach/Templates.vue';
import Mailboxes from '../views/Outreach/Mailboxes.vue';
import Settings from '../views/Outreach/Settings.vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
export default {
  name: 'Outreach',
  components: {
    SubNav,
    TabGroup,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
    Sequences,
    Emails,
    Templates,
    Mailboxes,
    Settings,
  },
  mounted() {
    //add segment analytics
    window.analytics.page(this.$route.path);
  },
  data() {
    return {
      tabs: [
        {
          name: 'Sequences',
          otherProperty: 'tab1',
        },
        {
          name: 'Emails',
          otherProperty: 'tab2',
        },
        {
          name: 'Templates',
          otherProperty: 'tab3',
        },
        {
          name: 'Mailboxes',
          otherProperty: 'tab4',
        },
        {
          name: 'Settings',
          otherProperty: 'tab5',
        },
      ],
    };
  },
};
</script>
