<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="relative bg-gray-50">
    <main class="lg:relative">
      <div
        class="mx-auto w-full max-w-7xl pt-16 pb-20 text-center lg:py-48 lg:text-left">
        <div class="px-4 sm:px-8 lg:w-1/2 xl:pr-16">
          <h1
            class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl lg:text-5xl xl:text-5xl">
            <span class="block xl:inline">Enrich your contacts</span>
            {{ ' ' }}
            <span class="block text-neutral-900 xl:inline"
              >with <span class="text-indigo-600">social data</span></span
            >
          </h1>
          <p
            class="mx-auto mt-3 max-w-md text-lg text-gray-500 sm:text-xl md:mt-5 md:max-w-3xl">
            Get instant insight into every relationship. Jovie aggregates social
            data from across the web so you have context for every contact.
          </p>
          <div class="mt-10 sm:flex sm:justify-center lg:justify-start">
            <div class="rounded-md shadow">
              <router-link
                to="signup"
                class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-1.5 text-base font-medium text-white hover:bg-indigo-700 md:py-4 md:px-10 md:text-lg">
                Get Started
              </router-link>
            </div>
            <!-- <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
              <a
                href="#"
                class="flex w-full items-center justify-center rounded-md border border-transparent bg-white px-8 py-3 text-base font-medium text-indigo-600 hover:bg-gray-50 md:py-4 md:px-10 md:text-lg">
                Live demo
              </a>
            </div> -->
          </div>
        </div>
      </div>
      <div
        class="relative h-64 w-full sm:h-72 md:h-96 lg:absolute lg:inset-y-0 lg:right-0 lg:h-full lg:w-1/2">
        <img
          class="absolute inset-0 h-full w-full object-cover"
          src="https://images.unsplash.com/photo-1520333789090-1afc82db536a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2102&q=80"
          alt="" />
      </div>
    </main>
    <HomeCTA2 />
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
