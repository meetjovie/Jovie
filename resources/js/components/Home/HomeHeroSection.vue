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
      class="flex flex-col items-center justify-center bg-gradient-to-b from-neutral-200 to-neutral-50 px-4 py-24 sm:pt-48 2xl:pt-48">
      <h1
        class="bg-gradient-to-r from-sky-500 via-blue-600 to-fuchsia-500 bg-clip-text text-2xl font-semibold uppercase tracking-wide text-transparent">
        Meet Jovie
      </h1>

      <h2
        class="text-7xl font-extrabold tracking-normal text-neutral-800 md:text-5xl xl:text-8xl">
        THE <span class="uppercase">Social</span> CRM
        <br />
      </h2>
      <h2 class="inline py-2 text-center text-xl font-bold text-neutral-500">
        A
        <span class="dexoration-2 font-bold underline decoration-pink-400"
          >smarter</span
        >
        way to organize everyone you follow<br />
      </h2>
      <div class="flex text-neutral-400">
        <span class="mx-auto items-center text-xs font-bold text-neutral-500"
          >Import contacts from:
        </span>

        <SocialIcons
          :color="black"
          :height="10"
          :width="10"
          :icon="instagram" />
        <SocialIcons :height="10" :width="10" :icon="twitter" />
        <SocialIcons :height="10" :width="10" :icon="twitch" />
        <SocialIcons :height="10" :width="10" :icon="tiktok" />
        <SocialIcons :height="10" :width="10" :icon="youtube" />
        <SocialIcons :height="10" :width="10" :icon="facebook" />
        <SocialIcons :height="10" :width="10" :icon="linkedin" />
      </div>
      <ButtonGroup
        @click="signup()"
        :loading="loading"
        :loader="loading"
        class="mt-8 w-full sm:w-48"
        text="Try Jovie free" />
      <span class="mt-1 text-2xs text-gray-400">
        <!--  <span class="font-bold">Fast & easy. </span> -->
        No credit card required.
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
import SocialIcons from '../../components/SocialIcons.vue';
export default {
  components: {
    ButtonGroup,
    HomeLogoCloud,
    SocialIcons,
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
