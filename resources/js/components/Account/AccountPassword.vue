<template>
  <div>
    <div v-if="onboarding">
      <!-- Name -->

      <!-- Password -->
      <div class="col-span-6 sm:col-span-4" v-if="!currentUser.password_set">
        <InputGroup
          @blur="setPassword()"
          v-model="user.password"
          :error="errors?.password?.[0]"
          :disabled="updating"
          passwordRevealToggle
          name="set_password"
          label="Set Password"
          placeholder="Enter a Password" />
      </div>
    </div>

    <div v-else class="">
      <form
        @submit.prevent="updatePassword()"
        method="post"
        enctype="multipart/form-data">
        <div class="flex flex-col space-y-4">
          <!-- Name -->

          <InputGroup
            v-model="user.current_password"
            :error="errors?.current_password?.[0]"
            :disabled="updating"
            name="current_password"
            label="Current Password"
            placeholder="Current Password"
            type="password" />

          <InputGroup
            v-model="user.password"
            :error="errors?.password?.[0]"
            :disabled="updating"
            name="new_password"
            label="New Password"
            placeholder="New Password"
            type="password" />
          <InputGroup
            v-model="user.password_confirmation"
            :error="errors?.password?.[0]"
            :disabled="updating"
            name="confirm_password"
            label="Confirm Password"
            placeholder="Confirm Password"
            type="password" />

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
</template>

<script>
import UserService from '../../services/api/user.service';
import InputGroup from '../../components/InputGroup.vue';
import CardHeading from '../CardHeading.vue';
import CardLayout from '../../components/CardLayout.vue';
import ButtonGroup from '../../components/ButtonGroup.vue';
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
  props: {
    onboarding: {
      type: Boolean,
      default: false,
    },
  },
  mounted() {
    window.analytics.page('Manage Security');
  },
  methods: {
    setPassword() {
      this.updating = true;
      UserService.setPassword(this.user)
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
