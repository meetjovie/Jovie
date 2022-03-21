<template>
  <main class="flex-1">
    <div class="relative mx-auto max-w-4xl md:px-8 xl:px-0">
      <div class="pt-10 pb-16">
        <div class="px-4 sm:px-6 md:px-0">
          <h1 class="text-3xl font-extrabold text-gray-900">Settings</h1>
        </div>
        <div class="px-4 sm:px-6 md:px-0">
          <div class="py-6">
            <!-- Tabs -->
            <TabGroup as="div" class="mt-2" @change="changeTab">
              <div class="border-b border-gray-200">
                <TabList class="-mb-px flex space-x-8 px-4">
                  <Tab
                    as="template"
                    v-for="tab in tabs"
                    :key="tab.name"
                    v-slot="{ selected }">
                    <button
                      :class="[
                        selected
                          ? 'border-indigo-600 text-indigo-600'
                          : 'border-transparent text-gray-900',
                        'flex-1 whitespace-nowrap border-b-2 py-4 px-1 text-base font-medium',
                      ]">
                      {{ tab.name }}
                    </button>
                  </Tab>
                </TabList>
              </div>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  <AccountTeam />
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6"> Password</TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  Notifications
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  Plan
                  <div class="w-full px-4 py-16">
                    <div class="mx-auto w-full max-w-4xl">
                      <RadioGroup v-model="selectedPlan">
                        <RadioGroupLabel class="sr-only">Plan</RadioGroupLabel>
                        <div class="space-y-2">
                          <RadioGroupOption
                            as="template"
                            v-for="plan in plans"
                            :key="plan.name"
                            :value="plan"
                            v-slot="{ active, checked }">
                            <div
                              :class="[
                                active
                                  ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-indigo-300'
                                  : '',
                                checked
                                  ? 'bg-indigo-700/80 text-white '
                                  : 'bg-white ',
                              ]"
                              class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none">
                              <div
                                class="flex w-full items-center justify-between">
                                <div class="flex items-center">
                                  <div class="text-sm">
                                    <RadioGroupLabel
                                      as="p"
                                      :for="plan.id"
                                      :class="
                                        checked ? 'text-white' : 'text-gray-900'
                                      "
                                      class="font-medium">
                                      {{ plan.product.name }}
                                    </RadioGroupLabel>
                                    <RadioGroupDescription
                                      as="span"
                                      :class="
                                        checked
                                          ? 'text-indigo-100'
                                          : 'text-gray-500'
                                      "
                                      class="inline">
                                      <span>
                                        {{ plan.amount / 100 }}/{{
                                          plan.interval
                                        }}</span
                                      >
                                      <span aria-hidden="true"> &middot; </span>
                                      <span class="text-xs uppercase">{{
                                        plan.currency
                                      }}</span>
                                    </RadioGroupDescription>
                                  </div>
                                </div>
                                <div
                                  v-show="checked"
                                  class="flex-shrink-0 text-white">
                                  <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none">
                                    <circle
                                      cx="12"
                                      cy="12"
                                      r="12"
                                      fill="#fff"
                                      fill-opacity="0.2" />
                                    <path
                                      d="M7 13l3 3 7-7"
                                      stroke="#fff"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round" />
                                  </svg>
                                </div>
                              </div>
                            </div>
                          </RadioGroupOption>
                        </div>
                      </RadioGroup>
                    </div>
                  </div>
                  <div class="flex justify-between">
                    <SwitchGroup as="div" class="flex items-center">
                      <Switch
                        v-model="annualBillingEnabled"
                        :class="[
                          annualBillingEnabled
                            ? 'bg-indigo-500'
                            : 'bg-gray-200',
                          'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2',
                        ]">
                        <span
                          aria-hidden="true"
                          :class="[
                            annualBillingEnabled
                              ? 'translate-x-5'
                              : 'translate-x-0',
                            'inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                          ]" />
                      </Switch>
                      <SwitchLabel as="span" class="ml-3">
                        <span class="text-sm font-medium text-gray-900"
                          >Annual billing
                        </span>
                        <span class="text-sm text-gray-500">(Save 10%)</span>
                      </SwitchLabel>
                    </SwitchGroup>
                    <div>
                      <ButtonGroup
                        design="secondary"
                        text="Cancel Subscription" />
                    </div>
                  </div>
                </TabPanel>
              </TabPanels>

              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  <div>
                    <h2
                      id="payment-details-heading"
                      class="text-lg font-medium leading-6 text-gray-900">
                      Payment details
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                      Update your billing information. Please note that updating
                      your location could affect your tax rates.
                    </p>
                  </div>
                  <form action="#" method="POST" class="space-y-6">
                    <div class="mt-6 grid grid-cols-4 gap-6">
                      <div class="col-span-4 sm:col-span-2">
                        <label
                          for="line1"
                          class="sr-only block text-sm font-medium text-gray-700">
                          Address line 1
                        </label>
                        <div class="mt-1">
                          <input
                            v-model="address.line1"
                            id="line1"
                            name="line1"
                            type="text"
                            placeholder="Address line 1"
                            autocomplete="line1"
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                          <p
                            class="mt-2 text-sm text-red-900"
                            v-if="
                              this.errors.address && this.errors.address.line1
                            ">
                            {{ this.errors.address.line1[0] }}
                          </p>
                        </div>
                      </div>

                      <div class="col-span-4 sm:col-span-2">
                        <label
                          for="city"
                          class="sr-only block text-sm font-medium text-gray-700">
                          City
                        </label>
                        <div class="mt-1">
                          <input
                            v-model="address.city"
                            id="city"
                            placeholder="City"
                            name="city"
                            type="text"
                            autocomplete="city"
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                          <p
                            class="mt-2 text-sm text-red-900"
                            v-if="
                              this.errors.address && this.errors.address.city
                            ">
                            {{ this.errors.address.city[0] }}
                          </p>
                        </div>
                      </div>
                      <div class="col-span-4 sm:col-span-2">
                        <label
                          for="state"
                          class="sr-only block text-sm font-medium text-gray-700">
                          State
                        </label>
                        <div class="mt-1">
                          <input
                            v-model="address.state"
                            id="state"
                            name="state"
                            placeholder="State"
                            type="text"
                            autocomplete="state"
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                          <p
                            class="mt-2 text-sm text-red-900"
                            v-if="
                              this.errors.address && this.errors.address.state
                            ">
                            {{ this.errors.address.state[0] }}
                          </p>
                        </div>
                      </div>
                      <div class="col-span-4 sm:col-span-2">
                        <label
                          for="country"
                          class="sr-only block text-sm font-medium text-gray-700">
                          Country
                        </label>
                        <div class="mt-1">
                          <input
                            v-model="address.country"
                            id="country"
                            name="country"
                            type="text"
                            placeholder="Country"
                            autocomplete="country"
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                          <p
                            class="mt-2 text-sm text-red-900"
                            v-if="
                              this.errors.address && this.errors.address.country
                            ">
                            {{ this.errors.address.country[0] }}
                          </p>
                        </div>
                      </div>
                      <div class="col-span-4 sm:col-span-2">
                        <label
                          for="postal_code"
                          class="sr-only block text-sm font-medium text-gray-700">
                          Postal Code
                        </label>
                        <div class="mt-1">
                          <input
                            v-model="address.postal_code"
                            id="postal_code"
                            name="postal_code"
                            type="text"
                            placeholder="Postal Code"
                            autocomplete="postal_code"
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                          <p
                            class="mt-2 text-sm text-red-900"
                            v-if="
                              this.errors.address &&
                              this.errors.address.postal_code
                            ">
                            {{ this.errors.address.postal_code[0] }}
                          </p>
                        </div>
                        <div class="col-span-4 sm:col-span-2">
                          <label
                            for="phone"
                            class="sr-only block text-sm font-medium text-gray-700">
                            Phone
                          </label>
                          <div class="mt-1">
                            <input
                              v-model="phone"
                              id="phone"
                              name="phone"
                              placeholder="Phone"
                              type="text"
                              autocomplete="phone"
                              class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                            <p
                              class="mt-2 text-sm text-red-900"
                              v-if="this.errors.address && this.errors.phone">
                              {{ this.errors.phone[0] }}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class="flex-inline mx-auto max-w-xl">
                    <div class="mt-5 sm:flex sm:items-center">
                      <div class="w-full space-x-4 sm:max-w-xs">
                        <div
                          id="payment"
                          class="flex-inline mr-4 appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm"></div>
                      </div>
                      <ButtonGroup
                        class="flex-inline px-4"
                        text="Pay"
                        type="button"
                        @click="pay" />
                    </div>
                  </div>
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 py-6">
                  <AccountTeam />
                </TabPanel>
              </TabPanels>
            </TabGroup>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import AccountTeam from '../components/Account/AccountTeam.vue';

import { ref } from 'vue';
import {
  Dialog,
  DialogOverlay,
  Switch,
  SwitchGroup,
  SwitchLabel,
  TransitionChild,
  TransitionRoot,
  TabGroup,
  Tab,
  TabList,
  TabPanel,
  TabPanels,
  RadioGroup,
  RadioGroupLabel,
  RadioGroupOption,
  RadioGroupDescription,
} from '@headlessui/vue';
import {
  BellIcon,
  BriefcaseIcon,
  ChatIcon,
  CogIcon,
  DocumentSearchIcon,
  HomeIcon,
  MenuAlt2Icon,
  QuestionMarkCircleIcon,
  UsersIcon,
  XIcon,
} from '@heroicons/vue/outline';
import { SearchIcon } from '@heroicons/vue/solid';
import ButtonGroup from '../components/ButtonGroup.vue';

const navigation = [
  { name: 'Home', href: '#', icon: HomeIcon, current: false },
  { name: 'Jobs', href: '#', icon: BriefcaseIcon, current: false },
  { name: 'Applications', href: '#', icon: DocumentSearchIcon, current: false },
  { name: 'Messages', href: '#', icon: ChatIcon, current: false },
  { name: 'Team', href: '#', icon: UsersIcon, current: false },
  { name: 'Settings', href: '#', icon: CogIcon, current: true },
];
const secondaryNavigation = [
  { name: 'Help', href: '#', icon: QuestionMarkCircleIcon },
  { name: 'Logout', href: '#', icon: CogIcon },
];
const tabs = [
  { name: 'General', href: '#', current: true },
  { name: 'Password', href: '#', current: false },
  { name: 'Notifications', href: '#', current: false },
  { name: 'Plan', href: '#', current: false },
  { name: 'Billing', href: '#', current: false },
  { name: 'Team Members', href: '#', current: false },
];

import { loadStripe } from '@stripe/stripe-js';
import UserService from '../services/api/user.service';
import AccountPlan from '../components/Account/AccountPlan.vue';

export default {
  components: {
    Dialog,
    DialogOverlay,
    Switch,
    SwitchGroup,
    SwitchLabel,
    TransitionChild,
    TransitionRoot,
    BellIcon,
    MenuAlt2Icon,
    SearchIcon,
    XIcon,
    AccountTeam,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    Tab,
    AccountPlan,
    RadioGroup,
    RadioGroupLabel,
    RadioGroupOption,
    RadioGroupDescription,
    ButtonGroup,
  },
  data() {
    return {
      navigation,
      secondaryNavigation,
      tabs,
      stripeLoaded: false,
      stripe: null,
      paymentProcessing: false,
      plans: [],
      selectedPlan: null,
      address: {
        city: null,
        country: null,
        line1: null,
        line2: null,
        postal_code: null,
        state: null,
      },
      phone: '',
      errors: {},
    };
  },
  methods: {
    async pay() {
      this.processingPayment = true;
      this.stripe
        .createPaymentMethod('card', this.cardElement, {
          billing_details: {
            address: this.address,
            email: this.currentUser.email,
            name: this.currentUser.full_name,
            phone: this.phone,
          },
        })
        .then((result) => {
          if (result.error) {
            this.addPaymentStatusError = result.error.message;
          } else {
            UserService.subscribe(result.paymentMethod.id, this.selectedPlan)
              .then((response) => {
                response = response.data;
                if (response.status) {
                  alert(response.message);
                }
              })
              .catch((error) => {
                error = error.response;
                if (error.status == 422) {
                  this.error = error.data.errors.email[0];
                }
              });
            this.cardElement.clear();
          }
        });
    },
    async changeTab(index) {
      if (index == 4) {
          UserService.paymentIntent().then(async response => {
              response = response.data
              if (response.status) {
                  const paymentIntent = response.intent
                  UserService.getSubscriptionPlans().then((response) => {
                      response = response.data;
                      if (response.status) {
                          this.plans = response.plans;
                      }
                  });
                  this.stripe = await loadStripe(this.stripeKey);
                  const elements = this.stripe.elements({clientSecret: paymentIntent.client_secret});
                  this.cardElement = elements.create('payment');
                  this.cardElement.mount('#payment');
              } else {
                  alert(response.message)
              }
          })
      }
    },
  },
  computed: {
    stripeKey() {
      return 'pk_test_51J4zLPIDxrKL9CaGrmkJQLySWhfolGo2vSIQFBOllle2XueppgjGnqnfapqW3ERTFRZj2bQqLxGo8DhTqxtDz6d1009nTMSB8c';
    },
    instanceOptions() {},
    elementsOptions() {},
    cardOptions() {
      return {
        postalCode: '12345',
      };
    },
  },
  async mounted() {},
};
</script>
