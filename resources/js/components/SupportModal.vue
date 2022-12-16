<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="close()">
      <TransitionChild
        as="template"
        enter="ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in duration-200"
        leave-from="opacity-100"
        leave-to="opacity-0">
        <div
          class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 z-40 overflow-y-auto py-12 px-8">
        <div
          class="flex min-h-full items-end justify-center text-center sm:items-center">
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel
              class="absolute right-4 my-12 flex h-full transform flex-col justify-between overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all dark:bg-slate-800 sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
              <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                <button
                  type="button"
                  class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 dark:bg-gray-800 dark:text-gray-300"
                  @click="close()">
                  <span class="sr-only">Close</span>
                  <XMarkIcon
                    class="h-6 w-6 dark:text-gray-300"
                    aria-hidden="true" />
                </button>
              </div>
              <div class="sm:flex sm:items-start">
                <div
                  class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                  <QuestionMarkCircleIcon
                    class="h-6 w-6 text-indigo-600"
                    aria-hidden="true" />
                </div>
                <div
                  class="mt-3 text-center dark:text-gray-300 sm:text-left sm:dark:mt-0 sm:dark:ml-4">
                  <DialogTitle
                    as="h3"
                    class="text-lg font-medium leading-6 text-gray-900 dark:text-slate-300"
                    >Need some help?</DialogTitle
                  >
                  <div class="mt-2">
                    <p class="text-sm text-gray-500 dark:text-gray-300">
                      We're here to help and other awesome thigns.
                    </p>
                  </div>
                </div>
              </div>
              <ul
                class="mt-8 h-full space-y-8 text-slate-700 dark:text-slate-200">
                <li v-for="(item, itemIdx) in items" :key="itemIdx">
                  <div
                    v-if="item.visible"
                    class="group relative flex h-24 items-center space-x-3 rounded-lg border border-slate-200 px-6 py-4 hover:bg-slate-200 dark:border-slate-700 dark:hover:bg-slate-700">
                    <div class="flex-shrink-0 items-center">
                      <span
                        :class="[
                          item.iconColor,
                          'inline-flex h-10 w-10 items-center justify-center rounded-lg',
                        ]">
                        <component
                          :is="item.icon"
                          class="h-6 w-6 text-white dark:text-black"
                          aria-hidden="true" />
                      </span>
                    </div>
                    <div class="min-w-0 flex-1">
                      <div
                        class="text-sm font-medium text-slate-900 dark:text-slate-100">
                        <a :href="item.href">
                          <span class="absolute inset-0" aria-hidden="true" />
                          {{ item.name }}
                        </a>
                      </div>

                      <p class="text-sm text-slate-500 dark:text-slate-400">
                        {{ item.description }}
                      </p>
                    </div>
                    <div class="flex-shrink-0 self-center">
                      <ChevronRightIcon
                        class="h-5 w-5 text-slate-400 group-hover:text-slate-500"
                        aria-hidden="true" />
                    </div>
                  </div>
                </li>
              </ul>
              <router-link
                to="/slack-community"
                class="boder-slate-300 dark-bg-slate-800 mt-4 flex cursor-pointer items-center rounded-md border border bg-slate-100 px-4 py-6 hover:bg-slate-200 dark:border-slate-700 dark:hover:bg-slate-700">
                <div>
                  <div class="text-sm font-bold">Join our Slack community</div>
                  <div class="mt-2">
                    <p
                      class="font-semi-bold text-sm text-gray-500 dark:text-gray-300">
                      We're here to help and other awesome thigns.
                    </p>
                  </div>
                </div>
                <div class="items-center">
                  <svg
                    role="img"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <title>Slack</title>
                    <path
                      d="M5.042 15.165a2.528 2.528 0 0 1-2.52 2.523A2.528 2.528 0 0 1 0 15.165a2.527 2.527 0 0 1 2.522-2.52h2.52v2.52zM6.313 15.165a2.527 2.527 0 0 1 2.521-2.52 2.527 2.527 0 0 1 2.521 2.52v6.313A2.528 2.528 0 0 1 8.834 24a2.528 2.528 0 0 1-2.521-2.522v-6.313zM8.834 5.042a2.528 2.528 0 0 1-2.521-2.52A2.528 2.528 0 0 1 8.834 0a2.528 2.528 0 0 1 2.521 2.522v2.52H8.834zM8.834 6.313a2.528 2.528 0 0 1 2.521 2.521 2.528 2.528 0 0 1-2.521 2.521H2.522A2.528 2.528 0 0 1 0 8.834a2.528 2.528 0 0 1 2.522-2.521h6.312zM18.956 8.834a2.528 2.528 0 0 1 2.522-2.521A2.528 2.528 0 0 1 24 8.834a2.528 2.528 0 0 1-2.522 2.521h-2.522V8.834zM17.688 8.834a2.528 2.528 0 0 1-2.523 2.521 2.527 2.527 0 0 1-2.52-2.521V2.522A2.527 2.527 0 0 1 15.165 0a2.528 2.528 0 0 1 2.523 2.522v6.312zM15.165 18.956a2.528 2.528 0 0 1 2.523 2.522A2.528 2.528 0 0 1 15.165 24a2.527 2.527 0 0 1-2.52-2.522v-2.522h2.52zM15.165 17.688a2.527 2.527 0 0 1-2.52-2.523 2.526 2.526 0 0 1 2.52-2.52h6.313A2.527 2.527 0 0 1 24 15.165a2.528 2.528 0 0 1-2.522 2.523h-6.313z" />
                  </svg>
                </div>
              </router-link>
              <div
                class="mt-4 rounded-md border border-slate-300 bg-slate-100 py-6 px-4 dark:border-slate-700 dark:bg-slate-800">
                <div class="prose font-bold text-slate-600 dark:text-slate-300">
                  Keyboard Shortcuts
                </div>
                <div class="mt-2">
                  <p
                    class="font-semi-bold text-sm text-gray-500 dark:text-gray-300">
                    We're here to help and other awesome thigns.
                  </p>
                </div>
                <div class="mt-2 space-y-2 px-4">
                  <div
                    v-for="shortcut in shortcuts"
                    :key="shortcut.id"
                    class="flex justify-between rounded-md text-xs text-slate-500 dark:text-slate-300">
                    <div>{{ shortcut.text }}</div>
                    <div
                      class="rounded-md border border-slate-300 px-1 py-0.5 font-bold dark:border-slate-700">
                      {{ shortcut.name }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-8 sm:flex sm:flex-row-reverse">
                <button
                  type="button"
                  class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                  @click="launchSupportChat()">
                  <ChatBubbleLeftIcon class="mr-2 h-5 w-5" />
                  Message Us
                </button>
                <button
                  type="button"
                  class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm"
                  @click="close()">
                  Cancel
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue';

import {
  QuestionMarkCircleIcon,
  XMarkIcon,
  DocumentTextIcon,
  ChatBubbleLeftIcon,
  CloudArrowUpIcon,
} from '@heroicons/vue/24/outline';
export default {
  name: 'SupportModal',
  props: {
    open: {
      type: Boolean,
      required: true,
      default: false,
    },
  },
  //add data for items
  data() {
    return {
      shortcuts: [
        {
          id: 1,
          name: 'Shift + C',
          text: 'Create new contact',
        },
        {
          id: 2,
          name: '?',
          text: 'Open this help menu',
        },
        {
          id: 3,
          name: 'Spacebar',
          text: 'Open the contact sidebar for the selected contact',
        },
        {
          id: 4,
          name: '/',
          text: 'Search for a contact',
        },
        {
          id: 5,
          name: 'Esc',
          text: 'Open/close the sidebar navigation menu',
        },
      ],
      items: [
        {
          name: 'Documentation',
          icon: DocumentTextIcon,
          description:
            'Help center and documentation for Jovie. Learn how to use Jovie.',
          href: '/support',
          iconColor: 'bg-pink-500',
          visible: true,
        },
        {
          name: 'Bulk Upload Contacts',
          icon: CloudArrowUpIcon,
          description: 'Upload a CSV File to Jovie.',
          href: '/import',
          iconColor: 'bg-purple-500',

          visible: true,
        },
      ],
    };
  },
  components: {
    Dialog,
    ChatBubbleLeftIcon,
    CloudArrowUpIcon,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    QuestionMarkCircleIcon,
    DocumentTextIcon,
    XMarkIcon,
  },

  methods: {
    close() {
      this.$emit('close');
    },

    launchSupportChat() {
      window.analytics.track('Support Chat Launched');
      this.close();
      window.Atlas.start();
      window.Atlas.chat.open();
      window.Atlas.chat.openWindow();

      //emit close event
    },
  },
};
</script>
