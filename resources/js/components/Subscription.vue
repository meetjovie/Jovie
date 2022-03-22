<template>
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
    <div class="w-full px-4 py-4">
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
                                            :for="product.id"
                                            :class="
                                                                                checked ? 'text-white' : 'text-gray-900'
                                                                              "
                                            class="font-medium">
                                            {{ product.name }}
                                        </RadioGroupLabel>
                                        <RadioGroupDescription
                                            v-for="plan in product.plans"
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
    <div class="w-full px-4">
        <div class="mx-auto w-full max-w-4xl">
            <div class="w-full space-x-4">
                <div
                    id="card"
                    class="flex-inline mr-4 appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm"></div>
            </div>
        </div>
    </div>
    <div class="w-full px-4">
        <div class="flex justify-between">
            <SwitchGroup as="div" class="flex items-center">
                <Switch
                    :disabled="!selectedProduct"
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
                    text="Pay"
                    type="button"
                    @click="pay"/>
            </div>
        </div>
    </div>
    <div class="w-full px-4">
        <ButtonGroup
            design="secondary"
            text="Cancel Subscription"/>
    </div>
</template>

<script>
import AccountPlan from "./Account/AccountPlan";
import {RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption, SwitchGroup, Switch, SwitchLabel} from "@headlessui/vue";
import ButtonGroup from "./ButtonGroup";
import UserService from "../services/api/user.service";
import {loadStripe} from "@stripe/stripe-js";

export default {
    name: "Subscription",
    components: {
        AccountPlan,
        RadioGroup,
        RadioGroupLabel,
        RadioGroupOption,
        RadioGroupDescription,
        ButtonGroup,
        Switch,
        SwitchGroup,
        SwitchLabel
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
            elements: null
        };
    },
    watch: {
        selectedProduct(val) {
            try {
                const interval = this.annualBillingEnabled ? 'year' : 'month'
                let selectedProduct = this.products.filter(product => product.id == val)[0]
                this.selectedPlan = selectedProduct.plans.filter(plan => plan.interval == interval)[0].id
                console.log(this.selectedProduct);
                console.log(this.selectedPlan);
            } catch (e) {
                alert('Problem in selecting product')
            }
        },
        annualBillingEnabled(val) {
            try {
                const interval = val ? 'year' : 'month'
                let selectedProduct = this.products.filter(product => product.id == this.selectedProduct)[0]
                this.selectedPlan = selectedProduct.plans.filter(plan => plan.interval == interval)[0].id
                console.log(this.selectedProduct);
                console.log(this.selectedPlan);
            } catch (e) {
                alert('Problem in selecting plan')
            }
        }
    },
    async mounted() {
        UserService.getSubscriptionProducts().then(response => {
            response = response.data
            if (response.status) {
                this.products = response.products
            }
        })
        this.stripe = await loadStripe(this.stripeKey)
        const elements = this.stripe.elements()
        this.cardElement = elements.create('card')
        this.cardElement.mount('#card')
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
                                this.$router.push({name: 'Account'})
                            } else {
                                alert(response.message)
                            }
                        })
                        .catch((error) => {
                            error = error.response;
                            if (error.status == 422) {
                                this.error = error.data.errors.email[0];
                            }
                        });
                    ;
                    this.cardElement.clear();
                }
            })
        },
    },
    computed: {
        stripeKey() {
            return 'pk_test_51J4zLPIDxrKL9CaGlDlQnD2dEz88UJh2APbGXIzBsJn9H69ormsxh1bHJds8JNb8zSql5bRhmO1vk7MMV7YPkeI000dgwaqAlT';
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
}
</script>

<style scoped>

</style>
