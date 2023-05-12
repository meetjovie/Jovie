<template>
  <div>
    <div v-if="onboarding">
      <div class="space-y-4">
        <!-- Profile Photo File Input -->
        <div class="mx-auto mt-1 flex flex-col items-center">
          <ContactAvatar
            :editable="true"
            @updateAvatar="updateProfile($event)"
            :loading="!$store.state.AuthState.user.id"
            :contact="$store.state.AuthState.user"
            class="mr-2" />
        </div>
        <!-- Name -->
        <div class="col-span-6 flex space-x-4">
          <div class="col-span-3">
            <InputGroup
              v-model="$store.state.AuthState.user.first_name"
              :error="errors?.first_name?.[0]"
              :disabled="updating"
              @blur="updateProfile"
              name="first_name"
              label="First Name"
              placeholder="First Name"
              type="text" />
          </div>

          <!-- Name -->
          <div class="col-span-3">
            <InputGroup
              @blur="updateProfile"
              v-model="$store.state.AuthState.user.last_name"
              :error="errors?.last_name?.[0]"
              :disabled="updating"
              name="last_name"
              label="Last Name"
              placeholder="Last Name"
              type="text" />
          </div>
        </div>
      </div>
    </div>
    <div v-else class="mx-auto max-w-7xl items-center py-10 sm:px-6 lg:px-8">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="flex justify-between md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3
              class="text-lg font-medium text-slate-900 dark:text-jovieDark-100">
              Profile Information
            </h3>

            <p class="mt-1 text-sm text-slate-600 dark:text-jovieDark-300">
              Update your account information and email address.
            </p>
          </div>

          <div class="px-4 sm:px-0"></div>
        </div>

        <div class="mt-5 md:col-span-2 md:mt-0">
          <form
            @submit.prevent="updateProfile()"
            method="post"
            enctype="multipart/form-data">
            <div
              x-data="{photoName: null, photoPreview: null}"
              class="bg-white px-4 py-5 shadow dark:bg-jovieDark-800 sm:rounded-tl-md sm:rounded-tr-md sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-4">
                  <!-- Profile Photo File Input -->
                  <div class="mt-1 flex items-center space-x-5">
                    <span
                      class="inline-block h-20 w-20 overflow-hidden rounded-full bg-slate-100 object-cover object-center dark:bg-jovieDark-800">
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
                      class="cursor-pointer rounded-md border border-slate-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-slate-700 shadow-sm hover:bg-slate-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 dark:border-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-800 dark:bg-jovieDark-900 dark:text-jovieDark-200">
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
                    class="mr-2 mt-2 inline-flex items-center rounded-md border border-slate-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-slate-700 shadow-sm transition hover:text-slate-500 focus-visible:border-blue-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-blue-200 active:bg-slate-50 active:text-slate-800 disabled:opacity-25 dark:border-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-800 dark:bg-jovieDark-900 dark:text-jovieDark-200">
                    Remove Photo
                  </button>
                </div>

                <!-- Name -->
                <div class="col-span-3">
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
                <div class="col-span-3">
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
                <AccountMobile :phone="$store.state.AuthState.user.phone" />
                <!-- Title -->
                <div class="col-span-3">
                  <InputGroup
                    v-model="currentUser.title"
                    :error="errors?.title?.[0]"
                    :disabled="updating"
                    name="title"
                    label="Title"
                    placeholder="Title"
                    type="text" />
                </div>

                <!-- Employee -->
                <div class="col-span-3">
                  <InputGroup
                    v-model="currentUser.employer"
                    :error="errors?.employer?.[0]"
                    :disabled="updating"
                    name="Employer"
                    label="Company"
                    placeholder="Company"
                    type="text" />
                </div>
              </div>
            </div>

            <div
              class="flex items-center justify-end bg-slate-50 px-4 py-3 text-right shadow dark:bg-jovieDark-800 sm:rounded-bl-md sm:rounded-br-md sm:px-6">
              <ButtonGroup
                type="submit"
                design="primary"
                text="Save"
                :loading="updating"
                :disabled="updating">
              </ButtonGroup>
            </div>
          </form>
        </div>

        <div class="flex justify-between md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3
              class="text-lg font-medium text-slate-900 dark:text-jovieDark-100">
              Social Handles
            </h3>

            <p class="mt-1 text-sm text-slate-600 dark:text-jovieDark-300">
              Add your social network handles.
            </p>
          </div>

          <div class="px-4 sm:px-0"></div>
        </div>

        <div class="mt-5 md:col-span-2 md:mt-0">
          <form
            @submit.prevent="updateSocialHandlers()"
            method="post"
            enctype="multipart/form-data">
            <div
              x-data="{photoName: null, photoPreview: null}"
              class="bg-white px-4 py-5 shadow dark:bg-jovieDark-800 sm:rounded-tl-md sm:rounded-tr-md sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <!-- Social -->
                <div class="grid-col-2 col-span-6 grid sm:col-span-3">
                  <InputGroup
                    @blur="updateSocialHandlers()"
                    v-model="currentUser.instagram_handler"
                    :error="errors?.instagram_handler?.[0]"
                    :disabled="updating"
                    name="instagram_handler"
                    socialicon="instagram"
                    label="Instagram"
                    placeholder="Instagram
                    Username"
                    type="text" />
                </div>
                <div class="col-span-6 sm:col-span-3">
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
                </div>
                <div class="col-span-6 sm:col-span-3">
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
                </div>
                <div class="col-span-6 sm:col-span-3">
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
              </div>
            </div>

            <div
              class="flex items-center justify-end bg-slate-50 px-4 py-3 text-right shadow dark:bg-jovieDark-800 sm:rounded-bl-md sm:rounded-br-md sm:px-6">
              <ButtonGroup
                type="submit"
                design="primary"
                text="Save"
                :loading="updating"
                :disabled="updating">
              </ButtonGroup>
            </div>
          </form>
        </div>
      </div>

      <div class="hidden sm:block">
        <div class="py-8">
          <div class="border-t border-slate-200"></div>
        </div>
      </div>
    </div>
  </div>
  <ActionPanel
    v-if="!onboarding"
    title="Delete Account"
    buttonstyle="danger"
    description="This is permanent and cannot be undone."
    buttonText="Delete"
    @action-click="toggleDeleteModal()" />
  <ModalPopup
    @primaryButtonClick="deleteAccount()"
    :open="deleteModalOpen"
    title="Deactivate account" />
</template>

<script>
import ActionPanel from '../../components/ActionPanel.vue';
import UserService from '../../services/api/user.service';
import InputGroup from '../../components/InputGroup';
import CardHeading from '../../components/CardHeading';
import CardLayout from '../../components/CardLayout';
import ButtonGroup from '../../components/ButtonGroup';
import ImportService from '../../services/api/import.service';
import ModalPopup from '../../components/ModalPopup';
import SocialIcons from '../../components/SocialIcons';
import ContactAvatar from '../ContactAvatar.vue';
import AccountMobile from './AccountMobile.vue';

export default {
  name: 'AccountProfile',
  components: {
    AccountMobile,
    InputGroup,
    CardHeading,
    CardLayout,
    ContactAvatar,
    ButtonGroup,
    ModalPopup,
    ActionPanel,
    SocialIcons,
  },
  props: {
    onboarding: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      errors: {},
      updating: false,
      bucketResponse: null,
      uploadProgress: 0,
      deleteModalOpen: false,
    };
  },
  mounted() {
    window.analytics.page('Manage Profile');
  },
  methods: {
    deleteAccount() {
      console.log('deleteAccount');
      this.$notify({
        group: 'user',
        type: 'success',
        title: 'Deleting account',
        text: 'This may take a few minutes.',
      });
      //add a function to cancel users current billing plan
      //add a function to logout the user
      //redirect user to the homepage
      this.$router.push('/');
    },
    toggleDeleteModal() {
      this.deleteModalOpen = !this.deleteModalOpen;
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
        this.updateProfile();
      });
    },
    // updateAvatar(pic) {
    //   console.log('hello');
    //   this.$emit('updateContact', {
    //     id: this.contact.id,
    //     index: this.contact.index,
    //     key: 'profile_pic_url',
    //     value: pic,
    //   });
    // },
    updateProfile(pic = null) {
      let data = new FormData();
      data.append(
        'first_name',
        this.$store.state.AuthState.user.first_name ?? ''
      );
      data.append(
        'last_name',
        this.$store.state.AuthState.user.last_name ?? ''
      );
      if (pic) {
        data.append('profile_pic_url', pic);
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

<style scoped></style>
