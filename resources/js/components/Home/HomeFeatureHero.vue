<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="relative overflow-hidden bg-white pt-16 pb-32">
    <div class="relative">
      <div
        class="lg:mx-auto lg:grid lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2 lg:gap-24 lg:px-8">
        <div
          class="mx-auto max-w-xl px-4 sm:px-6 lg:mx-0 lg:max-w-none lg:py-16 lg:px-0">
          <div>
            <div>
              <span
                class="flex h-12 w-12 items-center justify-center rounded-md bg-indigo-600">
                <LightningBoltIcon
                  class="h-6 w-6 text-white"
                  aria-hidden="true" />
              </span>
            </div>
            <div class="mt-6">
              <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                Fast. Reliable. Creator Search.
              </h2>
              <p class="mt-4 text-lg text-gray-500">
                Jovie is built for speed. Our creator search engine analyzes
                millions of records in under 1/10th of a second.
              </p>
              <div class="mt-6">
                <router-link
                  to="signup"
                  class="inline-flex rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
                  Get started
                </router-link>
              </div>
            </div>
          </div>
          <div class="mt-8 border-t border-gray-200 pt-6">
            <blockquote>
              <div>
                <p class="text-base text-gray-500">
                  &ldquo;Thanks to Jovie, software is no longer a bottleneck in
                  my workflow. The search feels instantaneous and the keyboard
                  shortcuts are a game changer.&rdquo;
                </p>
              </div>
              <footer class="mt-3">
                <div class="flex items-center space-x-3">
                  <div class="flex-shrink-0">
                    <img
                      class="h-6 w-6 rounded-full"
                      :src="asset('img/External/Mackenzie_Moore.webp')"
                      alt="" />
                  </div>
                  <div class="text-base font-medium text-gray-700">
                    NP Digital, Creator Partnerships
                  </div>
                </div>
              </footer>
            </blockquote>
          </div>
        </div>
        <div class="mt-12 sm:mt-16 lg:mt-0">
          <div
            class="-mr-48 pl-4 sm:pl-6 md:-mr-16 lg:relative lg:m-0 lg:h-full lg:px-0">
            <img
              class="w-full rounded-xl shadow-xl ring-1 ring-black ring-opacity-5 lg:absolute lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
              :src="asset('img/External/search.webp')"
              alt="Inbox user interface" />
          </div>
        </div>
      </div>
    </div>
    <!--  <div class="mt-24">
      <div
        class="lg:mx-auto lg:grid lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2 lg:gap-24 lg:px-8">
        <div
          class="mx-auto max-w-xl px-4 sm:px-6 lg:col-start-2 lg:mx-0 lg:max-w-none lg:py-32 lg:px-0">
          <div>
            <div>
              <span
                class="flex h-12 w-12 items-center justify-center rounded-md bg-indigo-600">
                <SparklesIcon class="h-6 w-6 text-white" aria-hidden="true" />
              </span>
            </div>
            <div class="mt-6">
              <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                Simple. Visual. Insightful.
              </h2>
              <p class="mt-4 text-lg text-gray-500">
                Jovie makes it easy to see exactly what needs your attention
                with zero distractions.
              </p>
              <div class="mt-6">
                <router-link
                  to="signup"
                  class="inline-flex rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
                  Get started
                </router-link>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-12 sm:mt-16 lg:col-start-1 lg:mt-0">
          <div
            class="-ml-48 pr-4 sm:pr-6 md:-ml-16 lg:relative lg:m-0 lg:h-full lg:px-0">
            <img
              class="w-full rounded-xl shadow-xl ring-1 ring-black ring-opacity-5 lg:absolute lg:right-0 lg:h-full lg:w-auto lg:max-w-none"
              :src="asset('img/External/search.webp')"
              alt="Customer profile user interface" />
          </div>
        </div>
      </div>
    </div> -->
  </div>
</template>

<script>
import { LightningBoltIcon, SparklesIcon } from '@heroicons/vue/outline';

export default {
  components: {
    LightningBoltIcon,
    SparklesIcon,
  },
};
</script>
