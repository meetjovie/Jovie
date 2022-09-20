<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="bg-indigo-700 py-6 md:py-12">
    <div
      class="mx-auto max-w-2xl py-16 px-4 text-center sm:py-20 sm:px-6 lg:px-8">
      <!-- <JovieLogo class="py-4" height="20" color="white" /> -->
      <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
        <span class="block">Try Jovie today</span>
      </h2>
      <p class="mt-4 text-lg leading-6 text-indigo-200">
        Get started for free. Add your whole team as your needs grow.
      </p>
      <ButtonGroup
        design="secondary"
        text="Try Jovie free"
        class="mt-8 w-60"
        @click="signup()"
        :loading="loading"
        >Try Jovie free</ButtonGroup
      >
      <p class="py-1 text-2xs text-neutral-100">
        On a big team?
        <router-link class="font-bold underline" to="demo"
          >Contact sales</router-link
        >
      </p>
    </div>
  </div>
</template>
<script>
import JovieLogo from '../../components/JovieLogo';
import ButtonGroup from '../../components/ButtonGroup';
export default {
  components: {
    JovieLogo,
    ButtonGroup,
  },
  data() {
    return {
      loading: false,
    };
  },
  methods: {
    signup() {
      this.loading = true;
      this.$router.push('/signup');
      this.loading = false;
    },
  },
};
</script>
