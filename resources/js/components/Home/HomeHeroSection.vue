<template>
  <body class="overflow-y-hidden">
    <div
      class="flex h-full w-full flex-col-reverse items-center justify-center py-48 md:flex-col">
      <img
        :src="asset('img/External/bgImg.webp')"
        class="mt-6 hidden w-full object-fill object-center md:mt-0 xl:block"
        alt="background image" />
      <img
        :src="asset('img/External/tabley.webp')"
        class="mt-6 w-full object-fill object-center md:mt-0 xl:hidden"
        alt="background image" />
      <div
        class="absolute mt-96 flex flex-col items-center justify-center py-48 px-4 2xl:py-24">
        <h2
          class="bg-gradient-to-r from-sky-500 via-blue-500 to-fuchsia-500 bg-clip-text text-xs font-semibold uppercase tracking-wide text-transparent">
          The easiest way to
        </h2>
        <h1
          class="text-3xl font-extrabold tracking-tight text-gray-900 md:text-5xl xl:text-6xl">
          Organize <span class="text-indigo-700">Everyone</span> You Follow.
          <br />
        </h1>
        <h2 class="inline py-2 text-center text-lg font-bold text-neutral-600">
          One place for you & your teams to track everyone you know<br />
          <span class="text-sm font-medium"
            >(and everyone you wish you did).</span
          >
        </h2>
        <ButtonGroup
          :loader="loading"
          as="router-link"
          to="/signup"
          @click="identifyUser()"
          class="mt-4 w-full sm:w-64"
          text="Get Started Free" />
        <span class="mt-2 text-xs text-gray-500">
          <span class="font-bold">No credit card required. </span> Fast & easy.
        </span>
        <home-logo-cloud />
        <div class="mt-12 max-w-7xl sm:-mb-14 lg:-mb-24 2xl:-mb-96">
          <img
            class="rounded-lg shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
            :src="asset('img/External/HomeFeatureCRM.webp')" />
        </div>
      </div>
    </div>
  </body>
</template>
<script>
import ButtonGroup from '../../components/ButtonGroup.vue';
import HomeLogoCloud from './HomeLogoCloud.vue';
export default {
  components: {
    ButtonGroup,
    HomeLogoCloud,
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
