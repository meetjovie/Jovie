<template>
  <TabGroup vertical :defaultIndex="defaultTab" as="div" class="flex">
    <JovieSidebar menu="Settings">
      <template #main>
        <TabList class="mt-4 flex flex-col space-y-2 px-4">
          <Tab
            as="template"
            v-for="tab in tabs"
            :key="tab.name"
            v-slot="{ selected }">
            <button
              :class="[
                selected
                  ? 'bg-slate-100 text-slate-700'
                  : 'border-transparent text-slate-900',
                'flex-1 whitespace-nowrap rounded-md py-1 px-1 text-left text-xs font-medium  outline-none ring-0 focus:outline-none focus:ring-0',
              ]">
              {{ tab.name }}
            </button>
          </Tab>
        </TabList>
      </template>
    </JovieSidebar>
    <main class="w-full flex-1">
      <div class="relative mx-auto max-w-7xl md:px-8 xl:px-0">
        <div class="pb-16">
          <div class="px-4 sm:px-6 md:px-0">
            <div class="pb-6">
              <!-- Tabs -->

              <div class="border-b border-slate-200"></div>

              <TabPanels as="template">
                <TabPanel class="mx-auto max-w-5xl space-y-12 px-4 py-6">
                  <AccountProfile />
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  <AccountPassword />
                </TabPanel>
              </TabPanels>
              <!--  <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  Notifications
                </TabPanel>
              </TabPanels> -->

              <TabPanels as="template">
                <TabPanel class="mx-auto max-w-5xl space-y-12 px-4 py-6">
                  <Subscription
                    title="Payment details"
                    subtitle="Update your billing information. Please note that updating your
          location could affect your tax rates." />
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="mx-auto max-w-5xl space-y-12 px-4 py-6">
                  <AccountTeam />
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  <AccountDelete />
                </TabPanel>
              </TabPanels>
            </div>
          </div>
        </div>
      </div>
    </main>
  </TabGroup>
</template>

<script>
import AccountTeam from '../components/Account/AccountTeam.vue';
import AccountProfile from '../components/Account/AccountProfile.vue';
import AccountDelete from '../components/Account/AccountDelete.vue';
import JovieSidebar from '../components/JovieSidebar.vue';

import { ref } from 'vue';
import {
  Dialog,
  DialogOverlay,
  Switch,
  SwitchGroup,
  SwitchLabel,
  TransitionChild,
  TransitionRoot,
  TabGroup,
  Tab,
  TabList,
  TabPanel,
  TabPanels,
  RadioGroup,
  RadioGroupLabel,
  RadioGroupOption,
  RadioGroupDescription,
} from '@headlessui/vue';
import {
  BellIcon,
  BriefcaseIcon,
  ChatBubbleLeftEllipsisIcon,
  CogIcon,
  DocumentMagnifyingGlassIcon,
  HomeIcon,
  Bars3BottomLeftIcon,
  QuestionMarkCircleIcon,
  UsersIcon,
  XMarkIcon,
} from '@heroicons/vue/24/outline';
import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid';
import ButtonGroup from '../components/ButtonGroup.vue';

const navigation = [
  { name: 'Home', href: '#', icon: HomeIcon, current: false },
  { name: 'Jobs', href: '#', icon: BriefcaseIcon, current: false },
  {
    name: 'Applications',
    href: '#',
    icon: DocumentMagnifyingGlassIcon,
    current: false,
  },
  {
    name: 'Messages',
    href: '#',
    icon: ChatBubbleLeftEllipsisIcon,
    current: false,
  },
  { name: 'Team', href: '#', icon: UsersIcon, current: false },
  { name: 'Settings', href: '#', icon: CogIcon, current: true },
];
const secondaryNavigation = [
  { name: 'Help', href: '#', icon: QuestionMarkCircleIcon },
  { name: 'Logout', href: '#', icon: CogIcon },
];
const tabs = [
  { name: 'General', href: '#', current: true },
  { name: 'Password', href: '#', current: false },
  { name: 'Billing', href: '#', current: false },
  { name: 'Team Members', href: '#', current: false },
  { name: 'Delete Account', href: '#', current: false },
];

import AccountPlan from '../components/Account/AccountPlan.vue';
import Subscribe from '../views/Subscribe';
import Subscription from '../components/Subscription';
import AccountPassword from '../components/Account/AccountPassword.vue';

const selectedTab = ref(0);

function changeTab(index) {
  selectedTab.value = index;
}
export default {
  components: {
    Subscription,
    Subscribe,
    Dialog,
    DialogOverlay,
    AccountDelete,
    Switch,
    SwitchGroup,
    SwitchLabel,
    TransitionChild,
    TransitionRoot,
    JovieSidebar,
    BellIcon,
    Bars3BottomLeftIcon,
    MagnifyingGlassIcon,
    XMarkIcon,
    AccountTeam,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    Tab,
    AccountPlan,
    RadioGroup,
    RadioGroupLabel,
    RadioGroupOption,
    RadioGroupDescription,
    ButtonGroup,
    AccountProfile,
    AccountPassword,
  },

  props: {
    defaultTab: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      navigation,
      secondaryNavigation,
      tabs,
    };
  },
};
</script>
