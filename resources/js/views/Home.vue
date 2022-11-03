<template>
  <div>
    <main>
      <HomeHeroSection />

      <!--  <section>
        <div class="mx-auto my-11 px-4 md:px-8">
          <div class="rounded-3xl bg-gray-50 p-4 md:p-10 lg:p-14">
            <p
              class="mb-8 max-w-3xl text-2xl text-gray-900 md:mb-12 md:text-2xl lg:text-3xl">
              Instantly import contacts from social media.
            </p>
            <div class="flex h-14 flex-wrap justify-between">
              <div v-for="icon in icons" :key="icon.id">
                <div class="relative hidden h-16 w-16 overflow-hidden lg:block">
                  <div
                    class="relative z-20 mx-auto h-full items-center p-2 text-white">
                    <SocialIcons
                      class="z-20 h-14 w-14"
                      color="white"
                      link="#"
                      :icon="icon.name"
                      height="16px" />
                  </div>
                  <svg viewBox="0 0 64 64" class="absolute top-0 h-full w-full">
                    <circle
                      cx="32"
                      cy="32"
                      r="32"
                      :fill="icon.fillColor"></circle>
                  </svg>
                </div>
              </div>
            </div>
            <a
              class="active:outline-3 text-md hover:border-coral-500 hover:text-coral-500 group mt-12 box-border inline-flex h-10 cursor-pointer items-center justify-center whitespace-nowrap rounded-full border border-solid border-gray-800 px-4 font-sans font-medium text-black outline-offset-2 transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-blue-700 active:bg-white active:bg-opacity-5 disabled:cursor-not-allowed disabled:border-gray-700 disabled:bg-transparent disabled:text-gray-700 md:h-12 md:text-lg"
              href="/signup"
              ><span class="-mt-[0.1em]">Try Jovie free</span
              ><svg
                class="ml-2 mt-[0.1em] block h-3 w-3 fill-transparent stroke-current"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 10 10">
                <path
                  d="M4.83337 8.5L8.58337 4.75L4.83337 1"
                  class="-translate-x-[2px] transform-gpu transition-transform group-hover:translate-x-0 group-disabled:-translate-x-[2px]"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <line
                  class="opacity-0 transition-opacity group-hover:opacity-100 group-disabled:opacity-0"
                  x1="1"
                  y1="4.75"
                  x2="8.58337"
                  y2="4.75"
                  stroke-width="1.5"
                  stroke-linecap="round"></line>
              </svg>
            </a>
          </div>
        </div>
      </section> -->
      <HomeFeatureCRM :features="features" class="" id="crm"></HomeFeatureCRM>
      <div class="relative bg-gray-50">
        <div
          class="bg-gray-50 pt-10 sm:pt-16 lg:overflow-hidden lg:pt-8 lg:pb-14">
          <div class="mx-auto max-w-7xl lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8">
              <div
                class="mx-auto max-w-md px-4 sm:max-w-7xl sm:px-6 sm:text-center lg:flex lg:items-center lg:px-0 lg:text-left">
                <div class="lg:py-24">
                  <h1
                    class="text-4xl font-extrabold tracking-tight text-neutral-600 sm:mt-2 sm:text-6xl lg:mt-3 xl:text-2xl">
                    Bridge the gap between social networks
                  </h1>
                  <p
                    class="mt-3 text-base text-gray-600 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                    Save a contact on instagram? Don’t worry, we have their
                    twitter profile too. No more fragmented networks. Jovie
                    automatically enriches contacts with all their social media
                    profiles
                  </p>
                </div>
              </div>
              <div class="mt-12 -mb-16 sm:-mb-48 lg:m-0">
                <img
                  class="w-full object-fill lg:absolute lg:inset-y-0 lg:right-0 lg:h-full lg:w-auto lg:max-w-none"
                  :src="asset('img/External/jovie_social_data_enrichment.png')"
                  alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--  <HomeFeatureHero></HomeFeatureHero> -->
      <!--  <HomeFeatureSequences></HomeFeatureSequences> -->
      <JovieReplaces class="py-12"></JovieReplaces>
      <!--  <HomeCTA></HomeCTA> -->
      <section
        class="mx-auto bg-gradient-radial from-white via-white to-blue-600/10">
        <div class="mx-auto max-w-7xl py-48">
          <div class="text-center text-3xl font-bold text-neutral-700">
            Add the Jovie Chrome Extension today.
          </div>
          <div class="text-center text-xl font-semibold text-neutral-500">
            Save, enrich, & organize contacts from any social media profile.
          </div>
          <router-link
            to="/chrome-extension"
            class="group mx-auto mt-8 flex w-80 cursor-pointer justify-between rounded-full border border-neutral-400 bg-gradient-to-r from-[#7928ca] to-[#ff0080] p-0.5 text-center shadow-xl shadow-pink-500/20 hover:shadow-pink-500/30">
            <div
              class="flex w-full justify-between rounded-full bg-neutral-800 py-2 px-4">
              <div class="text-white">
                <svg
                  role="img"
                  class="h-8 w-8 transform transition-transform duration-300 ease-in-out group-hover:rotate-180"
                  fill="white"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <title>Google Chrome</title>
                  <path
                    d="M12 0C8.21 0 4.831 1.757 2.632 4.501l3.953 6.848A5.454 5.454 0 0 1 12 6.545h10.691A12 12 0 0 0 12 0zM1.931 5.47A11.943 11.943 0 0 0 0 12c0 6.012 4.42 10.991 10.189 11.864l3.953-6.847a5.45 5.45 0 0 1-6.865-2.29zm13.342 2.166a5.446 5.446 0 0 1 1.45 7.09l.002.001h-.002l-5.344 9.257c.206.01.413.016.621.016 6.627 0 12-5.373 12-12 0-1.54-.29-3.011-.818-4.364zM12 16.364a4.364 4.364 0 1 1 0-8.728 4.364 4.364 0 0 1 0 8.728Z" />
                </svg>
              </div>
              <div
                class="mx-auto mt-0.5 w-full transform text-center font-medium text-white transition-transform duration-300 ease-in-out group-hover:underline">
                Add to Chrome
              </div>
            </div>
          </router-link>
        </div>
      </section>

      <HomeCTA4></HomeCTA4>

      <!--   <HomeTestimonials></HomeTestimonials> -->
    </main>
  </div>
</template>

<style></style>
<script>
import {
  InboxIcon,
  PencilIcon,
  TrashIcon,
  UsersIcon,
} from '@heroicons/vue/24/outline';
import JovieReplaces from '../components/External/JovieReplaces.vue';
import UserService from '../services/api/user.service';
import HomeLogoCloud from '../components/Home/HomeLogoCloud';
import HomeFeatureSequences from '../components/Home/HomeFeatureSequences';
import HomeFeatureDiscovery from '../components/Home/HomeFeatureDiscovery';
import HomeHeroSection from '../components/Home/HomeHeroSection';
import HomeCTA from '../components/Home/HomeCTA';
import HomeTestimonials from '../components/Home/HomeTestimonials';
import HomeCTA4 from '../components/Home/HomeCTA4';
import HomeFeatureCRM from '../components/Home/HomeFeatureCRM';
import HomeCreatorSearch from '../components/Home/HomeCreatorSearch';
import Enrichment from '../components/Enrichment.vue';
import SocialIcons from '../components/SocialIcons.vue';

import CallToAction from '../components/CallToAction';

import ButtonGroup from '@/components/ButtonGroup';
export default {
  name: 'Home',
  components: {
    HomeLogoCloud,
    HomeFeatureSequences,
    HomeCreatorSearch,
    HomeFeatureDiscovery,
    Enrichment,
    HomeHeroSection,
    HomeCTA,
    ButtonGroup,
    HomeTestimonials,
    CallToAction,
    HomeCTA4,
    HomeFeatureCRM,
    JovieReplaces,
    SocialIcons,
  },
  data() {
    return {
      waitListEmail: '',
      error: null,
      loading: false,
      icons: [
        {
          id: 1,
          name: 'twitter',
          fillColor: '#1DA1F2',
        },
        {
          id: 2,
          name: 'twitch',
          fillColor: '#9146FF',
        },
        {
          id: 3,
          name: 'youtube',
          fillColor: '#FF0000',
        },
        {
          id: 4,
          name: 'instagram',
          fillColor: '#E1306C',
        },
        {
          id: 5,
          name: 'tiktok',
          fillColor: '#000000',
        },
      ],
      features: [
        {
          id: 1,
          header: 'Import social media profiles in 1-click',
          subheader:
            ' Never type contact info again.  Jovie let’s you import any Tiktok, Twitter, Instagram, or Twitch profile instantly.',
          cta: 'Download the Chrome Extension',
          ctaLink: 'signup',
          img: 'img/External/Marketing/Chrome/Jovie_Chrome_Extension_Screenshot.png',
        },
        {
          id: 2,
          header: 'Get organized.',
          subheader:
            'Jovie works like the tools you love, letting you create lists and drag-n-drop contacts right into them. Leave notes for yourself or comments to share with your team.',
          img: 'img/External/Marketing/Chrome/Jovie_Lists_Screenshot.png',
        },
      ],
    };
  },
  mounted() {
    window.analytics.page('Home');
  },
  methods: {
    login() {
      // login();
    },
    logout() {
      // logout();
    },
    async identifyUser() {
      //segment identify call
      window.analytics.identify({
        email: this.waitListEmail,
      });
      //segment track call
      window.analytics.track('Initated Sign Up');
    },
    async requestDemo() {
      this.loading = true;

      await UserService.addToWaitList({
        email: this.waitListEmail,
        page: 'Home',
      })
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$store.commit('setAddedToWaitList');
            this.waitListEmail = '';
            this.error = null;
            this.$router.push('signup');
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
