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
              <GlassmorphismContainer size="xl">
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
                          class="overflow-hidden rounded-lg border border-gray-300 shadow-sm">
                          <!--  <ContactAvatar /> -->
                          <div
                            class="mt-2 flex items-center justify-between px-2">
                            <div class="flex items-center">
                              <span
                                class="inline-flex items-center rounded-md bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10"
                                >{{ currentUser.current_team.name }}</span
                              >
                              <ChevronRightIcon class="h-3 mr-1 w-4" />
                              <span
                                class="ml-2 items-center text-2xs font-semibold text-slate-400 dark:text-jovieDark-100"
                                > New contact</span
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
                          <div class="mt-4 flex px-4">
                            <UserCircleIcon
                              class="h-14 w-14 flex-shrink-0 text-gray-300 sm:-ml-1"
                              aria-hidden="true" />
                            <label for="first_name" class="sr-only"
                              >First Name</label
                            >
                            <input
                              type="text"
                              :disabled="importing"
                              name="first_name"
                              tabindex="0"
                              id="first_name"
                              class="w-38 block border-0 bg-transparent pt-2.5 text-lg font-bold tracking-tight placeholder-shown:w-28 placeholder-shown:text-slate-400 focus:ring-0 focus:placeholder:text-slate-300"
                              placeholder="First Name"
                              v-model="contact.first_name" />
                            <label for="first_name" class="sr-only"
                              >Last Name</label
                            >
                            <input
                              type="text"
                              :disabled="importing"
                              name="last_name"
                              tabindex="0"
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
                          <div class="mt-8 flex flex-col space-y-4 px-4">
                            <template
                              v-for="contactKey in Object.keys(contact).filter(
                                (k) => k != 'override' && k != 'list_id'
                              )">
                              <DataInputGroup
                                v-model="contact[contactKey]"
                                :id="contactKey"
                                :disabled="importing"
                                :sortable="false"
                                :name="contactKey"
                                :label="getLabel(contactKey)"
                                :placeholder="getLabel(contactKey)"
                                type="text"
                                required="" />
                            </template>
                          </div>
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
                          <!--  <div
                            class="flex flex-nowrap justify-end space-x-2 px-2 py-2 sm:px-3">
                            <Listbox
                              as="div"
                              v-model="assigned"
                              class="flex-shrink-0">
                              <ListboxLabel class="sr-only"
                                >Assign</ListboxLabel
                              >
                              <div class="relative">
                                <ListboxButton
                                  class="relative inline-flex items-center whitespace-nowrap rounded-full bg-gray-50 px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 sm:px-3">
                                  <UserCircleIcon
                                    v-if="assigned.value === null"
                                    class="h-5 w-5 flex-shrink-0 text-gray-300 sm:-ml-1"
                                    aria-hidden="true" />

                                  <img
                                    v-else
                                    :src="assigned.avatar"
                                    alt=""
                                    class="h-5 w-5 flex-shrink-0 rounded-full" />

                                  <span
                                    :class="[
                                      assigned.value === null
                                        ? ''
                                        : 'text-gray-900',
                                      'hidden truncate sm:ml-2 sm:block',
                                    ]"
                                    >{{
                                      assigned.value === null
                                        ? 'Assign'
                                        : assigned.name
                                    }}</span
                                  >
                                </ListboxButton>

                                <transition
                                  leave-active-class="transition ease-in duration-100"
                                  leave-from-class="opacity-100"
                                  leave-to-class="opacity-0">
                                  <ListboxOptions
                                    class="absolute right-0 z-10 mt-1 max-h-56 w-52 overflow-auto rounded-lg bg-white py-3 text-base shadow ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                    <ListboxOption
                                      as="template"
                                      v-for="assignee in assignees"
                                      :key="assignee.value"
                                      :value="assignee"
                                      v-slot="{ active }">
                                      <li
                                        :class="[
                                          active ? 'bg-gray-100' : 'bg-white',
                                          'relative cursor-default select-none px-3 py-2',
                                        ]">
                                        <div class="flex items-center">
                                          <img
                                            v-if="assignee.avatar"
                                            :src="assignee.avatar"
                                            alt=""
                                            class="h-5 w-5 flex-shrink-0 rounded-full" />
                                          <UserCircleIcon
                                            v-else
                                            class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            aria-hidden="true" />
                                          <span
                                            class="ml-3 block truncate font-medium"
                                            >{{ assignee.name }}</span
                                          >
                                        </div>
                                      </li>
                                    </ListboxOption>
                                  </ListboxOptions>
                                </transition>
                              </div>
                            </Listbox>

                            <Listbox
                              as="div"
                              v-model="labelled"
                              class="flex-shrink-0">
                              <ListboxLabel class="sr-only"
                                >Add a label</ListboxLabel
                              >
                              <div class="relative">
                                <ListboxButton
                                  class="relative inline-flex items-center whitespace-nowrap rounded-full bg-gray-50 px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 sm:px-3">
                                  <TagIcon
                                    :class="[
                                      labelled.value === null
                                        ? 'text-gray-300'
                                        : 'text-gray-500',
                                      'h-5 w-5 flex-shrink-0 sm:-ml-1',
                                    ]"
                                    aria-hidden="true" />
                                  <span
                                    :class="[
                                      labelled.value === null
                                        ? ''
                                        : 'text-gray-900',
                                      'hidden truncate sm:ml-2 sm:block',
                                    ]"
                                    >{{
                                      labelled.value === null
                                        ? 'Label'
                                        : labelled.name
                                    }}</span
                                  >
                                </ListboxButton>

                                <transition
                                  leave-active-class="transition ease-in duration-100"
                                  leave-from-class="opacity-100"
                                  leave-to-class="opacity-0">
                                  <ListboxOptions
                                    class="absolute right-0 z-10 mt-1 max-h-56 w-52 overflow-auto rounded-lg bg-white py-3 text-base shadow ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                    <ListboxOption
                                      as="template"
                                      v-for="label in labels"
                                      :key="label.value"
                                      :value="label"
                                      v-slot="{ active }">
                                      <li
                                        :class="[
                                          active ? 'bg-gray-100' : 'bg-white',
                                          'relative cursor-default select-none px-3 py-2',
                                        ]">
                                        <div class="flex items-center">
                                          <span
                                            class="block truncate font-medium"
                                            >{{ label.name }}</span
                                          >
                                        </div>
                                      </li>
                                    </ListboxOption>
                                  </ListboxOptions>
                                </transition>
                              </div>
                            </Listbox>

                            <Listbox
                              as="div"
                              v-model="dated"
                              class="flex-shrink-0">
                              <ListboxLabel class="sr-only"
                                >Add a due date</ListboxLabel
                              >
                              <div class="relative">
                                <ListboxButton
                                  class="relative inline-flex items-center whitespace-nowrap rounded-full bg-gray-50 px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 sm:px-3">
                                  <CalendarIcon
                                    :class="[
                                      dated.value === null
                                        ? 'text-gray-300'
                                        : 'text-gray-500',
                                      'h-5 w-5 flex-shrink-0 sm:-ml-1',
                                    ]"
                                    aria-hidden="true" />
                                  <span
                                    :class="[
                                      dated.value === null
                                        ? ''
                                        : 'text-gray-900',
                                      'hidden truncate sm:ml-2 sm:block',
                                    ]"
                                    >{{
                                      dated.value === null
                                        ? 'Due date'
                                        : dated.name
                                    }}</span
                                  >
                                </ListboxButton>

                                <transition
                                  leave-active-class="transition ease-in duration-100"
                                  leave-from-class="opacity-100"
                                  leave-to-class="opacity-0">
                                  <ListboxOptions
                                    class="absolute right-0 z-10 mt-1 max-h-56 w-52 overflow-auto rounded-lg bg-white py-3 text-base shadow ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                    <ListboxOption
                                      as="template"
                                      v-for="dueDate in dueDates"
                                      :key="dueDate.value"
                                      :value="dueDate"
                                      v-slot="{ active }">
                                      <li
                                        :class="[
                                          active ? 'bg-gray-100' : 'bg-white',
                                          'relative cursor-default select-none px-3 py-2',
                                        ]">
                                        <div class="flex items-center">
                                          <span
                                            class="block truncate font-medium"
                                            >{{ dueDate.name }}</span
                                          >
                                        </div>
                                      </li>
                                    </ListboxOption>
                                  </ListboxOptions>
                                </transition>
                              </div>
                            </Listbox>
                          </div> -->
                          <div
                            class="flex items-center justify-between space-x-3 border-t border-gray-200 px-2 py-2 sm:px-3">
                            <div class="flex">
                              <InputLists
                                @updateLists="updateContactLists"
                                :contactId="contact.id ?? 0"
                                :lists="contact.user_lists"
                                :currentList="contact.current_list" />
                              <!--  <button
                                type="button"
                                class="group -my-2 -ml-2 inline-flex items-center rounded-full px-3 py-2 text-left text-gray-400">
                                <PaperClipIcon
                                  class="-ml-1 mr-2 h-4 w-4 group-hover:text-gray-500"
                                  aria-hidden="true" />
                              </button> -->
                            </div>
                            <div
                              class="flex flex-shrink-0 items-center justify-end">
                              <div
                                class="mr-2 text-xs font-light text-slate-400 dark:text-jovieDark-300">
                                <CheckboxInput v-model="contact.override" />

                                Override data
                              </div>
                              <ButtonGroup
                                @click="importContact"
                                :loader="importing"
                                design="compact"
                                text="Create contact" />
                            </div>
                          </div>
                        </div>
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
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue';
import { XMarkIcon, UserCircleIcon, ChevronRightIcon } from '@heroicons/vue/24/outline';
import SocialInput from '../components/SocialInput.vue';
import GlassmorphismContainer from '../components/GlassmorphismContainer.vue';
import InputGroup from './InputGroup.vue';
import ButtonGroup from './ButtonGroup.vue';
import ImportService from '../services/api/import.service';
import CheckboxInput from './CheckboxInput.vue';
import ContactAvatar from './ContactAvatar.vue';
import ToggleGroup from './ToggleGroup.vue';
import InputLists from './InputLists.vue';
import DataInputGroup from './DataInputGroup.vue';
export default {
  components: {
    DataInputGroup,
    CheckboxInput,
    ButtonGroup,
    InputGroup,
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    ContactAvatar,
    ToggleGroup,
    InputLists,
    ChevronRightIcon,
    XMarkIcon,
    SocialInput,
    GlassmorphismContainer,
    UserCircleIcon,
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
        override: false,
      },
      socialMediaProfileUrl: '',
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
  methods: {
    closeModal() {
      this.$emit('closeModal');
      Object.assign(this.$data, this.$options.data());
    },
    getLabel(contactKey) {
      return contactKey.split('_').join(' ');
    },
    pasteFromClipboard() {
      navigator.clipboard.readText().then((text) => {
        //set it as the socialMediaProfileUrl
        this.socialMediaProfileUrl = text;
      });
    },
    importContact() {
      this.importing = true;
      this.contact.list_id = this.list ? this.list : '';
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
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally((response) => {
          this.importing = false;
        });
    },
  },
};
</script>
<script setup>
import { ref } from 'vue';
import {
  Listbox,
  ListboxButton,
  ListboxLabel,
  ListboxOption,
  ListboxOptions,
} from '@headlessui/vue';
import { CalendarIcon, PaperClipIcon, TagIcon } from '@heroicons/vue/20/solid';

const assignees = [
  { name: 'Unassigned', value: null },
  {
    name: 'Wade Cooper',
    value: 'wade-cooper',
    avatar:
      'https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
  },
  // More items...
];
const labels = [
  { name: 'Unlabelled', value: null },
  { name: 'Engineering', value: 'engineering' },
  // More items...
];
const dueDates = [
  { name: 'No due date', value: null },
  { name: 'Today', value: 'today' },
  // More items...
];

const assigned = ref(assignees[0]);
const labelled = ref(labels[0]);
const dated = ref(dueDates[0]);
</script>
