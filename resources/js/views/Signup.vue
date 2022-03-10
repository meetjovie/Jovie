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
          <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
            Create an account
          </h2>
          <p class="mt-2 text-sm text-gray-600">
            Or if you already have an account
            {{ ' ' }}
            <router-link
              to="Login"
              class="font-medium text-indigo-600 hover:text-indigo-500">
              login
            </router-link>
          </p>
          <ul v-if="error" class="mt-2 text-sm text-red-900">
            <li>{{ error }}</li>
          </ul>
        </div>

        <div class="mt-8">
          <div class="mt-6">
            <form action="#" method="POST" class="space-y-6">
              <template v-if="step == 1">
                <div class="grid grid-cols-2 gap-6">
                  <div class="col-span-1">
                    <label for="first_name" class="sr-only"> First Name </label>
                    <div class="mt-1">
                      <input
                        v-model="user.first_name"
                        id="first_name"
                        name="first_name"
                        type="text"
                        autocomplete="first_name"
                        required=""
                        placeholder="First Name"
                        class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                      <p
                        class="mt-2 text-sm text-red-900"
                        v-if="this.errors.first_name">
                        {{ this.errors.first_name[0] }}
                      </p>
                    </div>
                  </div>
                  <div class="col-span-1">
                    <label for="last_name" class="sr-only">Last Name</label>
                    <div class="mt-1">
                      <input
                        v-model="user.last_name"
                        id="last_name"
                        name="last_name"
                        placeholder="Last Name"
                        type="text"
                        autocomplete="last_name"
                        required=""
                        class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                      <p
                        class="mt-2 text-sm text-red-900"
                        v-if="this.errors.last_name">
                        {{ this.errors.last_name[0] }}
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <label for="email" class="sr-only"> Email address </label>
                  <div class="mt-1">
                    <input
                      v-model="user.email"
                      id="email"
                      name="email"
                      placeholder="Email address"
                      type="email"
                      autocomplete="email"
                      required=""
                      class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
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
              </template>
              <template v-if="step == 2">
                <div class="space-y-1">
                  <label for="password" class="sr-only"> Password </label>
                  <div class="mt-1">
                    <input
                      v-model="user.password"
                      id="password"
                      name="password"
                      placeholder="Password"
                      type="password"
                      autocomplete="current-password"
                      required=""
                      class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                    <p
                      class="mt-2 text-sm font-bold text-red-900"
                      v-if="this.errors.password">
                      {{ this.errors.password[0] }}
                    </p>
                  </div>
                </div>
                <div class="space-y-1">
                  <label for="password_confirmation" class="sr-only">
                    Confirm Password
                  </label>
                  <div class="mt-1">
                    <input
                      v-model="user.password_confirmation"
                      id="password_confirmation"
                      name="password_confirmation"
                      placeholder="Confirm Password"
                      type="password"
                      autocomplete="current-password"
                      required=""
                      class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                    <p
                      class="mt-2 text-sm font-bold text-red-900"
                      v-if="this.errors.password">
                      {{ this.errors.password[0] }}
                    </p>
                  </div>
                </div>

                <div>
                  <button
                    type="button"
                    @click="back()"
                    class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                    Back
                  </button>
                </div>
                <div>
                  <button
                    type="button"
                    @click="register()"
                    :disabled="submitting"
                    class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                    Create account
                  </button>
                </div>
              </template>
            </form>
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
import router from '../router';
import AuthService from '../services/auth/auth.service';

export default {
  components: {
    JovieLogo,
    AuthFooter,
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
            router.push({ name: 'Dashboard' });
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
