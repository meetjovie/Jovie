<template>
    <div>
        <template v-if="!currentUser || (currentUser && !currentUser.current_subscription || showSubscriptionPlans)">
            <div>
                <h2
                    id="payment-details-heading"
                    class="text-lg font-medium leading-6 text-gray-900">
                    {{ title }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    {{ subtitle }}
                </p>
            </div>

            <div class="w-full py-4">
                <div class="mx-auto w-full max-w-4xl">
                    <RadioGroup v-model="selectedProduct">
                        <RadioGroupLabel class="sr-only">Plan</RadioGroupLabel>
                        <div class="space-y-2">
                            <RadioGroupOption
                                as="template"
                                v-for="product in products"
                                :key="product.name"
                                :value="product.id"
                                v-slot="{ active, checked }">
                                <div
                                    :class="[
                    active
                      ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-indigo-300'
                      : '',
                    checked ? 'bg-indigo-700/80 text-white ' : 'bg-white ',
                  ]"
                                    class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus-visible:outline-none">
                                    <div class="flex w-full items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="text-sm">
                                                <RadioGroupLabel
                                                    as="p"
                                                    :for="product.id"
                                                    :class="checked ? 'text-white' : 'text-gray-900'"
                                                    class="font-medium">
                                                    {{ product.name }}
                                                </RadioGroupLabel>
                                                <RadioGroupDescription
                                                    v-for="plan in product.plans"
                                                    as="span"
                                                    :class="checked ? 'text-indigo-100' : 'text-gray-500'"
                                                    class="inline">
                          <span>
                            {{ plan.amount / 100 }}/{{ plan.interval }}</span
                          >
                                                    <span aria-hidden="true"> &middot; </span>
                                                    <span class="text-xs uppercase">
                            {{ plan.currency }}</span
                                                    >
                                                </RadioGroupDescription>
                                            </div>
                                        </div>
                                        <div v-show="checked" class="flex-shrink-0 text-white">
                                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="12"
                                                    fill="#fff"
                                                    fill-opacity="0.2"/>
                                                <path
                                                    d="M7 13l3 3 7-7"
                                                    stroke="#fff"
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </RadioGroupOption>
                        </div>
                    </RadioGroup>
                </div>
            </div>
            <div class="w-full">
                <div class="mx-auto w-full max-w-4xl">
                    <div class="w-full">
                        <div
                            id="card"
                            class="flex-inline appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm"></div>
                    </div>
                </div>
            </div>
            <div class="mt-2 w-full">
                <div class="flex justify-between">
                    <SwitchGroup as="div" class="flex items-center">
                        <Switch
                            :disabled="!selectedProduct"
                            v-model="annualBillingEnabled"
                            :class="[
                annualBillingEnabled ? 'bg-indigo-500' : 'bg-gray-200',
                'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gray-900 focus-visible:ring-offset-2',
              ]">
              <span
                  aria-hidden="true"
                  :class="[
                  annualBillingEnabled ? 'translate-x-5' : 'translate-x-0',
                  'inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                ]"/>
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
                            :disabled="processingPayment"
                            :text="processingPayment ? 'Processing' : 'Pay'"
                            :loader="processingPayment"
                            type="button"
                            @click="pay"/>
                    </div>
                </div>
            </div>
        </template>

        <template v-else>
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    Manage your subscription:
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500"></p>
            </div>
            <div>
                <ul>
                    <li></li>
                </ul>
            </div>
            <div class="mt-5 border-t border-gray-200">
                <dl class="divide-y divide-gray-200">
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                        <dt class="text-sm font-medium text-gray-500">Current plan</dt>

                        <dd class="mt-1 flex text-sm text-gray-900 sm:col-span-2 sm:mt-0">
              <span class="flex-grow">{{
                      currentUser.current_subscription.name
                  }}</span>
                            <span class="ml-4 flex-shrink-0">
                <button
                    type="button"
                    class="rounded-md bg-neutral-100 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                  Upgrade
                </button>
              </span>
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                        <dt class="text-sm font-medium text-gray-500">Price</dt>
                        <dd class="mt-1 flex text-sm text-gray-900 sm:col-span-2 sm:mt-0">
              <span class="flex-grow">
                <span class="flex-grow">
                  {{
                        currentUser.current_subscription.amount / 100
                    }}<span
                    v-if="currentUser.current_subscription.interval === 'month'"
                >/mo</span
                >
                  <span v-else>/yr</span>
                  <span
                      class="font-bolder ml-1 text-xs uppercase text-neutral-400">
                    {{ currentUser.current_subscription.currency }}</span
                  ></span
                ></span
              >
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                        <dt class="text-sm font-medium text-gray-500">Email credits</dt>
                        <dd class="mt-1 flex text-sm text-gray-900 sm:col-span-2 sm:mt-0">
              <span class="flex-grow"
              ><span class="text-neutral-600">500</span>/2500 Remaining</span
              >
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                        <dt class="text-sm font-medium text-gray-500">Seats</dt>
                        <dd class="mt-1 flex text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <span class="flex-grow"> 1</span>
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="justify-right mx-auto mt-4 w-full">
                <ButtonGroup
                    v-if="currentUser.current_subscription.ends_at"
                    @click="resumeSubscription()"
                    :disabled="updatingSubscription"
                    design="secondary"
                    class="mr-4"
                    text="Resume Subscription"/>
                <ButtonGroup
                    v-else
                    @click="cancelSubscription()"
                    :disabled="updatingSubscription"
                    design="danger"
                    class="mr-4"
                    text="Cancel Subscription"/>
                <ButtonGroup
                    @click="toggleChangeSubscription(true)"
                    :disabled="updatingSubscription"
                    design="secondary"
                    class="mr-4"
                    text="Change Subscription"/>
            </div>
        </template>
    </div>
</template>

<script>
import AccountPlan from './Account/AccountPlan';
import {
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
    SwitchGroup,
    Switch,
    SwitchLabel,
} from '@headlessui/vue';
import ButtonGroup from './ButtonGroup';
import UserService from '../services/api/user.service';
import {loadStripe} from '@stripe/stripe-js';

export default {
    name: 'Subscription',
    components: {
        AccountPlan,
        RadioGroup,
        RadioGroupLabel,
        RadioGroupOption,
        RadioGroupDescription,
        ButtonGroup,
        Switch,
        SwitchGroup,
        SwitchLabel,
    },
    props: {
        subtitle: {
            type: String,
            default: null,
            required: false,
        },
        title: {
            type: String,
            default: null,
            required: false,
        },
    },
    data() {
        return {
            stripeLoaded: false,
            stripe: null,
            paymentProcessing: false,
            products: [],
            selectedProduct: null,
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
            annualBillingEnabled: false,
            paymentIntent: null,
            elements: null,
            updatingSubscription: false,
            processingPayment: false,
            showSubscriptionPlans: false,
        };
    },
    watch: {
        selectedProduct(val) {
            if (!val) return;
            try {
                const interval = this.annualBillingEnabled ? 'year' : 'month';
                let selectedProduct = this.products.filter(
                    (product) => product.id == val
                )[0];
                this.selectedPlan = selectedProduct.plans.filter(
                    (plan) => plan.interval == interval
                )[0].id;
            } catch (e) {
                alert('Problem in selecting product');
            }
        },
        annualBillingEnabled(val) {
            if (!this.selectedProduct) return;
            try {
                const interval = val ? 'year' : 'month';
                let selectedProduct = this.products.filter(
                    (product) => product.id == this.selectedProduct
                )[0];
                this.selectedPlan = selectedProduct.plans.filter(
                    (plan) => plan.interval == interval
                )[0].id;
            } catch (e) {
                alert('Problem in selecting plan');
            }
        },
    },
    async mounted() {
        if (!this.currentUser || !this.currentUser.current_subscription) {
            UserService.getSubscriptionProducts().then((response) => {
                response = response.data;
                if (response.status) {
                    this.products = response.products;
                }
            });
            await this.initStripePayment();
        }
    },
    methods: {
        async initStripePayment() {
            UserService.paymentIntent().then(async response => {
                response = response.data
                if (response.status) {
                    this.stripeLoaded = true
                    this.paymentIntent = response.intent
                    UserService.getSubscriptionProducts().then((response) => {
                        response = response.data;
                        if (response.status) {
                            this.products = response.products;
                        }
                    });
                    this.stripe = await loadStripe(this.stripeKey);
                    this.elements = this.stripe.elements({clientSecret: this.paymentIntent.client_secret});
                    this.paymentElement = this.elements.create('payment');
                    this.paymentElement.mount('#card');
                } else {
                    alert(response.message)
                }
            })

        },
        toggleChangeSubscription(toggle) {
            this.showSubscriptionPlans = toggle;
            if (toggle) {
                this.initStripePayment();
            } else {
                this.resetSelections();
            }
        },
        resetSelections() {
            this.selectedPlan = null;
            this.selectedProduct = null;
            this.annualBillingEnabled = false;
        },
        resumeSubscription() {
            this.updatingSubscription = true;
            UserService.resumeSubscription()
                .then((response) => {
                    response = response.data;
                    if (response.status) {
                        alert(response.message);
                        this.currentUser.current_subscription = response.subscription;
                    } else {
                        alert(response.message);
                    }
                })
                .finally(() => {
                    this.updatingSubscription = false;
                });
        },
        cancelSubscription() {
            this.updatingSubscription = true;
            UserService.cancelSubscription()
                .then((response) => {
                    response = response.data;
                    if (response.status) {
                        alert(response.message);
                        this.currentUser.current_subscription = response.subscription;
                    } else {
                        alert(response.message);
                    }
                })
                .finally(() => {
                    this.updatingSubscription = false;
                });
        },
        async pay() {
            if (this.processingPayment) return;
            if (!this.selectedProduct || !this.selectedPlan) {
                alert('You must select a product and pricing to continue.');
                return;
            }
            this.processingPayment = true;
            this.paymentElement.update({readOnly: true});
            const elements = this.elements
            await this.stripe.confirmSetup({
                elements,
                redirect: 'if_required',
                confirmParams: {
                    // Make sure to change this to your payment completion page
                    return_url: "http://localhost:4242/public/checkout.html",
                },
            })
                .then((result) => {
                    if (result.error) {
                        alert(result.error.message);
                        this.paymentElement.update({readOnly: false});
                        this.processingPayment = false;
                    } else {
                        if (this.showSubscriptionPlans) {
                            this.changeSubscription(result.setupIntent.payment_method);
                        } else {
                            this.newSubscription(result.paymentMethod.payment_method);
                        }
                    }
                });
        },
        newSubscription(paymentId) {
            UserService.subscribe(paymentId, this.selectedPlan, this.selectedProduct)
                .then((response) => {
                    response = response.data;
                    if (response.status) {
                        alert(response.message);
                        this.resetSelections();
                        this.currentUser.current_subscription = response.subscription;
                        this.$router.push({name: 'Account'});
                    } else {
                        alert(response.message);
                    }
                })
                .catch((error) => {
                    error = error.response;
                    if (error.status == 422) {
                        this.error = error.data.errors.email[0];
                    }
                })
                .finally(() => {
                    this.paymentElement.clear();
                    this.paymentElement.update({readOnly: false});
                    this.processingPayment = false;
                });
        },
        changeSubscription(paymentId) {
            UserService.changeSubscription(
                paymentId,
                this.selectedPlan,
                this.selectedProduct
            )
                .then((response) => {
                    response = response.data;
                    if (response.status) {
                        alert(response.message);
                        this.resetSelections();
                        this.currentUser.current_subscription = response.subscription;
                        this.toggleChangeSubscription(false);
                        this.$router.push({name: 'Account'});
                    } else {
                        alert(response.message);
                    }
                })
                .catch((error) => {
                    error = error.response;
                    if (error.status == 422) {
                        this.error = error.data.errors.email[0];
                    }
                })
                .finally(() => {
                    this.paymentElement.clear();
                    this.paymentElement.update({readOnly: false});
                    this.processingPayment = false;
                });
        },
    },
    computed: {
        stripeKey() {
            return process.env.MIX_STRIPE_KEY;
        },
        instanceOptions() {
        },
        elementsOptions() {
        },
        cardOptions() {
            return {
                postalCode: '12345',
            };
        },
    },
};
</script>

<style scoped></style>
