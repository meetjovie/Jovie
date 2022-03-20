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
                  <span class="mb-3">Creators</span>
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
          <select id="dropdown-1" text="Dropdown Button" class="rounded-md relative mt-1">
            <option disabled :value="null">Select one</option>
            <option v-for="item in filters.list" :key="item.title" value="{{item.id}}">{{item.title}}</option>
          </select>
        </div>
        <div class="items-center px-2">
          <Menu as="div" class="relative inline-block items-center text-left">
            <span class="relative z-0 inline-flex rounded-md py-1">
              <button
                as="router-link"
                to="/import"
                type="button"
                class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white py-2 px-3 text-xs font-medium text-gray-700 hover:bg-indigo-600 hover:text-white focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
                Add creator
              </button>
              <MenuButton
                as="div"
                class="relative -ml-px inline-flex items-center rounded-r-md border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100">
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
      <TabPanels>
        <TabPanel>
          <div class="mx-auto w-full min-w-full">
            <div class="w-full">
              <div class="flex w-full flex-col">
                <div class="mx-auto w-full p-0">
                  <div class="inline-block w-full align-middle">
                    <div
                      class="overflow-hidden border-b border-gray-200 shadow">
                      <div
                        v-if="!loading && creators.length < 1"
                        class="mx-auto max-w-7xl items-center py-24 px-4 sm:px-6 lg:px-8">
                        <div class="mx-auto max-w-xl">
                          <router-link
                            to="import"
                            :class="[
                              active
                                ? 'bg-gray-100 text-gray-900'
                                : 'text-gray-700',
                              'group flex items-center px-4 py-2 text-sm first:pt-3 last:pt-3',
                            ]">
                            <button
                              type="button"
                              class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="mx-auto h-12 w-12 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                              </svg>
                              <span
                                class="mt-2 block text-sm font-bold text-gray-900">
                                Select a file to upload
                              </span>
                              <span
                                class="mt-2 block text-xs font-medium text-gray-400">
                                or drag and drop csv files</span
                              >
                            </button>
                          </router-link>
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
                    <div
                      class="overflow-hidden border-b border-gray-200 shadow">
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
import StarRating from 'vue-star-rating';
import {
  DotsVerticalIcon,
  ChevronDownIcon,
  DownloadIcon,
  CheckIcon,
  CloudUploadIcon,
} from '@heroicons/vue/solid';
import UserService from '../services/api/user.service';
import CrmTable from '../components/Crm/CrmTable';

export default {
  name: 'CRM',
  components: {
    DownloadIcon,
    TabGroup,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
    StarRating,
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    DotsVerticalIcon,
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
      filterId: 1,
      loading: false,
      creators: [],
      creatorsMeta: {},
      filters: {
          list:  [
            {
              id: 1,
              title: 'All'
            },
            {
              id: 2,
              title: 'Prospects'
            },
            {
              id: 3,
              title: 'Contacted'
            },
            {
              id: 4,
              title: 'Negotiating'
            },
            {
              id: 5,
              title: 'Closed'
            },
          ],
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
      },
    },
  },
  computed: {
    filteredUsersLists() {
      if (!this.searchList) //this.filters.list = null;
      return this.userLists.filter((list) =>
        list.name.toLowerCase().match(this.searchList.toLowerCase())
      );
    },
  },
  mounted() {
    this.getCrmCreators();
    this.getUserLists();
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
      UserService.exportCrmCreators(this.filters).then((response) => {
        var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');

        fileLink.href = fileURL;
        fileLink.setAttribute('download', 'creators.csv');
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
