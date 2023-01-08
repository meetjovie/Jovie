<template>
  <div class="dark:bg-jovieDark-900">
    <div v-if="!minimal">
      <footer
        class="bg-slate-50 dark:bg-jovieDark-900"
        aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
          <div class="pb-8 xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="mt-12 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
              <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                  <h3
                    class="dark:text-jovieDark-300dark:text-jovieDark-300 text-sm font-bold uppercase tracking-wider text-slate-700">
                    Product
                  </h3>
                  <ul role="list" class="mt-4 space-y-4">
                    <li v-for="item in navigation.solutions" :key="item.name">
                      <router-link
                        :to="{ name: item.href }"
                        class="text-sm text-slate-500 hover:text-slate-900 dark:text-jovieDark-200 dark:hover:text-jovieDark-100">
                        {{ item.name }}
                      </router-link>
                    </li>
                  </ul>
                </div>
                <div class="mt-12 md:mt-0">
                  <h3
                    class="tracking-widerdark:text-jovieDark-300 text-sm font-bold uppercase text-slate-700">
                    Intergrations
                  </h3>
                  <ul role="list" class="mt-4 space-y-4">
                    <li
                      v-for="item in navigation.intergrations"
                      :key="item.name">
                      <router-link
                        :to="{ name: item.href }"
                        class="text-sm text-slate-500 hover:text-slate-900 dark:text-jovieDark-200 dark:hover:text-jovieDark-100">
                        {{ item.name }}
                      </router-link>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                  <h3
                    class="tracking-widerdark:text-jovieDark-300 text-sm font-bold uppercase text-slate-700">
                    Support
                  </h3>
                  <ul role="list" class="mt-4 space-y-4">
                    <li v-for="item in navigation.support" :key="item.name">
                      <router-link
                        :to="{ name: item.href }"
                        class="text-sm text-slate-500 hover:text-slate-900 dark:text-jovieDark-200 dark:hover:text-jovieDark-100">
                        {{ item.name }}
                      </router-link>
                    </li>
                  </ul>
                </div>

                <div class="mt-12 md:mt-0">
                  <h3
                    class="tracking-widerdark:text-jovieDark-300 text-sm font-bold uppercase text-slate-700">
                    Company
                  </h3>
                  <ul role="list" class="mt-4 space-y-4">
                    <li v-for="item in navigation.company" :key="item.name">
                      <router-link
                        :to="{ name: item.href }"
                        class="text-sm text-slate-500 hover:text-slate-900 dark:text-jovieDark-200 dark:hover:text-jovieDark-100">
                        {{ item.name }}
                      </router-link>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div
              class="mt-8 block justify-between space-y-16 text-left md:mt-0 md:space-y-8 xl:col-span-1">
              <div class="h-1/2">
                <h3
                  class="tracking-widerdark:text-jovieDark-300 text-sm font-bold uppercase text-slate-700">
                  Connect with Jovie
                </h3>
                <div
                  class="mt-4 flex justify-between sm:justify-start sm:space-x-6">
                  <router-link
                    v-for="item in navigation.social"
                    :key="item.name"
                    :to="{ name: item.href }"
                    class="text-slate-400 hover:text-slate-500">
                    <span class="sr-only">{{ item.name }}</span>
                    <component
                      :is="item.icon"
                      class="h-6 w-6"
                      aria-hidden="true" />
                  </router-link>
                </div>

                <div class="mt-6 flex">
                  <svg
                    width="14"
                    class="ml-3"
                    height="14"
                    viewBox="0 0 21 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M4.32616 0.62103C4.11686 0.440896 3.80116 0.464539 3.62103 0.673838L0.685572 4.08457C0.505438 4.29387 0.529081 4.60957 0.738381 4.7897C0.94768 4.96984 1.26338 4.94619 1.44351 4.73689L4.05281 1.70513L7.08457 4.31443C7.29387 4.49456 7.60957 4.47092 7.7897 4.26162C7.96984 4.05232 7.94619 3.73662 7.73689 3.55649L4.32616 0.62103ZM19.9426 20.4458C17.6786 20.7074 14.1467 20.0809 11.0208 17.2875C7.9022 14.5006 5.13882 9.51128 4.4986 0.962659L3.5014 1.03734C4.15556 9.7722 6.99518 15.0311 10.3545 18.0331C13.7065 21.0285 17.5274 21.7315 20.0574 21.4392L19.9426 20.4458Z"
                      fill="#4B5563" />
                  </svg>
                  <span
                    class="font-mediumdark:text-jovieDark-300 ml-1 text-slate-700"
                    >Join the Jovie Slack community</span
                  >
                </div>
              </div>
              <div class="mt-16 sm:mt-0">
                <h3
                  class="text-sm font-bold uppercase tracking-wider text-slate-500">
                  Stay in the loop
                </h3>
                <p class="mt-0 text-xs font-bold tracking-wider text-slate-400">
                  Insights & updates from the team.
                </p>

                <div class="mt-2">
                  <form
                    v-if="waitlistComplete == false"
                    class="mt-4 sm:flex sm:max-w-md lg:mt-0">
                    <label for="email-address" class="sr-only"
                      >Email address</label
                    >
                    <input
                      type="email"
                      v-on:keyup.enter="requestDemo()"
                      v-model="waitListEmail"
                      name="email-address"
                      id="hero-email"
                      autocomplete="email"
                      required=""
                      class="w-full min-w-0 appearance-none rounded-md border border-slate-300 bg-white py-2 px-4 text-base text-slate-900 placeholder-slate-500 focus-visible:border-indigo-500 focus-visible:placeholder-slate-400 focus-visible:outline-none focus-visible:ring-indigo-500 sm:max-w-xs"
                      placeholder="Enter your email" />
                    <div
                      class="mt-3 rounded-md sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                      <ButtonGroup
                        type="submit"
                        :loader="loading"
                        @click="requestDemo()"
                        text="Subscribe"
                        class="bg-black text-white hover:bg-jovieDark-200 hover:bg-slate-900 dark:bg-jovieDark-100 dark:text-jovieDark-900">
                      </ButtonGroup>
                    </div>
                    <div>
                      <span
                        class="float-left h-8 px-2 text-xs font-bold text-red-500 dark:text-red-200"
                        >{{ error }}</span
                      >
                    </div>
                  </form>
                  <div v-else class="flex min-w-0">
                    <p class="text-sm text-slate-500 dark:text-jovieDark-200">
                      You're subscribed!
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <footer class="bg-slate-50 dark:bg-jovieDark-900">
      <div
        class="mx-auto max-w-7xl py-12 px-4 sm:px-6 md:flex md:justify-between lg:px-8">
        <div class="mt-8 md:order-1 md:mt-0"></div>
        <div class="flex justify-center space-x-6 md:order-1">
          <div class="flex items-center">
            <p
              v-if="minimal"
              class="justify-right items-center text-center text-xs text-slate-400">
              <span class="divide divide-x-1 flex divide-slate-200">
                <router-link class="px-2 hover:text-slate-700" to="Careers">
                  Careers</router-link
                >
                <router-link class="px-2 hover:text-slate-700" to="API"
                  >API</router-link
                >
                <router-link class="px-2 hover:text-slate-700" to="Pricing"
                  >Pricing</router-link
                >
                <router-link class="px-2 hover:text-slate-700" to="Privacy"
                  >Legal</router-link
                >
                <router-link class="px-2 hover:text-slate-700" to="Status"
                  >Status</router-link
                >
              </span>
            </p>
            <div class="ml-8 text-center text-2xs text-slate-400/75">
              <div class="block items-center sm:inline">
                <ul class="flex items-center justify-center">
                  <li class="px-2">&copy; {{ currentYear }} Jovie Inc</li>
                  <li class="px-2">
                    <router-link class="hover:text-slate-700" to="Privacy"
                      >Privacy</router-link
                    >
                  </li>
                  <li class="px-2">
                    <router-link class="hover:text-slate-700" to="Terms"
                      >Terms</router-link
                    >
                  </li>
                  <li class="px-2">
                    <DarkModeToggle />
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="baseline">
          <router-link
            to="Home"
            class="group text-slate-400 hover:text-slate-500">
            <JovieLogo
              class="opacity-50 group-hover:opacity-100"
              height="20px" />
          </router-link>
        </div>
      </div>
    </footer>
  </div>
</template>
<script>
import DarkModeToggle from '../../components/DarkModeToggle.vue';
import UserService from '../../services/api/user.service.js';

export default {
  data() {
    return {
      currentYear: new Date().getFullYear(),
      waitListEmail: '',
      error: '',
      loading: false,
      waitlistComplete: false,
    };
  },
  methods: {
    async requestDemo() {
      this.loading = true;
      await UserService.addToWaitList({
        email: this.waitListEmail,
        page: 'Footer',
      })
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.waitListEmail = '';
            this.error = null;
            this.loading = false;
            this.waitlistComplete = true;
          }
        })
        .catch((error) => {
          error = error.response;
          this.loading = false;
          if (error.status == 422) {
            this.error = error.data.errors.email[0];
          }
        });
    },
  },
  props: {
    minimal: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
<script setup>
import { defineComponent, h } from 'vue';
import JovieLogo from '../JovieLogo.vue';
import ButtonGroup from '../ButtonGroup.vue';
const navigation = {
  solutions: [
    { name: 'Social CRM', href: 'Home' },
    { name: 'Contact Profiles', href: 'Jovie Profile' },
    { name: 'Chrome Extension', href: 'Chrome Extension' },
  ],
  support: [
    //add changelog
    { name: 'Pricing', href: 'Pricing' },
    { name: 'Changelog', href: 'Changelog' },

    { name: 'Roadmap', href: 'Roadmap' },
    { name: 'Get Help', href: 'Support' },

    { name: 'Status', href: 'Status' },
  ],
  company: [
    { name: 'Meet Jovie', href: 'Meet Jovie' },
    { name: 'Careers', href: 'Careers' },
    { name: 'API', href: 'API' },
    { name: 'Community', href: 'Slack Community' },

    /*  { name: 'Our Data', href: 'data' }, */
    { name: 'Legal', href: 'Legal' },
  ],
  intergrations: [
    { name: 'Jovie for Instagram', href: 'Chrome Extension' },
    { name: 'Jovie for TikTok', href: 'Chrome Extension' },
    { name: 'Jovie for Twitch', href: 'Chrome Extension' },
    { name: 'Jovie for Twitter', href: 'Chrome Extension' },
  ],
  social: [
    {
      name: 'Slack',
      href: 'Slack Community',
      icon: defineComponent({
        render: () =>
          h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', {
              d: 'M5.042 15.165a2.528 2.528 0 0 1-2.52 2.523A2.528 2.528 0 0 1 0 15.165a2.527 2.527 0 0 1 2.522-2.52h2.52v2.52zM6.313 15.165a2.527 2.527 0 0 1 2.521-2.52 2.527 2.527 0 0 1 2.521 2.52v6.313A2.528 2.528 0 0 1 8.834 24a2.528 2.528 0 0 1-2.521-2.522v-6.313zM8.834 5.042a2.528 2.528 0 0 1-2.521-2.52A2.528 2.528 0 0 1 8.834 0a2.528 2.528 0 0 1 2.521 2.522v2.52H8.834zM8.834 6.313a2.528 2.528 0 0 1 2.521 2.521 2.528 2.528 0 0 1-2.521 2.521H2.522A2.528 2.528 0 0 1 0 8.834a2.528 2.528 0 0 1 2.522-2.521h6.312zM18.956 8.834a2.528 2.528 0 0 1 2.522-2.521A2.528 2.528 0 0 1 24 8.834a2.528 2.528 0 0 1-2.522 2.521h-2.522V8.834zM17.688 8.834a2.528 2.528 0 0 1-2.523 2.521 2.527 2.527 0 0 1-2.52-2.521V2.522A2.527 2.527 0 0 1 15.165 0a2.528 2.528 0 0 1 2.523 2.522v6.312zM15.165 18.956a2.528 2.528 0 0 1 2.523 2.522A2.528 2.528 0 0 1 15.165 24a2.527 2.527 0 0 1-2.52-2.522v-2.522h2.52zM15.165 17.688a2.527 2.527 0 0 1-2.52-2.523 2.526 2.526 0 0 1 2.52-2.52h6.313A2.527 2.527 0 0 1 24 15.165a2.528 2.528 0 0 1-2.522 2.523h-6.313z',
            }),
          ]),
      }),
    },
    {
      name: 'Instagram',
      href: 'Jovie Instagram',
      icon: defineComponent({
        render: () =>
          h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', {
              'fill-rule': 'evenodd',
              d: 'M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z',
              'clip-rule': 'evenodd',
            }),
          ]),
      }),
    },

    {
      name: 'Twitter',
      href: 'Jovie Twitter',
      icon: defineComponent({
        render: () =>
          h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', {
              d: 'M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84',
            }),
          ]),
      }),
    },
    {
      name: 'LinkedIn',
      href: 'Jovie LinkedIn',
      icon: defineComponent({
        render: () =>
          h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', {
              d: 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z',
            }),
          ]),
      }),
    },
    {
      name: 'GitHub',
      href: 'Jovie Github',
      icon: defineComponent({
        render: () =>
          h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', {
              'fill-rule': 'evenodd',
              d: 'M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z',
              'clip-rule': 'evenodd',
            }),
          ]),
      }),
    },
    {
      name: 'Facebook',
      href: 'Jovie Facebook',
      icon: defineComponent({
        render: () =>
          h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', {
              'fill-rule': 'evenodd',
              d: 'M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z',
              'clip-rule': 'evenodd',
            }),
          ]),
      }),
    },
  ],
};
</script>
