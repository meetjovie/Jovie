<template>
  <div>
    <SectionHeader
      header="Workspace"
      subheader="Manage your workspace settings" />
    <SectionWrapper
      callToAction="Upgrade plan"
      header="Plan Usage"
      :subheader="
        'You are currently on a ' +
        currentUser.current_team.current_subscription.name
      "
      ctaLink="/plan">
      <DataStatCards :stats="stats" />
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
        <ButtonGroup
          text="update"
          @click="updateTeam({ name: currentUser.current_team.name })" />
      </div>
    </SectionWrapper>
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
  </div>
</template>

<script>
import DataStatCards from './../components/DataStatCards.vue';
import EmojiPickerModal from './../components/EmojiPickerModal.vue';
import SectionHeader from './../components/SectionHeader.vue';
import SectionWrapper from './../components/SectionWrapper.vue';
import InputGroup from './../components/InputGroup.vue';
import ButtonGroup from './../components/ButtonGroup.vue';
import TeamService from '../services/api/team.service';
import userService from '../services/api/user.service';
export default {
  name: 'SettingsWorkspace',
  components: {
    DataStatCards,
    SectionWrapper,
    SectionHeader,
    EmojiPickerModal,
    InputGroup,
    ButtonGroup,
  },
  data() {
    return {
      stats: null,
    };
  },
  mounted() {
    this.getSubscriptionStats();
  },
  methods: {
    getSubscriptionStats() {
      userService
        .subscriptionStats()
        .then((response) => {
          response = response.data.data;
          this.stats = response;
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          console.log('fetched');
        });
    },
    emojiSelected(emoji) {
      this.currentUser.current_team.emoji = emoji;
      this.updateTeam({ emoji: emoji });
    },
    updateTeam(data) {
      TeamService.updateTeam(data, this.currentUser.current_team.id)
        .then((response) => {
          response = response.data;
          console.log(response);
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          console.log('fetched');
        });
    },
  },
};
</script>
