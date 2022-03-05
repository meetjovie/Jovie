<template>
  <div>
    <div
      class="container my-6 mx-auto flex flex-col items-start justify-between border-b border-gray-300 px-6 pb-4 md:flex-row md:items-center lg:my-4">
      <div class="inline-flex">
        <div class="mr-4 inline-flex">
          <div class="relative aspect-square">
            <span
              class="absolute inset-0 rounded-full shadow-inner"
              aria-hidden="true">
            </span>
          </div>
        </div>
        <div>
          <h4
            class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-100">
            {{ creator.name }}
          </h4>
          <ul
            aria-label="current Status"
            class="mt-3 flex flex-col items-start text-sm text-gray-600 dark:text-gray-400 md:flex-row md:items-center">
            <li class="mr-4 flex items-center">
              <div class="mr-1">
                <img
                  class="dark:hidden"
                  src="https://tuk-cdn.s3.amazonaws.com/can-uploader/simple_with_sub_text_and_border-svg1.svg"
                  alt="Active" />
                <img
                  class="hidden dark:block"
                  src="https://tuk-cdn.s3.amazonaws.com/can-uploader/simple_with_sub_text_and_border-svg1dark.svg"
                  alt="Active" />
              </div>
              <span>Onboarding</span>
            </li>
            <li class="mr-4 mt-4 flex items-center md:mt-0">
              <div class="mr-1">
                <img
                  class="dark:hidden"
                  src="https://tuk-cdn.s3.amazonaws.com/can-uploader/simple_with_sub_text_and_border-svg2.svg"
                  alt="Trending" />
                <img
                  class="hidden dark:block"
                  src="https://tuk-cdn.s3.amazonaws.com/can-uploader/simple_with_sub_text_and_border-svg2dark.svg"
                  alt="Trending" />
              </div>
              <span> Trending</span>
            </li>
            <li class="mt-4 flex items-center md:mt-0">
              <div class="mr-1">
                <img
                  class="dark:hidden"
                  src="https://tuk-cdn.s3.amazonaws.com/can-uploader/simple_with_sub_text_and_border-svg3.svg"
                  alt="date" />
                <img
                  class="hidden dark:block"
                  src="https://tuk-cdn.s3.amazonaws.com/can-uploader/simple_with_sub_text_and_border-svg3dark.svg"
                  alt="date" />
              </div>
              <span>Last contacted </span
              ><span class="ml-2 font-bold text-neutral-400">Jan 2020</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="mt-6 md:mt-0">
        <button
          class="mr-3 rounded bg-gray-200 px-5 py-2 text-sm text-indigo-700 transition duration-150 ease-in-out hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2 dark:bg-gray-700 dark:text-indigo-600 dark:hover:bg-gray-600">
          Archive
        </button>
        <button
          class="rounded bg-indigo-700 px-8 py-2 text-sm text-white transition duration-150 ease-in-out hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2">
          Add to campaign
        </button>
      </div>
    </div>
    <!-- Code block ends -->
    <main class="mb-12 py-2">
      <!-- Page header -->
      <div
        class="mx-auto mt-2 grid max-w-3xl grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-1 lg:col-start-1">
          <!-- Description list-->
          <section aria-labelledby="applicant-information-title">
            <div class="grid-cols-2 bg-white shadow sm:rounded-lg">
              <div class="pt-5">
                <CreatorAvatar size="md" />
              </div>
              <div class="grid-cols-1 px-4 pb-5 pt-2 sm:px-6">
                <h2
                  id="applicant-information-title"
                  class="text-lg font-medium leading-6 text-gray-900">
                  {{ creator.name }}
                </h2>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                  {{ creator.bio }}
                </p>
              </div>
              <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Rating</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <star-rating
                        class="w-20"
                        :star-size="12"
                        :increment="0.5"
                        v-model:rating="creator.rating"></star-rating>
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Category</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <CreatorTags size="md" text="Category" />
                    </dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                      Salary expectation
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">$120,000</dd>
                  </div>
                  <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                    <dd class="mt-1 text-sm text-gray-900">+1 555-555-5555</dd>
                  </div>
                  <div class="sm:col-span-2">
                    <dd class="mt-1 text-sm text-gray-900">
                      <span class="ml-2 w-0 flex-1 truncate">
                        <InputGroup
                          icon="MailIcon"
                          :placeholder="creator.email" />
                      </span>
                    </dd>
                  </div>
                  <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Tags</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <CreatorTags size="md" color="pink" text="Fashion" />
                      <CreatorTags size="md" color="blue" text="Music" />
                      <CreatorTags size="md" color="green" text="Sports" />
                    </dd>
                  </div>
                  <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Reports</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                      <ul
                        role="list"
                        class="divide-y divide-gray-200 rounded-md border border-gray-200">
                        <li
                          class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                          <div class="flex w-0 flex-1 items-center">
                            <!-- Heroicon name: solid/paper-clip -->
                            <svg
                              class="h-5 w-5 flex-shrink-0 text-gray-400"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                              aria-hidden="true">
                              <path
                                fill-rule="evenodd"
                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 w-0 flex-1 truncate">
                              {{ creator.name }} Creator Report.pdf
                            </span>
                          </div>
                          <div class="ml-4 flex-shrink-0">
                            <a
                              href="#"
                              class="font-medium text-indigo-600 hover:text-indigo-500">
                              Download
                            </a>
                          </div>
                        </li>
                      </ul>
                    </dd>
                  </div>
                </dl>
              </div>
              <div>
                <a
                  href="#"
                  class="block bg-gray-50 px-4 py-4 text-center text-sm font-medium text-gray-500 hover:text-gray-700 sm:rounded-b-lg"
                  >View profile</a
                >
              </div>
            </div>
          </section>

          <section
            aria-labelledby="timeline-title"
            class="lg:col-span-1 lg:col-start-3">
            <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
              <h2 id="timeline-title" class="text-lg font-medium text-gray-900">
                Social Info
              </h2>

              <!-- Activity Feed -->
              <div class="mt-6 flow-root">
                <!-- Code block starts -->
                <div
                  v-for="social in socials"
                  :key="social.network"
                  class="flex flex-col py-4 lg:py-0">
                  <CreatorHandles
                    :placeholder="social.placeholder"
                    icon="TwitterIcon"></CreatorHandles>

                  <div class="relative">
                    <div
                      class="absolute flex h-full cursor-pointer items-center rounded-l border-r bg-indigo-700 px-4 text-white dark:border-gray-700 dark:bg-indigo-600"></div>
                  </div>
                </div>
              </div>
              <div class="justify-stretch mt-6 flex flex-col">
                <button
                  type="button"
                  class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                  Add network
                  <PlusIcon class="ml-1 mt-0.5 h-4 w-4 text-white" />
                </button>
              </div>
            </div>
          </section>
        </div>

        <section
          aria-labelledby="timeline-title"
          class="lg:col-span-2 lg:col-start-2">
          <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
            <h2 id="timeline-title" class="text-lg font-medium text-gray-900">
              Timeline
            </h2>

            <!-- Links -->
            <TabGroup as="div" class="mt-2">
              <div class="border-b border-gray-200">
                <TabList class="-mb-px flex space-x-8 px-4">
                  <Tab
                    as="template"
                    v-for="navLink in nav"
                    :key="navLink.name"
                    v-slot="{ selected }">
                    <button
                      :class="[
                        selected
                          ? 'border-indigo-600 text-indigo-600'
                          : 'border-transparent text-gray-900',
                        'flex-1 whitespace-nowrap border-b-2 py-4 px-1 text-base font-medium',
                      ]">
                      {{ navLink.name }}
                    </button>
                  </Tab>
                </TabList>
              </div>
              <TabPanels as="template">
                <TabPanel class="space-y-12 px-4 pt-10 pb-6">
                  Panel content
                </TabPanel>
              </TabPanels>
            </TabGroup>

            <!-- Activity Feed -->
            <div class="mt-6 flow-root">
              <ul role="list" class="-mb-8">
                <li>
                  <div class="relative pb-8">
                    <span
                      class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                      aria-hidden="true"></span>
                    <div class="relative flex space-x-3">
                      <div>
                        <span
                          class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white">
                          <!-- Heroicon name: solid/user -->
                          <svg
                            class="h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true">
                            <path
                              fill-rule="evenodd"
                              d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                              clip-rule="evenodd" />
                          </svg>
                        </span>
                      </div>
                      <div
                        class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                          <p class="text-sm text-gray-500">
                            Applied to
                            <a href="#" class="font-medium text-gray-900"
                              >Front End Developer</a
                            >
                          </p>
                        </div>
                        <div
                          class="whitespace-nowrap text-right text-sm text-gray-500">
                          <time datetime="2020-09-20">Sep 20</time>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="relative pb-8">
                    <span
                      class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                      aria-hidden="true"></span>
                    <div class="relative flex space-x-3">
                      <div>
                        <span
                          class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-500 ring-8 ring-white">
                          <!-- Heroicon name: solid/thumb-up -->
                          <svg
                            class="h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true">
                            <path
                              d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                          </svg>
                        </span>
                      </div>
                      <div
                        class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                          <p class="text-sm text-gray-500">
                            Advanced to phone screening by
                            <a href="#" class="font-medium text-gray-900"
                              >Bethany Blake</a
                            >
                          </p>
                        </div>
                        <div
                          class="whitespace-nowrap text-right text-sm text-gray-500">
                          <time datetime="2020-09-22">Sep 22</time>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="relative pb-8">
                    <span
                      class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                      aria-hidden="true"></span>
                    <div class="relative flex space-x-3">
                      <div>
                        <span
                          class="flex h-8 w-8 items-center justify-center rounded-full bg-green-500 ring-8 ring-white">
                          <!-- Heroicon name: solid/check -->
                          <svg
                            class="h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true">
                            <path
                              fill-rule="evenodd"
                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                              clip-rule="evenodd" />
                          </svg>
                        </span>
                      </div>
                      <div
                        class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                          <p class="text-sm text-gray-500">
                            Completed phone screening with
                            <a href="#" class="font-medium text-gray-900"
                              >Martha Gardner</a
                            >
                          </p>
                        </div>
                        <div
                          class="whitespace-nowrap text-right text-sm text-gray-500">
                          <time datetime="2020-09-28">Sep 28</time>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="relative pb-8">
                    <span
                      class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                      aria-hidden="true"></span>
                    <div class="relative flex space-x-3">
                      <div>
                        <span
                          class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-500 ring-8 ring-white">
                          <!-- Heroicon name: solid/thumb-up -->
                          <svg
                            class="h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true">
                            <path
                              d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                          </svg>
                        </span>
                      </div>
                      <div
                        class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                          <p class="text-sm text-gray-500">
                            Advanced to interview by
                            <a href="#" class="font-medium text-gray-900"
                              >Bethany Blake</a
                            >
                          </p>
                        </div>
                        <div
                          class="whitespace-nowrap text-right text-sm text-gray-500">
                          <time datetime="2020-09-30">Sep 30</time>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="relative pb-8">
                    <div class="relative flex space-x-3">
                      <div>
                        <span
                          class="flex h-8 w-8 items-center justify-center rounded-full bg-green-500 ring-8 ring-white">
                          <!-- Heroicon name: solid/check -->
                          <svg
                            class="h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true">
                            <path
                              fill-rule="evenodd"
                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                              clip-rule="evenodd" />
                          </svg>
                        </span>
                      </div>
                      <div
                        class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                          <p class="text-sm text-gray-500">
                            Completed interview with
                            <a href="#" class="font-medium text-gray-900"
                              >Katherine Snyder</a
                            >
                          </p>
                        </div>
                        <div
                          class="whitespace-nowrap text-right text-sm text-gray-500">
                          <time datetime="2020-10-04">Oct 4</time>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="justify-stretch mt-6 flex flex-col">
              <button
                type="button"
                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Advance to offer
              </button>
            </div>
          </div>
        </section>
      </div>
    </main>
  </div>
</template>
<script>
import CreatorAvatar from '../components/Creator/CreatorAvatar.vue';
import SocialIcons from '../components/SocialIcons.vue';
import InputGroup from '../components/InputGroup.vue';
import { PlusIcon } from '@heroicons/vue/solid';
import {
  Tab,
  TabGroup,
  TabList,
  TabPanel,
  TabPanels,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue';
import CreatorTags from '../components/Creator/CreatorTags.vue';
import StarRating from 'vue-star-rating';
import CreatorHandles from '../components/Creator/CreatorHandles.vue';

export default {
  components: {
    CreatorAvatar,
    SocialIcons,
    PlusIcon,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
    InputGroup,
    StarRating,
    CreatorTags,
    CreatorHandles,
  },
  data() {
    return {
      creator: {
        name: 'Jessica Smith',
        avatar: '',
        email: 'jess@jov.ie',
        rating: 4.5,
        bio: 'Been beat up and battered round Been sent up and Ive been shot down Youre the best thing that Ive ever found Handle me with care',
      },
      socials: [
        { icon: 'UserIcon', size: '24', placeholder: '@itstimwhtie' },
        { icon: 'instagram', size: '24', placeholder: '@timwhite' },
        { icon: 'TwitterIcon', size: '24', placeholder: '@timwhite' },
      ],
    };
  },
};
</script>
