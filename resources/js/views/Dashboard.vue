<template>
  <div>
    <div class="bg-white shadow">
      <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8">
        <div
          class="py-6 md:flex md:items-center md:justify-between lg:border-gray-200">
          <div class="min-w-0 flex-1">
            <!-- Profile -->
            <div @click="thatYou()" class="flex items-center">
              <img
                class="hidden h-16 w-16 rounded-full sm:block"
                :src="
                  $store.state.AuthState.user.profile_pic_url ??
                  $store.state.AuthState.user.default_image
                "
                alt="" />
              <div>
                <div class="flex items-center">
                  <img class="h-16 w-16 rounded-full sm:hidden" src="" alt="" />
                  <h1
                    class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:leading-9">
                    Welcome {{ $store.state.AuthState.user.first_name }}!
                  </h1>
                </div>
                <dl
                  class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                  <dt class="sr-only">Team</dt>
                  <dd
                    class="flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6">
                    <!-- Heroicon name: solid/office-building -->
                    <svg
                      class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true">
                      <path
                        fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                        clip-rule="evenodd" />
                    </svg>
                    {{ currentUser.current_team.name }}
                  </dd>
                  <dt class="sr-only">Account status</dt>
                  <dd
                    v-if="user.is_admin"
                    class="mt-3 flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6 sm:mt-0">
                    <!-- Heroicon name: solid/check-circle -->

                    <svg
                      class="mr-1.5 h-5 w-5 flex-shrink-0 text-indigo-400"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true">
                      <path
                        fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                    </svg>
                    Admin account
                  </dd>
                  <dd
                    v-else-if="currentUser.isCurrentTeamOwner"
                    class="mt-3 flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6 sm:mt-0">
                    <!-- Heroicon name: solid/check-circle -->

                    <svg
                      class="mr-1.5 h-5 w-5 flex-shrink-0 text-neutral-400"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true">
                      <path
                        fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                    </svg>
                    Team Owner
                  </dd>
                </dl>
              </div>
            </div>
          </div>
          <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            <a href="/account">
              <button
                type="button"
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 focus-visible:ring-offset-2">
                Account Settings
              </button></a
            >
          </div>
        </div>
      </div>
    </div>
    <div class="container mx-auto mt-24 max-w-3xl py-24 px-4 sm:px-6 lg:px-8">
      <div>
        <h1 class="text-md font-bold">Add a creator.</h1>
        <span class="text-sm font-medium text-neutral-500"
          >Enter the url of a social profile to add a creator to your
          contacts.</span
        >
      </div>
      <SocialInput />
    </div>

    <!--  <div>

      <div
        v-for="nav in featuredNav"
        class="items-middle mx-auto mt-8 max-w-5xl items-center bg-white px-8 shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div class="inline-flex">
            <component
              :is="nav.icon"
              class="mr-2 mt-0.5 h-5 w-5 text-indigo-600"></component>
            <h3 class="text-lg font-medium leading-6 text-gray-900">
              {{ nav.name }}
            </h3>
          </div>
          <div class="mt-2 max-w-xl text-sm text-gray-500">
            <p>
              {{ nav.description }}
            </p>
          </div>
          <div class="mt-3 text-sm">
            <a
              :href="nav.link"
              class="font-medium text-indigo-600 hover:text-indigo-500">
              {{ nav.cta }}
              <span aria-hidden="true">&rarr;</span></a
            >
          </div>
        </div>
      </div>
    </div> -->
  </div>
</template>

<script>
import AlertBanner from '../components/AlertBanner.vue';
import {
  MagnifyingGlassIcon,
  CloudCloudArrowUpIcon,
} from '@heroicons/vue/24/solid';
import SocialInput from '../components/SocialInput.vue';

const featuredNav = [
  {
    name: 'Bulk Enrich your data',
    description:
      'Upload existing contacts & Jovie will automatically enrich those regards records with addiational details including social media profiles & metrics, social content, and more.',
    link: 'contacts',
    cta: 'Upload contacts',
    icon: 'CloudCloudArrowUpIcon',
  },
];

export default {
  name: 'Dashboard',
  components: {
    MagnifyingGlassIcon,
    CloudCloudArrowUpIcon,
    AlertBanner,
    SocialInput,
  },
  data() {
    return {
      user: this.$store.state.AuthState.user,
      featuredNav,
    };
  },
  methods: {
    thatYou() {
      console.log(this.user);
      // track event in segment

      this.$notify({
        group: 'user',
        title: 'Who are you?',
        text: `You are ${this.user.first_name}`,
        type: 'success',
      });
      //push router to /edit-profile
      this.$router.push('/edit-profile');
    },
  },
  mounted() {},
};
</script>

<style scoped></style>
