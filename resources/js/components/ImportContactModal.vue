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
              <GlassmorphismContainer size="3xl">
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
                        Import a contact
                      </DialogTitle>

                      <p
                        class="text-2xs text-slate-500 dark:text-jovieDark-300">
                        Type or
                        <span
                          class="decoration cursor-pointer"
                          @click="pasteFromClipboard()"
                          >paste</span
                        >
                        a link to a social media profile.
                      </p>
                    </div>
                  </div>
                    <div>
                        <div class="mt-2" v-if="fromSocial">
                            <SocialInput
                                :list="list"
                                v-model="socialMediaProfileUrl"
                                @finishImport="closeModal" />
                        </div>
                        <div class="mt-2" v-else>
                            <template v-for="contactKey in Object.keys(contact).filter(k => k != 'override' && k != 'list_id')">
                                <InputGroup
                                    v-model="contact[contactKey]"
                                    :id="contactKey"
                                    :disabled="importing"
                                    :name="contactKey"
                                    :label="getLabel(contactKey)"
                                    :placeholder="getLabel(contactKey)"
                                    type="text"
                                    required="" />
                            </template>
                            <div>
                                <CheckboxInput v-model="contact.override" />
                                marking this will override data for all the contacts that match any of social handles if provided.
                            </div>
                            <ButtonGroup @click="importContact" :loader="importing" text="Import" />
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
export default {
  components: {
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
      importing: false,
      contact: {
          first_name: '',
          last_name: '',
          emails: '',
          phones: '',
          company: '',
          title: '',
          instagram: '',
          twitter: '',
          twitch: '',
          linkedin: '',
          titkok: '',
          snapchat: '',
          youtube: '',
          override: false
      },
      socialMediaProfileUrl: ''
    };
  },
  props: {
    open: {
      type: Boolean,
      default: false,
    },
    list: {
    },
    fromSocial: {
      type: Boolean,
      default: false
    }
  },
  methods: {
      closeModal() {
          this.$emit('closeModal')
          Object.assign(this.$data, this.$options.data());
      },
      getLabel(contactKey) {
          return contactKey.split('_').join(' ')
      },
    pasteFromClipboard() {
      navigator.clipboard.readText().then((text) => {
        //set it as the socialMediaProfileUrl
        this.socialMediaProfileUrl = text;
      });
    },
      importContact() {
          this.importing = true
          this.contact.list_id = this.list ? this.list : ''
          ImportService.importContact(this.contact)
              .then((response) => {
                  response = response.data;
                  if (response.status) {
                      this.$notify({
                          group: 'user',
                          type: 'success',
                          title: 'Imported',
                          text: response.message,
                      });
                      this.closeModal()
                      this.$emit('contactImported', {contact: response.contact, list: response.list})
                  } else {
                      this.$notify({
                          group: 'user',
                          type: 'error',
                          title: 'Error',
                          text: response.message,
                      });
                  }
              })
              .catch((error) => {
                  error = error.response;
                  if (error.status == 422) {
                      this.errors = error.data.errors;
                  }
              })
              .finally((response) => {
                  this.importing = false
              });
      }
  },
};
</script>
