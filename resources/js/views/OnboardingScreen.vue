<template>
  <div class="flex h-screen w-full items-center bg-white dark:bg-jovieDark-900">
    <div
      v-if="step === 1"
      class="mx-auto flex h-full max-w-7xl flex-col space-y-6 py-12 text-center font-bold text-slate-600 dark:text-jovieDark-200">
      <h1 class="text-4xl font-bold text-slate-900 dark:text-jovieDark-100">
        Welcome to Jovie
      </h1>

      <h2 class="text-xl font-bold text-slate-900 dark:text-jovieDark-100">
        Let's get you set up
      </h2>
      <AccountProfile onboarding />
      <AccountPassword class="" onboarding />
      <ButtonGroup :loading="updating" text="Continue"></ButtonGroup>
    </div>
    <div
      v-if="step === 1"
      class="mx-auto flex h-full max-w-7xl flex-col space-y-6 py-12 text-center font-bold text-slate-600 dark:text-jovieDark-200">
      <h1 class="text-4xl font-bold text-slate-900 dark:text-jovieDark-100">
        Create a team workspace
      </h1>

      <h2 class="text-xl font-bold text-slate-900 dark:text-jovieDark-100">
        Fill in some details for your teammates.
      </h2>
      <InputGroup
        v-model="team.name"
        :error="errors?.name?.[0]"
        name="name"
        label="Workspace Name"
        placeholder="Enter a Team Name" />

      <ButtonGroup :loading="updating" text="Continue"></ButtonGroup>
    </div>
  </div>
</template>
<script>
import InputGroup from '../components/InputGroup.vue';
import AccountProfile from '../components/Account/AccountProfile.vue';
import AccountPassword from '../components/Account/AccountPassword.vue';
import ButtonGroup from '../components/ButtonGroup.vue';
export default {
  name: 'Account',
  data() {
    return {
      step: 1,
      errors: {},
      updating: false,
    };
  },
  components: {
    AccountProfile,
    AccountPassword,
    ButtonGroup,
    InputGroup,
  },
};
</script>
