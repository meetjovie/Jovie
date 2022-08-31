<template>
  <div class="h-full">
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
            class="top-0 z-30 mx-auto -mt-10 flex h-screen w-60 flex-col justify-between overflow-hidden border-r-2 border-neutral-200 bg-gray-50 px-2 py-4 pb-2 shadow-xl">
            <div>
              <div class="mt-10 flex-col py-1">
                <button
                  class="group flex h-6 w-full items-center justify-between rounded-md text-left hover:bg-neutral-200 hover:text-neutral-500"
                  :class="[
                    selected
                      ? 'text-sm font-bold text-neutral-500  '
                      : 'text-sm font-semibold text-neutral-400',
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
                      class="text-xs font-semibold text-neutral-400 group-hover:hidden group-hover:text-neutral-500"
                      >{{ creators.length }}</span
                    >

                    <PlusIcon
                      class="hidden h-3 w-3 text-gray-400 active:text-white group-hover:block"></PlusIcon>
                  </div>
                </button>

                <button
                  class="group flex h-6 w-full items-center justify-between rounded-md py-1 text-left hover:bg-neutral-200 hover:text-neutral-500"
                  :class="[
                    selected
                      ? 'text-sm font-bold text-neutral-500 '
                      : 'text-sm font-semibold text-neutral-400',
                  ]">
                  <div class="flex items-center text-xs">
                    <ArchiveIcon
                      class="mr-1 h-5 w-5 rounded-md p-1 text-sky-400"
                      aria-hidden="true" />Archived
                  </div>
                  <div class="items-center rounded-md p-1 hover:text-gray-50">
                    <span
                      class="text-xs font-semibold text-neutral-400 group-hover:text-neutral-500"
                      >{{ creators.length }}</span
                    >
                  </div>
                </button>

                <button
                  class="group flex h-6 w-full items-center justify-between rounded-md py-1 text-left hover:bg-neutral-200 hover:text-neutral-500"
                  :class="[
                    selected
                      ? 'text-sm font-bold text-neutral-500 '
                      : 'text-sm font-semibold text-neutral-400',
                  ]">
                  <div class="flex items-center text-xs">
                    <HeartIcon
                      class="mr-1 h-5 w-5 rounded-md p-1 text-red-400"
                      aria-hidden="true" />Favorites
                  </div>
                  <div class="items-center rounded-md p-1 hover:text-gray-50">
                    <span
                      class="text-xs font-semibold text-neutral-400 group-hover:text-neutral-500"
                      >{{ creators.length }}</span
                    >
                  </div>
                </button>
              </div>
              <div class="flex-col space-y-4 py-4">
                <MenuList
                    @getUserLists="getUserLists"
                  menuName="Pinned"
                  :menuItems="pinnedUserLists"></MenuList>
                <MenuList
                    @getUserLists="getUserLists"
                    menuName="Lists"
                  :draggable="true"
                  @end="sortLists"
                  :menuItems="filteredUsersLists"></MenuList>
              </div>
            </div>
            <div class="flex-shrink-0">
              <SwitchTeams />
              <div
                v-if="!currentUser.current_team.credits"
                as="router-link"
                to="/billing"
                class="underline-2 cursor-pointer text-xs font-bold text-indigo-500 decoration-indigo-700 hover:underline">
                Upgrade
              </div>
              <div class="mt-1 py-1">
                <ProgressBar
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
            </div>
          </div>
        </TransitionRoot>
        <div class="w-full">
          <div class="mx-auto w-full min-w-full">
            <div class="w-full">
              <div class="flex w-full flex-col">
                <div class="mx-auto w-full p-0">
                  <div class="inline-block w-full align-middle">
                    <div class="">
                      <div
                        v-if="!loading && creators.length < 1"
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
                            <SocialInput class="py-12" />
                            <InternalMarketingChromeExtension class="mt-24" />
                          </div>
                        </div>
                      </div>

                      <CrmTable
                        v-else
                        @updateCreator="updateCreator"
                        @pageChanged="pageChanged"
                        :creators="creators"
                        :networks="networks"
                        :stages="stages"
                        :creatorsMeta="creatorsMeta"
                        :loading="loading" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--  <TabPanel>
              <div class="mx-auto w-full min-w-full">
                <div class="w-full">
                  <div class="flex w-full flex-col">
                    <div class="mx-auto w-full p-0">
                      <div class="inline-block w-full align-middle">
                        <div class="border-b border-gray-200 shadow">
                          <CrmTable
                            @updateCreator="updateCreator"
                            @pageChanged="pageChanged"
                            :creators="creators"
                            :networks="networks"
                            :stages="stages"
                            :creatorsMeta="creatorsMeta"
                            :archived="true"
                            :loading="loading" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </TabPanel> -->
        </div>
      </div>

      <ImportCreatorModal :open="showCreatorModal" />
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
  MenuItems,
  MenuItem,
} from '@headlessui/vue';
import {
  ChevronDownIcon,
  DownloadIcon,
  CheckIcon,
  UserGroupIcon,
  DotsVerticalIcon,
  PlusIcon,
  HeartIcon,
  ArchiveIcon,
  CloudUploadIcon,
} from '@heroicons/vue/solid';
import UserService from '../services/api/user.service';
import CrmTable from '../components/Crm/CrmTable';
import ImportCreatorModal from '../components/ImportCreatorModal';
import SocialInput from '../components/SocialInput';
import InternalMarketingChromeExtension from '../components/InternalMarketingChromeExtension';
import MenuList from '../components/MenuList';
import ProgressBar from '../components/ProgressBar';
import SwitchTeams from '../components/SwitchTeams';

export default {
  name: 'CRM',
  components: {
    DownloadIcon,
    PlusIcon,
    SwitchTeams,
    TabGroup,
    HeartIcon,
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
    Combobox,
    DotsVerticalIcon,
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
    ArchiveIcon,
    UserGroupIcon,
    CloudUploadIcon,
    CrmTable,
  },
  data() {
    return {
      stages: [],
      networks: [],
      userLists: [],
      showCreatorModal: false,
      loading: false,
      creators: [],
      creatorsMeta: {},
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
        list: null,
        archived: 0,
        page: 1,
      },
      searchList: '',
    };
  },
  watch: {
    filters: {
      deep: true,
      handler: function (val) {
        this.getCrmCreators();
        if (val.list) {
          localStorage.setItem('filterListCrm', JSON.stringify(val.list));
        }
      },
    },
  },
  computed: {
    filteredUsersLists() {
      if (!this.searchList) this.filters.list = null;
      let filterList = localStorage.getItem('filterListCrm');
      if (filterList) {
        this.filters.list = JSON.parse(filterList);
      }
      return this.userLists.filter((list) =>
        list.name.toLowerCase().match(this.searchList.toLowerCase())
      );
    },
    pinnedUserLists() {
      return this.userLists.filter((list) => list.pinned);
    },
  },
  mounted() {
    this.getUserLists();
    this.getCrmCreators();
  },
  methods: {
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
            // show toast error here later
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
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
    getCrmCreators(filters = {}) {
      this.loading = true;
      let data = JSON.parse(JSON.stringify(this.filters));
      data.list = data.list?.id;
      UserService.getCrmCreators(data).then((response) => {
        this.loading = false;
        response = response.data;
        if (response.status) {
          this.networks = response.networks;
          this.stages = response.stages;
          this.creators = response.creators.data;
          this.creatorsMeta = response.creators;
          this.filters.page = response.creators.current_page;
        }
      });
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
        }
      });
    },
  },
};
</script>

<style scoped></style>
