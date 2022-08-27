<template>
  <div id="crm" class="mx-auto w-full min-w-full">
    <TabGroup :defaultIndex="0" as="div" @change="changeTab">
      <div class="items-bottom flex w-full justify-between border-b bg-white">
        <div>
          <div class="relative mx-auto w-full rounded sm:hidden">
            <div class="absolute inset-0 z-0 m-auto mr-4 h-6 w-6">
              <img
                class="icon icon-tabler icon-tabler-selector"
                src=""
                alt="selector" />
            </div>
          </div>
          <TabList
            class="items-bottom hidden h-12 rounded bg-white sm:block xl:mx-0 xl:w-full">
            <div class="flex h-12 px-5">
              <Tab v-slot="{ selected }" as="template">
                <button
                  class="w-24"
                  :class="[
                    selected
                      ? 'text-indigo text-sm underline decoration-indigo-700 decoration-4 underline-offset-8'
                      : 'text-sm text-neutral-700',
                  ]">
                  <span class="mb-3">All Contacts</span>
                </button>
              </Tab>
              <Tab v-slot="{ selected }" as="template">
                <button
                  class="w-24"
                  :class="[
                    selected
                      ? 'text-indigo text-sm underline decoration-indigo-700 decoration-4 underline-offset-8'
                      : 'text-sm text-neutral-700',
                  ]">
                  <span class="mb-3">Archived</span>
                </button>
              </Tab>
            </div>
          </TabList>
        </div>
        <div class="w-60 items-center">
          <Combobox as="div" v-model="filters.list">
            <div class="relative mt-1">
              <ComboboxInput
                placeholder="Filter by list"
                class="w-full rounded-md border border-gray-300 bg-white py-1 pl-3 pr-10 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                :displayValue="(list) => (list ? list.name : '')"
                @change="searchList = $event.target.value" />
              <ComboboxButton
                class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                <ChevronDownIcon
                  class="h-5 w-5 text-gray-400"
                  aria-hidden="true" />
              </ComboboxButton>

              <ComboboxOptions
                v-if="filteredUsersLists.length > 0"
                class="absolute z-20 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                <ComboboxOption
                  v-for="list in filteredUsersLists"
                  :key="list.id"
                  :value="list"
                  as="template"
                  v-slot="{ active, selected }">
                  <li
                    :class="[
                      'relative cursor-default select-none py-2 pl-3 pr-9',
                      active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                    ]">
                    <span
                      :class="['block truncate', selected && 'font-semibold']">
                      {{ list.name }}
                    </span>

                    <span
                      v-if="selected"
                      :class="[
                        'absolute inset-y-0 right-0 flex items-center pr-4',
                        active ? 'text-white' : 'text-indigo-600',
                      ]">
                      <CheckIcon class="h-5 w-5" aria-hidden="true" />
                    </span>
                  </li>
                </ComboboxOption>
              </ComboboxOptions>
            </div>
          </Combobox>
        </div>
        <div class="items-center px-2">
          <Menu as="div" class="relative inline-block items-center text-left">
            <span class="relative z-0 inline-flex rounded-md py-1">
              <button
                @click="showCreatorImportModal = true"
                type="button"
                class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white py-2 px-3 text-xs font-medium text-gray-700 hover:bg-indigo-600 hover:text-white focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
                Add contact
              </button>
              <MenuButton
                as="div"
                class="relative -ml-px inline-flex cursor-pointer items-center rounded-r-md border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100">
                <ChevronDownIcon class="h-4 w-4" aria-hidden="true" />
              </MenuButton>
            </span>
            <transition
              enter-active-class="transition ease-out duration-100"
              enter-from-class="transform opacity-0 scale-95"
              enter-to-class="transform opacity-100 scale-100"
              leave-active-class="transition ease-in duration-75"
              leave-from-class="transform opacity-100 scale-100"
              leave-to-class="transform opacity-0 scale-95">
              <MenuItems
                class="absolute right-0 z-30 mt-2 w-40 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus-visible:outline-none">
                <div class="">
                  <MenuItem v-slot="{ active }">
                    <router-link
                      to="/import"
                      :class="[
                        active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                        'group flex items-center px-4 py-2 text-sm first:pt-3 last:pt-3',
                      ]">
                      <CloudUploadIcon
                        class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                        aria-hidden="true" />
                      Import a csv
                    </router-link>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a
                      @click="exportCrmCreators()"
                      :class="[
                        active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                        'group flex items-center px-4 py-2 text-sm first:pt-3 last:pt-3',
                      ]">
                      <DownloadIcon
                        class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                        aria-hidden="true" />
                      Export a csv
                    </a>
                  </MenuItem>
                </div>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
      <div class="flex h-screen">
        <div
          v-if="$store.state.CRMSidebarOpen"
          class="border-neutral-2 z-10 h-full w-60 border-r-2 bg-neutral-50 px-1 py-2 shadow-xl">
          <div class="h-1/2">
            <MenuList menuName="Lists" :menuItems="filters.list"></MenuList>
          </div>
          <div>
            <MenuList menuName="Tags" :menuItems="lists"></MenuList>
          </div>
        </div>
        <div class="w-full">
          <TabPanels>
            <TabPanel>
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
                                  <span
                                    class="text-sm font-medium text-neutral-500"
                                    >Enter the url of a social profile to add a
                                    contact to Jovie.</span
                                  >
                                </div>
                                <SocialInput class="py-12" />
                                <InternalMarketingChromeExtension
                                  class="mt-24" />
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
            </TabPanel>
            <TabPanel>
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
                            :arcvhied="true"
                            :loading="loading" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </TabPanel>
          </TabPanels>
        </div>
      </div>
    </TabGroup>
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
  MenuItems,
  MenuItem,
} from '@headlessui/vue';
import {
  ChevronDownIcon,
  DownloadIcon,
  CheckIcon,
  CloudUploadIcon,
} from '@heroicons/vue/solid';
import UserService from '../services/api/user.service';
import CrmTable from '../components/Crm/CrmTable';

import SocialInput from '../components/SocialInput';
import InternalMarketingChromeExtension from '../components/InternalMarketingChromeExtension';
import MenuList from '../components/MenuList';
export default {
  name: 'CRM',
  components: {
    DownloadIcon,
    TabGroup,
    TabList,
    Tab,
    InternalMarketingChromeExtension,
    SocialInput,
    TabPanels,
    TabPanel,
    MenuList,
    Combobox,
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
          name: 'Dancers',
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
  },
  mounted() {
    this.getUserLists();
    this.getCrmCreators();
  },
  methods: {
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
