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

    <div
      class="top-0 z-30 mx-auto flex h-screen w-60 flex-col justify-between overflow-hidden border-r border-slate-100 bg-white py-4 dark:border-slate-800 dark:bg-stone-900">
      <div>
        <slot name="header">
          <div class="w-full flex-col px-2">
            <div class="items-center" @click="navigateBack()" v-if="menu">
              <div
                class="items-cemter flex cursor-pointer justify-between text-xl font-light text-slate-900 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white">
                <ChevronLeftIcon
                  class="mr-2 h-5 w-5 text-slate-400 dark:text-gray-200 dark:hover:text-gray-100"
                  aria-hidden="true" />
                {{ menu || 'Back' }}
              </div>
            </div>
            <div v-else class="flex h-8 w-full items-center justify-between">
              <!-- <SwitchTeams /> -->
              <JovieDropdownMenu
                :items="currentUser.teams"
                :numbered="true"
                size="md"
                :searchable="false">
                <template #triggerButton>
                  <div
                    class="flex w-full items-center justify-between rounded-md px-2 py-1 hover:bg-slate-200 dark:hover:bg-slate-800">
                    <div class="flex">
                      <div
                        class="items-center text-2xs font-medium text-slate-700 line-clamp-1 group-hover:text-slate-800 dark:text-slate-300 dark:group-hover:text-slate-200">
                        {{
                          currentUser.current_team
                            ? currentUser.current_team.name
                            : 'Select a team'
                        }}
                      </div>
                    </div>
                  </div>
                </template>
                <template #menuTop>
                  <div class="">
                    <div
                      class="border-b border-slate-200 px-4 pt-2 pb-1 text-center text-xs font-semibold text-slate-700 dark:border-slate-600 dark:text-slate-300">
                      Your workspaces:
                    </div>
                  </div>
                </template>
                <template #menuBottom>
                  <router-link
                    to="/accounts"
                    class="group rounded-md px-1 py-1 text-center text-sm font-medium hover:bg-slate-200 hover:text-slate-700 dark:hover:bg-slate-700 dark:hover:text-slate-300"
                    :class="[
                      active
                        ? 'bg-white px-1 py-2 text-slate-800 dark:bg-slate-900 dark:text-slate-200'
                        : 'text-sm text-slate-700 dark:text-slate-300',
                      'group flex w-full items-center px-2 py-2 text-2xs  ',
                    ]">
                    <PlusCircleIcon
                      :active="active"
                      class="mr-2 h-4 w-4 text-slate-500 dark:text-slate-300"
                      aria-hidden="true" />
                    Create workspace
                  </router-link>
                </template>
              </JovieDropdownMenu>
              <div class="items-center">
                <JovieDropdownMenu
                  :searchable="false"
                  :items="profileMenuItems">
                  <template #triggerButton>
                    <img
                      class="inline-block aspect-square h-6 w-6 rounded-full border border-slate-200 hover:bg-slate-100 dark:border-slate-600 dark:hover:bg-slate-800"
                      :src="
                        $store.state.AuthState.user.profile_pic_url ??
                        $store.state.AuthState.user.default_image
                      "
                      alt="User Avatar" />
                  </template>
                  <template #menuTop>
                    <div class="ml-3 cursor-default">
                      <p
                        class="justify-between text-xs font-medium text-slate-700 group-hover:text-slate-900 dark:text-slate-200 dark:group-hover:text-slate-200">
                        {{ currentUser.first_name }}
                        {{ currentUser.last_name }}
                      </p>

                      <p
                        class="text-2xs font-medium text-slate-400 group-hover:text-slate-700">
                        {{ currentUser.email }}
                      </p>
                    </div>
                    <MenuItem
                      as="div"
                      class="overflow-y-scroll"
                      role="menuitem"
                      tabindex="-1">
                      <router-link
                        v-if="currentUser.username"
                        class="flex w-full cursor-pointer px-4 py-1 text-xs text-slate-700 dark:text-slate-100"
                        :to="profileLink">
                        <div
                          class="group mt-1 flex w-full cursor-pointer items-center rounded-md text-xs text-slate-600 dark:text-slate-200"
                          :class="{
                            'bg-slate-200 text-slate-700 dark:bg-slate-700 dark:text-slate-100':
                              active,
                          }">
                          <component
                            class="mr-4 h-4 w-4 cursor-pointer"
                            is="UserIcon">
                          </component
                          >Your profile
                        </div>
                      </router-link>
                      <router-link
                        v-else
                        class="flex w-full cursor-pointer px-4 py-2 text-xs text-slate-700 dark:text-slate-300"
                        to="edit-profile">
                        <div
                          class="group mt-1 flex w-full cursor-pointer items-center rounded-md text-xs text-slate-600 dark:text-slate-400"
                          :class="{
                            'bg-slate-300 text-slate-700 dark:bg-slate-700 dark:text-slate-100':
                              active,
                          }">
                          <component
                            class="mr-4 h-4 w-4 cursor-pointer"
                            is="WrenchScrewdriverIcon">
                          </component
                          >Setup profile
                        </div>
                      </router-link>
                    </MenuItem>
                    <MenuItem
                      v-if="currentUser.is_admin"
                      as="div"
                      role="menuitem"
                      tabindex="-1">
                      <router-link
                        class="flex w-full cursor-pointer px-4 py-2 text-xs text-slate-700 dark:text-slate-300"
                        to="/admin">
                        <div
                          class="group mt-1 flex w-full cursor-pointer items-center rounded-md text-xs text-slate-600 dark:text-slate-200"
                          :class="{
                            'bg-slate-300 text-slate-700 dark:bg-slate-700 dark:text-slate-100':
                              active,
                          }">
                          <component
                            class="mr-4 h-4 w-4 cursor-pointer"
                            is="ChartBarIcon">
                          </component
                          >Admin
                        </div>
                      </router-link>
                    </MenuItem>
                  </template>

                  <template #menuBottom>
                    <div
                      class="border-t border-slate-200/40 dark:border-slate-600/40">
                      <MenuItem
                        as="div"
                        @click="$store.dispatch('logout')"
                        class="inline-flex w-full cursor-pointer rounded-md px-4 py-1 text-xs text-slate-700 hover:bg-slate-200 hover:text-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100"
                        role="menuitem"
                        tabindex="-1">
                        <component
                          class="mr-4 h-4 w-4"
                          is="ArrowLeftOnRectangleIcon">
                        </component>
                        Sign out
                      </MenuItem>
                    </div>
                  </template>
                </JovieDropdownMenu>
              </div>
            </div>
          </div>
        </slot>

        <slot name="main"> Main </slot>
      </div>
      <slot name="footer"> </slot>
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
  ChartBarIcon,
} from '@heroicons/vue/24/solid';

import { LightBulbIcon, SparklesIcon } from '@heroicons/vue/24/outline';
import JovieTooltip from '../components/JovieTooltip';
import UserService from '../services/api/user.service';
import ProgressBar from '../components/ProgressBar';
import { Float } from '@headlessui-float/vue';
import JovieDropdownMenu from '../components/JovieDropdownMenu.vue';

export default {
  components: {
    CreditCardIcon,
    UserIcon,
    CogIcon,
    BoltIcon,
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
          icon: 'CogIcon',
        },
        {
          id: 3,
          name: 'Billing',
          route: '/billing',
          icon: 'CreditCardIcon',
        },
        {
          id: 6,
          name: 'Request a feature',
          route: '/request-a-feature',
          icon: LightBulbIcon,
        },
        {
          id: 5,
          name: 'Chrome Extension',
          route: '/chrome-extension',
          icon: 'CloudArrowDownIcon',
        },
        {
          id: 1,
          name: "What's new",
          route: '/changelog',
          icon: SparklesIcon,
        },
        {
          id: 4,
          name: 'Slack Community',
          route: '/slack-community',
          icon: 'LifebuoyIcon',
        },
      ],
    };
  },

  methods: {
    async logout() {
      await UserService.logout();
      this.$store.dispatch('logout');
    },
    navigateBack() {
      this.$router.go(-1);
    },
  },
};
</script>
