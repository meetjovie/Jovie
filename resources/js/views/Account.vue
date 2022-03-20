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
                                    <AccountTeam/>
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
                                <TabPanel class="space-y-12 px-4 py-6"> Plan</TabPanel>
                            </TabPanels>

                            <TabPanels as="template">
                                <TabPanel class="space-y-12 px-4 py-6">
                                    <div v-for="plan in plans">
                                        <img :src="plan.product.images[0]" alt="">
                                        <label :for="plan.id" class="mr-2">{{ plan.product.name }}</label>
                                        <label :for="plan.id" class="mr-2">
                                            {{ plan.currency }}
                                            <span class="mr-2">{{ plan.amount/100 }}</span>
                                            <span>{{ plan.interval }}</span>
                                        </label>
                                        <input type="radio" name="plan" :value="plan.id" :id="plan.id" v-model="selectedPlan">
                                    </div>
                                    <form action="#" method="POST" class="space-y-6">
                                        <div>
                                            <label
                                                for="line1"
                                                class="block text-sm font-medium text-gray-700">
                                                Line 1
                                            </label>
                                            <div class="mt-1">
                                                <input
                                                    v-model="address.line1"
                                                    id="line1"
                                                    name="line1"
                                                    type="text"
                                                    autocomplete="line1"
                                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                                                <p class="mt-2 text-sm text-red-900" v-if="this.errors.address && this.errors.address.line1">
                                                    {{ this.errors.address.line1[0] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <label
                                                for="line2"
                                                class="block text-sm font-medium text-gray-700">
                                                Line 2
                                            </label>
                                            <div class="mt-1">
                                                <input
                                                    v-model="address.line2"
                                                    id="line2"
                                                    name="line2"
                                                    type="text"
                                                    autocomplete="line2"
                                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                                                <p class="mt-2 text-sm text-red-900" v-if="this.errors.address && this.errors.address.line2">
                                                    {{ this.errors.address.line2[0] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <label
                                                for="city"
                                                class="block text-sm font-medium text-gray-700">
                                                City
                                            </label>
                                            <div class="mt-1">
                                                <input
                                                    v-model="address.city"
                                                    id="city"
                                                    name="city"
                                                    type="text"
                                                    autocomplete="city"
                                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                                                <p class="mt-2 text-sm text-red-900" v-if="this.errors.address && this.errors.address.city">
                                                    {{ this.errors.address.city[0] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <label
                                                for="state"
                                                class="block text-sm font-medium text-gray-700">
                                                State
                                            </label>
                                            <div class="mt-1">
                                                <input
                                                    v-model="address.state"
                                                    id="state"
                                                    name="state"
                                                    type="text"
                                                    autocomplete="state"
                                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                                                <p class="mt-2 text-sm text-red-900" v-if="this.errors.address && this.errors.address.state">
                                                    {{ this.errors.address.state[0] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <label
                                                for="country"
                                                class="block text-sm font-medium text-gray-700">
                                                Country
                                            </label>
                                            <div class="mt-1">
                                                <input
                                                    v-model="address.country"
                                                    id="country"
                                                    name="country"
                                                    type="text"
                                                    autocomplete="country"
                                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                                                <p class="mt-2 text-sm text-red-900" v-if="this.errors.address && this.errors.address.country">
                                                    {{ this.errors.address.country[0] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <label
                                                for="postal_code"
                                                class="block text-sm font-medium text-gray-700">
                                                Postal Code
                                            </label>
                                            <div class="mt-1">
                                                <input
                                                    v-model="address.postal_code"
                                                    id="postal_code"
                                                    name="postal_code"
                                                    type="text"
                                                    autocomplete="postal_code"
                                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                                                <p class="mt-2 text-sm text-red-900" v-if="this.errors.address && this.errors.address.postal_code">
                                                    {{ this.errors.address.postal_code[0] }}
                                                </p>
                                            </div>
                                            <div>
                                                <label
                                                    for="phone"
                                                    class="block text-sm font-medium text-gray-700">
                                                    Phone
                                                </label>
                                                <div class="mt-1">
                                                    <input
                                                        v-model="phone"
                                                        id="phone"
                                                        name="phone"
                                                        type="text"
                                                        autocomplete="phone"
                                                        class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                                                    <p class="mt-2 text-sm text-red-900" v-if="this.errors.address && this.errors.phone">
                                                        {{ this.errors.phone[0] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="card">

                                    </div>
                                    <button type="button" @click="pay">Pay</button>
                                </TabPanel>
                            </TabPanels>
                            <TabPanels as="template">
                                <TabPanel class="space-y-12 px-4 py-6">
                                    <AccountTeam/>
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

import {ref} from 'vue';
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
import {SearchIcon} from '@heroicons/vue/solid';

const navigation = [
    {name: 'Home', href: '#', icon: HomeIcon, current: false},
    {name: 'Jobs', href: '#', icon: BriefcaseIcon, current: false},
    {name: 'Applications', href: '#', icon: DocumentSearchIcon, current: false},
    {name: 'Messages', href: '#', icon: ChatIcon, current: false},
    {name: 'Team', href: '#', icon: UsersIcon, current: false},
    {name: 'Settings', href: '#', icon: CogIcon, current: true},
];
const secondaryNavigation = [
    {name: 'Help', href: '#', icon: QuestionMarkCircleIcon},
    {name: 'Logout', href: '#', icon: CogIcon},
];
const tabs = [
    {name: 'General', href: '#', current: true},
    {name: 'Password', href: '#', current: false},
    {name: 'Notifications', href: '#', current: false},
    {name: 'Plan', href: '#', current: false},
    {name: 'Billing', href: '#', current: false},
    {name: 'Team Members', href: '#', current: false},
];

import {loadStripe} from '@stripe/stripe-js'
import UserService from "../services/api/user.service";

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
        Tab
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
                state: null
            },
            phone: '',
            errors: {}
        };
    },
    methods: {
        async pay() {
            this.processingPayment = true
            this.stripe.createPaymentMethod(
                'card', this.cardElement, {
                    billing_details: {
                        address: this.address,
                        email: this.currentUser.email,
                        name: this.currentUser.full_name,
                        phone: this.phone
                    }
                }
            ).then((result) => {
                if (result.error) {
                    this.addPaymentStatusError = result.error.message;
                } else {
                    UserService.subscribe(result.paymentMethod.id, this.selectedPlan)
                        .then(response => {
                            response = response.data
                            if (response.status) {
                                alert(response.message)
                            }
                        })
                        .catch((error) => {
                        error = error.response;
                        if (error.status == 422) {
                            this.error = error.data.errors.email[0];
                        }
                    });;
                    this.cardElement.clear();
                }
            })
        },
        async changeTab(index) {
            if (index == 4) {
                UserService.getSubscriptionPlans().then(response => {
                    response = response.data
                    if (response.status) {
                        this.plans = response.plans
                    }
                })
                this.stripe = await loadStripe(this.stripeKey)
                const elements = this.stripe.elements()
                this.cardElement = elements.create('card')
                this.cardElement.mount('#card')
            }
        }
    },
    computed: {
        stripeKey() {
            return 'pk_test_51J4zLPIDxrKL9CaGrmkJQLySWhfolGo2vSIQFBOllle2XueppgjGnqnfapqW3ERTFRZj2bQqLxGo8DhTqxtDz6d1009nTMSB8c'
        },
        instanceOptions() {

        },
        elementsOptions() {

        },
        cardOptions() {
            return {
                postalCode: '12345',
            }
        }
    },
    async mounted() {
    }
};
</script>
