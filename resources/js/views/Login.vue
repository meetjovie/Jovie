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
          <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Sign in</h2>
          <p class="mt-2 text-sm text-gray-600">
            Or
            {{ ' ' }}
            <router-link
              to="/signup"
              class="font-medium text-indigo-600 hover:text-indigo-500">
              Create an account
            </router-link>
          </p>

          <ul v-if="error" class="text-red-900">
            <li>{{ error }}</li>
          </ul>
        </div>

        <div class="mt-8">
          <div class="mt-6">
            <form action="#" method="POST" class="space-y-6">
              <div>
                <div class="relative mt-1">
                  <input
                    v-model="user.email"
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    placeholder="Email"
                    required=""
                    class="peer block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-transparent placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                  <label
                    for="email"
                    class="absolute -top-2.5 left-0 ml-3 block bg-white px-1 text-xs font-medium text-gray-500 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-gray-400 peer-focus:left-0 peer-focus:-top-2.5 peer-focus:text-xs peer-focus:font-medium">
                    Email address
                  </label>
                  <p class="mt-2 text-sm text-red-900" v-if="this.errors.email">
                    {{ this.errors.email[0] }}
                  </p>
                </div>
              </div>

              <div>
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
                    for="password"
                    class="absolute -top-2.5 left-0 ml-3 block bg-white px-1 text-xs font-medium text-gray-500 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-gray-400 peer-focus:left-0 peer-focus:-top-2.5 peer-focus:text-xs peer-focus:font-medium">
                    Password
                  </label>
                  <p
                    class="mt-2 text-sm text-red-900"
                    v-if="this.errors.password">
                    {{ this.errors.password[0] }}
                  </p>
                </div>
              </div>

              <div>
                <button
                  :disabled="loggingIn"
                  @click="login()"
                  type="button"
                  class="mt-4 flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                  Sign in
                </button>
              </div>
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
