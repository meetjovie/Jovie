<template>
  <div class="flex h-screen w-full items-center bg-white dark:bg-jovieDark-900">
    <div
      v-if="step === 1"
      class="mx-auto flex h-full max-w-7xl flex-col justify-center space-y-6 py-12 text-center font-bold text-slate-600 dark:text-jovieDark-200">
      <h1 class="text-4xl font-bold text-slate-900 dark:text-jovieDark-100">
        Welcome to Jovie
      </h1>

      <h2 class="text-xl font-bold text-slate-900 dark:text-jovieDark-100">
        Let's get you set up
      </h2>
      <AccountProfile onboarding />
      <AccountPassword class="" onboarding />
      <ButtonGroup
        @click="step = 2"
        :disabled="
          !$store.state.AuthState.user.first_name ||
          !$store.state.AuthState.user.last_name ||
          !$store.state.AuthState.user.password
        "
        :loading="updating"
        text="Continue"></ButtonGroup>
    </div>
    <div
      v-if="step === 1"
      class="mx-auto flex h-full max-w-5xl flex-col justify-center space-y-6 text-center font-bold text-slate-600 dark:text-jovieDark-200">
      <h1 class="text-4xl font-bold text-slate-900 dark:text-jovieDark-100">
        How are you planning to use Jovie?
      </h1>

      <h2 class="text-xl font-bold text-slate-900 dark:text-jovieDark-100">
        We'll streamline your setup experience accordingly.
      </h2>
      <div class="mx-auto text-center">
        <RadioGroup :items="items" />
      </div>

      <ButtonGroup :loading="updating" text="Continue"></ButtonGroup>
    </div>
    <div
      v-if="step === 1"
      class="mx-auto flex h-full max-w-7xl flex-col justify-center space-y-6 text-center font-bold text-slate-600 dark:text-jovieDark-200">
      <h1 class="text-4xl font-bold text-slate-900 dark:text-jovieDark-100">
        Create a team workspace
      </h1>

      <h2 class="text-xl font-bold text-slate-900 dark:text-jovieDark-100">
        Fill in some details for your teammates.
      </h2>
      <EmojiPickerModa xl />
      <span class="text-2xl font-bold text-slate-900 dark:text-jovieDark-100">
        Choose icon
      </span>

      <InputGroup
        icon="CheckCircleIcon"
        :error="errors?.name?.[0]"
        name="workspace-name"
        label="Workspace Name"
        placeholder="Enter a Team Name" />

      <ButtonGroup :loading="updating" text="Continue"></ButtonGroup>
    </div>
  </div>
</template>
<script>
import RadioGroup from './../components/RadioGroup.vue';
import InputGroup from '../components/InputGroup.vue';
import AccountProfile from '../components/Account/AccountProfile.vue';
import AccountPassword from '../components/Account/AccountPassword.vue';
import ButtonGroup from '../components/ButtonGroup.vue';
import EmojiPickerModal from '../components/EmojiPickerModal.vue';
export default {
  name: 'Onboarding',
  data() {
    return {
      step: 1,
      errors: {},
      updating: false,
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
    ButtonGroup,
    InputGroup,
    EmojiPickerModal,
    RadioGroup,
  },
};
</script>
