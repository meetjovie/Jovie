<template>
  <div class="min-h-full w-80 bg-white">
    <div v-if="user.loggedIn">
      <div
        v-if="!jovie"
        class="absolute top-2 right-2 w-full justify-end text-right text-xs font-bold text-neutral-400 hover:text-neutral-500">
        <a href="https://jov.ie" target="_blank">Jovie</a>
      </div>
      <div v-else class="absolute right-1 top-1">
        <XMarkIcon
          @click="closeContactSidebar()"
          class="h-4 w-4 cursor-pointer text-neutral-400 hover:text-neutral-600" />
      </div>

      <div class="mt-2 grid grid-cols-3">
        <div class="px-1">
          <!--  <svg
            v-if="creator.verified"
            xmlns="http://www.w3.org/2000/svg"
            class="relative top-8 left-20 h-4 w-4 text-neutral-600"
            viewBox="0 0 20 20"
            fill="currentColor">
            <path
              fill-rule="evenodd"
              d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
              clip-rule="evenodd" />
          </svg> -->
          <img
            v-if="imageLoaded"
            crossorigin="anonymous"
            id="profile-img-jovie"
            class="h-18 w-18 mt-2 aspect-square rounded-full border-4 border-neutral-200 object-cover object-center"
            :src="creator.profile_pic_url" />
          <!--WIP fixing images not showing. trigger a function on error works but need to refresh when changing creators -->
          <img
            v-else
            crossorigin="anonymous"
            id="profile-img-jovie"
            class="h-18 w-18 mt-2 aspect-square rounded-full border-4 border-neutral-200 object-cover object-center"
            :src="asset('img/noimage.webp')" />
        </div>
        <div class="col-span-2 mt-4 px-1">
          <input
            @blur="$emit('updateCrmMeta')"
            v-model="creator.meta.name"
            placeholder="Name"
            class="placeholder:text-gray-300/0hover:border-opacity-100 w-full rounded-md border border-gray-300 border-opacity-0 px-1 text-lg font-bold text-gray-700 transition line-clamp-1 hover:bg-gray-100 hover:placeholder:text-gray-500" />
          <!-- <div class="">
            <input
              @blur="saveToJovie()"
              placeholder="Title"
              class="w-auto rounded-md border border-gray-300 border-opacity-0 px-1 text-xs font-bold text-gray-700 transition line-clamp-1 placeholder:text-gray-300/0 hover:border-opacity-100 hover:bg-gray-100 hover:placeholder:text-gray-500" />

            <input
              @blur="saveToJovie()"
              placeholder="Company"
              class="w-full rounded-md border border-gray-300 border-opacity-0 px-1 text-2xs font-semibold text-gray-400 transition line-clamp-1 placeholder:text-gray-300/0 hover:border-opacity-100 hover:bg-gray-100 hover:placeholder:text-gray-500" />
          </div> -->

          <div v-if="creator.category" class="">
            <span
              class="inline-flex items-center rounded-md bg-indigo-100 px-2.5 py-0.5 text-2xs font-medium text-indigo-800">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="-ml-0.5 mr-1.5 h-2 w-2 text-indigo-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
              </svg>
              {{ creator.category }}
            </span>
          </div>

          <div
            @click="toggleExpandBio()"
            class="w-full cursor-pointer whitespace-pre-wrap text-2xs transition-all"
            :class="{
              'h-12 line-clamp-5': expandBio,
              'h-8 line-clamp-2': !expandBio,
            }">
            {{ creator.biography }}
          </div>
        </div>
      </div>
      <div class="grid grid-cols-6 py-2 px-4">
        <SocialIcons
          icon="instagram"
          :link="creator.instagram_handler"
          :followers="formatCount(creator.instagram_followers)"
          height="14"
          width="14"
          class="h-4 w-4 text-gray-400"
          aria-hidden="true"
          :countsVisible="false" />
        <SocialIcons
          icon="twitter"
          :link="creator.twitter_handler"
          :followers="formatCount(creator.twitter_followers)"
          height="14"
          width="14"
          class="h-4 w-4 text-gray-400"
          aria-hidden="true"
          :countsVisible="false" />
        <SocialIcons
          icon="twitch"
          :link="creator.twitch_handler"
          :followers="formatCount(creator.twitch_followers)"
          height="14"
          width="14"
          class="h-4 w-4 text-gray-400"
          aria-hidden="true"
          :countsVisible="false" />
        <SocialIcons
          icon="tiktok"
          :link="creator.tiktok_handler"
          :followers="formatCount(creator.tiktok_followers)"
          height="14"
          width="14"
          class="h-4 w-4 text-gray-400"
          aria-hidden="true"
          :countsVisible="false" />
        <SocialIcons
          icon="youtube"
          :link="creator.youtubeh_handler"
          :followers="formatCount(creator.youtube_followers)"
          height="14"
          width="14"
          class="h-4 w-4 text-gray-400"
          aria-hidden="true"
          :countsVisible="false" />
        <SocialIcons
          icon="linkedin"
          :link="creator.linkedin_handler"
          :followers="formatCount(creator.linkedin_followers)"
          height="14"
          width="14"
          class="h-4 w-4 text-gray-400"
          aria-hidden="true"
          :countsVisible="false" />
      </div>
      <!--  <div v-if="activeSocialNetworkURLEdit">
        <div class="relative rounded-md py-1 px-2 shadow-sm">
          <div
            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <SocialIcons
              :network="activeSocialNetworkURLEdit.network"
              height="14"
              width="14"
              class="h-4 w-4 text-gray-400"
              aria-hidden="true" />
          </div>
          <input
            type="email"
            name="email"
            id="email"
            class="block w-full rounded-md border-gray-300 pl-10 text-2xs focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
            placeholder="sdfsdfsfd" />
        </div>
      </div> -->

      <hr />

      <div class="px-4 py-2">
        <ButtonGroup
          v-if="!jovie"
          :text="buttonText"
          :success="savedToJovie"
          @click="saveToJovie()"
          class="w-full rounded-md py-2 px-4 font-bold text-white hover:bg-indigo-600" />
      </div>
      <div class="px-2">
        <h2 class="text-xs font-semibold text-neutral-400">Lists</h2>
        <InputLists
          :lists="creator.lists"
          :current-list="creator.current_list" />
      </div>
      <div class="mt-4 space-y-4 px-2">
        <h2 class="mb-2 text-xs font-semibold text-neutral-400">
          Contact Details
        </h2>
        <DataInputGroup
          @blur="$emit('updateCrmMeta')"
          v-model="creator.meta.location"
          :value="`${creator.city ?? ''} ${creator.country ?? ''}`"
          id="location"
          icon="MapPinIcon"
          label="Location"
          placeholder="Location"
          ><slot name="icon">HI</slot></DataInputGroup
        >

        <DataInputGroup
          @blur="$emit('updateCrmMeta')"
          v-model="creator.meta.emails"
          icon="EnvelopeIcon"
          id="email"
          label="Email"
          placeholder="email@email.com" />
        <DataInputGroup
          @blur="$emit('updateCrmMeta')"
          v-model="creator.meta.website"
          icon="LinkIcon"
          id="website"
          label="Website"
          placeholder="Website" />
        <DataInputGroup
          @blur="$emit('updateCrmMeta')"
          v-model="creator.meta.phone"
          id="phone"
          icon="PhoneIcon"
          label="Phone"
          placeholder="Phone" />
        <DataInputGroup
          @blur="$emit('updateCrmMeta')"
          socialicon="instagram"
          v-model="creator.meta.instagram_handler"
          id="instagram_handler"
          label="Instagram"
          placeholder="Instagram" />
        <DataInputGroup
          @blur="$emit('updateCrmMeta')"
          socialicon="twitch"
          v-model="creator.meta.twitch_handler"
          id="twitch_handler"
          label="Twitch"
          placeholder="Twitch" />
        <DataInputGroup
          @blur="$emit('updateCrmMeta')"
          socialicon="twitter"
          v-model="creator.meta.twitter_handler"
          id="twitter_handler"
          label="Twitter"
          placeholder="Twitter" />
        <TextAreaInput v-model="creator.note" @blur="updateCreatorNote" />
      </div>
      <!--  <div class="grid mt-2 border-b pb-2 px-2 grid-cols-3">
        <div class="mx-auto">
          <div class="text-center text-md text-indigo-400 font-bold">34M</div>
          <div class="text-center text-[8px] text-indigo-600 font-bold">Followers</div>
        </div>
        <div class="mx-auto">
          <div class="text-center text-md text-indigo-400 font-bold">3.4%</div>
          <div class="text-center text-[8px] text-indigo-600 font-bold">Engagement</div>
        </div>
        <div class="mx-auto">
          <div class="text-center text-md text-indigo-400 font-bold">43</div>
          <div class="text-center text-[8px] text-indigo-600 font-bold">EF</div>
        </div>
      </div> -->
      <!-- <div class="grid grid-cols-3">
        <img
          class="object-fit object-cover rounded-md-l"
          src="data:image/jpeg;base64,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"
        />

        <img
          class="object-fit object-cover"
          src="data:image/jpeg;base64,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"
        />

        <img
          class="object-fit object-cover rounded-md-r"
          src="data:image/jpeg;base64,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"
        />
      </div> -->
    </div>
    <div v-else>
      <div class="flex">
        <!-- <div class="relative hidden h-screen flex-1 items-center bg-indigo-700 lg:flex">
          <div class="m-auto flex h-full items-center">
            <JovieLogo height="48px" color="#fff" />
          </div>
        </div> -->
        <div
          class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
          <div class="mx-auto w-full max-w-sm lg:w-96">
            <div>
              <div class="block lg:hidden">
                <JovieLogo height="28px" />
              </div>
              <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                Sign in
              </h2>
              <p class="mt-2 text-sm text-gray-600">
                Or
                {{ ' ' }}
                <a
                  href="https://jov.ie/signup"
                  target="_blank"
                  class="font-medium text-indigo-600 hover:text-indigo-500">
                  Create an account
                </a>
              </p>

              <ul v-if="error" class="text-red-900">
                <li>{{ error }}</li>
              </ul>
            </div>

            <div class="mt-8">
              <div class="mt-6">
                <form action="#" method="POST" class="space-y-6">
                  <div>
                    <div class="relative mt-1">
                      <InputGroup
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        placeholder="Email"
                        label="Email"
                        required="" />
                      <!--  <p class="mt-2 text-sm text-red-900" v-if="this.errors.email">
                        {{ this.errors.email[0] }}
                      </p> -->
                    </div>
                  </div>

                  <div>
                    <div class="relative mt-1">
                      <InputGroup
                        id="password"
                        name="password"
                        label="Password"
                        placeholder="Password"
                        type="password"
                        v-on:keyup.enter="login()"
                        autocomplete="current-password"
                        required="" />
                      <!--  <p class="mt-2 text-sm text-red-900" v-if="this.errors.password">
                        {{ this.errors.password[0] }}
                      </p> -->
                    </div>
                  </div>

                  <div>
                    <button
                      :disabled="loggingIn"
                      @click="login()"
                      type="button"
                      class="mt-4 flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                      Sign in
                    </button>
                  </div>

                  <div class="flex items-center justify-between">
                    <div class="flex items-center">
                      <input
                        id="remember-me"
                        name="remember-me"
                        type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500" />
                      <label
                        for="remember-me"
                        class="ml-2 block text-sm text-gray-900">
                        Remember me
                      </label>
                    </div>

                    <div class="text-sm">
                      <a
                        href="https://jov.ie/forgot-password"
                        target="_blank"
                        class="font-medium text-indigo-600 hover:text-indigo-500">
                        Forgot your password?
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <AuthFooter></AuthFooter>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ButtonGroup from '../components/ButtonGroup.vue';
import JovieLogo from '../components/JovieLogo.vue';
import AuthFooter from '../components/Auth/AuthFooter.vue';
import InputGroup from '../components/InputGroup.vue';
import DataInputGroup from '../components/DataInputGroup.vue';
import JovieSpinner from '../components/JovieSpinner.vue';
import TextAreaInput from '../components/TextAreaInput.vue';
import InputLists from '../components/InputLists.vue';
import { XMarkIcon } from '@heroicons/vue/24/solid';
import SocialIcons from './SocialIcons.vue';
import UserService from '../services/api/user.service';
export default {
  name: 'Contact Sidebar',
  components: {
    JovieLogo,
    AuthFooter,
    InputGroup,
    JovieSpinner,
    XMarkIcon,
    ButtonGroup,
    DataInputGroup,
    TextAreaInput,
    InputLists,
    SocialIcons,
  },
  watch: {
    creator: function (val) {
      console.log('this.creator');
      this.resetImage();
      console.log(val);
    },
  },
  mounted() {
    // console.log('Sidebar loaded');
    // document.onreadystatechange = () => {
    //   if (document.readyState == 'complete') {
    //     console.log('Page completed with image and files!');
    //     // fetch to next page or some code
    //     /*  this.setCreatorData(); */
    //   }
    // };
    //
    // const queryParameters = location.href.split('?')[1];
    // let image = queryParameters.split('image=')[1];
    // const urlParameters = new URLSearchParams(queryParameters);
    //
    // let creator = urlParameters.get('creator');
    // this.creator = JSON.parse(creator);
    // this.creator.instagram_profile_picture = image;
    // console.log('creator from iframe');
    // console.log(this.creator);
  },
  props: {
    creator: {
      type: Object,
      default: {},
    },
    jovie: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    resetImage() {
      this.imageLoaded = true;
    },
    updateCreatorNote() {
      UserService.updateCreatorNote(this.creator.id, this.creator.note)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
          } else {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {});
    },
    editSocialNetworkURL(network, creator) {
      console.log('editSocialNetworkURL');
      console.log(network);
      console.log(creator);

      this.activeSocialNetworkURLEdit = {
        network: network,
        creator: creator,
      };
      this.$emit('editSocialNetworkURL', network, creator);
    },
    closeContactSidebar() {
      //turn off the sidebar
      this.$store.state.ContactSidebarOpen = false;
    },
    setCreatorData() {
      ///listen for an object from the content script
      chrome.storage.local.get(['creator'], function (result) {
        console.log(result);
        if (result.creator) {
          this.creator = result.creator;
        }
      });
    },
    toggleExpandBio() {
      this.expandBio = !this.expandBio;
    },
    imageLoadingError() {
      this.imageLoaded = false;
    },
  },
  data() {
    return {
      instagram_handler: '',
      loader: false,
      expandBio: false,
      savedToJovie: false,
      buttonText: 'Save to Jovie',
      closeSidebar: '',
      imageLoaded: true,

      activeSocialNetworkURLEdit: [],
      user: {
        loggedIn: true,
        name: '',
        email: '',
        password: '',
        passwordConfirm: '',
        errors: [],
      },
    };
  },
};
</script>

<style scoped></style>
