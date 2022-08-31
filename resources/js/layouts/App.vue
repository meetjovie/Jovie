<template>
  <div id="app" class="flex h-screen overflow-hidden bg-neutral-100">
    <NotificationGroup group="user">
      <!-- Global notification live region, render this permanently at the end of the document -->
      <div
        aria-live="assertive"
        class="pointer-events-none absolute top-0 right-0 z-50 mr-4 mt-4 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
          <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->

          <Notification
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
              class="mx-auto mt-4 flex w-80 max-w-sm overflow-hidden rounded-lg border border-neutral-200 bg-white/60 bg-clip-padding shadow-md backdrop-blur-2xl backdrop-saturate-150"
              v-for="notification in notifications"
              :key="notification.id">
              <div class="flex w-10 items-center justify-center bg-neutral-200">
                <XIcon
                  v-if="notification.type === 'error'"
                  class="h-4 w-4 text-red-500" />
                <ExclamationIcon
                  v-if="notification.type === 'warning'"
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
                  <span class="text-xs font-semibold text-neutral-600">{{
                    notification.title
                  }}</span>
                  <p class="text-xs text-gray-400">{{ notification.text }}</p>
                </div>
              </div>
            </div>
          </Notification>
        </div>
      </div>
    </NotificationGroup>

    <div
      id="overlay"
      class="fixed inset-0 z-30 flex md:hidden"
      role="dialog"
      aria-modal="true">
      <div
        class="fixed inset-0 bg-neutral-600 bg-opacity-75"
        aria-hidden="true"></div>
      <div
        id="sidebar"
        class="relative flex w-full flex-1 flex-col bg-neutral-500/50 pt-5 pb-4 backdrop-blur-md">
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
    </div>
    <!-- Narrow sidebar -->

    <div class="z-10 flex w-0 flex-1 flex-col overflow-hidden">
      <div
        class="border-1 relative z-50 flex h-10 flex-shrink-0 border-b bg-white/75 backdrop-blur-md backdrop-filter">
        <button
          id="showSidebar"
          class="border-r border-neutral-200 px-4 text-neutral-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-indigo-500 md:hidden">
          <span class="sr-only">Open sidebar</span>

          <svg
            class="h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h7" />
          </svg>
        </button>
        <div class="z-10 flex flex-1 justify-between px-2">
          <div class="z-10 flex flex-1 text-left">
            <div
              class="ml-0 px-4 py-2 text-left text-sm font-semibold text-indigo-600 sm:px-6 md:px-8">
              <nav class="z-10 flex" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                  <li>
                    <a
                      @mouseover="previewAppMenuTrue()"
                      @mouseout="previewAppMenuFalse()"
                      @click="toggleShowAppMenu()"
                      href="#"
                      class="text-gray-400 hover:text-gray-500">
                      <MenuIcon
                        class="h-5 w-5 flex-shrink-0"
                        aria-hidden="true" />
                      <span class="sr-only">Menu</span>
                    </a>
                  </li>
                  <li>
                    <router-link to="/" class="text:bg-gray-500 text-gray-400">
                      <HomeIcon
                        class="h-5 w-5 flex-shrink-0"
                        aria-hidden="true" />
                      <span class="sr-only">Home</span>
                    </router-link>
                  </li>
                  <li>
                    <div class="flex items-center">
                      <svg
                        class="h-5 w-5 flex-shrink-0 text-gray-300"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        aria-hidden="true">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                      </svg>
                      <a
                        :href="currentRoutePath"
                        class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                        :aria-current="currentRouteName ? 'page' : undefined"
                        >{{ currentRouteName }}</a
                      >
                    </div>
                  </li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="z-10 flex items-center">
            <div class="inline-flex items-center space-x-4">
              <PopoverGroup>
                <Popover as="div" class="relative">
                  <PopoverButton
                    as="div"
                    type="button"
                    class="rounded-full p-1 text-neutral-400 transition duration-300 ease-in-out hover:text-neutral-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 active:bg-neutral-100 active:text-neutral-700"
                    id="notification-button"
                    aria-expanded="false"
                    aria-haspopup="true"
                    @click="getNotifications()">
                    <span class="sr-only">Open import notification</span>
                    <span
                      v-if="notifications.length"
                      class="absolute top-6 -mt-1 ml-4 flex h-1 w-1">
                      <span
                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-indigo-400 opacity-75"></span>
                      <span
                        class="relative inline-flex h-1 w-1 rounded-full bg-indigo-500"></span>
                    </span>
                    <BellIcon
                      class="h-5 w-5 flex-shrink-0 cursor-pointer"
                      aria-hidden="true">
                    </BellIcon>
                  </PopoverButton>

                  <transition
                    enter-active-class="transition duration-150 ease-out"
                    enter-from-class="transform scale-95 opacity-0"
                    enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-150 ease-out"
                    leave-from-class="transform scale-100 opacity-100"
                    leave-to-class="transform scale-95 opacity-0">
                    <PopoverPanel
                      class="absolute left-6 z-10 mt-2 w-screen max-w-md -translate-x-full transform px-2 sm:px-0">
                      <!-- Active: "bg-neutral-100", Not Active: "" -->
                      <div
                        class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                        <div class="relative h-80 gap-6 bg-white px-1 sm:gap-8">
                          <div
                            class="mx-auto inline-flex w-full items-center border-b pb-1">
                            <p
                              class="px-2 pt-2 text-xs font-bold text-neutral-400">
                              Notifications
                            </p>
                          </div>
                          <div class="" v-if="notifications.length">
                            <template
                              v-for="notification in notifications"
                              :key="notification.id">
                              <div
                                v-if="notification.is_batch"
                                as="div"
                                class="inline-flex w-full border-b px-2 py-2 text-xs text-neutral-700 first:pt-3"
                                role="menuitem"
                                tabindex="-1">
                                <router-link
                                  to="/imports"
                                  class="0 group block flex-shrink-0">
                                  <div
                                    class="flex w-full items-center justify-between">
                                    <div class="px-2">
                                      <component
                                        class="mx-auto h-5 w-5 text-neutral-400"
                                        :is="'CloudUploadIcon'">
                                      </component>
                                    </div>
                                    <div class="ml-3 w-60">
                                      <p
                                        class="justify-between text-2xs font-medium uppercase text-gray-700 group-hover:text-gray-900">
                                        Importing {{ notification.name }}
                                        <span
                                          class="text-2xs font-light text-neutral-500"
                                          >-
                                          {{ notification.type }} Profiles</span
                                        >
                                      </p>
                                      <div class="w-full">
                                        <span
                                          class="text-2xs font-medium text-gray-500">
                                          Total:
                                          {{
                                            notification.initial_total_in_file
                                          }}
                                        </span>
                                        |
                                        <span
                                          class="text-2xs font-medium text-gray-500">
                                          Successful:
                                          {{ notification.successful }}
                                        </span>
                                      </div>
                                      <ProgressBar
                                        :percentage="notification.progress"
                                        class="mx-auto w-full" />
                                    </div>
                                    <div
                                      class="mx-auto px-2 font-bold text-neutral-300 line-clamp-2">
                                      {{ notification.created_at_formatted }}
                                    </div>
                                  </div>
                                </router-link>
                              </div>
                              <div
                                v-else
                                as="div"
                                class="inline-flex w-full border-b px-2 py-2 text-xs text-neutral-700 first:pt-3"
                                role="menuitem"
                                tabindex="-1">
                                <router-link
                                  to="/imports"
                                  class="0 group block flex-shrink-0">
                                  <div
                                    class="flex w-full items-center justify-between">
                                    <div class="px-2">
                                      <component
                                        class="mx-auto h-5 w-5 text-neutral-400"
                                        :is="'CloudUploadIcon'">
                                      </component>
                                    </div>
                                    <div class="ml-3 w-60">
                                      <p
                                        class="mx-auto text-2xs text-red-400"
                                        v-if="
                                          !notification.is_error &&
                                          notification.meta &&
                                          notification.meta.total_jobs
                                        ">
                                        Completed
                                        {{ notification.meta.type }} import at
                                        {{ notification.created_at }}
                                      </p>
                                      <p
                                        class="mx-auto text-2xs text-red-400"
                                        v-else-if="notification.is_error">
                                        {{ notification.message }}
                                        <span
                                          v-if="
                                            notification.meta &&
                                            notification.meta.name
                                          ">
                                          <b
                                            >({{ notification.meta.name }})</b
                                          ></span
                                        >
                                      </p>
                                      <p
                                        class="mx-auto text-2xs text-blue-500"
                                        v-else>
                                        {{ notification.message }}
                                      </p>
                                    </div>
                                    <div
                                      class="mx-auto px-2 font-bold text-neutral-300 line-clamp-2">
                                      {{ notification.created_at_formatted }}
                                    </div>
                                  </div>
                                </router-link>
                              </div>
                            </template>
                          </div>
                          <div
                            class="mx-auto w-full items-center py-4 text-center"
                            v-else>
                            <span
                              class="mx-auto items-center text-sm font-bold text-neutral-400"
                              ><EmojiHappyIcon
                                class="mx-auto h-14 w-14 text-neutral-200" />No
                              notifications</span
                            >
                          </div>
                        </div>
                      </div>
                    </PopoverPanel>
                  </transition>
                </Popover>
              </PopoverGroup>
            </div>

            <!-- Profile dropdown -->
            <PopoverGroup>
              <Popover as="div" class="relative ml-3 border-l px-4">
                <PopoverButton
                  as="div"
                  type="button"
                  class="flex max-w-xs items-center rounded-full bg-white text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-200 focus-visible:ring-offset-2"
                  id="user-menu-button"
                  aria-expanded="false"
                  aria-haspopup="true"
                  @click="isShowing = !isShowing">
                  <span class="sr-only">Open user menu</span>

                  <img
                    id="profile_pic_url_img"
                    ref="profile_pic_url_img"
                    class="h-8 w-8 rounded-full border border-neutral-200 object-cover object-center"
                    :src="
                      $store.state.AuthState.user.profile_pic_url ??
                      $store.state.AuthState.user.default_image
                    " />
                </PopoverButton>

                <transition
                  enter-active-class="transition duration-150 ease-out"
                  enter-from-class="transform scale-95 opacity-0"
                  enter-to-class="transform scale-100 opacity-100"
                  leave-active-class="transition duration-150 ease-out"
                  leave-from-class="transform scale-100 opacity-100"
                  leave-to-class="transform scale-95 opacity-0">
                  <PopoverPanel
                    as="div"
                    active=""
                    id="profileDropdown"
                    class="absolute right-0 z-10 mt-2 w-80 origin-top-right rounded-md bg-white py-1 shadow-xl backdrop-blur-xl backdrop-saturate-150 backdrop-filter"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="user-menu-button"
                    tabindex="-1">
                    <!-- Active: "bg-neutral-100", Not Active: "" -->
                    <div
                      as="div"
                      class="block border-b-2 border-opacity-30 px-4 py-2 text-left text-xs font-bold text-neutral-400"
                      role="menuitem"
                      tabindex="-1"
                      id="user-menu-item-0">
                      <router-link
                        to="/account"
                        class="0 group block flex-shrink-0">
                        <div class="flex items-center">
                          <div>
                            <img
                              class="inline-block h-6 w-6 rounded-full"
                              :src="
                                currentUser.profile_pic_url ??
                                currentUser.default_image
                              "
                              alt="" />
                          </div>
                          <div class="ml-3">
                            <p
                              class="justify-between text-xs font-medium text-gray-700 group-hover:text-gray-900">
                              {{ currentUser.first_name }}
                              {{ currentUser.last_name }}
                            </p>

                            <p
                              class="text-xs font-medium text-gray-500 group-hover:text-gray-700">
                              {{ currentUser.email }}
                            </p>
                          </div>
                        </div>
                      </router-link>
                    </div>
                    <router-link
                      v-if="currentUser.username"
                      class="first-rounded-t-md inline-flex w-full cursor-pointer px-4 py-2 text-xs text-neutral-700 hover:bg-indigo-700 hover:text-white"
                      :to="profileLink">
                      <component
                        class="mr-4 h-4 w-4 cursor-pointer"
                        is="UserIcon">
                      </component
                      >Your profile
                    </router-link>
                    <router-link
                      v-else
                      class="first-rounded-t-md inline-flex w-full cursor-pointer px-4 py-2 text-xs text-neutral-700 hover:bg-indigo-700 hover:text-white"
                      to="edit-profile">
                      <component
                        class="mr-4 h-4 w-4 cursor-pointer"
                        is="CogIcon">
                      </component
                      >Setup Your profile
                    </router-link>
                    <div
                      v-for="dropdownmenuitem in dropdownmenuitems"
                      :key="dropdownmenuitem"
                      as="router-link"
                      :to="dropdownmenuitem.route"
                      class="first-rounded-t-md inline-flex w-full cursor-pointer text-xs text-neutral-700 hover:bg-indigo-700 hover:text-white"
                      role="menuitem"
                      tabindex="-1">
                      <router-link
                        class="first-rounded-t-md inline-flex w-full cursor-pointer px-4 py-2 text-xs text-neutral-700 hover:bg-indigo-700 hover:text-white"
                        :to="dropdownmenuitem.route">
                        <component
                          class="mr-4 h-4 w-4 cursor-pointer"
                          :is="dropdownmenuitem.icon">
                        </component>
                        {{ dropdownmenuitem.name }}
                      </router-link>
                    </div>
                    <div
                      as="div"
                      @click="openWidget()"
                      class="inline-flex w-full cursor-pointer px-4 py-2 text-xs text-neutral-700 hover:bg-indigo-700 hover:text-white"
                      role="menuitem">
                      <component class="mr-4 h-4 w-4" is="SupportIcon">
                      </component>
                      Chat with support
                    </div>
                    <div
                      as="div"
                      @click="$store.dispatch('logout')"
                      class="inline-flex w-full cursor-pointer rounded-b-md px-4 py-2 text-xs text-neutral-700 hover:bg-indigo-700 hover:text-white"
                      role="menuitem"
                      tabindex="-1">
                      <component class="mr-4 h-4 w-4" is="LogoutIcon">
                      </component>
                      Sign out
                    </div>
                  </PopoverPanel>
                </transition>
              </Popover>
            </PopoverGroup>
          </div>
        </div>
      </div>

      <main
        class="relative flex-1 overflow-y-auto focus-visible:outline-none"
        id="main">
        <div class="h-full">
          <div class="h-full">
            <CommandPallette as="div" :open="showCommandPallette" />
            <AlertBanner
              v-if="currentUser.current_team.credits < 1"
              design="danger"
              :mobiletitle="`You're out of credits`"
              :title="`You're out of credits.`"
              :cta="`Upgrade`"
              ctaLink="Billing" />
            <router-view></router-view>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import {
  HomeIcon,
  MenuIcon,
  SearchIcon,
  MailIcon,
  ChartBarIcon,
  ChevronLeftIcon,
  CheckCircleIcon,
  ExclamationIcon,
  CreditCardIcon,
  CloudUploadIcon,
  UserGroupIcon,
  FolderOpenIcon,
  CogIcon,
  UserIcon,
  XIcon,
  BellIcon,
  CursorClickIcon,
  ChatAltIcon,
  LogoutIcon,
  SwitchHorizontalIcon,
  SpeakerphoneIcon,
  SupportIcon,
  EmojiHappyIcon,
} from '@heroicons/vue/outline';
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
      profileLink: this.$store.state.AuthState.user.username,

      nav: [
        /* /*  /*  { name: 'Admin', route: '/admin', icon: CheckCircleIcon }, */
        /*  { name: 'Dashboard', route: '/dashboard', icon: HomeIcon }, */
        /*  { name: 'Search', route: '/discovery', icon: SearchIcon }, */
        { name: 'Contacts', route: '/contacts', icon: HomeIcon },
        //add a link for profile
        { name: 'Profile', route: '/edit-profile', icon: UserIcon },

        /* { name: 'Pipeline', route: '/pipeline', icon: SwitchHorizontalIcon }, */
        /*  { name: 'Import', route: '/import', icon: CloudUploadIcon }, */
        /* { name: 'Settings', route: '/account', icon: CogIcon }, */
      ],
      dropdownmenuitems: [
        { name: 'Billing', route: '/billing', icon: CreditCardIcon },
        { name: 'Settings', route: 'Account', icon: CogIcon },
      ],
      helpmenuitems: [
        { name: 'Shortcuts', route: 'Account', icon: CursorClickIcon },
        { name: 'Feedback', route: 'Account', icon: SpeakerphoneIcon },
      ],
      isShowing: false,
      isLoading: false,
      CRMSidebarOpen: false,
      notifications: [],
    };
  },

  mounted() {
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
    // this.getNotifications();
    // setInterval(() => {
    //   this.getNotifications();
    // }, 5000);
  },

  methods: {
    getNotifications() {
      ImportService.getNotifications().then((response) => {
        response = response.data;
        if (response.status) {
          this.notifications = response.notifications;
        }
      });
    },
    toggleShowAppMenu() {
      this.showAppMenu = !this.showAppMenu;
      this.$store.commit('toggleCRMSidebar', this.CRMSidebarOpen);
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
    MenuIcon,
    MenuItem,
    MenuItems,
    ChatAltIcon,
    SearchIcon,
    BellIcon,
    SpeakerphoneIcon,
    MailIcon,
    SwitchTeams,
    CursorClickIcon,
    ChartBarIcon,
    CheckCircleIcon,
    CloudUploadIcon,
    UserGroupIcon,
    FolderOpenIcon,
    CogIcon,
    CreditCardIcon,
    ChevronLeftIcon,
    LogoutIcon,
    SwitchHorizontalIcon,
    JovieLogo,
    XIcon,
    TransitionRoot,
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverGroup,
    SupportIcon,
    ExclamationIcon,
    AlertBanner,
    CommandPallette,
    EmojiHappyIcon,
    ProgressBar,
    UserIcon,
    XCircle,
  },
};
</script>
<!-- End Freshdesk -->
<style scoped></style>
