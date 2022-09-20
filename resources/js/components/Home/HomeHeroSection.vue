<template>
  <div class="overflow-y-hidden">
    <!-- <img
        :src="asset('img/External/bgImg.webp')"
        class="mt-6 hidden w-full object-fill object-center md:mt-0 xl:block"
        alt="background image" />
      <img
        :src="asset('img/External/tabley.webp')"
        class="mt-6 w-full object-fill object-center md:mt-0 xl:hidden"
        alt="background image" /> -->
    <!--  <div class="mt-12 block max-w-xl to-white sm:hidden">
      <img
        class="rounded-lg shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
        :src="asset('img/External/HomeFeatureCRM.webp')" />
    </div> -->
    <div
      class="flex flex-col items-center justify-center bg-white px-4 py-24 sm:mt-12 sm:pt-48 2xl:pt-48">
      <!-- <h2
          class="bg-gradient-to-r from-sky-500 via-blue-500 to-fuchsia-500 bg-clip-text text-xs font-semibold uppercase tracking-wide text-transparent">
          The easiest way to
        </h2> -->

      <h1
        class="text-xl font-extrabold tracking-tight text-gray-900 md:text-5xl xl:text-6xl">
        Organize <span class="text-indigo-700">Everyone</span> You Follow.
        <br />
      </h1>
      <h2 class="inline py-2 text-center text-lg font-bold text-neutral-600">
        One space for the people that matter to
        <span class="text-sky-600">you</span> &
        <span class="text-pink-600">your team</span> <br />
      </h2>
      <ButtonGroup
        @click="signup()"
        :loading="loading"
        :loader="loading"
        class="mt-4 w-full sm:w-64"
        text="Try Jovie free" />
      <span class="mt-1 text-2xs text-gray-400">
        <span class="font-bold">Fast & easy. </span> No credit card required.
      </span>

      <!-- <home-logo-cloud /> -->
      <div class="mt-24 hidden max-w-7xl sm:-mb-48 sm:block lg:-mb-96">
        <img
          class="rounded-lg shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
          :src="asset('img/External/HomeFeatureCRM.webp')" />
      </div>
    </div>
  </div>
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
      loading: false,
    };
  },
  methods: {
    signup() {
      this.loading = true;
      this.$router.push('/signup');
      this.loading = false;
    },
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
