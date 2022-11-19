<template>
  <div class="flex w-full">
    <div
      class="mx-auto flex h-screen w-full flex-col items-center justify-between py-12">
      <div class="mx-auto h-full w-full items-center px-12 py-6">
        <p class="text-sm font-medium text-gray-900">
          Create your Jovie profile...
        </p>
        <div class="mx-auto max-w-7xl py-6" aria-hidden="true">
          <div class="overflow-hidden rounded-full bg-gray-200">
            <div
              class="h-2 rounded-full bg-indigo-600"
              :class="[
                { 'w-1/6': currentStep === 1 },
                { 'w-2/5': currentStep === 2 },
                { 'w-3/5': currentStep === 3 },
                { 'w-full': currentStep === 4 },
                'w-0',
              ]" />
          </div>
          <div
            class="max-w-7xlhidden mx-auto mt-2 grid-cols-4 px-8 text-sm font-medium text-gray-600 sm:grid">
            <div
              @click="setCurrentStep(1)"
              class="cursor-pointer"
              :class="[
                { 'text-indigo-600': step1Complete },
                'text-neutral-600',
              ]">
              Upload picture
            </div>
            <div
              @click="setCurrentStep(2)"
              class="cursor-pointer"
              :class="[
                { 'text-indigo-600': step2Complete },
                'text-neutral-600',
              ]">
              Add social Links
            </div>
            <div
              @click="setCurrentStep(3)"
              class="cursor-pointer"
              :class="[
                { 'text-indigo-600': step3Complete },
                'text-neutral-600',
              ]">
              Set a username
            </div>
            <div
              class="cursor-pointer"
              :class="[
                {
                  'text-indigo-600':
                    step1Complete && step2Complete && step3Complete,
                },
                'text-neutral-600',
              ]">
              Finish
            </div>
          </div>
        </div>

        <div v-if="currentStep == 1">
          <form
            @submit.prevent="updateProfile()"
            method="post"
            enctype="multipart/form-data">
            <div
              x-data="{photoName: null, photoPreview: null}"
              class="bg-white px-4 py-5 shadow sm:rounded-tl-md sm:rounded-tr-md sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-4">
                  <!-- Profile Photo File Input -->
                  <div class="mt-1 flex items-center space-x-5">
                    <span
                      class="inline-block h-20 w-20 overflow-hidden rounded-full bg-neutral-100 object-cover object-center">
                      <img
                        class="aspect-square"
                        id="profile_pic_url_img"
                        ref="profile_pic_url_img"
                        :src="
                          $store.state.AuthState.user.profile_pic_url ??
                          $store.state.AuthState.user.default_image
                        " />
                    </span>

                    <label
                      for="profile_pic_url"
                      class="cursor-pointer rounded-md border border-neutral-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-neutral-700 shadow-sm hover:bg-neutral-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                      Change
                    </label>
                    <input
                      :disabled="updating"
                      type="file"
                      ref="profile_pic_url"
                      @change="fileChanged($event)"
                      name="profile_pic_url"
                      id="profile_pic_url"
                      style="display: none" />
                    <span v-if="uploadProgress">{{ uploadProgress }} %</span>
                    <ProgressBar
                      v-if="uploadProgress"
                      :progress="uploadProgress" />
                    <p
                      v-if="errors.profile_pic_url"
                      class="mt-2 text-sm text-red-600">
                      {{ errors.profile_pic_url[0] }}
                    </p>
                  </div>

                  <button
                    @click="removeProfilePhoto()"
                    v-if="$store.state.AuthState.user.profile_pic_url"
                    type="button"
                    class="mt-2 mr-2 inline-flex items-center rounded-md border border-neutral-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-neutral-700 shadow-sm transition hover:text-neutral-500 focus-visible:border-blue-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-blue-200 active:bg-neutral-50 active:text-neutral-800 disabled:opacity-25">
                    Remove Photo
                  </button>
                </div>

                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                  <InputGroup
                    v-model="$store.state.AuthState.user.first_name"
                    :error="errors?.first_name?.[0]"
                    :disabled="updating"
                    name="first_name"
                    label="First Name"
                    placeholder="First Name"
                    type="text" />
                </div>

                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                  <InputGroup
                    v-model="$store.state.AuthState.user.last_name"
                    :error="errors?.last_name?.[0]"
                    :disabled="updating"
                    name="last_name"
                    label="Last Name"
                    placeholder="Last Name"
                    type="text" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                  <InputGroup
                    :value="$store.state.AuthState.user.email"
                    :error="errors?.email?.[0]"
                    :disabled="true"
                    name="email"
                    label="Email"
                    placeholder="Email"
                    type="text" />
                </div>
              </div>
            </div>
            <div
              class="flex items-center justify-end bg-neutral-50 px-4 py-3 text-right shadow sm:rounded-bl-md sm:rounded-br-md sm:px-6">
              <ButtonGroup
                type="submit"
                design="primary"
                text="Save"
                @click="currentStep = 2"
                :disabled="updating">
              </ButtonGroup>
            </div>
          </form>
        </div>

        <div class="mt-8 items-center px-2 py-12" v-else-if="currentStep == 2">
          <div class="py- rounded-md bg-gray-50 px-4">
            <h2 class="font-neutral-500 py-2 px-4">
              Add at least one social link to your profile.
            </h2>
            <div class="mt-4 grid grid-cols-2 gap-4">
              <InputGroup
                @blur="updateSocialHandlers()"
                v-model="currentUser.instagram_handler"
                :error="errors?.instagram_handler?.[0]"
                :disabled="updating"
                name="instagram_handler"
                socialicon="instagram"
                label="Instagram"
                placeholder="Instagram"
                type="text" />

              <InputGroup
                @blur="updateSocialHandlers()"
                v-model="currentUser.tiktok_handler"
                :error="errors?.tiktok_handler?.[0]"
                :disabled="updating"
                name="tiktok_handler"
                socialicon="tiktok"
                label="TikTok"
                placeholder="TikTok"
                type="text" />

              <InputGroup
                @blur="updateSocialHandlers()"
                v-model="currentUser.twitter_handler"
                :error="errors?.twitter_handler?.[0]"
                :disabled="updating"
                name="twitter_handler"
                socialicon="twitter"
                label="Twitter"
                placeholder="Twitter"
                type="text" />

              <InputGroup
                @blur="updateSocialHandlers()"
                v-model="currentUser.youtube_handler"
                :error="errors?.youtube_handler?.[0]"
                :disabled="updating"
                name="youtube_handler"
                socialicon="youtube"
                label="YouTube"
                placeholder="YouTube"
                type="text" />
            </div>
            <div class="py-4">
              <ButtonGroup
                text="Next"
                :loader="updating"
                @click="currentStep = currentStep + 1" />
            </div>
          </div>
        </div>
        <div
          class="mt-4 items-center space-y-4 px-2 py-4"
          v-else-if="currentStep == 3">
          <InputGroup
            @blur="updateSocialHandlers()"
            v-model="currentUser.username"
            :error="errors?.username?.[0]"
            :disabled="updating"
            name="username"
            label="Username"
            placeholder="Username"
            type="text" />
          <ButtonGroup
            v-if="currentUser.username"
            text="Save"
            :loader="updating"
            @click="completeProfileSetup()" />
        </div>
        <div v-else>Here's your profile</div>
      </div>

      <div
        class="text-2x mx-auto flex items-center justify-between py-6 px-4 text-center font-semibold text-neutral-500">
        <div>
          <ChevronLeftIcon
            @click="previousStep()"
            v-if="currentStep > 1"
            class="mr-2 h-8 w-8 cursor-pointer" />
        </div>
        <div>Step {{ currentStep }} of 4</div>
        <div>
          <ChevronRightIcon
            @click="nextStep()"
            v-if="currentStep < 3"
            class="mr-2 h-8 w-8 cursor-pointer" />
        </div>
      </div>
    </div>
    <aside
      class="overflow-y-autoxl:order-last relative hidden w-96 flex-shrink-0 border border-dashed xl:flex xl:flex-col">
      <!-- Start secondary column (hidden on smaller screens) -->
      <div
        class="absolute inset-0 items-center border-r border-gray-200 py-6 px-4 sm:px-6 lg:px-8">
        <span class="text-2xl font-semibold text-neutral-500">Preview</span>
        <div class="items-center">
          <div
            class="items-top min-h-96 flex items-center justify-center overflow-hidden rounded-3xl border-4 border-gray-200 bg-gray-50 px-4 sm:items-center sm:px-6 lg:px-8">
            <div class="mt-8 max-w-md items-center space-y-8 pt-8 sm:mt-0">
              <div>
                <img
                  class="block-inline mx-auto mt-0 aspect-square w-48 rounded-full object-cover object-center"
                  :src="this.currentUser.profile_pic_url"
                  alt="" />

                <div class="mx-auto mt-6 flex 2xl:mt-12">
                  <h2
                    class="mx-auto flex text-3xl font-extrabold text-gray-900">
                    {{ this.currentUser.first_name }}
                    {{ this.currentUser.last_name }}
                    <svg
                      v-if="this.currentUser.is_verified"
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
                  {{ this.currentUser.title }}
                  {{ this.currentUser.employer ? ' at ' : '' }}
                  <a
                    v-if="this.currentUser.employer"
                    :href="this.currentUser.employer_link"
                    class="font-medium text-indigo-600 hover:text-indigo-500">
                    {{ this.currentUser.employer }}
                  </a>
                </p>
              </div>
              <div
                class="mt-2 2xl:mt-8"
                v-if="this.currentUser.creator_profile">
                <fieldset class="mt-0 2xl:mt-2">
                  <legend class="sr-only">Social links</legend>
                  <div
                    class="flex grid-cols-3 items-center justify-between gap-2 sm:grid-cols-6">
                    <template v-for="network in networks" :key="network">
                      <div
                        v-if="
                          user[`show_${network}`] &&
                          this.currentUser.creator_profile[`${network}_handler`]
                        "
                        class="group flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase opacity-50 hover:bg-gray-100 hover:opacity-100 focus-visible:outline-none sm:flex-1">
                        <a
                          class
                          :href="
                            this.currentUser.creator_profile[
                              `${network}_handler`
                            ]
                          "
                          target="_blank">
                          <SocialIcons
                            groupHover
                            height="24px"
                            :icon="network" />
                          <span class="sr-only">{{ network }}</span>
                        </a>
                      </div>
                    </template>
                  </div>
                </fieldset>
              </div>
              <!--    this.currentUser.call_to_action -->
              <!--  v-if="this.currentUser.call_to_action_text" -->
              <a href="#">
                <button
                  class="mt-2 mb-0 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                  Save contact
                </button>
              </a>

              <div class="border-t-2 border-gray-400 opacity-20"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- End secondary column -->
    </aside>
  </div>
</template>
<script>
import InputGroup from './../components/InputGroup';
import CardHeading from './../components/CardHeading';
import CardLayout from './../components/CardLayout';
import ButtonGroup from './../components/ButtonGroup';
import ModalPopup from './../components/ModalPopup';
import UserService from './../services/api/user.service';
import ProgressBar from './../components/ProgressBar';
import JovieSpinner from './../components/JovieSpinner';
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline';

export default {
  name: 'ProfileSetup',
  components: {
    InputGroup,
    ChevronLeftIcon,
    ChevronRightIcon,
    CardHeading,
    CardLayout,
    ProgressBar,
    ButtonGroup,
    ModalPopup,
    JovieSpinner,
  },
  data() {
    return {
      step1Complete: false,
      step2Complete: false,
      step3Complete: false,
      currentStep: '',
      loader: false,
      errors: {},
      updating: false,
      bucketResponse: null,
      uploadProgress: 0,
      deleteModalOpen: false,
    };
  },
  mounted() {
    window.analytics.page('Edit Profile');

    //if currentUser.profile_pic is not emptry, return true
    if (this.$store.state.AuthState.user.profile_pic) {
      this.step1Complete = true;
    }
    //if the currentUser instagram_handler or tiktok_handler or youtube_handler or twitter_handler is not empty, return true
    if (
      this.$store.state.AuthState.user.instagram_handler ||
      this.$store.state.AuthState.user.tiktok_handler ||
      this.$store.state.AuthState.user.youtube_handler ||
      this.$store.state.AuthState.user.twitter_handler
    ) {
      this.step2Complete = true;
    }
    //if the current user username is not empty, return true
    if (this.$store.state.AuthState.user.username) {
      this.step3Complete = true;
    }
    // if step1 i not complete set the current step to 1 else if step 2 is not complete set the current step to 2 else if step 3 is not complete set the current step to 3 else set the current step to 4
    this.currentStep = this.step1Complete
      ? this.step2Complete
        ? this.step3Complete
          ? 4
          : 3
        : 2
      : 1;
  },
  methods: {
    completeProfileSetup() {
      this.updating = true;
      this.step3Complete = true;

      this.$router.push('Edit Profile');
    },
    setCurrentStep(step) {
      this.currentStep = step;
    },
    previousStep() {
      this.currentStep--;
    },
    nextStep() {
      this.currentStep++;
    },
    fileChanged(e) {
      this.bucketResponse = null;
      this.uploadProgress = 0;
      const src = URL.createObjectURL(e.target.files[0]);
      Vapor.store(e.target.files[0], {
        visibility: 'public-read',
        progress: (progress) => {
          this.uploadProgress = Math.round(progress * 100);
        },
      }).then((response) => {
        this.bucketResponse = response;
        this.$refs.profile_pic_url_img.src = src;
      });
    },
    updateSocialHandlers() {
      this.updating = true;
      let data = new FormData();
      data.append(
        'instagram_handler',
        this.currentUser.instagram_handler ?? ''
      );
      data.append('tiktok_handler', this.currentUser.tiktok_handler ?? '');
      data.append('twitter_handler', this.currentUser.twitter_handler ?? '');
      data.append('youtube_handler', this.currentUser.youtube_handler ?? '');
      data.append('twitch_handler', this.currentUser.twitch_handler ?? '');
      data.append('username', this.currentUser.username ?? '');
      //add username
      UserService.updateProfile(data)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$store.commit('setAuthStateUser', response.user);
            this.$refs.profile_pic_url.value = null;
            this.errors = {};
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally((response) => {
          this.updating = false;
        });
    },
    updateProfile() {
      let data = new FormData();
      data.append('first_name', this.$store.state.AuthState.user.first_name);
      data.append('last_name', this.$store.state.AuthState.user.last_name);
      if (this.bucketResponse && this.bucketResponse.uuid) {
        data.append('profile_pic_url', this.bucketResponse.uuid);
      }
      this.updating = true;
      UserService.updateProfile(data)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$store.commit('setAuthStateUser', response.user);
            this.$refs.profile_pic_url.value = null;
            this.errors = {};
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally((response) => {
          this.updating = false;
        });
    },
    removeProfilePhoto() {
      this.updating = true;
      UserService.removeProfilePhoto()
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$store.commit('setAuthStateUser', response.user);
          }
        })
        .catch((error) => {
          error = error.response;
        })
        .finally((response) => {
          this.updating = false;
        });
    },
  },
};
</script>
