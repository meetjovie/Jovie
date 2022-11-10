<template>
  <div>
    <div
      class="group flex cursor-pointer items-center justify-between rounded-md py-1">
      <div
        @click="toggleShowMenu()"
        class="flex cursor-pointer items-center rounded-md py-0.5 px-1 text-xs font-medium tracking-wider text-neutral-700 hover:bg-neutral-200 hover:text-neutral-800">
        <ChevronDownIcon
          v-if="showMenu"
          class="mt-0.5 mr-1 h-4 w-4 text-neutral-700 group-hover:text-neutral-800" />
        <ChevronRightIcon
          v-else
          class="text-thin mr-1 h-4 w-4 text-xs text-neutral-700 group-hover:text-neutral-800" />
        {{ menuName }}
      </div>
      <div class="flex items-center">
        <div
          v-if="draggable"
          class="group mx-auto rounded-md p-1 text-neutral-400 transition-all hover:bg-neutral-300 hover:text-neutral-50">
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
    <ul v-if="showMenu && draggable" class="">
      <draggable
        v-model="menuItems"
        group="lists"
        class="select-none"
        ghost-class="ghost-card"
        itemKey="id"
        @change="$emit('sort')">
        <template #item="{ element, index }">
          <div :key="element.id" :id="element.id">
            <div
              class="group/list inline-flex h-8 w-full select-none items-center justify-between rounded-md pl-1 transition-all hover:bg-neutral-200 active:shadow-xl">
              <div
                class="group/move mx-auto w-4 flex-none cursor-grab items-center">
                <Bars3Icon
                  class="h-3 w-3 text-neutral-700/0 active:text-neutral-900 group-hover/list:text-neutral-900"></Bars3Icon>
              </div>

              <div class="flex w-full items-center">
                <div
                  @click="openEmojiPicker(element)"
                  class="mr-1 w-6 cursor-pointer items-center rounded-md px-1 py-1 text-center text-xs transition-all hover:bg-neutral-800 active:bg-neutral-800 group-hover/list:bg-neutral-200">
                  {{ element.emoji ?? '📄' }}
                </div>
                <div
                  @dblclick="enableEditName(element)"
                  class="w-full cursor-pointer"
                  @click="$emit('setFilterList', element.id)">
                  <span
                    v-if="!element.editName"
                    :class="[
                      selectedList == element.id
                        ? 'font-bold text-neutral-800 '
                        : 'font-medium text-neutral-700',
                    ]"
                    class="cursor-pointer text-xs line-clamp-1 group-hover/list:text-neutral-800"
                    >{{ element.name }}</span
                  >
                  <input
                    v-model="element.name"
                    @blur="updateList(element)"
                    @keyup.esc="disableEditName(element)"
                    @keyup.enter="updateList(element)"
                    v-else
                    class="text-xs font-medium text-neutral-700 group-hover/list:text-neutral-800" />
                </div>
              </div>
              <div
                class="mx-auto h-8 w-6 flex-none cursor-pointer items-center rounded-md p-1 hover:bg-neutral-300 hover:text-neutral-50">
                <ArrowPathIcon
                  v-if="element.updating_list"
                  class="mx-auto mt-1 mr-2 h-4 w-4 animate-spin-slow items-center group-hover/list:hidden group-hover/list:text-neutral-800" />
                <span
                  v-else
                  class="text-right text-xs font-medium text-neutral-700 group-hover/list:hidden group-hover/list:text-neutral-800"
                  >{{ element.creators_count }}</span
                >

                <Menu
                  as="div"
                  class="relative inline-block items-center text-center">
                  <Float portal :offset="12" placement="right-start">
                    <MenuButton
                      class="hidden h-6 w-6 items-center text-neutral-400 active:text-neutral-700 group-hover/list:block">
                      <EllipsisHorizontalIcon
                        class="mt-1 hidden h-4 w-4 text-neutral-400 active:text-neutral-700 group-hover/list:block"></EllipsisHorizontalIcon>
                    </MenuButton>

                    <transition
                      enter-active-class="transition duration-100 ease-out"
                      enter-from-class="transform scale-95 opacity-0"
                      enter-to-class="transform scale-100 opacity-100"
                      leave-active-class="transition duration-75 ease-in"
                      leave-from-class="transform scale-100 opacity-100"
                      leave-to-class="transform scale-95 opacity-0">
                      <MenuItems
                        class="absolute right-0 mt-2 w-28 origin-top-right divide-y divide-neutral-100 rounded-md border-neutral-200 bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="px-1 py-1">
                          <MenuItem v-slot="{ active }">
                            <button
                              @click="editList(element)"
                              :class="[
                                active
                                  ? 'bg-neutral-200 text-neutral-700'
                                  : 'text-neutral-900',
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
                                  ? 'bg-neutral-200 text-neutral-700'
                                  : 'text-neutral-900',
                                'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                              ]">
                              <DocumentDuplicateIcon
                                :active="active"
                                class="mr-2 h-3 w-3 text-teal-400 hover:text-neutral-700"
                                aria-hidden="true" />
                              Duplicate
                            </button>
                          </MenuItem>
                          <MenuItem v-slot="{ active }">
                            <button
                              @click="pinList(element.id)"
                              :class="[
                                active
                                  ? 'bg-neutral-200 text-neutral-700'
                                  : 'text-neutral-900',
                                'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                              ]">
                              <PinIcon
                                :active="active"
                                class="mr-2 h-3 w-3 text-indigo-400 hover:text-neutral-700"
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
                                  ? 'bg-neutral-200 text-neutral-900'
                                  : 'text-neutral-900',
                                'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                              ]">
                              <TrashIcon
                                :active="active"
                                class="mr-2 h-3 w-3 text-neutral-400 hover:text-white"
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
          class="group inline-flex h-8 w-8 w-full items-center justify-between rounded-md pl-1 transition-all hover:bg-neutral-200">
          <div class="group h-4 w-4 flex-none cursor-pointer items-center">
            <PinnedIcon
              :active="active"
              class="hidden h-3 w-3 text-indigo-400 hover:bg-neutral-200 hover:text-neutral-700 active:text-indigo-500 group-hover:block"
              aria-hidden="true" />
          </div>

          <div class="flex w-full items-center">
            <div
              @click="openEmojiPicker(item)"
              class="h-full w-6 cursor-pointer items-center rounded-md bg-neutral-50 px-1 text-center text-xs transition-all hover:bg-neutral-700 group-hover:bg-neutral-200">
              {{ item.emoji ?? '📄' }}
            </div>
            <div
              @dblclick="enableEditName(item)"
              class="w-full cursor-pointer"
              @click="$emit('setFilterList', item.id)">
              <span
                v-if="!item.editName"
                :class="[
                  selectedList == item.id
                    ? 'font-bold text-neutral-800 '
                    : 'font-medium text-neutral-700',
                ]"
                class="cursor-pointer text-xs line-clamp-1 group-hover:text-neutral-800"
                >{{ item.name }}</span
              >
              <input
                ref="input"
                :input="ref"
                @blur="disableEditName(item)"
                @keyup.esc="disableEditName(item)"
                @keyup.enter="updateList(item)"
                v-else
                class="text-xs font-medium text-neutral-900 group-hover:text-neutral-800" />
            </div>
          </div>

          <div
            class="group mx-auto h-8 w-8 flex-none cursor-pointer items-center rounded-md p-1 text-center hover:bg-neutral-300 hover:text-neutral-50">
            <span
              class="text-right text-xs font-medium text-neutral-700 group-hover:hidden group-hover:text-neutral-800"
              >{{ item.creators_count }}</span
            >
            <Menu as="div" class="relative inline-block text-center">
              <Float portal :offset="12" placement="right-start">
                <div class="mx-auto text-center">
                  <MenuButton
                    class="hidden h-4 w-4 text-neutral-400 group-hover:block">
                    <EllipsisHorizontalIcon
                      class="mt-1 h-4 w-4 text-neutral-400 active:text-neutral-700"></EllipsisHorizontalIcon>
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
                    class="z-40 mt-2 w-28 origin-top-right divide-y divide-neutral-100 rounded-md border-neutral-200 bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <div class="px-1 py-1">
                      <MenuItem v-slot="{ active }">
                        <button
                          @click="editList(item.id)"
                          :class="[
                            active
                              ? 'bg-neutral-200 text-neutral-700'
                              : 'text-neutral-900',
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
                              ? 'bg-neutral-200 text-neutral-700'
                              : 'text-neutral-900',
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
                              ? 'bg-neutral-200 text-neutral-700'
                              : 'text-neutral-900',
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
                              ? 'bg-neutral-200 text-neutral-700'
                              : 'text-neutral-900',
                            'group flex w-full items-center rounded-md px-2 py-1 text-xs',
                          ]">
                          <TrashIcon
                            :active="active"
                            class="mr-2 h-4 w-4 text-neutral-400"
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
          class="text-xs font-medium text-neutral-900 group-hover:text-neutral-900" />
        <ToggleGroup :enabled="currentEditingList.pinned" /><span
          class="ml-2 items-center text-xs font-medium text-neutral-900 group-hover:text-neutral-900"
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
import { Float } from '@headlessui-float/vue';

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

    openEmojiPicker(item) {
      this.$emit('openEmojiPicker', item);
    },
    toggleShowMenu() {
      this.showMenu = !this.showMenu;
    },
    enableEditName(item, fallBackFocus = false) {
      if (!fallBackFocus) {
        this.currentEditingList = JSON.parse(JSON.stringify(item));
      }
      item.editName = true;
    },
    disableEditName(item) {
      item.editName = false;
      item.name = this.currentEditingList.name;
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
    updateList(item) {
      item.updating = true;
      UserService.updateList({ name: item.name, emoji: item.emoji }, item.id)
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
            this.editListPopup.open = false;
            this.$emit('getUserLists');
          } else {
            // show toast error here later
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
            this.enableEditName(item, true);
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: Object.values(error.data.errors)[0][0],
            });
            this.enableEditName(item, true);
          }
        })
        .finally((response) => {
          item.updating = false;
        });
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
