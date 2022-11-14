<template>
  <div>
    <Head>
      <title>Jovie Social CRM | Changelog</title>
      <meta
        name="description"
        content="Jovie is always improving. Our changelog contains a record of some of the latest features & improvements the Jovie CRM & Chrome extension." />
    </Head>

    <div class="relative mb-24 overflow-hidden bg-white py-16">
      <div
        class="hidden lg:absolute lg:inset-y-0 lg:block lg:h-full lg:w-full lg:[overflow-anchor:none]">
        <div
          class="relative mx-auto h-full max-w-prose text-lg"
          aria-hidden="true">
          <svg
            class="absolute top-12 left-full translate-x-32 transform"
            width="404"
            height="384"
            fill="none"
            viewBox="0 0 404 384">
            <defs>
              <pattern
                id="74b3fd99-0a6f-4271-bef2-e80eeafdf357"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse">
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-gray-200"
                  fill="currentColor" />
              </pattern>
            </defs>
            <rect
              width="404"
              height="384"
              fill="url(#74b3fd99-0a6f-4271-bef2-e80eeafdf357)" />
          </svg>
          <svg
            class="absolute top-1/2 right-full -translate-y-1/2 -translate-x-32 transform"
            width="404"
            height="384"
            fill="none"
            viewBox="0 0 404 384">
            <defs>
              <pattern
                id="f210dbf6-a58d-4871-961e-36d5016a0f49"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse">
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-gray-200"
                  fill="currentColor" />
              </pattern>
            </defs>
            <rect
              width="404"
              height="384"
              fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)" />
          </svg>
          <svg
            class="absolute bottom-12 left-full translate-x-32 transform"
            width="404"
            height="384"
            fill="none"
            viewBox="0 0 404 384">
            <defs>
              <pattern
                id="d3eb07ae-5182-43e6-857d-35c643af9034"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse">
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-gray-200"
                  fill="currentColor" />
              </pattern>
            </defs>
            <rect
              width="404"
              height="384"
              fill="url(#d3eb07ae-5182-43e6-857d-35c643af9034)" />
          </svg>
        </div>
      </div>
      <div class="min-h-800 relative px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-prose border-b border-neutral-200 text-lg">
          <div class="py-6">
            <h1>
              <span class="block text-lg font-semibold text-indigo-600"
                >What's New:</span
              >
              <span
                class="mt-2 block text-3xl font-bold leading-8 tracking-tight text-gray-900 sm:text-4xl"
                >Jovie Changelog</span
              >
            </h1>
            <p class="mt-8 text-xl leading-8 text-gray-700">
              New updates and improvements to Jovie.
            </p>

            <div class="mt-4 flex space-x-8">
              <a href="https://twitter.com/meetjovie" class="">
                <p
                  class="cursor-pointer text-xs leading-8 text-gray-500 hover:text-indigo-500">
                  Follow us on Twitter.
                </p>
              </a>
              <router-link to="/slack-community" class="">
                <p
                  class="cursor-pointer text-xs leading-8 text-gray-500 hover:text-indigo-500">
                  Join our Slack Community for support and feedback.
                </p>
              </router-link>
            </div>
          </div>
        </div>
        <ul role="list" class="mx-auto max-w-prose divide-y divide-gray-200">
          <li
            v-for="log in logs"
            :key="log.version"
            class="mx-auto mt-6 flex px-4 py-4 text-gray-500 sm:px-0">
            <div class="w-24 text-2xs">
              <p class="text-sm font-semibold text-neutral-600">
                {{ log.version }}
              </p>
              <p>{{ log.date }}</p>
            </div>
            <div class="w-full">
              <h2 class="text-3xl font-bold tracking-tight text-neutral-800">
                {{ log.summary }}
              </h2>
              <p class="text-base font-medium text-gray-500">
                {{ log.description }}
              </p>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <HomeCTA2 />
    <HomeCTA4 />
  </div>
</template>
<script>
import { Head } from '@vueuse/head';
import HomeCTA2 from './../components/Home/HomeCTA2.vue';
import HomeCTA4 from './../components/Home/HomeCTA4.vue';

export default {
  name: 'ChangeLog',
  data() {
    return {
      logs: [
        {
          version: '0.0.1',
          date: '2022-11-07',
          summary: 'Initial release of Jovie.',
          description: 'Today we rolled out the first release of Jovie.',
        },
      ],
    };
  },
  components: {
    Head,
    HomeCTA2,
    HomeCTA4,
  },
};
</script>
