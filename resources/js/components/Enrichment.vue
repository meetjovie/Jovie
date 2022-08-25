<template>
  <div v-if="dark" class="relative bg-gray-800">
    <div class="bg-gray-900 pt-10 sm:pt-16 lg:overflow-hidden lg:pt-8 lg:pb-14">
      <div class="mx-auto max-w-7xl lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
          <div
            class="mx-auto max-w-md px-4 sm:max-w-2xl sm:px-6 sm:text-center lg:flex lg:items-center lg:px-0 lg:text-left">
            <div class="lg:py-24">
              <!--  <a
                href="#"
                class="inline-flex items-center rounded-full bg-black p-1 pr-2 text-white hover:text-gray-200 sm:text-base lg:text-sm xl:text-base">
                <span
                  class="rounded-full bg-indigo-500 px-3 py-0.5 text-xs font-semibold uppercase leading-5 tracking-wide text-white"
                  >Data enrichment</span
                >
                <span class="ml-4 text-sm">powered by Jovie</span>
                <ChevronRightIcon
                  class="ml-2 h-5 w-5 text-gray-500"
                  aria-hidden="true" />
              </a> -->
              <h1
                class="mt-4 text-4xl font-extrabold tracking-tight text-white sm:mt-5 sm:text-6xl lg:mt-6 xl:text-5xl">
                <span class="block">Enrich your contacts</span>
                <span class="block text-indigo-400">with social data</span>
              </h1>
              <p
                class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                Get instant insight into every relationship. Jovie aggregates
                social data from across the web so you have context for every
                contact.
              </p>
              <div class="mt-10 sm:mt-12">
                <form action="#" class="sm:mx-auto sm:max-w-xl lg:mx-0">
                  <div class="sm:flex">
                    <div class="min-w-0 flex-1">
                      <label for="email" class="sr-only">Email address</label>
                      <input
                        id="email"
                        type="email"
                        v-on:keyup.enter="requestDemo() && identifyUser()"
                        v-model="waitListEmail"
                        placeholder="Enter your email"
                        class="block w-full rounded-md border-0 px-4 py-3 text-base text-gray-900 placeholder-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-900" />
                    </div>
                    <div class="mt-3 sm:mt-0 sm:ml-3">
                      <ButtonGroup
                        :loader="loading"
                        @click="requestDemo() && identifyUser()"
                        size="base"
                        design="primary"
                        text="Get started free" />
                    </div>
                  </div>
                  <span
                    class="float-left px-2 text-xs font-bold text-red-500"
                    >{{ error }}</span
                  >
                  <p class="mt-3 text-xs text-gray-300 sm:mt-4">
                    No credit card required.
                  </p>
                </form>
              </div>
            </div>
          </div>
          <div class="mt-12 -mb-16 sm:-mb-48 lg:relative lg:m-0">
            <img
              class="w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
              :src="asset('img/External/jovie_social_data_enrichment.png')"
              alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="relative bg-gray-50">
    <div class="bg-gray-50 pt-10 sm:pt-16 lg:overflow-hidden lg:pt-8 lg:pb-14">
      <div class="mx-auto max-w-7xl lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
          <div
            class="mx-auto max-w-md px-4 sm:max-w-7xl sm:px-6 sm:text-center lg:flex lg:items-center lg:px-0 lg:text-left">
            <div class="lg:py-24">
              <!--  <a
                href="#"
                class="inline-flex items-center rounded-full bg-black p-1 pr-2 text-white hover:text-gray-200 sm:text-base lg:text-sm xl:text-base">
                <span
                  class="rounded-full bg-indigo-500 px-3 py-0.5 text-xs font-semibold uppercase leading-5 tracking-wide text-white"
                  >Data enrichment</span
                >
                <span class="ml-4 text-sm">powered by Jovie</span>
                <ChevronRightIcon
                  class="ml-2 h-5 w-5 text-gray-500"
                  aria-hidden="true" />
              </a> -->
              <h1
                class="mt-4 text-4xl font-extrabold tracking-tight text-neutral-900 sm:mt-5 sm:text-6xl lg:mt-6 xl:text-5xl">
                <span class="block">Instant Enrich Contacts</span>
                <span class="block text-indigo-600">With Social Data</span>
              </h1>
              <p
                class="mt-3 text-base text-gray-700 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                Get instant insight into every relationship. Jovie aggregates
                social data from across the web so you have context for every
                contact.
              </p>
              <div class="mt-10 sm:mt-12">
                <form action="#" class="sm:mx-auto sm:max-w-xl lg:mx-0">
                  <div class="sm:flex">
                    <div class="min-w-0 flex-1">
                      <label for="email" class="sr-only">Email address</label>
                      <input
                        id="email"
                        type="email"
                        v-on:keyup.enter="requestDemo() && identifyUser()"
                        v-model="waitListEmail"
                        placeholder="Enter your email"
                        class="block w-full rounded-md border-0 px-4 py-3 text-base text-gray-900 placeholder-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-900" />
                    </div>
                    <div class="mt-3 sm:mt-0 sm:ml-3">
                      <ButtonGroup
                        :loader="loading"
                        @click="requestDemo() && identifyUser()"
                        size="base"
                        design="primary"
                        text="Get started free" />
                    </div>
                  </div>
                  <span
                    class="float-left px-2 text-xs font-bold text-red-500"
                    >{{ error }}</span
                  >
                  <p class="mt-3 text-xs text-gray-700 sm:mt-4">
                    No credit card required.
                  </p>
                </form>
              </div>
            </div>
          </div>
          <div class="mt-12 -mb-16 sm:-mb-48 lg:m-0">
            <img
              class="w-full object-fill lg:absolute lg:inset-y-0 lg:right-0 lg:h-full lg:w-auto lg:max-w-none"
              :src="asset('img/External/jovie_social_data_enrichment.png')"
              alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import {
  Popover,
  PopoverButton,
  PopoverGroup,
  PopoverPanel,
} from '@headlessui/vue';
import {
  BookmarkAltIcon,
  CalendarIcon,
  ChartBarIcon,
  CursorClickIcon,
  MenuIcon,
  PhoneIcon,
  PlayIcon,
  RefreshIcon,
  ShieldCheckIcon,
  SupportIcon,
  ViewGridIcon,
  XIcon,
} from '@heroicons/vue/outline';
import { ChevronDownIcon } from '@heroicons/vue/solid';
import ButtonGroup from '../components/ButtonGroup.vue';
import HomeCTA2 from '../components/Home/HomeCTA2.vue';

const features = [
  {
    name: 'Analytics',
    href: '#',
    description:
      'Get a better understanding of where your traffic is coming from.',
    icon: ChartBarIcon,
  },
  {
    name: 'Engagement',
    href: '#',
    description: 'Speak directly to your customers in a more meaningful way.',
    icon: CursorClickIcon,
  },
  {
    name: 'Security',
    href: '#',
    description: "Your customers' data will be safe and secure.",
    icon: ShieldCheckIcon,
  },
  {
    name: 'Integrations',
    href: '#',
    description: "Connect with third-party tools that you're already using.",
    icon: ViewGridIcon,
  },
  {
    name: 'Automations',
    href: '#',
    description:
      'Build strategic funnels that will drive your customers to convert',
    icon: RefreshIcon,
  },
];
const callsToAction = [
  { name: 'Watch Demo', href: '#', icon: PlayIcon },
  { name: 'Contact Sales', href: '#', icon: PhoneIcon },
];
const resources = [
  {
    name: 'Help Center',
    description:
      'Get all of your questions answered in our forums or contact support.',
    href: '#',
    icon: SupportIcon,
  },
  {
    name: 'Guides',
    description:
      'Learn how to maximize our platform to get the most out of it.',
    href: '#',
    icon: BookmarkAltIcon,
  },
  {
    name: 'Events',
    description:
      'See what meet-ups and other events we might be planning near you.',
    href: '#',
    icon: CalendarIcon,
  },
  {
    name: 'Security',
    description: 'Understand how we take your privacy seriously.',
    href: '#',
    icon: ShieldCheckIcon,
  },
];
const recentPosts = [
  { id: 1, name: 'Boost your conversion rate', href: '#' },
  {
    id: 2,
    name: 'How to use search engine optimization to drive traffic to your site',
    href: '#',
  },
  { id: 3, name: 'Improve your customer experience', href: '#' },
];
</script>
<script>
import UserService from '../services/api/user.service';
export default {
  mounted() {
    //add segment analytics
    window.analytics.page(this.$route.path);
  },
  data() {
    return {
      waitListEmail: '',
      error: '',
      loading: false,
      waitlistComplete: false,
    };
  },
  props: {
    dark: {
      type: Boolean,
      default: true,
    },
  },
  methods: {
    async identifyUser() {
      //segment identify call
      window.analytics.identify({
        email: this.waitListEmail,
      });
      //segment track call
      window.analytics.track('Initated Sign Up');
    },
    async requestDemo() {
      this.loading = true;
      await UserService.addToWaitList({
        email: this.waitListEmail,
        page: 'Enrichment',
      })
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$store.commit('setAddedToWaitList');
            this.waitListEmail = '';
            this.error = null;
            this.loading = false;
            this.waitlistComplete = true;
            this.$router.push('signup');
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
