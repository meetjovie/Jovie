<template>
  <TransitionRoot
    :show="$store.state.CRMSidebarOpen"
    enter="transition ease-in-out duration-300 transform"
    enter-from="-translate-x-full"
    enter-to="translate-x-0"
    leave="transition ease-in-out duration-300 transform"
    leave-from="translate-x-0"
    leave-to="-translate-x-full">
    <!--  :class="[{ '-mt-20': $store.state.CRMSidebarOpen }, '-mt-10']" -->
    <div class="flex">
      <div
        class="min-w-60 max-w-96 overflow-none top-0 z-30 mx-auto flex h-screen w-60 flex-col justify-between overflow-auto border-r border-slate-100 bg-white py-4 dark:border-jovieDark-border dark:bg-jovieDark-900">
        <div>
          <slot name="header">
            <div class="w-full flex-col px-2">
              <div class="items-center" @click="navigateBack()" v-if="menu">
                <div
                  class="items-cemter flex cursor-pointer text-lg font-medium tracking-wide text-slate-900 hover:text-slate-700 dark:text-jovieDark-400 dark:hover:text-white">
                  <ChevronLeftIcon
                    class="h-4 w-4 text-slate-400 dark:text-gray-200 dark:hover:text-gray-100"
                    aria-hidden="true" />
                  <span class="ml-2 items-center">{{ menu || 'Back' }}</span>
                </div>
              </div>
              <div v-else class="flex h-8 w-full items-center justify-between">
                <!-- <SwitchTeams /> -->
                <div>
                  <JovieDropdownMenu
                    :items="currentUser.teams"
                    :activeItem="currentUser.current_team.id"
                    :numbered="true"
                    placement="bottom-start"
                    size="lg"
                    :searchable="false">
                    <template #triggerButton>
                      <div
                        class="flex w-full items-center justify-between rounded-md px-2 py-1 hover:bg-slate-200 dark:hover:bg-jovieDark-700">
                        <div class="group/teammenu flex items-center space-x-1">
                          <InitialBox
                            :name="currentUser.current_team.name"
                            :height="18" />
                          <div
                            class="line-clamp-1 items-center text-2xs font-medium text-slate-700 group-hover:text-slate-800 dark:text-jovieDark-300 dark:group-hover:text-slate-200">
                            {{
                              currentUser.current_team
                                ? currentUser.current_team.name
                                : 'Select a team'
                            }}
                          </div>
                          <ChevronDownIcon
                            class="group/teammenu-hover:dark:text-jovieDark-200 group/teammenu-hover:text-slate-700 h-4 w-4 text-slate-700/0 dark:text-jovieDark-200/0" />
                        </div>
                      </div>
                    </template>
                    <template #menuTop>
                      <div class="">
                        <div
                          class="border-b border-slate-200 px-4 pb-1 pt-2 text-center text-xs font-semibold text-slate-700 dark:border-jovieDark-border dark:text-jovieDark-300">
                          Your workspaces:
                        </div>
                      </div>
                    </template>
                    <template #menuBottom>
                      <router-link
                        to="/accounts"
                        class="group rounded-md px-1 py-1 text-center text-sm font-medium hover:bg-slate-200 hover:text-slate-700 dark:hover:bg-jovieDark-border dark:hover:text-slate-300"
                        :class="[
                          active
                            ? 'bg-white px-1 py-2 text-slate-800 dark:bg-jovieDark-700 dark:text-jovieDark-200'
                            : 'text-sm text-slate-700 dark:text-jovieDark-300',
                          'group flex w-full items-center px-2 py-2 text-xs  ',
                        ]">
                        <PlusCircleIcon
                          :active="active"
                          class="mr-2 h-4 w-4 text-slate-500 dark:text-jovieDark-300"
                          aria-hidden="true" />
                        Create workspace
                      </router-link>
                    </template>
                  </JovieDropdownMenu>
                </div>
                <div class="items-center">
                  <JovieDropdownMenu
                    :searchable="false"
                    size="lg"
                    placement="bottom-start"
                    :items="profileMenuItems">
                    <template #triggerButton>
                      <img
                        class="inline-block aspect-square h-6 w-6 rounded-full border-2 border-slate-200 hover:bg-slate-100 dark:bg-jovieDark-700 dark:hover:bg-jovieDark-800"
                        :src="
                          $store.state.AuthState.user.profile_pic_url ??
                          $store.state.AuthState.user.default_image
                        "
                        alt="User Avatar" />
                    </template>
                    <template #menuTop>
                      <div
                        class="mt-2 flex w-full cursor-default justify-between px-4">
                        <div>
                          <p
                            class="justify-between text-xs font-medium text-slate-700 group-hover:text-slate-900 dark:text-jovieDark-200 dark:group-hover:text-slate-200">
                            {{ currentUser.first_name }}
                            {{ currentUser.last_name }}
                          </p>

                          <p
                            class="text-2xs font-medium text-slate-400 group-hover:text-slate-700">
                            {{ currentUser.email }}
                          </p>
                        </div>
                        <div>
                          <router-link
                            v-if="currentUser.username"
                            :to="profileLink">
                            <DropdownMenuItem
                              name="View profile"
                              :icon="UserIcon" />
                          </router-link>
                          <!-- <router-link v-else to="edit-profile">
                            <DropdownMenuItem
                              name="Setup profile"
                              icon="WrenchScrewdriverIcon" />
                          </router-link> -->
                        </div>
                      </div>
                    </template>

                    <template #menuBottom>
                      <router-link v-if="currentUser.is_admin" to="/admin">
                        <DropdownMenuItem
                          name="Admin Dashboard"
                          icon="ChartBarIcon" />
                      </router-link>
                      <DropdownMenuItem
                        shortcutKey="?"
                        shortcutSequence
                        @click="toggleShowSupportModal()"
                        name="Get Help"
                        icon="ChatBubbleLeftIcon" />
                      <div
                        class="my-1 border-t border-slate-200 dark:border-jovieDark-border"></div>
                      <DropdownMenuItem
                        :shortcutKey="
                          $store.state.platform === 'mac'
                            ? ['⌥', '⇧', 'Q']
                            : ['Alt', '⇧', 'Q']
                        "
                        @click="$store.dispatch('logout')"
                        name="Logout"
                        icon="ArrowLeftOnRectangleIcon" />

                      <div class="flex justify-end">
                        <span
                          class="text-right text-[8px] text-slate-400 dark:text-jovieDark-400">
                          {{ $store.state.jovieVersion }}
                        </span>
                      </div>
                    </template>
                  </JovieDropdownMenu>
                </div>
              </div>
            </div>
          </slot>
          <div class="">
            <slot name="main"> Main </slot>
          </div>
        </div>
        <slot name="footer"> </slot>
      </div>
    </div>
  </TransitionRoot>
</template>

<script>
import {
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
  TransitionRoot,
  SwitchGroup,
  Switch,
} from '@headlessui/vue';
import {
  ChevronDownIcon,
  CreditCardIcon,
  ChevronLeftIcon,
  CogIcon,
  ChevronRightIcon,
  CloudArrowDownIcon,
  CheckIcon,
  UserGroupIcon,
  EllipsisVerticalIcon,
  PlusIcon,
  PlusCircleIcon,
  HeartIcon,
  UserIcon,
  ArchiveBoxIcon,
  CloudArrowUpIcon,
  ArrowLeftOnRectangleIcon,
  ArrowPathIcon,
  BellIcon,
  SunIcon,
  FireIcon,
  RocketLaunchIcon,
  MoonIcon,
  BoltIcon,
  WrenchScrewdriverIcon,
  ComputerDesktopIcon,
  LifebuoyIcon,
  ChartBarIcon,
  ChatBubbleLeftIcon,
} from '@heroicons/vue/24/solid';

import { LightBulbIcon, SparklesIcon } from '@heroicons/vue/24/outline';
import JovieTooltip from '../components/JovieTooltip.vue';
import UserService from '../services/api/user.service';
import ProgressBar from '../components/ProgressBar.vue';
import InitialBox from '../components/InitialBox.vue';
import { Float } from '@headlessui-float/vue';
import JovieDropdownMenu from '../components/JovieDropdownMenu.vue';
import DropdownMenuItem from '../components/DropdownMenuItem.vue';

export default {
  components: {
    CreditCardIcon,
    UserIcon,
    InitialBox,
    CogIcon,
    DropdownMenuItem,
    BoltIcon,
    LifebuoyIcon,
    ArrowPathIcon,
    Float,
    CloudArrowDownIcon,
    PlusIcon,
    PlusCircleIcon,
    Menu,
    SwitchGroup,
    Switch,
    SunIcon,
    ChartBarIcon,
    MoonIcon,
    MenuItem,
    MenuItems,

    HeartIcon,
    RocketLaunchIcon,

    ProgressBar,
    TransitionRoot,
    ChevronRightIcon,
    EllipsisVerticalIcon,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    ChevronDownIcon,

    SparklesIcon,
    FireIcon,
    ChatBubbleLeftIcon,
    CheckIcon,
    ArchiveBoxIcon,
    ArrowLeftOnRectangleIcon,
    UserGroupIcon,
    CloudArrowUpIcon,
    JovieTooltip,
    ChevronLeftIcon,

    LightBulbIcon,
    JovieDropdownMenu,
    WrenchScrewdriverIcon,

    BellIcon,
  },
  props: {
    menu: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      darkmode: false,
      profileLink: this.$store.state.AuthState.user.username,
      profileMenuItems: [
        {
          id: 2,
          name: 'Settings',
          route: 'Account',
          icon: CogIcon,
          shortcutKey: ['g', 's'],
          shortcutSequence: true,
        },
        {
          id: 3,
          name: 'Billing',
          route: '/billing',
          icon: CreditCardIcon,
        },
        {
          id: 6,
          name: 'Request a feature',
          route: '/request-a-feature',
          icon: LightBulbIcon,
        },
        {
          id: 5,
          name: 'Download Chrome Extension',
          route: '/chrome-extension',
          icon: CloudArrowDownIcon,
        },

        {
          id: 7,
          name: "What's new",
          route: '/changelog',
          icon: SparklesIcon,
        },
        {
          id: 4,
          name: 'Slack Community',
          route: '/slack-community',
          icon: LifebuoyIcon,
        },
      ],
    };
  },

  methods: {
    async logout() {
      await UserService.logout();
      this.$store.dispatch('logout');
    },
    toggleShowSupportModal() {
      //emit event to parent
      this.$emit('toggleShowSupportModal');
    },
    navigateBack() {
      this.$router.go(-1);
    },
  },
};
</script>
