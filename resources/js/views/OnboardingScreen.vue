<template>
  <div class="flex h-screen w-full items-center bg-white dark:bg-jovieDark-900">
    <OnboardingStep
      v-if="step === 1"
      header="Welcome to Jovie"
      subheader="Let's get you set up">
      <div class="space-y-6">
        <AccountProfile onboarding />
        <AccountPassword class="" onboarding />
        <ButtonGroup
          @click="step = 2"
          :loading="updating"
          text="Continue"></ButtonGroup>
      </div>
    </OnboardingStep>
    <OnboardingStep
      v-if="step === 2"
      header="How are you planning to use Jovie?"
      subheader="We'll streamline your setup experience accordingly.">
      <div class="space-y-6">
        <RadioGroup :items="items" />
        <ButtonGroup
          @click="step = 3"
          :loading="updating"
          text="Continue"></ButtonGroup>
      </div>
    </OnboardingStep>
    <OnboardingStep
      v-if="step === 3"
      header="Create a team workspace"
      subheader="Fill in some details for your teammates.">
      <div class="mt-4 space-y-6">
        <EmojiPickerModal
          xl
          class="py-4"
          @emojiSelected="emojiSelected($event, item)"
          :currentEmoji="emoji" />
        <span
          class="mt-4 text-xl font-bold text-slate-900 dark:text-jovieDark-100">
          Choose icon
        </span>

        <InputGroup
          :error="errors?.name?.[0]"
          name="workspace-name"
          label="Workspace Name"
          placeholder="Enter a Team Name" />

        <h3
          class="text-xs font-semibold text-slate-600 dark:text-jovieDark-300">
          The name of your company or organization
        </h3>

        <ButtonGroup :loading="updating" text="Continue"></ButtonGroup>
      </div>
    </OnboardingStep>
  </div>
</template>
<script>
import RadioGroup from './../components/RadioGroup.vue';
import InputGroup from '../components/InputGroup.vue';
import AccountProfile from '../components/Account/AccountProfile.vue';
import AccountPassword from '../components/Account/AccountPassword.vue';
import ButtonGroup from '../components/ButtonGroup.vue';
import EmojiPickerModal from '../components/EmojiPickerModal.vue';
import OnboardingStep from '../components/OnboardingStep.vue';
export default {
  name: 'Onboarding',
  data() {
    return {
      step: 1,
      errors: {},
      updating: false,
      emoji: '👋',
      items: [
        {
          id: 1,
          title: 'With my team',
          description: 'Collaborate with your team on a shared workspace.',
          cta: 'Try free',
        },
        {
          id: 2,
          title: 'For myself',
          description: 'Use Jovie for yourself and your personal projects.',
        },
      ],
    };
  },
  components: {
    AccountProfile,
    AccountPassword,
    OnboardingStep,
    ButtonGroup,
    InputGroup,
    EmojiPickerModal,
    RadioGroup,
  },
};
</script>
