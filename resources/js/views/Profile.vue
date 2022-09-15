<template>
  <div
    v-if="user"
    class="items-top flex max-h-screen min-h-screen justify-center overflow-hidden bg-gray-50 px-4 sm:items-center sm:px-6 lg:px-8">
    <div class="mt-8 max-w-md items-center space-y-8 pt-8 sm:mt-0">
      <router-link
        v-if="user.username == currentUser.username"
        to="/Account"
        class="absolute top-0 right-0 cursor-pointer py-2 px-4 text-xs font-bold text-indigo-400 hover:text-indigo-600">
        Edit profile
      </router-link>
      <div>
        <img
          class="block-inline mx-auto mt-0 aspect-square w-48 rounded-full object-cover object-center sm:w-64 2xl:w-80"
          :src="user.profile_pic_url"
          alt="" />
        <div class="mx-auto mt-6 flex 2xl:mt-12">
          <h2 class="mx-auto flex text-3xl font-extrabold text-gray-900">
            {{ user.first_name }} {{ user.last_name }}
            <svg
              v-if="user.is_verified"
              xmlns="http://www.w3.org/2000/svg"
              class="-mr-5 h-5 w-5 text-indigo-600"
              viewBox="0 0 20 20"
              fill="currentColor">
              <path
                fill-rule="evenodd"
                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
            </svg>
          </h2>
        </div>
        <p class="mt-2 text-center text-sm text-gray-600">
          {{ user.title }} {{ user.employer ? ' at ' : '' }}
          <a
            v-if="user.employer"
            :href="user.employer_link"
            class="font-medium text-indigo-600 hover:text-indigo-500">
            {{ user.employer }}
          </a>
        </p>
      </div>
      <div class="mt-2 2xl:mt-8" v-if="user.creator_profile">
        <fieldset class="mt-0 2xl:mt-2">
          <legend class="sr-only">Social links</legend>
          <div
            class="flex grid-cols-3 items-center justify-between gap-2 sm:grid-cols-6">
            <template v-for="network in networks" :key="network">
              <div
                v-if="
                  user[`show_${network}`] &&
                  user.creator_profile[`${network}_handler`]
                "
                class="group flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase opacity-50 hover:bg-gray-100 hover:opacity-100 focus-visible:outline-none sm:flex-1">
                <a
                  class
                  :href="user.creator_profile[`${network}_handler`]"
                  target="_blank">
                  <SocialIcons groupHover height="24px" :icon="network" />
                  <span class="sr-only">{{ network }}</span>
                </a>
              </div>
            </template>
          </div>
        </fieldset>
      </div>
      <!--    user.call_to_action -->
      <!--  v-if="user.call_to_action_text" -->
      <a href="#">
        <button
          @click="generateVCF(user)"
          class="mt-2 mb-0 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
          Save contact
        </button>
      </a>

      <div class="border-t-2 border-gray-400 opacity-20"></div>
      <router-link
        class="group mt-1 py-4 text-center text-sm text-gray-500"
        to="signup">
        <div class="mx-auto mt-4 flex items-center justify-center text-center">
          <JovieLogo
            iconColor="black"
            height="20px"
            class="opacity-20 group-hover:opacity-100" />
        </div>
        <div
          class="bottom-0 w-full cursor-pointer items-center pb-4 font-semibold text-gray-900 opacity-20 group-hover:opacity-50">
          Get your profile
        </div>
      </router-link>
    </div>
  </div>
</template>
<script>
import JovieLogo from '../components/JovieLogo.vue';
import ButtonGroup from '../components/ButtonGroup.vue';
import { EnvelopeOpenIcon } from '@heroicons/vue/24/solid';
import store from '../store';
import router from '../router';
import SocialIcons from '../components/SocialIcons';

export default {
  name: 'CreatorProfile',
  components: { JovieLogo, ButtonGroup, EnvelopeOpenIcon, SocialIcons },
  props: ['profile', 'socialNetworks'],
  data() {
    return {
      user: null,
      networks: [],
    };
  },
  methods: {
    generateVCF(user) {
      console.log(user);
      let vCard = 'BEGIN:VCARD\n';
      vCard += 'VERSION:3.0\n';
      //if creator has a first name
      if (user.first_name) {
        vCard += 'N:' + user.first_name + ' ' + user.last_name + '\n';
        vCard += 'FN:' + user.first_name + ' ' + user.last_name + '\n';
      } else {
        vCard += 'N:' + user.name + '\n';
        vCard += 'FN:' + user.name + '\n';
      }
      //if creator has a title
      if (user.title) {
        vCard += 'TITLE:' + user.title + '\n';
      }
      //if creator has a company
      if (user.employer) {
        vCard += 'ORG:' + user.employer + '\n';
      }
      //if creator has a phone number
      if (user.phone_number) {
        vCard += 'TEL;TYPE=WORK,VOICE:' + user.phone_number + '\n';
      }
      //if creator has a email
      if (user.email) {
        vCard += 'EMAIL;TYPE=PREF,INTERNET:' + user.email + '\n';
      }
      //if creator has a website
      if (user.website) {
        vCard += 'URL:' + user.website + '\n';
      }
      //if creator has a address
      if (user.address) {
        vCard += 'ADR;TYPE=WORK:;;' + user.address + ';;;\n';
      }
      //add a note Saved from Jovie
      vCard += 'NOTE:Saved from Jovie\n';
      //if creator has a twitter
      if (user.creator_profile.twitter_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=twitter:' +
          user.creator_profile.twitter_handler +
          '\n';
      }
      //if creator has a instagram
      if (user.creator_profile.instagram_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=instagram:' +
          user.creator_profile.instagram_handler +
          '\n';
      }
      //if creator has a facebook
      if (user.creator_profile.facebook_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=facebook:' +
          user.creator_profile.facebook_handler +
          '\n';
      }
      //if creator has a linkedin
      if (user.creator_profile.linkedin_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=linkedin:' +
          user.creator_profile.linkedin_handler +
          '\n';
      }
      //if creator has a youtube
      if (user.creator_profile.youtube_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=youtube:' +
          user.creator_profile.youtube_handler +
          '\n';
      }
      //if creator has a tiktok
      if (user.creator_profile.tiktok_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=tiktok:' +
          user.creator_profile.tiktok_handler +
          '\n';
      }
      //if creator has a twitch
      if (user.creator_profile.twitch_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=twitch:' +
          user.creator_profile.twitch_handler +
          '\n';
      }
      //if creator has a snapchat
      if (user.creator_profile.snapchat_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=snapchat:' +
          user.creator_profile.snapchat_handler +
          '\n';
      }
      console.log(vCard);
      vCard += 'END:VCARD';
      //download the vcard
      const element = document.createElement('a');
      element.setAttribute(
        'href',
        'data:text/plain;charset=utf-8,' + encodeURIComponent(vCard)
      );
      element.setAttribute('download', user.name + '.vcf');
      element.style.display = 'none';
      document.body.appendChild(element);
      element.click();
      document.body.removeChild(element);
    },
  },
  mounted() {
    //add segment analytics
    window.analytics.page(this.$route.path);
    if (!this.profile) {
      const username = this.$route.params.username;
      store
        .dispatch('getPublicProfile', { username: username })
        .then((response) => {
          if (response.status) {
            this.user = response.data;
            this.networks = response.networks;
          } else {
            router.push({ name: 'Home' });
          }
        })
        .catch((error) => {
          router.push({ name: 'Home' });
        });
    } else {
      this.user = this.profile;
      this.networks = this.socialNetworks ?? [];
    }
  },
};
</script>
