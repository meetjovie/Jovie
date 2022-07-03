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
    <div class="mt-2 w-full">
        <div class="flex justify-between">
            <ButtonGroup
                :disabled="processingPayment"
                :text="processingPayment ? 'Processing' : buttonText"
                :loader="processingPayment"
                type="button"
                @click="$emit('pay', {stripe: stripe, elements: elements})" />
        </div>
    </div>
</template>

<script>
import {loadStripe} from "@stripe/stripe-js";
import UserService from "../services/api/user.service";
import ButtonGroup from './ButtonGroup';

export default {
    name: "PaymentElement",
    components: {ButtonGroup},
    props: {
        processingPayment: {
            type: Boolean,
            default: false
        },
        buttonText: {
            type: String,
            default: 'Pay'
        }
    },
    data() {
        return {
            stripe: null,
            stripeLoaded: false,
            paymentIntent: null,
            elements: null
        }
    },
    computed: {
        stripeKey() {
            console.log('process.env.MIX_STRIPE_KEY');
            console.log(process.env.MIX_STRIPE_KEY);
            return process.env.MIX_STRIPE_KEY;
        },
    },
    watch: {
        processingPayment(val) {
            this.paymentElement.update({readOnly: val});
        }
    },
    methods: {
        clear() {
            this.paymentElement.clear();
        }
    },
    async mounted() {
        UserService.paymentIntent().then(async (response) => {
            response = response.data;
            if (response.status) {
                this.stripeLoaded = true;
                this.paymentIntent = response.intent;

                this.stripe = await loadStripe(this.stripeKey);
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
}
</script>

<style scoped>

</style>
