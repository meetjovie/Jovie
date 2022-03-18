<template>
  <div>
    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="flex justify-between md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-neutral-900">
              Profile Information
            </h3>

            <p class="mt-1 text-sm text-neutral-600">
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
              <button
                type="submit"
                :disabled="updating"
                class="inline-flex items-center rounded-md border border-transparent bg-neutral-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-neutral-700 focus-visible:border-neutral-900 focus-visible:outline-none focus-visible:ring focus-visible:ring-neutral-300 active:bg-neutral-900 disabled:opacity-25">
                Save
              </button>
            </div>
          </form>

          <CardLayout>
            <CardHeading
              title="Manage Subscription"
              subtitle="You can change your plan at any time."
              buttontext="Delete"
              buttocolor="red" />
          </CardLayout>
          <CardLayout>
            <CardHeading
              title="Delete Account"
              subtitle="This is permanent and cannot be undone.">
              <ButtonGroup icon="BanIcon" text="hi" />
            </CardHeading>
          </CardLayout>
        </div>
      </div>

      <div class="hidden sm:block">
        <div class="py-8">
          <div class="border-t border-neutral-200"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import UserService from '../../services/api/user.service';
import InputGroup from '../../components/InputGroup';
import CardHeading from '../../components/CardHeading';
import CardLayout from '../../components/CardLayout';

export default {
  name: 'AccountProfile',
  components: { InputGroup, CardHeading, CardLayout },
  data() {
    return {
      errors: {},
      updating: false,
    };
  },
  methods: {
    fileChanged(e) {
      const src = URL.createObjectURL(e.target.files[0]);
      this.$refs.profile_pic_url_img.src = src;
    },
    updateProfile() {
      let data = new FormData();
      data.append('first_name', this.$store.state.AuthState.user.first_name);
      data.append('last_name', this.$store.state.AuthState.user.last_name);
      if (this.$refs.profile_pic_url.files.length) {
        data.append('profile_pic_url', this.$refs.profile_pic_url.files[0]);
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
