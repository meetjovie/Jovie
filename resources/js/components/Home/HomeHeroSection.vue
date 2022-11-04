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
      <div class="flex justify-between">
        <!-- <div class="relative">
          <div class="-mt-24 flex flex-col space-y-24">
            <span
              v-for="avatar in avatars"
              :key="avatar.id"
              class="relative inline-block odd:translate-x-24">
              <img
                class="aspect-square h-14 w-14 rounded-full"
                :src="avatar.src"
                alt="" />

              <span
                :class="`ring-neutral-50`"
                class="absolute bottom-0 right-0 block h-3.5 w-3.5 items-center rounded-full bg-white ring-2"
                ><div class="mt-0.5 items-center">
                  <SocialIcons
                    cla
                    :height="8"
                    link="#"
                    :icon="avatar.network"
                    :color="black" /></div
              ></span>
            </span>
          </div>
        </div> -->
        <div class="z-10 flex flex-col text-center">
          <h1
            class="text-xs font-semibold uppercase tracking-wide text-sky-500 text-transparent sm:text-2xl">
            Meet Jovie
          </h1>

          <h2
            class="text-xl font-extrabold tracking-normal text-neutral-800 sm:text-5xl lg:text-7xl xl:text-8xl">
            THE <span class="uppercase">Social</span> CRM
            <br />
          </h2>
          <h2
            class="inline py-2 text-center text-xs font-bold text-neutral-500 sm:text-xl">
            A
            <span class="dexoration-2 font-bold underline decoration-pink-400"
              >smarter</span
            >
            way to organize everyone you follow<br />
          </h2>

          <ButtonGroup
            @click="signup()"
            :loading="loading"
            :loader="loading"
            class="mx-auto mt-8 w-full sm:w-48"
            text="Try Jovie free" />
          <span class="mt-1 text-2xs text-gray-400">
            <!--  <span class="font-bold">Fast & easy. </span> -->
            No credit card required.
          </span>

          <!--  <home-logo-cloud /> -->
          <div class="mt-24 hidden max-w-7xl sm:-mb-48 sm:block lg:-mb-96">
            <img
              class="rounded-lg shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
              :src="asset('img/External/HomeFeatureCRM.webp')" />
          </div>
        </div>
        <!-- <div class="relative">
          <div class="-mt-12 flex flex-col space-y-24">
            <span
              v-for="avatar in avatars"
              :key="avatar.id"
              class="relative inline-block odd:-translate-x-24">
              <img class="h-14 w-14 rounded-full" :src="avatar.src" alt="" />
              <span
                :class="`ring-neutral-50`"
                class="absolute bottom-0 right-0 block h-3.5 w-3.5 items-center rounded-full bg-white ring-2"
                ><div class="mt-0.5 items-center">
                  <SocialIcons
                    cla
                    :height="8"
                    link="#"
                    :icon="avatar.network"
                    :color="black" /></div
              ></span>
            </span>
          </div>
        </div> -->
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
      avatars: [
        {
          id: 1,
          src: 'https://i.pravatar.cc/150?u=a042581f4e29026704d',
          network: 'instagram',
        },
        {
          id: 2,
          src: 'https://i.pravatar.cc/150?u=a042581f4e290267035',
          network: 'twitter',
        },
        {
          id: 3,
          src: 'https://i.pravatar.cc/150?u=a042581f4e29w267036',
          network: 'twitch',
        },
      ],
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
