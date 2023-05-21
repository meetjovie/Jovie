<template>
  <div>
    <SectionHeader
      header="Workspace"
      subheader="Manage your workspace settings" />
    <SectionWrapper header="Team" :subheader="'Emoji'">
      <div class="">
        <EmojiPickerModal
          xl
          class="py-8"
          @emojiSelected="emojiSelected($event)"
          :currentEmoji="this.currentUser.current_team.emoji" />
      </div>
      <div class="font-base text-sm text-slate-600 dark:text-jovieDark-300">
        Pick an emoji for your workspace
      </div>
    </SectionWrapper>
    <SectionWrapper header="General">
      <div class="md:w-1/2">
        <InputGroup
          class="py-8"
          :error="errors?.name?.[0]"
          name="workspace-name"
          label="Workspace Name"
          v-model="currentUser.current_team.name"
          placeholder="Enter a Team Name" />
        <ButtonGroup text="update" />
      </div>
    </SectionWrapper>
    <SectionWrapper
      header="Plan Usage"
      :subheader="
        'You are currently on a ' +
        currentUser.current_team.current_subscription.name
      ">
      <DataStatCards :stats="stats" />
    </SectionWrapper>
  </div>
</template>

<script>
import DataStatCards from './../components/DataStatCards.vue';
import EmojiPickerModal from './../components/EmojiPickerModal.vue';
import SectionHeader from './../components/SectionHeader.vue';
import ProgressBar from './../components/ProgressBar.vue';
import SectionWrapper from './../components/SectionWrapper.vue';
import InputGroup from './../components/InputGroup.vue';
import ButtonGroup from './../components/ButtonGroup.vue';

export default {
  name: 'SettingsWorkspace',
  components: {
    DataStatCards,
    ProgressBar,
    SectionWrapper,
    SectionHeader,
    EmojiPickerModal,
    InputGroup,
    ButtonGroup,
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
