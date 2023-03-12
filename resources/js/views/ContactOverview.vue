<template>
  <div class="flex w-full">
    <aside>
      <JovieSidebar />
    </aside>
    <div class="w-full">
      <div
        class="container my-6 mx-auto flex flex-col items-start justify-between border-b border-slate-300 px-6 pb-4 md:flex-row md:items-center lg:my-4">
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
              @click="previousContact(contact.id)"
              class="mr-3 rounded bg-slate-200 px-5 py-2 text-sm text-indigo-700 transition duration-150 ease-in-out hover:bg-slate-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-700 focus-visible:ring-offset-2">
              <ChevronLeftIcon class="h-5 w-5" />
            </button>
            <button
              @click="nextContact(contact.id)"
              class="mr-3 rounded bg-slate-200 px-5 py-2 text-sm text-indigo-700 transition duration-150 ease-in-out hover:bg-slate-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-700 focus-visible:ring-offset-2">
              <ChevronRightIcon class="h-5 w-5" />
            </button>
            <!-- <ul
                                          aria-label="current Status"
                                          class="mt-3 flex flex-col items-start text-sm text-slate-600 dark:text-jovieDark-400 md:flex-row md:items-center">
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
                                            ><span class="ml-2 font-bold text-slate-400">Jan 2020</span>
                                          </li>
                                        </ul> -->
          </div>
        </div>

        <div class="mt-6 md:mt-0" v-if="$store.state.overviewList">
          <button
            class="mr-3 rounded bg-slate-200 px-5 py-2 text-sm text-indigo-700 transition duration-150 ease-in-out hover:bg-slate-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-700 focus-visible:ring-offset-2">
              {{ $store.state.overviewList.name}}
          </button>
<!--           <button-->
<!--                  class="rounded bg-indigo-700 px-8 py-2 text-sm text-white transition duration-150 ease-in-out hover:bg-indigo-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-700 focus-visible:ring-offset-2">-->
<!--                  Add to campaign-->
<!--                </button> -->
        </div>
      </div>
      <!-- Code block ends -->
      <main class="mb-12 py-2" v-if="contact">
        <!-- Page header -->
        <div
          class="mx-auto mt-2 grid max-w-3xl grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
          <div class="space-y-6 lg:col-span-1 lg:col-start-1">
            <!-- Description list-->
            <section aria-labelledby="applicant-information-title">
              <div class="grid-cols-2 bg-white shadow sm:rounded-lg">
                <div class="pt-5">
                  <ContactAvatar
                    size="md"
                    :imageUrl="contact.profile_pic_url" />
                </div>
                <div class="grid-cols-1 px-4 pb-5 pt-2 sm:px-6">
                  <h2
                    id="applicant-information-title"
                    class="text-lg font-medium leading-6 text-slate-900">
                    {{ contact.name }}
                  </h2>
                  <p
                    @click="fullbio = true"
                    class="mt-1 max-w-2xl cursor-pointer text-sm text-slate-500"
                    :class="[
                      { 'line-clamp-none': fullbio == true },
                      { 'line-clamp-2': fullbio == false },
                    ]">
                    {{ contact.biography }}
                  </p>
                  <div class="mt-4">
                    <ContactSocialLinks
                      :socialLinks="contact.social_links_with_followers"
                      iconstyle="horizontal" />
                  </div>
                </div>
                <div class="border-t border-slate-200 px-4 py-5 sm:px-6">
                  <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-slate-500">Rating</dt>
                      <dd class="mt-1 text-sm text-slate-900">
                        <star-rating
                          class="w-20"
                          :star-size="12"
                          :increment="0.5"
                          v-model:rating="contact.rating"
                          @update:rating="
                            updateContact({
                              id: contact.id,
                              key: `rating`,
                              value: $event,
                            })
                          "></star-rating>
                      </dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-slate-500">Stage 123</dt>
                      <dd class="mt-1 text-sm text-slate-900">
                          <ContactStageMenu
                              :contact="contact"
                              :stages="stages"
                              @updateContact="updateContact($event)" />
<!--                        <Popover-->
<!--                          as="div"-->
<!--                          class="relative inline-block text-left">-->
<!--                          <PopoverButton-->
<!--                            class="group my-0 inline-flex w-32 items-center justify-between rounded-sm bg-blue-100 px-2 py-1 text-xs font-semibold leading-5 text-blue-800">-->
<!--                            {{ contact.stage_name }}-->
<!--                            <svg-->
<!--                              xmlns="http://www.w3.org/2000/svg"-->
<!--                              class="ml-2 h-4 w-4 hover:text-blue-700 group-hover:text-blue-900"-->
<!--                              fill="none"-->
<!--                              viewBox="0 0 24 24"-->
<!--                              stroke="currentColor">-->
<!--                              <path-->
<!--                                stroke-linecap="round"-->
<!--                                stroke-linejoin="round"-->
<!--                                stroke-width="2"-->
<!--                                d="M19 9l-7 7-7-7" />-->
<!--                            </svg>-->
<!--                          </PopoverButton>-->
<!--                          <transition-->
<!--                            enter-active-class="transition duration-100 ease-out"-->
<!--                            enter-from-class="transform scale-95 opacity-0"-->
<!--                            enter-to-class="transform scale-100 opacity-100"-->
<!--                            leave-active-class="transition duration-75 ease-in"-->
<!--                            leave-from-class="transform scale-100 opacity-100"-->
<!--                            leave-to-class="transform scale-95 opacity-0">-->
<!--                            <PopoverPanel-->
<!--                              class="center-0 absolute z-30 mt-2 w-40 origin-top-right divide-y divide-slate-100 rounded-lg bg-white/60 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-md focus-visible:outline-none">-->
<!--                              <div class="">-->
<!--                                <div class="">-->
<!--                                  <button-->
<!--                                    class="group flex w-full items-center px-2 py-2 text-xs text-slate-700 first:rounded-t-lg first:pt-2 last:rounded-b-lg last:pb-2 hover:bg-indigo-700 hover:text-white"-->
<!--                                    v-for="(stage, key) in stages"-->
<!--                                    @click="-->
<!--                                      updateContact({-->
<!--                                        id: contact.id,-->
<!--                                        key: `crm_record_by_user.stage`,-->
<!--                                        value: key,-->
<!--                                      })-->
<!--                                    ">-->
<!--                                    <div class="mr-2 font-bold opacity-50">-->
<!--                                      {{ key + 1 }}-->
<!--                                    </div>-->
<!--                                    <div class="font-bold">-->
<!--                                      {{ stage }}-->
<!--                                    </div>-->
<!--                                  </button>-->
<!--                                </div>-->
<!--                              </div>-->
<!--                            </PopoverPanel>-->
<!--                          </transition>-->
<!--                        </Popover>-->
                      </dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-slate-500">
                        Last contact
                      </dt>
                      <dd class="mt-1 text-sm text-slate-900">{{ contact.last_contacted }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                      <dt class="text-sm font-medium text-slate-500">
                        Category
                      </dt>
                      <dd class="mt-1 text-sm text-slate-900">
                        <ContactTags
                          :showX="false"
                          size="md"
                          :text="contact.category" />
                      </dd>
                    </div>
                    <div class="sm:col-span-2">
                      <dt class="text-sm font-medium text-slate-500">Email</dt>
                      <dd class="mt-1 text-sm text-slate-900">
                        <div class="relative mt-1 rounded-md shadow-sm">
                          <div
                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <DocumentDuplicateIcon
                              tooltip="Copy to clipboard"
                              @click="copyToClipboard(contact.emails[0])"
                              class="h-5 w-5 cursor-pointer text-slate-400 hover:text-slate-700 active:mt-0.5 active:mr-0.5 active:text-slate-500"
                              aria-hidden="true" />
                          </div>
                          <InputGroup
                            v-model="contact.emails"
                            @blur="
                              updateContact({
                                id: contact.id,
                                key: `emails`,
                                value: contact.emails,
                              })
                            "
                            icon="DocumentDuplicateIcon"
                            :placeholder="contact.email" />
                        </div>
                      </dd>
                    </div>
                    <div class="sm:col-span-2">
                      <dt class="text-sm font-medium text-slate-500">Tags</dt>
                      <dd class="mt-1 text-sm text-slate-900">
                        <template v-for="(tag, index) in contact.tags">
                          <ContactTags
                            @deleteTag="deleteTag(contact.id, index)"
                            v-if="index == 0"
                            size="md"
                            color="pink"
                            :text="tag" />
                          <ContactTags
                            @deleteTag="deleteTag(contact.id, index)"
                            v-if="index == 1"
                            size="md"
                            color="blue"
                            :text="tag" />
                          <ContactTags
                            @deleteTag="deleteTag(contact.id, index)"
                            v-if="index == 2"
                            size="md"
                            color="green"
                            :text="tag" />
                        </template>
                      </dd>
                    </div>
                    <div class="sm:col-span-2">
                      <dt class="text-sm font-medium text-slate-500">
                        Reports
                      </dt>
                      <!-- <dd class="mt-1 text-sm text-slate-900">
                      <ul
                        role="list"
                        class="divide-y divide-slate-200 rounded-md border border-slate-200">
                        <li
                          class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                          <div class="flex w-0 flex-1 items-center">

                            <svg
                              class="h-5 w-5 flex-shrink-0 text-slate-400"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                              aria-hidden="true">
                              <path
                                fill-rule="evenodd"
                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 w-0 flex-1 truncate text-xs">
                              {{ contact.name }} Contact Report.pdf
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
                    </dd> -->
                    </div>
                  </dl>
                </div>
                <div>
                  <a
                    href="#"
                    class="block bg-slate-50 px-4 py-4 text-center text-sm font-medium text-slate-500 hover:text-slate-700 sm:rounded-b-lg"
                    >View profile</a
                  >
                </div>
              </div>
            </section>

            <!--    <section
            aria-labelledby="timeline-title"
            class="lg:col-span-1 lg:col-start-3">
            <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
              <h2 id="timeline-title" class="text-lg font-medium text-slate-900">
                Social Info
              </h2>


             <div class="mt-6 flow-root">

                                <div
                                    v-for="social in socials"
                                    :key="social.network"
                                    class="flex flex-col py-4 lg:py-0">
                                    <ContactHandles
                                        :placeholder="social.placeholder"
                                        icon="TwitterIcon"></ContactHandles>

                                    <div class="relative">
                                        <div
                                            class="absolute flex h-full cursor-pointer items-center rounded-l border-r bg-indigo-700 px-4 text-white dark:border-jovieDark-border dark:bg-indigo-600"></div>
                                    </div>
                                </div>
                            </div>
              <div class="justify-stretch mt-6 flex flex-col">
                <button
                  type="button"
                  class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                  Add network
                  <PlusIcon class="ml-1 mt-0.5 h-4 w-4 text-white" />
                </button>
              </div>
            </div>
          </section> -->
          </div>

          <section
            aria-labelledby="timeline-title"
            class="lg:col-span-2 lg:col-start-2">
            <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
              <TabGroup as="div" @change="changeTab">
                <!-- Links -->

                <div class="border-b border-slate-200">
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
                            : 'border-transparent text-slate-900',
                          'flex-1 whitespace-nowrap border-b-2 py-4 px-1 text-base font-medium',
                        ]">
                        {{ tab.name }}
                      </button>
                    </Tab>
                  </TabList>
                </div>
                <TabPanels as="template">
                  <!--  <TabPanel class="space-y-12 px-4 pt-10 pb-6">
                                  <ContactContentBar />
                                </TabPanel>
                                <TabPanel class="space-y-12 px-4 pt-10 pb-6">
                                  <ActivityFeed button="Show more" />
                                </TabPanel> -->

                  <TabPanel class="space-y-12 px-4 pt-10 pb-6">
                    <ContactMediaGroup>
                      <ContactMediaItem
                        v-for="media in contact.overview_media"
                        :media="media"></ContactMediaItem>
                    </ContactMediaGroup>
                  </TabPanel>
                  <TabPanel class="space-y-12 px-4 pt-10 pb-6">
                    <CommentThread
                      :comments="comments"
                      @getComments="getComments" />
                    <CommentBox
                      ref="commentBox"
                      :loading="addingComment"
                      @addComment="addComment" />
                  </TabPanel>
                </TabPanels>
              </TabGroup>
            </div>
          </section>
        </div>
      </main>
    </div>
  </div>
</template>
<script>
import ContactAvatar from '../components/Contact/ContactAvatar.vue';
import ContactContentBar from '../components/Contact/ContactContentBar.vue';
import SocialIcons from '../components/SocialIcons.vue';
import InputGroup from '../components/InputGroup.vue';
import {
  PlusIcon,
  ChevronRightIcon,
  DocumentDuplicateIcon,
  EnvelopeIcon,
  ChevronLeftIcon,
} from '@heroicons/vue/24/solid';
import CommentBox from '../components/CommentBox.vue';
import ActivityFeed from '../components/ActivityFeed.vue';
import ContactSocialLinks from '../components/Contact/ContactSocialLinks.vue';
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
import ContactTags from '../components/Contact/ContactTags.vue';
import StarRating from 'vue-star-rating';
import CommentThread from '../components/CommentThread.vue';
import ContactHandles from '../components/Contact/ContactHandles.vue';
import UserService from '../services/api/user.service';
import ContactMediaGroup from '../components/TimelineMedia/ContactMediaGroup.vue';
import ContactMediaItem from '../components/TimelineMedia/ContactMediaItem.vue';
import ContactService from '../services/api/contact.service';
import JovieSidebar from '../components/JovieSidebar.vue';
import ContactStageMenu from '../components/ContactStageMenu.vue'

export default {
  components: {
      ContactStageMenu,
    ContactMediaItem,
    JovieSidebar,
    ContactMediaGroup,
    ContactAvatar,
    SocialIcons,
    PlusIcon,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    DocumentDuplicateIcon,
    TabPanels,
    TransitionChild,
    TransitionRoot,
    InputGroup,
    StarRating,
    ContactTags,
    ContactHandles,
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverGroup,
    ContactContentBar,
    CommentBox,
    ActivityFeed,
    CommentThread,
    ChevronRightIcon,
    ChevronLeftIcon,
    ContactSocialLinks,
    EnvelopeIcon,
  },
  props: ['profile', 'socialNetworks', 'contactId'],
  data() {
    return {
      fullbio: false,
      contact: null,
      stages: [],
      networks: [],
      tabs: [
        /* {
                  name: 'Demographics',
                },
                {
                  name: 'Activity',
                }, */
        {
          name: 'Content',
        },
        {
          name: 'Comments',
        },
      ],

      socials: [
        { icon: 'UserIcon', size: '24', placeholder: '@itstimwhtie' },
        { icon: 'instagram', size: '24', placeholder: '@timwhite' },
        { icon: 'TwitterIcon', size: '24', placeholder: '@timwhite' },
      ],
      errors: [],
      addingComment: false,
      comments: [],
    };
  },
  methods: {
    changeTab(index) {
      if (index == 3) {
        this.getComments();
      }
    },
    getComments(limit = 3) {
      ContactService.getComments(this.contact.id, limit).then((response) => {
        response = response.data;
        if (response.status) {
          this.comments = response.comments.reverse();
        }
      });
    },
    addComment(comment) {
      if (!comment) return;

      this.addingComment = true;
      const data = {
        comment: comment,
        contact_id: this.contact.id,
      };
      ContactService.addComment(data)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$refs.commentBox.comment = '';
            this.comments.push(response.data);
          } else {
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          this.addingComment = false;
        });
    },
    getContactOverview() {
      this.loading = true;
      const id = this.$route.params.id;

      UserService.getContactOverview({id: id, listId: this.$store.state.overviewList ? this.$store.state.overviewList.id : ''}).then((response) => {
        this.loading = false;
        response = response.data;
        if (response.status) {
          this.networks = response.networks;
          this.stages = response.stages;
          this.contact = response.contact;
        } else {
          this.$router.push({name: 'Contacts'})
        }
      });
    },
    updateContact(params) {
      this.$store.dispatch('updateContact', params).then((response) => {
        response = response.data;
        if (response.status) {
          this.contact = response.data;
        }
      });
    },
    deleteTag(contactId, index) {
      let updatedTags = this.contact.tags;
      updatedTags.splice(index, 1);
      this.updateContact({ id: contactId, key: 'tags', value: updatedTags });
    },
    previousContact(id) {
      ContactService.previousContact(id).then((response) => {
        response = response.data;
        if (response.status) {
          this.contact = response.data;
          this.$router.replace({
            name: this.$route.name,
            params: {
              id: this.contact.id,
            },
          });
        } else {
          this.$router.push({ name: 'CRM' });
        }
      });
    },
    nextContact(id) {
      ContactService.nextContact(id).then((response) => {
        response = response.data;
        if (response.status) {
          this.contact = response.data;
          this.$router.replace({
            name: this.$route.name,
            params: {
              id: this.contact.id,
            },
          });
        } else {
          this.$router.push({ name: 'CRM' });
        }
      });
    },
  },
  mounted() {
      window.analytics.page(this.$route.name + ' - ' + this.$route.params.id);
    this.getContactOverview();
  },
};
</script>
