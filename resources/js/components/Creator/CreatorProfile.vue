<template>
  <div
    class="items-top flex max-h-screen min-h-screen justify-center overflow-hidden bg-gray-50 px-4 sm:items-center sm:px-6 lg:px-8">
    <div class="mt-8 max-w-md items-center space-y-8 pt-8 sm:mt-0">
      <div v-if="profile" :key="profile.name">
        <img
          class="block-inline 2xL:w-auto mx-auto mt-0 w-48 rounded-full object-cover object-center sm:w-64 2xl:w-80"
          :src="asset(profile.pic)"
          alt="" />
        <div class="mx-auto mt-6 flex 2xl:mt-12">
          <h2 class="mx-auto flex text-3xl font-extrabold text-gray-900">
            {{ profile.name }}

            <svg
              v-if="profile.verified"
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
          {{ profile.bio }}
          <a
            v-if="profile.biolink"
            :href="profile.biolink"
            class="font-medium text-indigo-600 hover:text-indigo-500">
            {{ profile.biolinktext }}
          </a>
        </p>
      </div>

      <div class="mt-2 2xl:mt-8">
        <fieldset class="mt-0 2xl:mt-2">
          <legend class="sr-only">Social links</legend>
          <div
            class="grid grid-cols-3 items-center justify-between gap-3 sm:grid-cols-6">
            <div
              v-if="profile.link1"
              class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase opacity-50 hover:bg-gray-100 hover:opacity-100 focus-visible:outline-none sm:flex-1">
              <a :href="profile.link1">
                <img
                  height="24"
                  width="24"
                  class="mx-auto"
                  :src="profile.link1icon" />
              </a>
            </div>
            <div
              v-if="profile.link2"
              class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase opacity-50 hover:bg-gray-100 hover:opacity-100 focus-visible:outline-none sm:flex-1">
              <a :href="profile.link2">
                <img
                  height="24"
                  width="24"
                  class="mx-auto"
                  :src="profile.link2icon" />
              </a>
            </div>
            <div
              v-if="profile.link3"
              class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase opacity-50 hover:bg-gray-100 hover:opacity-100 focus-visible:outline-none sm:flex-1">
              <a :href="profile.link3">
                <img
                  height="24"
                  width="24"
                  class="mx-auto"
                  :src="profile.link3icon" />
              </a>
            </div>
            <div
              v-if="profile.link4"
              class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase opacity-50 hover:bg-gray-100 hover:opacity-100 focus-visible:outline-none sm:flex-1">
              <a :href="profile.link4">
                <img
                  height="24"
                  width="24"
                  class="mx-auto"
                  :src="profile.link4icon" />
              </a>
            </div>
            <div
              v-if="profile.link5"
              class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase opacity-50 hover:bg-gray-100 hover:opacity-100 focus-visible:outline-none sm:flex-1">
              <a :href="profile.link5">
                <img
                  height="24"
                  width="24"
                  class="mx-auto"
                  :src="profile.link5icon" />
              </a>
            </div>
            <div
              v-if="profile.link6"
              class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase opacity-50 hover:bg-gray-100 hover:opacity-100 focus-visible:outline-none sm:flex-1">
              <a :href="profile.link6">
                <img
                  height="24"
                  width="24"
                  class="mx-auto"
                  :src="profile.link6icon" />
              </a>
            </div>
          </div>
        </fieldset>
      </div>

      <!--  <div>
                <div class="mt-3 relative rounded-md">
                    <div class="absolute -mb-4 inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                    <div class="flex items-center text-center">

                        <input type="text" name="email" id="email"
                               class="mt-4 focus-visible:ring-indigo-500 py-3 focus-visible:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                               placeholder="you@example.com"> 

                </div>
                </div>
            </div>  -->

      <a :href="profile.ctalink">
        <button
          type="submit"
          class="mt-2 mb-0 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
          <component :is="profile.icon" class="text-white" />
          {{ profile.ctatext }}
        </button>
      </a>

      <div class="border-t-2 border-gray-400 opacity-20"></div>
      <router-link
        class="group mt-1 py-4 text-center text-sm text-gray-500"
        to="creators">
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
import JovieLogo from '../JovieLogo.vue';
import ButtonGroup from '../ButtonGroup.vue';
import { MailOpenIcon } from '@heroicons/vue/solid';

export default {
  name: 'CreatorProfile',
  components: { JovieLogo, ButtonGroup, MailOpenIcon },
  props: {
    profile: {
      type: Object,
      required: true,
    },
  },
};
</script>
