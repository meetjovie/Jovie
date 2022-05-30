<template>
  <body class="main py-16">
    <div
      class="flex flex-col justify-between px-4 md:flex-row md:items-center xl:container xl:mx-auto">
      <div class="mb-8 w-full pr-0 md:w-1/2 md:pr-4 lg:mb-0 lg:pr-0 xl:w-1/3">
        <h1
          class="pr-16 text-2xl font-bold text-gray-700 md:text-4xl lg:pr-0 xl:text-5xl">
          Meet Jovie
        </h1>
        <p
          class="mt-4 w-full pr-0 text-base leading-normal text-gray-500 lg:w-10/12 lg:pr-16 xl:w-96 xl:pr-0">
          We believe every company can benefit from partnering with
          <span class="font-bold">creators</span>. We're building the tools to
          make those relationships effortless.
        </p>

        <button
          class="mt-6 flex w-full items-start justify-center rounded bg-indigo-500 px-8 py-4 text-center text-base font-medium leading-none text-white hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2 sm:w-auto sm:justify-start">
          Join us
        </button>
      </div>
      <div class="md:w-1/2">
        <div class="h-auto w-full justify-between sm:flex">
          <div class="relative hidden h-48 rounded sm:block md:h-64 lg:h-72">
            <img
              class="inset-0 h-full w-full rounded object-cover object-top sm:w-72 xl:object-center"
              :src="asset('img/External/timwhite.webp')"
              alt="Display Picture of Tim White"
              role="img" />
            <div class="absolute left-0 bottom-0 rounded-tr bg-white px-6 py-4">
              <h5 class="mb-2 text-base leading-none text-gray-800">Tim</h5>
              <p class="text-base font-semibold leading-none text-gray-600">
                Founder
              </p>
            </div>
          </div>
          <div
            class="relative mt-4 hidden h-48 rounded sm:ml-6 sm:mt-0 sm:block md:h-64 lg:h-72">
            <img
              class="inset-0 h-full w-full rounded object-cover object-center"
              :src="asset('img/External/Mackenzie_Moore.webp')"
              alt="Display Picture of Mackenzie"
              role="img" />
            <div class="absolute left-0 bottom-0 rounded-tr bg-white px-6 py-4">
              <h5 class="mb-2 text-base leading-none text-gray-800">
                Mackenzie
              </h5>
              <p class="text-base font-semibold leading-none text-gray-600">
                Operations
              </p>
            </div>
          </div>
          <div
            class="relative block h-full w-10/12 rounded sm:hidden sm:w-auto">
            <img
              class="h-full w-full rounded object-cover object-top xl:object-center"
              :src="asset('img/External/timwhite.webp')"
              alt="Display Picture of Tim"
              role="img" />
            <div class="absolute left-0 bottom-0 rounded-tr bg-white px-6 py-4">
              <h5 class="mb-2 text-base leading-none text-gray-800">Tim</h5>
              <p class="text-base font-semibold leading-none text-gray-600">
                Founder
              </p>
            </div>
          </div>
          <div
            class="relative mt-4 block h-full w-10/12 rounded sm:ml-6 sm:mt-0 sm:hidden sm:w-auto">
            <img
              class="h-full w-full rounded object-cover object-center"
              :src="asset('img/External/Mackenzie_Moore.webp')"
              alt="Display Picture of Mackenzie"
              role="img" />
            <div class="absolute left-0 bottom-0 rounded-tr bg-white px-6 py-4">
              <h5 class="mb-2 text-base leading-none text-gray-800">
                Mackenzie
              </h5>
              <p class="text-base font-semibold leading-none text-gray-600">
                Operations
              </p>
            </div>
          </div>
        </div>
        <div class="relative mt-6 hidden h-48 rounded sm:block md:h-64 lg:h-72">
          <img
            class="absolute inset-0 h-full w-full rounded object-cover object-center"
            :src="asset('img/External/based_in_la.webp')"
            alt="Based in LA"
            role="img" />
          <div class="absolute left-0 bottom-0 rounded-tr bg-white px-6 py-4">
            <h5 class="mb-2 text-base leading-none text-gray-800">Based in</h5>
            <p class="text-base font-semibold leading-none text-gray-600">
              Los Angeles
            </p>
          </div>
        </div>
        <div
          class="relative mt-6 block h-72 w-10/12 rounded sm:hidden sm:w-auto">
          <img
            class="absolute inset-0 h-full w-full rounded object-cover object-center"
            :src="asset('img/External/based_in_la.webp')"
            alt="A group of four people"
            role="img" />
          <div class="absolute left-0 bottom-0 rounded-tr bg-white px-6 py-4">
            <h5 class="mb-2 text-base leading-none text-gray-800">Based in</h5>
            <p class="text-base font-semibold leading-none text-gray-600">
              Los Angeles
            </p>
          </div>
        </div>
      </div>
    </div>

    <JoinOurTeam />
  </body>
</template>
<script setup>
import ButtonGroup from '../components/ButtonGroup.vue';
import JoinOurTeam from '../components/External/JoinOurTeam.vue';
import OurTeam from '../components/External/OurTeam.vue';
</script>
