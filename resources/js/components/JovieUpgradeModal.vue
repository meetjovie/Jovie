<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="cloese()">
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

      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div
          class="flex min-h-full items-end justify-center p-4 sm:items-center sm:p-0">
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel
              class="relative transform overflow-hidden rounded-lg text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-5xl">
              <div
                class="flex h-full w-full items-center border border-gray-200 bg-white/90 backdrop-blur-xl backdrop-filter dark:border-jovieDark-border dark:bg-jovieDark-900/90">
                <div class="h-full w-1/2 items-center px-6">
                  <div class="mx-auto px-8">
                    <div
                      class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 dark:bg-indigo-400">
                      <CheckIcon
                        class="h-6 w-6 text-slate-300 dark:text-jovieDark-50"
                        aria-hidden="true" />
                    </div>
                    <div class="mt-3 sm:mt-5">
                      <DialogTitle
                        as="h3"
                        class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
                        {{ title }}
                        Your workspace is on a free plan</DialogTitle
                      >
                      <div class="mt-2">
                        <p
                          class="text-sm text-gray-500 dark:text-jovieDark-400">
                          Upgrade to remove limits & unlock more features.
                        </p>
                      </div>
                      <div class="mt-2">
                        <ProgressBar
                          invertedColor
                          :percentage="
                            100 -
                            (currentUser.current_team.credits /
                              (currentUser.current_team.current_subscription
                                ?.credits || 10)) *
                              100
                          "
                          :label="
                            (currentUser.current_team.current_subscription
                              ?.credits || 10) -
                            currentUser.current_team.credits +
                            ' of ' +
                            (currentUser.current_team.current_subscription
                              ?.credits || 10) +
                            ' contacts'
                          " />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="w-1/2 items-center px-6 py-12">
                  <div class="w-full px-8">
                    <h2 class="">
                      <span
                        class="text-md font-bold text-slate-900 dark:text-jovieDark-100"
                        >Upgrade to access:</span
                      >
                    </h2>
                    <ul class="mt-4 w-full space-y-4">
                      <li
                        v-for="feature in features"
                        :key="feature.name"
                        class="flex">
                        <component
                          :is="feature.icon"
                          class="mr-2 h-5 w-5 text-indigo-700 dark:text-indigo-300" />
                        <div class="">
                          <span
                            class="text-xs text-slate-700 dark:text-jovieDark-200"
                            >{{ feature.name }}</span
                          >
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div
                class="flex w-full items-center justify-end bg-white px-4 dark:bg-jovieDark-800">
                <div class="flex items-center justify-end py-4">
                  <button
                    type="button"
                    class="mt-3 inline-flex w-full justify-center px-4 py-2 text-base font-medium text-gray-700 focus:outline-none focus:ring-0 dark:text-jovieDark-300 sm:col-start-1 sm:mt-0 sm:text-sm"
                    @click="open = false"
                    ref="cancelButtonRef">
                    Dismiss
                  </button>
                  <router-link to="/billing">
                    <button
                      type="button"
                      class="flex w-40 justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm line-clamp-1 hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 sm:col-start-2 sm:text-sm"
                      @click="open = false">
                      Choose plan
                    </button>
                  </router-link>
                </div>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue';

import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue';
import ProgressBar from '../components/ProgressBar.vue';
import {
  DocumentDuplicateIcon,
  ChatBubbleOvalLeftIcon,
  GlobeAmericasIcon,
  UserGroupIcon,
  PlusIcon,
} from '@heroicons/vue/24/outline';
import { CheckIcon } from '@heroicons/vue/24/solid';

const features = [
  {
    name: 'Priority support',
    icon: ChatBubbleOvalLeftIcon,
  },
  {
    name: 'Bulk imports',
    icon: DocumentDuplicateIcon,
  },
  {
    name: '500+ Contacts/mo',
    icon: CheckIcon,
  },

  {
    name: 'Unlimited use of Chrome Extension',
    icon: GlobeAmericasIcon,
  },
  {
    name: 'Early access to new features',
    icon: UserGroupIcon,
  },
  //and more
  {
    name: 'And more...',
    icon: PlusIcon,
  },
];
</script>
<script>
export default {
  props: {
    open: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    close() {
      this.open = false;
      //emit
      this.$emit('close');
    },
  },
};
</script>
