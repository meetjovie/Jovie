<template>
  <div
    class="relative overflow-hidden bg-gradient-to-r from-white to-indigo-50">
    <div
      class="hidden sm:absolute sm:inset-y-0 sm:block sm:h-full sm:w-full"
      aria-hidden="true">
      <div class="relative mx-auto h-full max-w-7xl">
        <svg
          class="absolute right-full translate-y-1/4 translate-x-1/4 transform lg:translate-x-1/2"
          width="404"
          height="784"
          fill="none"
          viewBox="0 0 404 784">
          <defs class="text-indigo-700">
            <pattern
              id="f210dbf6-a58d-4871-961e-36d5016a0f49"
              x="0"
              y="0"
              width="20"
              height="20"
              patternUnits="userSpaceOnUse">
              <rect
                x="0"
                y="0"
                width="4"
                height="4"
                class="text-gray-200 opacity-50"
                fill="currentColor" />
            </pattern>
          </defs>
          <rect
            width="404"
            height="784"
            fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)" />
        </svg>
        <svg
          class="absolute left-full -translate-y-3/4 -translate-x-1/4 transform md:-translate-y-1/2 lg:-translate-x-1/2"
          width="404"
          height="784"
          fill="none"
          viewBox="0 0 404 784">
          <defs>
            <pattern
              id="5d0dd344-b041-4d26-bec4-8d33ea57ec9b"
              x="0"
              y="0"
              width="20"
              height="20"
              patternUnits="userSpaceOnUse">
              <rect
                x="0"
                y="0"
                width="4"
                height="4"
                class="text-gray-200"
                fill="currentColor" />
            </pattern>
          </defs>
          <rect
            width="404"
            height="784"
            class
            fill="url(#5d0dd344-b041-4d26-bec4-8d33ea57ec9b)" />
        </svg>
      </div>
    </div>

    <div class="relative pt-12 pb-16 sm:pb-24">
      <main
        class="min-h-1/2 mx-auto mt-16 max-w-7xl py-8 px-4 sm:mt-24 lg:py-24">
        <div class="text-center">
          <h1
            class="text-3xl font-extrabold tracking-tight text-gray-900 md:text-5xl xl:text-6xl">
            <span class="inline">Scale your</span>
            {{ ' ' }}
            <span class="inline text-indigo-700">creator</span>

            {{ ' ' }}
            <span class="inline"> partnerships</span>
          </h1>
          <p
            class="mx-auto mt-3 max-w-md text-center text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">
            <span class="font-bold">Easily </span>
            {{ ' ' }}
            <span class="font-bold text-indigo-600">build</span>,
            <span class="font-bold text-indigo-600">manage</span>, &
            <span class="font-bold text-indigo-600">grow </span>
            <span class="font-bold underline decoration-pink-500 decoration-4"
              >creator communities</span
            >.
          </p>
          <div class="mx-auto mt-5 max-w-md sm:flex sm:justify-center md:mt-8">
            <div class="rounded-md">
              <div class="mt-8 sm:w-full sm:max-w-md xl:mt-0 xl:ml-8">
                <form class="sm:flex">
                  <label for="email-address" class="sr-only"
                    >Email address</label
                  >
                  <input
                    id="email-address"
                    v-model="waitListEmail"
                    name="email-address"
                    type="email"
                    autocomplete="email"
                    required=""
                    class="w-full rounded-md border-indigo-700/30 px-5 py-3 placeholder-gray-500 shadow-xl shadow-indigo-700/20 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-700"
                    placeholder="Enter your email" />
                  <router-link to="signup">
                    <button
                      type="button"
                      class="mt-3 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-500 px-5 py-3 text-base font-medium text-white shadow-xl shadow-indigo-700/30 hover:bg-indigo-800 hover:shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-700 sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0">
                      Get started
                    </button>
                  </router-link>
                </form>
                <span class="float-left text-red-900">{{ this.error }}</span>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>
<script>
export default {
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
