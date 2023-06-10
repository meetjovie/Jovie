<template>
  <!--  :class="[{ '-mt-20': $store.state.CRMSidebarOpen }, '-mt-10']" -->
  <div @mouseleave="handleMouseLeave()" class="flex">
    <div
      :class="[
        {
          'fixed -left-[270px] top-10 z-50 rounded border shadow-xl':
            sidebarStatus == 'hidden',
        },
        {
          'fixed bottom-2 left-2 top-10 z-50 h-3/4 rounded border pb-4 shadow-xl':
            sidebarStatus == 'float',
        },
        'flex h-screen w-[268px] flex-col justify-between overflow-auto border-r border-slate-200 bg-white px-3 py-3 dark:border-jovieDark-border dark:bg-jovieDark-900',
      ]">
      <div>
        <slot name="header">
          <div @click="setSidebarOpen()" class="w-full flex-col px-2">
            <div class="items-center" @click="navigateBack()" v-if="menu">
              <div
                class="items-cemter flex cursor-pointer text-lg font-medium tracking-wide text-slate-900 hover:text-slate-700 dark:text-jovieDark-400 dark:hover:text-white">
                <ChevronLeftIcon
                  class="mt-1.5 h-4 w-4 text-slate-400 dark:text-gray-200 dark:hover:text-gray-100"
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
                      class="flex w-full items-center justify-between rounded px-1 py-1 hover:bg-slate-150 dark:hover:bg-jovieDark-700">
                      <div class="group/teammenu flex items-center space-x-2">
                        <InitialBox
                          :emoji="currentUser.current_team.emoji"
                          :name="currentUser.current_team.name"
                          :height="18" />
                        <div
                          class="line-clamp-1 items-center text-sm font-normal tracking-wider text-slate-700 group-hover:text-slate-800 dark:text-jovieDark-100 dark:group-hover:text-slate-200">
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
                        class="border-b border-slate-200 px-4 pb-1 pt-2 text-xs font-semibold text-slate-700 dark:border-jovieDark-border dark:text-jovieDark-300">
                        {{ currentUser.email }}
                      </div>
                    </div>
                  </template>
                  <template #menuBottom>
                    <DropdownMenuItem separator />
                    <JovieMenuItem
                      component="SettingsWorkspace"
                      icon="CogIcon"
                      name="Workspace settings" />
                    <JovieMenuItem
                      component="SettingsWorkspace"
                      icon="PlusCircleIcon"
                      name="Create or join a workspace" />
                  </template>
                </JovieDropdownMenu>
              </div>
              <div class="items-center">
                <JovieDropdownMenu
                  :searchable="false"
                  size="md"
                  placement="bottom-start"
                  :items="profileMenuItems">
                  <template #triggerButton>
                    <ContactAvatar :height="6" :contact="currentUser" />
                    <!--  <img
                        class="inline-block aspect-square h-6 w-6 rounded-full border-2 border-slate-200 hover:bg-slate-100 dark:bg-jovieDark-700 dark:hover:bg-jovieDark-800"
                        :src="
                          $store.state.AuthState.user.profile_pic_url ??
                          $store.state.AuthState.user.default_image
                        "
                        alt="User Avatar" /> -->
                  </template>
                  <template #menuTop>
                    <div
                      class="flex w-full cursor-default justify-between px-4">
                      <div class="flex w-full items-center justify-between">
                        <p
                          class="justify-between truncate text-sm font-medium text-slate-700 group-hover:text-slate-900 dark:text-jovieDark-200 dark:group-hover:text-slate-200">
                          {{ currentUser.first_name }}
                          {{ currentUser.last_name }}
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
                      <DropdownMenuItem name="Admin" icon="ChartBarIcon" />
                    </router-link>
                    <DropdownMenuItem
                      shortcutKey="?"
                      shortcutSequence
                      @click="toggleShowSupportModal()"
                      name="Help"
                      icon="ChatBubbleLeftIcon" />
                    <div
                      class="border-t border-slate-200 dark:border-jovieDark-border"></div>
                    <DropdownMenuItem
                      :shortcutKey="
                        $store.state.platform === 'mac'
                          ? ['⌥', '⇧', 'Q']
                          : ['Alt', '⇧', 'Q']
                      "
                      @click="$store.dispatch('logout')"
                      name="Logout"
                      icon="ArrowLeftOnRectangleIcon" />
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
</template>

<script>
import {
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  Switch,
  SwitchGroup,
  TransitionRoot,
} from '@headlessui/vue';
import {
  ArchiveBoxIcon,
  ArrowLeftOnRectangleIcon,
  ArrowPathIcon,
  BellIcon,
  BoltIcon,
  ChartBarIcon,
  ChatBubbleLeftIcon,
  CheckIcon,
  ChevronDownIcon,
  ChevronLeftIcon,
  ChevronRightIcon,
  CloudArrowDownIcon,
  CloudArrowUpIcon,
  CogIcon,
  CreditCardIcon,
  EllipsisVerticalIcon,
  FireIcon,
  HeartIcon,
  LifebuoyIcon,
  MoonIcon,
  PlusCircleIcon,
  PlusIcon,
  RocketLaunchIcon,
  SunIcon,
  UserGroupIcon,
  UserIcon,
  WrenchScrewdriverIcon,
} from '@heroicons/vue/24/solid';
import ContactAvatar from './ContactAvatar.vue';
import JovieMenuItem from './JovieMenuItem.vue';

import { Float } from '@headlessui-float/vue';
import { LightBulbIcon, SparklesIcon } from '@heroicons/vue/24/outline';
import DropdownMenuItem from '../components/DropdownMenuItem.vue';
import InitialBox from '../components/InitialBox.vue';
import JovieDropdownMenu from '../components/JovieDropdownMenu.vue';
import JovieTooltip from '../components/JovieTooltip.vue';
import ProgressBar from '../components/ProgressBar.vue';
import UserService from '../services/api/user.service';

export default {
  components: {
    CreditCardIcon,
    UserIcon,
    ContactAvatar,
    InitialBox,
    CogIcon,
    JovieMenuItem,
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
    open: {
      type: Boolean,
      default: false,
    },
    sidebarStatus: {
      type: String,
      default: 'open',
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
          route: 'Settings',
          icon: CogIcon,
          shortcutKey: ['g', 's'],
          shortcutSequence: true,
        },
        /*   {
          id: 3,
          name: 'Billing',
          route: '/billing',
          icon: CreditCardIcon,
        }, */
        /*      {
          id: 6,
          name: 'Request a feature',
          route: '/request-a-feature',
          icon: LightBulbIcon,
        }, */
        /*   {
          id: 5,
          name: 'Download Chrome Extension',
          route: '/chrome-extension',
          icon: CloudArrowDownIcon,
        }, */

        {
          id: 7,
          name: "What's new",
          route: '/changelog',
          icon: SparklesIcon,
        },
        /*    {
          id: 4,
          name: 'Slack Community',
          route: '/slack-community',
          icon: LifebuoyIcon,
        }, */
      ],
    };
  },

  methods: {
    async logout() {
      await UserService.logout();
      this.$store.dispatch('logout');
    },
    setSidebarOpen() {
      this.$store.commit('setSidebarStatus', 'open');
    },
    toggleShowSupportModal() {
      //emit event to parent
      this.$emit('toggleShowSupportModal');
    },
    navigateBack() {
      this.$router.push({ name: 'Home' });
    },
    handleMouseLeave() {
      //if the store.state.sidebarStatus is not 'open' then wait half a second and then set the store.state.sidebarStatus to hidden else do nothing
      if (this.$store.state.sidebarStatus !== 'open') {
        setTimeout(() => {
          this.$store.commit('setSidebarStatus', 'hidden');
        }, 500);
      }
    },
  },
};
</script>
