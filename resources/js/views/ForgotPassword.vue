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
            Reset your password
          </h2>
          <p class="mt-2 text-sm text-gray-600">
            Or
            {{ ' ' }}
            <router-link
              to="/signin"
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
                    id="email"
                    name="email"
                    label="Email"
                    type="email"
                    autocomplete="email"
                    required="" />
                </div>
              </div>

              <div>
                <button
                  type="submit"
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
};
</script>
