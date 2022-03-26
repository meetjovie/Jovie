<template>
  <div class="">
    <!-- Pricing with four tiers and toggle -->
    <div class="h-screen bg-gradient-to-b from-white to-neutral-50">
      <div class="mx-auto max-w-7xl px-4 pt-24 sm:px-6 lg:px-8">
        <div class="sm:align-center sm:flex sm:flex-col">
          <h1 class="text-5xl font-extrabold text-neutral-900 sm:text-center">
            Jovie Pricing
          </h1>
          <p class="mt-5 text-xl text-neutral-500 sm:text-center">
            Everything you need to scale your creator partnerships.
          </p>

          <div
            class="relative mt-6 flex self-center rounded-lg bg-neutral-200 py-1 px-2 sm:mt-8">
            <SwitchGroup as="div" class="flex items-center">
              <div class="flex items-center">
                <Switch
                  v-model="annualBilling"
                  :class="annualBilling ? 'bg-neutral-200' : 'bg-neutral-200'"
                  class="relative inline-flex h-14 w-96 items-center rounded-md transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                  <span
                    :class="annualBilling ? 'translate-x-0' : 'translate-x-48'"
                    class="inline-block h-12 w-1/2 transform rounded-md bg-white transition-transform" />
                  <div class="absolute mx-auto grid w-full grid-cols-2">
                    <div
                      :class="
                        annualBilling ? 'text-neutral-700' : 'text-neutral-500'
                      "
                      class="text-sm font-medium focus-visible:z-10 focus-visible:ring-2 focus-visible:ring-indigo-500 sm:w-auto sm:px-8">
                      Yearly Billing
                    </div>
                    <div
                      :class="
                        annualBilling ? 'text-neutral-500' : 'text-neutral-700'
                      "
                      class="text-sm font-medium text-neutral-700 focus-visible:z-10 focus-visible:ring-2 focus-visible:ring-indigo-500 sm:w-auto sm:px-8">
                      Monthly Billing
                    </div>
                  </div>
                </Switch>
              </div>
            </SwitchGroup>
          </div>
        </div>
        <div
          class="mt-12 space-y-4 sm:mt-16 sm:grid sm:grid-cols-2 sm:gap-6 sm:space-y-0 lg:mx-auto lg:max-w-4xl xl:mx-0 xl:max-w-none xl:grid-cols-3">
          <div
            v-for="tier in tiers"
            :key="tier.name"
            class="divide-y divide-neutral-200 rounded-lg border border-neutral-200 shadow-sm">
            <div class="p-6">
              <h2 class="text-lg font-medium leading-6 text-neutral-900">
                {{ tier.name }}
              </h2>
              <p class="mt-4 text-sm text-neutral-500">
                {{ tier.description }}
              </p>
              <p v-if="annualBilling" class="mt-8">
                <span class="text-4xl font-extrabold text-neutral-900"
                  >${{ (tier.priceAnnual / 12).toFixed(2) }}</span
                >
                {{ ' ' }}
                <span class="text-base font-medium text-neutral-500">/mo</span>
                <br />
                <span class="text-sm font-medium text-neutral-500"
                  >Billed yearly as ${{ tier.priceAnnual.toFixed(2) }}</span
                >
              </p>
              <p v-else class="mt-8">
                <span class="text-4xl font-extrabold text-neutral-900"
                  >${{ tier.priceMonthly }}</span
                >
                {{ ' ' }}
                <span class="text-base font-medium text-neutral-500">/mo</span>
                <br />
                <span class="text-sm font-medium text-neutral-500"
                  >Billed monthly</span
                >
              </p>
              <a
                :href="tier.href"
                class="mt-8 block w-full rounded-md border border-transparent bg-indigo-600 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-700"
                >Buy {{ tier.name }}</a
              >
            </div>
            <div class="px-6 pt-6 pb-8">
              <h3
                class="text-xs font-medium uppercase tracking-wide text-neutral-900">
                What's included
              </h3>
              <ul role="list" class="mt-6 space-y-4">
                <li
                  v-for="feature in tier.features"
                  :key="feature"
                  class="flex space-x-3">
                  <CheckIcon
                    class="h-5 w-5 flex-shrink-0 text-indigo-500"
                    aria-hidden="true" />
                  <span class="text-sm text-neutral-500">{{ feature }}</span>
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
import { ref } from 'vue';
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue';
import { CheckIcon } from '@heroicons/vue/solid';
const annualBilling = ref(true);

const tiers = [
  {
    name: 'Professional',
    href: '/signup',
    priceMonthly: 199,
    priceAnnual: 2199,
    description: 'For freelancers',
    featureIcons: ['EmailIcon', 'EmailIcon', 'EmailIcon', 'EmailIcon'],
    features: [
      '500 contact credits/month',
      'Database of 2M+ creators',
      'Blazing fast search',
      'CRM, CSV exports,',
    ],
  },
  {
    name: 'Team',
    href: '/signup',
    priceMonthly: 499,
    priceAnnual: 4999,
    description: 'Built for startups and growing teams',
    featureIcons: ['EmailIcon', 'EmailIcon', 'EmailIcon', 'EmailIcon'],
    features: [
      'Everything in the Professional plan, plus:',
      '2,500 contact credits/month',
      'Collaboration & team managment.',
      'Additional seats $99/mo',
    ],
  },
  {
    name: 'Enterprise',
    href: '/signup',
    priceMonthly: 2499,
    priceAnnual: 24999,
    description: 'For large teams and enterprises',
    featureIcons: ['EmailIcon', 'EmailIcon', 'EmailIcon', 'EmailIcon'],
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
    Switch,
    SwitchGroup,
    SwitchLabel,
    CheckIcon,
  },
  setup() {
    return {
      tiers,
      annualBilling,
    };
  },
};
</script>
