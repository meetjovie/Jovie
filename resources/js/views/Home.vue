<template>
  <div>
    <main>
      <HomeHeroSection />
      <!-- <HomeFeatureCRM :features="features" class="" id="crm"></HomeFeatureCRM> -->
      <!-- <div class="relative bg-gray-50">
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
      </div> -->

      <!--  <HomeCreatorSearch id="discovery"></HomeCreatorSearch> -->

      <!--  <HomeFeatureHero></HomeFeatureHero> -->

      <!--  <HomeFeatureSequences></HomeFeatureSequences> -->
      <!--  
      
      <HomeTestimonials></HomeTestimonials> -->
      <!--  <HomeCTA></HomeCTA> -->
      <JovieReplaces class="py-12"></JovieReplaces>
      <HomeCTA4></HomeCTA4>
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
  },
  data() {
    return {
      waitListEmail: '',
      error: null,
      loading: false,
      features: [
        {
          id: 1,
          header: 'Import social media profiles in 1-click',
          subheader:
            ' Never type contact info again.  Jovie let’s you import any Tiktok, Twitter, Instagram, or Twitch profile instantly.',
          cta: 'Download the Chrome Extension',
          ctaLink: 'signup',
          img: 'img/External/feature1.webp',
        },
        {
          id: 2,
          header: 'Get organized.',
          subheader:
            'Jovie works like the tools you love, letting you create lists and drag-n-drop contacts right into them. Leave notes for yourself or comments to share with your team.',
          img: 'img/External/jovie_social_data_enrichment.png',
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
