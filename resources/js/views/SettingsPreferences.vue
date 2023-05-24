<template>
  <div>
    <SectionHeader header="Preferences" />
    <div v-for="(teamSetting, key) in teamSettings" :key="index">
      <SectionWrapper
        v-if="teamSetting.type == 'radio'"
        :header="toTitleCase(unSlugify(key))"
        :subheader="teamSetting.description">
        <CheckboxInput
          :checked="teamSetting.value == 1 ? true : false"
          v-model="teamSetting.value"
          :name="key"
          :disabled="updating" />
        <label :for="key">{{
          teamSetting.value == 1 ? 'Disable' : 'Enable'
        }}</label>
      </SectionWrapper>
      <SectionWrapper
        v-else
        :header="toTitleCase(unSlugify(key))"
        :subheader="teamSetting.description">
        <TextAreaInput v-model="teamSetting.value" />
      </SectionWrapper>
    </div>

    <div
      class="flex items-center justify-end text-right shadow dark:bg-jovieDark-900 dark:bg-jovieDark-900 sm:rounded-bl-md sm:rounded-br-md sm:px-6">
      <ButtonGroup
        type="submit"
        design="primary"
        text="Save"
        @click="updateTeamSettings()"
        :disabled="updating">
      </ButtonGroup>
    </div>
  </div>
</template>
<script>
import SectionHeader from '../components/SectionHeader.vue';
import SectionWrapper from '../components/SectionWrapper.vue';

import TextAreaInput from '../components/TextAreaInput.vue';
import CheckboxInput from '../components/CheckboxInput.vue';
import TeamService from '../services/api/team.service';
import ButtonGroup from '../components/ButtonGroup.vue';

export default {
  components: {
    ButtonGroup,
    CheckboxInput,
    TextAreaInput,
    SectionHeader,
    SectionWrapper,
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
  mounted() {
    this.getTeamSettings();
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
