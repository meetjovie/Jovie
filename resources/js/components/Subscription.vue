<template>
  <div class="items-center py-12">
    <template
      v-if="
        !currentUser ||
        (currentUser && !currentUser.current_team.current_subscription) ||
        showSubscriptionPlans
      ">
      <div>
        <h2
          id="payment-details-heading"
          class="leading-6darK;text-slate-100 text-lg font-medium text-slate-900">
          {{ title }}
        </h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-jovieDark-300">
          {{ subtitle }}

          <span
            class="ml-4 cursor-pointer"
            v-if="showPayment"
            @click="showPayment = false"
            >Go Back</span
          >
        </p>
      </div>
      <template v-if="!loadingProducts && !showPayment">
        <div class="w-full items-center py-12">
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
                        : 'bg-white dark:bg-jovieDark-800 ',
                    ]"
                    class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus-visible:outline-none">
                    <div class="flex w-full items-center justify-between">
                      <div class="flex items-center">
                        <div class="text-sm">
                          <RadioGroupLabel
                            as="p"
                            :for="product.id"
                            :class="
                              checked
                                ? 'text-white'
                                : 'text-slate-900 dark:text-jovieDark-100'
                            "
                            class="font-medium">
                            {{ product.name }} -
                            <span
                              class="text-xs font-bold text-slate-400 dark:text-jovieDark-200"
                              >{{ product.description }}</span
                            >
                          </RadioGroupLabel>
                          <template v-for="plan in product.plans">
                            <RadioGroupDescription
                              as="span"
                              v-if="annualBillingEnabled"
                              :class="
                                checked ? 'text-indigo-100' : 'text-slate-100'
                              "
                              class="inline">
                              <span v-if="plan.interval == 'year'">
                                ${{ plan.amount / 100 }}/{{ plan.interval
                                }}<span class="text-xs uppercase">
                                  {{ plan.currency }}</span
                                >

                                <span aria-hidden="true"> &middot; </span>
                              </span>
                            </RadioGroupDescription>
                            <RadioGroupDescription
                              as="span"
                              v-else
                              :class="
                                checked
                                  ? 'text-indigo-100'
                                  : 'text-slate-500 dark:text-jovieDark-300'
                              "
                              class="inline">
                              <span v-if="plan.interval == 'month'">
                                ${{ plan.amount / 100 }}/{{ plan.interval }}
                                <span class="text-xs uppercase">
                                  {{ plan.currency }}</span
                                >
                                <span aria-hidden="true"> &middot; </span>
                                <span class="text-xs uppercase">
                                  {{
                                    product.metadata.contacts
                                      ? product.metadata.contacts
                                      : 0
                                  }}
                                  contact</span
                                >
                                <span class="text-xs uppercase">
                                  {{
                                    product.metadata.credits
                                      ? product.metadata.credits
                                      : 0
                                  }}
                                  contact AI credits</span
                                >
                              </span>
                            </RadioGroupDescription>
                          </template>
                        </div>
                      </div>
                      <div
                        v-show="checked"
                        class="flex-shrink-0 text-white dark:text-jovieDark-900">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
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
        <div class="mt-2 w-full">
          <div class="flex justify-between">
            <SwitchGroup as="div" class="flex items-center">
              <Switch
                :disabled="!selectedProduct"
                v-model="annualBillingEnabled"
                :class="[
                  annualBillingEnabled ? 'bg-indigo-500' : 'bg-slate-200',
                  'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2',
                ]">
                <span
                  aria-hidden="true"
                  :class="[
                    annualBillingEnabled ? 'translate-x-5' : 'translate-x-0',
                    'inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out dark:bg-jovieDark-800',
                  ]" />
              </Switch>
              <SwitchLabel as="span" class="ml-3">
                <span
                  class="text-sm font-medium text-slate-900 dark:text-jovieDark-100"
                  >Annual billing
                </span>
                <span class="text-sm text-slate-500 dark:text-jovieDark-300"
                  >(Save 10%)</span
                >
              </SwitchLabel>
            </SwitchGroup>
            <div>
              <ButtonGroup
                :disabled="!selectedProduct || !selectedPlan"
                type="button"
                text="Next"
                @click="next()" />
            </div>
          </div>
        </div>
      </template>
      <div class="my-4" v-show="showPayment">
        <PaymentElement
          ref="paymentElement"
          :errors="errors"
          @setPaymentElement="setPaymentElement"
          :buttonText="showSubscriptionPlans ? 'Update' : 'Pay'"
          :processingPayment="processingPayment"
          @pay="pay" />
      </div>
      <div class="flex h-80 items-center justify-center" v-if="loadingProducts">
        <JovieSpinner />
      </div>
    </template>

    <template class="items-center py-12" v-else>
      <div>
        <h3
          class="text-lg font-medium leading-6 text-slate-900 dark:text-jovieDark-100">
          Manage your subscription:
        </h3>
        <p
          class="mt-1 max-w-2xl text-sm text-slate-500 dark:text-jovieDark-300"></p>
      </div>
      <div>
        <ul>
          <li></li>
        </ul>
      </div>
      <div class="mt-5 border-t border-slate-200 dark:border-jovieDark-border">
        <dl class="divide-y divide-slate-200">
          <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
            <dt
              class="text-sm font-medium text-slate-500 dark:text-jovieDark-300">
              Current plan
            </dt>

            <dd
              class="dark:text-jovieDark-100sm:col-span-2 mt-1 flex text-sm text-slate-900 sm:mt-0">
              <span class="flex-grow"
                >{{ currentUser.current_team.current_subscription.name }}
              </span>
              <span class="ml-4 flex-shrink-0">
                <button
                  type="button"
                  class="rounded-md bg-slate-100 font-medium text-indigo-600 hover:text-indigo-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                  Upgrade
                </button>
              </span>
            </dd>
          </div>
          <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
            <dt
              class="text-sm font-medium text-slate-500 dark:text-jovieDark-300">
              Price
            </dt>
            <dd
              class="dark:text-jovieDark-100sm:col-span-2 mt-1 flex text-sm text-slate-900 sm:mt-0">
              <span
                v-if="
                  currentUser.current_team.current_subscription.amount !== 0
                "
                class="flex-grow">
                <span class="flex-grow">
                  {{ currentUser.current_team.current_subscription.amount / 100
                  }}<span
                    v-if="
                      currentUser.current_team.current_subscription.interval ===
                      'month'
                    "
                    >/mo</span
                  >
                  <span v-else>/yr</span>
                  <span
                    class="font-bolder ml-1 text-xs uppercase text-slate-400">
                    {{
                      currentUser.current_team.current_subscription.currency
                    }}</span
                  ></span
                ></span
              >
              <span v-else class="flex-grow"> Free </span>
            </dd>
          </div>
          <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
            <dt
              class="text-sm font-medium text-slate-500 dark:text-jovieDark-300">
              Contact credits
            </dt>
            <dd
              class="dark:text-jovieDark-100sm:col-span-2 mt-1 flex text-sm text-slate-900 sm:mt-0">
              <span class="flex-grow"
                ><span class="text-slate-600"
                  >{{ currentUser.current_team.credits }}.</span
                >/{{
                  currentUser.current_team.current_subscription.credits
                }}
                Remaining</span
              >
            </dd>
          </div>

          <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
            <dt
              class="text-sm font-medium text-slate-500 dark:text-jovieDark-300">
              Seats
            </dt>
            <dd
              class="dark:text-jovieDark-100sm:col-span-2 mt-1 flex text-sm text-slate-900 sm:mt-0">
              <span class="flex-grow"> 1</span>
            </dd>
          </div>
        </dl>
      </div>
      <div class="justify-right mx-auto mt-4 w-full">
        <ButtonGroup
          v-if="currentUser.current_team.current_subscription.ends_at"
          @click="resumeSubscription()"
          :disabled="updatingSubscription"
          design="secondary"
          class="mr-4"
          text="Resume Subscription" />
        <ButtonGroup
          v-else
          @click="cancelSubscription()"
          :disabled="updatingSubscription"
          design="danger"
          class="mr-4"
          text="Cancel Subscription" />
        <ButtonGroup
          @click="toggleChangeSubscription(true)"
          :disabled="updatingSubscription"
          design="secondary"
          class="mr-4"
          text="Change Subscription" />
      </div>
    </template>
  </div>
</template>

<script>
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
import PaymentElement from './PaymentElement';
import JovieSpinner from '../components/JovieSpinner';

export default {
  name: 'Subscription',
  components: {
    JovieSpinner,
    PaymentElement,

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
      paymentProcessing: false,
      products: [],
      loadingProducts: false,
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
      showPayment: false,
      stripe: null,
      paymentElement: null,
    };
  },
  watch: {
    selectedProduct(val) {
      if (!val) return;
      try {
        const interval = this.annualBillingEnabled ? 'year' : 'month';
        let selectedProduct = Object.values(this.products).filter(
          (product) => product.id == val
        )[0];
        this.selectedPlan = selectedProduct.plans.filter(
          (plan) => plan.interval == interval
        )[0].id;
      } catch (e) {
        console.log(e);
        /*  alert('Problem in selecting product'); */
        this.$notify({
          group: 'user',
          title: 'Error',
          text: 'Problem in selecting product',
          type: 'error',
          duration: 10000,
        });
      }
    },
    annualBillingEnabled(val) {
      if (!this.selectedProduct) return;
      try {
        const interval = val ? 'year' : 'month';
        let selectedProduct = Object.values(this.products).filter(
          (product) => product.id == this.selectedProduct
        )[0];
        this.selectedPlan = selectedProduct.plans.filter(
          (plan) => plan.interval == interval
        )[0].id;
      } catch (e) {
        /* alert('Problem in selecting plan'); */
        this.$notify({
          group: 'user',
          title: 'Error',
          text: 'Problem in selecting plan',
          type: 'error',
          duration: 10000,
        });
      }
    },
  },
  async mounted() {
    if (
      !this.currentUser ||
      !this.currentUser.current_team.current_subscription
    ) {
      this.getProducts();
    }
  },
  methods: {
    next() {
      if (!this.selectedProduct || !this.selectedPlan) {
        /*  alert('Please select a plan to continue.'); */
        this.$notify({
          group: 'user',
          title: 'Error',
          text: 'Please select a plan to continue.',
          type: 'error',
          duration: 10000,
        });
        return;
      }
      this.showPayment = true;
      console.log(this.showPayment);
    },
    getProducts() {
      this.loadingProducts = true;
      UserService.getSubscriptionProducts()
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.products = response.products;
          } else {
            /*  alert(response.message); */
            this.$notify({
              group: 'user',
              title: 'Error',
              text: response.message,
              type: 'error',
              duration: 10000,
            });
          }
        })
        .catch(() => {})
        .finally(() => {
          this.loadingProducts = false;
        });
    },
    toggleChangeSubscription(toggle) {
      this.showSubscriptionPlans = toggle;
      if (toggle) {
        this.getProducts();
      } else {
        this.resetSelections();
      }
    },
    resetSelections() {
      this.selectedPlan = null;
      this.selectedProduct = null;
      this.annualBillingEnabled = false;
      this.showPayment = false;
    },
    resumeSubscription() {
      this.updatingSubscription = true;
      UserService.resumeSubscription()
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              title: 'Success',
              text: response.message,
              type: 'success',
              duration: 10000,
            });
            /*  alert(response.message); */
            this.currentUser.current_team.current_subscription =
              response.subscription;
          } else {
            /*  alert(response.message); */
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
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
            /* alert(response.message); */
            this.$notify({
              group: 'user',
              title: 'Success',
              text: response.message,
              type: 'success',
            });
            this.currentUser.current_team.current_subscription =
              response.subscription;
          } else {
            this.$notify({
              group: 'user',
              title: 'Error',
              text: response.message,
              type: 'error',
              duration: 10000,
            });
            /*  alert(response.message); */
          }
        })
        .finally(() => {
          this.updatingSubscription = false;
        });
    },
    async pay({ stripe, elements, coupon }) {
      if (this.processingPayment) return;
      if (!this.selectedProduct || !this.selectedPlan) {
        /*  alert('You must select a product and pricing to continue.'); */
        this.$notify({
          group: 'user',
          title: 'Error',
          text: 'You must select a product and pricing to continue.',
          type: 'error',
          duration: 10000,
        });
        return;
      }
      this.processingPayment = true;
      await stripe
        .confirmSetup({
          elements,
          redirect: 'if_required',
          confirmParams: {
            // Make sure to change this to your payment completion page
            return_url: 'http://localhost:4242/public/checkout.html',
          },
        })
        .then((result) => {
          console.log('result');
          console.log(result);
          if (result.error) {
            /* alert(result.error.message); */
            this.$notify({
              group: 'user',
              title: 'Error',
              text: result.error.message,
              type: 'error',
              duration: 10000,
            });
            this.processingPayment = false;
          } else {
            if (this.showSubscriptionPlans) {
              this.changeSubscription(
                result.setupIntent.payment_method,
                coupon
              );
            } else {
              this.newSubscription(result.setupIntent.payment_method, coupon);
            }
          }
        });
    },
    setPaymentElement(paymentElement) {
      this.paymentElement = paymentElement;
    },
    newSubscription(paymentId, coupon) {
      UserService.subscribe(
        paymentId,
        this.selectedPlan,
        this.selectedProduct,
        coupon
      )
        .then((response) => {
          response = response.data;
          if (response.status) {
            /* alert(response.message); */
            this.$notify({
              group: 'user',
              title: 'Success',
              text: response.message,
              type: 'success',
              duration: 10000,
            });
            this.resetSelections();
            this.currentUser.current_team.current_subscription =
              response.subscription;
            this.$router.push({ name: 'Account' });
          } else {
            /*  alert(response.message); */
            this.$notify({
              group: 'user',
              title: 'Error',
              text: `${response.message} ${response.error}`,
              type: 'error',
              duration: 10000,
            });
            this.$refs.paymentElement.initPaymentIntent();
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
          this.$refs.paymentElement.initPaymentIntent();
        })
        .finally(() => {
          this.paymentElement.clear();
          window.analytics.identify(this.user.email, {
            email: this.user.email,
            plan_name: this.user.current_team.current_subscription.name,
            name: this.user.first_name + ' ' + this.user.last_name,
          });
          //track and event for New Subscription
          window.analytics.track('New Subscription', {
            plan_name: this.user.current_team.current_subscription.name,
            name: this.user.first_name + ' ' + this.user.last_name,
            email: this.user.email,
          });
          this.processingPayment = false;
        });
    },
    changeSubscription(paymentId, coupon) {
      UserService.changeSubscription(
        paymentId,
        this.selectedPlan,
        this.selectedProduct,
        coupon
      )
        .then((response) => {
          response = response.data;
          if (response.status) {
            /*  alert(response.message); */
            this.$notify({
              group: 'user',
              title: 'Success',
              text: response.message,
              type: 'success',
              duration: 10000,
            });
            this.resetSelections();
            this.currentUser.current_team.current_subscription =
              response.subscription;
            this.toggleChangeSubscription(false);
            this.$router.push({ name: 'Account' });
          } else {
            /*  alert(response.message); */
            this.$notify({
              group: 'user',
              title: 'Error',
              text: `${response.message} ${response.error}`,
              type: 'error',
              duration: 10000,
            });
            this.$refs.paymentElement.initPaymentIntent();
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
          this.$refs.paymentElement.initPaymentIntent();
        })
        .finally(() => {
          this.paymentElement.clear();
          this.processingPayment = false;
        });
    },
  },
};
</script>

<style scoped></style>
