<template>
  <div class="bg-gray-100">
    <div class="container mx-auto flex flex-col items-center py-12 sm:py-24">
      <div class="mb-5 w-11/12 sm:mb-10 sm:w-2/3">
        <h1
          class="text-center text-2xl font-extrabold text-gray-700 sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl">
          Our
          <span class="text-indigo-600">Data</span>
        </h1>
        <p
          class="mt-5 text-center text-lg font-normal text-gray-600 sm:mt-10 sm:text-lg">
          Jovie aggregates data from around the web.
        </p>
      </div>
      <div class="flex items-center justify-center">
        <ButtonGroup text="Get started" />
      </div>
    </div>
    <HomeCTA />
  </div>
</template>
<script setup>
import ButtonGroup from '../components/ButtonGroup.vue';
import HomeCTA from '../components/Home/HomeCTA.vue';
</script>
