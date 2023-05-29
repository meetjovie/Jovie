<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="open = false">
      <TransitionChild
        as="template"
        enter="ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in duration-200"
        leave-from="opacity-100"
        leave-to="opacity-0">
        <div
          class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div
          class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative">
              <div
                class="transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div
                  v-if="modalLayout == 'alert'"
                  class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                  <div class="sm:flex sm:items-start">
                    <div
                      class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                      <ExclamationTriangleIcon
                        v-if="modalType === 'error'"
                        class="h-6 w-6 text-red-600"
                        aria-hidden="true" />
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                      <DialogTitle
                        as="h3"
                        class="text-lg font-medium leading-6 text-slate-900">
                        {{ title }}
                      </DialogTitle>
                      <div class="mt-2">
                        <p class="text-sm text-slate-500">
                          {{ description }}
                        </p>
                        <slot name="content"></slot>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="px-4 py-2" v-else>
                  <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <DialogTitle
                      as="h3"
                      class="text-lg font-medium leading-6 text-slate-900">
                      {{ title }}
                    </DialogTitle>
                    <div class="mt-2">
                      <p class="text-sm text-slate-500">
                        {{ description }}
                      </p>
                      <slot name="content"></slot>
                    </div>
                  </div>
                </div>
                <div
                  class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                  <button
                    :disabled="loading"
                    type="button"
                    :class="
                      modalLayout == 'alert'
                        ? 'bg-red-600 hover:bg-red-700'
                        : 'bg-indigo-600 hover:bg-indigo-700'
                    "
                    class="inline-flex w-full justify-center rounded-md border border-transparent px-4 py-2 text-base font-medium text-white shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                    @click="$emit('primaryButtonClick')">
                    {{ primaryButtonText }}
                  </button>
                  <button
                    :disabled="loading"
                    @click="$emit('cancelButtonClick')"
                    type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-base font-medium text-slate-700 shadow-sm hover:bg-slate-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 sm:ml-3 sm:mt-0 sm:w-auto sm:text-sm"
                    ref="cancelButtonRef">
                    {{ secondaryButtonText }}
                  </button>
                </div>
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
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline';

export default {
  components: {
    Dialog,
    DialogTitle,
    DialogPanel,
    TransitionRoot,
    TransitionChild,
    ExclamationTriangleIcon,
  },
  props: {
    title: {
      type: String,
      default: 'Are you sure?',
    },
    description: {
      type: String,
      default:
        'Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.',
    },
    primaryButtonText: {
      type: String,
      default: 'Deactivate',
    },
    secondaryButtonText: {
      type: String,
      default: 'Cancel',
    },
    modalLayout: {
      type: String,
      default: 'alert',
    },
    modalType: {
      type: String,
      default: 'error',
    },
    open: {
      type: Boolean,
      default: false,
    },
    loading: {
      type: Boolean,
      default: false,
    },
    customContent: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
