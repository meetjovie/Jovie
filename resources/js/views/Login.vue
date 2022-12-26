<template>
  <Head>
    <title>Jovie Social CRM | Login to Jovie</title>
    <meta name="description" content="Login to your Jovie account." />
    <!--- OpenGraph -->
    <meta property="og:image:height" content="333" />
    <meta property="og:image:width" content="636" />
    <meta property="og:description" content="Organize everyone you follow" />
    <meta property="og:title" content="Jovie | Social CRM" />
    <meta property="og:url" content="http://jov.ie" />
    <meta
      property="og:image"
      content="https://jovie-production-store.s3.amazonaws.com/og-image.jpg" />
    <!-- End OpenGraph -->
  </Head>

  <div class="flex min-h-screen bg-white dark:bg-jovieDark-900">
    <div
      class="relative hidden h-screen flex-1 items-center bg-indigo-700 dark:bg-indigo-800 lg:flex">
      <div class="m-auto flex h-full items-center">
        <JovieLogo height="48px" color="#fff" />
      </div>
    </div>
    <div
      class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
      <div class="mx-auto w-full max-w-sm lg:w-96">
        <div>
          <div class="block lg:hidden">
            <JovieLogo
              v-if="$store.theme === 'dark'"
              height="28px"
              color="#000" />
            <JovieLogo v-else height="28px" color="#fff" />
          </div>
          <h2
            class="mt-6 text-center text-3xl font-extrabold text-slate-900 dark:text-jovieDark-100">
            Log in to Jovie
          </h2>
          <p class="mt-2 text-center text-sm text-slate-600">
            Or
            {{ ' ' }}
            <router-link
              to="/signup"
              class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-300 dark:hover:text-indigo-400">
              Create an account
            </router-link>
          </p>

          <ul v-if="error" class="text-red-900">
            <li>{{ error }}</li>
          </ul>
        </div>

        <div class="mt-8">
          <div
            class="divide-x divide-slate-300 dark:divide-jovieDark-border"
            v-show="!showEmailLoginMethod">
            <ButtonGroup
              :disabled="loggingIn"
              :error="buttonError"
              icon="google"
              @click.prevent="authProvider('google')"
              :text="loggingIn ? 'Logging in...' : 'Continue with Google'"
              :loader="loggingIn"
              :success="successfulLogin"
              type="button"
              class="mt-4 flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
            </ButtonGroup>

            <ButtonGroup
              :disabled="loggingIn"
              :error="buttonError"
              @click.prevent="showEmailLoginMethod = !showEmailLoginMethod"
              :text="loggingIn ? 'Logging in...' : 'Continue with Email'"
              :loader="loggingIn"
              :success="successfulLogin"
              design="secondary"
              type="button"
              class="mt-4 flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
            </ButtonGroup>
            <span
              class="mt-4 text-center text-[8px] text-slate-600 dark:text-jovieDark-400">
              By clicking “Continue with Apple/Google/Email/SAML” above, you
              acknowledge that you have read and understood, and agree to
              Jovie's
              <router-link
                to="/legal"
                class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-300 dark:hover:text-indigo-400">
                Privacy Policy
              </router-link>
              and
              <router-link
                to="/legal"
                class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-300 dark:hover:text-indigo-400">
                Terms of Service </router-link
              >.
            </span>
          </div>

          <div v-show="showEmailLoginMethod" class="mt-6">
            <form action="#" method="POST" class="space-y-6">
              <div>
                <div class="relative mt-1">
                  <InputGroup
                    v-model="user.email"
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    placeholder="Email"
                    label="Email"
                    required="" />
                  <p class="mt-1 text-xs text-red-700" v-if="this.errors.email">
                    {{ this.errors.email[0] }}
                  </p>
                </div>
              </div>

              <div>
                <div class="relative mt-1">
                  <InputGroup
                    v-model="user.password"
                    id="password"
                    name="password"
                    label="Password"
                    placeholder="Password"
                    type="password"
                    v-on:keyup.enter="login()"
                    autocomplete="current-password"
                    required="" />
                  <p
                    class="mt-1 text-xs text-red-700"
                    v-if="this.errors.password">
                    {{ this.errors.password[0] }}
                  </p>
                </div>
              </div>

              <div>
                <ButtonGroup
                  :disabled="loggingIn"
                  :error="buttonError"
                  @click="login()"
                  :text="loggingIn ? 'Logging in...' : 'Log in'"
                  :loader="loggingIn"
                  :success="successfulLogin"
                  type="button"
                  class="mt-4 flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                </ButtonGroup>
              </div>

              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <input
                    id="remember-me"
                    name="remember-me"
                    type="checkbox"
                    class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" />
                  <label
                    for="remember-me"
                    class="ml-2 block text-sm text-slate-900 dark:text-jovieDark-100">
                    Remember me
                  </label>
                </div>

                <div class="text-sm">
                  <router-link
                    :to="{ name: 'forget-password' }"
                    class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-300 dark:hover:text-indigo-400">
                    Forgot your password?
                  </router-link>
                </div>
              </div>
            </form>
            <div class="flex w-full justify-end">
              <div
                @click="showEmailLoginMethod = !showEmailLoginMethod"
                class="cursor-pointer justify-end text-xs text-slate-600 dark:text-jovieDark-400">
                Login another way
              </div>
            </div>
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
import InputGroup from '../components/InputGroup.vue';
import ButtonGroup from '../components/ButtonGroup.vue';
import { Head } from '@vueuse/head';
export default {
  components: {
    JovieLogo,
    AuthFooter,
    InputGroup,
    ButtonGroup,
    Head,
  },
  mounted() {
    //add segment analytics
    window.analytics.page(this.$route.path);
  },
  data() {
    return {
      errors: {},
      showEmailLoginMethod: false,
      buttonError: false,
      error: '',

      user: {
        email: '',
        password: '',
      },
      loggingIn: false,
      successfulLogin: false,
    };
  },
  methods: {
    authProvider(provider) {
      window.location.href = process.env.MIX_GOOGLE_URL;
    },
    login() {
      this.errors = {};
      this.error = '';
      this.buttonError = false;
      this.loggingIn = true;

      if (this.$store.state.isExtension) {
        AuthService.loginUserExtension(this.user)
          .then((response) => {
            response = response.data;
            localStorage.setItem('jovie_extension', response.token);
            document.cookie = `jovie_extension=${response.token}`;
            if (response.status) {
              this.$store.commit('setAuthStateUser', response.user);
              this.buttonError = false;
              this.successfulLogin = true;
              window.analytics.track('User Logged In', {
                email: this.user.email,
                first_name: this.user.first_name,
                last_name: this.user.last_name,
              });
              router.push({ name: 'Extension' });
            } else {
              this.error = response.error;
            }
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
              this.buttonError = true;
              return;
            }
            alert('Something went wrong.');
          })
          .finally(() => {
            this.loggingIn = false;
          });
      } else {
        AuthService.login(this.user)
          .then((response) => {
            response = response.data;
            localStorage.setItem('jovie_extension', response.token);
            document.cookie = `jovie_extension=${response.token}`;
            if (response.status) {
              this.$store.commit('setAuthStateUser', response.user);
              this.buttonError = false;
              this.successfulLogin = true;
              window.analytics.track('User Logged In', {
                email: this.user.email,
                first_name: this.user.first_name,
                last_name: this.user.last_name,
              });
              router.push({ name: 'Contacts' });
            } else {
              this.error = response.error;
            }
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
              this.buttonError = true;
              return;
            }
            alert('Something went wrong.');
          })
          .finally(() => {
            this.loggingIn = false;
          });
      }
    },
  },
};
</script>
