<template>
  <Head>
    <title>Jovie | The Social CRM</title>
    <meta name="description" content="Jovie is a CRM that creates & enriches contacts from social media profiles." />
     <!--- OpenGraph -->
     <meta property="og:image:height" content="333">
        <meta property="og:image:width" content="636">
        <meta property="og:description" content="Organize everyone you follow">
        <meta property="og:title" content="Jovie | Social CRM">
        <meta property="og:url" content="http://jov.ie">
        <meta property="og:image" content="https://jovie-production-store.s3.amazonaws.com/og-image.jpg">
        <!-- End OpenGraph -->
       
  </Head>
  <div>
    <header class="sticky top-0 z-20 bg-neutral-50">
      <nav>
        <Disclosure as="nav" class="border-b border-gray-200" v-slot="{ open }">
          <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-12 items-center justify-between">
              <div class="flex">
                <div
                  class="flex flex-shrink-0 items-center text-neutral-800 md:mr-12">
                  <a href="/">
                    <JovieLogo height="20" />
                  </a>
                </div>
                <div
                  class="hidden items-center py-1 md:ml-6 md:flex md:space-x-4">
                  <!-- <Popover v-slot="{ open }" class="relative">
                    <PopoverButton
                      :class="open ? '' : 'text-opacity-90'"
                      class="group z-20 -mt-1 inline-flex items-center rounded-md px-3 text-xs font-medium text-neutral-700 hover:text-opacity-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-neutral-200 focus-visible:ring-opacity-75">
                      <span class="mt-0.5">Product</span>
                      <ChevronDownIcon
                        :class="open ? '' : 'text-opacity-70'"
                        class="ml-2 mt-1 h-5 w-5 text-neutral-600 transition duration-150 ease-in-out group-hover:text-opacity-80"
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
                                class="flex h-10 w-10 flex-shrink-0 items-center justify-center text-neutral-700 sm:h-12 sm:w-12">
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
                           <div class="bg-gray-50 p-4">
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
                        </div> 
                        </div>
                      </PopoverPanel>
                    </transition>
                  </Popover> -->

                  <router-link
                    to="pricing"
                    class="group z-20 hidden items-center rounded-md px-3 text-xs font-medium text-neutral-600 hover:text-neutral-700 hover:text-opacity-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 lg:inline-flex"
                    >Pricing</router-link
                  >
                </div>
              </div>
              <div class="hidden items-center lg:flex">
                <div class="flex-shrink-0">
                  <div v-if="!$store.state.AuthState.loading">
                    <div
                      v-if="!$store.state.AuthState.isAuthenticated"
                      class="cursor-pointer">
                      <div class="inline-flex">
                        <router-link
                          to="login"
                          class="cursor-hover:text-neutral-200 rounded-md px-4 py-2 text-xs font-medium text-neutral-600 hover:text-neutral-700"
                          >Sign in
                        </router-link>
                      </div>
                      <div class="inline-flex">
                        <a class="max-auto justify-center px-2">
                          <router-link
                            to="signup"
                            class="border-1 group relative inline-flex items-center rounded-md bg-indigo-500 px-4 py-1 text-xs font-medium text-neutral-200 hover:bg-indigo-600 hover:text-neutral-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-neutral-500 focus-visible:ring-offset-2 focus-visible:ring-offset-neutral-800">
                            <span>Try Jovie free</span>
                            <svg
                              class="mt-0 ml-2 -mr-1 stroke-white stroke-2"
                              fill="none"
                              width="10"
                              height="10"
                              viewBox="0 0 10 10"
                              aria-hidden="true">
                              <path
                                class="opacity-0 transition group-hover:opacity-100"
                                d="M0 5h7"></path>
                              <path
                                class="transition group-hover:translate-x-[3px]"
                                d="M1 1l4 4-4 4"></path>
                            </svg>
                            <!-- <span>
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
                            </span> -->
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
              <div class="-mr-2 flex items-center lg:hidden">
                <!-- Mobile menu button -->
                <DisclosureButton
                  class="inline-flex items-center justify-center rounded-md bg-neutral-50 p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-neutral-500 focus-visible:ring-offset-2">
                  <span class="sr-only">Open main menu</span>
                  <Bars3Icon
                    v-if="!open"
                    class="block h-6 w-6"
                    aria-hidden="true" />
                  <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                </DisclosureButton>
              </div>
            </div>
          </div>

          <!-- Mobile menu, show/hide based on menu state. -->
          <!-- <div class="hidden" id="mobile-menu">
          <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <div v-if="!$store.state.AuthState.loading">
              <div v-if="!$store.state.AuthState.isAuthenticated">
                <a
                  @click="login()"
                  class="rounded-md px-3 py-2 text-xs font-medium text-neutral-600 hover:text-neutral-200"
                  >Login</a
                >
              </div>
              <div v-else>
                <a
                  href="/"
                  class="block rounded-md bg-neutral-900 px-3 py-2 text-base font-medium text-neutral-700"
                  aria-current="page"
                  >Dashboard</a
                >
              </div>
            </div>
            <div v-else>Loading ...</div>
          </div>
        </div> -->
          <DisclosurePanel class="lg:hidden">
            <div class="space-y-1 pt-2 pb-3">
              <DisclosureButton
                v-for="item in navigation"
                :key="item.name"
                as="a"
                :href="item.href"
                :class="[
                  item.current
                    ? 'border-neutral-500 bg-neutral-50 text-neutral-600'
                    : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700',
                  'block border-l-4 py-2 pl-3 pr-4 text-base font-medium',
                ]"
                :aria-current="item.current ? 'page' : undefined"
                >{{ item.name }}</DisclosureButton
              >
            </div>
          </DisclosurePanel>
        </Disclosure>
      </nav>
    </header>
    <router-view />

    <ExternalFooter> </ExternalFooter>
    <div class="sticky bottom-0">
      <AlertBanner
        class="hidden sm:block"
        dismissable="false"
        v-if="!acceptCookies">
        <span
          class="text-2xs font-light tracking-widest text-neutral-100 md:text-sm"
          >We use
          <router-link class="cursor-pointer underline" to="privacy"
            >cookies</router-link
          >
          to make this experience taste better.
        </span>
        <span
          @click="toggleAcceptCookies"
          class="ml-2 cursor-pointer text-xs font-bold text-neutral-50 hover:text-white hover:underline active:text-white md:text-sm"
          >Accept all cookies</span
        >
      </AlertBanner>
    </div>
  </div>
</template>

<script>
import { Head } from '@vueuse/head';
import JovieLogo from '../components/JovieLogo.vue';
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
  CircleStackIcon,
  LightBulbIcon,
  Bars3Icon,
  BellIcon,
  XMarkIcon,
} from '@heroicons/vue/24/outline';
import UserService from '../services/api/user.service';
import ExternalFooter from '../components/External/ExternalFooter';
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverOverlay,
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from '@headlessui/vue';

export default {
  name: 'Default',

  components: {
    InboxIcon,
    AlertBanner,
    Head,
    LightBulbIcon,
    PencilIcon,
    TrashIcon,
    UsersIcon,
    UserIcon,
    Bars3Icon,
    XMarkIcon,
    BellIcon,
    ExternalFooter,
    ChevronDownIcon,
    MagnifyingGlassIcon,
    UserGroupIcon,
    EnvelopeIcon,
    JovieLogo,
    CircleStackIcon,
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverOverlay,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
  },
  data() {
    return {
      title: 'Jovie | The Social CRM',
      navigation: [
        { name: 'Pricing', href: '/pricing', current: false },
        { name: 'Get strarted free', href: '/signup', current: false },
      ],
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
          icon: 'CircleStackIcon',
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
