<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="closeModal">
      <div class="fixed inset-0 bg-black/30" aria-hidden="true" />
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
              <GlassmorphismContainer
                class="bg-whit dark:bg-jovieDark-900"
                size="xl">
                <div class="relative w-full transform overflow-hidden">
                  <div>
                    <div class="mt-2" v-if="fromSocial">
                      <SocialInput
                        :list="list"
                        v-model="socialMediaProfileUrl"
                        @finishImport="closeModal" />
                    </div>
                    <div class="" v-else>
                      <form action="#" class="relative">
                        <div
                          class="overflow-hidden rounded-lg border border-gray-300 px-2 shadow-sm dark:border-jovieDark-border">
                          <!--  <ContactAvatar /> -->
                          <div class="mt-2 flex items-center justify-between">
                            <div class="flex items-center">
                              <div
                                class="inline-flex items-center rounded border border-slate-200 bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-600 shadow-sm ring-1 ring-inset ring-gray-500/10 dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-jovieDark-200">
                                <InitialBox
                                  :name="
                                    currentUser.current_team.emoji ||
                                    currentUser.current_team.name
                                  "
                                  :height="12" />
                                <span class="ml-1"
                                  >{{ currentUser.current_team.name }}
                                </span>
                              </div>
                              <ChevronRightIcon
                                class="mr-1 h-4 w-4 text-slate-500 dark:text-jovieDark-300" />
                              <span
                                class="items-center text-2xs font-semibold text-slate-400 dark:text-jovieDark-100"
                                >New contact</span
                              >
                            </div>
                            <button
                              type="button"
                              class="rounded-md text-slate-400 hover:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 dark:bg-jovieDark-700 dark:text-jovieDark-300 dark:hover:text-slate-500"
                              @click="closeModal">
                              <span class="sr-only">Close</span>
                              <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                            </button>
                          </div>
                          <div class="mt-4 flex w-full items-center px-4">
                            <div class="px-2">
                              <ContactAvatar
                                @updateAvatar="contact.profile_pic = $event"
                                :contact="contact"
                                :editable="true"
                                class="h-14 w-14 flex-shrink-0 text-gray-300" />
                            </div>

                            <div class="">
                              <label for="first_name" class="sr-only"
                                >First Name</label
                              >
                              <input
                                ref="initialFocus"
                                type="text"
                                :disabled="importing"
                                name="first_name"
                                tabindex="-1"
                                id="first_name"
                                class="z-20 block w-32 border-0 bg-transparent px-4 pt-2.5 text-lg font-bold tracking-tight placeholder-shown:w-32 placeholder-shown:text-slate-400 focus:ring-0 focus:placeholder:text-slate-300"
                                placeholder="First Name"
                                v-model="contact.first_name" />
                            </div>
                            <div
                                class="h-6 w-full justify-start py-1 text-xs text-red-600 dark:text-red-400">
                            <span v-if="errors.first_name">
                              {{ errors.first_name[0] }}</span
                            >
                            </div>

                            <label for="first_name" class="sr-only"
                              >Last Name</label
                            >
                            <input
                              type="text"
                              :disabled="importing"
                              name="last_name"
                              tabindex="-1"
                              id="last_name"
                              class="block w-full border-0 bg-transparent pt-2.5 text-lg font-bold tracking-tight placeholder-shown:text-slate-400 focus:ring-0 focus:placeholder:text-slate-300"
                              placeholder="Last Name"
                              v-model="contact.last_name" />
                          </div>

                          <label for="description" class="sr-only"
                            >Description</label
                          >
                          <!--  <textarea
                            rows="2"
                            name="description"
                            id="description"
                            class="block w-full resize-none border-0 py-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Write a description..." /> -->
                          <div
                            class="mt-2 flex h-80 flex-col space-y-4 overflow-y-scroll px-4">
                            <template v-for="field in contactFields">
                              <DataInputGroup
                                v-model="contact[field.model]"
                                :id="field.model"
                                :disabled="importing"
                                :sortable="false"
                                :name="field.model"
                                :label="field.name"
                                :icon="field.icon"
                                :socialicon="field.socialicon"
                                :placeholder="field.placeholder"
                                type="text"
                                required="" />
                            </template>
                          </div>
                          <InputLists
                            @updateLists="updateContactLists"
                            :contactId="contact.id ?? 0"
                            :lists="contact.user_lists" />
                          <!-- Spacer element to match the height of the toolbar -->
                          <div aria-hidden="true">
                            <div class="py-2">
                              <div class="h-9" />
                            </div>
                            <div class="h-px" />
                            <div class="py-2">
                              <div class="py-px">
                                <div class="h-9" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="absolute inset-x-px bottom-0">
                          <div
                            class="flex items-center justify-between space-x-4 border-t border-slate-200 px-2 py-2 dark:border-jovieDark-border">
                            <div
                              v-if="!enrichable"
                              class="flex w-full justify-end space-x-2">
                              <ButtonGroup
                                @click="importContact"
                                :loader="importing"
                                icon="UserPlusIcon"
                                design="secondary"
                                class="border"
                                text="Create contact" />
                            </div>
                            <div
                              v-else
                              class="flex w-full items-center justify-between">
                              <div
                                class="items-center text-xs font-light text-slate-400 dark:text-jovieDark-300">
                                Contact already exists. Override?
                                <CheckboxInput v-model="contact.override" />
                              </div>
                              <div class="flex items-center space-x-2">
                                <ButtonGroup
                                  design="secondary"
                                  icon="UserPlusIcon"
                                  class="border"
                                  size="sm"
                                  @click="importContact"
                                  :loader="importing"
                                  text="Create without enriching" />
                                <ButtonGroup
                                  :loader="importing"
                                  icon="SparklesIcon"
                                  size="sm"
                                  @click="importContactWithEnrich"
                                  class="border"
                                  text="Create & Enrich" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <ModalPopup
                          modalType="info"
                          :open="autoEnrichmentPopup.open"
                          :loading="autoEnrichmentPopup.loading"
                          :title="autoEnrichmentPopup.title"
                          :description="autoEnrichmentPopup.description"
                          :primaryButtonText="
                            autoEnrichmentPopup.primaryButtonText
                          "
                          secondaryButtonText="No"
                          @primaryButtonClick="autoEnrichment"
                          @cancelButtonClick="cancelAutoEnrichment">
                        </ModalPopup>
                      </form>
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
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue';
import {
  XMarkIcon,
  UserGroupIcon,
  ChevronRightIcon,
} from '@heroicons/vue/24/outline';
import InitialBox from '../components/InitialBox.vue';
import SocialInput from '../components/SocialInput.vue';
import GlassmorphismContainer from '../components/GlassmorphismContainer.vue';
import InputGroup from './InputGroup.vue';
import ButtonGroup from './ButtonGroup.vue';
import ImportService from '../services/api/import.service';
import CheckboxInput from './CheckboxInput.vue';
import ContactAvatar from './ContactAvatar.vue';

import InputLists from './InputLists.vue';
import DataInputGroup from './DataInputGroup.vue';
import ModalPopup from './ModalPopup.vue';
import TeamService from '../services/api/team.service';
export default {
  components: {
    ModalPopup,
    DataInputGroup,
    CheckboxInput,
    ButtonGroup,
    InputGroup,
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
    ContactAvatar,
    InputLists,
    ChevronRightIcon,
    UserGroupIcon,
    InitialBox,
    XMarkIcon,
    SocialInput,
    GlassmorphismContainer,
  },
  data() {
    return {
      importing: false,
      autoEnrichmentSetting: true,
      autoEnrichmentPopup: {
        confirmationMethod: null,
        title: 'Auto contact enrichment',
        open: false,
        primaryButtonText: 'Yes',
        description: 'Do you want to automatically enrich contacts on import?',
        loading: false,
      },
      contact: {
        id: 0,
        profile_pic: '',
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
        override: false,
        enrich: false,
        user_lists: [],
        list_id: [],
      },
      fields: [
        {
          name: 'First Name',
          icon: 'UserIcon',
          model: 'first_name',
          placeholder: 'First Name',
        },
        {
          name: 'Last Name',
          icon: 'UserIcon',
          model: 'last_name',
          placeholder: 'Last Name',
        },
        {
          name: 'Email',
          icon: 'EnvelopeIcon',
          model: 'emails',
          placeholder: 'Email',
        },
        {
          name: 'Phone',
          icon: 'PhoneIcon',
          model: 'phones',
          placeholder: 'Phone',
        },
        {
          name: 'Website',
          icon: 'LinkIcon',
          model: 'website',
          placeholder: 'Website',
        },
        {
          name: 'Instagram',
          socialicon: 'instagram',
          actionIcon2: 'ArrowTopRightOnSquareIcon',
          model: 'instagram',
          method2: 'instagramDMContact',
          placeholder: 'Instagram',
        },
        {
          name: 'Twitter',
          socialicon: 'twitter',
          model: 'twitter',

          placeholder: 'Twitter',
        },
        {
          name: 'TikTok',
          socialicon: 'tiktok',
          model: 'tiktok',
          placeholder: 'TikTok',
        },
        {
          name: 'Youtube',
          socialicon: 'youtube',
          model: 'youtube',
          placeholder: 'Youtube',
        },
        {
          name: 'Twitch',
          socialicon: 'twitch',
          model: 'twitch',
          placeholder: 'Twitch',
        },
        {
          name: 'Linkedin',
          socialicon: 'linkedin',
          model: 'linkedin',
          placeholder: 'Linkedin',
        },
      ],
      socialMediaProfileUrl: '',
      errors: {},
    };
  },
  props: {
    open: {
      type: Boolean,
      default: false,
    },
    list: {},
    fromSocial: {
      type: Boolean,
      default: false,
    },
  },
  watch: {
    list: {
      deep: true,
      immediate: true,
      handler(val) {
        if (val && val.id) {
          this.contact.user_lists = [];
          let payload = {
            list: val,
            add: true,
          };
          this.updateContactLists(payload);
        }
      },
    },
  },
  computed: {
    firstNameWidth() {
      // Calculate the width based on the length of this.contact.first_name
      return Math.max(this.contact.first_name.length * 8, 14);
    },
    enrichable() {
      return (
        this.contact.instagram.trim() != '' ||
        this.contact.twitter.trim() != '' ||
        this.contact.twitch.trim() != '' ||
        this.contact.linkedin.trim() != '' ||
        this.contact.titkok.trim() != '' ||
        this.contact.snapchat.trim() != '' ||
        this.contact.youtube.trim() != ''
      );
    },
    contactFields() {
      return this.fields.filter(
        (field) =>
          field.model != 'override' &&
          field.model != 'list_id' &&
          field.model != 'first_name' &&
          field.model != 'last_name' &&
          field.model != 'profile_pic_url' &&
          field.model != 'profile_pic' &&
          field.model != 'id' &&
          field.model != 'user_lists'
      );
    },
  },
  methods: {
    closeModal() {
      this.$emit('closeModal');
      Object.assign(this.$data, this.$options.data());
    },
    pasteFromClipboard() {
      navigator.clipboard.readText().then((text) => {
        //set it as the socialMediaProfileUrl
        this.socialMediaProfileUrl = text;
      });
    },
    updateContactLists(payload) {
      if (payload.add) {
        if (
          !this.contact.user_lists.filter((l) => l.id === payload.list.id)
            .length
        ) {
          this.contact.user_lists.push(payload.list);
          console.log('this.contact.user_lists');
          console.log(this.contact.user_lists);
        }
        if (!this.contact.list_id.includes(payload.list.id)) {
          this.contact.list_id.push(payload.list.id);
        }
      } else {
        this.contact.user_lists = this.contact.user_lists.filter(
          (l) => l.id !== payload.list.id
        );
        this.contact.list_id = this.contact.list_id.filter(
          (id) => id !== payload.list.id
        );
      }
    },
    importContactWithEnrich() {
      if (!this.currentUser.workspace_preferences.auto_enrich_import) {
        this.autoEnrichmentPopup.open = true;
      } else {
        this.importContact(true);
      }
    },
    autoEnrichment() {
      this.autoEnrichmentPopup.open = false;
      if (this.autoEnrichmentSetting) {
        this.updateEnrichmentSetting({
          teamSettings: { auto_enrich_import: { value: true } },
        });
      }
      this.importContact(true);
    },
    cancelAutoEnrichment() {
      this.autoEnrichmentPopup.open = false;
      this.importContact(true);
    },
    updateEnrichmentSetting(data) {
      TeamService.updateTeamSettings(data, this.currentUser.current_team.id)
        .then((response) => {
          response = response.data;
          this.currentUser.workspace_preferences.auto_enrich_import =
            response.data.auto_enrich_import.value;
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          console.log('fetched');
        });
    },
    importContact(enrich = false) {
      this.importing = true;
      this.contact.list_id = this.contact.list_id
        ? this.contact.list_id
        : this.list
        ? this.list
        : '';
      this.contact.enrich = enrich;
      let contact = JSON.parse(JSON.stringify(this.contact));
      contact.profile_pic_url = contact.profile_pic;
      ImportService.importContact(contact)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              title: 'Imported',
              text: response.message,
            });
            this.closeModal();
            this.$emit('contactImported', {
              contact: response.contact,
              list: response.list,
            });
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
          if (error.response && error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        })
        .finally((response) => {
          this.importing = false;
        });
    },
  },
};
</script>
