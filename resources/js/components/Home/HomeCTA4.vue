<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="h-80 overflow-hidden bg-purple-600 py-6 md:py-12">
    <div
      class="mx-auto -mt-24 h-[500px] w-[500px] rounded-full bg-gradient-to-b from-purple-500 via-purple-500/0 to-purple-500/0 lg:h-[1000px] lg:w-[1000px]">
      <div
        class="mx-auto max-w-2xl items-center py-16 px-4 text-center sm:py-20 sm:px-6 lg:px-8">
        <!-- <JovieLogo class="py-4" height="20" color="white" /> -->
        <h2
          class="mt-16 text-3xl font-bold tracking-tight text-white sm:mt-8 sm:text-4xl">
          <span class="block">Try Jovie today</span>
        </h2>
        <p class="mt-4 text-lg leading-6 text-white">
          Get started for free. Add your whole team as your needs grow.
        </p>
        <ButtonGroup
          design="secondary"
          text="Try Jovie free"
          class="mt-8 w-60 bg-gradient-to-r from-blue-400 to-blue-500 text-white"
          @click="signup()"
          :loading="loading">
          <svg
            class="mt-0 ml-2 -mr-1 stroke-white stroke-2"
            fill="none"
            width="10"
            height="10"
            viewBox="0 0 10 10"
            aria-hidden="true">
            <path
              class="opacity-0 transition group-hover:opacity-100"
              d="M0 5h7"></path>
            <path
              class="transition group-hover:translate-x-[3px]"
              d="M1 1l4 4-4 4"></path>
          </svg>
        </ButtonGroup>
        <p class="py-1 text-2xs text-gray-100">
          On a big team?
          <router-link class="font-bold underline" to="demo"
            >Contact sales</router-link
          >
        </p>
      </div>
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
      //send the event to segment
      window.analytics.track('Clicked Sign Up', {
        location: 'HomeCTA4',
      });
      this.loading = true;
      this.$router.push('/signup');
      this.loading = false;
    },
  },
};
</script>
