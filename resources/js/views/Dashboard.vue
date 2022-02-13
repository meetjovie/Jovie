<template>
  <div>
    <div class="bg-white shadow">
      <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8">
        <div
          class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
          <div class="min-w-0 flex-1">
            <!-- Profile -->
            <div class="flex items-center">
              <img
                class="hidden h-16 w-16 rounded-full sm:block"
                src=""
                alt="" />
              <div>
                <div class="flex items-center">
                  <img class="h-16 w-16 rounded-full sm:hidden" src="" alt="" />
                  <h1
                    class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:leading-9">
                    Welcome user
                  </h1>
                </div>
                <dl
                  class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                  <dt class="sr-only">Company</dt>
                  <dd
                    class="flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6">
                    <!-- Heroicon name: solid/office-building -->
                    <svg
                      class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true">
                      <path
                        fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                        clip-rule="evenodd" />
                    </svg>
                    A7X3
                  </dd>
                  <dt class="sr-only">Account status</dt>
                  <dd
                    v-if="user.is_admin"
                    class="mt-3 flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6 sm:mt-0">
                    <!-- Heroicon name: solid/check-circle -->

                    <svg
                      class="mr-1.5 h-5 w-5 flex-shrink-0 text-indigo-400"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true">
                      <path
                        fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                    </svg>
                    Admin account
                  </dd>
                </dl>
              </div>
            </div>
          </div>
          <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            <a href="/discovery">
              <button
                type="button"
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">
                Find creators
              </button></a
            >
          </div>
        </div>
      </div>
    </div>
    <div>
      <!-- This example requires Tailwind CSS v2.0+ -->
      <div
        class="items-centeritems-middle mx-auto mt-8 max-w-5xl bg-white px-8 shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Discovery</h3>
          <div class="mt-2 max-w-xl text-sm text-gray-500">
            <p>
              Campaigns start with discovery. Find the creators that fit your
              campaign by searching our database. You can filter down results
              and favorite the best ones for later.
            </p>
          </div>
          <div class="mt-3 text-sm">
            <a
              href="/discovery"
              class="font-medium text-indigo-600 hover:text-indigo-500">
              Create a search <span aria-hidden="true">&rarr;</span></a
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Dashboard',
  data() {
    return {
      user: this.$store.state.AuthState.user,
    };
  },
  mounted() {},
};
</script>

<style scoped></style>
