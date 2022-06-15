<template>
  <div v-if="!minimal">
    <footer class="bg-neutral-50" aria-labelledby="footer-heading">
      <h2 id="footer-heading" class="sr-only">Footer</h2>
      <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        <div class="pb-8 xl:grid xl:grid-cols-3 xl:gap-8">
          <div class="text-left xl:col-span-1">
            <div>
              <h3
                class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                Stay in the loop
              </h3>
              <p
                class="mt-0 text-xs font-semibold tracking-wider text-gray-400">
                Insights & updates from the team.
              </p>
            </div>
            <div class="mt-2">
              <form
                v-if="waitlistComplete == false"
                class="mt-4 sm:flex sm:max-w-md lg:mt-0">
                <label for="email-address" class="sr-only">Email address</label>
                <input
                  type="email"
                  v-on:keyup.enter="requestDemo()"
                  v-model="waitListEmail"
                  name="email-address"
                  id="hero-email"
                  autocomplete="email"
                  required=""
                  class="w-full min-w-0 appearance-none rounded-md border border-gray-300 bg-white py-2 px-4 text-base text-gray-900 placeholder-gray-500 focus-visible:border-indigo-500 focus-visible:placeholder-gray-400 focus-visible:outline-none focus-visible:ring-indigo-500 sm:max-w-xs"
                  placeholder="Enter your email" />
                <div class="mt-3 rounded-md sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                  <ButtonGroup
                    type="submit"
                    :loader="loading"
                    @click="requestDemo()"
                    text="Subscribe"
                    design="hero">
                  </ButtonGroup>
                </div>
                <div>
                  <span
                    class="float-left h-8 px-2 text-xs font-bold text-red-500"
                    >{{ this.error }}</span
                  >
                </div>
              </form>
              <div v-else class="flex min-w-0">
                <p class="text-sm text-gray-500">You're subscribed!</p>
              </div>
            </div>

            <div class="mt-4 flex space-x-6">
              <a
                v-for="item in navigation.social"
                :key="item.name"
                :href="item.href"
                class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">{{ item.name }}</span>
                <component :is="item.icon" class="h-6 w-6" aria-hidden="true" />
              </a>
            </div>
          </div>
          <div class="mt-12 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
            <div class="md:grid md:grid-cols-2 md:gap-8">
              <div>
                <h3
                  class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                  Product
                </h3>
                <ul role="list" class="mt-4 space-y-4">
                  <li v-for="item in navigation.solutions" :key="item.name">
                    <a
                      :href="item.href"
                      class="text-sm text-gray-500 hover:text-gray-900">
                      {{ item.name }}
                    </a>
                  </li>
                </ul>
              </div>
              <div class="mt-12 md:mt-0">
                <h3
                  class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                  Features
                </h3>
                <ul role="list" class="mt-4 space-y-4">
                  <li v-for="item in navigation.features" :key="item.name">
                    <a
                      :href="item.href"
                      class="text-sm text-gray-500 hover:text-gray-900">
                      {{ item.name }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="md:grid md:grid-cols-2 md:gap-8">
              <div>
                <h3
                  class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                  Support
                </h3>
                <ul role="list" class="mt-4 space-y-4">
                  <li v-for="item in navigation.support" :key="item.name">
                    <router-link
                      :to="item.href"
                      class="text-sm text-gray-500 hover:text-gray-900">
                      {{ item.name }}
                    </router-link>
                  </li>
                </ul>
              </div>

              <div class="mt-12 md:mt-0">
                <h3
                  class="text-sm font-semibold uppercase tracking-wider text-gray-400">
                  Company
                </h3>
                <ul role="list" class="mt-4 space-y-4">
                  <li v-for="item in navigation.company" :key="item.name">
                    <a
                      :href="item.href"
                      class="text-sm text-gray-500 hover:text-gray-900">
                      {{ item.name }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <footer class="bg-neutral-50">
    <div
      class="mx-auto max-w-7xl py-12 px-4 sm:px-6 md:flex md:justify-between lg:px-8">
      <div class="mt-8 md:order-1 md:mt-0"></div>
      <div class="flex justify-center space-x-6 md:order-1">
        <div class="flex items-center">
          <p
            v-if="minimal"
            class="justify-right items-center text-center text-xs text-gray-400">
            <span class="divide divide-x-1 flex divide-gray-200">
              <router-link class="px-2 hover:text-neutral-700" to="/careers">
                Careers</router-link
              >
              <router-link class="px-2 hover:text-neutral-700" to="/api"
                >API</router-link
              >
              <router-link class="px-2 hover:text-neutral-700" to="/pricing"
                >Pricing</router-link
              >
              <router-link class="px-2 hover:text-neutral-700" to="/privacy"
                >Legal</router-link
              >
              <router-link class="px-2 hover:text-neutral-700" to="/status"
                >Status</router-link
              >
            </span>
          </p>
          <p class="ml-8 text-center text-2xs text-neutral-400/75">
            <span class="block sm:inline"
              >&copy; {{ currentYear }} Jovie Inc</span
            >
          </p>
        </div>
      </div>
      <div class="baseline">
        <a href="/" class="group text-gray-400 hover:text-gray-500">
          <div>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              width="138px"
              height="40px"
              class="opacity-50 group-hover:opacity-100">
              <path
                fill-rule="evenodd"
                fill="rgb(0, 0, 0)"
                d="M57.964,14.130 C58.057,14.960 58.283,15.578 58.639,15.984 C59.141,16.568 59.795,16.861 60.602,16.861 C61.111,16.861 61.596,16.734 62.054,16.480 C62.335,16.319 62.636,16.035 62.959,15.629 L68.068,16.099 C67.287,17.453 66.344,18.425 65.240,19.013 C64.135,19.602 62.551,19.896 60.487,19.896 C58.695,19.896 57.284,19.644 56.257,19.140 C55.229,18.637 54.377,17.836 53.702,16.740 C53.027,15.644 52.689,14.355 52.689,12.873 C52.689,10.765 53.366,9.059 54.721,7.755 C56.076,6.451 57.947,5.799 60.334,5.799 C62.271,5.799 63.800,6.091 64.921,6.675 C66.042,7.260 66.896,8.106 67.482,9.215 C68.068,10.325 68.362,11.768 68.362,13.546 L68.362,14.130 L57.964,14.130 ZM62.277,9.507 C61.840,9.076 61.264,8.860 60.551,8.860 C59.727,8.860 59.068,9.186 58.576,9.838 C58.261,10.244 58.062,10.849 57.977,11.654 L63.086,11.654 C62.984,10.655 62.715,9.939 62.277,9.507 ZM46.406,6.104 L51.592,6.104 L51.592,19.591 L46.406,19.591 L46.406,6.104 ZM46.406,0.973 L51.592,0.973 L51.592,4.491 L46.406,4.491 L46.406,0.973 ZM35.939,19.591 L30.311,6.104 L35.707,6.104 L38.332,14.651 L41.056,6.104 L46.289,6.104 L40.538,19.591 L35.939,19.591 ZM29.730,17.908 C28.349,19.233 26.440,19.896 24.002,19.896 C21.827,19.896 20.069,19.346 18.727,18.245 C17.079,16.882 16.255,15.095 16.255,12.886 C16.255,10.828 16.951,9.133 18.345,7.799 C19.738,6.466 21.619,5.799 23.989,5.799 C26.699,5.799 28.746,6.582 30.131,8.149 C31.244,9.410 31.800,10.964 31.800,12.809 C31.800,14.884 31.110,16.583 29.730,17.908 ZM25.863,10.212 C25.378,9.641 24.779,9.355 24.066,9.355 C23.310,9.355 22.685,9.645 22.193,10.225 C21.700,10.805 21.454,11.688 21.454,12.873 C21.454,14.075 21.698,14.964 22.186,15.540 C22.675,16.116 23.289,16.403 24.028,16.403 C24.775,16.403 25.389,16.120 25.869,15.553 C26.349,14.985 26.589,14.075 26.589,12.822 C26.589,11.654 26.347,10.784 25.863,10.212 ZM12.781,18.754 C11.639,19.524 10.176,19.908 8.392,19.908 C6.506,19.908 5.045,19.655 4.009,19.147 C2.972,18.639 2.171,17.896 1.607,16.918 C1.042,15.940 0.708,14.731 0.606,13.292 L6.124,12.543 C6.132,13.364 6.204,13.974 6.340,14.371 C6.476,14.769 6.705,15.091 7.028,15.337 C7.249,15.498 7.564,15.578 7.971,15.578 C8.617,15.578 9.090,15.339 9.392,14.861 C9.693,14.383 9.844,13.577 9.844,12.444 L9.844,0.973 L15.629,0.973 L15.629,11.088 C15.629,13.212 15.440,14.828 15.062,15.936 C14.684,17.045 13.924,17.984 12.781,18.754 Z" />
            </svg>
          </div>
        </a>
      </div>
    </div>
  </footer>
</template>
<script>
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
import JovieLogo from '../JovieLogo';
import ButtonGroup from '../ButtonGroup.vue';
const navigation = {
  solutions: [
    { name: 'Creator Search', href: '/' },
    { name: 'Social CRM', href: '/' },

    { name: 'Chrome Extension', href: 'chrome-extension' },
  ],
  support: [
    { name: 'Pricing', href: 'pricing' },
    { name: 'Get Help', href: 'support' },
    { name: 'API', href: 'api' },
    { name: 'Status', href: 'https://jovie.statuspage.io/' },
  ],
  company: [
    { name: 'About', href: 'about' },
    { name: 'Careers', href: 'careers' },

    { name: 'Our Data', href: 'data' },
    { name: 'Legal', href: 'legal' },
  ],
  features: [
    { name: 'Social Data', href: '/' },
    { name: 'Data Enrichment', href: 'enrichment' },
  ],
  social: [
    {
      name: 'Facebook',
      href: 'https://facebook.com/meetjovie',
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
      href: 'http://instagram.com/meetjovie',
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
      href: 'http://twitter.com/meetjovie',
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
      href: 'https://github.com/meetjovie',
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
  ],
};
</script>
