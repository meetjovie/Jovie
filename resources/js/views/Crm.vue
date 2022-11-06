<template>
  <div class="h-full w-full">
    <div id="crm" class="mx-auto flex h-full w-full min-w-full">
      <div class="flex h-full w-full">
        <TransitionRoot
          :show="$store.state.CRMSidebarOpen"
          enter="transition ease-in-out duration-300 transform"
          enter-from="-translate-x-full"
          enter-to="translate-x-0"
          leave="transition ease-in-out duration-300 transform"
          leave-from="translate-x-0"
          leave-to="-translate-x-full">
          <div
            class="top-0 z-30 mx-auto flex h-screen w-60 flex-col justify-between overflow-hidden border-r border-neutral-100 bg-neutral-50 py-4 pb-2 shadow-xl"
            :class="[{ '-mt-20': $store.state.CRMSidebarOpen }, '-mt-10']">
            <div>
              <div class="mt-10 flex-col py-0.5 px-2">
                <JovieTooltip
                  shortcuts="{ key: 's', key: 'c', key: 't' }"
                  text="Show All Contacts">
                  <button
                    @click="setFiltersType('all')"
                    class="group flex h-8 w-full items-center justify-between rounded-md px-1 text-left tracking-wide hover:bg-neutral-200/50 hover:text-neutral-600"
                    :class="[
                      filters.type == 'all'
                        ? 'text-sm font-bold text-neutral-600  '
                        : 'text-sm font-semibold text-neutral-500',
                    ]">
                    <div class="flex items-center text-xs">
                      <UserGroupIcon
                        class="mr-1 h-5 w-5 rounded-md p-1 text-pink-400"
                        aria-hidden="true" />
                      All Contacts
                    </div>
                    <div
                      @click="showCreatorModal = true"
                      class="items-center rounded-md p-1 hover:bg-gray-300 hover:text-gray-50">
                      <span
                        class="text-xs font-semibold text-neutral-500 group-hover:hidden group-hover:text-neutral-600"
                        >{{ counts.total }}</span
                      >

                      <PlusIcon
                        class="hidden h-3 w-3 text-gray-400 active:text-white group-hover:block"></PlusIcon>
                    </div>
                  </button>
                </JovieTooltip>
                <JovieTooltip
                  :shortcut.key="{
                    key1: 'G',
                    key2: 'A',
                    delimiter: 'then',
                  }"
                  text="Show Archived Contacts">
                  <button
                    @click="setFiltersType('archived')"
                    class="group flex h-8 w-full items-center justify-between rounded-md px-1 py-1 text-left tracking-wide hover:bg-neutral-200/50 hover:text-neutral-600"
                    :class="[
                      filters.type == 'archived'
                        ? 'text-sm font-bold text-neutral-600 '
                        : 'text-sm font-semibold text-neutral-500',
                    ]">
                    <div class="flex items-center text-xs">
                      <ArchiveBoxIcon
                        class="mr-1 h-5 w-5 rounded-md p-1 text-sky-400"
                        aria-hidden="true" />Archived
                    </div>
                    <div class="items-center rounded-md p-1 hover:text-gray-50">
                      <span
                        class="text-xs font-semibold text-neutral-500 group-hover:text-neutral-600"
                        >{{ counts.archived }}</span
                      >
                    </div>
                  </button>
                </JovieTooltip>
                <JovieTooltip :shortcut="'G then F'" text="Show Favorites">
                  <button
                    @click="setFiltersType('favourites')"
                    class="group flex h-8 w-full items-center justify-between rounded-md px-1 py-1 text-left tracking-wide hover:bg-neutral-200/50 hover:text-neutral-600"
                    :class="[
                      filters.type == 'favourites'
                        ? 'text-sm font-bold text-neutral-600 '
                        : 'text-sm font-semibold text-neutral-500',
                    ]">
                    <div class="flex items-center text-xs">
                      <HeartIcon
                        class="mr-1 h-5 w-5 rounded-md p-1 text-red-400"
                        aria-hidden="true" />Favorite
                    </div>
                    <div class="items-center rounded-md p-1 hover:text-gray-50">
                      <span
                        class="text-xs font-semibold text-neutral-500 group-hover:text-neutral-600"
                        >{{ counts.favourites }}</span
                      >
                    </div>
                  </button>
                </JovieTooltip>
              </div>
              <div class="flex-col justify-evenly space-y-4 px-2 py-4">
                <MenuList
                  ref="menuListPinned"
                  @getUserLists="getUserLists"
                  @setFiltersType="setFiltersType"
                  @openEmojiPicker="openEmojiPicker"
                  menuName="Pinned"
                  :selectedList="filters.list"
                  @setFilterList="setFilterList"
                  :menuItems="pinnedUserLists"></MenuList>
                <!--    Team Specific Lists -->
                <MenuList
                  ref="menuListAll"
                  @getUserLists="getUserLists"
                  @setFiltersType="setFiltersType"
                  @openEmojiPicker="openEmojiPicker"
                  menuName="Lists"
                  @setFilterList="setFilterList"
                  :selectedList="filters.list"
                  :draggable="true"
                  @end="sortLists"
                  :menuItems="filteredUsersLists"></MenuList>
              </div>
            </div>
            <div class="flex-shrink-0 border-t border-neutral-200 py-2 px-2">
              <JovieTooltip text="Import a new contact to Jovie">
                <div
                  @click="showCreatorModal = true"
                  class="rouned-md mb-2 flex cursor-pointer items-center rounded-md py-2 text-xs font-semibold text-neutral-500 hover:bg-neutral-200/50 hover:text-neutral-600">
                  <PlusIcon
                    class="mr-1 h-5 w-5 rounded-md p-1 text-neutral-500"
                    aria-hidden="true" />New Contact
                </div>
              </JovieTooltip>
              <JovieTooltip text="Upload a csv file to import contacts">
                <router-link
                  to="import"
                  class="rouned-md mb-2 flex cursor-pointer items-center justify-between rounded-md py-2 text-xs font-semibold text-neutral-500 hover:bg-neutral-200/50 hover:text-neutral-600">
                  <div class="flex items-center">
                    <CloudArrowUpIcon
                      class="mr-1 h-5 w-5 rounded-md p-1 text-sky-400"
                      aria-hidden="true" />Upload A CSV
                  </div>
                  <div class="items-center">
                    <CreatorTags
                      v-if="!currentUser.current_team.current_subscription"
                      :showX="false"
                      text="Pro"
                      color="blue" />
                  </div>
                </router-link>
              </JovieTooltip>
              <JovieTooltip text="Choose which teamspace you want to work in.">
                <SwitchTeams />
              </JovieTooltip>

              <div class="mt-1 py-1">
                <ProgressBar
                  invertedColor
                  :percentage="
                    100 -
                    (currentUser.current_team.credits /
                      (currentUser.current_team.current_subscription?.credits ||
                        10)) *
                      100
                  "
                  :label="
                    (currentUser.current_team.current_subscription?.credits ||
                      10) -
                    currentUser.current_team.credits +
                    ' of ' +
                    (currentUser.current_team.current_subscription?.credits ||
                      10) +
                    ' contacts'
                  " />
              </div>
              <div
                v-if="!currentUser.current_team.credits"
                class="flex items-center justify-between">
                <div class="flex items-center px-2">
                  <span class="text-2xs text-neutral-400"
                    >Account quota exceeded
                  </span>
                  <ChevronRightIcon
                    class="h-3 w-3 text-neutral-400"
                    aria-hidden="true" />
                </div>
                <div
                  as="router-link"
                  to="/billing"
                  class="underline-2 cursor-pointer text-center text-xs font-bold text-indigo-500 decoration-indigo-700 hover:underline">
                  Upgrade
                </div>
              </div>
            </div>
          </div>
        </TransitionRoot>

        <div class="h-full overflow-hidden w-full transition-all duration-200 ease-in-out">
          <div class="mx-auto h-full w-full">
            <div class="h-full w-full">
              <div class="flex h-full w-full flex-col">
                <div class="mx-auto h-full w-full p-0">
                  <div class="inline-block h-full w-full align-middle">
                    <div class="h-full w-full">
                      <!--  Show import screen if no creators -->
                      <div
                        v-if="!loading && !creators.length && !showImporting"
                        class="mx-auto h-full max-w-7xl items-center px-4 sm:px-6 lg:px-8">
                        <div class="mx-auto max-w-xl">
                          <div
                            class="container mx-auto mt-24 max-w-3xl py-24 px-4 sm:px-6 lg:px-8">
                            <div>
                              <h1 class="text-md font-bold">
                                You don't have any contacts yet.
                              </h1>
                              <span class="text-sm font-medium text-neutral-500"
                                >Enter a Twitch or Instagram url to add someone
                                to Jovie.</span
                              >
                            </div>
                            <SocialInput
                              class="py-12"
                              @finishImport="closeImportCreatorModal" />
                            <InternalMarketingChromeExtension class="mt-24" />
                          </div>
                        </div>
                      </div>
                      <!-- Show loading screen if the users first ever import is loading -->

                      <div
                        v-else-if="showImporting && !creators.length"
                        class="mx-auto h-full max-w-7xl items-center px-4 sm:px-6 lg:px-8">
                        <div class="mx-auto max-w-xl">
                          <div
                            class="container mx-auto mt-24 max-w-3xl py-24 px-4 sm:px-6 lg:px-8">
                            <div>
                              <ArrowPathIcon
                                class="mt-1 mr-2 h-4 w-4 animate-spin-slow items-center" />
                              <h1 class="text-md font-bold">
                                You've just initated an import.
                              </h1>
                              <span class="text-sm font-medium text-neutral-500"
                                >You'll see creators populate this space
                                soon.</span
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Show the crm if there are creators -->
                      <CrmTable
                        class="overflow-hidden"
                        v-else
                        ref="crmTable"
                        @updateCreator="updateCreator"
                        @updateCrmMeta="updateCrmMeta"
                        @crmCounts="crmCounts"
                        :counts="counts"
                        @updateListCount="updateListCount"
                        @pageChanged="pageChanged"
                        @setCurrentContact="setCurrentContact"
                        @openSidebar="openSidebarContact"
                        @setOrder="setOrder"
                        :header="filters.type"
                        subheader="All your contacts in one place."
                        :filters="filters"
                        :userLists="userLists"
                        :creators="creators"
                        :networks="networks"
                        :stages="stages"
                        :creatorsMeta="creatorsMeta"
                        :loading="loading">
                        <slot header="header"></slot>
                      </CrmTable>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <TransitionRoot
          :show="$store.state.ContactSidebarOpen"
          enter="transition ease-in-out duration-300 transform"
          enter-from="translate-x-full"
          enter-to="-translate-x-0"
          leave="transition ease-in-out duration-300 transform"
          leave-from="-translate-x-0"
          leave-to="translate-x-full">
          <aside
            class="z-30 -mt-2 hidden h-full border-l-2 border-neutral-200 shadow-xl xl:block">
            <ContactSidebar
              @updateCrmMeta="updateCrmMeta"
              :jovie="true"
              :creatorsData="currentContact" />
          </aside>
        </TransitionRoot>
      </div>

      <ImportCreatorModal
        :open="showCreatorModal"
        :list="filters.list"
        @closeModal="closeImportCreatorModal" />

      <EmojiPickerModal
        v-show="openEmojis"
        @emojiSelected="emojiSelected($event)"
        class="absolute left-60 w-4 cursor-pointer select-none items-center rounded-md bg-gray-50 text-center text-xs">
      </EmojiPickerModal>
    </div>
  </div>
</template>

<script>
import {
  Combobox,
  ComboboxButton,
  ComboboxInput,
  ComboboxOptions,
  ComboboxOption,
  TabGroup,
  TabList,
  Tab,
  TabPanels,
  TabPanel,
  Menu,
  MenuButton,
  TransitionRoot,
  TransitionChild,
  MenuItems,
  MenuItem,
} from '@headlessui/vue';
import {
  ChevronDownIcon,
  ChevronRightIcon,
  CloudArrowDownIcon,
  CheckIcon,
  UserGroupIcon,
  EllipsisVerticalIcon,
  PlusIcon,
  HeartIcon,
  ArchiveBoxIcon,
  CloudArrowUpIcon,
} from '@heroicons/vue/24/solid';

import UserService from '../services/api/user.service';
import CrmTable from '../components/Crm/CrmTable';
import ImportCreatorModal from '../components/ImportCreatorModal';
import SocialInput from '../components/SocialInput';
import InternalMarketingChromeExtension from '../components/InternalMarketingChromeExtension';
import MenuList from '../components/MenuList';
import ProgressBar from '../components/ProgressBar';
import SwitchTeams from '../components/SwitchTeams';
import JovieTooltip from '../components/JovieTooltip.vue';
import EmojiPickerModal from '../components/EmojiPickerModal.vue';
import ContactSidebar from '../components/ContactSidebar.vue';
import VueMousetrapPlugin from 'vue-mousetrap';
import CreatorTags from '../components/Creator/CreatorTags.vue';
export default {
  name: 'CRM',
  components: {
    EmojiPickerModal,
    CloudArrowDownIcon,
    PlusIcon,
    SwitchTeams,
    TabGroup,
    HeartIcon,
    ContactSidebar,
    ProgressBar,
    TabList,
    Tab,
    InternalMarketingChromeExtension,
    ImportCreatorModal,
    SocialInput,
    TransitionRoot,
    TabPanels,
    TabPanel,
    MenuList,
    ChevronRightIcon,
    Combobox,
    EllipsisVerticalIcon,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    ChevronDownIcon,
    CheckIcon,
    ArchiveBoxIcon,
    UserGroupIcon,
    CloudArrowUpIcon,
    CrmTable,
    JovieTooltip,
    vueMousetrapPlugin: VueMousetrapPlugin,
    CreatorTags,
    TransitionChild,
  },
  data() {
    return {
      counts: {},
      stages: [],
      networks: [],
      userLists: [],
      showCreatorModal: false,
      loading: false,

      creatorsMeta: {},
      activeCreator: [],
      currentContact: [],
      innerWidth: window.innerWidth,

      lists: [
        {
          name: 'Dancers with really really really really long names',
          emoji: '💃',
          id: 1,
          count: 34,
          index: 2,
        },
        {
          name: 'Singers',
          emoji: '🧑‍🎤 ',
          id: 2,
          count: 23,
          index: 3,
        },
        {
          name: 'Actors',
          emoji: '🎭',
          id: 3,
          count: 54,
          index: 1,
        },
        {
          name: 'Musicians',
          emoji: '🎸',
          id: 4,
          count: 34,
          index: 0,
        },
      ],

      query: '',
      filters: {
        list: '',
        type: 'all',
        page: 1,
          sort: '',
          order: ''
      },
      searchList: '',
      abortController: null,
      openEmojis: false,
      selectedList: null,
        currentSortBy: 'id',
        currentSortOrder: 'desc'
    };
  },
  watch: {
    filters: {
      deep: true,
      handler: function (val) {
        localStorage.setItem('filters', JSON.stringify(val));
      },
    },
    creators: {
      deep: true,
      handler: function () {
        this.crmCounts();
      },
    },
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize());
  },
  computed: {
    showImporting() {
      if (this.userLists.length && this.filters.type == 'list') {
        let list = this.userLists.find((list) => list.id == this.filters.list);
        if (list) {
          return list.updating_list;
        }
      }
      return false;
    },
    sortedCreators() {
      return this.creators.sort((a, b) => {
        let modifier = 1;
        if (this.currentSortDir === 'desc') modifier = -1;
        if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
        if (a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
        return 0;
      });
    },
    filteredUsersLists() {
      if (!this.searchList) this.filters.list = null;
      let filters = localStorage.getItem('filters');
      if (filters) {
        this.filters = JSON.parse(filters);
      }
      return this.userLists.filter((list) =>
        list.name.toLowerCase().match(this.searchList.toLowerCase())
      );
    },
    pinnedUserLists() {
      return this.userLists.filter((list) => list.pinned);
    },
  },
  async mounted() {
    await this.getUserLists();
    this.getCrmCreators();
    this.crmCounts();
    this.$mousetrap.bind(['e'], console.log('working'));

    this.$nextTick(() => {
      window.addEventListener('resize', this.onResize());
    });

    if (!this.$store.state.crmEventsRegistered) {
      this.listenEvents(
        `userListDuplicated.${this.currentUser.current_team.id}`,
        'UserListDuplicated',
        async (data) => {
          await this.getUserLists();
          setTimeout(() => {
            let list = this.userLists.find((list) => list.id == data.list);
            if (list) {
              list.updating_list = null;
              this.setFilterList(list.id);
            }
          }, 200);
        }
      );

      this.listenEvents(
        `importListCreated.${this.currentUser.current_team.id}`,
        'ImportListCreated',
        async (data) => {
          await this.getUserLists();
          setTimeout(() => {
            let list = this.userLists.find((list) => list.id == data.list);
            if (list) {
              this.setFilterList(list.id);
            }
          }, 200);
        }
      );

      this.listenEvents(
        `userListImported.${this.currentUser.current_team.id}`,
        'UserListImported',
        (data) => {
          let index = this.userLists.findIndex((list) => list.id == data.list);
          if (index >= 0) {
            this.userLists[index].updating_list = null;
          }
          this.$store.state.showImportProgress = data.remaining;
          if (!data.remaining) {
            this.getUserLists();
          }
        }
      );

      this.listenEvents(
        `userListImportTriggered.${this.currentUser.current_team.id}`,
        'UserListImportTriggered',
        (data) => {
          let index = this.userLists.findIndex((list) => list.id == data.list);
          if (index >= 0) {
            this.userLists[index].updating_list = true;
            this.$store.state.showImportProgress = data.remaining;
          }
        }
      );

      this.listenEvents(
        `creatorImported.${this.currentUser.current_team.id}`,
        'CreatorImported',
        (data) => {
          if (!data.list) {
            this.$store.state.importProgressSingleCount--;
          }
          if (
            (data.list && this.filters.type != 'list') ||
            (!data.list && this.filters.type != 'all')
          ) {
            return;
          }

          if (
            (data.list && data.list == this.filters.list) ||
            this.filters.type == 'all'
          ) {
            let newCreator = JSON.parse(window.atob(data.creator));
            let index = this.creators.findIndex(
              (creator) => creator.id == newCreator.id
            );

            if (index >= 0) {
              this.creators[index] = newCreator;
            } else {
              if (this.filters.page === 1 && this.creators.length == 50) {
                this.creators.pop();
              }
              if (this.creators.length) {
                this.creators.splice(0, 0, newCreator);
              } else {
                this.creators.push(newCreator);
              }
            }
          }
        }
      );
      this.$store.state.crmEventsRegistered = true;
    }
  },
  methods: {
    closeImportCreatorModal() {
      this.showCreatorModal = false;
    },
    onResize() {
      this.windowWidth = window.innerWidth;
    },
    openEmojiPicker(item) {
      this.selectedList = item;
      this.openEmojis = true;
    },
    emojiSelected(emoji) {
      //take the value of the selected emoji and set it to the emoji variable
      this.selectedList.emoji = emoji.i;
      this.$refs.menuListAll.updateList(
        JSON.parse(JSON.stringify(this.selectedList))
      );
      this.selectedList = null;
      this.openEmojis = false;
    },
    openSidebarContact(contact) {
      this.currentContact = contact;
      this.$store.state.ContactSidebarOpen = true;
    },

    setCurrentContact(contact) {
      this.currentContact = contact;
    },
    setFiltersType(type) {
      this.filters.type = this.filters.type == type ? 'all' : type;
      this.filters.list = null;
      this.getCrmCreators();
    },
    setFilterList(list) {
      this.filters.type = 'list';
      this.filters.list = this.filters.list == list ? null : list;
      this.getCrmCreators();
    },
    sortLists(e, listId) {
      UserService.sortLists(
        { newIndex: e.newIndex, oldIndex: e.oldIndex },
        e.item.id
      )
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
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
            // show toast error here later
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
            if (this.errors.list[0]) {
              this.$notify({
                group: 'user',
                type: 'success',
                duration: 15000,
                title: 'Successful',
                text: this.errors.list[0],
              });
            }
          }
        })
        .finally((response) => {});
    },
    getUserLists() {
      UserService.getUserLists().then((response) => {
        response = response.data;
        if (response.status) {
          this.userLists = response.lists;
        }
      });
    },
    pageChanged({ page }) {
      this.filters.page = page;
    },
    changeTab(index) {
      Object.assign(this.$data, this.$options.data());
      if (index == 1) {
        this.filters.archived = 1;
      } else {
        this.filters.archived = 0;
      }
    },
      setOrder({sortBy, sortOrder}) {
        this.filters.sort = sortBy;
        this.filters.order = sortOrder;
      },
    getCrmCreators(filters = {}) {
      this.loading = true;
      let data = JSON.parse(JSON.stringify(this.filters));
      if (this.abortController) {
        this.abortController.abort();
      }
      this.abortController = new AbortController();
      const signal = this.abortController.signal;
      UserService.getCrmCreators(data, signal).then((response) => {
        this.loading = false;
        response = response.data;
        if (response.status) {
          this.$store.commit('setCrmRecords', response.creators.data);
          this.networks = response.networks;
          this.stages = response.stages;
          this.counts = response.counts;
          this.creatorsMeta = response.creators;
          this.filters.page = response.creators.current_page;
        }
      });
    },
    crmCounts() {
      UserService.crmCounts().then((response) => {
        response = response.data;
        if (response.status) {
          this.counts = response.counts;
        }
      });
    },
    updateListCount(params) {
      let list = this.userLists.find((list) => list.id == params.list_id);
      if (list) {
        if (params.remove) {
          list.creators_count -= params.count;
        } else {
          list.creators_count += params.count;
        }
      }
    },
    exportCrmCreators() {
      let obj = JSON.parse(JSON.stringify(this.filters));
      if (obj.list) {
        obj.list = obj.list.id;
      }
      UserService.exportCrmCreators(obj).then((response) => {
        var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');

        fileLink.href = fileURL;
        fileLink.setAttribute(
          'download',
          `${this.filters.list ? this.filters.list.name : 'creators'}.csv`
        );
        document.body.appendChild(fileLink);

        fileLink.click();
      });
    },
    updateCreator(params) {
      this.$store.dispatch('updateCreator', params).then((response) => {
        response = response.data;
        if (response.status) {
          if (response.data == null) {
            this.creators.splice(params.index, 1);
          } else {
            this.creators[params.index] = response.data;
          }
          this.crmCounts();
        }
      });
    },
    updateCrmMeta(creator = null) {
      console.log('creator');
      console.log(creator);
      if (creator == null) {
        creator = this.currentContact;
      }
      if (!creator) return;
      this.$store
        .dispatch('updateCrmMeta', { id: creator.crm_id, meta: creator.meta })
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.currentContact = response.data;
            this.crmCounts();
          }
        });
    },
  },
};
</script>

<style scoped></style>
