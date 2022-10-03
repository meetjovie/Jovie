<template>
    <div class="w-full">
        <div class="mx-auto w-full max-w-4xl">
            <div class="w-full">
                <div
                    id="card"
                    class="flex-inline appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm"></div>
            </div>
        </div>
    </div>
    <div class="mt-2 w-full mx-auto max-w-4xl ">
        <div class="flex items-center">
            <input
                id="add_coupon"
                v-model="addCoupon"
                name="add_coupon"
                type="checkbox"
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500" />
            <label
                for="remember-me"
                class="ml-2 block text-sm text-gray-900">
                Add Coupon
            </label>
        </div>
        <InputGroup
            v-if="addCoupon"
            v-model="coupon"
            id="coupon"
            :disabled="processingPayment"
            name="coupon"
            placeholder="Enter your coupon"
            type="text"
            required="" />
        <p
            class="mt-1 text-sm text-red-900"
            v-if="errors.coupon">
            {{ errors.coupon[0] }}
        </p>
    </div>
    <div class="mt-2 w-full">
        <div class="flex justify-between">
            <ButtonGroup
                :disabled="processingPayment"
                :text="processingPayment ? 'Processing' : buttonText"
                :loader="processingPayment"
                type="button"
                @click="$emit('pay', {stripe: stripe, elements: elements, coupon: coupon})" />
        </div>
    </div>
</template>

<script>
import {loadStripe} from "@stripe/stripe-js";
import UserService from "../services/api/user.service";
import ButtonGroup from './ButtonGroup';
import InputGroup from './InputGroup';

export default {
    name: "PaymentElement",
    components: {ButtonGroup, InputGroup},
    props: {
        processingPayment: {
            type: Boolean,
            default: false
        },
        buttonText: {
            type: String,
            default: 'Pay'
        },
        errors: {
            type: Object,
            default: {}
        }
    },
    data() {
        return {
            stripe: null,
            stripeLoaded: false,
            paymentIntent: null,
            elements: null,
            coupon: null,
            addCoupon: false
        }
    },
    watch: {
        processingPayment(val) {
            this.paymentElement.update({readOnly: val});
        }
    },
    methods: {
        clear() {
            this.paymentElement.clear();
        },
        initPaymentIntent() {
            UserService.paymentIntent().then(async (response) => {
                response = response.data;
                if (response.status) {
                    this.stripeLoaded = true;
                    this.paymentIntent = response.intent;

                    this.stripe = await loadStripe(response.stripeKey);
                    this.elements = this.stripe.elements({
                        clientSecret: this.paymentIntent.client_secret,
                    });
                    this.paymentElement = this.elements.create('payment');
                    this.paymentElement.mount('#card');
                    this.$emit('setPaymentElement', this.paymentElement)
                } else {
                    alert(response.message);
                }
            });
        }
    },
    async mounted() {
        this.initPaymentIntent()
    }
}
</script>

<style scoped>

</style>
