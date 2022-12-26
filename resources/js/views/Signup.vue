<template>
  <div class="flex min-h-screen bg-white dark:bg-jovieDark-900">
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
            <JovieLogo
              tabindex="-1"
              v-if="$store.theme === 'dark'"
              height="48px"
              color="#000" />
            <JovieLogo tabindex="-1" v-else height="48px" color="#fff" />
          </div>
        </div>

        <div class="mt-8">
          <div class="min-h-96 mt-6">
            <form action="#" method="POST" class="space-y-6">
              <template v-if="step == 1">
                <CreateAccount />
                <div v-show="!showEmailSignupMethod">
                  <ButtonGroup
                    :disabled="loading"
                    @click.prevent="authProvider('google')"
                    :text="'Continue with Google'"
                    type="button"
                    icon="google"
                    class="mt-4 flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                  </ButtonGroup>
                  <ButtonGroup
                    :disabled="loading"
                    @click.prevent="showEmailSignupMethod = true"
                    :text="'Continue with email'"
                    type="button"
                    design="secondary"
                    class="mt-4 flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                  </ButtonGroup>
                </div>
                <div v-show="showEmailSignupMethod">
                  <div
                    v-show="showEmailSignupMethod"
                    class="grid grid-cols-2 gap-6">
                    <div class="col-span-1">
                      <div class="relative mt-1">
                        <InputGroup
                          v-model="user.first_name"
                          id="first_name"
                          name="first_name"
                          type="text"
                          :valid="firstNameIsValid"
                          @blur="validateFirstName"
                          autocomplete="first_name"
                          required=""
                          label="First Name"
                          placeholder="First Name" />
                        <p
                          class="mt-2 text-sm text-red-900"
                          v-if="this.errors.first_name">
                          {{ this.errors.first_name[0] }}
                        </p>
                      </div>
                    </div>
                    <div class="col-span-1">
                      <div class="relative mt-1">
                        <InputGroup
                          v-model="user.last_name"
                          id="last_name"
                          :valid="lastNameIsValid"
                          @blur="validateLastName"
                          name="last_name"
                          placeholder="Last Name"
                          label="Last Name"
                          type="text"
                          autocomplete="last_name"
                          required="" />
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
                      <InputGroup
                        v-model="user.email"
                        id="email"
                        :valid="emailIsValid"
                        name="email"
                        label="Email address"
                        @blur="validateEmail"
                        placeholder="Email address"
                        type="email"
                        autocomplete="email"
                        v-on:keyup.enter="nextStep()"
                        required="" />
                      <p
                        class="mt-2 text-sm text-red-900"
                        v-if="this.errors.email">
                        {{ this.errors.email[0] }}
                      </p>
                    </div>
                  </div>

                  <div>
                    <ButtonGroup
                      type="button"
                      @click="nextStep()"
                      :loader="loading"
                      :disabled="submitting"
                      text="Next"
                      class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                    </ButtonGroup>
                  </div>
                </div>

                <h3
                  class="mx-auto text-center text-xs text-slate-400 dark:text-jovieDark-300">
                  Fast & easy. No credit card required.
                </h3>
              </template>
              <template v-if="step == 2">
                <CreateAccount text="Enter a password" />
                <div class="space-y-1">
                  <div class="relative mt-1">
                    <InputGroup
                      v-model="user.password"
                      id="password"
                      name="password"
                      placeholder="Password"
                      label="Password"
                      :loader="passwordIsLoading"
                      type="password"
                      :valid="passwordIsValid"
                      @blur="validatePassword"
                      autocomplete="current-password"
                      required="" />
                    <p
                      class="mt-2 text-sm font-bold text-red-900"
                      v-if="this.errors.password">
                      {{ this.errors.password[0] }}
                    </p>
                  </div>
                </div>
                <div class="space-y-1">
                  <div class="relative mt-1">
                    <InputGroup
                      v-model="user.password_confirmation"
                      id="password_confirmation"
                      name="password_confirmation"
                      placeholder="Confirm Password"
                      label="Confirm Password"
                      type="password"
                      v-on:keyup.enter="register()"
                      autocomplete="confirm-password"
                      required="" />
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
                    <ButtonGroup
                      type="button"
                      tabindex="0"
                      @click="register()"
                      :loader="loading"
                      :success="success"
                      :error="error"
                      :disabled="submitting"
                      text="Create Account">
                    </ButtonGroup>
                  </div>
                </div>
                <p class="text-2xs text-slate-400 dark:text-jovieDark-200">
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
                  <p class="mt-1 text-sm text-slate-500">
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
import InputGroup from '../components/InputGroup.vue';
import ButtonGroup from '../components/ButtonGroup.vue';

export default {
  components: {
    JovieLogo,
    AuthFooter,
    CreateAccount,
    ButtonGroup,
    InputGroup,
  },
  data() {
    return {
      showEmailSignupMethod: false,
      errors: {},
      error: '',
      step: 1,
      emailIsValid: false,
      firstNameIsValid: false,
      lastNameIsValid: false,
      passwordIsValid: false,
      passwordIsLoading: false,
      user: {
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      submitting: false,
      success: false,
      loading: false,
    };
  },
  mounted() {
    //add segment analytics
    window.analytics.page(this.$route.path);
  },
  methods: {
    authProvider(provider) {
      window.location.href = `http://127.0.0.1:8000/auth/${provider}/redirect`;
    },
    back() {
      this.user.password = '';
      this.user.password_confirmation = '';
      this.step = 1;
    },
    nextStep() {
      this.loading = true;
      if (this.user.first_name && this.user.last_name && this.user.email) {
        this.errors = {};
        this.error = '';
        this.validateStep1();
      } else {
        this.loading = false;
        this.error = 'Please fill in your name & email to continue.';
      }
    },
    validateEmail() {
      if (this.user.email) {
        this.emailIsValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.user.email);

        this.errors.email = [];
      } else {
        this.emailIsValid = false;
        this.errors.email = ['Please enter your email.'];
      }
    },
    validateFirstName() {
      if (this.user.first_name) {
        this.firstNameIsValid = /^[a-zA-Z]+$/.test(this.user.first_name);
        this.errors.first_name = [];
      } else {
        this.firstNameIsValid = false;
        this.errors.first_name = ['First name is required.'];
      }
    },
    validateLastName() {
      if (this.user.last_name) {
        this.lastNameIsValid = /^[a-zA-Z]+$/.test(this.user.last_name);
        this.errors.last_name = [];
      } else {
        this.lastNameIsValid = false;
        this.errors.last_name = ['Last name is required.'];
      }
    },
    validatePassword() {
      AuthService.validateStep1(this.user.password).then(
        (response) => {
          this.passwordIsValid = true;
          this.errors.password = [];
        },
        (error) => {
          this.error = error.response.data.message;
        }
      );
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
          this.success = false;
        })
        .finally(() => {
          //identify call to segment
          window.analytics.identify(this.user.email, {
            email: this.user.email,
            created_at: new Date(),
            plan_name: 'free',
            name: this.user.first_name + ' ' + this.user.last_name,
          });
          this.submitting = false;
          this.loading = false;
        });
    },
    register() {
      this.loading = true;
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
        .then(() => {
          //track call to segment
          window.analytics.track('Signed Up', {
            first_name: this.user.first_name,
            last_name: this.user.last_name,
            email_address: this.user.email,
          });
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
            this.error = error.response.data.message;
            return;
          }
          alert('Something went wrong.');
          this.success = false;
        })
        .finally(() => {
          this.submitting = false;
          this.success = true;
          this.loading = false;
        });
    },
  },
};
</script>
