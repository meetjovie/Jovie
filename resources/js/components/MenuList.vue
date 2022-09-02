<template>
  <div>
    <div
      @click="toggleShowMenu()"
      class="group flex cursor-pointer items-center justify-between rounded-md py-1 hover:bg-neutral-200">
      <div
        class="flex cursor-pointer items-center text-sm font-semibold text-neutral-400 group-hover:text-neutral-500">
        <ChevronDownIcon
          v-if="showMenu"
          class="mt-0.5 mr-1 h-4 w-4 text-gray-400 group-hover:text-neutral-500" />
        <ChevronRightIcon
          v-else
          class="mr-1 h-4 w-4 text-gray-400 group-hover:text-neutral-500" />
        {{ menuName }}
      </div>
      <div class="flex items-center">
        <div
          class="group rounded-md p-1 text-gray-400 hover:bg-gray-300 hover:text-gray-50">
          <PlusIcon v-if="draggable" class="h-4 w-4"></PlusIcon>
        </div>
      </div>
    </div>
    <ul v-if="showMenu && draggable" class="">
      <draggable
        v-model="menuItems"
        group="lists"
        itemKey="id"
        @change="$emit('sort')">
        <template #item="{ element, index }">
          <div :key="element.id" :id="element.id">
            <div
              class="group inline-flex w-full items-center justify-between rounded-md transition-all hover:bg-neutral-200 active:shadow-xl">
              <div
                class="group w-4 flex-none cursor-grab items-center hover:bg-neutral-200">
                <Bars3Icon
                  class="h-4 w-4 text-gray-400/0 group-hover:text-gray-400"></Bars3Icon>
              </div>

              <div class="flex w-full items-center">
                <div
                  class="cursor-pointer rounded-md p-1 text-xs hover:bg-gray-400">
                  {{ element.emoji || '😆' }}
                </div>
                <div>
                  <span
                    v-if="!element.editName"
                    @dblclick="enableEditName(element)"
                    class="cursor-pointer text-xs font-semibold text-neutral-400 line-clamp-1 group-hover:text-neutral-500"
                    >{{ element.name }}</span
                  >
                  <input
                    v-model="element.name"
                    @blur="disableEditName(element)"
                    @keyup.enter="disableEditName(element)"
                    v-else
                    class="text-xs font-semibold text-neutral-400 group-hover:text-neutral-500" />
                </div>
              </div>
              <div
                class="h-6 w-6 flex-none cursor-pointer items-center rounded-md p-1 hover:bg-gray-300 hover:text-gray-50">
                <span
                  class="items-center text-xs font-semibold text-neutral-400 group-hover:hidden group-hover:text-neutral-500"
                  >{{ element.count }}</span
                >

                <Menu as="div" class="relative inline-block text-left">
                  <MenuButton
                    class="hidden h-4 w-4 text-gray-400 active:text-gray-500 group-hover:block">
                    <EllipsisVerticalIcon
                      class="hidden h-4 w-4 text-gray-400 active:text-gray-500 group-hover:block"></EllipsisVerticalIcon>
                  </MenuButton>

                  <transition
                    enter-active-class="transition duration-100 ease-out"
                    enter-from-class="transform scale-95 opacity-0"
                    enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-75 ease-in"
                    leave-from-class="transform scale-100 opacity-100"
                    leave-to-class="transform scale-95 opacity-0">
                    <MenuItems
                      class="absolute right-0 mt-2 w-28 origin-top-right divide-y divide-gray-100 rounded-md border-neutral-200 bg-white/60 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl backdrop-saturate-150 focus:outline-none">
                      <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                          <button
                            @click="duplicateList(element.id)"
                            :class="[
                              active
                                ? 'bg-gray-300 text-gray-700'
                                : 'text-gray-900',
                              'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                            ]">
                            <DocumentDuplicateIcon
                              :active="active"
                              class="mr-2 h-3 w-3 text-teal-400 hover:text-gray-700"
                              aria-hidden="true" />
                            Duplicate
                          </button>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                          <button
                            @click="pinList(element.id)"
                            :class="[
                              active
                                ? 'bg-gray-300 text-gray-700'
                                : 'text-gray-900',
                              'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                            ]">
                            <BookmarkIcon
                              :active="active"
                              class="mr-2 h-3 w-3 text-indigo-400 hover:text-gray-700"
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
                                ? 'bg-gray-300 text-gray-900'
                                : 'text-gray-900',
                              'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                            ]">
                            <TrashIcon
                              :active="active"
                              class="mr-2 h-3 w-3 text-gray-400 hover:text-white"
                              aria-hidden="true" />
                            Trash
                          </button>
                        </MenuItem>
                      </div>
                    </MenuItems>
                  </transition>
                </Menu>
              </div>
            </div>
          </div>
        </template>
        <div v-for="element in myArray" :key="element.id">
          {{ element.name }}
        </div>
      </draggable>
    </ul>
    <ul v-if="showMenu && !draggable" class="">
      <div v-for="item in menuItems" :key="item.id">
        <div
          class="group inline-flex w-full items-center justify-between rounded-md transition-all hover:bg-neutral-200">
          <div
            class="group w-4 flex-none cursor-pointer items-center hover:bg-neutral-200">
            <BookmarkIcon
              :active="active"
              class="h-4 w-4 text-gray-400 hover:text-gray-500 active:text-indigo-500"
              aria-hidden="true" />
          </div>

          <div class="flex w-full items-center">
            <EmojiPickerModal>
              <div
                class="cursor-pointer rounded-md p-1 text-xs hover:bg-gray-400">
                {{ item.emoji || '😆' }}
              </div>
            </EmojiPickerModal>
            <div>
              <span
                v-if="!item.editName"
                @dblclick="enableEditName(item)"
                class="cursor-pointer text-xs font-semibold text-neutral-400 line-clamp-1 group-hover:text-neutral-500"
                >{{ item.name }}</span
              >
              <input
                v-model="item.name"
                @blur="disableEditName(item)"
                @keyup.enter="disableEditName(item)"
                v-else
                class="text-xs font-semibold text-neutral-400 group-hover:text-neutral-500" />
            </div>
          </div>
          <div
            class="group h-6 w-6 flex-none cursor-pointer items-center rounded-md p-1 hover:bg-gray-300 hover:text-gray-50">
            <span
              class="items-center text-xs font-semibold text-neutral-400 group-hover:hidden group-hover:text-neutral-500"
              >{{ item.count }}</span
            >

            <Menu as="div" class="relative inline-block text-left">
              <div>
                <MenuButton
                  class="hidden h-4 w-4 text-gray-400 group-hover:block">
                  <EllipsisVerticalIcon
                    class="hidden h-4 w-4 text-gray-400 active:text-gray-500 group-hover:block"></EllipsisVerticalIcon>
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
                  class="absolute right-0 z-40 mt-2 w-28 origin-top-right divide-y divide-gray-100 rounded-md border-neutral-200 bg-white/60 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl backdrop-saturate-150 backdrop-filter focus:outline-none">
                  <div class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                      <button
                        @click="duplicateList(item.id)"
                        :class="[
                          active
                            ? 'bg-gray-300 text-gray-700'
                            : 'text-gray-900',
                          'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                        ]">
                        <DocumentDuplicateIcon
                          :active="active"
                          class="mr-2 h-4 w-4 text-teal-400 hover:text-gray-700"
                          aria-hidden="true" />
                        Duplicate
                      </button>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <button
                        @click="unpinList(item.id)"
                        :class="[
                          active
                            ? 'bg-gray-300 text-gray-700'
                            : 'text-gray-900',
                          'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                        ]">
                        <BookmarkIcon
                          :active="active"
                          class="mr-2 h-3 w-3 text-indigo-400 hover:text-gray-700"
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
                            ? 'bg-gray-300 text-gray-700'
                            : 'text-gray-900',
                          'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                        ]">
                        <TrashIcon
                          :active="active"
                          class="mr-2 h-4 w-4 text-gray-400 hover:text-gray-700"
                          aria-hidden="true" />
                        Trash
                      </button>
                    </MenuItem>
                  </div>
                </MenuItems>
              </transition>
            </Menu>
          </div>
        </div>
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
  </div>
</template>
<script>
import {
  ChevronRightIcon,
  ChevronDownIcon,
  PlusIcon,
  Bars3Icon,
  EllipsisVerticalIcon,
  BookmarkIcon,
  DocumentDuplicateIcon,
  ArchiveBoxIcon,
  TrashIcon,
} from '@heroicons/vue/24/solid';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
import draggable from 'vuedraggable';
import EmojiPickerModal from '../components/EmojiPickerModal.vue';
import UserService from '../services/api/user.service';
import ModalPopup from '../components/ModalPopup';

export default {
  data() {
    return {
      showMenu: true,
      editName: false,
      openEmojiPicker: false,
      confirmationPopup: {
        confirmationMethod: null,
        title: null,
        open: false,
        primaryButtonText: null,
        description: '',
        loading: false,
      },
    };
  },
  methods: {
    // event callback

    toggleShowMenu() {
      this.showMenu = !this.showMenu;
    },
    enableEditName(item) {
      item.editName = true;
    },
    disableEditName(item) {
      item.editName = false;
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
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
            if (this.errors.list[0]) {
              this.$notify({
                group: 'user',
                type: 'error',
                duration: 15000,
                title: 'Error',
                text: this.errors.list[0],
              });
            }
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
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
            if (this.errors.list[0]) {
              this.$notify({
                group: 'user',
                type: 'error',
                duration: 15000,
                title: 'Error',
                text: this.errors.list[0],
              });
            }
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
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
            if (this.errors.list[0]) {
              this.$notify({
                group: 'user',
                type: 'error',
                duration: 15000,
                title: 'Error',
                text: this.errors.list[0],
              });
            }
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
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
            if (this.errors.list[0]) {
              this.$notify({
                group: 'user',
                type: 'error',
                duration: 15000,
                title: 'Error',
                text: this.errors.list[0],
              });
            }
          }
        })
        .finally((response) => {
          this.$emit('getUserLists');
        });
    },
  },
  components: {
    ChevronRightIcon,
    BookmarkIcon,
    EmojiPickerModal,
    ChevronDownIcon,
    EllipsisVerticalIcon,
    PlusIcon,
    Bars3Icon,
    ArchiveBoxIcon,
    DocumentDuplicateIcon,
    TrashIcon,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    draggable,
    ModalPopup,
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
  },
};
</script>
