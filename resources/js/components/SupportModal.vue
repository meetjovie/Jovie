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

      <div class="fixed inset-0 z-40 my-2 overflow-y-auto rounded-md px-8">
        <div class="flex items-end justify-center text-center sm:items-center">
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-x-100"
            enter-to="opacity-100 translate-x-0"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-x-0"
            leave-to="opacity-0 translate-x-100">
            <DialogPanel
              class="absolute right-4 top-4 mb-12 mr-8 flex transform flex-col justify-between overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all dark:bg-jovieDark-800 sm:mb-4 sm:w-full sm:max-w-lg sm:p-6">
              <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                <button
                  type="button"
                  class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 dark:bg-jovieDark-800 dark:text-gray-300"
                  @click="close()">
                  <span class="sr-only">Close</span>
                  <XMarkIcon
                    class="h-4 w-4 dark:text-gray-300"
                    aria-hidden="true" />
                </button>
              </div>
              <div class="overflow-y-scroll sm:flex sm:items-start">
                <!-- <div
                  class="mx-auto flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                  <QuestionMarkCircleIcon
                    class="h-4 w-4 text-indigo-600"
                    aria-hidden="true" />
                </div> -->
                <div
                  class="text-center dark:text-gray-300 sm:text-left sm:dark:ml-4 sm:dark:mt-0">
                  <DialogTitle
                    as="h3"
                    class="text-lg font-medium leading-6 text-gray-900 dark:text-jovieDark-300"
                    >Need some help?</DialogTitle
                  >
                  <div class="mt-2">
                    <p class="text-sm text-gray-500 dark:text-gray-300">
                      We're here to help. If you can't find what you're looking
                      feel free to reach out via the chat below.
                    </p>
                  </div>
                </div>
              </div>
              <ul
                class="mt-4 h-full space-y-2 text-slate-700 dark:text-jovieDark-200">
                <li v-for="(item, itemIdx) in items" :key="itemIdx">
                  <div
                    v-if="item.visible"
                    class="group relative flex h-24 items-center space-x-3 rounded-lg border border-slate-200 px-6 py-4 hover:bg-slate-200 dark:border-jovieDark-border dark:hover:bg-jovieDark-border">
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
                        class="text-sm font-medium text-slate-900 dark:text-jovieDark-100">
                        <a :href="item.href">
                          <span class="absolute inset-0" aria-hidden="true" />
                          {{ item.name }}
                        </a>
                      </div>

                      <p
                        class="text-2xs text-slate-500 dark:text-jovieDark-400">
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
              <div
                class="mt-4 rounded-md border border-slate-300 bg-slate-100 px-4 py-6 dark:border-jovieDark-border dark:bg-jovieDark-800">
                <div
                  class="prose font-bold text-slate-600 dark:text-jovieDark-300">
                  Keyboard Shortcuts
                </div>
                <div class="mt-2">
                  <p
                    class="font-semi-bold text-sm text-gray-500 dark:text-gray-300">
                    Speed up your workflow with these shortcuts.
                  </p>
                </div>
                <div class="mt-2 space-y-2 overflow-y-scroll px-4">
                  <div
                    v-for="shortcut in shortcuts"
                    :key="shortcut.id"
                    class="flex justify-between rounded-md text-xs text-slate-500 dark:text-jovieDark-300">
                    <div>{{ shortcut.text }}</div>
                    <div
                      class="rounded-md border border-slate-300 px-1 py-0.5 font-bold dark:border-jovieDark-border">
                      {{ shortcut.name }}
                    </div>
                  </div>
                </div>
              </div>

              <div
                class="mt-4 w-full items-center justify-between border-t border-slate-300 py-2 dark:border-jovieDark-border sm:flex sm:flex-row-reverse">
                <button
                  type="button"
                  class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-2 py-0.5 text-2xs font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 sm:ml-3 sm:w-auto"
                  @click="launchSupportChat()">
                  <ChatBubbleLeftIcon class="mr-2 h-3 w-3" />
                  Contact us
                </button>
                <router-link
                  class="flex items-center text-2xs text-slate-400 hover:text-slate-500 dark:text-jovieDark-300 dark:hover:text-slate-200"
                  to="/changelog">
                  <div
                    class="mr-2 rounded-full bg-indigo-600 p-1 dark:bg-indigo-400"></div>
                  Changelog
                </router-link>
              </div>
              <div class="flex justify-end">
                <span class="text-2xs text-slate-200 dark:text-jovieDark-200">
                  {{ $store.state.jovieVersion }}</span
                >
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
  ChevronRightIcon,
  HandRaisedIcon,
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
          name: 'C',
          text: 'Create new contact',
        },
        {
          id: 2,
          name: 'Shift + C',
          text: 'Bulk import new Contacts',
        },
        {
          id: 3,
          name: '?',
          text: 'Open this help menu',
        },
        {
          id: 4,
          name: 'Spacebar',
          text: 'Open the contact sidebar for the selected contact',
        },
        {
          id: 5,
          name: '/',
          text: 'Search for a contact',
        },
        {
          id: 6,
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
          name: 'Request A Feature',
          icon: HandRaisedIcon,
          description:
            'Request a feature for Jovie. We love hearing from our users.',
          href: 'https://roadmap.jov.ie',
          iconColor: 'bg-orange-500',
          visible: true,
        },
        {
          name: 'Join our Slack community',
          icon: CloudArrowUpIcon,
          //use define component t put the svg of the slack icon

          description:
            'Join our Slack community to chat with other Jovie users and the Jovie team.',
          href: '/slack-community',
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
    ChevronRightIcon,
    HandRaisedIcon,
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
