<!--
  This example requires Tailwind CSS v2.0+

  This example requires some changes to your config:

  ```
  // tailwind.config.js
  const colors = require('tailwindcss/colors')

  module.exports = {
    // ...
    theme: {
      extend: {
        colors: {
          indigo: colors.indigo,
        },
      },
    },
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
  <div class="bg-white">
    <main>
      <!-- Hero section -->
      <div class="overflow-hidden pt-8 sm:pt-12 lg:relative lg:py-48">
        <div
          class="mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-24 lg:px-8">
          <div>
            <div class="">
              <div>
                <div class="hidden space-x-4 sm:inline-flex">
                  <span
                    class="rounded bg-indigo-50 px-2.5 py-1 text-xs font-semibold uppercase tracking-wide text-indigo-500">
                    Coming soon
                  </span>
                  <span
                    class="inline-flex items-center space-x-1 text-sm font-medium text-neutral-500">
                    <span>Jovie Chrome Extension</span>
                    <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                  </span>
                </div>
              </div>
              <div class="mt-6 sm:max-w-xl">
                <h1
                  class="text-4xl font-extrabold tracking-tight text-indigo-600 sm:text-5xl">
                  Creator insights
                </h1>
                <h1
                  class="-mt-4 text-4xl font-extrabold tracking-tight text-neutral-900 sm:text-5xl">
                  right inside gmail
                </h1>

                <p class="mt-2 text-xs text-gray-500 sm:mt-6 sm:text-xl">
                  See content & social metrics of creators right inside your
                  inbox.
                </p>
              </div>
              <div class="mt-4 sm:mt-12 sm:flex sm:w-full sm:max-w-lg">
                <div v-if="waitlistComplete == false" class="min-w-0">
                  <div class="flex">
                    <label for="hero-email" class="sr-only"
                      >Email address</label
                    >
                    <input
                      v-on:keyup.enter="requestDemo()"
                      v-model="waitListEmail"
                      id="hero-email"
                      type="email"
                      class="block w-full rounded-md border border-gray-300 px-5 py-3 text-base text-gray-900 placeholder-gray-500 shadow-sm focus-visible:border-indigo-500 focus-visible:ring-indigo-500"
                      placeholder="Enter your email" />

                    <ButtonGroup
                      type="button"
                      :loader="loading"
                      @click="requestDemo()"
                      text="Get early access"
                      design="hero">
                    </ButtonGroup>
                  </div>
                  <div>
                    <span
                      class="float-left h-8 px-2 text-xs font-bold text-red-500"
                      >{{ this.error }}</span
                    >
                  </div>
                </div>
                <div v-else class="flex min-w-0">
                  <p class="text-sm text-gray-500">
                    Awesome! We'll be in touch soon.
                  </p>
                </div>
              </div>

              <div class="mt-6">
                <div class="inline-flex items-center divide-x divide-gray-300">
                  <div class="flex flex-shrink-0 pr-5">
                    <StarIcon
                      class="h-5 w-5 text-yellow-400"
                      aria-hidden="true" />
                    <StarIcon
                      class="h-5 w-5 text-yellow-400"
                      aria-hidden="true" />
                    <StarIcon
                      class="h-5 w-5 text-yellow-400"
                      aria-hidden="true" />
                    <StarIcon
                      class="h-5 w-5 text-yellow-400"
                      aria-hidden="true" />
                    <StarIcon
                      class="h-5 w-5 text-yellow-400"
                      aria-hidden="true" />
                  </div>
                  <div
                    class="min-w-0 flex-1 py-1 pl-5 text-sm text-gray-500 sm:py-3">
                    <span class="font-medium text-gray-900">Rated 5 stars</span>
                    by
                    <span class="font-medium text-indigo-500">beta users</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="sm:mx-auto sm:max-w-3xl sm:px-6">
          <div
            class="py-12 sm:relative sm:mt-12 sm:py-16 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <div class="hidden sm:block">
              <svg
                class="absolute top-8 right-1/2 -mr-3 lg:left-0 lg:m-0"
                width="404"
                height="392"
                fill="none"
                viewBox="0 0 404 392">
                <defs>
                  <pattern
                    id="837c3e70-6c3a-44e6-8854-cc48c737b659"
                    x="0"
                    y="0"
                    width="20"
                    height="20"
                    patternUnits="userSpaceOnUse">
                    <rect
                      x="0"
                      y="0"
                      width="4"
                      height="4"
                      class="text-gray-200"
                      fill="currentColor" />
                  </pattern>
                </defs>
                <rect
                  width="404"
                  height="392"
                  fill="url(#837c3e70-6c3a-44e6-8854-cc48c737b659)" />
              </svg>
              <div
                class="absolute inset-y-0 left-1/2 w-screen rounded-l-3xl bg-gray-50 lg:left-80 lg:right-0 lg:w-full">
                <img
                  class="z-10 w-full rounded-md shadow-2xl ring-1 ring-black ring-opacity-5 blur-sm lg:h-full lg:w-auto lg:max-w-none"
                  :src="asset('img/External/gmail.jpeg')"
                  alt="" />
              </div>
            </div>
            <div
              class="relative -mr-20 pl-4 sm:mx-auto sm:max-w-3xl sm:px-0 lg:h-full lg:max-w-none lg:pl-12">
              <img
                class="w-full rounded-md shadow-xl ring-1 ring-black ring-opacity-5 lg:h-full lg:w-auto lg:max-w-none"
                :src="asset('img/External/chrome.webp')"
                alt="" />
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import { defineComponent, h } from 'vue';
import { ChevronRightIcon, StarIcon } from '@heroicons/vue/solid';
import UserService from '../services/api/user.service';
import ButtonGroup from '../components/ButtonGroup';

const stats = [
  { label: 'Founded', value: '2021' },
  { label: 'Employees', value: '5' },
  { label: 'Beta Users', value: '521' },
  { label: 'Raised', value: '$25M' },
];
const logos = [
  {
    name: 'Transistor',
    url: 'https://tailwindui.com/img/logos/transistor-logo-gray-400.svg',
  },
  {
    name: 'Mirage',
    url: 'https://tailwindui.com/img/logos/mirage-logo-gray-400.svg',
  },
  {
    name: 'Tuple',
    url: 'https://tailwindui.com/img/logos/tuple-logo-gray-400.svg',
  },
  {
    name: 'Laravel',
    url: 'https://tailwindui.com/img/logos/laravel-logo-gray-400.svg',
  },
  {
    name: 'StaticKit',
    url: 'https://tailwindui.com/img/logos/statickit-logo-gray-400.svg',
  },
  {
    name: 'Workcation',
    url: 'https://tailwindui.com/img/logos/workcation-logo-gray-400.svg',
  },
];
const footerNavigation = {
  main: [
    { name: 'About', href: '#' },
    { name: 'Blog', href: '#' },
    { name: 'Jobs', href: '#' },
    { name: 'Press', href: '#' },
    { name: 'Accessibility', href: '#' },
    { name: 'Partners', href: '#' },
  ],
  social: [
    {
      name: 'Facebook',
      href: '#',
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
    {
      name: 'Instagram',
      href: '#',
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
      href: '#',
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
      name: 'GitHub',
      href: '#',
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
      name: 'Dribbble',
      href: '#',
      icon: defineComponent({
        render: () =>
          h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', {
              'fill-rule': 'evenodd',
              d: 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z',
              'clip-rule': 'evenodd',
            }),
          ]),
      }),
    },
  ],
};

export default {
  components: {
    ChevronRightIcon,
    StarIcon,
    ButtonGroup,
  },
  setup() {
    return {
      stats,
      logos,
      footerNavigation,
    };
  },
  mounted() {
    window.analytics.page(this.$route.name);
  },
  data() {
    return {
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
        page: 'Extension',
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
};
</script>
