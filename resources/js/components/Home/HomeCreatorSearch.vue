<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="bg-white py-12">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
      <div class="mt-10">
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
              <p class="ml-16 text-sm font-medium leading-6 text-gray-900">
                {{ feature.name }}
              </p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500">
              {{ feature.description }}
            </dd>
          </div>
        </dl>
      </div>
    </div>
  </div>
</template>

<script>
import {
  AnnotationIcon,
  MagnifyingGlassIcon,
  BoltIcon,
  ScaleIcon,
} from '@heroicons/vue/24/outline';

const features = [
  {
    name: 'Data Enrichment',
    description:
      'Upload your existing customer lists and instantly enrich your data.  Pay only for matched profiles.',
    icon: MagnifyingGlassIcon,
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
    icon: BoltIcon,
  },
  {
    name: 'Mobile notifications',
    description:
      'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.',
    icon: AnnotationIcon,
  },
];
import JovieLogo from '@/components/JovieLogo.vue';
export default {
  components: {
    JovieLogo,
  },
  setup() {
    return {
      features,
    };
  },
};
</script>
