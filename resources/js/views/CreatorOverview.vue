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
                    <button
                        class="mr-3 rounded bg-gray-200 px-5 py-2 text-sm text-indigo-700 transition duration-150 ease-in-out hover:bg-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-700 focus-visible:ring-offset-2 dark:bg-gray-700 dark:text-indigo-600 dark:hover:bg-gray-600">
                        <ChevronLeftIcon class="h-5 w-5"/>
                    </button>
                    <button
                        class="mr-3 rounded bg-gray-200 px-5 py-2 text-sm text-indigo-700 transition duration-150 ease-in-out hover:bg-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-700 focus-visible:ring-offset-2 dark:bg-gray-700 dark:text-indigo-600 dark:hover:bg-gray-600">
                        <ChevronRightIcon class="h-5 w-5"/>
                    </button>
                    <!-- <ul
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
                    </ul> -->
                </div>
            </div>

            <div class="mt-6 md:mt-0">
                <button
                    class="mr-3 rounded bg-gray-200 px-5 py-2 text-sm text-indigo-700 transition duration-150 ease-in-out hover:bg-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-700 focus-visible:ring-offset-2 dark:bg-gray-700 dark:text-indigo-600 dark:hover:bg-gray-600">
                    Archive
                </button>
                <button
                    class="rounded bg-indigo-700 px-8 py-2 text-sm text-white transition duration-150 ease-in-out hover:bg-indigo-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-700 focus-visible:ring-offset-2">
                    Add to campaign
                </button>
            </div>
        </div>
        <!-- Code block ends -->
        <main class="mb-12 py-2" v-if="creator">
            <!-- Page header -->
            <div
                class="mx-auto mt-2 grid max-w-3xl grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
                <div class="space-y-6 lg:col-span-1 lg:col-start-1">
                    <!-- Description list-->
                    <section aria-labelledby="applicant-information-title">
                        <div class="grid-cols-2 bg-white shadow sm:rounded-lg">
                            <div class="pt-5">
                                <CreatorAvatar size="md"/>
                            </div>
                            <div class="grid-cols-1 px-4 pb-5 pt-2 sm:px-6">
                                <h2
                                    id="applicant-information-title"
                                    class="text-lg font-medium leading-6 text-gray-900">
                                    {{ creator.name }}
                                </h2>
                                <p
                                    @click="fullbio = true"
                                    class="ext-sm mt-1 max-w-2xl cursor-pointer text-gray-500 line-clamp-2"
                                    :class="[
                    { 'line-clamp-none': fullbio == true },
                    { 'line-clamp-2': fullbio == false },
                  ]">
                                    {{ creator.bio }}
                                </p>
                                <div class="mt-4">
                                    <CreatorSocialLinks iconstyle="horizontal"/>
                                </div>
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
                                                v-model:rating="creator.crm_record_by_user.rating"></star-rating>
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Stage</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            <Popover as="div" class="relative inline-block text-left">
                                                <PopoverButton
                                                    class="group my-0 inline-flex w-32 items-center justify-between rounded-sm bg-blue-100 px-2 py-1 text-xs font-semibold leading-5 text-blue-800">
                                                    {{ creator.crm_record_by_user.instgram_stage }}
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="ml-2 h-4 w-4 hover:text-blue-700 group-hover:text-blue-900"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 9l-7 7-7-7"/>
                                                    </svg>
                                                </PopoverButton>
                                                <transition
                                                    enter-active-class="transition duration-100 ease-out"
                                                    enter-from-class="transform scale-95 opacity-0"
                                                    enter-to-class="transform scale-100 opacity-100"
                                                    leave-active-class="transition duration-75 ease-in"
                                                    leave-from-class="transform scale-100 opacity-100"
                                                    leave-to-class="transform scale-95 opacity-0">
                                                    <PopoverPanel
                                                        class="center-0 absolute z-30 mt-2 w-40 origin-top-right divide-y divide-gray-100 rounded-lg bg-white/60 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-md focus-visible:outline-none">
                                                        <div class="">
                                                            <div class="">
                                                                <button v-for="(stage, key) in stages">
                                                                    <div class="mr-2 font-bold opacity-50">
                                                                        {{ key + 1 }}
                                                                    </div>
                                                                    <div class="font-bold">
                                                                        {{ stage }}
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </PopoverPanel>
                                                </transition>
                                            </Popover>
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Last contact
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">3 days ago</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Category</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            <CreatorTags size="md" text="Category"/>
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            <InputGroup
                                                icon="MailIcon"
                                                :placeholder="creator.email"/>
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500">Tags</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            <CreatorTags size="md" color="pink" text="Fashion"/>
                                            <CreatorTags size="md" color="blue" text="Music"/>
                                            <CreatorTags size="md" color="green" text="Sports"/>
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
                                                                clip-rule="evenodd"/>
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
                                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                                    Add network
                                    <PlusIcon class="ml-1 mt-0.5 h-4 w-4 text-white"/>
                                </button>
                            </div>
                        </div>
                    </section>
                </div>

                <section
                    aria-labelledby="timeline-title"
                    class="lg:col-span-2 lg:col-start-2">
                    <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                        <TabGroup as="div">
                            <!-- Links -->

                            <div class="border-b border-gray-200">
                                <TabList class="-mb-px flex space-x-8 px-4">
                                    <Tab
                                        as="template"
                                        v-for="tab in tabs"
                                        :key="tab.name"
                                        v-slot="{ selected }">
                                        <button
                                            :class="[
                        selected
                          ? 'border-indigo-600 text-indigo-600'
                          : 'border-transparent text-gray-900',
                        'flex-1 whitespace-nowrap border-b-2 py-4 px-1 text-base font-medium',
                      ]">
                                            {{ tab.name }}
                                        </button>
                                    </Tab>
                                </TabList>
                            </div>
                            <TabPanels as="template">
                                <TabPanel class="space-y-12 px-4 pt-10 pb-6">
                                    <CreatorContentBar/>
                                </TabPanel>
                                <TabPanel class="space-y-12 px-4 pt-10 pb-6">
                                    <ActivityFeed button="Show more"/>
                                </TabPanel>

                                <TabPanel class="space-y-12 px-4 pt-10 pb-6">
                                    <CreatorContentBar/>
                                </TabPanel>
                                <TabPanel class="space-y-12 px-4 pt-10 pb-6">
                                    <CommentThread/>
                                    <CommentBox/>
                                </TabPanel>
                            </TabPanels>
                        </TabGroup>
                    </div>
                </section>
            </div>
        </main>
    </div>
</template>
<script>
import CreatorAvatar from '../components/Creator/CreatorAvatar.vue';
import CreatorContentBar from '../components/Creator/CreatorContentBar.vue';
import SocialIcons from '../components/SocialIcons.vue';
import InputGroup from '../components/InputGroup.vue';
import {
    PlusIcon,
    ChevronRightIcon,
    ChevronLeftIcon,
} from '@heroicons/vue/solid';
import CommentBox from '../components/CommentBox.vue';
import ActivityFeed from '../components/ActivityFeed.vue';
import CreatorSocialLinks from '../components/Creator/CreatorSocialLinks.vue';
import {
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverGroup,
} from '@headlessui/vue';
import CreatorTags from '../components/Creator/CreatorTags.vue';
import StarRating from 'vue-star-rating';
import CommentThread from '../components/CommentThread.vue';
import CreatorHandles from '../components/Creator/CreatorHandles.vue';
import store from "../store";
import router from "../router";
import UserService from "../services/api/user.service";

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
        Popover,
        PopoverButton,
        PopoverPanel,
        PopoverGroup,
        CreatorContentBar,
        CommentBox,
        ActivityFeed,
        CommentThread,
        ChevronRightIcon,
        ChevronLeftIcon,
        CreatorSocialLinks,
    },
    props: ['profile', 'socialNetworks', 'creatorId'],
    data() {
        return {
            fullbio: false,
            creator: null,
            stages: [],
            networks: [],
            tabs: [
                {
                    name: 'Demographics',
                },
                {
                    name: 'Activity',
                },
                {
                    name: 'Content',
                },
                {
                    name: 'Comments',
                },
            ],

            socials: [
                {icon: 'UserIcon', size: '24', placeholder: '@itstimwhtie'},
                {icon: 'instagram', size: '24', placeholder: '@timwhite'},
                {icon: 'TwitterIcon', size: '24', placeholder: '@timwhite'},
            ],
        };
    },
    methods: {
        getCrmCreators() {
            this.loading = true;
            const id = this.$route.params.id
            let data = {id: id};
            UserService.getCrmCreators(data).then((response) => {
                this.loading = false;
                response = response.data;
                if (response.status) {
                    this.networks = response.networks;
                    this.stages = response.stages;
                    this.creator = response.creators.data[0];
                }
            });
        },
        updateCreator(params) {
            this.$store.dispatch('updateCreator', params).then((response) => {
                response = response.data;
                if (response.status) {
                    if (response.data == null) {
                        this.creators.splice(params.index, 1);
                    } else {
                        this.creators[params.index] = response.data;
                    }
                }
            });
        },
    },
    mounted() {
        this.getCrmCreators()
    }

};
</script>
