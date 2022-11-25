<template>
  <div class="overflow-y-hidden">
    <div
      class="flex flex-col items-center justify-center bg-gradient-to-b from-white to-slate-50 px-4 pt-24">
      <div class="flex justify-between">
        <div class="relative hidden md:block">
          <div class="-mt-14 flex flex-col space-y-14">
            <span
              v-for="(avatar, index) in avatars.slice(4, 6)"
              :key="avatar.id"
              class="relative inline-block odd:translate-x-14">
              <div
                class="rounded-full border-2 border-dashed p-1"
                :class="[
                  { 'border-social-instagram': avatar.network === 'instagram' },
                  { 'border-social-twitter': avatar.network === 'twitter' },
                  {
                    'bg-gradient border-gradient border-social-tiktok2 ':
                      avatar.network === 'tiktok',
                  },
                  { 'border-social-twitch': avatar.network === 'twitch' },

                  { 'border-social-linkedin': avatar.network === 'linkedin' },
                  { 'border-social-youtube': avatar.network === 'youtube' },
                ]">
                <img
                  class="aspect-square h-10 w-10 rounded-full lg:h-14 lg:w-14 2xl:h-20 2xl:w-20"
                  :src="avatar.src"
                  alt="" />
              </div>

              <span
                :class="`ring-slate-50`"
                class="absolute bottom-0 right-0 block h-3.5 w-3.5 items-center rounded-full bg-white ring-2"
                ><div class="mt-0.5 items-center">
                  <SocialIcons
                    cla
                    :height="12"
                    link="/signup"
                    :icon="avatar.network"
                    :color="black" /></div
              ></span>
            </span>
          </div>
        </div>

        <div class="z-10 flex flex-col text-center">
          <div class="mb-4 flex justify-center rounded-full">
            <div
              class="relative overflow-hidden rounded-full border border-indigo-100 bg-indigo-100 py-1 px-8 text-xs leading-6">
              <h1
                class="items-center rounded-md text-lg font-medium text-indigo-600">
                👋🏻 Meet Jovie: <span class="font-light">The Social CRM</span>
              </h1>
            </div>
          </div>

          <h2
            class="text-3xl font-semibold tracking-normal text-slate-800 sm:text-5xl lg:text-3xl xl:text-7xl">
            Organize everyone<br class="hidden xl:block" />
            you follow
            <br />
          </h2>
          <!-- <h2
            class="inline py-2 text-center text-xs font-bold text-slate-500 sm:text-xl">
            A
            <span class="dexoration-2 font-bold underline decoration-pink-400"
              >smarter</span
            >
            way to organize everyone you follow<br />
          </h2>
 -->
          <ButtonGroup
            @click="signup()"
            :loading="loading"
            :loader="loading"
            class="mx-auto mt-8 w-full sm:w-48"
            text="Try Jovie free" />
          <div
            class="mx-auto mt-2 flex items-center justify-between rounded-full bg-gradient-to-r from-slate-100 to-slate-400/0 py-1 px-2 text-center">
            <CreditCardIcon class="mr-2 h-4 w-4 text-slate-700" />
            <span class="text-light text-2xs text-slate-700">
              <!--  <span class="font-bold">Fast & easy. </span> -->
              No credit card required.
            </span>
          </div>

          <!--  <home-logo-cloud /> -->
          <div class="mt-24 -mb-36 block max-w-7xl sm:-mb-48 lg:-mb-96">
            <img
              alt="Jovie - Social CRM Screenshot"
              class="rounded-lg shadow-xl shadow-indigo-700/30 ring-8 ring-black ring-opacity-5"
              :src="asset('img/External/HomeFeatureCRM.webp')" />
          </div>
        </div>
        <div class="relative hidden md:block">
          <div class="-mt-12 flex flex-col space-y-24">
            <span
              v-for="(avatar, index) in avatars.slice(0, 3)"
              :key="avatar.id"
              class="relative inline-block odd:-translate-x-20">
              <div
                class="rounded-full border-2 border-dashed p-1"
                :class="[
                  { 'border-social-instagram': avatar.network === 'instagram' },
                  { 'border-social-twitter': avatar.network === 'twitter' },

                  { 'border-social-twitch': avatar.network === 'twitch' },

                  {
                    'bg-gradient border-gradient border-social-tiktok2 ':
                      avatar.network === 'tiktok',
                  },

                  { 'border-social-linkedin': avatar.network === 'linkedin' },
                  { 'border-social-youtube': avatar.network === 'youtube' },
                ]">
                <img class="h-16 w-16 rounded-full" :src="avatar.src" alt="" />
              </div>
              <span
                :class="`ring-slate-50`"
                class="absolute bottom-0 right-0 mx-auto block h-6 w-6 items-center rounded-full bg-white ring-2"
                ><div class="mx-auto mt-1 items-center">
                  <SocialIcons
                    :height="14"
                    link="/signup"
                    :icon="avatar.network"
                    :color="black" /></div
              ></span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ButtonGroup from '../../components/ButtonGroup.vue';
import HomeLogoCloud from './HomeLogoCloud.vue';
import SocialIcons from '../../components/SocialIcons.vue';
import { CreditCardIcon } from '@heroicons/vue/24/solid';
export default {
  components: {
    ButtonGroup,
    HomeLogoCloud,
    SocialIcons,
    CreditCardIcon,
  },
  data() {
    return {
      avatars: [
        {
          id: 1,
          src: 'https://i.pravatar.cc/150?u=a042581f4e29026704d',
          network: 'instagram',
          handle: 'jessica',
        },
        {
          id: 2,
          src: 'https://i.pravatar.cc/150?u=a042581f4e290267035',
          network: 'twitter',
          handle: 'loren',
        },
        {
          id: 3,
          src: 'https://i.pravatar.cc/150?u=a042581f4e29w267036',
          network: 'twitch',
          handle: 'alexa',
        },
        {
          id: 4,
          src: 'https://i.pravatar.cc/150?u=a042581f4e290267067',
          network: 'youtube',
          handle: 'candice',
        },
        {
          id: 5,
          src: 'https://i.pravatar.cc/150?u=a042581f4e290267038',
          network: 'tiktok',
          handle: 'taylor',
        },
        {
          id: 6,
          src: 'https://i.pravatar.cc/150?u=a042581f4e290267039',
          network: 'linkedin',
          handle: 'lily',
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
