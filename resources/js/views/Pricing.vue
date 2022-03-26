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
                <span class="text-base font-medium text-neutral-500">/mo</span>
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
                <span class="text-base font-medium text-neutral-500">/mo</span>
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
  </div>
  <!-- FAQ -->
  <div class="bg-gradient-to-b from-neutral-50 to-white">
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
import {
  CheckIcon,
  ChevronDownIcon,
  MailIcon,
  LightningBoltIcon,
  DatabaseIcon,
  SupportIcon,
  UserIcon,
  UserGroupIcon,
  UsersIcon,
  UserAddIcon,
  CloudDownloadIcon,
  ChatAlt2Icon,
  TableIcon,
  PhoneIcon,
} from '@heroicons/vue/outline';
const annualBilling = ref(true);

const tiers = [
  {
    name: 'Professional',
    href: 'signup',
    featured: false,
    priceMonthly: 199,
    priceAnnual: 2148,
    description: 'For freelancers',
    features: [
      { name: 'Database of 2M+ creators', icon: 'DatabaseIcon' },
      { name: 'Blazing fast search', icon: 'LightningBoltIcon' },
      { name: '500 contact credits/month', icon: 'MailIcon' },
      { name: '1 User included', icon: 'UserIcon' },
      { name: '10 CSV exports', icon: 'CloudDownloadIcon' },
    ],
  },
  {
    name: 'Team',
    href: 'signup',
    featured: true,
    priceMonthly: 499,
    priceAnnual: 5388,
    description: 'Built for startups and growing teams',
    features: [
      { name: 'Database of 2M+ creators', icon: 'DatabaseIcon' },
      { name: 'Blazing fast search', icon: 'LightningBoltIcon' },
      { name: '2,500 contact credits/month', icon: 'MailIcon' },
      { name: '2 Users included', icon: 'UsersIcon' },
      { name: 'Unlimited CSV exports', icon: 'CloudDownloadIcon' },
      { name: 'Collaboration & team managment', icon: 'ChatAlt2Icon' },
      { name: 'Additional users $99/mo', icon: 'UserAddIcon' },
      { name: '1,000 Data enrichment credits', icon: 'TableIcon' },
    ],
  },
  {
    name: 'Enterprise',
    href: 'request-demo',
    featured: false,
    priceMonthly: 'Annual Only',
    priceAnnual: 26388,
    description: 'For large teams and enterprises',
    features: [
      { name: 'Database of 2M+ creators', icon: 'DatabaseIcon' },
      { name: 'Blazing fast search', icon: 'LightningBoltIcon' },
      { name: '10,00 contact credits/month', icon: 'MailIcon' },
      { name: '5 Users included', icon: 'UserGroupIcon' },
      { name: 'Unlimited CSV exports', icon: 'CloudDownloadIcon' },
      { name: 'Collaboration & team managment', icon: 'ChatAlt2Icon' },
      { name: 'Additional users $99/mo', icon: 'UserAddIcon' },
      { name: '5,0000 Data enrichment credits', icon: 'TableIcon' },
      { name: 'Dedicated support', icon: 'PhoneIcon' },
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
      'Jovie provides access to a database of millions of creators.  You can leverage this data for your outreach efforts.  A contact credit is deducted from your account when you send a message to a contact or export an email address.',
  },
  {
    question: 'What is a data enrichment credit?',
    answer:
      'Jovie allows you to enrich your contacts with data from your own database or customer lists.  When you upload contacts, we match them against our data to provide you an enriched profile with social metrics, content, & other details.  You are only charged for succcessful matches.',
  },
  {
    question: 'Doy you offer trials?',
    answer:
      'We do not offer free trials.  But we do think you will love Jovie.  If youre unsure which plan meets your needs you can start with our professional plan and upgrade later.  If you have questions or would like to schedule a demo, please contact us.',
  },
];

export default {
  components: {
    Switch,
    SwitchGroup,
    SwitchLabel,
    CheckIcon,
    UserAddIcon,
    CloudDownloadIcon,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    ChevronDownIcon,
    MailIcon,
    LightningBoltIcon,
    DatabaseIcon,
    SupportIcon,
    UserIcon,
    UserGroupIcon,
    UsersIcon,
    ChatAlt2Icon,
    TableIcon,
    PhoneIcon,
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
