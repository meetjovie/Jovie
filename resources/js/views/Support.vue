<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="min-h-screen bg-white">
    <div class="mx-auto max-w-7xl py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
      <div class="text-center">
        <h2
          class="text-base font-semibold uppercase tracking-wide text-indigo-600">
          Support
        </h2>
        <p
          class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
          We're hear to help.
        </p>
        <p class="mx-auto mt-5 max-w-xl text-xl text-gray-500">
          <a class="text-indigo-400" href="mailto:support@jov.ie"
            >Get in touch</a
          >
          with our team.
        </p>
      </div>
    </div>
  </div>
  <JoinOurTeam />
</template>
<script setup>
import JoinOurTeam from '../components/JoinOurTeam.vue';
</script>
