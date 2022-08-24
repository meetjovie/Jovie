<template>
  <body class="main py-16">
    <div
      class="flex flex-col justify-between px-4 pb-12 md:flex-row md:items-center xl:container xl:mx-auto">
      <div class="mb-8 w-full pr-0 md:w-1/2 md:pr-4 lg:mb-0 lg:pr-0 xl:w-1/3">
        <h1
          class="pr-16 text-2xl font-bold text-gray-700 md:text-4xl lg:pr-0 xl:text-5xl">
          Meet Jovie
        </h1>
        <p
          class="mt-4 w-full pr-0 text-base leading-normal text-gray-500 lg:w-10/12 lg:pr-16 xl:w-96 xl:pr-0">
          We believe everyone can benefit from building strong
          <span class="font-bold">relationships</span>. We're building the tools
          to make that process effortless.
        </p>

        <router-link to="careers"
          ><ButtonGroup class="mt-4" text="Join us"> </ButtonGroup
        ></router-link>
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
    <NewsletterSignup />
    <div
      class="flex flex-col items-center justify-center space-y-8 bg-neutral-50 py-12 px-4 sm:py-24 md:space-y-12 md:px-6 xl:px-20 2xl:container 2xl:mx-auto">
      <div
        class="flex flex-col items-center justify-center space-y-2 md:space-y-4">
        <h1
          class="text-center text-xl font-bold leading-5 text-gray-700 md:text-2xl md:leading-8 lg:text-4xl lg:font-bold">
          Culture
        </h1>
        <!--  <p
          class="text-center text-base leading-5 text-gray-600 md:w-2/3 md:leading-6">
          We are designers, developer, and testers. We provide best design
          solution to our clients. Working perfectly with our clients.
        </p> -->
      </div>
    </div>

    <div class="overflow-hidden bg-gray-50">
      <div class="relative mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8">
        <svg
          class="absolute top-0 left-full -translate-x-1/2 -translate-y-3/4 transform lg:left-auto lg:right-full lg:translate-x-2/3 lg:translate-y-1/4"
          width="404"
          height="784"
          fill="none"
          viewBox="0 0 404 784"
          aria-hidden="true">
          <defs>
            <pattern
              id="8b1b5f72-e944-4457-af67-0c6d15a99f38"
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
            fill="url(#8b1b5f72-e944-4457-af67-0c6d15a99f38)" />
        </svg>

        <div class="relative lg:grid lg:grid-cols-3 lg:gap-x-8">
          <div class="lg:col-span-1">
            <h2
              class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
              Our values
            </h2>
          </div>
          <dl
            class="mt-10 space-y-10 sm:grid sm:grid-cols-2 sm:gap-x-8 sm:gap-y-10 sm:space-y-0 lg:col-span-2 lg:mt-0">
            <div v-for="feature in features" :key="feature.name">
              <dt>
                <div
                  class="flex h-12 w-12 items-center justify-center rounded-md bg-indigo-500 text-white">
                  <component
                    :is="feature.icon"
                    class="h-6 w-6"
                    aria-hidden="true" />
                </div>
                <p class="mt-5 text-lg font-medium leading-6 text-gray-900">
                  {{ feature.name }}
                </p>
              </dt>
              <dd class="mt-2 text-sm text-gray-500">
                {{ feature.description }}
              </dd>
            </div>
          </dl>
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
import {
  GlobeAltIcon,
  LightningBoltIcon,
  MailIcon,
  ThumbUpIcon,
  DocumentTextIcon,
  ScaleIcon,
} from '@heroicons/vue/outline';
import NewsletterSignup from '../components/External/NewsletterSignup.vue';

const features = [
  {
    name: "Be so good they can't ignore you",
    description: `We’re here to build products that are undeniably good.  We work hard everyday to be better at that. `,
    icon: ThumbUpIcon,
  },
  {
    name: 'Best idea wins',
    description:
      'We check our ego at the door.  The best idea wins, no matter who it came from.',
    icon: ScaleIcon,
  },
  {
    name: 'Move fast & break often',
    description:
      'We move quickly with a bias for action.  We step back often to see how our work fits in to the bigger picture. Sprint, walk, repeat.',
    icon: LightningBoltIcon,
  },
  {
    name: 'Be concise',
    description:
      'We use simple & concise language to communicate our ideas internally & externally. Concise emails,concise code,concise lunch orders. We value simplicity & clarity.',
    icon: DocumentTextIcon,
  },
];
</script>
<script>
export default {
  mounted() {
    window.analytics.page(this.$route.name);
  },
};
</script>
