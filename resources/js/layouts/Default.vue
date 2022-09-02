<template>
  <div>
    <header class="bg-neutral-800">
      <nav>
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex h-12 items-center justify-between">
            <div class="flex">
              <div class="flex flex-shrink-0 items-center text-white md:mr-12">
                <a href="/">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="69px"
                    height="20px">
                    <path
                      fill-rule="evenodd"
                      fill="rgb(255, 255, 255)"
                      d="M57.964,14.130 C58.057,14.960 58.283,15.578 58.639,15.984 C59.141,16.568 59.795,16.861 60.602,16.861 C61.111,16.861 61.596,16.734 62.054,16.480 C62.335,16.319 62.636,16.035 62.959,15.629 L68.068,16.099 C67.287,17.453 66.344,18.425 65.240,19.013 C64.135,19.602 62.551,19.896 60.487,19.896 C58.695,19.896 57.284,19.644 56.257,19.140 C55.229,18.637 54.377,17.836 53.702,16.740 C53.027,15.644 52.689,14.355 52.689,12.873 C52.689,10.765 53.366,9.059 54.721,7.755 C56.076,6.451 57.947,5.799 60.334,5.799 C62.271,5.799 63.800,6.091 64.921,6.675 C66.042,7.260 66.896,8.106 67.482,9.215 C68.068,10.325 68.362,11.768 68.362,13.546 L68.362,14.130 L57.964,14.130 ZM62.277,9.507 C61.840,9.076 61.264,8.860 60.551,8.860 C59.727,8.860 59.068,9.186 58.576,9.838 C58.261,10.244 58.062,10.849 57.977,11.654 L63.086,11.654 C62.984,10.655 62.715,9.939 62.277,9.507 ZM46.406,6.104 L51.592,6.104 L51.592,19.591 L46.406,19.591 L46.406,6.104 ZM46.406,0.973 L51.592,0.973 L51.592,4.491 L46.406,4.491 L46.406,0.973 ZM35.939,19.591 L30.311,6.104 L35.707,6.104 L38.332,14.651 L41.056,6.104 L46.289,6.104 L40.538,19.591 L35.939,19.591 ZM29.730,17.908 C28.349,19.233 26.440,19.896 24.002,19.896 C21.827,19.896 20.069,19.346 18.727,18.245 C17.079,16.882 16.255,15.095 16.255,12.886 C16.255,10.828 16.951,9.133 18.345,7.799 C19.738,6.466 21.619,5.799 23.989,5.799 C26.699,5.799 28.746,6.582 30.131,8.149 C31.244,9.410 31.800,10.964 31.800,12.809 C31.800,14.884 31.110,16.583 29.730,17.908 ZM25.863,10.212 C25.378,9.641 24.779,9.355 24.066,9.355 C23.310,9.355 22.685,9.645 22.193,10.225 C21.700,10.805 21.454,11.688 21.454,12.873 C21.454,14.075 21.698,14.964 22.186,15.540 C22.675,16.116 23.289,16.403 24.028,16.403 C24.775,16.403 25.389,16.120 25.869,15.553 C26.349,14.985 26.589,14.075 26.589,12.822 C26.589,11.654 26.347,10.784 25.863,10.212 ZM12.781,18.754 C11.639,19.524 10.176,19.908 8.392,19.908 C6.506,19.908 5.045,19.655 4.009,19.147 C2.972,18.639 2.171,17.896 1.607,16.918 C1.042,15.940 0.708,14.731 0.606,13.292 L6.124,12.543 C6.132,13.364 6.204,13.974 6.340,14.371 C6.476,14.769 6.705,15.091 7.028,15.337 C7.249,15.498 7.564,15.578 7.971,15.578 C8.617,15.578 9.090,15.339 9.392,14.861 C9.693,14.383 9.844,13.577 9.844,12.444 L9.844,0.973 L15.629,0.973 L15.629,11.088 C15.629,13.212 15.440,14.828 15.062,15.936 C14.684,17.045 13.924,17.984 12.781,18.754 Z" />
                  </svg>
                </a>
              </div>
              <div
                class="judtify- hidden items-center md:ml-6 md:block md:space-x-4">
                <Popover v-slot="{ open }" class="relative">
                  <PopoverButton
                    :class="open ? '' : 'text-opacity-90'"
                    class="group z-20 -mt-1 inline-flex items-center rounded-md px-3 py-1 text-xs font-medium text-white hover:text-opacity-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                    <span>Product</span>
                    <ChevronDownIcon
                      :class="open ? '' : 'text-opacity-70'"
                      class="ml-2 mt-1 h-5 w-5 text-neutral-300 transition duration-150 ease-in-out group-hover:text-opacity-80"
                      aria-hidden="true" />
                  </PopoverButton>
                  <transition
                    enter-active-class="transition duration-200 ease-out"
                    enter-from-class="translate-y-1 opacity-0"
                    enter-to-class="translate-y-0 opacity-100"
                    leave-active-class="transition duration-150 ease-in"
                    leave-from-class="translate-y-0 opacity-100"
                    leave-to-class="translate-y-1 opacity-0">
                    <PopoverPanel
                      class="absolute left-1/2 z-50 mt-3 w-screen max-w-sm transform px-4 sm:px-0 lg:max-w-3xl">
                      <div
                        class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                        <div
                          class="relative grid gap-8 bg-white p-7 lg:grid-cols-2">
                          <router-link
                            v-for="item in features"
                            :key="item.name"
                            :to="item.href"
                            @click.native="scrollFix(item.anchor)"
                            class="-m-3 flex items-center rounded-lg p-2 transition duration-150 ease-in-out hover:bg-gray-50 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-500 focus-visible:ring-opacity-50">
                            <div
                              class="flex h-10 w-10 flex-shrink-0 items-center justify-center text-white sm:h-12 sm:w-12">
                              <div class="rounded-md p-2">
                                <component
                                  :is="item.icon"
                                  class="h-6 w-6 text-indigo-600" />
                              </div>
                            </div>
                            <div class="ml-4">
                              <p class="text-sm font-medium text-gray-900">
                                {{ item.name }}
                                <span
                                  v-if="item.label"
                                  class="ml-3 inline-flex items-center rounded-md bg-pink-100 px-2 py-0 text-2xs font-medium leading-5 text-pink-800">
                                  {{ item.label }}
                                </span>
                              </p>
                              <p class="text-xs text-gray-500">
                                {{ item.description }}
                              </p>
                            </div>
                          </router-link>
                        </div>
                        <!-- <div class="bg-gray-50 p-4">
                          <router-link
                            to="chrome-extension"
                            class="flow-root rounded-md px-2 py-2 transition duration-150 ease-in-out hover:bg-gray-100 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-500 focus-visible:ring-opacity-50">
                            <span class="flex items-center">
                              <span class="text-sm font-medium text-gray-900">
                                Chrome Extension
                              </span>
                              <span
                                class="ml-3 inline-flex items-center rounded-md bg-indigo-100 px-2 py-0 text-2xs font-medium leading-5 text-indigo-800">
                                New
                              </span>
                            </span>
                            <span class="block text-sm text-gray-500">
                              Get creator insights & social content right inside
                              Gmail.
                            </span>
                          </router-link>
                        </div> -->
                      </div>
                    </PopoverPanel>
                  </transition>
                </Popover>
              </div>
              <router-link
                to="pricing"
                class="group z-20 hidden items-center rounded-md px-3 py-1 text-xs font-medium text-neutral-300 hover:text-white hover:text-opacity-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 md:inline-flex"
                >Pricing</router-link
              >
            </div>
            <div class="hidden items-center sm:flex">
              <div class="flex-shrink-0">
                <div v-if="!$store.state.AuthState.loading">
                  <div
                    v-if="!$store.state.AuthState.isAuthenticated"
                    class="cursor-pointer">
                    <div class="inline-flex">
                      <router-link
                        to="login"
                        class="cursor-hover:text-neutral-200 rounded-md px-4 py-2 text-xs font-medium text-neutral-300 hover:text-white"
                        >Sign in
                      </router-link>
                    </div>
                    <div class="inline-flex">
                      <a class="max-auto justify-center px-2">
                        <router-link
                          to="signup"
                          class="border-1 group relative inline-flex items-center rounded-md border border-neutral-300 bg-neutral-800 px-2 py-1 text-xs font-medium text-neutral-200 hover:border-white hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-neutral-500 focus-visible:ring-offset-2 focus-visible:ring-offset-neutral-800">
                          <span>Get started free</span>
                          <span>
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="ml-1 block h-4 w-4 group-hover:hidden"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor">
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7" />
                            </svg>
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="ml-1 hidden h-4 w-4 group-hover:block"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor">
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                          </span>
                        </router-link>
                      </a>
                    </div>
                  </div>
                  <div v-else>
                    <router-link
                      to="dashboard"
                      class="group inline-flex w-32 items-center rounded-md border-transparent px-2 py-1 text-sm font-medium text-neutral-400 hover:text-neutral-100">
                      Dashboard
                    </router-link>
                  </div>
                </div>
                <div v-else>Loading ...</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="hidden" id="mobile-menu">
          <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <div v-if="!$store.state.AuthState.loading">
              <div v-if="!$store.state.AuthState.isAuthenticated">
                <a
                  @click="login()"
                  class="rounded-md px-3 py-2 text-xs font-medium text-neutral-300 hover:text-neutral-200"
                  >Login</a
                >
              </div>
              <div v-else>
                <a
                  href="/"
                  class="block rounded-md bg-neutral-900 px-3 py-2 text-base font-medium text-white"
                  aria-current="page"
                  >Dashboard</a
                >
              </div>
            </div>
            <div v-else>Loading ...</div>
          </div>
        </div>
      </nav>
    </header>
    <router-view />

    <ExternalFooter> </ExternalFooter>
    <div class="sticky bottom-0">
      <AlertBanner
        class="hidden sm:block"
        dismissable="false"
        v-if="!acceptCookies">
        <span class="text-2xs font-light tracking-widest text-white md:text-sm"
          >We use
          <router-link class="cursor-pointer underline" to="privacy"
            >cookies</router-link
          >
          to make this experience taste better.
        </span>
        <span
          @click="toggleAcceptCookies"
          class="ml-2 cursor-pointer text-xs font-bold text-neutral-50 hover:text-white active:text-white md:text-sm"
          >Accept all cookies</span
        >
      </AlertBanner>
    </div>
  </div>
</template>

<script>
import AlertBanner from '../components/AlertBanner.vue';
import {
  InboxIcon,
  PencilIcon,
  TrashIcon,
  UserIcon,
  UsersIcon,
  ChevronDownIcon,
  MagnifyingGlassIcon,
  UserGroupIcon,
  EnvelopeIcon,
  DatabaseIcon,
  LightBulbIcon,
} from '@heroicons/vue/24/outline';
import UserService from '../services/api/user.service';
import ExternalFooter from '../components/External/ExternalFooter';
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverOverlay,
} from '@headlessui/vue';

export default {
  name: 'Default',
  components: {
    InboxIcon,
    AlertBanner,
    LightBulbIcon,
    PencilIcon,
    TrashIcon,
    UsersIcon,
    UserIcon,
    ExternalFooter,
    ChevronDownIcon,
    MagnifyingGlassIcon,
    UserGroupIcon,
    EnvelopeIcon,
    DatabaseIcon,
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverOverlay,
  },

  data() {
    return {
      features: [
        {
          name: 'Contact profiles',
          description: `Simple, beautiful, universal profiles.`,
          href: '/profiles',
          anchor: '#discovery',
          icon: 'UserIcon',
          label: 'New',
        },
        {
          name: 'Social CRM',
          description: 'Manage your relationships',
          href: '/',
          anchor: '#crm',
          icon: 'UserGroupIcon',
        },
        {
          name: 'Social Insights in Gmail',
          description: `The Jovie Chrome Extension puts new & extsting contact\'s social data right inside your inbox`,
          href: 'chrome-extension',
          anchor: '',
          icon: 'DatabaseIcon',
        },
        {
          name: 'Data Enrichment',
          description:
            'Enrich your existing customer lists with creator specific data',
          href: 'Enrichment',
          anchor: '',
          icon: 'LightBulbIcon',
        },
      ],
      waitListEmail: '',
      acceptCookies: '',
      error: null,
      CommandPalletteOpen: false,
    };
  },
  mounted() {
    this.acceptCookies = this.$cookies.get('acceptCookies');
    if (this.acceptCookies) {
      this.$store.commit('setAcceptCookies', true);
    }
  },
  methods: {
    toggleAcceptCookies() {
      this.acceptCookies = true;
      this.$cookies.set('acceptCookies', true, 60 * 60 * 24 * 365);
    },
    login() {
      // login()
    },
    logout() {
      // logout()
    },
    scrollFix: function (hashbang) {
      location.hash = hashbang;
    },
    async requestDemo() {
      await UserService.addToWaitList({ email: this.waitListEmail })
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$store.commit('setAddedToWaitList');
            this.waitListEmail = '';
            this.error = null;
            this.$router.push('demo');
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.error = error.data.errors.email[0];
          }
        });
    },
  },
};
</script>
<style>
/* your style */
</style>
