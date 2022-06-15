<template>
  <div>
    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="flex justify-between md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-neutral-900">Password</h3>

            <p class="mt-1 text-sm text-neutral-600">Update your password</p>
          </div>

          <div class="px-4 sm:px-0"></div>
        </div>

        <div class="mt-5 md:col-span-2 md:mt-0">
          <form
            @submit.prevent="updatePassword()"
            method="post"
            enctype="multipart/form-data">
            <div
              x-data="{photoName: null, photoPreview: null}"
              class="bg-white px-4 py-5 shadow sm:rounded-tl-md sm:rounded-tr-md sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                  <InputGroup
                    v-model="$store.state.AuthState.user.first_name"
                    :error="errors?.first_name?.[0]"
                    :disabled="updating"
                    name="current_password"
                    label="Current Password"
                    placeholder="Current Password"
                    type="text" />
                </div>

                <!-- Password -->
                <div class="col-span-6 sm:col-span-4">
                  <InputGroup
                    v-model="$store.state.AuthState.user.password"
                    :error="errors?.last_name?.[0]"
                    :disabled="updating"
                    name="new_password"
                    label="New Password"
                    placeholder="New Password"
                    type="text" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                  <InputGroup
                    :value="$store.state.AuthState.user.password_confirmation"
                    :error="errors?.email?.[0]"
                    :disabled="updating"
                    name="confirm_password"
                    label="Confirm Password"
                    placeholder="Confirm Password"
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

          <!-- <CardLayout>
            <CardHeading
              title="2 Factor Authentication"
              subtitle="This is coming soon"
              buttonstyle="primary"
              buttonlink="mailto:admin@jov.ie"
              buttontext="Enable">
            </CardHeading>
          </CardLayout> -->
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
import ButtonGroup from '../../components/ButtonGroup';
import ImportService from '../../services/api/import.service';

export default {
  name: 'AccountProfile',
  components: { InputGroup, CardHeading, CardLayout, ButtonGroup },
  data() {
    return {
      errors: {},
      updating: false,
      bucketResponse: null,
      uploadProgress: 0,
    };
  },
  methods: {
    updatePassword() {
      let data = new FormData();
      data.append('first_name', this.$store.state.AuthState.user.first_name);
      data.append('last_name', this.$store.state.AuthState.user.last_name);
      if (this.bucketResponse && this.bucketResponse.uuid) {
        data.append('profile_pic_url', this.bucketResponse.uuid);
      }
      this.updating = true;
      UserService.updatePassword(data)
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
  },
};
</script>

<style scoped></style>
