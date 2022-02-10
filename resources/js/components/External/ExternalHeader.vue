<template>
    <header class="bg-neutral-800">
            <nav>
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-12">
                        <div class="flex">

                            <div class="flex-shrink-0 flex md:mr-12 text-white items-center">
                                <a href="/">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="69px" height="20px">
                                        <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                                              d="M57.964,14.130 C58.057,14.960 58.283,15.578 58.639,15.984 C59.141,16.568 59.795,16.861 60.602,16.861 C61.111,16.861 61.596,16.734 62.054,16.480 C62.335,16.319 62.636,16.035 62.959,15.629 L68.068,16.099 C67.287,17.453 66.344,18.425 65.240,19.013 C64.135,19.602 62.551,19.896 60.487,19.896 C58.695,19.896 57.284,19.644 56.257,19.140 C55.229,18.637 54.377,17.836 53.702,16.740 C53.027,15.644 52.689,14.355 52.689,12.873 C52.689,10.765 53.366,9.059 54.721,7.755 C56.076,6.451 57.947,5.799 60.334,5.799 C62.271,5.799 63.800,6.091 64.921,6.675 C66.042,7.260 66.896,8.106 67.482,9.215 C68.068,10.325 68.362,11.768 68.362,13.546 L68.362,14.130 L57.964,14.130 ZM62.277,9.507 C61.840,9.076 61.264,8.860 60.551,8.860 C59.727,8.860 59.068,9.186 58.576,9.838 C58.261,10.244 58.062,10.849 57.977,11.654 L63.086,11.654 C62.984,10.655 62.715,9.939 62.277,9.507 ZM46.406,6.104 L51.592,6.104 L51.592,19.591 L46.406,19.591 L46.406,6.104 ZM46.406,0.973 L51.592,0.973 L51.592,4.491 L46.406,4.491 L46.406,0.973 ZM35.939,19.591 L30.311,6.104 L35.707,6.104 L38.332,14.651 L41.056,6.104 L46.289,6.104 L40.538,19.591 L35.939,19.591 ZM29.730,17.908 C28.349,19.233 26.440,19.896 24.002,19.896 C21.827,19.896 20.069,19.346 18.727,18.245 C17.079,16.882 16.255,15.095 16.255,12.886 C16.255,10.828 16.951,9.133 18.345,7.799 C19.738,6.466 21.619,5.799 23.989,5.799 C26.699,5.799 28.746,6.582 30.131,8.149 C31.244,9.410 31.800,10.964 31.800,12.809 C31.800,14.884 31.110,16.583 29.730,17.908 ZM25.863,10.212 C25.378,9.641 24.779,9.355 24.066,9.355 C23.310,9.355 22.685,9.645 22.193,10.225 C21.700,10.805 21.454,11.688 21.454,12.873 C21.454,14.075 21.698,14.964 22.186,15.540 C22.675,16.116 23.289,16.403 24.028,16.403 C24.775,16.403 25.389,16.120 25.869,15.553 C26.349,14.985 26.589,14.075 26.589,12.822 C26.589,11.654 26.347,10.784 25.863,10.212 ZM12.781,18.754 C11.639,19.524 10.176,19.908 8.392,19.908 C6.506,19.908 5.045,19.655 4.009,19.147 C2.972,18.639 2.171,17.896 1.607,16.918 C1.042,15.940 0.708,14.731 0.606,13.292 L6.124,12.543 C6.132,13.364 6.204,13.974 6.340,14.371 C6.476,14.769 6.705,15.091 7.028,15.337 C7.249,15.498 7.564,15.578 7.971,15.578 C8.617,15.578 9.090,15.339 9.392,14.861 C9.693,14.383 9.844,13.577 9.844,12.444 L9.844,0.973 L15.629,0.973 L15.629,11.088 C15.629,13.212 15.440,14.828 15.062,15.936 C14.684,17.045 13.924,17.984 12.781,18.754 Z"/>
                                    </svg>
                                </a>
                            </div>
                           
                                

                                <div class="hidden md:block md:ml-6 items-center judtify- md:space-x-4">
                                    <Popover v-slot="{ open }" class="relative">
                                        <PopoverButton
                                            :class="open ? '' : 'text-opacity-90'"
                                            class="inline-flex items-center px-3 py-1 -mt-1 z-20 text-xs font-medium text-white rounded-md group hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                                        >
                                            <span>Features</span>
                                            <ChevronDownIcon
                                            :class="open ? '' : 'text-opacity-70'"
                                            class="w-5 h-5 ml-2 mt-1 text-neutral-300 transition duration-150 ease-in-out group-hover:text-opacity-80"
                                            aria-hidden="true"
                                            />
                                        </PopoverButton>
                                        <transition
                                            enter-active-class="transition duration-200 ease-out"
                                            enter-from-class="translate-y-1 opacity-0"
                                            enter-to-class="translate-y-0 opacity-100"
                                            leave-active-class="transition duration-150 ease-in"
                                            leave-from-class="translate-y-0 opacity-100"
                                            leave-to-class="translate-y-1 opacity-0"
                                        >
                                            <PopoverPanel
                                            class="absolute z-10 w-screen max-w-sm px-4 mt-3 transform left-1/2 sm:px-0 lg:max-w-3xl"
                                            >
                                            <div
                                                class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5"
                                            >
                                                <div class="relative grid gap-8 bg-white p-7 lg:grid-cols-2">
                                                <router-link
                                                    v-for="item in solutions"
                                                    :key="item.name"
                                                    :to="item.href" @click.native="scrollFix(item.anchor)"
                                                    class="flex items-center p-2 -m-3 transition duration-150 ease-in-out rounded-lg hover:bg-gray-50 focus:outline-none focus-visible:ring focus-visible:ring-indigo-500 focus-visible:ring-opacity-50"
                                                >
                                                    <div
                                                    class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white sm:h-12 sm:w-12"
                                                    >
                                                    <div class="bg-indigo-200 rounded-md p-2">
                                                        <component :is="item.icon" class="h-6 w-6 text-indigo-600"/>
                                                    </div>
                                                    </div>
                                                    <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        {{ item.name }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ item.description }}
                                                    </p>
                                                    </div>
                                                </router-link>
                                                </div>
                                                <div class="p-4 bg-gray-50">
                                                <router-link
                                                    to="demo"
                                                    class="flow-root px-2 py-2 transition duration-150 ease-in-out rounded-md hover:bg-gray-100 focus:outline-none focus-visible:ring focus-visible:ring-indigo-500 focus-visible:ring-opacity-50"
                                                >
                                                    <span class="flex items-center">
                                                    <span class="text-sm font-medium text-gray-900">
                                                        Request a demo
                                                    </span>
                                                    </span>
                                                    <span class="block text-sm text-gray-500">
                                                    Wanna see what Jovie can do?
                                                    </span>
                                                </router-link>
                                                </div>
                                            </div>
                                            </PopoverPanel>
                                        </transition>
                                    </Popover>
                                   
                        
                
                                 </div>
                                  <router-link to="pricing" class="hidden md:inline-flex items-center px-3 py-1  z-20 text-xs font-medium text-neutral-300 hover:text-white rounded-md group hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">Pricing</router-link>
                         </div>
                        <div class="hidden sm:flex items-center">
                            <div class="flex-shrink-0 ">
                                <div v-if="!$store.state.AuthState.loading">
                                    <div v-if="!$store.state.AuthState.isAuthenticated" class="cursor-pointer">
                                        <div class="inline-flex">
                                            <a @click="login()"
                                               class="text-neutral-300 cursor-hover:text-neutral-200 hover:text-white px-4 py-2 rounded-md text-xs font-medium">Sign
                                                in
                                            </a>
                                        </div>
                                        <div class="inline-flex">
                                            <a class:="justify-center px-2 max-auto" @click="demo">
                                                <router-link to='demo'
                                                             class="relative inline-flex group items-center px-2 py-1 border text-xs font-medium rounded-md text-neutral-200 hover:text-white bg-neutral-800 border-1 border-neutral-300 hover:border-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-neutral-800 focus-visible:ring-neutral-500">
                                                    <span>Request Demo</span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="block group-hover:hidden ml-1 h-4 w-4" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2" d="M9 5l7 7-7 7"/>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="hidden group-hover:block ml-1 h-4 w-4" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                                        </svg>
                                                    </span>
                                                </router-link>
                                            </a>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <router-link to="dashboard"
                                                     class="text-sm border-transparent group rounded-md w-32 px-2 py-1 inline-flex items-center font-medium text-neutral-400 hover:text-neutral-100">
                                            Dashboard
                                        </router-link>
                                    </div>
                                </div>
                                <div v-else>
                                    Loading ...
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
                <div class="hidden" id="mobile-menu">
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                        <div v-if="!$store.state.AuthState.loading">
                            <div v-if="!$store.state.AuthState.isAuthenticated">
                                <a @click="login()"
                                   class="text-neutral-300 hover:text-neutral-200  px-3 py-2 rounded-md text-xs font-medium">Login</a>
                            </div>
                            <div v-else>
                                <a href="/"
                                   class="bg-neutral-900 text-white block px-3 py-2 rounded-md text-base font-medium"
                                   aria-current="page">Dashboard</a>
                            </div>
                        </div>
                        <div v-else>
                            Loading ...
                        </div>
                    </div>
                </div>
            </nav>
        </header>
</template>
<script>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { ChevronDownIcon, UserGroupIcon, SearchIcon, MailIcon } from '@heroicons/vue/outline'

import {useAuth0} from "./utils/useAuth0";

const {login, logout, initAuth} = useAuth0();

export default {
  components: { Popover, PopoverButton, PopoverPanel, ChevronDownIcon, UserGroupIcon, SearchIcon, MailIcon },
  mounted: function()
  {
    setTimeout(() => this.scrollFix(this.$route.hash), 1);
  },
  setup() {
        initAuth();
    },
  methods: {
    login() {
            login()
        },
        logout() {
            logout()
        },
    scrollFix: function(hashbang)
    {
      location.hash = hashbang;
    }
  },

  data() {
    return {
      solutions: [
        {
          name: 'AI Discovery',
          description: 'Identify creators most likely to love your brand ',
          href: 'discovery',
          anchor: '#discovery',
          icon: 'SearchIcon',
        },
        {
          name: 'CRM',
          description: 'Manage your relationships',
          href: 'discovery',
          anchor: '#crm',
          icon: 'UserGroupIcon',
        },
        {
          name: 'Outreach',
          description: 'Onboard new creators at scale',
          href: 'discovery',
          anchor: '#outreach',
          icon: 'MailIcon',
        },
      ],
    }
  },
}
</script>
