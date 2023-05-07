<template>
  <div>
    <SectionHeader
      header="Workspace"
      subheader="Manage your workspace settings" />
    <SectionWrapper
      header="Plan Usage"
      :subheader="
        'You are currently on a ' +
        currentUser.current_team.current_subscription.name
      ">
      <div class="flex w-full">
        <div class="w-full">
          <dl class="mt-5 grid w-full grid-cols-1 gap-5 sm:grid-cols-3">
            <div
              v-for="item in stats"
              :key="item.name"
              class="flex flex-col justify-between space-y-4 overflow-hidden rounded-lg border border-slate-300 px-4 py-5 dark:border-jovieDark-border sm:p-6">
              <dt
                class="truncate text-sm font-medium text-slate-900 dark:text-jovieDark-100">
                {{ item.name }}
              </dt>
              <dd
                class="mt-1 text-3xl font-semibold tracking-tight text-slate-900 dark:text-jovieDark-100">
                {{ item.stat }} / {{ item.limit }}
              </dd>
              <ProgressBar
                :size="sm"
                :color="black"
                :percentage="Math.round((item.stat / item.limit) * 100)" />
              <span class="text-2xs text-slate-600">{{
                item.description
              }}</span>
            </div>
          </dl>
        </div>
      </div>
    </SectionWrapper>
  </div>
</template>

<script>
import SectionHeader from './../components/SectionHeader.vue';
import ProgressBar from './../components/ProgressBar.vue';
import SectionWrapper from './../components/SectionWrapper.vue';

export default {
  name: 'SettingsWorkspace',
  components: {
    ProgressBar,
    SectionWrapper,
    SectionHeader,
  },
  data() {
    return {
      stats: [
        {
          name: 'Contacts',
          stat: '3',
          limit: '100',
          description:
            'The number of people you can add to your CRM. This limit',
        },
        {
          name: 'AI Credits',
          stat: '100',
          limit: '500',
          description:
            'AI Credits are used when you use our AI features such as AI Feilds, or AI copywriting.',
        },
        {
          name: 'Enrichment Credits',
          stat: '58',
          limit: '100',
          description:
            'Enrichment credits are used everytime you enrich a contact.',
        },
      ],
    };
  },
};
</script>
