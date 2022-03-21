<template>
  <div class="flex min-h-screen">
    <div
      class="relative hidden h-screen flex-1 items-center bg-indigo-700 lg:flex">
      <div class="m-auto flex h-full items-center">
        <JovieLogo height="48px" color="#fff" />
      </div>
    </div>
    <div
      class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
      <div class="mx-auto w-full max-w-sm lg:w-96">
        <div>
          <div class="block lg:hidden">
            <JovieLogo height="28px" />
          </div>
          <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Payment</h2>
          <p class="mt-2 text-sm text-gray-600">
            <span to="/signup" class="font-medium text-neutral-600">
              Choose a plan that fits your needs
            </span>
          </p>

          <ul v-if="error" class="text-red-900">
            <li>{{ error }}</li>
          </ul>
        </div>
        <div class="mt-8">
          <div class="mt-6">Plan picker placeholder</div>
        </div>
        <div class="mt-8">
          <div class="mt-6">
            Payment component placeholder
            <stripe-element-payment
              ref="paymentRef"
              :pk="pk"
              :elements-options="elementsOptions"
              :confirm-params="confirmParams" />
          </div>
        </div>
      </div>
      <AuthFooter></AuthFooter>
    </div>
  </div>
</template>
<script>
import JovieLogo from '../components/JovieLogo';
import AuthFooter from '../components/Auth/AuthFooter.vue';
import AuthService from '../services/auth/auth.service';
import router from '../router';

export default {
  components: {
    JovieLogo,
    AuthFooter,
  },
  data() {
    return {
      errors: {},
      error: '',
      user: {
        email: '',
        password: '',
      },
      loggingIn: false,
    };
  },
  methods: {
    login() {
      this.errors = {};
      this.error = '';
      this.loggingIn = true;
      AuthService.login(this.user)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$store.commit('setAuthStateUser', response.user);
            router.push({ name: 'Dashboard' });
          } else {
            this.error = response.error;
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
            return;
          }
          alert('Something went wrong.');
        })
        .finally(() => {
          this.loggingIn = false;
        });
    },
  },
};
</script>
