<!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
  <div class="bg-gray-800">
    <div
      class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:flex lg:items-center lg:py-16 lg:px-8">
      <div class="lg:w-0 lg:flex-1">
        <h2
          class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl"
          id="newsletter-headline">
          Stay in the loop
        </h2>
        <p class="mt-3 max-w-3xl text-lg leading-6 text-gray-300">
          Drop you email to get insights & updates on everything Jovie.
        </p>
      </div>
      <div class="mt-8 lg:mt-0 lg:ml-8">
        <form
          v-if="waitlistComplete == false"
          class="mt-4 sm:flex sm:max-w-md lg:mt-0">
          <label for="email" class="sr-only">Email address</label>
          <input
            type="email"
            v-on:keyup.enter="requestDemo()"
            v-model="waitListEmail"
            name="email"
            id="hero-email"
            autocomplete="email"
            required=""
            class="w-full min-w-0 appearance-none rounded-md border border-gray-300 bg-white py-2 px-4 text-base text-gray-900 placeholder-gray-500 focus-visible:border-indigo-500 focus-visible:placeholder-gray-400 focus-visible:outline-none focus-visible:ring-indigo-500 sm:max-w-xs"
            placeholder="Enter your email" />
          <div class="mt-3 rounded-md sm:mt-0 sm:ml-3 sm:flex-shrink-0">
            <ButtonGroup
              type="submit"
              :loader="loading"
              @click="requestDemo()"
              text="Subscribe"
              design="hero">
            </ButtonGroup>
          </div>
          <div>
            <span class="float-left h-8 px-2 text-xs font-bold text-red-500">{{
              this.error
            }}</span>
          </div>
        </form>
        <div v-else class="flex min-w-0">
          <p class="text-sm text-gray-500">You're subscribed!</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ButtonGroup from '../../components/ButtonGroup.vue';
export default {
  name: 'NewsletterSignup',
  components: {
    ButtonGroup,
  },
  data() {
    return {
      currentYear: new Date().getFullYear(),
      waitListEmail: '',
      error: '',
      loading: false,
      waitlistComplete: false,
    };
  },
  methods: {
    async requestDemo() {
      this.loading = true;
      await UserService.addToWaitList({
        email: this.waitListEmail,
        page: 'NewsletterSignup',
      })
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.waitListEmail = '';
            this.error = null;
            this.loading = false;
            this.waitlistComplete = true;
            window.location.href = '/signup?email=' + this.waitListEmail;
          }
        })
        .catch((error) => {
          error = error.response;
          this.loading = false;
          if (error.status == 422) {
            this.error = error.data.errors.email[0];
          }
        });
    },
  },
};
</script>
