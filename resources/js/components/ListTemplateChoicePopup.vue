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
              <div v-if="customContent">
                <div
                  class="transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                  <slot name="content"></slot>
                </div>
              </div>
              <div
                class="transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                v-else>
                <div class="px-4 py-2">
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <DialogTitle
                      as="h3"
                      class="text-lg font-medium leading-6 text-slate-900">
                      {{ title }}
                    </DialogTitle>
                    <div class="mt-2">
                      <p class="text-sm text-slate-500">
                        {{ description }}
                      </p>
                      <slot name="content">
                        <input-group
                          label="New list name"
                          name="name"
                          id="list_name"
                          v-model="newList.name"
                        />
                        <RadioGroup
                          v-if="templates"
                          v-model="newList.template_id">
                          <RadioGroupLabel class="sr-only">VH </RadioGroupLabel>
                          <div class="space-y-2">
                            <RadioGroupOption
                              as="template"
                              v-for="template in templates"
                              :value="template.id"
                              v-slot="{ active, checked }">
                              <div
                                :class="[
                                  active
                                    ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-sky-300'
                                    : '',
                                  checked
                                    ? 'bg-sky-900 bg-opacity-75 text-white '
                                    : 'bg-white ',
                                ]"
                                class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none">
                                <div
                                  class="flex w-full items-center justify-between">
                                  <div class="shrink-0">
                                    <img
                                      style="height: 40px; width: 40px"
                                      src="https://uploads-ssl.webflow.com/626be00c3963391bdd16355c/63f4e500a5c03bbde8012c0e_24cc6a2f-9099-41c2-977b-3b09ba5dbdd6.png" />
                                  </div>
                                  <div class="flex items-center">
                                    <div class="text-sm">
                                      <RadioGroupLabel
                                        as="p"
                                        :class="
                                          checked
                                            ? 'text-white'
                                            : 'text-gray-900'
                                        "
                                        class="font-medium">
                                        {{ template.name }}
                                      </RadioGroupLabel>
                                      <RadioGroupDescription
                                        as="span"
                                        :class="
                                          checked
                                            ? 'text-sky-100'
                                            : 'text-gray-500'
                                        "
                                        class="inline">
                                        <span>{{ template.description }}</span>
                                      </RadioGroupDescription>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </RadioGroupOption>
                          </div>
                        </RadioGroup>
                      </slot>
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
                    @click="$emit('primaryButtonClick', newList)">
                    {{ primaryButtonText }}
                  </button>
                  <button
                    :disabled="loading"
                    @click="$emit('cancelButtonClick')"
                    type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-base font-medium text-slate-700 shadow-sm hover:bg-slate-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    ref="cancelButtonRef">
                    Cancel
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
  RadioGroup,
  RadioGroupDescription,
  RadioGroupLabel,
  RadioGroupOption,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue';
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline';
import TemplateService from '../services/api/template.service';
import InputGroup from './InputGroup.vue';

export default {
  components: {
    InputGroup,
    Dialog,
    DialogTitle,
    DialogPanel,
    TransitionRoot,
    TransitionChild,
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
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
  data() {
    return {
      newList: {
        name: null,
        template_id: null,
      },
      templates: [],
    };
  },
  mounted() {
    this.getTemplates();
  },
  methods: {
    getTemplates() {
      TemplateService.getTemplates()
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.templates = [];
            this.templates = response.data;
            console.log('TEMPLATES FETCHED', this.templates);
          }
        })
        .catch((error) => {
          console.log('error', error);
        });
    },
  },
};
</script>
