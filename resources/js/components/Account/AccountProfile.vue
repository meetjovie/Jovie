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
    <div v-else class="mx-auto">
      <div class="flex flex-col space-y-16 py-12">
        <SeciontWrapper>
          <form
            class="space-y-8"
            @submit.prevent="updateProfile()"
            method="post"
            enctype="multipart/form-data">
            <div class="flex w-full items-center justify-between">
              <ContactAvatar
                :editable="true"
                :height="24"
                :contact="currentUser" />

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
              <div class="flex w-full space-x-4 px-4">
                <InputGroup
                  v-model="$store.state.AuthState.user.first_name"
                  :error="errors?.first_name?.[0]"
                  :disabled="updating"
                  name="first_name"
                  label="First Name"
                  placeholder="First Name"
                  type="text" />
                <InputGroup
                  v-model="$store.state.AuthState.user.last_name"
                  :error="errors?.last_name?.[0]"
                  :disabled="updating"
                  name="last_name"
                  label="Last Name"
                  placeholder="Last Name"
                  type="text" />
              </div>
            </div>

            <InputGroup
              :value="$store.state.AuthState.user.email"
              :error="errors?.email?.[0]"
              :disabled="true"
              name="email"
              label="Email"
              placeholder="Email"
              type="text" />

            <AccountMobile :phone="$store.state.AuthState.user.phone" />
            <!-- Title -->

            <InputGroup
              v-model="currentUser.title"
              :error="errors?.title?.[0]"
              :disabled="updating"
              name="title"
              label="Title"
              placeholder="Title"
              type="text" />

            <InputGroup
              v-model="currentUser.employer"
              :error="errors?.employer?.[0]"
              :disabled="updating"
              name="Employer"
              label="Company"
              placeholder="Company"
              type="text" />

            <ButtonGroup
              type="submit"
              design="primary"
              text="Save"
              :loading="updating"
              :disabled="updating">
            </ButtonGroup>
          </form>
        </SeciontWrapper>

        <SectionWrapper
          header="Social Handles"
          subheader="Add your social network handles.">
          <SectionHeader
            header="Social Handles"
            subheader="Add your social network handles." />
          <form
            class="space-y-8"
            @submit.prevent="updateSocialHandlers()"
            method="post"
            enctype="multipart/form-data">
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

            <ButtonGroup
              type="submit"
              design="primary"
              text="Save"
              :loading="updating"
              :disabled="updating">
            </ButtonGroup>
          </form>
        </SectionWrapper>
      </div>
    </div>
  </div>
</template>

<script>
import ActionPanel from '../../components/ActionPanel.vue';
import UserService from '../../services/api/user.service';
import InputGroup from '../../components/InputGroup.vue';
import CardHeading from '../../components/CardHeading.vue';
import CardLayout from '../../components/CardLayout.vue';
import ButtonGroup from '../../components/ButtonGroup.vue';
import ImportService from '../../services/api/import.service';
import ModalPopup from '../../components/ModalPopup.vue';
import SocialIcons from '../../components/SocialIcons.vue';
import ContactAvatar from '../ContactAvatar.vue';
import AccountMobile from './AccountMobile.vue';
import SectionHeader from '../SectionHeader.vue';

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
    SectionHeader,
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
    };
  },
  mounted() {
    window.analytics.page('Manage Profile');
  },
  methods: {
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
