<template>
  <div class="">
    <!-- Pricing with four tiers and toggle -->
    <div class="h-screen bg-gradient-to-b from-white to-gray-50">
      <div class="mx-auto max-w-7xl px-4 pt-24 sm:px-6 lg:px-8">
        <div class="sm:align-center sm:flex sm:flex-col">
          <h1 class="text-5xl font-extrabold text-gray-900 sm:text-center">
            Jovie Pricing
          </h1>
          <p class="mt-5 text-xl text-gray-500 sm:text-center">
            Pricing that scales.
          </p>
          <div
            class="relative mt-6 flex self-center rounded-lg bg-gray-100 p-0.5 sm:mt-8">
            <button
              @click="billing = 'monthly'"
              type="button"
              :class="[
                {
                  'border-gray-200 bg-white text-gray-700 ':
                    billing == 'monthly',
                },
                'rounded-lg text-gray-900 ',
              ]"
              class="relative w-1/2 whitespace-nowrap rounded-md py-2 text-sm font-medium shadow-sm focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:w-auto sm:px-8">
              Monthly billing
            </button>
            <button
              @click="billing = 'annual'"
              type="button"
              class="relative ml-0.5 w-1/2 whitespace-nowrap rounded-md border border-transparent py-2 text-sm font-medium text-gray-700 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:w-auto sm:px-8">
              Yearly billing
            </button>
          </div>
        </div>
        <div
          class="mt-12 space-y-4 sm:mt-16 sm:grid sm:grid-cols-2 sm:gap-6 sm:space-y-0 lg:mx-auto lg:max-w-4xl xl:mx-0 xl:max-w-none xl:grid-cols-3">
          <div
            v-for="tier in tiers"
            :key="tier.name"
            class="divide-y divide-gray-200 rounded-lg border border-gray-200 shadow-sm">
            <div class="p-6">
              <h2 class="text-lg font-medium leading-6 text-gray-900">
                {{ tier.name }}
              </h2>
              <p class="mt-4 text-sm text-gray-500">{{ tier.description }}</p>
              <p class="mt-8">
                <span class="text-4xl font-extrabold text-gray-900"
                  >${{ tier.priceMonthly }}</span
                >
                {{ ' ' }}
                <span class="text-base font-medium text-gray-500">/mo</span>
              </p>
              <a
                :href="tier.href"
                class="mt-8 block w-full rounded-md border border-transparent bg-indigo-600 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-700"
                >Buy {{ tier.name }}</a
              >
            </div>
            <div class="px-6 pt-6 pb-8">
              <h3
                class="text-xs font-medium uppercase tracking-wide text-gray-900">
                What's included
              </h3>
              <ul role="list" class="mt-6 space-y-4">
                <li
                  v-for="feature in tier.features"
                  :key="feature"
                  class="flex space-x-3">
                  <CheckIconSolid
                    class="h-5 w-5 flex-shrink-0 text-green-500"
                    aria-hidden="true" />
                  <span class="text-sm text-gray-500">{{ feature }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, h } from 'vue';
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
  CheckIcon as CheckIconOutline,
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
import {
  CheckIcon as CheckIconSolid,
  ChevronDownIcon,
} from '@heroicons/vue/solid';

const solutions = [
  {
    name: 'Analytics',
    description:
      'Get a better understanding of where your traffic is coming from.',
    href: '#',
    icon: ChartBarIcon,
  },
  {
    name: 'Engagement',
    description: 'Speak directly to your customers in a more meaningful way.',
    href: '#',
    icon: CursorClickIcon,
  },
  {
    name: 'Security',
    description: "Your customers' data will be safe and secure.",
    href: '#',
    icon: ShieldCheckIcon,
  },
  {
    name: 'Integrations',
    description: "Connect with third-party tools that you're already using.",
    href: '#',
    icon: ViewGridIcon,
  },
  {
    name: 'Automations',
    description:
      'Build strategic funnels that will drive your customers to convert',
    href: '#',
    icon: RefreshIcon,
  },
];

const billing = 'monthly';

const tiers = [
  {
    name: 'Professional',
    href: '#',
    priceMonthly: 199,
    description: 'For freelancers',
    features: [
      '500 contact credits/month',
      'Database of 2M+ creators',
      'Blazing fast search',
      'CRM, CSV exports,',
    ],
  },
  {
    name: 'Team',
    href: '#',
    priceMonthly: 499,
    description: 'Built for startups and growing teams',
    features: [
      'Everything in the Professional plan, plus:',
      '2,500 contact credits/month',
      'Collaboration & team managment.',
      'Additional seats $99/mo',
    ],
  },
  {
    name: 'Enterprise',
    href: '#',
    priceMonthly: 2499,
    description: 'For large teams and enterprises',
    features: [
      '10,000 contact credits/month',
      '5 Seats',
      'Dedicated support',
      'Additional seats $99/mo',
    ],
  },
];

export default {
  components: {
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    CheckIconOutline,
    CheckIconSolid,
    ChevronDownIcon,
    MenuIcon,
    XIcon,
  },
  setup() {
    return {
      tiers,
      billing,
    };
  },
};
</script>
