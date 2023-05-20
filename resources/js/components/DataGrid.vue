<template>
  <div class="h-full w-full flex-col overflow-hidden">
    <div class="flex h-full w-full flex-col">
      <div class="h-full pb-10">
        <header
          class="flex w-full items-center justify-between border-b border-slate-200 bg-white px-2 py-2 dark:border-jovieDark-border dark:bg-jovieDark-900">
          <DataGridHeaderContent
            :loading="loading"
            :taskLoading="taskLoading"
            :header="header"
            @updateUserList="updateUserList"
            :list="filters.currentList"
            :subheader="subheader" />
          <!--  <span
            class="flex w-40 items-center text-xs text-slate-600 dark:text-jovieDark-200">
            >You're in Column: {{ currentCell.column }} Row:
            {{ currentCell.row }}</span
          > -->
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
                              tabindex="0"
                              ref="tableColumnFilterInput"
                              v-on:search-query="updateTableViewSearchQuery"
                              :searchBox="{
                                query: 'tableViewSearchQuery',
                                placeholder: 'Add columns...',
                              }" />
                          </div>
                          <DropdownMenuItem
                            disabled
                            name="Name"
                            icon="UserIcon">
                            <template #toggle>
                              <LockClosedIcon class="h-4 w-5" />
                            </template>
                          </DropdownMenuItem>
                          <div
                            v-for="(column, index) in filteredColumnList"
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
                                      @click="toggleHeaderHide(column, index)"
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
                                      v-model="setting.visible"
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
                            <DropdownMenuItem
                              @click="$emit('export')"
                              name="Export CSV"
                              icon="CloudArrowDownIcon" />
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
              ref="crmTable"
              class="block w-full divide-y divide-slate-200 overflow-x-auto bg-slate-100 dark:divide-slate-700 dark:border-jovieDark-border dark:bg-jovieDark-700">
              <thead
                class="relative isolate z-20 w-full items-center overflow-auto">
                <tr
                  v-if="!headersLoaded"
                  class="sticky top-0 z-50 h-8 w-full items-center">
                  <th
                    scope="col"
                    class="sticky left-0 top-0 z-50 w-6 items-center border-slate-300 bg-slate-100 px-2 text-center text-xs font-light tracking-wider text-slate-600 backdrop-blur backdrop-filter before:absolute before:left-0 before:top-0 before:h-full before:border-l before:border-slate-300 before:content-[''] dark:border-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-700 dark:before:border-jovieDark-border">
                    <div
                      class="h-4 w-3 animate-pulse rounded-md bg-slate-300"></div>
                  </th>
                  <th
                    scope="col"
                    class="sticky left-[26.5px] top-0 z-50 w-12 items-center border-slate-300 bg-slate-100 px-2 text-center text-xs font-thin tracking-wider text-slate-600 backdrop-blur backdrop-filter dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-jovieDark-400">
                    <div
                      class="h-4 w-8 animate-pulse rounded-md bg-slate-300"></div>
                  </th>
                  <th
                    scope="col"
                    class="sticky left-[55px] top-0 isolate z-50 w-60 resize-x items-center border-r border-slate-300 bg-slate-100 px-2 text-left text-xs font-medium tracking-wider text-slate-600 backdrop-blur backdrop-filter after:absolute after:right-[-1px] after:top-0 after:h-full after:border-r after:border-slate-300 after:content-[''] dark:border-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-jovieDark-400 after:dark:border-jovieDark-border">
                    <div
                      class="h-4 w-40 animate-pulse rounded-md bg-slate-300"></div>
                  </th>
                  <th
                    v-for="i in 10"
                    class="dark:border-slate-border sticky top-0 z-30 table-cell w-40 items-center border-x border-slate-300 bg-slate-100 px-2 text-left text-xs font-medium tracking-wider text-slate-600 backdrop-blur backdrop-filter dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-jovieDark-400">
                    <div
                      class="h-4 w-24 animate-pulse rounded-md bg-slate-300"></div>
                  </th>
                </tr>
                <draggable
                  v-else
                  v-model="headers"
                  itemKey="key"
                  ghost-class="ghost-header"
                  tag="tr"
                  @end="sortHeaders"
                  @start="startHeaderDrag"
                  handle=".drag-head"
                  class="sticky h-8 items-center">
                  <template #header>
                    <th
                      scope="col"
                      class="sticky left-0 top-0 z-50 w-6 items-center border-slate-300 bg-slate-100 px-2 text-center text-xs font-light tracking-wider text-slate-600 backdrop-blur backdrop-filter before:absolute before:left-0 before:top-0 before:h-full before:border-l before:border-slate-300 before:content-[''] dark:border-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-700 dark:before:border-jovieDark-border">
                      <div class="mx-auto items-center text-center">
                        <input
                          type="checkbox"
                          class="h-3 w-3 rounded border-slate-300 text-indigo-600 focus-visible:ring-indigo-500 dark:border-jovieDark-border dark:text-indigo-400"
                          :checked="
                            intermediate ||
                            selectedContacts.length === contactRecords.length
                          "
                          :intermediate="intermediate"
                          @change="
                            selectedContacts = $event.target.checked
                              ? contactRecords.map((c) => c.id)
                              : []
                          " />
                      </div>
                    </th>
                    <th
                      scope="col"
                      class="sticky left-[26.5px] top-0 z-50 w-12 items-center border-slate-300 bg-slate-100 text-center text-xs font-thin tracking-wider text-slate-600 backdrop-blur backdrop-filter dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-jovieDark-400">
                      <span class="sr-only">Favorite</span>
                    </th>
                    <th
                      scope="col"
                      class="sticky left-[55px] top-0 isolate z-50 w-60 resize-x items-center border-r border-slate-300 bg-slate-100 text-left text-xs font-medium tracking-wider text-slate-600 backdrop-blur backdrop-filter after:absolute after:right-[-1px] after:top-0 after:h-full after:border-r after:border-slate-300 after:content-[''] dark:border-jovieDark-border dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-jovieDark-400 after:dark:border-jovieDark-border">
                      <div
                        v-if="selectedContacts.length > 0"
                        class="flex items-center space-x-3 bg-slate-100 dark:bg-jovieDark-700">
                        <!--   <ContactActionMenu /> -->
                        <Menu>
                          <Float portal :offset="2" placement="bottom-start">
                            <MenuButton
                              class="py-.5 inline-flex items-center rounded border border-slate-300 bg-white px-2 text-2xs font-medium text-slate-700 shadow-sm hover:bg-slate-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30 dark:border-jovieDark-border dark:bg-jovieDark-900 dark:text-jovieDark-300 dark:hover:bg-jovieDark-800">
                              <span class="line-clamp-1">Bulk Actions</span>
                              <ChevronDownIcon
                                class="-mr-1 ml-2 h-5 w-5 text-slate-500 dark:text-jovieDark-400"
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
                                      toggleContactsFromList(
                                        selectedContacts,
                                        filters.list,
                                        true
                                      )
                                    "
                                    name="Remove from list"
                                    icon="TrashIcon" />
                                  <MenuItem
                                    v-slot="{ active }"
                                    @click="
                                      toggleArchiveContacts(
                                        this.selectedContacts,
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
                                  <MenuItem
                                    v-slot="{ active }"
                                    @click="
                                      $emit(
                                        'checkContactsEnrichable',
                                        selectedContacts
                                      )
                                    ">
                                    <button
                                      :class="[
                                        active
                                          ? 'bg-slate-300 text-slate-900 dark:bg-jovieDark-700 dark:text-jovieDark-100'
                                          : 'text-slate-700 dark:text-jovieDark-200',
                                        'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
                                      ]">
                                      <SparklesIcon
                                        :active="active"
                                        class="mr-2 h-3 w-3 text-sky-400"
                                        aria-hidden="true" />
                                      Enrich
                                    </button>
                                  </MenuItem>
                                  <!-- <DropdownMenuItem @click="toggleArchiveContacts(
                                selectedContacts, filters.type == 'archived' ?
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
                        <DataGridColumnHeader
                          :show-resizeable="false"
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
                  </template>

                  <template #item="{ element, index }">
                    <th
                      :key="element.id"
                      :id="element.id"
                      v-show="!element.hide"
                      scope="col"
                      :style="`width: ${element.width}px`"
                      class="dark:border-slate-border sticky top-0 z-30 table-cell w-full items-center border-x border-slate-300 bg-slate-100 text-left text-xs font-medium tracking-wider text-slate-600 backdrop-blur backdrop-filter dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-jovieDark-400">
                      <DataGridColumnHeader
                        class="w-full"
                        @updateColumnWidth="updateColumnWidth($event)"
                        @reflectColumnWidth="reflectColumnWidth($event)"
                        @editField="editCustomFieldsModal"
                        @sortData="sortData"
                        @hideColumn="toggleHeaderHide(element, index, true)"
                        @deleteField="deleteField(element)"
                        :index="index"
                        :last-column-index="headers.length - 1"
                        :column="element"
                        :previous-column="getPreviousColumn(index)" />
                    </th>
                  </template>
                  <template #footer>
                    <th
                      scope="col"
                      class="sticky top-0 z-30 table-cell h-10 w-40 cursor-pointer items-center border-x border-slate-300 bg-slate-100 text-left text-xs font-medium tracking-wider text-slate-600 backdrop-blur backdrop-filter hover:bg-slate-300 focus:border-transparent focus:outline-none focus:ring-0 dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-jovieDark-400 dark:hover:bg-jovieDark-600">
                      <div @click="openCustomFieldModal()" class="w-40">
                        <!-- <CustomFieldsMenu
                          class=""
                          @getHeaders="$emit('getHeaders')" /> -->
                        <PlusIcon
                          class="mx-auto h-4 w-4 text-slate-500 dark:text-jovieDark-400"
                          aria-hidden="true" />
                      </div>
                    </th>

                    <th
                      scope="col"
                      :class="[
                        { 'border-b-2': view.atTopOfPage },
                        'border-b-0',
                      ]"
                      class="sticky top-0 isolate z-30 table-cell w-full content-end items-center border-slate-300 bg-slate-100 py-1 text-right text-xs font-medium tracking-wider text-slate-600 backdrop-blur-2xl backdrop-filter dark:border-jovieDark-border dark:bg-jovieDark-700"></th>
                  </template>
                </draggable>
              </thead>
              <!--                {{ columns.map(c => c.name ) }}-->
              <!--                {{ visibleColumns }}-->
              <draggable
                class="list-group relative isolate z-0 h-full divide-y divide-slate-200 overflow-y-scroll bg-slate-50 dark:divide-slate-700 dark:bg-jovieDark-700"
                :list="filteredContacts"
                ghost-class="ghost-row"
                group="contacts"
                :sort="false"
                itemKey="id"
                tag="tbody"
                :multiple="true"
                @start.prevent="startDrag">
                <template #item="{ element, index }" :key="element.id">
                  <DataGridRow
                    :loading="loading"
                    :ref="`gridRow_${index}`"
                    :id="element.id"
                    :currentCell="currentCell"
                    :networks="networks"
                    :stages="stages"
                    :visibleColumns="visibleColumns"
                    :settings="settings"
                    :otherColumns="headers"
                    :filters="filters"
                    :currentContact="currentContact"
                    :selectedContacts="selectedContacts"
                    @updateSelectedContacts="selectedContacts = $event"
                    :contact="element"
                    :row="index"
                    :column="currentCell.column"
                    :userLists="userLists"
                    v-if="element"
                    @update:currentCell="$emit('updateContact', $event)"
                    @click="setCurrentContact($event, element, index)"
                    @mouseover="setCurrentContact($event, element, index)"
                    @openSidebar="
                      $emit('openSidebar', { contact: element, index: index })
                    "
                    @refresh="refresh(element)"
                    @updateContact="$emit('updateContact', $event)"
                    @updateListCount="$emit('updateListCount', $event)"
                    @archive-contacts="
                      toggleArchiveContacts(element.id, !element.archived)
                    "
                    @toggleContactsFromList="toggleContactsFromList"
                    @checkContactsEnrichable="
                      $emit('checkContactsEnrichable', $event)
                    " />
                </template>
                <!--   @contextmenu.prevent="openContextMenu(index, element)" -->
              </draggable>
            </table>
            <div
              v-if="contactRecords.length < 50 && contactRecords.length > 0"
              class="flex w-full cursor-pointer items-center justify-between border bg-slate-100 px-4 py-2 text-xs font-bold text-slate-400 hover:bg-slate-200 hover:text-slate-700 dark:border-jovieDark-border dark:bg-jovieDark-800 dark:text-jovieDark-200 hover:dark:bg-jovieDark-700 dark:hover:text-slate-200">
              <span class="flex" @click="$emit('addContact')">
                <PlusIcon class="mr-2 h-4 w-4" />
                Add new contact
              </span>
            </div>
            <div
              v-if="contactRecords.length < 1"
              class="mx-auto mt-4 h-full w-full max-w-xl items-center py-12">
              <div
                class="border-b border-gray-200 bg-white px-4 py-5 dark:bg-jovieDark-900 sm:px-6">
                <h3
                  class="text-base font-semibold leading-6 text-slate-900 dark:text-jovieDark-200">
                  There are no contacts to display
                </h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-jovieDark-200">
                  You can add some:
                </p>

                <div class="mt-5">
                  <div class="py-1">
                    <Menu>
                      <MenuItems class="space-y-2" static>
                        <div v-for="item in menuItems" :key="item.name">
                          <JovieMenuItem
                            class="rounded py-2"
                            :active="active"
                            :icon="item.icon"
                            @click="item.action"
                            :name="item.name" />
                        </div>
                      </MenuItems>
                    </Menu>
                  </div>
                </div>
              </div>
            </div>

            <Pagination
              class="z-50 w-full bg-blue-500"
              v-if="contactRecords.length > 50"
              :totalPages="contactsMeta.last_page"
              :perPage="contactsMeta.per_page"
              :currentPage="contactsMeta.current_page"
              :disabled="loading"
              @pagechanged="$emit('pageChanged', $event)" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <ModalPopup customContent :open="$store.state.crmPage.showCustomFieldsModal">
    <template v-slot:content>
      <CustomFieldsMenu
        @getCrmCreators="$emit('getCrmCreators')"
        :currentField="currentEditingField"
        @getHeaders="$emit('getHeaders')" />
    </template>
  </ModalPopup>

  <MergeContactsModal
    @close="closeMergeSuggestions"
    ref="mergeModal"
    @acceptMerge="acceptMerge"
    @rejectMerge="rejectMerge"
    :open="openMergeSuggestion"
    :suggestion="mergeSuggestion" />
</template>

<script>
import CustomFieldsMenu from './CustomFieldsMenu.vue';
import { Float } from '@headlessui-float/vue';
import JovieMenuItem from '../components/JovieMenuItem.vue';
import ModalPopup from './ModalPopup.vue';
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
  ChatBubbleOvalLeftEllipsisIcon,
  CheckIcon,
  ChevronDownIcon,
  ChevronUpIcon,
  CloudArrowDownIcon,
  CloudArrowUpIcon,
  CurrencyDollarIcon,
  EllipsisVerticalIcon,
  EnvelopeIcon,
  HeartIcon,
  LinkIcon,
  LockClosedIcon,
  SparklesIcon,
  ListBulletIcon,
  MagnifyingGlassIcon,
  NoSymbolIcon,
  PlusIcon,
  StarIcon,
  TrashIcon,
  UserGroupIcon,
  UserIcon,
  XMarkIcon,
} from '@heroicons/vue/24/solid';
import ImportService from './../services/api/import.service';
import ButtonGroup from './ButtonGroup.vue';
import DataGridColumnHeader from './DataGridColumnHeader.vue';
import DataGridCell from './DataGridCell.vue';
import DataGridCellTextInput from './DataGridCellTextInput.vue';
import DataGridHeaderContent from './DataGridHeaderContent.vue';
import DataGridRow from './DataGridRow.vue';
import DropdownMenuItem from './DropdownMenuItem.vue';
import GlassmorphismContainer from './GlassmorphismContainer.vue';
import InputLists from './InputLists.vue';
import JovieSpinner from './JovieSpinner.vue';
import JovieTooltip from './JovieTooltip.vue';
import KeyboardShortcut from './KeyboardShortcut.vue';
import Pagination from './Pagination.vue';
import SocialIcons from './SocialIcons.vue';
import draggable from 'vuedraggable';
import ContactService from '../services/api/contact.service';
import MergeContactsModal from './MergeContactsModal.vue';

export default {
  name: 'DataGrid',
  components: {
    MergeContactsModal,
    DropdownMenuItem,
    DataGridCell,
    DataGridRow,
    DataGridCellTextInput,
    DataGridHeaderContent,
    CustomFieldsMenu,
    ArchiveBoxIcon,
    KeyboardShortcut,
    MagnifyingGlassIcon,
    GlassmorphismContainer,
    ButtonGroup,
    CloudArrowUpIcon,
    Menu,
    InputLists,
    EnvelopeIcon,
    ArrowSmallLeftIcon,
    LockClosedIcon,
    Switch,
    MenuButton,
    Float,
    SparklesIcon,
    StarIcon,
    ArrowPathIcon,
    MenuItems,
    MenuItem,
    JovieMenuItem,
    EllipsisVerticalIcon,
    ModalPopup,
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
    DataGridColumnHeader,
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
    draggable,
  },
  emits: [
    'addContact',
    'updateContact',
    'crmCounts',
    'updateListCount',
    'pageChanged',
    'getCrmContacts',
    'setCurrentContact',
    'openSidebar',
    'getHeaders',
    'checkContactsEnrichable',
    'setOrder',
    'importCSV',
    'getUserLists',
  ],
  data() {
    return {
      confirmationPopup: {
        confirmationMethod: null,
        title: 'Hiiiii',
        open: false,
        primaryButtonText: 'custom',
        description: 'hellooo hello hello',
        loading: false,
      },
      currentCell: {
        row: 0,
        column: 0,
      },
      contactMenu: false,
      view: {
        atTopOfPage: true,
      },
      menuItems: [
        {
          name: 'Add new contact',
          icon: 'UserPlusIcon',
          action: () => this.$emit('addContact'),
        },
        {
          name: 'Import a social media profile',
          icon: 'SparklesIcon',
          action: () => this.$emit('addContactFromSocial'),
        },

        {
          name: 'Upload a CSV file',
          icon: 'CloudArrowUpIcon',
          action: () => this.importCSV(),
        },
        {
          name: 'Install the Jovie Chrome extension',
          icon: 'GlobeAltIcon',
          action: () => this.downloadChromeExtension(),
        },
      ],
      showCustomFieldsModal: false,
      currentEditingField: null,
      contactRecords: [],
      tableViewSearchQuery: '',
      searchQuery: '',
      stageSearchQuery: '',
      currentRow: null,
      showContextMenu: false,
      showContactStageMenu: [],
      date: null,
      selectedContacts: [],
      currentContact: [],
      editingSocialHandle: true,
      searchVisible: false,
      imageLoaded: true,
      open: false,
      subMenuOpen: true,

      settings: [
        {
          name: 'Show Follower Counts',
          key: 'show_follower_count',
          icon: 'UserGroupIcon',
          visible: true,
          type: 'toggle',
        },
      ],
      currentSort: 'asc',
      currentSortBy: '',
      headers: [],
      disableDrag: false,
      mergeSuggestion: [],
      suggestingMerge: false,
      openMergeSuggestion: false,
      contactIds: null,
      disableDragging: false,
    };
  },
  props: [
    'userLists',
    'filters',
    'networks',
    'stages',
    'contactsMeta',
    'loading',
    'taskLoading',
    'archived',
    'subheader',
    'header',
    'counts',
    'columns',
    'headersLoaded',
    'suggestMerge',
  ],
  expose: ['toggleContactsFromList', 'updateUserList'],
  watch: {
    settings: {
      deep: true,
      handler: function () {
        localStorage.setItem('settings', JSON.stringify(this.settings));
      },
    },
    suggestMerge() {
      this.suggestContactsMerge();
    },
    contacts: function (val) {
      this.contactRecords = val;
    },
    filters: function () {
      this.selectedContacts = [];
    },
    contactRecords: function () {
      this.selectedContacts = [];
    },
    columns: {
      immediate: true,
      handler: function (val) {
        this.headers = val.filter((column) => column.key != 'full_name');
      },
    },
    selectedContacts(val) {
      this.$emit('updateFiltersContact', val);
    },
    openMergeSuggestion(val) {
      console.log('csdfcsdc', val);
    },
    downloadChromeExtension() {
      //route push to chrome-extension
      this.$router.push({ name: 'Chrome Extension' });
    },
  },
  mounted() {
    this.suggestContactsMerge([], true);
    this.$mousetrap.bind('up', () => {
      //prevent the page from scrolling up
      event.preventDefault();
      this.previousContact();
      this.handleCellNavigation('ArrowUp');
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
    //arrow keys to navigate through the table
    this.$mousetrap.bind('right', () => {
      event.preventDefault();
      if (this.openMergeSuggestion) {
        this.$refs.mergeModal.acceptMerge();
      } else {
        this.handleCellNavigation('ArrowRight');
      }
    });
    this.$mousetrap.bind('left', () => {
      event.preventDefault();
      if (this.openMergeSuggestion) {
        this.$refs.mergeModal.rejectMerge();
      } else {
        this.handleCellNavigation('ArrowLeft');
      }
    });
    this.$mousetrap.bind('down', () => {
      event.preventDefault();
      this.nextContact();
      this.handleCellNavigation('ArrowDown');
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
      try {
        this.$refs[`gridRow_${this.currentCell.row}`].$refs[
          `gridCell_${this.currentCell.row}_${this.currentCell.column}`
        ][0].$refs[
          `active_cell_${this.currentCell.row}_${this.currentCell.column}`
        ].$refs.input.focus();
      } catch (e) {}
      if (this.currentContact.length) {
        this.$router.push({
          name: 'Contact Overview',
          params: { id: this.currentContact[0].crm_id },
        });
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Tab') {
        event.stopPropagation();
        event.preventDefault();

        try {
          this.$refs[`gridRow_${this.currentCell.row}`].$refs[
            `gridCell_${this.currentCell.row}_${this.currentCell.column}`
          ][0].$refs[
            `active_cell_${this.currentCell.row}_${this.currentCell.column}`
          ].$refs.input.blur();
        } catch (e) {}

        // Get the index of the last visible column
        // Get the index of the last visible column
        const lastVisibleColumnIndex = this.visibleColumns.length - 1;
        this.currentCell.column += 1;
        console.log(this.currentCell);
        if (this.currentCell.column > lastVisibleColumnIndex) {
          this.$refs.crmTable.scrollLeft = 0;
          setTimeout(() => {
            this.$nextTick(() => {
              this.currentCell.column = 0;
              if (this.currentCell.row < this.filteredContacts.length - 1) {
                this.currentCell.row += 1;
              } else {
                this.currentCell.row = 0;
              }
            });
          }, 100);
        }
        this.scrollToFocusCell();
      }
    });

    document.addEventListener('paste', (event) => {
      try {
        if (!this.isAnyInputFocused()) {
          this.$refs[`gridRow_${this.currentCell.row}`].$refs[
            `gridCell_${this.currentCell.row}_${this.currentCell.column}`
          ][0].$refs[
            `active_cell_${this.currentCell.row}_${this.currentCell.column}`
          ].$refs.input.focus();
        }
      } catch (e) {}
    });

    document.addEventListener('mousedown', (event) => {
      this.disableDrag = event.target.tagName.toLowerCase() === 'input';
    });

    // let columns = JSON.parse(localStorage.getItem('columns'));
    // if (columns) {
    //   this.columns = columns;
    // }
    let settings = JSON.parse(localStorage.getItem('settings'));
    if (settings) {
      this.settings = settings;
    }
    this.contactRecords = this.contactRecords.length
      ? this.contactRecords
      : this.contacts;

    for (let i = 0; i < this.columns.length; i++) {
      this.columns[i].visible = !this.columns[i].hide;
    }
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
        this.selectedContacts.length > 0 &&
        this.selectedContacts.length < this.contactRecords.length
      );
    },
    visibleFields() {
      return this.headers.filter((header) => !header.hide);
    },
    filteredContacts() {
      return this.contactRecords.filter((contact) => {
        return (
          (contact.name ?? '')
            .toLowerCase()
            .match(this.searchQuery.toLowerCase()) ||
          contact.emails.some((email) =>
            email.toString().toLowerCase().match(this.searchQuery.toLowerCase())
          )
        );
      });
    },
    visibleColumns() {
      return this.columns
        .filter((col) => !col.hide && col.key != 'full_name')
        .map((column) => {
          return column.key;
        });
    },
    fullNameColumn() {
      return this.columns.find((column) => column.key == 'full_name');
    },
    otherColumns() {
      this.headers = this.columns.filter((column) => column.key != 'full_name');
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
    getPreviousColumn(index) {
      return index > 0 ? this.headers[index - 1] : false;
    },
    updateColumnWidth(data) {
      data.self = this;
      data.listId = this.filters.list;
      this.$store.dispatch('updateColumnWidth', data);
    },
    reflectColumnWidth(data) {
      this.headers.find((h) => h.id == data.id).width = data.width;
    },
    acceptMerge(data) {
      let contactIds = [];
      if (this.contactIds && this.contactIds.length) {
        contactIds = this.contactIds;
      }
      let newContact = this.contactRecords.find((record) => {
        return record.id == data.suggestions[0];
      });
      let oldContact = this.contactRecords.find((record) => {
        return record.id == data.suggestions[1];
      });
      this.contactRecords.splice(this.contactRecords.indexOf(newContact), 1);
      this.contactRecords[this.contactRecords.indexOf(oldContact)] =
        data.newContact;
      this.suggestContactsMerge([]);
    },
    rejectMerge(id) {
      let contactIds = [];
      if (!this.contactIds || !this.contactIds.length) {
        contactIds = this.contactRecords.map((record) => {
          return record.id;
        });
        this.contactIds = contactIds;
      }
      this.contactIds.splice(this.contactIds.indexOf(id), 1);
      this.suggestContactsMerge(this.contactIds);
    },
    suggestContactsMerge(contactIds = [], checkSuggestionsOnly = false) {
      this.suggestingMerge = true;
      let data = {};
      data.contact_ids = contactIds;
      ContactService.suggestMerge(data)
        .then((response) => {
          response = response.data;
          if (response.status) {
            if (checkSuggestionsOnly && response.data) {
              this.$emit('suggestionExists', true);
              return;
            }
            this.mergeSuggestion = response.data;
            if (!this.mergeSuggestion) {
              this.$emit('suggestionExists', false);
              this.$notify({
                group: 'user',
                type: 'success',
                duration: 15000,
                title: 'Successful',
                text: response.message,
              });
              this.openMergeSuggestion = false;
            } else {
              this.openMergeSuggestion = true;
            }
            let modal = document.querySelector('#suggestion-modal');
            if (modal) {
              document
                .querySelector('#suggestion-modal')
                .scrollTo({ top: 0, behavior: 'smooth' });
            }
          } else {
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
        .finally((_) => {
          this.suggestingMerge = false;
        });
    },
    closeMergeSuggestions() {
      this.openMergeSuggestion = false;
      this.mergeSuggestions = [];
    },
    scrollToFocusCell() {
      this.$nextTick(() => {
        try {
          let targetCell =
            this.$refs[`gridRow_${this.currentCell.row}`].$refs[
              `gridCell_${this.currentCell.row}_${this.currentCell.column}`
            ][0].$refs.cell_area;
          var tableOffsetLeft = this.$refs.crmTable.offsetLeft;
          var targetCellOffsetLeft = targetCell.offsetLeft;
          var scrollTo = targetCellOffsetLeft - tableOffsetLeft;
          if (scrollTo < 0) {
            scrollTo = scrollTo + 300;
          } else {
            scrollTo = scrollTo - 300;
          }
          this.$refs.crmTable.scroll(scrollTo, 0);
        } catch (e) {}
      });
    },
    updateUserList(list) {
      let userList = this.userLists.find((l) => l.id == list.id);
      if (userList) {
        userList.name = list.name;
        userList.emoji = list.emoji;
        userList.pinned = list.pinned;
        if (this.filters.currentList) {
          this.filters.currentList.name = list.name;
          this.filters.currentList.emoji = list.emoji;
        }
      }
    },
    openCustomFieldModal() {
      this.$store.commit('setShowCustomFieldModal');
    },
    closeEditFieldPopup() {
      this.$store.state.crmPage.showCustomFieldsModal = false;
      this.currentEditingField = null;
    },
    editCustomFieldsModal(column) {
      this.$store.state.crmPage.showCustomFieldsModal = true;
      this.currentEditingField = column;
    },
    deleteField(column) {
      this.$store
        .dispatch('deleteField', {
          self: this,
          itemId: column.id,
        })
        .then(() => {
          this.$emit('getHeaders');
        });
    },
    toggleHeaderHide(column, index, forceHide = false) {
      this.$nextTick(() => {
        if (forceHide) {
          column.visible = !column.visible;
        }
        column = JSON.parse(JSON.stringify(column));
        this.headers.find((header) => header.id === column.id).hide =
          column.hide = forceHide ? forceHide : !column.visible;
        this.$store.dispatch('toggleHeaderHide', {
          self: this,
          listId: this.filters.list,
          itemId: column.id,
          hide: column.hide,
          custom: column.custom,
        });
      });
    },
    sortHeaders(e) {
      e.newIndex -= 3;
      e.oldIndex -= 3;
      this.$store.dispatch('sortHeaders', {
        self: this,
        newIndex: e.newIndex,
        oldIndex: e.oldIndex,
        custom: e.item.dataset.custom === 'true',
        listId: this.filters.list,
        itemId: e.item.id,
      });
    },
    startDrag(e) {
      if (this.selectedContacts.length) {
        let draggedContactIds = [];
        this.selectedContacts.forEach((contactId) => {
          draggedContactIds.push(contactId);
        });
        this.$store.state.currentlyDraggedContact = draggedContactIds;
      } else {
        this.$store.state.currentlyDraggedContact = e.item.id;
      }

      console.log(this.$store.state.currentlyDraggedContact);
    },
    handleCellNavigation(event) {
      // Get the index of the first visible column
      const firstVisibleColumnIndex = this.otherColumns.findIndex((column) =>
        this.visibleColumns.includes(column.key)
      );

      switch (event) {
        case 'ArrowRight':
          while (true) {
            if (this.currentCell.column === this.otherColumns.length - 1) {
              break;
            }
            this.currentCell.column += 1;
            this.scrollToFocusCell();
            if (
              this.visibleColumns.includes(
                this.otherColumns[this.currentCell.column].key
              )
            ) {
              break;
            }
          }
          break;
        case 'ArrowLeft':
          while (true) {
            if (this.currentCell.column <= firstVisibleColumnIndex) {
              break;
            }
            this.currentCell.column -= 1;
            this.scrollToFocusCell();
            if (
              this.visibleColumns.includes(
                this.otherColumns[this.currentCell.column].key
              )
            ) {
              break;
            }
          }
          break;
        case 'ArrowUp':
          if (this.currentCell.row > 0) {
            this.currentCell.row -= 1;
            this.scrollToFocusCell();
          }
          break;
        case 'ArrowDown':
          if (this.currentCell.row < this.filteredContacts.length - 1) {
            this.currentCell.row += 1;
            this.scrollToFocusCell();
          }
          break;
      }
    },
    /* handleCellNavigation(event) {
      switch (event) {
        case 'ArrowRight':
          while (true) {
            if (this.currentCell.column === this.otherColumns.length - 1) {
              break;
            }
            this.currentCell.column += 1;
            if (
              this.visibleColumns.includes(
                this.otherColumns[this.currentCell.column].key
              )
            ) {
              break;
            }
          }
          break;
        case 'ArrowLeft':
          while (true) {
            if (this.currentCell.column === 0) {
              break;
            }
            this.currentCell.column -= 1;
            if (
              this.visibleColumns.includes(
                this.otherColumns[this.currentCell.column].key
              )
            ) {
              break;
            }
          }
          break;
        case 'ArrowUp':
          if (this.currentCell.row > 0) {
            this.currentCell.row -= 1;
          }
          break;
        case 'ArrowDown':
          if (this.currentCell.row < this.filteredContacts.length - 1) {
            this.currentCell.row += 1;
          }
          break;
      }
    }, */
    handleUpdateCurrentCell(newCell) {
      this.currentCell = {
        row: newCell.row,
        column: newCell.column,
      };
    },
    hideContextMenu(contact) {
      contact.showContextMenu = false;
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
    openContextMenu(contact) {
      // Close the context menu for any other contacts that may have it open
      /*  filteredContacts.forEach((c) => {
          if (c !== contact && c.showContextMenu) {
            c.showContextMenu = false;
          }
        }); */
      // Open the context menu for the given contact
      contact.showContextMenu = true;
    },
    sortData({ sortBy, sortOrder }) {
      this.columns.map((column) => {
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

      this.$emit('pageChanged', { page: this.contactsMeta.current_page });

      // if (this.contactRecords.length < 50) {
      //   this.$emit('pageChanged', { page: this.contactsMeta.current_page });
      // } else {
      //   this.contactRecords = this.contactRecords.sort((a, b) => {
      //     let modifier = 1;
      //     if (sortOrder === 'desc') {
      //       modifier = -1;
      //     }
      //     if (['first_name', 'last_name', 'email', 'platform_title', 'platform_employer'].includes(sortBy)) {
      //       let sortByC = sortBy == 'full_name' ? 'name' : sortOrder;
      //       return a[sortByC] == null ? -1 : (a[sortByC].localeCompare(b[sortByC]) * modifier);
      //     } else {
      //       if (a[sortBy] < b[sortBy]) {
      //         return -1 * modifier;
      //       }
      //       if (a[sortBy] > b[sortBy]) {
      //         return modifier;
      //       }
      //     }
      //     return 0;
      //   });
      // }
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
      this.selectedContacts = [];
    },
    openSidebarAndSetContact() {
      //if there is currently no contact selected, select the first one
      if (!this.currentContact) {
        this.currentContact = this.contactRecords[0];
        this.$store.state.ContactSidebarOpen = true;
      }
      //esle just open the sidebar
      else {
        this.$store.state.ContactSidebarOpen = true;
      }
    },
    exportCrmCreators() {
      //export filteredContacts to a csv file
      //write a function to export all contacts in the current table while accounting for filters and lists
    },

    createCalendarEvent(contact) {
      window.open(
        `https://calendar.google.com/calendar/r/eventedit?text=${
          this.currentUser.first_name
        } ${this.currentUser.last_name} <> ${contact.name}&details=Created by ${
          this.currentUser.first_name
        } ${
          this.currentUser.last_name
        } on ${new Date().toLocaleDateString()}&location=&trp=false&sprop=&sprop=name:&dates=20200501T000000Z/20200501T000000Z&add=${
          contact.emails[0] || contact.emails[0] || ''
        }&notes='Created via Jovie: https://jov.ie`
      );
    },
    emailCreator(email) {
      //go to the url mailto:contact.emails[0]
      //if email is not null
      if (email) {
        window.open('mailto:' + email);
        //else log no email found
      } else {
        this.$notify({
          title: 'No email found',
          message: 'This contact does not have an email address',
          type: 'warning',
          group: 'user',
        });
      }
    },
    sendTwitterDM(id) {
      //go to the url https://twitter.com/messages/compose?recipient_id=contact.twitter_id
      //if twitter_id is not null
      if (id) {
        //add text tot he message that says "Hey contact.name || contact.name "
        window.open(
          'https://twitter.com/messages/compose?recipient_id=' +
            id +
            '&text=Hey ' +
            this.currentContact.name +
            ','
        );
        //else log no twitter id found
      } else {
        this.$notify({
          title: 'No twitter id found',
          message: 'This contact does not have a twitter id',
          type: 'warning',
          group: 'user',
        });
      }
    },
    callCreator(phone) {
      //go to the url tel:contact.phone
      //if phone is not null
      if (phone) {
        window.open('tel:' + phone);
        //else log no phone found
      } else {
        this.$notify({
          title: 'No phone number found',
          message: 'This contact does not have a phone number',
          type: 'warning',
          group: 'user',
        });
      }
    },
    whatsappCreator(phone) {
      //go to the url tel:contact.phone
      //if phone is not null
      if (phone) {
        //open whatsapp://send?text=Hello World!&phone=+phone
        window.open('whatsapp://send?text=Hey!&phone=+' + phone);
        //else log no phone found
      } else {
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
        this.$notify({
          title: 'No instagram username found',
          message: 'This contact does not have an instagram username',
          type: 'warning',
          group: 'user',
        });
      }
    },
    textCreator(phone) {
      //go to the url sms:contact.phone
      //if phone is not null
      if (phone) {
        window.open('sms:' + phone);
        //else log no phone found
      } else {
        this.$notify({
          title: 'No phone number found',
          message: 'This contact does not have a phone number',
          type: 'warning',
          group: 'user',
        });
      }
    },
    generateVCF(_contact) {
      let vCard = 'BEGIN:VCARD\n';
      vCard += 'VERSION:3.0\n';
      //if contact has a first name
      //if the contact has an instagram handler then set instagram to the instagram handler
      //else if the contact has a meta.instagram_handler then set instagram to the meta.instagram_handler
      //else set instagram to null

      /*       //if contact has an email
       if (contact.emails[0]) {
          vCard += 'EMAIL;TYPE=PREF,INTERNET:' + contact.emails[0] + '\n';
        } else if
        {
          vCard += 'EMAIL;TYPE=PREF,INTERNET:' + contact.emails + '\n';
        } else {
        };
        //set employer
        if (contact.employer) {
          vCard += 'ORG:' + contact.employer + '\n';
        } else {
        };
        //set title
        if (contact.title) {
          vCard += 'TITLE:' + contact.title + '\n';
        } else {
        };
        if (Contact.location) {
          vCard += 'ADR;TYPE=WORK:;;' + Contact.location + '\n';
        }
        //if contact.instagram_handler set instagram else if contact.instagram set instagram else log no instagram found
        if (contact.instagram_handler) {
          vCard += 'URL;TYPE=WORK:' + contact.instagram_handler + '\n';
        } else if
        {
          vCard += 'URL;TYPE=WORK:' + contact.instagram + '\n';
        } else {
        };
        //do the twitter and twitch and youtube and tiktok and linkedin
        if (contact.twitter_handler) {
          vCard += 'URL;TYPE=WORK:' + contact.twitter_handler + '\n';
        } else if
        {
          vCard += 'URL;TYPE=WORK:' + contact.twitter + '\n';
        } else {
        };
        if (contact.twitch_handler) {
          vCard += 'URL;TYPE=WORK:' + contact.twitch_handler + '\n';
        } else if
        {
          vCard += 'URL;TYPE=WORK:' + contact.twitch + '\n';
        } else {
        };
        if (contact.youtube_handler) {
          vCard += 'URL;TYPE=WORK:' + contact.youtube_handler + '\n';
        } else if
        {
          vCard += 'URL;TYPE=WORK:' + contact.youtube + '\n';
        } else {
        };
        if (contact.tiktok_handler) {
          vCard += 'URL;TYPE=WORK:' + contact.tiktok_handler + '\n';
        } else if
        {
          vCard += 'URL;TYPE=WORK:' + contact.tiktok + '\n';
        } else {
        };
        if (contact.linkedin_handler) {
          vCard += 'URL;TYPE=WORK:' + contact.linkedin_handler + '\n';
        } else if {
          vCard += 'URL;TYPE=WORK:' + contact.linkedin + '\n';
        }; */

      vCard += 'NOTE:Saved from Jovie\n';

      vCard += 'END:VCARD';
      return vCard;
    },
    downloadVCF(contact) {
      let vCard = this.generateVCF(contact);
      let blob = new Blob([vCard], { type: 'text/vcard' });
      let url = URL.createObjectURL(blob);
      let link = document.createElement('a');
      link.setAttribute('href', url);
      link.setAttribute('download', this.contact.name + '.vcf');
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
    },
    toggleArchiveContacts(ids, archived) {
      this.$store
        .dispatch('toggleArchiveContacts', {
          contact_ids: ids,
          archived: archived,
        })
        .then((response) => {
          response = response.data;
          if (response.status) {
            let contactIds = Array.isArray(ids) ? ids : [ids];
            this.contactRecords = this.contactRecords.filter(
              (contact) => !contactIds.includes(contact.id)
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
          console.log('error');
          console.log(error);
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
        .finally((_) => {});
    },
    addContactsToList(id) {
      this.toggleContactsFromList(this.selectedContacts, id, false);
    },
    toggleContactsFromList(ids, list, remove) {
      console.log(ids, list, remove);
      this.$store
        .dispatch('toggleContactsFromList', {
          contact_ids: ids,
          list: list,
          remove: remove,
        })
        .then((response) => {
          response = response.data;
          if (response.status) {
            let contactIds = Array.isArray(ids) ? ids : [ids];
            if (remove && this.filters.list == list) {
              this.contactRecords = this.contactRecords.filter(
                (contact) => !contactIds.includes(contact.id)
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
            this.$emit('getUserLists');
            this.$emit('crmCounts');
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
          console.log('error');
          console.log(error);
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
        .finally((_) => {});
      this.resetChecked();
    },
    toggleContactSidebar() {
      this.$store.state.ContactSidebarOpen =
        !this.$store.state.ContactSidebarOpen;
    },

    setCurrentContact(_e, contact, index) {
      this.currentContact = contact;
      this.$emit('setCurrentContact', contact);
      this.currentCell.row = index;
    },
    nextContact() {
      const index = this.contactRecords.indexOf(this.currentContact);
      if (index < this.contactRecords.length - 1) {
        this.setCurrentContact(
          'setCurrentCreator',
          this.contactRecords[index + 1],
          index
        );
      }
    },
    previousContact() {
      const index = this.contactRecords.indexOf(this.currentContact);
      if (index > 0) {
        this.setCurrentContact(
          'setCurrentCreator',
          this.contactRecords[index - 1],
          index
        );
      }
    },
    importCSV() {
      //emit the importCSV event to the parent component
      //push router to /import
      this.$router.push('/import');
    },
    refresh(contact) {
      let imports = {};
      this.networks.forEach((network) => {
        imports[network] = contact[`${network}_handler`];
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
          console.log('error');
          console.log(error);
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally((_) => {
          this.adding = false;
        });
    },
    isAnyInputFocused() {
      let check = document.activeElement.tagName === 'INPUT';
      return check;
    },
  },
  directives: {
    // enables v-focus in template
    focus,
  },
};
</script>
