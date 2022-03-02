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
                                alt="selector"/>
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
                <div class="items-center w-60">
                    <Combobox as="div" v-model="filters.list">
                        <div class="relative mt-1 ">
                            <ComboboxInput
                                class="w-full rounded-md border border-gray-300 bg-white py-1 pl-3 pr-10 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                                :displayValue="(list) => (list ? list.name : '')"
                                @change="searchList = $event.target.value"/>
                            <ComboboxButton
                                class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                <ChevronDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
                            </ComboboxButton>

                            <ComboboxOptions v-if="filteredUsersLists.length > 0"
                                             class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                <ComboboxOption v-for="list in filteredUsersLists" :key="list.id" :value="list"
                                                as="template"
                                                v-slot="{ active, selected }">
                                    <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                        <span :class="['block truncate', selected && 'font-semibold']">
                                        {{ list.name }}
                                        </span>

                                        <span v-if="selected"
                                              :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                        <CheckIcon class="h-5 w-5" aria-hidden="true"/>
                                        </span>
                                    </li>
                                </ComboboxOption>
                            </ComboboxOptions>
                        </div>
                    </Combobox>
                </div>
                <div class="items-center px-2">
                    <Menu as="div" class="relative inline-block items-center text-left">
                       <span class="relative z-0 inline-flex py-1 rounded-md ">
                            <button as="router-link" to="/import" type="button"
                                    class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white py-2 px-3 text-xs font-medium text-gray-700 hover:bg-indigo-600 hover:text-white focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
                            Add creator
                            </button>
                            <MenuButton as="div"
                                        class="-ml-px relative inline-flex items-center px-3 py-2 rounded-r-md border border-gray-300 shadow-sm bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100 focus-visible:ring-indigo-500">
                                <ChevronDownIcon class="h-4 w-4" aria-hidden="true"/>
                            </MenuButton>
                        </span>
                        <transition enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95">
                            <MenuItems
                                class="origin-top-right absolute z-30 right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus-visible:outline-none">
                                <div class="">
                                    <MenuItem v-slot="{ active }">
                                        <router-link to="/import"
                                                     :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex first:pt-3 last:pt-3 items-center px-4 py-2 text-sm']">
                                            <CloudUploadIcon
                                                class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                                aria-hidden="true"/>
                                            Import a csv
                                        </router-link>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <a href="#"
                                           :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex items-center first:pt-3 last:pt-3 px-4 py-2 text-sm']">
                                            <DownloadIcon class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                                          aria-hidden="true"/>
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
                                            <div v-if="!loading && creators.length < 1"
                                                 class="max-w-7xl items-center py-24 mx-auto px-4 sm:px-6 lg:px-8">
                                                <div class="max-w-xl mx-auto">
                                                    <button type="button"
                                                            class="relative block w-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                        </svg>
                                                        <span class="mt-2 block text-sm font-bold text-gray-900"> Select a file to upload </span>
                                                        <span class="mt-2 block text-xs font-medium text-gray-400"> or drag and drop csv files</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <CrmTable v-else @updateCreator="updateCreator" @pageChanged="pageChanged"
                                                      :creators="creators"
                                                      :networks="networks"
                                                      :stages="stages"
                                                      :creatorsMeta="creatorsMeta"
                                                      :loading="loading"
                                            />
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
                                            <CrmTable @updateCreator="updateCreator" @pageChanged="pageChanged"
                                                      :creators="creators"
                                                      :networks="networks"
                                                      :stages="stages"
                                                      :creatorsMeta="creatorsMeta"
                                                      :arcvhied="true"
                                                      :loading="loading"
                                            />
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
    CloudUploadIcon

} from '@heroicons/vue/solid';
import UserService from "../services/api/user.service";
import CrmTable from "../components/Crm/CrmTable";

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
        CrmTable
    },
    data() {
        return {
            stages: [],
            networks: [],
            userLists: [],

            loading: false,
            creators: [],
            creatorsMeta: {},
            filters: {
                list: null,
                archived: 0,
                page: 1
            },
            searchList: '',
        };
    },
    watch: {
        filters: {
            deep: true,
            handler: function (val) {
                this.getCrmCreators()
            }
        }
    },
    computed: {
        filteredUsersLists() {
            if (!this.searchList) this.filters.list = null
            return this.userLists.filter(list => list.name.toLowerCase().match(this.searchList.toLowerCase()))
        }
    },
    mounted() {
        this.getCrmCreators()
        this.getUserLists()
    },
    methods: {
        getUserLists() {
            UserService.getUserLists()
                .then(response => {
                    response = response.data
                    if (response.status) {
                        this.userLists = response.lists
                    }
                })
        },
        pageChanged({page}) {
            this.filters.page = page
        },
        changeTab(index) {
            Object.assign(this.$data, this.$options.data())
            if (index == 1) {
                this.filters.archived = 1
            } else {
                this.filters.archived = 0
            }
        },
        getCrmCreators(filters = {}) {
            this.loading = true
            UserService.getCrmCreators(this.filters)
                .then(response => {
                    this.loading = false
                    response = response.data
                    if (response.status) {
                        this.networks = response.networks
                        this.stages = response.stages
                        this.creators = response.creators.data
                        this.creatorsMeta = response.creators
                        this.filters.page = response.creators.current_page
                    }
                })
        },
        updateCreator({id, index, network, key, value}) {

            const data = {
                id: id,
            }
            let keySplits = key.split('.')
            if (keySplits.length > 1) {
                var key1 = keySplits[0]
                var key2 = keySplits[1]
                data[key1] = {
                    [key2]: value
                }
            } else {
                data[key] = value
            }

            this.$store.dispatch('updateCreator', data).then(response => {
                response = response.data
                if (response.status) {
                    if (response.data == null) {
                        this.creators.splice(index, 1)
                    } else {
                        this.creators[index] = response.data
                    }
                }
            })
        },
    }
};
</script>

<style scoped></style>
