<template>
  <div class="mx-auto w-full py-10 sm:px-6 lg:px-8">
    <SectionHeader
      header="Workspace"
      subheader="Manage your workspace settings" />
    <div class="flex w-full">
      <div class="w-full">
        <h3 class="text-base font-semibold leading-6 text-gray-900">
          Plan Usage
        </h3>

        <dl class="mt-5 grid w-full grid-cols-1 gap-5 sm:grid-cols-3">
          <div
            v-for="item in stats"
            :key="item.name"
            class="overflow-hidden rounded-lg border border-slate-300 px-4 py-5 dark:border-jovieDark-border sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">
              {{ item.name }}
            </dt>
            <ProgressBar
              :percentage="Math.round((item.stat / item.limit) * 100)" />

            <dd
              class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
              {{ item.stat }} / {{ item.limit }}
            </dd>
          </div>
        </dl>
      </div>
    </div>

    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="mt-5 md:col-span-2 md:mt-0">
        <div
          x-data="{photoName: null, photoPreview: null}"
          class="px-4 py-5 dark:bg-jovieDark-800 sm:rounded-tl-md sm:rounded-tr-md sm:p-6">
          <div class="relative flex gap-x-3">
            <!-- Password -->
            <div
              v-for="(teamSetting, index) in teamSettings"
              :key="index"
              class="flex h-6 items-center">
              <CheckboxInput
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                :checked="teamSetting.value == 1 ? true : false"
                v-model="teamSetting.value"
                :name="teamSetting.key"
                :disabled="updating" />
              <label class="font-medium text-gray-900" :for="teamSetting.key">{{
                unSlugify(teamSetting.key)
              }}</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button
        type="submit"
        @click="updateTeamSettings()"
        :disabled="updating"
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Save
      </button>
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
import StatCard from '../../components/StatCard.vue';
import TeamService from '../../services/api/team.service';
import SectionHeader from '../../components/SectionHeader.vue';
import ProgressBar from '../../components/ProgressBar.vue';

export default {
  name: 'AccountTeamSetting',
  components: {
    ButtonGroup,
    CheckboxInput,
    SectionHeader,
    StatCard,
    ProgressBar,
  },
  data() {
    return {
      errors: {},
      updating: false,
      setting: {
        key: null,
        value: null,
      },
      stats: [
        { name: 'Contacts', stat: '3', limit: '100' },
        { name: 'AI Credits', stat: '100', limit: '500' },
        { name: 'Enrichment Credits', stat: '58', limit: '100' },
        { name: 'AI Field Credits', stat: '12', limit: '100' },
      ],
      //add an object called stats and put the number of AI Credits, Enrich Credits, and Contacts used

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
