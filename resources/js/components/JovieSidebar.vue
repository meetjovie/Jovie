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
      class="top-0 z-30 mx-auto flex h-screen w-60 flex-col justify-between overflow-hidden border-r border-slate-100 bg-white py-4 dark:border-gray-700 dark:bg-gray-900">
      <div>
        <slot name="header">
          <div class="w-full flex-col px-2">
            <div @click="navigateBack()" v-if="menu">
              <div
                class="items-cemter flex cursor-pointer justify-between text-xl font-light text-slate-600 text-slate-900 hover:text-slate-700 dark:text-gray-300 dark:hover:text-gray-200">
                <ChevronLeftIcon
                  class="mr-2 h-5 w-5 text-slate-400 dark:text-gray-300 dark:hover:text-gray-200"
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
                    class="flex w-full items-center justify-between rounded-md px-2 py-1 hover:bg-slate-100">
                    <div class="flex">
                      <div
                        class="items-center text-2xs font-medium text-slate-700 line-clamp-1 group-hover:text-slate-800">
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
                      class="border-b px-4 pt-2 pb-1 text-center text-xs font-semibold text-slate-700">
                      Your workspaces:
                    </div>
                  </div>
                </template>
                <template #menuBottom>
                  <router-link
                    to="/accounts"
                    class="group rounded-md px-1 py-1 text-center text-sm font-medium hover:bg-slate-200 hover:text-slate-700"
                    :class="[
                      active
                        ? 'bg-white px-1 py-2  text-slate-800'
                        : 'text-sm text-slate-700',
                      'group flex w-full items-center px-2 py-2 text-2xs  ',
                    ]">
                    <PlusCircleIcon
                      :active="active"
                      class="mr-2 h-4 w-4 text-slate-500"
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
                    <div
                      class="mx-auto h-6 w-6 items-center rounded-full border border-neutral-200 hover:bg-slate-100">
                      <img
                        class="h-5 w-5 items-center rounded-full object-cover"
                        :src="
                          $store.state.AuthState.user.profile_pic_url ??
                          $store.state.AuthState.user.default_image
                        "
                        alt="User Avatar" />
                    </div>
                  </template>
                  <template #menuTop>
                    <div class="ml-3 cursor-default">
                      <p
                        class="justify-between text-xs font-medium text-slate-700 group-hover:text-slate-900">
                        {{ currentUser.first_name }}
                        {{ currentUser.last_name }}
                      </p>

                      <p
                        class="text-2xs font-medium text-slate-400 group-hover:text-slate-700">
                        {{ currentUser.email }}
                      </p>
                    </div>
                    <MenuItem as="div" role="menuitem" tabindex="-1">
                      <router-link
                        v-if="currentUser.username"
                        class="flex w-full cursor-pointer px-4 py-2 text-xs text-slate-700 hover:bg-slate-100 hover:text-slate-700"
                        :to="profileLink">
                        <div
                          class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-slate-600"
                          :class="{
                            'bg-slate-200 text-slate-700': active,
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
                        class="flex w-full cursor-pointer px-4 py-2 text-xs text-slate-700 hover:bg-slate-100 hover:text-slate-700"
                        to="edit-profile">
                        <div
                          class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-slate-600"
                          :class="{
                            'bg-slate-200 text-slate-700': active,
                          }">
                          <component
                            class="mr-4 h-4 w-4 cursor-pointer"
                            is="CogIcon">
                          </component
                          >Setup Your profile
                        </div>
                      </router-link>
                    </MenuItem>
                  </template>

                  <template #menuBottom>
                    <MenuItem
                      as="div"
                      @click="$store.dispatch('logout')"
                      class="inline-flex w-full cursor-pointer rounded-b-md px-4 py-2 text-xs text-slate-700 hover:bg-slate-100 hover:text-slate-700"
                      role="menuitem"
                      tabindex="-1">
                      <component
                        class="mr-4 h-4 w-4"
                        is="ArrowLeftOnRectangleIcon">
                      </component>
                      Sign out
                    </MenuItem>
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
  TransitionChild,
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverGroup,
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
} from '@heroicons/vue/24/solid';
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
    ArrowPathIcon,
    Float,
    CloudArrowDownIcon,
    PlusIcon,
    PlusCircleIcon,
    Menu,
    MenuItem,
    MenuItems,
    PopoverGroup,
    Popover,
    PopoverButton,
    PopoverPanel,
    HeartIcon,
    ProgressBar,
    TransitionRoot,
    ChevronRightIcon,
    EllipsisVerticalIcon,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    ChevronDownIcon,
    CheckIcon,
    ArchiveBoxIcon,
    ArrowLeftOnRectangleIcon,
    UserGroupIcon,
    CloudArrowUpIcon,
    JovieTooltip,
    ChevronLeftIcon,

    TransitionChild,
    JovieDropdownMenu,
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
          id: 4,
          name: 'Slack Community',
          route: '/slack-community',
          icon: 'LifebuoyIcon',
        },
        {
          id: 5,
          name: 'Chrome Extension',
          route: '/chrome-extension',
          icon: 'CloudArrowDownIcon',
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
