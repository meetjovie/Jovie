<template>
  <div>
    <div
      class="group flex cursor-pointer items-center justify-between rounded-md py-1">
      <div
        @click="toggleShowMenu()"
        class="flex cursor-pointer items-center rounded-md py-0.5 pl-1 pr-2 text-xs font-medium tracking-wider text-slate-800 hover:bg-slate-100 hover:text-slate-900 dark:text-jovieDark-200 dark:hover:bg-jovieDark-border dark:hover:bg-jovieDark-800 dark:hover:text-slate-100">
        <ChevronDownIcon
          v-if="showMenu"
          class="mt-0.5 mr-1 h-4 w-4 text-slate-700 group-hover:text-slate-800 dark:text-jovieDark-300 group-hover:dark:text-jovieDark-200" />
        <ChevronRightIcon
          v-else
          class="text-thin mr-1 h-4 w-4 text-xs text-slate-700 group-hover:text-slate-800 dark:text-jovieDark-300 dark:group-hover:text-slate-200" />
        {{ menuName }}
      </div>
      <div class="flex items-center overflow-auto">
        <div
          v-if="draggable"
          class="group mx-auto overflow-y-scroll rounded-md p-1 text-slate-400 transition-all hover:bg-slate-300 hover:text-slate-50 dark:text-jovieDark-400 dark:hover:bg-jovieDark-600 dark:hover:bg-jovieDark-border dark:hover:text-slate-800">
          <PlusIcon
            v-if="!creatingList"
            @click="createList()"
            class="h-4 w-4"></PlusIcon>
          <JovieSpinner
            spinnerSize="xs"
            spinnerColor="neutral"
            v-if="creatingList" />
        </div>
      </div>
    </div>
    <ul v-if="showMenu && draggable" class="overflow-auto">
      <draggable
        v-model="menuItemsList"
        group="lists"
        class="select-none overflow-y-scroll"
        ghost-class="ghost-card"
        itemKey="id"
        @change="$emit('sort')">
        <template #item="{ element, index }">
          <div :key="element.id" :id="element.id">
            <MenuItem
              @drop="$emit('onListDrop', element.id)"
              @click="$emit('setFilterList', element.id)"
              v-slot="{ active }">
              <div
                :class="{ 'bg-slate-200 dark:bg-jovieDark-500': active }"
                class="group/list inline-flex h-8 w-full select-none items-center justify-between rounded-md pl-1 transition-all">
                <div
                  class="group/move mx-auto w-4 flex-none cursor-grab items-center">
                  <Bars3Icon
                    class="h-3 w-3 text-slate-700/0 active:text-slate-900 group-hover/list:text-slate-900 dark:text-jovieDark-300/0 dark:active:text-slate-100 dark:group-hover/list:text-slate-100"></Bars3Icon>
                </div>

                <div class="flex w-full items-center">
                  <!-- <div
                    @click="openEmojiPicker(element)"
                    :class="{
                      'bg-slate-200 hover:bg-slate-700 dark:bg-jovieDark-700 hover:dark:bg-jovieDark-900':
                        active,
                    }"
                    class="h-full w-6 cursor-pointer items-center rounded-md px-1 text-center text-xs transition-all">
                    {{ element.emoji ?? '📄' }}
                  </div> -->
                  <UserListEditable
                    :list="element"
                    @updateUserList="$emit('updateUserList', $event)" />
                  <!--                  <EmojiPickerModal-->
                  <!--                    class="mr-1"-->
                  <!--                    @emojiSelected="emojiSelected($event, element)"-->
                  <!--                    :currentEmoji="element.emoji">-->
                  <!--                  </EmojiPickerModal>-->

                  <!--                  <div-->
                  <!--                    @dblclick="enableEditName(element)"-->
                  <!--                    class="w-full cursor-pointer">-->
                  <!--                    <span-->
                  <!--                      v-if="!element.editName"-->
                  <!--                      :class="[-->
                  <!--                        selectedList == element.id-->
                  <!--                          ? 'font-bold text-slate-800 dark:text-jovieDark-200'-->
                  <!--                          : 'font-light text-slate-700 dark:text-jovieDark-300',-->
                  <!--                      ]"-->
                  <!--                      class="cursor-pointer text-xs line-clamp-1 group-hover/list:text-slate-800 dark:group-hover/list:text-slate-200"-->
                  <!--                      >{{ element.name }}</span-->
                  <!--                    >-->
                  <!--                    <input-->
                  <!--                      v-model="element.name"-->
                  <!--                      :ref="`list_${element.id}`"-->
                  <!--                      @blur="updateList(element)"-->
                  <!--                      @keyup.esc="disableEditName(element)"-->
                  <!--                      @keyup.enter="updateList(element)"-->
                  <!--                      v-else-->
                  <!--                      class="text-xs font-light text-slate-700 group-hover/list:text-slate-800 dark:text-jovieDark-300 dark:group-hover/list:text-slate-200" />-->
                  <!--                  </div>-->
                </div>
                <div
                  class="group mx-auto h-8 w-8 flex-none cursor-pointer items-center rounded-md p-1 text-center hover:bg-slate-300 hover:text-slate-50 hover:text-slate-700 dark:hover:bg-jovieDark-600">
                  <ArrowPathIcon
                    v-if="element.updating_list"
                    class="mx-auto mt-1 mr-2 h-4 w-4 animate-spin-slow items-center group-hover/list:hidden group-hover/list:text-slate-800 dark:group-hover/list:text-slate-200" />
                  <span
                    v-else
                    class="text-right text-xs font-light text-slate-700 group-hover:hidden group-hover:text-slate-800 dark:text-jovieDark-200 dark:group-hover:text-slate-200 dark:group-hover:text-slate-200"
                    >{{ element.creators_count }}</span
                  >

                  <Menu as="div" class="relative inline-block text-center">
                    <Float portal :offset="12" placement="right-start">
                      <div class="mx-auto text-center">
                        <MenuButton
                          class="hidden h-4 w-4 text-slate-400 group-hover:block dark:text-jovieDark-600">
                          <EllipsisHorizontalIcon
                            :class="{ 'dark:text-jovieDark-200': active }"
                            class="mt-1 h-4 w-4 text-slate-400 active:text-slate-700 dark:text-jovieDark-600 dark:text-jovieDark-600 dark:active:text-slate-200"></EllipsisHorizontalIcon>
                        </MenuButton>
                      </div>

                      <transition
                        enter-active-class="transition duration-100 ease-out"
                        enter-from-class="transform scale-95 opacity-0"
                        enter-to-class="transform scale-100 opacity-100"
                        leave-active-class="transition duration-75 ease-in"
                        leave-from-class="transform scale-100 opacity-100"
                        leave-to-class="transform scale-95 opacity-0">
                        <MenuItems
                          class="mt-2 w-28 origin-top-right divide-y divide-slate-100 rounded-md border border-slate-200 bg-white/60 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl backdrop-saturate-150 focus:outline-none dark:divide-slate-800 dark:divide-slate-800 dark:border-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-900/60">
                          <div class="px-1 py-1">
                            <MenuItem v-slot="{ active }">
                              <button
                                @click="editList(element)"
                                :class="[
                                  active
                                    ? 'bg-slate-200  dark:bg-jovieDark-700 dark:text-jovieDark-200'
                                    : 'text-slate-900 dark:text-jovieDark-100',
                                  'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                                ]">
                                <PencilSquareIcon
                                  :active="active"
                                  class="mr-2 h-4 w-4 text-sky-400"
                                  aria-hidden="true" />
                                Edit List
                              </button>
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                              <button
                                @click="duplicateList(element.id)"
                                :class="[
                                  active
                                    ? 'bg-slate-200 dark:bg-jovieDark-500 dark:text-jovieDark-200'
                                    : 'text-slate-900 dark:text-jovieDark-100',
                                  'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                                ]">
                                <DocumentDuplicateIcon
                                  :active="active"
                                  class="mr-2 h-3 w-3 text-teal-400 hover:text-slate-700"
                                  aria-hidden="true" />
                                Duplicate
                              </button>
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                              <button
                                @click="unpinList(element.id)"
                                :class="[
                                  active
                                    ? 'bg-slate-200 dark:bg-jovieDark-500 dark:text-jovieDark-200'
                                    : 'text-slate-900 dark:text-jovieDark-100',
                                  'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                                ]">
                                <PinIcon
                                  :active="active"
                                  class="mr-2 h-3 w-3 text-indigo-400 hover:text-slate-700 dark:text-indigo-700 dark:hover:text-slate-300"
                                  aria-hidden="true" />
                                Pin List
                              </button>
                            </MenuItem>
                          </div>

                          <div class="px-1 py-1">
                            <MenuItem v-slot="{ active }">
                              <button
                                @click="confirmListDeletion(element.id)"
                                :class="[
                                  active
                                    ? 'bg-slate-200 dark:bg-jovieDark-500 dark:text-jovieDark-200'
                                    : 'text-slate-900 dark:text-jovieDark-100',
                                  'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                                ]">
                                <TrashIcon
                                  :active="active"
                                  class="mr-2 h-3 w-3 text-slate-400 dark:text-jovieDark-600"
                                  aria-hidden="true" />
                                Delete List
                              </button>
                            </MenuItem>
                          </div>
                        </MenuItems>
                      </transition>
                    </Float>
                  </Menu>
                </div>
              </div>
            </MenuItem>
          </div>
        </template>
        <div v-for="element in myArray" :key="element.id">
          {{ element.name }}
        </div>
      </draggable>
    </ul>
    <ul v-if="showMenu && !draggable" class="">
      <div v-for="item in menuItems" :key="item.id">
        <MenuItem @click="$emit('setFilterList', item.id)" v-slot="{ active }">
          <div
            :class="{ 'bg-slate-200 dark:bg-jovieDark-500': active }"
            class="group inline-flex h-8 w-8 w-full items-center justify-between rounded-md pl-1 transition-all">
            <div class="group h-4 w-4 flex-none cursor-pointer items-center">
              <PinnedIcon
                :active="active"
                class="hidden h-3 w-3 text-indigo-400 hover:bg-slate-100 hover:text-slate-700 active:text-indigo-500 group-hover:block dark:hover:bg-jovieDark-border dark:hover:bg-jovieDark-border dark:hover:text-slate-300"
                aria-hidden="true" />
            </div>

            <div class="flex w-full items-center">
              <!-- <div
                @click="openEmojiPicker(item)"
                :class="{
                  'bg-slate-200 hover:bg-slate-700 dark:bg-jovieDark-700 hover:dark:bg-jovieDark-900':
                    active,
                }"
                class="h-full w-6 cursor-pointer items-center rounded-md px-1 text-center text-xs transition-all">
                {{ item.emoji ?? '📄' }}
              </div> -->
              <UserListEditable
                :list="element"
                @updateUserList="$emit('updateUserList', $event)" />
            </div>

            <div
              class="group mx-auto h-8 w-8 flex-none cursor-pointer items-center rounded-md p-1 text-center hover:bg-slate-300 hover:text-slate-50 hover:text-slate-700 dark:hover:bg-jovieDark-600 dark:hover:text-jovieDark-200">
              <span
                class="text-right text-xs font-light text-slate-700 group-hover:hidden group-hover:text-slate-800 dark:text-jovieDark-200 dark:group-hover:text-slate-200 dark:group-hover:text-slate-200"
                >{{ item.creators_count }}</span
              >
              <Menu as="div" class="relative inline-block text-center">
                <Float portal :offset="12" placement="right-start">
                  <div class="mx-auto text-center">
                    <MenuButton
                      class="hidden h-4 w-4 text-slate-400 group-hover:block dark:bg-jovieDark-400 dark:text-jovieDark-200">
                      <EllipsisHorizontalIcon
                        class="mt-1 h-4 w-4 text-slate-400 active:text-slate-700 dark:text-jovieDark-200 dark:active:text-jovieDark-200"></EllipsisHorizontalIcon>
                    </MenuButton>
                  </div>

                  <transition
                    enter-active-class="transition duration-100 ease-out"
                    enter-from-class="transform scale-95 opacity-0"
                    enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-75 ease-in"
                    leave-from-class="transform scale-100 opacity-100"
                    leave-to-class="transform scale-95 opacity-0">
                    <MenuItems
                      class="z-40 mt-2 w-28 origin-top-right divide-y divide-slate-100 rounded-md border border-slate-200 bg-white/60 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl backdrop-saturate-150 focus:outline-none dark:divide-slate-800 dark:border-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-900/60">
                      <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                          <button
                            @click="editList(item.id)"
                            :class="[
                              active
                                ? 'bg-slate-200  dark:bg-jovieDark-700 dark:text-jovieDark-200'
                                : 'text-slate-900 dark:text-jovieDark-100',
                              'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                            ]">
                            <PencilSquareIcon
                              :active="active"
                              class="mr-2 h-4 w-4 text-sky-400"
                              aria-hidden="true" />
                            Edit List
                          </button>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                          <button
                            @click="duplicateList(item.id)"
                            :class="[
                              active
                                ? 'bg-slate-200 dark:bg-jovieDark-500 dark:text-jovieDark-200'
                                : 'text-slate-900 dark:text-jovieDark-100',
                              'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                            ]">
                            <DocumentDuplicateIcon
                              :active="active"
                              class="mr-2 h-4 w-4 text-teal-400"
                              aria-hidden="true" />
                            Duplicate
                          </button>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                          <button
                            @click="unpinList(item.id)"
                            :class="[
                              active
                                ? 'bg-slate-200 dark:bg-jovieDark-500 dark:text-jovieDark-200'
                                : 'text-slate-900 dark:text-jovieDark-100',
                              'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                            ]">
                            <PinnedIcon
                              :active="active"
                              class="mr-2 h-3 w-3 text-indigo-400"
                              aria-hidden="true" />
                            Unpin List
                          </button>
                        </MenuItem>
                      </div>

                      <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                          <button
                            @click="confirmListDeletion(item.id)"
                            :class="[
                              active
                                ? 'bg-slate-200 dark:bg-jovieDark-500 dark:text-jovieDark-200'
                                : 'text-slate-900 dark:text-jovieDark-100',
                              'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                            ]">
                            <TrashIcon
                              :active="active"
                              class="mr-2 h-4 w-4 text-slate-400 dark:text-jovieDark-600 dark:text-jovieDark-600"
                              aria-hidden="true" />
                            Delete List
                          </button>
                        </MenuItem>
                      </div>
                    </MenuItems>
                  </transition>
                </Float>
              </Menu>
            </div>
          </div>
        </MenuItem>
      </div>
    </ul>

    <ModalPopup
      :open="confirmationPopup.open"
      :loading="confirmationPopup.loading"
      :title="confirmationPopup.title"
      :description="confirmationPopup.description"
      :primaryButtonText="confirmationPopup.primaryButtonText"
      @primaryButtonClick="confirmationPopup.confirmationMethod"
      @cancelButtonClick="cancelDelete" />
    <ModalPopup
      :open="editListPopup.open"
      :loading="editListPopup.loading"
      :title="editListPopup.title"
      :description="editListPopup.description"
      :primaryButtonText="editListPopup.primaryButtonText"
      @primaryButtonClick="editListPopup.confirmationMethod"
      @cancelButtonClick="cancelEditMethod">
      <div class="space-y-8 py-4">
        <InputGroup
          autocomplete="off"
          label="List Name"
          placeholder="List Name"
          v-model="currentEditingList.name"
          class="text-xs font-medium text-slate-900 group-hover:text-slate-900" />
        <ToggleGroup v-model="currentEditingList.pinned" /><span
          class="ml-2 items-center text-xs font-medium text-slate-900 group-hover:text-slate-900"
          >Pinned</span
        >
      </div>
    </ModalPopup>
  </div>
</template>
<script>
import InputGroup from './../components/InputGroup.vue';
import { PinIcon, PinnedIcon } from 'vue-tabler-icons';
import JovieSpinner from './../components/JovieSpinner.vue';
import { Float } from '@headlessui-float/vue';
import {
  ChevronRightIcon,
  ChevronDownIcon,
  PlusIcon,
  Bars3Icon,
  EllipsisHorizontalIcon,
  BookmarkIcon,
  DocumentDuplicateIcon,
  ArchiveBoxIcon,
  PencilSquareIcon,
  TrashIcon,
  ArrowPathIcon,
} from '@heroicons/vue/20/solid';
import ToggleGroup from './../components/ToggleGroup.vue';
import {
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
  Switch,
  SwitchGroup,
  SwitchLabel,
} from '@headlessui/vue';
import draggable from 'vuedraggable';
import UserService from '../services/api/user.service';
import ModalPopup from '../components/ModalPopup';
import UserListEditable from './Crm/UserListEditable.vue';
export default {
  data() {
    return {
      showMenu: true,
      editName: false,
      emoji: '',
      editListPopup: {
        open: false,
        loading: false,
        title: 'Edit List',
        pinned: null,
        name: '',
        description: '',
        primaryButtonText: 'Save',
        confirmationMethod: null,
      },
      confirmationPopup: {
        confirmationMethod: null,
        title: null,
        open: false,
        primaryButtonText: null,
        description: '',
        loading: false,
      },
      creatingList: false,
      currentEditingList: null,
    };
  },
  methods: {
    // event callback
    editListFromModal() {
      this.editListPopup.loading = true;
      this.updateList(this.currentEditingList);
      this.editListPopup.loading = false;
      this.editListPopup.open = false;
    },
    toggleShowMenu() {
      this.showMenu = !this.showMenu;
    },
    async enableEditName(item, fallBackFocus = false) {
      if (!fallBackFocus) {
        this.currentEditingList = JSON.parse(JSON.stringify(item));
      }
      item.editName = true;
      await this.$nextTick(() => {
        if (this.$refs[`list_${item.id}`]) {
          this.$refs[`list_${item.id}`].focus();
        }
      });
    },
    disableEditName(item) {
      item.editName = false;
      item.name = this.currentEditingList.name;
      this.currentEditingList = null;
    },
    editList(item) {
      this.currentEditingList = JSON.parse(JSON.stringify(item));
      this.editListPopup.confirmationMethod = () => {
        this.updateList(this.currentEditingList);
      };
      this.confirmationPopup.cancelEditMethod = () => {
        this.cancelEditMethod(item);
      };
      this.editListPopup.open = true;
      this.editListPopup.title = `Edit ${this.currentEditingList.name}`;
      this.editListPopup.pinned = this.currentEditingList.pinned;
      this.editListPopup.name = this.currentEditingList.name;
    },
    createList() {
      this.creatingList = true;
      UserService.createList()
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
            this.$emit('setFilterList', response.list.id);
            this.enableEditName(response.list);
          } else {
            // show toast error here later
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          console.log('error');
          console.log(error);
          error = error.response;
          if (error.status == 422) {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {
          this.creatingList = false;
          this.$emit('getUserLists');
        });
    },
    confirmListDeletion(id) {
      this.confirmationPopup.confirmationMethod = () => {
        this.deleteList(id);
      };
      this.confirmationPopup.cancelMethod = () => {
        this.cancelDelete();
      };
      this.confirmationPopup.title = 'Confirm List Deletion';
      this.confirmationPopup.primaryButtonText = 'Delete';
      this.confirmationPopup.description =
        'Are you sure you want to delete the list ?';
      this.confirmationPopup.open = true;
    },
    deleteList(id) {
      this.confirmationPopup.loading = true;
      UserService.deleteList(id)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
            this.$emit('setFiltersType', 'all');
          } else {
            // show toast error here later
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          console.log('error');
          console.log(error);
          error = error.response;
          if (error.status == 422) {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {
          this.resetPopup();
          this.$emit('getUserLists');
        });
    },
    cancelDelete() {
      this.resetPopup();
    },
    resetPopup() {
      this.confirmationPopup = {
        confirmationMethod: null,
        title: null,
        open: false,
        description: null,
        primaryButtonText: null,
        loading: false,
      };
    },
    resetEditPopup() {
      this.editListPopup = {
        confirmationMethod: null,
        title: null,
        open: false,
        description: null,
        primaryButtonText: null,
        loading: false,
        name: null,
        emoji: null,
        pinned: false,
      };
    },
    cancelEditMethod(item) {
      this.resetEditPopup();
      this.editListPopup.open = false;
    },
    duplicateList(id) {
      UserService.duplicateList(id)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
          } else {
            // show toast error here later
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          console.log('error');
          console.log(error);
          error = error.response;
          if (error.status == 422) {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {
          this.$emit('getUserLists');
        });
    },
    pinList(id) {
      UserService.pinList(id)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
          } else {
            // show toast error here later
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          console.log('error');
          console.log(error);
          error = error.response;
          if (error.status == 422) {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {
          this.$emit('getUserLists');
        });
    },
    unpinList(id) {
      UserService.unpinList(id)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
          } else {
            // show toast error here later
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          console.log('error');
          console.log(error);
          error = error.response;
          if (error.status == 422) {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {
          this.$emit('getUserLists');
        });
    },
  },
  components: {
    UserListEditable,
    ChevronRightIcon,
    BookmarkIcon,
    Switch,
    SwitchGroup,
    SwitchLabel,
    JovieSpinner,
    PinnedIcon,
    ChevronDownIcon,
    EllipsisHorizontalIcon,
    PlusIcon,
    Bars3Icon,
    ArchiveBoxIcon,
    DocumentDuplicateIcon,
    TrashIcon,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    PinIcon,
    PencilSquareIcon,
    draggable,
    ModalPopup,
    InputGroup,
    Float,
    ToggleGroup,
    ArrowPathIcon,
  },
  computed: {
    menuItemsList: {
      get() {
        return this.menuItems;
      },
      set(val) {
        this.$emit('updateMenuItems', val);
      },
    },
  },
  watch: {
    menuItems(val) {
      if (this.menuName == 'Lists' && this.currentEditingList) {
        let enabledList = this.menuItems.find(
          (list) => this.currentEditingList.id === list.id
        );
        if (enabledList) {
          this.enableEditName(enabledList);
        }
      }
    },
  },
  props: {
    menuName: {
      type: String,
      default: 'MenuName',
    },
    menuItems: {
      type: Array,
      default: [
        { name: 'item 1', emoji: '😍', id: 1, count: 34 },
        { name: 'item 2', emoji: '🎥', id: 2, count: 39 },
        { name: 'item 3', emoji: '👍', id: 3, count: 23 },
      ],
    },
    draggable: {
      type: Boolean,
      default: false,
    },
    selectedList: {
      type: String,
      default: null,
    },
  },
};
</script>
