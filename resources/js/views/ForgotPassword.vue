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
          <h2 class="mt-6 text-3xl font-extrabold text-slate-900">
            Reset your password
          </h2>
          <p class="mt-2 text-sm text-slate-600">
            Or
            {{ ' ' }}
            <router-link
              to="/login"
              class="font-medium text-indigo-600 hover:text-indigo-500">
              Sign in
            </router-link>
          </p>
        </div>

        <div class="mt-8">
          <div class="mt-6">
            <form action="#" method="POST" class="space-y-6">
              <div>
                <div class="mt-1">
                  <InputGroup
                    v-model="email"
                    id="email"
                    :disabled="updating"
                    name="email"
                    label="Email"
                    placeholder="Email"
                    type="email"
                    autocomplete="email"
                    required="" />
                </div>
                <p class="mt-2 text-sm text-red-900" v-if="this.errors.email">
                  {{ this.errors.email[0] }}
                </p>
              </div>

              <div>
                <button
                  type="button"
                  :disabled="updating"
                  @click="sendResetEmail()"
                  class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                  Reset password
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
import InputGroup from '../components/InputGroup.vue';
import UserService from '../services/api/user.service';

export default {
  mounted() {
    //add segment analytics
    window.analytics.page(this.$route.path);
  },
  components: {
    JovieLogo,
    InputGroup,
    AuthFooter,
  },
  data() {
    return {
      updating: false,
      errors: {},
      email: null,
    };
  },
  methods: {
    sendResetEmail() {
      this.updating = true;
      UserService.sendResetEmail({ email: this.email })
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.errors = {};
            this.$notify({
              group: 'user',
              title: 'Successful',
              text: response.message,
              type: 'success',
            });
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          this.updating = false;
        });
    },
  },
};
</script>
