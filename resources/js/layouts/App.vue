<template>
  <div
    id="app"
    class="flex h-screen overflow-hidden bg-slate-100 transition-all duration-1000 ease-in-out">
    <!-- <div
      id="overlay"
      class="fixed inset-0 z-30 flex md:hidden"
      role="dialog"
      aria-modal="true">
      <div
        class="fixed inset-0 bg-slate-600 bg-opacity-75"
        aria-hidden="true"></div>
      <div
        id="sidebar"
        class="relative flex w-full flex-1 flex-col bg-slate-500/50 pt-5 pb-4 backdrop-blur-md">
        <div class="mx-auto flex h-screen w-full items-center justify-center">
          <a href="{{ route('dashboard') }}">
            <JovieLogo color="#ffffff" height="40px" />
            <h2
              class="align-center mt-4 flex text-center text-sm font-bold text-white opacity-90">
              Your screen is too small. Jovie is built for larger devices. If
              you'd like to use Jovie on your phone, please let us know.
            </h2>
          </a>
        </div>
      </div>
    </div> -->
    <!-- Narrow sidebar -->

    <div class="z-10 flex w-0 flex-1 flex-col overflow-hidden">
      <main
        class="relative flex-1 overflow-y-auto overflow-x-hidden focus-visible:outline-none"
        id="main">
        <div class="h-full">
          <div class="mx-auto h-full">
            <CommandPallette as="div" :open="showCommandPallette" />

            <AlertBanner
              v-if="currentUser.current_team.credits < 1"
              design="danger"
              :mobiletitle="`You're out of credits`"
              :title="`You're out of credits.`"
              :cta="`Upgrade`"
              ctaLink="Billing" />
            <AlertBanner
              class="hidden sm:block"
              v-else-if="$store.state.chromeExtensionInstalled === false"
              design="primary"
              :mobiletitle="`Install Jovie Chrome Extension`"
              :title="`Looks like you're missing the best part!`"
              :cta="`Install Chrome Extension`"
              ctaLink="Chrome Extension" />
            <router-view></router-view>
          </div>
        </div>
      </main>
    </div>
    <NotificationGroup group="user">
      <!-- Global notification live region, render this permanently at the end of the document -->
      <div
        aria-live="assertive"
        class="pointer-events-none absolute top-0 right-0 z-50 mr-4 mt-4 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
          <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->

          <Notification
            closeOnClick="true"
            v-slot="{ notifications }"
            enter="transform ease-out duration-300 transition"
            enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
            enter-to="translate-y-0 opacity-100 sm:translate-x-0"
            leave="transition ease-in duration-500"
            leave-from="opacity-100"
            leave-to="opacity-0"
            move="transition duration-500"
            move-delay="delay-300">
            <div
              class="mx-auto mt-4 flex w-80 max-w-sm overflow-hidden rounded-lg border border-slate-200 bg-white/60 bg-clip-padding shadow-md backdrop-blur-2xl backdrop-saturate-150 dark:border-slate-700 dark:bg-slate-900/60"
              v-for="notification in notifications"
              :key="notification.id">
              <button
                class="absolute top-0 right-0 m-2"
                @click="notification.close">
                <XIcon class="h-5 w-5 text-slate-400 dark:text-slate-100" />
              </button>
              <div
                class="flex w-10 items-center justify-center bg-slate-200 dark:bg-slate-800">
                <XMarkIcon
                  v-if="notification.type === 'error'"
                  class="h-4 w-4 text-red-500" />
                <ExclamationTriangleIcon
                  v-else-if="notification.type === 'warning'"
                  class="h-4 w-4 text-amber-500" />
                <CheckCircleIcon
                  v-else
                  class="h-4 w-4"
                  :class="[
                    { 'text-red-500': notification.type === 'error' },
                    { 'text-green-500': notification.type === 'success' },
                    { 'text-amber-500': notification.type === 'warning' },
                  ]" />
              </div>

              <div class="-mx-3 px-4 py-2">
                <div class="mx-3">
                  <span
                    class="text-xs font-semibold text-slate-600 dark:text-slate-100"
                    >{{ notification.title }}</span
                  >
                  <p class="text-xs text-slate-400 dark:text-slate-100">
                    {{ notification.text }}
                  </p>
                </div>
              </div>
            </div>
          </Notification>
        </div>
      </div>
    </NotificationGroup>
  </div>
</template>

<script>
import {
  HomeIcon,
  Bars3Icon,
  MagnifyingGlassIcon,
  EnvelopeIcon,
  ChartBarIcon,
  ChevronLeftIcon,
  CheckCircleIcon,
  ExclamationTriangleIcon,
  CreditCardIcon,
  CloudArrowUpIcon,
  UserGroupIcon,
  FolderOpenIcon,
  CogIcon,
  UserIcon,
  XMarkIcon,
  BellIcon,
  CursorArrowRippleIcon,
  ChatBubbleLeftEllipsisIcon,
  ArrowLeftOnRectangleIcon,
  AdjustmentsHorizontalIcon,
  MegaphoneIcon,
  LifebuoyIcon,
  FaceSmileIcon,
  CloudArrowDownIcon,
} from '@heroicons/vue/24/outline';

import { ArrowPathIcon } from '@heroicons/vue/24/solid';

import {
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverGroup,
  TransitionRoot,
} from '@headlessui/vue';

import AlertBanner from '../components/AlertBanner';
import JovieLogo from '../components/JovieLogo';
import CommandPallette from '../components/CommandPallette';
import ImportService from '../services/api/import.service';
import ProgressBar from '../components/ProgressBar.vue';
import SwitchTeams from '../components/SwitchTeams.vue';
import XCircle from '../../../vendor/laravel/vapor-ui/resources/js/components/icons/XCircle.vue';

export default {
  name: 'App',
  data() {
    return {
      errors: [],
      showAppMenu: false,
      previewAppMenu: false,
      showCommandPallette: false,
      user: this.$store.state.AuthState.user,

      nav: [
        /* /*  /*  { name: 'Admin', route: '/admin', icon: CheckCircleIcon }, */
        /*  { name: 'Dashboard', route: '/dashboard', icon: HomeIcon }, */
        /*  { name: 'Search', route: '/discovery', icon: MagnifyingGlassIcon }, */
        { name: 'Contacts', route: '/contacts', icon: HomeIcon },
        //add a link for profile
        { name: 'Profile', route: '/edit-profile', icon: UserIcon },

        /* { name: 'Pipeline', route: '/pipeline', icon: AdjustmentsHorizontalIcon }, */
        /*  { name: 'Import', route: '/import', icon: CloudArrowUpIcon }, */
        /* { name: 'Settings', route: '/account', icon: CogIcon }, */
      ],
      dropdownmenuitems: [
        {
          name: 'Chrome Extension',
          route: '/chrome-extension',
          badge: 'Download',
          badgeColor: 'pink',
          icon: CloudArrowDownIcon,
        },
        { name: 'Billing', route: '/billing', icon: CreditCardIcon },
        { name: 'Settings', route: 'Account', icon: CogIcon },
      ],
      helpmenuitems: [
        { name: 'Shortcuts', route: 'Account', icon: CursorArrowRippleIcon },
        { name: 'Feedback', route: 'Account', icon: MegaphoneIcon },
      ],
      isShowing: false,
      isLoading: false,
      notifications: [],
      newNotification: false,
    };
  },

  mounted() {
    //check local storage for the value of CRM sidebar
    console.log('CRMSidebarOpen', localStorage.getItem('CRMSidebarOpen'));
    console.log(
      'CRMSidebarOpen',
      typeof localStorage.getItem('CRMSidebarOpen')
    );
    if (localStorage.getItem('CRMSidebarOpen') === 'false') {
      this.$store.state.CRMSidebarOpen = false;
    }

    //check for darkmode

    // On page load or when changing themes, best to add inline in `head` to avoid FOUC

    if (
      localStorage.theme === 'dark' ||
      (!('theme' in localStorage) &&
        window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }

    //identify call to segment
    window.analytics.identify(this.user.email, {
      email: this.user.email,
      name: this.user.first_name + ' ' + this.user.last_name,
      plan: this.user.plan,
      team: this.user.team,
      user_id: this.user.id,
    });
    this.$mousetrap.bind(['command+k', 'ctrl+k'], () => {
      this.toggleCommandPallette();
    });
    //toggle the sidebar when hitting cmd + q or ctrl + q
    this.$mousetrap.bind(['esc'], () => {
      this.toggleShowAppMenu();
    });

    // this.getNotifications();
    // setInterval(() => {
    //   this.getNotifications();
    // }, 5000);
    this.listenEvents(
      `notification.${this.currentUser.current_team.id}`,
      'Notification',
      (data) => {
        this.newNotification = true;
      }
    );
    this.getNotifications();
  },

  methods: {
    getNotifications() {
      ImportService.getNotifications().then((response) => {
        response = response.data;
        if (response.status) {
          this.notifications = response.notifications;
          this.newNotification = false;
          this.$store.state.showImportProgress = this.notifications.filter(
            (notification) => {
              return notification.is_batch && notification.progress < 100;
            }
          ).length;
        }
      });
    },

    toggleShowAppMenu() {
      this.showAppMenu = !this.showAppMenu;
      //add the value for CRMSidebarOpen to local storage

      this.$store.commit('toggleCRMSidebar');

      console.log(this.showAppMenu);
    },
    openSupportChat() {
      this.$freshchat.open();
    },
    previewAppMenuTrue() {
      if (!this.showAppMenu) {
        setTimeout(() => {
          this.previewAppMenu = true;
        }, 1000);
      }
    },
    previewAppMenuFalse() {
      this.previewAppMenu = false;
    },
    toggleCommandPallette() {
      this.showCommandPallette = !this.showCommandPallette;
    },
  },

  computed: {
    currentRouteName() {
      return this.$route.name;
    },
    currentRoutePath() {
      return this.$route.path;
    },
  },
  components: {
    Menu,
    MenuButton,
    HomeIcon,
    Bars3Icon,
    MenuItem,
    CloudArrowDownIcon,
    MenuItems,
    ChatBubbleLeftEllipsisIcon,
    MagnifyingGlassIcon,
    BellIcon,
    MegaphoneIcon,
    EnvelopeIcon,
    SwitchTeams,
    CursorArrowRippleIcon,
    ChartBarIcon,
    CheckCircleIcon,
    CloudArrowUpIcon,
    UserGroupIcon,
    FolderOpenIcon,
    CogIcon,
    CreditCardIcon,
    ChevronLeftIcon,
    ArrowLeftOnRectangleIcon,
    AdjustmentsHorizontalIcon,
    JovieLogo,
    XMarkIcon,
    TransitionRoot,
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverGroup,
    LifebuoyIcon,
    ExclamationTriangleIcon,
    AlertBanner,
    CommandPallette,
    FaceSmileIcon,
    ProgressBar,
    UserIcon,
    XCircle,
    ArrowPathIcon,
  },
};
</script>

<style scoped></style>
