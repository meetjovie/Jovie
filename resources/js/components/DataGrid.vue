<template>
  <div class="h-full w-full flex-col">
    <div class="flex h-full w-full flex-col">
      <div class="h-full pb-10">
        <header
          class="flex w-full items-center justify-between border-slate-300 bg-white px-2 py-2 dark:border-jovieDark-border dark:bg-jovieDark-900">
          <DataGridHeaderContent :header="header" :subheader="subheader" />
          <div class="flex h-6 w-full content-end items-center">
            <div
              class="group flex h-full w-full cursor-pointer content-end items-center justify-end gap-2 py-2 text-right transition-all duration-150 ease-out">
              <TransitionRoot
                :show="searchVisible"
                enter="transition-opacity duration-75"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="transition-opacity duration-0"
                leave-from="opacity-100"
                leave-to="opacity-0">
                <div
                  class="flex h-6 w-full items-center justify-end transition-all">
                  <div
                    class="flex items-center rounded-md border border-slate-300 dark:border-jovieDark-border dark:bg-jovieDark-700">
                    <div
                      class="content-right relative flex flex-grow items-center py-1 focus-within:z-10">
                      <div
                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <MagnifyingGlassIcon
                          class="h-4 w-4 text-slate-400 dark:text-jovieDark-600"
                          aria-hidden="true" />
                      </div>
                      <input
                        placeholder="Press /  to search"
                        ref="searchInput"
                        v-model="searchQuery"
                        class="rounded-m block w-full border-slate-300 py-0.5 pl-10 ring-0 focus:outline-0 focus-visible:border-none focus-visible:ring-0 dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-jovieDark-100 dark:placeholder:text-slate-400 sm:text-sm" />

                      <div
                        @click="toggleSearchVisible()"
                        class="group absolute inset-y-0 right-0 flex items-center pr-3">
                        <XMarkIcon
                          class="h-4 w-4 cursor-pointer rounded-md p-0.5 text-slate-400 transition-all duration-150 group-hover:bg-slate-100 group-hover:text-slate-600 dark:bg-jovieDark-800 dark:text-jovieDark-300 dark:group-hover:bg-jovieDark-800"
                          aria-hidden="true" />
                      </div>
                    </div>
                  </div>
                </div>
              </TransitionRoot>
              <div v-if="!searchVisible">
                <JovieTooltip
                  text="Search"
                  class="w-full justify-end"
                  arrow
                  placement="right-start"
                  ><template #content
                    ><KeyboardShortcut text="/" /> to search</template
                  >
                  <ButtonGroup
                    :design="'toolbar'"
                    :text="'Search'"
                    icon="MagnifyingGlassIcon"
                    hideText
                    @click="toggleSearchVisible()" />
                </JovieTooltip>
              </div>
            </div>
            <div class="flex items-center">
              <div class="group h-full cursor-pointer items-center">
                <Menu v-slot="{ open }" class="items-center">
                  <Float portal class="pr-2" :offset="4" placement="bottom-end">
                    <MenuButton class="inline-flex items-center">
                      <JovieTooltip
                        text="Adjustments"
                        class="w-full justify-end"
                        arrow
                        placement="bottom-end"
                        ><template #content
                          ><KeyboardShortcut text="/" /> to search</template
                        >
                        <ButtonGroup
                          :design="'toolbar'"
                          :text="'Hide Columns'"
                          icon="AdjustmentsHorizontalIcon"
                          hideText />
                      </JovieTooltip>
                    </MenuButton>
                    <TransitionRoot
                      :show="open"
                      enter-active-class="transition duration-100 ease-out"
                      enter-from-class="transform scale-95 opacity-0"
                      enter-to-class="transform scale-100 opacity-100"
                      leave-active-class="transition duration-75 ease-in"
                      leave-from-class="transform scale-100 opacity-100"
                      leave-to-class="transform scale-95 opacity-0">
                      <MenuItems @focus="focusTableColumnFilterInput()" static>
                        <GlassmorphismContainer
                          class="w-60 flex-col rounded-md py-2 pl-2 pr-1 ring-0 focus:ring-0">
                          <div class="px-1">
                            <DropdownMenuItem
                              ref="tableColumnFilterInput"
                              v-on:search-query="updateTableViewSearchQuery"
                              :searchBox="{
                                query: 'tableViewSearchQuery',
                                placeholder: 'Add columns...',
                              }" />
                          </div>
                          <div
                            v-for="column in filteredColumnList"
                            :key="column.name">
                            <SwitchGroup>
                              <SwitchLabel>
                                <DropdownMenuItem
                                  :name="column.name"
                                  :icon="column.icon">
                                  <template #toggle>
                                    <Switch
                                      :name="column.name"
                                      v-model="column.visible"
                                      as="template"
                                      v-slot="{ checked }">
                                      <button
                                        :class="
                                          checked
                                            ? 'bg-indigo-600 dark:bg-indigo-400'
                                            : 'bg-slate-200 dark:bg-jovieDark-800'
                                        "
                                        class="relative inline-flex h-4 w-6 items-center rounded-full border border-slate-300 dark:border-jovieDark-border">
                                        <span class="sr-only">{{
                                          column.name
                                        }}</span>
                                        <span
                                          :class="
                                            checked
                                              ? 'translate-x-3'
                                              : 'translate-x-0'
                                          "
                                          class="inline-block h-3 w-3 transform rounded-full bg-white transition duration-200 ease-in-out dark:bg-jovieDark-900" />
                                      </button>
                                    </Switch>
                                  </template>
                                </DropdownMenuItem>
                              </SwitchLabel>
                            </SwitchGroup>
                          </div>
                          <DropdownMenuItem separator />
                          <div class="">
                            <SwitchGroup>
                              <SwitchLabel>
                                <DropdownMenuItem
                                  :icon="setting.icon"
                                  :key="setting.name"
                                  :name="setting.name"
                                  v-for="setting in settings">
                                  <template #toggle
                                    ><Switch
                                      v-if="setting.type === 'toggle'"
                                      name="columns-visible"
                                      v-model="setting.isVisable"
                                      as="template"
                                      v-slot="{ checked }">
                                      <button
                                        :class="
                                          checked
                                            ? 'bg-indigo-600 dark:bg-indigo-400'
                                            : 'bg-slate-200 dark:bg-jovieDark-700'
                                        "
                                        class="relative inline-flex h-4 w-6 items-center rounded-full border border-slate-300 dark:border-jovieDark-border">
                                        <span
                                          :class="
                                            checked
                                              ? 'translate-x-3'
                                              : 'translate-x-0'
                                          "
                                          class="inline-block h-3 w-3 transform rounded-full bg-white transition dark:bg-jovieDark-100" />
                                      </button> </Switch
                                  ></template>
                                </DropdownMenuItem>
                              </SwitchLabel>
                            </SwitchGroup>
                            <DropdownMenuItem
                              @click="importCSV()"
                              name="Import CSV"
                              icon="CloudArrowUpIcon" />
                          </div>
                        </GlassmorphismContainer>
                      </MenuItems>
                    </TransitionRoot>
                  </Float>
                </Menu>
              </div>
            </div>
          </div>
        </header>
        <div
          class="inline-block h-full w-full overflow-x-auto scroll-smooth align-middle">
          <div
            class="flex h-full w-full flex-col overflow-auto bg-white shadow-sm ring-1 ring-black ring-opacity-5 dark:bg-jovieDark-900">
            <table
              class="block w-full divide-y divide-slate-200 overflow-x-auto bg-slate-100 dark:divide-slate-700 dark:border-jovieDark-border dark:bg-jovieDark-700">
              <thead
                class="relative isolate z-20 w-full items-center overflow-auto">
                <tr class="sticky h-8 items-center">
                  <th
                    scope="col"
                    class="sticky left-0 top-0 z-50 w-6 items-center border-slate-300 bg-slate-100 text-center text-xs font-light tracking-wider text-slate-600 backdrop-blur backdrop-filter before:absolute before:left-0 before:top-0 before:h-full before:border-l before:border-slate-300 before:content-[''] dark:border-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-700 dark:before:border-jovieDark-border">
                    <div class="mx-auto items-center text-center">
                      <input
                        type="checkbox"
                        class="h-3 w-3 rounded border-slate-300 text-indigo-600 focus-visible:ring-indigo-500 dark:border-jovieDark-border dark:text-indigo-400"
                        :checked="
                          intermediate ||
                          selectedCreators.length === creatorRecords.length
                        "
                        :intermediate="intermediate"
                        @change="
                          selectedCreators = $event.target.checked
                            ? creatorRecords.map((c) => c.id)
                            : []
                        " />
                    </div>
                  </th>
                  <th
                    scope="col"
                    class="sticky left-[26.5px] top-0 z-50 w-8 items-center border-slate-300 bg-slate-100 text-center text-xs font-thin tracking-wider text-slate-600 backdrop-blur backdrop-filter dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-jovieDark-400">
                    <span class="sr-only">Favorite</span>
                  </th>
                  <th
                    scope="col"
                    class="sticky left-[55px] top-0 isolate z-50 w-60 resize-x items-center border-r border-slate-300 bg-slate-100 text-left text-xs font-medium tracking-wider text-slate-600 backdrop-blur backdrop-filter after:absolute after:right-[-1px] after:top-0 after:h-full after:border-r after:border-slate-300 after:content-[''] dark:border-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-jovieDark-400 after:dark:border-jovieDark-border">
                    <div
                      v-if="selectedCreators.length > 0"
                      class="flex items-center space-x-3 bg-slate-100 dark:bg-jovieDark-700">
                      <!--   <ContactActionMenu /> -->
                      <Menu>
                        <Float portal :offset="2" placement="bottom-start">
                          <MenuButton
                            class="py-.5 inline-flex items-center rounded border border-slate-300 bg-white px-2 text-2xs font-medium text-slate-700 shadow-sm hover:bg-slate-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30 dark:border-jovieDark-border dark:bg-jovieDark-900 dark:text-jovieDark-300 dark:hover:bg-jovieDark-800">
                            <span class="line-clamp-1">Bulk Actions</span>
                            <ChevronDownIcon
                              class="ml-2 -mr-1 h-5 w-5 text-slate-500 dark:text-jovieDark-400"
                              aria-hidden="true" />
                          </MenuButton>
                          <transition
                            enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0"
                            enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-in"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0">
                            <MenuItems>
                              <GlassmorphismContainer
                                class="max-h-80 w-60 flex-col overflow-y-scroll px-1 py-1">
                                <DropdownMenuItem
                                  v-if="filters.list"
                                  @click="
                                    toggleCreatorsFromList(
                                      selectedCreators,
                                      filters.list,
                                      true
                                    )
                                  "
                                  name="Remove from list"
                                  icon="TrashIcon" />
                                <MenuItem
                                  v-slot="{ active }"
                                  @click="
                                    toggleArchiveCreators(
                                      this.selectedCreators,
                                      this.filters.type == 'archived'
                                        ? false
                                        : true
                                    )
                                  ">
                                  <button
                                    :class="[
                                      active
                                        ? 'bg-slate-300 text-slate-900 dark:bg-jovieDark-700 dark:text-jovieDark-100'
                                        : 'text-slate-700 dark:text-jovieDark-200',
                                      'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
                                    ]">
                                    <ArchiveBoxIcon
                                      :active="active"
                                      class="mr-2 h-3 w-3 text-sky-400"
                                      aria-hidden="true" />
                                    {{
                                      this.filters.type == 'archived'
                                        ? 'Unarchive'
                                        : 'Archive'
                                    }}
                                  </button>
                                </MenuItem>
                                <!-- <DropdownMenuItem @click="toggleArchiveCreators(
                                selectedCreators, filters.type == 'archived' ?
                                false : true ) :name="( filters.type == 'archived'
                                ? 'Unarchive' : 'Archive' )"
                                :icon="ArchiveBoxIcon" /> -->
                              </GlassmorphismContainer>
                            </MenuItems>
                          </transition>
                        </Float>
                      </Menu>
                    </div>
                    <div v-else>
                      <CrmTableSortableHeader
                        icon="Bars3BottomLeftIcon"
                        :column="fullNameColumn"
                        @sortData="
                          sortData({
                            sortBy: fullNameColumn.key,
                            sortOrder: fullNameColumn.sortOrder,
                          })
                        "
                        menu="false" />
                    </div>
                  </th>

                  <template v-for="column in otherColumns">
                    <th
                      :key="column.key"
                      v-if="column.visible"
                      scope="col"
                      :class="columnWidth ? `w-${columnWidth}` : 'w-40'"
                      class="dark:border-x-slate-border sticky top-0 z-30 table-cell items-center border-x border-slate-300 bg-slate-100 text-left text-xs font-medium tracking-wider text-slate-600 backdrop-blur backdrop-filter dark:border-jovieDark-border dark:bg-jovieDark-700 dark:bg-jovieDark-700 dark:text-jovieDark-400">
                      <CrmTableSortableHeader
                        class="w-full"
                        @sortData="sortData"
                        @hide-column="column.visible = false"
                        :column="column" />
                    </th>
                  </template>
                  <th
                    scope="col"
                    :class="[{ 'border-b-2': view.atTopOfPage }, 'border-b-0']"
                    class="sticky top-0 isolate z-30 table-cell w-full content-end items-center border-slate-300 bg-slate-100 py-1 text-right text-xs font-medium tracking-wider text-slate-600 backdrop-blur-2xl backdrop-filter dark:border-jovieDark-border dark:bg-jovieDark-700"></th>
                </tr>
              </thead>
              <tbody
                class="relative isolate z-0 h-full w-full divide-y divide-slate-200 overflow-y-scroll bg-slate-50 dark:divide-slate-700 dark:bg-jovieDark-700">
                <template v-for="(creator, index) in filteredCreators">
                  <DataGridRow
                    :creator="creator"
                    :index="index"
                    :visibleColumns="visibleColumns"
                    :currentContact="currentContact"
                    :key="creator.id"
                    :filters="filters"
                    @openSidebar="$emit('openSidebar', creator)"
                    :column="column"
                    @archive-creators="
                      toggleArchiveCreators(
                        creator.id,
                        !creator.crm_record_by_user.archived
                      )
                    "
                    @refresh="refresh(creator)"
                    :columnIndex="columnIndex"
                    :otherColumns="otherColumns"
                    :selectedCreators="selectedCreators"
                    v-if="creator"
                    @click="setCurrentContact($event, creator)"
                    @contextmenu.prevent="openContextMenu(index, creator)"
                    @mouseover="setCurrentContact($event, creator)" />
                </template>
              </tbody>
            </table>
            <div
              v-if="creatorRecords.length < 50 && creatorRecords.length > 0"
              @click="$emit('addContact')"
              class="flex w-full cursor-pointer items-center bg-white py-2 px-4 text-xs font-bold text-slate-400 hover:bg-slate-100 hover:text-slate-700 dark:bg-jovieDark-900 dark:text-jovieDark-400 hover:dark:bg-jovieDark-700 dark:hover:text-slate-200">
              <PlusIcon class="mr-2 h-4 w-4" />
              Add new contact
            </div>

            <Pagination
              class="z-50 w-full bg-blue-500"
              v-if="creatorRecords.length > 50"
              :totalPages="creatorsMeta.last_page"
              :perPage="creatorsMeta.per_page"
              :currentPage="creatorsMeta.current_page"
              :disabled="loading"
              @pagechanged="$emit('pageChanged', $event)" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Float } from '@headlessui-float/vue';
import {
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  Popover,
  PopoverButton,
  PopoverPanel,
  Switch,
  SwitchGroup,
  SwitchLabel,
  TransitionRoot,
} from '@headlessui/vue';
import {
  AdjustmentsHorizontalIcon,
  ArchiveBoxIcon,
  ArrowDownCircleIcon,
  ArrowPathIcon,
  ArrowSmallLeftIcon,
  ArrowTopRightOnSquareIcon,
  ArrowUpCircleIcon,
  AtSymbolIcon,
  Bars3BottomLeftIcon,
  BriefcaseIcon,
  CalendarDaysIcon,
  ChatBubbleLeftEllipsisIcon,
  ChatBubbleOvalLeftEllipsisIcon,
  CheckIcon,
  ChevronDownIcon,
  ChevronRightIcon,
  ChevronUpIcon,
  CloudArrowDownIcon,
  CloudArrowUpIcon,
  CurrencyDollarIcon,
  EllipsisVerticalIcon,
  EnvelopeIcon,
  HeartIcon,
  LinkIcon,
  ListBulletIcon,
  MagnifyingGlassIcon,
  NoSymbolIcon,
  PhoneIcon,
  PlusIcon,
  StarIcon,
  TrashIcon,
  UserGroupIcon,
  UserIcon,
  XMarkIcon,
} from '@heroicons/vue/24/solid';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import StarRating from 'vue-star-rating';
import ImportService from './../services/api/import.service';
import ButtonGroup from './ButtonGroup.vue';
import ContactContextMenu from './ContactContextMenu';
import ContactContextMenuItem from './ContactContextMenuItem';
import ContactStageMenu from './ContactStageMenu.vue';
import CrmTableSortableHeader from './CrmTableSortableHeader.vue';
import DataGridCell from './DataGridCell.vue';
import DataGridCellTextInput from './DataGridCellTextInput.vue';
import DataGridHeaderContent from './DataGridHeaderContent.vue';
import DataGridRow from './DataGridRow.vue';
import DropdownMenuItem from './DropdownMenuItem.vue';
import GlassmorphismContainer from './GlassmorphismContainer.vue';
import InputLists from './InputLists';
import JovieDropdownMenu from './JovieDropdownMenu.vue';
import JovieSpinner from './JovieSpinner.vue';
import JovieTooltip from './JovieTooltip.vue';
import KeyboardShortcut from './KeyboardShortcut';
import LoadingOverlay from './LoadingOverlay';
import Pagination from './Pagination';
import SocialIcons from './SocialIcons.vue';
export default {
  name: 'DataGrid',
  components: {
    ContactStageMenu,
    JovieDropdownMenu,
    DropdownMenuItem,
    DataGridCell,
    DataGridRow,
    DataGridCellTextInput,
    DataGridHeaderContent,
    LoadingOverlay,
    ArchiveBoxIcon,
    ChevronRightIcon,
    ContactContextMenu,
    StarRating,
    ContactContextMenuItem,
    KeyboardShortcut,
    MagnifyingGlassIcon,
    PhoneIcon,
    ChatBubbleLeftEllipsisIcon,
    GlassmorphismContainer,
    ButtonGroup,
    CloudArrowUpIcon,
    Menu,
    InputLists,
    EnvelopeIcon,
    ArrowSmallLeftIcon,
    Switch,
    Datepicker,
    MenuButton,
    Float,
    StarIcon,
    ArrowPathIcon,
    MenuItems,
    MenuItem,
    EllipsisVerticalIcon,
    SocialIcons,
    Popover,
    BriefcaseIcon,
    UserIcon,
    CheckIcon,
    ChatBubbleOvalLeftEllipsisIcon,
    UserGroupIcon,
    ChevronDownIcon,
    PopoverButton,
    PopoverPanel,
    NoSymbolIcon,
    ListBulletIcon,
    TrashIcon,
    Pagination,
    HeartIcon,
    JovieTooltip,
    PlusIcon,
    JovieSpinner,
    CrmTableSortableHeader,
    Bars3BottomLeftIcon,
    AtSymbolIcon,
    CurrencyDollarIcon,
    ChevronUpIcon,
    LinkIcon,
    CalendarDaysIcon,
    ArrowDownCircleIcon,
    AdjustmentsHorizontalIcon,
    CloudArrowDownIcon,
    XMarkIcon,
    SwitchGroup,
    SwitchLabel,
    ArrowUpCircleIcon,
    TransitionRoot,
    ArrowTopRightOnSquareIcon,
  },
  data() {
    return {
      creatorMenu: false,
      view: {
        atTopOfPage: true,
      },
      creatorRecords: [],
      tableViewSearchQuery: '',
      searchQuery: '',
      stageSearchQuery: '',
      currentRow: null,
      showContextMenu: false,
      showContactStageMenu: [],
      date: null,
      selectedCreators: [],
      currentContact: [],
      editingSocialHandle: true,
      searchVisible: false,
      imageLoaded: true,
      cellActive: false,
      open: false,
      subMenuOpen: true,
      settings: [
        {
          name: 'Show Follower Counts',
          icon: 'UserGroupIcon',
          countsVisible: false,
          type: 'toggle',
        },
      ],
      columns: [
        {
          name: 'Name',
          key: 'full_name',
          icon: 'Bars3BottomLeftIcon',
          sortable: true,
          visible: true,
          dataType: 'text',
        },
        {
          name: 'First',
          key: 'first_name',
          icon: 'Bars3BottomLeftIcon',
          sortable: false,
          visible: false,
          breakpoint: '2xl',
          width: '18',
          dataType: 'text',
        },
        {
          name: 'Last',
          key: 'last_name',
          icon: 'Bars3BottomLeftIcon',
          visible: false,
          sortable: false,
          breakpoint: '2xl',
          width: '18',
          dataType: 'text',
        },
        {
          name: 'Title',
          key: 'title',
          icon: 'UserIcon',
          visible: false,
          breakpoint: '2xl',
          dataType: 'text',
        },
        {
          name: 'Company',
          key: 'employer',
          icon: 'BriefcaseIcon',
          visible: false,
          sortable: false,
          breakpoint: '2xl',
          width: '24',
          dataType: 'text',
        },

        {
          name: 'Email',
          key: 'emails',
          icon: 'AtSymbolIcon',
          visible: true,
          breakpoint: 'lg',
          width: '40',
          dataType: 'email',
        },

        {
          name: 'Social Links',
          key: 'networks',
          icon: 'LinkIcon',
          visible: true,
          width: '18',
          dataType: 'socialLinks',
        },
        {
          name: 'Offer',
          key: 'crm_record_by_user.offer',
          icon: 'CurrencyDollarIcon',
          sortable: false,
          visible: false,
          breakpoint: 'lg',
          width: '12',
          dataType: 'currency',
        },
        {
          name: 'Stage',
          key: 'crm_record_by_user.stage',
          icon: 'ArrowDownCircleIcon',
          width: '24',
          sortable: true,
          visible: true,
          breakpoint: 'md',
          dataType: 'singleSelect',
        },
        {
          name: 'Last Contact',
          key: 'crm_record_by_user.last_contacted',
          icon: 'CalendarDaysIcon',
          sortable: false,
          visible: false,
          breakpoint: '2xl',
          width: '24',
          dataType: 'date',
        },
        {
          name: 'Rating',
          key: 'crm_record_by_user.rating',
          icon: 'StarIcon',
          sortable: true,
          visible: true,
          breakpoint: '2xl',
          width: '28',
          dataType: 'rating',
        },
        {
          name: 'Lists',
          key: 'crm_record_by_user.lists',
          icon: 'ListBulletIcon',
          sortable: true,
          visible: true,
          breakpoint: '2xl',
          width: '24',
          dataType: 'multiSelect',
        },
      ],
      currentSort: 'asc',
      currentSortBy: '',
    };
  },
  props: [
    'userLists',
    'filters',
    'creators',
    'networks',
    'stages',
    'creatorsMeta',
    'loading',
    'archived',
    'subheader',
    'header',
    'counts',
  ],
  watch: {
    creators: function (val) {
      this.creatorRecords = val;
    },
    filters: function () {
      this.selectedCreators = [];
    },
    creatorRecords: function () {
      this.selectedCreators = [];
    },
  },
  mounted() {
    this.$mousetrap.bind('up', () => {
      //prevent the page from scrolling up
      event.preventDefault();
      this.previousContact();
    });
    this.$mousetrap.bind('/', () => {
      if (!this.searchVisible) {
        this.searchVisible = true;
        return this.$nextTick(() => {
          event.preventDefault();
          this.$refs.searchInput.focus();
        });
      } else {
        event.preventDefault();
        this.$refs.searchInput.focus();
      }
    });
    this.$mousetrap.bind('down', () => {
      event.preventDefault();
      this.nextContact();
    });
    this.$mousetrap.bind('space', () => {
      this.toggleContactSidebar();
    });
    //s key opens the stage menu for the current contact
    this.$mousetrap.bind('s', () => {
      if (this.currentContact.length) {
        this.showContactStageMenu = true;
      }
    });

    this.$mousetrap.bind('enter', () => {
      if (this.currentContact.length) {
        this.$router.push({
          name: 'Creator Overview',
          params: { id: this.currentContact[0].id },
        });
      }
    });
    let columns = JSON.parse(localStorage.getItem('columns'));
    if (columns) {
      this.columns = columns;
    }
    this.creatorRecords = this.creatorRecords.length
      ? this.creatorRecords
      : this.creators;
  },
  computed: {
    sidebarOpen() {
      return this.$store.state.sidebarOpen;
    },
    getTheme() {
      return localStorage.getItem('theme') || 'light';
    },
    intermediate() {
      return (
        this.selectedCreators.length > 0 &&
        this.selectedCreators.length < this.creatorRecords.length
      );
    },
    visibleFields() {
      return this.headers.filter((header) => header.visible);
    },
    filteredCreators() {
      return this.creatorRecords.filter((creator) => {
        return (
          creator.name.toLowerCase().match(this.searchQuery.toLowerCase()) ||
          creator.emails.some((email) =>
            email.toString().toLowerCase().match(this.searchQuery.toLowerCase())
          )
        );
      });
    },
    visibleColumns() {
      localStorage.setItem('columns', JSON.stringify(this.columns));
      return this.columns.map((column) => {
        if (column.visible) {
          return column.key;
        }
      });
    },
    fullNameColumn() {
      return this.columns.find((column) => column.key == 'full_name');
    },
    otherColumns() {
      return this.columns.filter((column) => column.key != 'full_name');
    },
    filteredColumnList() {
      return this.columns.filter((column) => {
        return (
          column.name.toLowerCase().includes(this.tableViewSearchQuery) &&
          column.key !== 'full_name'
        );
      });
    },
  },
  // a beforeMount call to add a listener to the window
  beforeMount() {
    window.addEventListener('scroll', this.handleScroll);
  },
  methods: {
    hideContextMenu(creator) {
      creator.showContextMenu = false;
    },
    updateTableViewSearchQuery(query) {
      this.tableViewSearchQuery = query;
    },
    toggleContactStageMenu(index) {
      this.showContactStageMenu[index] = !this.showContactStageMenu[index];
    },
    focusTableColumnFilterInput() {
      //next tick
      this.$nextTick(() => {
        this.$refs.tableColumnFilterInput.focus();
      });
    },
    focusStageInput() {
      //use next tick
      this.$nextTick(() => {
        this.$refs.stageInput.$el.focus();
      });
    },
    openContextMenu(creator) {
      // Close the context menu for any other creators that may have it open
      /*  filteredCreators.forEach((c) => {
          if (c !== creator && c.showContextMenu) {
            c.showContextMenu = false;
          }
        }); */
      // Open the context menu for the given creator
      creator.showContextMenu = true;
    },
    sortData({ sortBy, sortOrder }) {
      this.columns = this.columns.map((column) => {
        if (column.key == sortBy) {
          column.sortOrder = sortOrder == 'asc' ? 'desc' : 'asc';
        } else {
          delete column.sortOrder;
        }
        return column;
      });
      if (sortBy.split('.')[1]) {
        sortBy = sortBy.split('.')[1];
      }
      this.$emit('setOrder', { sortBy, sortOrder });

      if (this.creatorRecords.length > 50) {
        this.$emit('pageChanged', { page: this.creatorsMeta.current_page });
      } else {
        this.creatorRecords = this.creatorRecords.sort((a, b) => {
          let modifier = 1;
          if (sortOrder === 'desc') {
            modifier = -1;
          }
          if (['first_name', 'last_name', 'full_name'].includes(sortBy)) {
            let sortByC = sortBy == 'full_name' ? 'name' : sortOrder;
            return a.meta[sortByC].localeCompare(b.meta[sortByC]) * modifier;
          } else {
            if (a.crm_record_by_user[sortBy] < b.crm_record_by_user[sortBy]) {
              return -1 * modifier;
            }
            if (a.crm_record_by_user[sortBy] > b.crm_record_by_user[sortBy]) {
              return modifier;
            }
          }
          return 0;
        });
      }
    },
    handleScroll() {
      // when the user scrolls, check the pageYOffset
      if (window.pageYOffset > 0) {
        // user is scrolled
        if (this.view.atTopOfPage) this.view.atTopOfPage = false;
      } else {
        // user is at top of page
        if (!this.view.atTopOfPage) this.view.atTopOfPage = true;
      }
    },
    resetChecked() {
      this.selectedCreators = [];
    },
    openSidebarAndSetContact() {
      //if there is currently no contact selected, select the first one
      if (!this.currentContact) {
        this.currentContact = this.creatorRecords[0];
        console.log(this.currentContact.id);
        this.$store.state.ContactSidebarOpen = true;
      }
      //esle just open the sidebar
      else {
        this.$store.state.ContactSidebarOpen = true;
      }
    },
    exportCrmCreators() {
      //export filteredCreators to a csv file
      console.log('exporting');
      //write a function to export all contacts in the current table while accounting for filters and lists
    },

    createCalendarEvent(creator) {
      window.open(
        `https://calendar.google.com/calendar/r/eventedit?text=${
          this.currentUser.first_name
        } ${this.currentUser.last_name} <> ${
          creator.meta.name
        }&details=Created by ${this.currentUser.first_name} ${
          this.currentUser.last_name
        } on ${new Date().toLocaleDateString()}&location=&trp=false&sprop=&sprop=name:&dates=20200501T000000Z/20200501T000000Z&add=${
          creator.meta.emails[0] || creator.emails[0] || ''
        }&notes='Created via Jovie: https://jov.ie`
      );
    },
    emailCreator(email) {
      //go to the url mailto:creator.emails[0]
      //if email is not null
      if (email) {
        window.open('mailto:' + email);
        //else log no email found
      } else {
        console.log('No email found');
        this.$notify({
          title: 'No email found',
          message: 'This contact does not have an email address',
          type: 'warning',
          group: 'user',
        });
      }
    },
    sendTwitterDM(id) {
      //go to the url https://twitter.com/messages/compose?recipient_id=creator.twitter_id
      //if twitter_id is not null
      if (id) {
        //add text tot he message that says "Hey creator.name || creator.meta.name "
        window.open(
          'https://twitter.com/messages/compose?recipient_id=' +
            id +
            '&text=Hey ' +
            this.currentContact.meta.name +
            ','
        );
        //else log no twitter id found
      } else {
        console.log('No twitter id found');
        this.$notify({
          title: 'No twitter id found',
          message: 'This contact does not have a twitter id',
          type: 'warning',
          group: 'user',
        });
      }
    },
    callCreator(phone) {
      //go to the url tel:creator.meta.phone
      //if phone is not null
      if (phone) {
        window.open('tel:' + phone);
        //else log no phone found
      } else {
        console.log('No phone number found');
        this.$notify({
          title: 'No phone number found',
          message: 'This contact does not have a phone number',
          type: 'warning',
          group: 'user',
        });
      }
    },
    whatsappCreator(phone) {
      //go to the url tel:creator.meta.phone
      //if phone is not null
      if (phone) {
        console.log('whatsapp');
        //open whatsapp://send?text=Hello World!&phone=+phone
        window.open('whatsapp://send?text=Hey!&phone=+' + phone);
        //else log no phone found
      } else {
        console.log('No phone number found');
        this.$notify({
          title: 'No phone number found',
          message: 'This contact does not have a phone number',
          type: 'warning',
          group: 'user',
        });
      }
    },
    instagramDMContact(username) {
      if (username.includes('instagram.com')) {
        username = username.split('instagram.com/')[1];
      }
      if (username) {
        window.open('https://ig.me/m/' + username);
      } else {
        console.log('No instagram username found');
        this.$notify({
          title: 'No instagram username found',
          message: 'This contact does not have an instagram username',
          type: 'warning',
          group: 'user',
        });
      }
    },
    textCreator(phone) {
      //go to the url sms:creator.meta.phone
      //if phone is not null
      if (phone) {
        window.open('sms:' + phone);
        //else log no phone found
      } else {
        console.log('No phone number found');
        this.$notify({
          title: 'No phone number found',
          message: 'This contact does not have a phone number',
          type: 'warning',
          group: 'user',
        });
      }
    },
    generateVCF(creator) {
      let vCard = 'BEGIN:VCARD\n';
      vCard += 'VERSION:3.0\n';
      //if creator has a first name
      //if the creator has an instagram handler then set instagram to the instagram handler
      //else if the creator has a meta.instagram_handler then set instagram to the meta.instagram_handler
      //else set instagram to null

      /*       //if creator has an email
       if (creator.emails[0]) {
          vCard += 'EMAIL;TYPE=PREF,INTERNET:' + creator.emails[0] + '\n';
        } else if
        {
          vCard += 'EMAIL;TYPE=PREF,INTERNET:' + creator.meta.emails + '\n';
        } else {
          console.log('No email found');
        };
        //set employer
        if (creator.meta.employer) {
          vCard += 'ORG:' + creator.meta.employer + '\n';
        } else {
          console.log('No employer found');
        };
        //set title
        if (creator.meta.title) {
          vCard += 'TITLE:' + creator.meta.title + '\n';
        } else {
          console.log('No title found');
        };
        if (Creator.location) {
          vCard += 'ADR;TYPE=WORK:;;' + Creator.location + '\n';
        }
        //if creator.instagram_handler set instagram else if creator.meta.instagram set instagram else log no instagram found
        if (creator.instagram_handler) {
          vCard += 'URL;TYPE=WORK:' + creator.instagram_handler + '\n';
        } else if
        {
          vCard += 'URL;TYPE=WORK:' + creator.meta.instagram + '\n';
        } else {
          console.log('No instagram found');
        };
        //do the twitter and twitch and youtube and tiktok and linkedin
        if (creator.twitter_handler) {
          vCard += 'URL;TYPE=WORK:' + creator.twitter_handler + '\n';
        } else if
        {
          vCard += 'URL;TYPE=WORK:' + creator.meta.twitter + '\n';
        } else {
          console.log('No twitter found');
        };
        if (creator.twitch_handler) {
          vCard += 'URL;TYPE=WORK:' + creator.twitch_handler + '\n';
        } else if
        {
          vCard += 'URL;TYPE=WORK:' + creator.meta.twitch + '\n';
        } else {
          console.log('No twitch found');
        };
        if (creator.youtube_handler) {
          vCard += 'URL;TYPE=WORK:' + creator.youtube_handler + '\n';
        } else if
        {
          vCard += 'URL;TYPE=WORK:' + creator.meta.youtube + '\n';
        } else {
          console.log('No youtube found');
        };
        if (creator.tiktok_handler) {
          vCard += 'URL;TYPE=WORK:' + creator.tiktok_handler + '\n';
        } else if
        {
          vCard += 'URL;TYPE=WORK:' + creator.meta.tiktok + '\n';
        } else {
          console.log('No tiktok found');
        };
        if (creator.linkedin_handler) {
          vCard += 'URL;TYPE=WORK:' + creator.linkedin_handler + '\n';
        } else if {
          vCard += 'URL;TYPE=WORK:' + creator.meta.linkedin + '\n';
        } else {console.log('No linkedin found');
        }; */

      vCard += 'NOTE:Saved from Jovie\n';

      vCard += 'END:VCARD';
      return vCard;
    },
    downloadVCF(creator) {
      let vCard = this.generateVCF(creator);
      let blob = new Blob([vCard], { type: 'text/vcard' });
      let url = URL.createObjectURL(blob);
      let link = document.createElement('a');
      link.setAttribute('href', url);
      link.setAttribute('download', this.creator.meta.name + '.vcf');
      link.click();
    },
    toggleSearchVisible() {
      //if search is not visible then make it visible and focus on the search input
      if (!this.searchVisible) {
        this.searchVisible = true;
        this.$nextTick(() => {
          this.$refs.searchInput.focus();
        });
      }
      //else make it not visible
      else {
        this.searchVisible = false;
      }
    },
    setCurrentRow(row) {
      this.currentRow = row;
      console.log(this.currentRow);
    },
    toggleArchiveCreators(ids, archived) {
      this.$store
        .dispatch('toggleArchiveCreators', {
          creator_ids: ids,
          archived: archived,
        })
        .then((response) => {
          response = response.data;
          if (response.status) {
            let creatorIds = Array.isArray(ids) ? ids : [ids];
            this.creatorRecords = this.creatorRecords.filter(
              (creator) => !creatorIds.includes(creator.id)
            );
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
            this.$emit('crmCounts');
          } else {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            if (this.errors) {
              this.errors = error.data.errors;
            }
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {});
    },
    addCreatorsToList(id) {
      this.toggleCreatorsFromList(this.selectedCreators, id, false);
    },
    toggleCreatorsFromList(ids, list, remove) {
      this.$store
        .dispatch('toggleCreatorsFromList', {
          creator_ids: ids,
          list: list,
          remove: remove,
        })
        .then((response) => {
          response = response.data;
          if (response.status) {
            let creatorIds = Array.isArray(ids) ? ids : [ids];
            if (remove && this.filters.list == list) {
              this.creatorRecords = this.creatorRecords.filter(
                (creator) => !creatorIds.includes(creator.id)
              );
              this.$store.state.ContactSidebarOpen = false;
            }
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
            this.$emit('crmCounts');
            this.$emit('updateListCount', {
              count: creatorIds.length,
              list_id: list,
              remove: remove,
            });
          } else {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: 'Contact has been' + response.message + 'from list',
            });
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {});
      this.resetChecked();
    },
    toggleContactSidebar() {
      this.$store.state.ContactSidebarOpen =
        !this.$store.state.ContactSidebarOpen;
    },

    setCurrentContact(e, creator) {
      this.currentContact = creator;
      this.$emit('setCurrentContact', creator);
    },
    nextContact() {
      const index = this.creatorRecords.indexOf(this.currentContact);
      if (index < this.creatorRecords.length - 1) {
        this.setCurrentContact(
          'setCurrentCreator',
          this.creatorRecords[index + 1]
        );
      }
    },
    previousContact() {
      const index = this.creatorRecords.indexOf(this.currentContact);
      if (index > 0) {
        this.setCurrentContact(
          'setCurrentCreator',
          this.creatorRecords[index - 1]
        );
      }
    },
    importCSV() {
      //emit the importCSV event to the parent component
      //push router to /import
      this.$router.push('/import');
    },
    refresh(creator) {
      let imports = {};
      this.networks.forEach((network) => {
        imports[network] = creator[`${network}_handler`];
      });
      if (!Object.keys(imports).length) return;
      this.adding = true;
      ImportService.import(imports)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              title: 'Import initiated',
              text: 'Your data is being updated.',
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
          this.adding = false;
        });
    },
  },
  directives: {
    // enables v-focus in template
    focus,
  },
};
</script>
