<template>
  <div class="">
    <!-- Pricing with four tiers and toggle -->
    <div class="bg-gradient-to-b from-white to-neutral-50">
      <div class="mx-auto max-w-7xl px-4 pt-24 sm:px-6 lg:px-8">
        <div class="sm:align-center sm:flex sm:flex-col">
          <h1 class="text-5xl font-extrabold text-neutral-900 sm:text-center">
            Jovie Pricing
          </h1>
          <p class="mt-5 text-xl text-neutral-500 sm:text-center">
            Everything you need to scale your creator partnerships.
          </p>

          <div
            class="relative mt-6 flex self-center rounded-lg bg-neutral-200 py-0.5 px-2 sm:mt-8">
            <SwitchGroup as="div" class="flex items-center">
              <div class="flex items-center">
                <Switch
                  v-model="annualBilling"
                  :class="annualBilling ? 'bg-neutral-200' : 'bg-neutral-200'"
                  class="relative inline-flex h-14 w-96 items-center rounded-md transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                  <span
                    :class="annualBilling ? 'translate-x-0' : 'translate-x-48'"
                    class="inline-block h-12 w-1/2 transform rounded-md bg-white shadow-sm transition-transform" />
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
  <!-- FAQ -->
  <div class="bg-gradient-to-b from-neutral-50 to-white">
    <div class="mx-auto max-w-7xl py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-3xl divide-y-2 divide-gray-200">
        <h2
          class="text-center text-3xl font-extrabold text-gray-900 sm:text-4xl">
          Frequently asked questions
        </h2>
        <dl class="mt-6 space-y-6 divide-y divide-gray-200">
          <Disclosure
            as="div"
            v-for="faq in faqs"
            :key="faq.question"
            class="pt-6"
            v-slot="{ open }">
            <dt class="text-lg">
              <DisclosureButton
                class="flex w-full items-start justify-between text-left text-gray-400">
                <span class="font-medium text-gray-900">
                  {{ faq.question }}
                </span>
                <span class="ml-6 flex h-7 items-center">
                  <ChevronDownIcon
                    :class="[
                      open ? '-rotate-180' : 'rotate-0',
                      'h-6 w-6 transform',
                    ]"
                    aria-hidden="true" />
                </span>
              </DisclosureButton>
            </dt>
            <DisclosurePanel as="dd" class="mt-2 pr-12">
              <p class="text-base text-gray-500">
                {{ faq.answer }}
              </p>
            </DisclosurePanel>
          </Disclosure>
        </dl>
      </div>
    </div>
  </div>
  <!-- CTA -->

  <div class="bg-white">
    <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 md:py-16 lg:px-8 lg:py-20">
      <h2
        class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
        <span class="block">Ready to dive in?</span>
        <span class="block text-indigo-600">Get started right now.</span>
      </h2>
      <div class="mt-8 flex">
        <div class="inline-flex rounded-md shadow">
          <router-link
            to="signup"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">
            Get started
          </router-link>
        </div>
        <div class="ml-3 inline-flex">
          <router-link
            to="/"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-100 px-5 py-3 text-base font-medium text-indigo-700 hover:bg-indigo-200">
            Learn more
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import {
  Switch,
  SwitchGroup,
  SwitchLabel,
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
} from '@headlessui/vue';
import { CheckIcon, ChevronDownIcon } from '@heroicons/vue/solid';
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
const faqs = [
  {
    question: 'Can I add additional users to my account?',
    answer:
      'Yes. Team & enterprise plans allow you to invite team members and collaborate.  The Team plan includes 2 seats and you can add more for $99/mo.',
  },
  {
    question: 'What is a contact credit?',
    answer:
      'Jovie provides access to a database of millions of creators.  You can leverage this data for your outreach efforts or to enrich your own customer data.  A contact credit is deducted from your account when you send a message to a contact or export a us.',
  },
];

export default {
  components: {
    Switch,
    SwitchGroup,
    SwitchLabel,
    CheckIcon,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    ChevronDownIcon,
  },
  setup() {
    return {
      tiers,
      faqs,
      annualBilling,
    };
  },
};
</script>
