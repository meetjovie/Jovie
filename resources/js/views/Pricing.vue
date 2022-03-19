<template>
  <div class="min-h-screen">
    <div class="flex min-h-full">
      <div class="relative hidden w-0 flex-1 lg:block">
        <div
          class="absolute inset-0 min-h-screen w-full items-center justify-center bg-indigo-700 px-8 py-12">
          <div
            class="shadown-sm flex items-center justify-center rounded-md px-8 py-2">
            <div
              class="mx-auto max-w-4xl px-4 py-16 pb-24 sm:px-6 sm:pt-20 lg:max-w-7xl lg:px-8 lg:pt-24">
              <h2 class="text-3xl font-extrabold tracking-tight text-white">
                Scale your
                <span class="underline decoration-pink-500"
                  >creator partnerships</span
                >
              </h2>
              <p class="mt-4 max-w-3xl text-lg text-indigo-200">
                Jovie gives you the tools to build, manage, & grow creator
                communities at scale
              </p>

              <div>
                <div class="mt-8 items-center">
                  <div
                    class="font-xs flex-inline px-6 py-4 text-indigo-100 xl:px-12">
                    <CheckIcon class="h5 mr-4 inline w-5" />Discover creators
                    with AI powered search tools
                  </div>
                  <div
                    class="font-xs flex-inline px-6 py-4 text-indigo-100 xl:px-12">
                    <CheckIcon class="h5 mr-4 inline w-5" />Manage your
                    relationships with a CRM built for the creator economy
                  </div>
                  <div
                    class="font-xs flex-inline px-6 py-4 text-indigo-100 xl:px-12">
                    <CheckIcon class="h5 mr-4 inline w-5" />Automate & track
                    your entire pipeline
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="flex min-h-screen flex-1 flex-col items-center justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm sm:pb-40 lg:w-96">
          <div>
            <JovieLogo :height="40" />
            <div class="mt-8 text-center">
              <h2
                class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                Request pricing
              </h2>
              <p class="mt-4 text-sm leading-6 text-gray-500">
                There are many factors that influence pricing. We just need a
                few details about your use case and we can get you pricing
                details that fit your exact needs.
              </p>
            </div>
          </div>

          <div class="mt-8">
            <div class="mt-6">
              <form class="space-y-6">
                <div>
                  <label
                    for="email"
                    class="block text-sm font-medium text-gray-700">
                    Email address
                  </label>
                  <div class="mt-1">
                    <input
                      v-if="!$store.state.addedToWaitList"
                      v-model="waitListEmail"
                      id="email"
                      name="email"
                      type="email"
                      autocomplete="email"
                      required=""
                      class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm" />
                    <!-- <input  id="email-address"
                                                    
                                            <button  type="button"
                                                    class="mt-3  hover:shadow-sm w-full flex items-center justify-center px-5 py-3 border border-transparent shadow-xl shadow-indigo-700/30 text-base font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-700 focus-visible:ring-white sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0">
                                                Added to waitlist
                                            </button>
                                            <button v-else type="button" @click="requestDemo()"
                                                    class="mt-3  hover:shadow-sm w-full flex items-center justify-center px-5 py-3 border border-transparent shadow-xl shadow-indigo-700/30 text-base font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-700 focus-visible:ring-white sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0">
                                                Request Access
                                            </button> -->
                  </div>
                </div>

                <div>
                  <button
                    v-if="$store.state.addedToWaitList"
                    type="submit"
                    class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                    Request submitted
                  </button>
                  <button
                    v-else
                    type="submit"
                    @click="requestDemo()"
                    class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                    Request pricing
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import JovieLogo from '../components/JovieLogo.vue';
import { CheckIcon } from '@heroicons/vue/outline';
import UserService from '../services/api/user.service';

export default {
  components: {
    JovieLogo,
    CheckIcon,
  },
  data() {
    return {
      waitListEmail: '',
      error: null,
    };
  },
  methods: {
    async requestDemo() {
      await UserService.addToWaitList({ email: this.waitListEmail })
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$store.commit('setAddedToWaitList');
            this.waitListEmail = '';
            this.error = null;
            this.$router.push('demo');
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.error = error.data.errors.email[0];
          }
        });
    },
  },
};
</script>
