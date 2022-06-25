<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div>
    <div class="relative overflow-hidden bg-gray-50 pt-16 sm:pt-24 lg:pt-32">
      <div
        class="mx-auto max-w-md px-4 text-center sm:max-w-3xl sm:px-6 lg:max-w-7xl lg:px-8">
        <div>
          <h2
            class="text-base font-semibold uppercase tracking-wider text-indigo-600">
            Social CRM
          </h2>
          <p
            class="mt-2 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            Manage creator partnerships at scale
          </p>
          <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
            Jovie makes it easy to manage creator relationships by bringing
            social data into the workflows you’re used to.
          </p>
        </div>
        <div class="mt-12 -mb-10 sm:-mb-24 lg:-mb-80">
          <img
            class="rounded-lg shadow-xl ring-1 ring-black ring-opacity-5"
            :src="asset('img/External/HomeFeatureCRM.webp')"
            alt="" />
        </div>
      </div>
    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->

    <div class="bg-white py-12">
      <div class="mx-auto max-w-xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="sr-only">A better way to send money.</h2>
        <dl class="space-y-10 lg:grid lg:grid-cols-3 lg:gap-8 lg:space-y-0">
          <div v-for="feature in features" :key="feature.name">
            <dt>
              <div
                class="flex h-12 w-12 items-center justify-center rounded-md text-indigo-500">
                <component
                  :is="feature.icon"
                  class="h-6 w-6"
                  aria-hidden="true" />
              </div>

              <p class="mt-5 text-lg font-medium leading-6 text-gray-900">
                {{ feature.name
                }}<CreatorTags
                  v-if="feature.tag"
                  :color="feature.color"
                  :showX="false"
                  size="xs"
                  class="ml-1"
                  :text="feature.tag" />
              </p>
            </dt>
            <dd class="mt-2 text-base text-gray-500">
              {{ feature.description }}
            </dd>
          </div>
        </dl>
      </div>
    </div>
  </div>
</template>

<script setup>
import {
  GlobeAltIcon,
  LightningBoltIcon,
  RefreshIcon,
  UserGroupIcon,
} from '@heroicons/vue/outline';
import CreatorTags from '../components/Creator/CreatorTags.vue';

const features = [
  {
    name: 'Competitive exchange rates',
    description:
      'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.',
    icon: GlobeAltIcon,
  },
  {
    name: 'Automated lead research',
    tag: 'Coming Soon',
    color: 'indigo',
    description:
      "Simply click “request contact info” we will automatically start searching for contact info. When the results are added right they're automatically available in your CRM.",
    icon: RefreshIcon,
  },
  {
    name: 'Team collaboration',
    description:
      'Jovie Team licenses allow you to work with your team and leave comments directly on creators.',
    icon: UserGroupIcon,
  },
];
</script>
<script>
export default {
  mounted() {
    //add segment analytics
    window.analytics.page(this.$route.path);
  },
};
</script>
