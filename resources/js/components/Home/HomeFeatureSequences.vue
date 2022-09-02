<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div id="outreach" class="overflow-hidden bg-gray-50 py-16 lg:py-24">
    <div class="relative mx-auto max-w-xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
      <svg
        class="absolute right-full hidden translate-x-1/2 translate-y-12 transform lg:block"
        width="404"
        height="784"
        fill="none"
        viewBox="0 0 404 784"
        aria-hidden="true">
        <defs>
          <pattern
            id="64e643ad-2176-4f86-b3d7-f2c5da3b6a6d"
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
          fill="url(#64e643ad-2176-4f86-b3d7-f2c5da3b6a6d)" />
      </svg>

      <div class="relative mt-12 sm:mt-16 lg:mt-24">
        <div
          class="lg:grid lg:grid-flow-row-dense lg:grid-cols-2 lg:items-center lg:gap-8">
          <div class="lg:col-start-2">
            <h3
              class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
              Creator outreach on autopilot
            </h3>
            <p class="mt-3 text-lg text-gray-500">
              Jovie allows you to build complex outreach sequences that
              dramtically increase response rates.
            </p>

            <dl class="mt-10 space-y-10">
              <div
                v-for="item in communicationFeatures"
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

          <div class="relative -mx-4 mt-10 lg:col-start-1 lg:mt-0">
            <svg
              class="absolute left-1/2 -translate-x-1/2 translate-y-16 transform lg:hidden"
              width="784"
              height="404"
              fill="none"
              viewBox="0 0 784 404"
              aria-hidden="true">
              <defs>
                <pattern
                  id="e80155a9-dfde-425a-b5ea-1f6fadd20131"
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
                fill="url(#e80155a9-dfde-425a-b5ea-1f6fadd20131)" />
            </svg>
            <img
              class="relative mx-auto"
              width="490"
              :src="asset('img/External/feature-outreach.webp')" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  ChartBarIcon,
  GlobeAltIcon,
  BoltIcon,
  EnvelopeIcon,
  ScaleIcon,
} from '@heroicons/vue/24/outline';

const transferFeatures = [
  {
    id: 1,
    name: 'Competitive exchange rates',
    description:
      'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.',
    icon: GlobeAltIcon,
  },
  {
    id: 2,
    name: 'No hidden fees',
    description:
      'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.',
    icon: ScaleIcon,
  },
  {
    id: 3,
    name: 'Transfers are instant',
    description:
      'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.',
    icon: BoltIcon,
  },
];
const communicationFeatures = [
  {
    id: 1,
    name: 'A/B testing',
    description:
      'Test multiple versions of your message to increase your response rate.',
    icon: ChartBarIcon,
  },
  {
    id: 2,
    name: 'Automatic Follow Ups',
    description:
      'Automatically reach out to creators who havent responded to your message. This feature dramtically increases your response rate.',
    icon: EnvelopeIcon,
  },
];

export default {
  setup() {
    return {
      transferFeatures,
      communicationFeatures,
    };
  },
};
</script>
