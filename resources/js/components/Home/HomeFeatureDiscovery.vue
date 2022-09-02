<template>
  <div id="outreach" class="overflow-hidden bg-gray-50 py-16 lg:py-24">
    <div class="relative mx-auto max-w-xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
      <svg
        class="absolute left-full hidden -translate-x-1/2 -translate-y-1/4 transform lg:block"
        width="404"
        height="784"
        fill="none"
        viewBox="0 0 404 784"
        aria-hidden="true">
        <defs>
          <pattern
            id="b1e6e422-73f8-40a6-b5d9-c8586e37e0e7"
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
          height="784"
          fill="url(#b1e6e422-73f8-40a6-b5d9-c8586e37e0e7)" />
      </svg>

      <div class="relative">
        <h2
          class="text-center text-3xl font-extrabold leading-8 tracking-tight text-gray-900 sm:text-4xl">
          Creator search
        </h2>
        <p class="mx-auto mt-4 max-w-3xl text-center text-xl text-gray-500">
          Jovie's built-in prospecting tool lets you find ideal creators and add
          them to your pipeline. Every contact has accurate contact information,
          social engagement metrics, & a unified profile showing their content
          accross all platforms.
        </p>
      </div>

      <div
        class="relative mt-12 lg:mt-24 lg:grid lg:grid-cols-2 lg:items-center lg:gap-8">
        <div class="relative">
          <h3
            class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
            Transfer funds world-wide
          </h3>
          <p class="mt-3 text-lg text-gray-500">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur
            minima sequi recusandae, porro maiores officia assumenda aliquam
            laborum ab aliquid veritatis impedit odit adipisci optio iste
            blanditiis facere. Totam, velit.
          </p>

          <dl class="mt-10 space-y-10">
            <div
              v-for="item in transferFeatures"
              :key="item.id"
              class="relative">
              <dt>
                <div
                  class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-indigo-500 text-white">
                  <component
                    :is="item.icon"
                    class="h-6 w-6"
                    aria-hidden="true" />
                </div>
                <p class="ml-16 text-lg font-medium leading-6 text-gray-900">
                  {{ item.name }}
                </p>
              </dt>
              <dd class="mt-2 ml-16 text-base text-gray-500">
                {{ item.description }}
              </dd>
            </div>
          </dl>
        </div>

        <div class="relative -mx-4 mt-10 lg:mt-0" aria-hidden="true">
          <svg
            class="absolute left-1/2 -translate-x-1/2 translate-y-16 transform lg:hidden"
            width="784"
            height="404"
            fill="none"
            viewBox="0 0 784 404">
            <defs>
              <pattern
                id="ca9667ae-9f92-4be7-abcb-9e3d727f2941"
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
              width="784"
              height="404"
              fill="url(#ca9667ae-9f92-4be7-abcb-9e3d727f2941)" />
          </svg>
          <img
            class="relative mx-auto"
            width="490"
            src="https://tailwindui.com/img/features/feature-example-1.png"
            alt="" />
        </div>
      </div>
    </div>
  </div>

  <div
    class="grid grid-cols-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 px-8 backdrop-blur-xl backdrop-saturate-150">
    <div
      class="mx-auto max-w-4xl px-4 py-16 sm:px-6 sm:pt-20 sm:pb-24 lg:max-w-7xl lg:px-8 lg:pt-24">
      <h2 class="text-3xl font-extrabold tracking-tight text-white">
        Disocver creators with AI
      </h2>
      <p class="mt-4 max-w-3xl text-lg text-indigo-200">
        Find <span class="text-neutral-100">highly relevant</span> and
        <span class="text-neutral-100">influential creators</span> in seconds...
      </p>
      <div
        class="mt-12 grid grid-cols-2 gap-x-6 gap-y-12 lg:mt-16 lg:gap-x-8 lg:gap-y-8">
        <!--  <div v-for="feature in features" :key="feature.name" class="col-span-1">
          <div class="mt-6">
            <h3 class="text-sm font-medium text-white">{{ feature.name }}</h3>
            <p class="mt-2 text-xs text-indigo-100">
              {{ feature.description }}
            </p>
          </div>
        </div> -->
      </div>
    </div>
    <div class="items-center py-8">
      <img :src="asset('img/sun.webp')" alt="" />
      <div
        class="bg-saturate-150 mx-auto rounded-lg bg-white/90 py-4 px-4 text-center text-lg font-bold text-gray-800 shadow-xl backdrop-blur-xl">
        Find
        <span
          class="px-1 text-neutral-900 underline decoration-pink-600 decoration-4"
          >female</span
        >
        <span class="underline decoration-amber-600 decoration-4"
          >micro-influencers</span
        >
        wearing
        <span
          class="px-1 text-neutral-900 underline decoration-sky-600 decoration-4"
          >sunglasses</span
        >
      </div>
    </div>
  </div>
</template>
<script>
import {
  ChatAltIcon,
  DocumentReportIcon,
  HeartIcon,
  InboxIcon,
  PencilIcon,
  ArrowUTurnLeftIcon,
  TrashIcon,
  UsersIcon,
} from '@heroicons/vue/24/outline';

export default {
  name: 'HomeFeatureDiscovery',
  components: {
    ChatAltIcon,
    DocumentReportIcon,
    HeartIcon,
    InboxIcon,
    PencilIcon,
    ArrowUTurnLeftIcon,
    TrashIcon,
    UsersIcon,
  },

  data() {
    return {
      features: [
        {
          name: 'Discover creators by the products they use',
          description:
            'Jovie can see if a creator is wearing glass, holding an iPhone, or riding a skateboard. ',
          icon: InboxIcon,
        },
        {
          name: 'Identify Brands within content',
          description:
            'Search for Starbucks logos in Tiktok videos, or people wearing Prada on Instagram.',
          icon: UsersIcon,
        },
        {
          name: 'Brand Saftey',
          description:
            'Jovie can identify & restrict creators who post content that may not be suitable for your brand. ',
          icon: TrashIcon,
        },
        {
          name: 'Exclusion',
          description:
            'Jovie can check to make creators you partner with have never promoted a competing product.',
          icon: PencilIcon,
        },
      ],
    };
  },
};
</script>
