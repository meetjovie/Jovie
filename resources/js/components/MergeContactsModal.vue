<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="relative z-10" @close="closeModal">
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
                        <DialogPanel class="mx-auto w-full">
                            <GlassmorphismContainer size="6xl">
                                <div
                                    class="relative w-full transform overflow-hidden rounded-lg px-4 pb-6 pt-4">
                                    <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                                        <button
                                            type="button"
                                            class="dark:hover:text-slate-500focus-visible:outline-none rounded-md bg-white text-slate-400 hover:text-slate-500 focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 dark:bg-jovieDark-700 dark:text-jovieDark-300"
                                            @click="closeModal">
                                            <span class="sr-only">Close</span>
                                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                        </button>
                                    </div>
                                    <div class="sm:flex sm:items-start">
                                        <div
                                            class="mt-3 w-full text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <DialogTitle
                                                as="h3"
                                                class="text-lg font-medium leading-6 dark:text-jovieDark-100">
                                                Merge Contacts
                                            </DialogTitle>

                                            <p
                                                class="text-2xs text-slate-500 dark:text-jovieDark-300">
                                                Merge contacts from suggestions
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <div class="grid grid-cols-3 gap-3">
                                            <template v-for="contact in suggestion.contacts">
                                                <ContactSidebar
                                                    :jovie="true"
                                                    :contactData="contact" />
                                            </template>
                                        </div>
                                      <div class="grid grid-cols-2 gap-x-8 mt-2">
                                        <ButtonGroup
                                            :text="'Reject'"
                                            @click="rejectMerge" />
                                        <ButtonGroup
                                            :text="'Merge'"
                                            @click="acceptMerge" />
                                      </div>
                                    </div>
                                </div>
                            </GlassmorphismContainer>
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
import { XMarkIcon } from '@heroicons/vue/24/outline';
import SocialInput from '../components/SocialInput.vue';
import GlassmorphismContainer from '../components/GlassmorphismContainer.vue';
import InputGroup from "./InputGroup.vue";
import ButtonGroup from "./ButtonGroup.vue";
import ImportService from "../services/api/import.service";
import CheckboxInput from "./CheckboxInput.vue";
import ContactSidebar from "./ContactSidebar.vue";
import ContactService from "../services/api/contact.service";
export default {
    components: {
        ContactSidebar,
        CheckboxInput,
        ButtonGroup,
        InputGroup,
        Dialog,
        DialogPanel,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        XMarkIcon,
        SocialInput,
        GlassmorphismContainer,
    },
    data() {
        return {

        };
    },
    emits: ['close'],
    props: {
        open: {
            type: Boolean,
            default: false,
        },
        suggestion: {
            type: Array
        }
    },
  methods: {
        closeModal() {
            this.$emit('close')
            Object.assign(this.$data, this.$options.data());
        },
      acceptMerge() {
        console.log('lskfmnvkm', this.suggestion);
        let data = {
          contacts: []
        };
        data.contacts.push(this.suggestion.contacts[0].id)
        data.contacts.push(this.suggestion.contacts[1].id)
        ContactService.mergeContacts(data)
            .then(() => {w
              this.suggestingMerge = true
              ContactService.suggestMerge().then((response) => {
                response = response.data;
                if (response.status) {
                  // this.mergeSuggestion = response.data
                  this.suggestion.contacts = response.data.contacts
                  // if (! this.mergeSuggestion) {
                    this.$notify({
                      group: 'user',
                      type: 'success',
                      duration: 15000,
                      title: 'Successful',
                      text: response.message,
                    });
                  // } else {
                  //   this.openMergeSuggestion = true
                  // }
                } else {
                  this.$notify({
                    group: 'user',
                    type: 'success',
                    duration: 15000,
                    title: 'Successful',
                    text: response.message,
                  });
                }
              })
                  .catch((error) => {
                    error = error.response;
                    if (error.status == 422) {
                      if (this.errors) {
                        this.errors = error.data.errors;
                      }
                      this.$notify({
                        group: 'user',
                        type: 'success',
                        duration: 15000,
                        title: 'Successful',
                        text: Object.values(error.data.errors)[0][0],
                      });
                    }
                  })
                  .finally((_) => {
                    this.suggestingMerge = false
                  });
                // this.closeModal()
            })
      }
    },
};
</script>
