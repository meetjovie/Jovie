<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="bg-indigo-700">
    <div
      class="mx-auto max-w-2xl py-16 px-4 text-center sm:py-20 sm:px-6 lg:px-8">
      <!-- <JovieLogo class="py-4" height="20" color="white" /> -->
      <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
        <span class="block">Try Jovie today</span>
      </h2>
      <p class="mt-4 text-lg leading-6 text-indigo-200">
        <span class="block">Get started for free.</span>
        Add your whole team as your needs grow.
      </p>
      <router-link
        to="/signup"
        class="mt-8 inline-flex w-full items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-indigo-600 hover:bg-indigo-50 sm:w-auto"
        >Try Jovie free</router-link
      >
      <p class="text-2xs text-neutral-200">
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
export default {
  components: {
    JovieLogo,
  },
};
</script>
