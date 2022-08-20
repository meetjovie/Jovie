<template>
  <div class="mx-auto h-screen max-w-5xl flex-col justify-between py-12">
    <div class="mx-12">
      <h4 class="sr-only">Status</h4>
      <p class="text-sm font-medium text-gray-900">
        Creating your Jovie profile...
      </p>
      <div class="mt-6" aria-hidden="true">
        <div class="overflow-hidden rounded-full bg-gray-200">
          <div
            class="h-2 rounded-full bg-indigo-600"
            :style="{ width: status.percentage }" />
        </div>
        <div
          class="mt-6 hidden grid-cols-4 text-sm font-medium text-gray-600 sm:grid">
          <div class="text-indigo-600">Upload picture</div>
          <div class="text-center text-indigo-600">Add social Links</div>
          <div class="text-center">Set a username</div>
          <div class="text-right">Done</div>
        </div>
      </div>
    </div>

    <div class="rounded-md bg-neutral-400 py-6 px-4 text-center">
      <div v-if="!step1Complete">
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
              :disabled="updating">
            </ButtonGroup>
          </div>
        </form>
      </div>

      <div v-else-if="!step2Complete">
        <InputGroup
          v-model="$store.state.AuthState.user.instagram_handler"
          :error="errors?.instagram_handler?.[0]"
          :disabled="updating"
          name="instagram_handler"
          label="Instagram Handler"
          placeholder="Instagram Handler"
          type="text" />
      </div>
      <div v-else-if="!step3Complete">
        <InputGroup
          v-model="$store.state.AuthState.user.username"
          :error="errors?.username?.[0]"
          :disabled="updating"
          name="username"
          label="Username"
          placeholder="Username"
          type="text" />
      </div>
      <div v-else>Here's your profile</div>
    </div>

    <div class="text-2x font-bold">This will only take a moment</div>
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

export default {
  name: 'ProfileSetup',
  components: { InputGroup, CardHeading, CardLayout, ButtonGroup, ModalPopup },
  data() {
    return {
      step1Complete: false,
      step2Complete: false,
      step3Complete: false,
      status: [
        {
          percentage: 20,
        },
      ],
      errors: {},
      updating: false,
      bucketResponse: null,
      uploadProgress: 0,
      deleteModalOpen: false,
    };
  },
  mounted() {
    window.analytics.page('Edit Profile');
    //make a function that sets step1 to true if the user has a profile photo
    //make a function that sets step2 to true if the user has social handles
    //make a function that sets step3 to true if the user has a username

    this.step1Complete = this.$store.state.AuthState.user.profile_pic_url
      ? true
      : false;
    this.step2Complete = this.$store.state.AuthState.user.social_handles
      ? true
      : false;
    this.step3Complete = this.$store.state.AuthState.user.username
      ? true
      : false;
  },
  methods: {
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
