<template>
  <div>
    <main>
      <div class="min-h-screen">
        <div
          class="flex w-full flex-col-reverse items-center justify-center pt-12 sm:py-12 md:flex-col md:py-40">
          <img
            :src="asset('img/External/bgImg.webp')"
            class="mt-6 hidden w-full object-fill object-center md:mt-0 xl:block"
            alt="background image" />
          <img
            :src="asset('img/External/tabley.webp')"
            class="mt-6 w-full object-fill object-center md:mt-0 xl:hidden"
            alt="background image" />
          <div class="absolute flex flex-col items-center justify-center px-4">
            <h1
              class="text-center text-4xl font-extrabold tracking-tight text-gray-900 sm:text-3xl md:text-5xl xl:text-6xl">
              <span class="inline">Scale your</span>
              {{ ' ' }}
              <span class="inline text-indigo-700">creator</span>
              <vue-typed-js
                :strings="['Creator', 'Biz Dev', 'Investor', 'Founder']">
                <h1 class="typing"></h1>
              </vue-typed-js>
              <!--make a span that rotates through the words "creator", "founder", "Biz Dev", "Investor"-->
              {{ ' ' }}

              <span class="inline"> relationships</span>
            </h1>
            <p
              class="mx-auto mt-8 max-w-md text-center text-base text-gray-500 sm:mt-3 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">
              <span class="font-bold">Jovie is the </span>
              {{ ' ' }}
              <span class="font-bold text-indigo-600">CRM</span>
              {{ ' ' }}
              <span class="font-bold">you'll actually</span>
              {{ ' ' }}
              <span
                class="font-bold underline decoration-social-instagram decoration-4"
                >want to use</span
              >.
            </p>
            <div class="mx-auto mt-8 flex max-w-md justify-center md:mt-5">
              <div class="rounded-md">
                <div class="mt-8 h-20 sm:w-full sm:max-w-md xl:mt-0 xl:ml-8">
                  <div class="sm:flex">
                    <label for="email-address" class="sr-only"
                      >Email address</label
                    >
                    <input
                      v-on:keyup.enter="requestDemo() && identifyUser()"
                      id="email-address"
                      v-model="waitListEmail"
                      name="email-address"
                      type="email"
                      autocomplete="off"
                      required=""
                      class="focus:ring-none focus:ring-none w-full rounded-md border-indigo-700/30 px-5 py-3 placeholder-gray-500 shadow-xl shadow-indigo-700/20 focus:border-none focus:outline-none focus-visible:outline-none"
                      placeholder="Enter your email" />

                    <ButtonGroup
                      type="button"
                      :loader="loading"
                      as="router-link"
                      @click="requestDemo() && identifyUser()"
                      text="Get started free"
                      design="hero">
                      Get started free
                    </ButtonGroup>
                  </div>
                  <span
                    class="float-left px-2 text-xs font-bold text-red-500"
                    >{{ this.error }}</span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--  <HomeLogoCloud></HomeLogoCloud> -->
      </div>
      <HomeFeatureCRM id="crm"></HomeFeatureCRM>
      <!--  <HomeCreatorSearch id="discovery"></HomeCreatorSearch> -->

      <!--  <HomeFeatureHero></HomeFeatureHero> -->
      <Enrichment></Enrichment>
      <!--  <HomeFeatureSequences></HomeFeatureSequences> -->
      <!--  <HomeCTA></HomeCTA>
      <JovieReplaces></JovieReplaces>
      <HomeTestimonials></HomeTestimonials> -->
      <HomeCTA2></HomeCTA2>
    </main>
  </div>
</template>

<style></style>
<script>
import {
  InboxIcon,
  PencilAltIcon,
  TrashIcon,
  UsersIcon,
} from '@heroicons/vue/outline';
import JovieReplaces from '../components/External/JovieReplaces.vue';
import UserService from '../services/api/user.service';
import HomeLogoCloud from '../components/Home/HomeLogoCloud';
import HomeFeatureSequences from '../components/Home/HomeFeatureSequences';
import HomeFeatureDiscovery from '../components/Home/HomeFeatureDiscovery';
import HomeHeroSection from '../components/Home/HomeHeroSection';
import HomeCTA from '../components/Home/HomeCTA';
import HomeTestimonials from '../components/Home/HomeTestimonials';
import HomeCTA2 from '../components/Home/HomeCTA2';
import HomeFeatureCRM from '../components/Home/HomeFeatureCRM';
import HomeCreatorSearch from '../components/Home/HomeCreatorSearch';
import Enrichment from '../components/Enrichment.vue';

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
    HomeCTA2,
    HomeFeatureCRM,
    JovieReplaces,
  },
  data() {
    return {
      waitListEmail: '',
      error: null,
      loading: false,
      features: [
        {
          name: 'Discover creators by the products they use',
          description:
            'Jovie can see if a creator is wearing glass, holding an iPhone, or riding a skateboard. ',
          icon: InboxIcon,
        },
        {
          name: 'Identify Brands within content',
          description:
            'Search for Starbucks logos in Tiktok videos, or people wearing Prada on Instagram.',
          icon: UsersIcon,
        },
        {
          name: 'Brand Saftey',
          description:
            'Jovie can identify & restrict creators who post content that may not be suitable for your brand. ',
          icon: TrashIcon,
        },
        {
          name: 'Exclusion',
          description:
            'Jovie can check to make creators you partner with have never promoted a competing product.',
          icon: PencilAltIcon,
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
