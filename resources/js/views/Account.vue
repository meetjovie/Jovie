<template>
  <main class="flex-1">
    <div class="relative mx-auto max-w-4xl md:px-8 xl:px-0">
      <div class="pt-10 pb-16">
        <div class="px-4 sm:px-6 md:px-0">
          <h1 class="text-3xl font-extrabold text-gray-900">Settings</h1>
        </div>
        <div class="px-4 sm:px-6 md:px-0">
          <div class="py-6">
            <!-- Tabs -->
            <TabGroup as="div" class="mt-2">
              <div class="border-b border-gray-200">
                <TabList class="-mb-px flex space-x-8 px-4">
                  <Tab
                    as="template"
                    v-for="tab in tabs"
                    :key="tab.name"
                    v-slot="{ selected }">
                    <button
                      :class="[
                        selected
                          ? 'border-indigo-600 text-indigo-600'
                          : 'border-transparent text-gray-900',
                        'flex-1 whitespace-nowrap border-b-2 py-4 px-1 text-base font-medium',
                      ]">
                      {{ tab.name }}
                    </button>
                  </Tab>
                </TabList>
              </div>

              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  <AccountProfile />
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  Password (Coming soon)
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  Notifications
                </TabPanel>
              </TabPanels>

              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  <Subscription
                    title="Payment details"
                    subtitle="Update your billing information. Please note that updating your
          location could affect your tax rates." />
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  <AccountTeam />
                </TabPanel>
              </TabPanels>
            </TabGroup>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import AccountTeam from '../components/Account/AccountTeam.vue';
import AccountProfile from '../components/Account/AccountProfile.vue';

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
  ChatIcon,
  CogIcon,
  DocumentSearchIcon,
  HomeIcon,
  MenuAlt2Icon,
  QuestionMarkCircleIcon,
  UsersIcon,
  XIcon,
} from '@heroicons/vue/outline';
import { SearchIcon } from '@heroicons/vue/solid';
import ButtonGroup from '../components/ButtonGroup.vue';

const navigation = [
  { name: 'Home', href: '#', icon: HomeIcon, current: false },
  { name: 'Jobs', href: '#', icon: BriefcaseIcon, current: false },
  { name: 'Applications', href: '#', icon: DocumentSearchIcon, current: false },
  { name: 'Messages', href: '#', icon: ChatIcon, current: false },
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
  { name: 'Notifications', href: '#', current: false },
  { name: 'Billing', href: '#', current: false },
  { name: 'Team Members', href: '#', current: false },
];

import AccountPlan from '../components/Account/AccountPlan.vue';
import Subscribe from '../views/Subscribe';
import Subscription from '../components/Subscription';

export default {
  components: {
    Subscription,
    Subscribe,
    Dialog,
    DialogOverlay,
    Switch,
    SwitchGroup,
    SwitchLabel,
    TransitionChild,
    TransitionRoot,
    BellIcon,
    MenuAlt2Icon,
    SearchIcon,
    XIcon,
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
