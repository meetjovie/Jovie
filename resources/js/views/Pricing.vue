<template>
  <div class="">
    <!-- Pricing with four tiers and toggle -->
    <div class="bg-gradient-to-b from-neutral-50 to-white">
      <div class="mx-auto max-w-7xl px-4 pt-24 sm:px-6 lg:px-8">
        <div class="sm:align-center sm:flex sm:flex-col">
          <h1 class="text-5xl font-extrabold text-neutral-900 sm:text-center">
            Jovie Pricing
          </h1>
          <p class="mt-5 text-xl text-neutral-500 sm:text-center">
            Everything you need to scale your relationships.
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
                        annualBilling ? 'text-indigo-700' : 'text-neutral-500'
                      "
                      class="text-sm font-medium focus-visible:z-10 focus-visible:ring-2 focus-visible:ring-indigo-500 sm:w-auto sm:px-8">
                      Yearly Billing
                    </div>
                    <div
                      :class="
                        annualBilling ? 'text-neutral-500' : 'text-indigo-700'
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
            class="divide-y divide-neutral-200 rounded-lg shadow-sm"
            :class="[
              { 'border-2 border-indigo-400': tier.featured == true },
              'border border-neutral-200',
            ]">
            <div class="p-6">
              <h2 class="text-lg font-medium leading-6 text-neutral-900">
                {{ tier.name }}
              </h2>
              <p class="mt-4 text-sm text-neutral-500">
                {{ tier.description }}
              </p>
              <p v-if="tier.name === 'Enterprise'" class="mt-4">
                <span class="text-xs font-medium text-neutral-500"
                  >Starts at</span
                ><br />
                <span class="-mt-2 text-4xl font-extrabold text-neutral-900"
                  >${{ (tier.priceAnnual / 12).toFixed(0) }}</span
                >
                {{ ' ' }}
                <span class="text-base font-medium text-neutral-500">/mo</span>
                <br />
                <span class="text-sm font-medium text-neutral-500"
                  >Annual billing only</span
                >
              </p>
              <p v-else-if="annualBilling" class="mt-4">
                <span class="text-xs font-medium text-neutral-500"></span><br />
                <span class="text-4xl font-extrabold text-neutral-900"
                  >${{ (tier.priceAnnual / 12).toFixed(0) }}</span
                >
                {{ ' ' }}
                <span class="text-base font-medium text-neutral-500">/mo</span
                ><span
                  v-if="tier.name == 'Team'"
                  class="ml-0.5 text-sm font-medium text-neutral-400"
                  >/seat</span
                >
                <br />
                <span class="text-sm font-medium text-neutral-500"
                  >Billed as
                  <span
                    class="text-sm font-medium text-neutral-400 line-through">
                    ${{ tier.priceMonthly.toFixed(0) * 12 }}</span
                  >
                  ${{ tier.priceAnnual.toFixed(0) }}/yr
                </span>
              </p>
              <p v-else class="mt-4">
                <span class="text-xs font-medium text-neutral-500"></span><br />
                <span class="text-4xl font-extrabold text-neutral-900"
                  >${{ tier.priceMonthly }}</span
                >
                {{ ' ' }}
                <span class="text-base font-medium text-neutral-500">/mo</span
                ><span
                  v-if="tier.name == 'Team'"
                  class="ml-0.5 text-sm font-medium text-neutral-400"
                  >/seat</span
                >
                <br />
                <span class="text-sm font-medium text-neutral-500"
                  >Billed monthly</span
                >
              </p>
              <router-link
                v-if="tier.name == 'Enterprise'"
                :to="tier.href"
                class="mt-8 block w-full rounded-md border border-indigo-600 bg-white py-2 text-center text-sm font-semibold text-indigo-600 hover:bg-indigo-600 hover:text-white"
                >Contact Sales</router-link
              >
              <router-link
                v-else
                :to="tier.href"
                class="mt-8 block w-full rounded-md border border-transparent bg-indigo-600 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-700"
                >Buy Now</router-link
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
                  <component
                    :is="feature.icon"
                    class="h-5 w-5 flex-shrink-0 text-indigo-400"
                    aria-hidden="true" />
                  <span class="text-sm text-neutral-500">{{
                    feature.name
                  }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Free Account-->
    <div
      class="relative mx-auto mt-8 max-w-5xl bg-white px-4 sm:px-6 lg:mt-5 lg:px-8">
      <div class="mx-auto max-w-md lg:max-w-5xl">
        <div
          class="rounded-lg bg-gray-50 px-6 py-8 sm:p-10 lg:flex lg:items-center">
          <div class="flex-1">
            <div>
              <h3
                class="inline-flex rounded-md bg-neutral-100 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-gray-600">
                Get started with a free account
              </h3>
            </div>
            <div class="mt-4 text-xs text-gray-600">
              Not ready to commit? Our basic plan is completely free.
              <span class="font-semibold text-gray-900"
                >No credit card required</span
              >.
            </div>
          </div>
          <div class="mt-6 rounded-md shadow lg:mt-0 lg:ml-10 lg:flex-shrink-0">
            <router-link
              to="signup"
              class="flex items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-gray-900 hover:bg-gray-50">
              Try Jovie free
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- FAQ -->
  <div class="mt-4 bg-gradient-to-b from-white to-neutral-50">
    <div class="mx-auto max-w-7xl py-12 px-4 sm:py-16 sm:px-6 lg:py-24 lg:px-8">
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

  <HomeCTA4 />
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
import {
  CheckIcon,
  ChevronDownIcon,
  UserGroupIcon,
  BoltIcon,
  CircleStackIcon,
  LifebuoyIcon,
  UserIcon,
  UsersIcon,
  UserPlusIcon,
  CloudArrowDownIcon,
  ChatBubbleBottomCenterIcon,
  TableCellsIcon,
  PhoneIcon,
} from '@heroicons/vue/24/outline';
import store from '../store';
import HomeCTA4Vue from '../components/Home/HomeCTA4.vue';
const annualBilling = ref(true);

const tiers = [
  {
    name: 'Pro',
    href: 'signup',
    featured: false,
    priceMonthly: 5,
    priceAnnual: 48,
    description: 'For freelancers',
    features: [
      { name: '500 contact credits/month', icon: 'UserGroupIcon' },

      { name: 'Blazing fast CRM Search', icon: 'BoltIcon' },

      { name: '1 User included', icon: 'UserIcon' },
    ],
  },
  {
    name: 'Team',
    href: 'signup',
    featured: true,
    priceMonthly: 10,
    priceAnnual: 96,
    description: 'Built for startups and growing teams',
    features: [
      { name: '2,500 contact credits/month', icon: 'UserGroupIcon' },
      { name: 'Blazing fast search', icon: 'BoltIcon' },
      { name: '2 Users included', icon: 'UsersIcon' },

      { name: 'Unlimited CSV exports', icon: 'CloudArrowDownIcon' },
      {
        name: 'Collaboration & team managment',
        icon: 'ChatBubbleBottomCenterIcon',
      },
    ],
  },
  {
    name: 'Enterprise',
    href: 'request-demo',
    featured: false,
    priceMonthly: 'Annual Only',
    priceAnnual: 240,
    description: 'For large teams and enterprises',
    features: [
      /*  {
        name: `Prospecting engine - Search ${store.state.creatorsDBCount}+ social media profiles`,
        icon: 'CircleStackIcon',
      }, */

      { name: '10,000 contact credits/month', icon: 'UserGroupIcon' },
      { name: 'Blazing fast search', icon: 'BoltIcon' },

      { name: 'Unlimited CSV exports', icon: 'CloudArrowDownIcon' },
      {
        name: 'Collaboration & team managment',
        icon: 'ChatBubbleBottomCenterIcon',
      },

      {
        name: `Prospecting engine - Search millions of social media profiles`,
        icon: 'CircleStackIcon',
      },
      { name: 'Dedicated support', icon: 'PhoneIcon' },
    ],
  },
];
const faqs = [
  {
    question: 'Can I add additional users to my account?',
    answer:
      'Yes. Team & enterprise plans allow you to invite team members and collaborate.  The Team plan includes 2 seats and you can add more for $49/mo.',
  },
  {
    question: 'What is a contact credit?',
    answer:
      'The number of contacts you can enrich & store within the Jovie CRM.',
  },

  {
    question: 'Do you offer trials?',
    answer:
      'Our basic plan is completely free. You can upgrade at any time.  If you have questions or would like to schedule a demo of our advanced features, please contact us.',
  },
];

export default {
  components: {
    Switch,
    SwitchGroup,
    SwitchLabel,
    CheckIcon,
    UserPlusIcon,
    CloudArrowDownIcon,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    ChevronDownIcon,
    UserGroupIcon,
    BoltIcon,
    CircleStackIcon,
    LifebuoyIcon,
    UserIcon,
    UserGroupIcon,
    UsersIcon,
    ChatBubbleBottomCenterIcon,
    TableCellsIcon,
    PhoneIcon,
    HomeCTA4: HomeCTA4Vue,
  },
  mounted() {
    //add segment analytics
    window.analytics.page(this.$route.path);
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
