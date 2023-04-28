<template>
  <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="flex justify-between md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3
            class="text-lg font-medium text-slate-900 dark:text-jovieDark-100">
            Team Settings
          </h3>

          <p class="mt-1 text-sm text-slate-600 dark:text-jovieDark-300">
            Update your team preferences
          </p>
        </div>

        <div class="px-4 sm:px-0"></div>
      </div>

      <div class="mt-5 md:col-span-2 md:mt-0">
        <div
          x-data="{photoName: null, photoPreview: null}"
          class="bg-white px-4 py-5 shadow dark:bg-jovieDark-800 sm:rounded-tl-md sm:rounded-tr-md sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <!-- Password -->
            <div
              v-for="(teamSetting, index) in teamSettings"
              :key="index"
              class="col-span-6 sm:col-span-4">
              <CheckboxInput
                :checked="teamSetting.value == 1 ? true : false"
                v-model="teamSetting.value"
                :name="teamSetting.key"
                :disabled="updating" />
              <label :for="teamSetting.key">{{ unSlugify(teamSetting.key) }}</label>
            </div>
          </div>
        </div>

        <div
          class="flex items-center justify-end bg-slate-50 px-4 py-3 text-right shadow dark:bg-jovieDark-900 dark:bg-jovieDark-900 sm:rounded-bl-md sm:rounded-br-md sm:px-6">
          <ButtonGroup
            type="submit"
            design="primary"
            text="Save"
            @click="updateTeamSettings()"
            :disabled="updating">
          </ButtonGroup>
        </div>
      </div>
    </div>

    <div class="hidden sm:block">
      <div class="py-8">
        <div
          class="border-t border-slate-200 dark:border-jovieDark-border"></div>
      </div>
    </div>
  </div>
</template>

<script>
import CheckboxInput from '../CheckboxInput.vue';
import ButtonGroup from '../../components/ButtonGroup.vue';
import TeamService from '../../services/api/team.service';

export default {
  name: 'AccountTeamSetting',
  components: {
    ButtonGroup,
    CheckboxInput,
  },
  data() {
    return {
      errors: {},
      updating: false,
      setting: {
        key: null,
        value: null,
      },
      teamSettings: {},
    };
  },
  props: {
    onboarding: {
      type: Boolean,
      default: false,
    },
  },
  mounted() {
    this.getTeamSettings();
    window.analytics.page('Manage Security');
  },
  methods: {
    getTeamSettings() {
      TeamService.getTeamSetting()
        .then((response) => {
          response = response.data;
          this.teamSettings = response.data;
          console.log('TeamSetting', response);
          if (response.status) {
            this.errors = {};
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
    updateTeamSettings() {
      this.updating = true;
      let data = { teamSettings: this.teamSettings };
      TeamService.updateTeamSettings(data)
        .then((response) => {
          response = response.data;
          this.TeamSettings = response.data;
          console.log('UpdateSetting', response);
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
