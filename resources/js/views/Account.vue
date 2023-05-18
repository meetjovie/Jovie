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
                  ? 'bg-slate-100 text-slate-700 dark:bg-jovieDark-700 dark:text-jovieDark-300'
                  : 'border-transparent text-slate-900 dark:text-jovieDark-100',
                'flex-1 whitespace-nowrap rounded-md px-1 py-1 text-left text-xs font-medium  outline-none ring-0 focus:outline-none focus:ring-0',
              ]">
              <componenet :is="tab.icon" class="mr-1 h-4 w-4" />
              {{ tab.name }}
            </button>
          </Tab>
        </TabList>
      </template>
    </JovieSidebar>
    <main class="w-full flex-1 overflow-y-scroll dark:bg-jovieDark-900">
      <div class="relative mx-auto md:px-8 xl:px-0">
        <div class="pb-16">
          <div class="px-4 sm:px-6 md:px-0">
            <div class="pb-6">
              <!-- Tabs -->

              <div
                class="overflow-auto border-b border-slate-200 dark:border-jovieDark-border"></div>

              <TabPanels as="template">
                <TabPanel
                  class="mx-auto space-y-12 overflow-y-scroll px-4 py-6">
                  <AccountProfile />
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  <AccountPassword />
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  <AccountTeamSetting />
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
import AccountTeamSetting from '../components/Account/AccountTeamSetting.vue';
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
  CreditCardIcon,
  TrashIcon,
  LockClosedIcon,
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
  { name: 'General', href: '#', current: true, icon: CogIcon },
  { name: 'Password', href: '#', current: false, icon: LockClosedIcon },
  { name: 'Workspace', href: '#', current: false, icon: UsersIcon },

  { name: 'Plan & Billing', href: '#', current: false, icon: CreditCardIcon },
  { name: 'Team Members', href: '#', current: false, icon: UsersIcon },
];

import Subscribe from '../views/Subscribe.vue';
import Subscription from '../components/Subscription.vue';
import AccountPassword from '../components/Account/AccountPassword.vue';

const selectedTab = ref(0);

function changeTab(index) {
  selectedTab.value = index;
}
export default {
  components: {
    Subscription,
    Subscribe,
    LockClosedIcon,
    CreditCardIcon,
    TrashIcon,
    Dialog,
    DialogOverlay,

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

    RadioGroup,
    RadioGroupLabel,
    RadioGroupOption,
    RadioGroupDescription,
    ButtonGroup,
    AccountProfile,
    AccountPassword,
    AccountTeamSetting,
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
