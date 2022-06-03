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
            <JovieLogo tabindex="-1" height="28px" />
          </div>
        </div>

        <div class="mt-8">
          <div class="mt-6">
            <form action="#" method="POST" class="space-y-6">
              <template v-if="step == 1">
                <CreateAccount />
                <div class="grid grid-cols-2 gap-6">
                  <div class="col-span-1">
                    <div class="relative mt-1">
                      <input
                        v-model="user.first_name"
                        id="first_name"
                        name="first_name"
                        type="text"
                        autocomplete="first_name"
                        required=""
                        placeholder="First Name"
                        class="peer block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-transparent placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                      <label
                        for="first_name"
                        class="absolute -top-2.5 left-0 ml-3 block bg-white px-1 text-xs font-medium text-gray-500 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-gray-400 peer-focus:left-0 peer-focus:-top-2.5 peer-focus:text-xs peer-focus:font-medium"
                        >First Name
                      </label>
                      <p
                        class="mt-2 text-sm text-red-900"
                        v-if="this.errors.first_name">
                        {{ this.errors.first_name[0] }}
                      </p>
                    </div>
                  </div>
                  <div class="col-span-1">
                    <div class="relative mt-1">
                      <input
                        v-model="user.last_name"
                        id="last_name"
                        name="last_name"
                        placeholder="Last Name"
                        type="text"
                        autocomplete="last_name"
                        required=""
                        class="peer block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-transparent placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                      <label
                        for="last_name"
                        class="absolute -top-2.5 left-0 ml-3 block bg-white px-1 text-xs font-medium text-gray-500 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-gray-400 peer-focus:left-0 peer-focus:-top-2.5 peer-focus:text-xs peer-focus:font-medium"
                        >Last Name</label
                      >
                      <p
                        class="mt-2 text-sm text-red-900"
                        v-if="this.errors.last_name">
                        {{ this.errors.last_name[0] }}
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="relative mt-1">
                    <input
                      v-model="user.email"
                      id="email"
                      name="email"
                      placeholder="Email address"
                      type="email"
                      autocomplete="email"
                      required=""
                      class="peer block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-transparent placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                    <label
                      for="email"
                      class="absolute -top-2.5 left-0 ml-3 block bg-white px-1 text-xs font-medium text-gray-500 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-gray-400 peer-focus:left-0 peer-focus:-top-2.5 peer-focus:text-xs peer-focus:font-medium">
                      Email address
                    </label>
                    <p
                      class="mt-2 text-sm text-red-900"
                      v-if="this.errors.email">
                      {{ this.errors.email[0] }}
                    </p>
                  </div>
                </div>

                <div>
                  <button
                    type="button"
                    @click="nextStep()"
                    :disabled="submitting"
                    class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                    Next
                  </button>
                </div>

                <h3 class="mx-auto text-center text-xs text-gray-400">
                  Fast & easy. No credit card required.
                </h3>
              </template>
              <template v-if="step == 2">
                <CreateAccount text="Enter a password" />
                <div class="space-y-1">
                  <div class="relative mt-1">
                    <input
                      v-model="user.password"
                      id="password"
                      name="password"
                      placeholder="Password"
                      type="password"
                      autocomplete="current-password"
                      required=""
                      class="peer block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-transparent placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                    <label
                      for="email"
                      class="absolute -top-2.5 left-0 ml-3 block bg-white px-1 text-xs font-medium text-gray-500 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-gray-400 peer-focus:left-0 peer-focus:-top-2.5 peer-focus:text-xs peer-focus:font-medium">
                      Password
                    </label>
                    <p
                      class="mt-2 text-sm font-bold text-red-900"
                      v-if="this.errors.password">
                      {{ this.errors.password[0] }}
                    </p>
                  </div>
                </div>
                <div class="space-y-1">
                  <div class="relative mt-1">
                    <input
                      v-model="user.password_confirmation"
                      id="password_confirmation"
                      name="password_confirmation"
                      placeholder="Confirm Password"
                      type="password"
                      autocomplete="current-password"
                      required=""
                      class="peer block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-transparent placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                    <label
                      for="password_confirmation"
                      class="absolute -top-2.5 left-0 ml-3 block bg-white px-1 text-xs font-medium text-gray-500 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-gray-400 peer-focus:left-0 peer-focus:-top-2.5 peer-focus:text-xs peer-focus:font-medium">
                      Confirm Password
                    </label>
                    <p
                      class="mt-2 text-sm font-bold text-red-900"
                      v-if="this.errors.password">
                      {{ this.errors.password[0] }}
                    </p>
                  </div>
                </div>
                <div class="grid grid-cols-2">
                  <div>
                    <button
                      type="button"
                      @click="back()"
                      tabindex="0"
                      class="col-span-1 cursor-pointer justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium text-indigo-600 hover:text-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                      Back
                    </button>
                  </div>
                  <div>
                    <button
                      type="button"
                      tabindex="0"
                      @click="register()"
                      :disabled="submitting"
                      class="col-span-1 w-full cursor-pointer justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                      Create account
                    </button>
                  </div>
                </div>
                <p class="text-2xs text-gray-400">
                  By clicking “Sign up” you agree to our
                  <router-link class="underline" to="privacy"
                    >privacy policy</router-link
                  >.and
                  <router-link class="underline" to="terms">terms</router-link>
                  of use. You’re also opting in to receive marketing emails. You
                  can unsubscribe at anytime.
                </p>
              </template>
              <!--  <template v-if="step == 3">
                <CreateAccount text="Choose a plan">
                  <p class="mt-1 text-sm text-gray-500">
                    Choose a plan that fits your needs.
                  </p>
                </CreateAccount>
                <div class="space-y-1">
                  <Subscription />
                </div>
              </template> -->
            </form>
          </div>
        </div>
      </div>
      <AuthFooter></AuthFooter>
    </div>
  </div>
</template>
<script>
import CreateAccount from '../components/External/CreateAccount.vue';
import JovieLogo from '../components/JovieLogo';
import AuthFooter from '../components/Auth/AuthFooter.vue';
import AuthService from '../services/auth/auth.service';
import Subscription from '../components/Subscription';

export default {
  components: {
    Subscription,
    JovieLogo,
    AuthFooter,
    CreateAccount,
  },
  data() {
    return {
      errors: {},
      error: '',
      step: 1,
      user: {
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      submitting: false,
    };
  },
  methods: {
    back() {
      this.user.password = '';
      this.user.password_confirmation = '';
      this.step = 1;
    },
    nextStep() {
      if (this.user.first_name && this.user.last_name && this.user.email) {
        this.errors = {};
        this.error = '';
        this.validateStep1();
      } else {
        this.error = 'Please fill in your name & email to continue.';
      }
    },
    validateStep1() {
      this.submitting = true;
      AuthService.validateStep1(this.user)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.step = 2;
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
            this.error = error.response.data.message;
            return;
          }
          alert('Something went wrong.');
        })
        .finally(() => {
          this.submitting = false;
        });
    },
    register() {
      this.errors = {};
      this.error = '';
      this.submitting = true;
      AuthService.register(this.user)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$store.commit('setAuthStateUser', response.user);
            this.$router.push({ name: 'Home' });
          } else {
            this.error = response.error;
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
            this.error = error.response.data.message;
            return;
          }
          alert('Something went wrong.');
        })
        .finally(() => {
          this.submitting = false;
        });
    },
  },
};
</script>
