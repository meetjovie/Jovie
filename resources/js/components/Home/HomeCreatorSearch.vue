<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="bg-white py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="lg:text-center">
        <h2
          class="text-base font-semibold uppercase tracking-wide text-indigo-600">
          Data
        </h2>
        <p
          class="mt-2 text-3xl font-extrabold leading-8 tracking-tight text-gray-900 sm:text-4xl">
          A better way to find creators
        </p>
        <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
          Jovie's database of
          <span class="text-indigo-500"
            >{{ store.state.creatorsDBCount }}+ creators</span
          >
          is a powerful tool for finding new prospects and building
          partnerships.
        </p>
      </div>

      <!--    <div class="mt-10">
        <dl
          class="space-y-10 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10 md:space-y-0">
          <div v-for="feature in features" :key="feature.name" class="relative">
            <dt>
              <div
                class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-indigo-500 text-white">
                <component
                  :is="feature.icon"
                  class="h-6 w-6"
                  aria-hidden="true" />
              </div>
              <p class="ml-16 text-lg font-medium leading-6 text-gray-900">
                {{ feature.name }}
              </p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500">
              {{ feature.description }}
            </dd>
          </div>
        </dl>
      </div> -->
    </div>
  </div>
</template>

<script>
import {
  AnnotationIcon,
  SearchIcon,
  LightningBoltIcon,
  ScaleIcon,
} from '@heroicons/vue/outline';

const features = [
  {
    name: 'Power search filters',
    description:
      'Within Jovie, you have the ability to search for creators not just by basic metrics like follower count & engagement, but also by more advanced properties like type contents of their photos, the sentiment of their captions, and more.',
    icon: SearchIcon,
  },
  {
    name: 'No hidden fees',
    description:
      'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.',
    icon: ScaleIcon,
  },
  {
    name: 'Web3 Ready',
    description:
      'Jovie catalogues creators ENS domains & wallet addresses when available so you can easily airdrop your next NFT or token based project.',
    icon: LightningBoltIcon,
  },
  {
    name: 'Mobile notifications',
    description:
      'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.',
    icon: AnnotationIcon,
  },
];

export default {
  setup() {
    return {
      features,
    };
  },
};
</script>
