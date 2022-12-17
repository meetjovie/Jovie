<template>
  <div>
    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="flex justify-between md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3
              class="text-lg font-medium text-slate-900 dark:text-jovieDark-100">
              Password
            </h3>

            <p class="mt-1 text-sm text-slate-600 dark:text-jovieDark-300">
              Update your password
            </p>
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
              class="bg-white px-4 py-5 shadow dark:bg-jovieDark-800 sm:rounded-tl-md sm:rounded-tr-md sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                  <InputGroup
                    v-model="user.current_password"
                    :error="errors?.current_password?.[0]"
                    :disabled="updating"
                    name="current_password"
                    label="Current Password"
                    placeholder="Current Password"
                    type="password" />
                </div>

                <!-- Password -->
                <div class="col-span-6 sm:col-span-4">
                  <InputGroup
                    v-model="user.password"
                    :error="errors?.password?.[0]"
                    :disabled="updating"
                    name="new_password"
                    label="New Password"
                    placeholder="New Password"
                    type="password" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                  <InputGroup
                    v-model="user.password_confirmation"
                    :error="errors?.password?.[0]"
                    :disabled="updating"
                    name="confirm_password"
                    label="Confirm Password"
                    placeholder="Confirm Password"
                    type="password" />
                </div>
              </div>
            </div>

            <div
              class="flex items-center justify-end bg-slate-50 px-4 py-3 text-right shadow dark:bg-jovieDark-900 dark:bg-jovieDark-900 sm:rounded-bl-md sm:rounded-br-md sm:px-6">
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
          <div
            class="border-t border-slate-200 dark:border-jovieDark-border"></div>
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
      user: {
        current_password: null,
        password: null,
        password_confirmation: null,
      },
    };
  },
  mounted() {
    window.analytics.page('Manage Security');
  },
  methods: {
    updatePassword() {
      this.updating = true;
      UserService.updatePassword(this.user)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.errors = {};
            this.$notify({
              group: 'user',
              title: 'Successful',
              text: response.message,
              type: 'success',
            });
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          this.updating = false;
        });
    },
  },
};
</script>

<style scoped></style>
