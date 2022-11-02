<template>
  <div class="h-full w-full flex-col overflow-y-scroll">
    <div class="flex h-full w-full flex-col">
      <div class="h-full pb-10">
        <div
          class="flex w-full items-center justify-between border-b border-neutral-200 bg-white px-2 py-2">
          <div>
            <H1
              v-if="!filters.type == 'list'"
              class="text-sm font-bold capitalize text-neutral-600">
              {{ filters.type + 'Contacts' }}
            </H1>
            <H1 v-else class="text-sm font-bold capitalize text-neutral-600">
              {{ filters.list }}
            </H1>
            <p
              v-if="header.includes('all')"
              class="text-2xs font-medium text-neutral-400">
              {{ counts.total }} Total
            </p>
          </div>
          <div class="flex h-6 w-80 content-end items-center">
            <div
              class="group flex h-full w-full cursor-pointer content-end items-center justify-end gap-2 py-2 text-right transition-all duration-150 ease-out">
              <!-- <div class="group">
                trigger
                <span
                  data-tooltip="test"
                  class="backfdrop-filter absolute z-50 hidden w-auto flex-col items-center justify-between rounded-md border border-neutral-200 bg-neutral-800 px-2 py-1 text-xs text-neutral-50 shadow-lg backdrop-blur-2xl backdrop-saturate-150 group-hover:flex"
                  >test content</span
                >
              </div> -->

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
                    class="flex items-center rounded-md border border-neutral-200">
                    <div
                      class="content-right relative flex flex-grow items-center focus-within:z-10">
                      <div
                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <MagnifyingGlassIcon
                          class="h-4 w-4 text-gray-400"
                          aria-hidden="true" />
                      </div>
                      <input
                        placeholder="Press /  to search"
                        ref="searchInput"
                        v-model="searchQuery"
                        class="block w-full rounded-md border-gray-300 py-1 pl-10 ring-0 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-sm" />

                      <div
                        @click="toggleSearchVisible()"
                        class="group absolute inset-y-0 right-0 flex items-center pr-3">
                        <XMarkIcon
                          class="h-4 w-4 cursor-pointer rounded-md text-gray-400 group-hover:bg-gray-100 group-hover:text-gray-600"
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
                  placement="bottom-end"
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
              <!--  <div
                class="group flex cursor-pointer items-center rounded-md px-2 py-2 hover:bg-gray-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30"
                v-else>
                <MagnifyingGlassIcon
                  @click="toggleSearchVisible()"
                  class="h-5 w-5 text-gray-400 group-hover:text-neutral-600" />
              </div> -->
            </div>
            <div class="flex items-center">
              <div class="group h-full cursor-pointer items-center">
                <Popover class="items-center">
                  <Float portal class="pr-2" :offset="4" placement="bottom-end">
                    <PopoverButton class="inline-flex items-center">
                      <!--  <AdjustmentsHorizontalIcon
                        class="h-5 w-5 font-bold text-gray-400 group-hover:text-neutral-600"
                        aria-hidden="true" /> -->
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
                    </PopoverButton>
                    <transition
                      enter-active-class="transition duration-100 ease-out"
                      enter-from-class="transform scale-95 opacity-0"
                      enter-to-class="transform scale-100 opacity-100"
                      leave-active-class="transition duration-75 ease-in"
                      leave-from-class="transform scale-100 opacity-100"
                      leave-to-class="transform scale-95 opacity-0">
                      <PopoverPanel
                        class="w-60 flex-col rounded-md border-2 border-neutral-200 bg-white py-1 pl-2 pr-1 shadow-xl">
                        <div as="div">
                          <div
                            class="flex items-center justify-between border-b border-neutral-200 py-1">
                            <div
                              class="text-xs font-bold text-neutral-500 line-clamp-1">
                              Display Columns
                            </div>
                          </div>
                        </div>
                        <div as="div" v-for="(column, index) in otherColumns">
                          <SwitchGroup>
                            <SwitchLabel
                              class="flex items-center hover:bg-neutral-100 hover:text-white">
                              <button
                                class="group flex w-full items-center justify-between rounded-md px-2 py-1 text-xs font-medium text-gray-500">
                                <div class="flex items-center">
                                  <component
                                    :is="column.icon"
                                    :active="active"
                                    class="mr-2 h-3 w-3 text-neutral-400"
                                    aria-hidden="true" />
                                  <span class="line-clamp-1">{{
                                    column.name
                                  }}</span>
                                </div>

                                <Switch
                                  name="columns-visible"
                                  v-model="column.visible"
                                  as="template"
                                  v-slot="{ checked }">
                                  <button
                                    :class="
                                      checked ? 'bg-indigo-600' : 'bg-gray-200'
                                    "
                                    class="relative inline-flex h-4 w-6 items-center rounded-full">
                                    <span class="sr-only"
                                      >Show/hide column</span
                                    >
                                    <span
                                      :class="
                                        checked
                                          ? 'translate-x-3'
                                          : 'translate-x-0'
                                      "
                                      class="inline-block h-3 w-3 transform rounded-full bg-white transition" />
                                  </button>
                                </Switch>
                              </button>
                            </SwitchLabel>
                          </SwitchGroup>
                        </div>
                        <div class="text-medium border-t border-neutral-200">
                          <SwitchGroup v-for="setting in settings">
                            <SwitchLabel
                              class="flex items-center hover:bg-neutral-100 hover:text-white">
                              <button
                                class="group flex w-full items-center justify-between rounded-md px-2 py-1 text-xs font-medium text-gray-500">
                                <div class="flex items-center">
                                  <component
                                    :is="setting.icon"
                                    class="mr-2 h-3 w-3 text-neutral-400"
                                    aria-hidden="true" />
                                  <span class="line-clamp-1">{{
                                    setting.name
                                  }}</span>
                                </div>

                                <Switch
                                  v-if="setting.type === 'toggle'"
                                  name="columns-visible"
                                  v-model="setting.isVisable"
                                  as="template"
                                  v-slot="{ checked }">
                                  <button
                                    :class="
                                      checked ? 'bg-indigo-600' : 'bg-gray-200'
                                    "
                                    class="relative inline-flex h-4 w-6 items-center rounded-full">
                                    <span
                                      :class="
                                        checked
                                          ? 'translate-x-3'
                                          : 'translate-x-0'
                                      "
                                      class="inline-block h-3 w-3 transform rounded-full bg-white transition" />
                                  </button>
                                </Switch>
                              </button>
                            </SwitchLabel>
                          </SwitchGroup>
                        </div>
                      </PopoverPanel>
                    </transition>
                  </Float>
                </Popover>
              </div>
              <!-- <div v-if="currentContact">
                <button
                  v-if="!$store.state.ContactSidebarOpen"
                  class="group inline-flex items-center rounded-md px-2 py-2 text-2xs font-medium text-gray-700 hover:bg-gray-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">
                  <ChevronRightIcon
                    @click="openSidebarAndSetContact()"
                    class="h-5 w-5 font-bold text-gray-400 transition-all group-hover:text-neutral-600" />
                </button>
              </div> -->
            </div>
          </div>
        </div>
        <div
          class="inline-block h-full w-full overflow-x-auto align-middle">
          <div
            class="flex w-full h-full flex-col justify-between overflow-auto shadow-sm ring-1 ring-black ring-opacity-5">
            <table class="block overflow-x-auto w-full divide-y divide-gray-200 divide-y divide-gray-200">
              <thead class="relative isolate z-20 items-center bg-neutral-100">
                <tr class="h-8 sticky items-center">
                  <th
                    scope="col"
                    class="sticky left-0 w-20 top-0 z-50 w-6 items-center border-b border-gray-300 bg-gray-100 text-center text-xs font-light tracking-wider text-gray-600 backdrop-blur backdrop-filter">
                    <div class="mx-auto items-center text-center">
                      <input
                        type="checkbox"
                        class="h-3 w-3 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500"
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
                    class="sticky left-[26.5px] top-0 z-50 w-8 items-center border-b border-gray-300 bg-gray-100 text-center text-xs font-thin tracking-wider text-gray-600 backdrop-blur backdrop-filter">
                    <span class="sr-only">Favorite</span>
                  </th>
                  <th
                    scope="col"
                    class="sticky left-[55px] w-20 top-0 isolate z-50 resize-x items-center border-b border-gray-300 bg-gray-100 text-left text-xs font-medium tracking-wider text-gray-600 backdrop-blur backdrop-filter">
                    <div
                      v-if="selectedCreators.length > 0"
                      class="flex items-center space-x-3 bg-gray-100">
                      <Menu>
                        <Float portal :offset="2" placement="bottom-start">
                          <MenuButton
                            class="py-.5 inline-flex items-center rounded border border-gray-300 bg-white px-2 text-2xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">
                            <span class="line-clamp-1">Bulk Actions</span>
                            <ChevronDownIcon
                              class="text-vue-gray-400 hover:text-vue-gray-500 ml-2 -mr-1 h-5 w-5"
                              aria-hidden="true" />
                          </MenuButton>
                          <transition
                            enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0"
                            enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-in"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0">
                            <MenuItems
                              class="max-h-80 w-60 flex-col overflow-y-scroll rounded-md border border-neutral-200 bg-white shadow-xl">
                              <MenuItem
                                v-if="filters.list"
                                v-slot="{ active }"
                                @click="
                                  toggleCreatorsFromList(
                                    selectedCreators,
                                    filters.list,
                                    true
                                  )
                                ">
                                <button
                                  :class="[
                                    active
                                      ? 'bg-gray-200 text-gray-600'
                                      : 'text-gray-400',
                                    'group flex w-full items-center rounded-md px-2 py-1 text-xs font-bold',
                                  ]">
                                  <TrashIcon class="mr-2 inline h-4 w-4" />
                                  Remove from list
                                </button>
                              </MenuItem>

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
                                      ? 'bg-gray-200 text-gray-600'
                                      : 'text-gray-400',
                                    'group flex w-full items-center rounded-md px-2 py-1 text-xs font-bold',
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
                            </MenuItems>
                          </transition>
                        </Float>
                      </Menu>
                      <Menu>
                        <Float portal :offset="2" placement="bottom-start">
                          <MenuButton
                            class="py-.5 inline-flex items-center rounded border border-gray-300 bg-white px-2 text-2xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">
                            <span class="line-clamp-1">Add to list </span>
                            <ChevronDownIcon
                              class="text-vue-gray-400 hover:text-vue-gray-500 ml-2 -mr-1 h-5 w-5"
                              aria-hidden="true" />
                          </MenuButton>
                          <transition
                            enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0"
                            enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-in"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0">
                            <MenuItems
                              class="max-h-80 w-60 flex-col overflow-y-scroll rounded-md border border-neutral-200 bg-white shadow-xl">
                              <MenuItem
                                v-slot="{ active }"
                                v-for="list in userLists"
                                @click="
                                  toggleCreatorsFromList(
                                    selectedCreators,
                                    list.id,
                                    false
                                  )
                                ">
                                <button
                                  :class="[
                                    active
                                      ? 'bg-gray-200 text-gray-600'
                                      : 'text-gray-400',
                                    'group flex w-full items-center px-4 py-2 text-left text-xs font-bold line-clamp-1 first:rounded-t-md',
                                  ]">
                                  <span class="px-1">{{
                                    list.emoji ? list.emoji : '📄'
                                  }}</span>
                                  {{ list.name }}
                                </button>
                              </MenuItem>
                              <MenuItem v-slot="{ active }" class="mx-auto">
                                <button
                                  :class="[
                                    active
                                      ? 'bg-gray-200 text-gray-600'
                                      : 'text-gray-400',
                                    'group inline w-full items-center rounded-b-md border border-t border-neutral-200 px-2 py-2 text-left text-xs font-bold ',
                                  ]">
                                  <div
                                    class="mx-auto flex content-center items-center text-center">
                                    <span class="text-center"
                                      >Create New List</span
                                    >
                                    <PlusIcon
                                      :active="active"
                                      class="mr-2 h-3 w-3 text-neutral-400"
                                      aria-hidden="true" />
                                  </div>
                                </button>
                              </MenuItem>
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
                      class="w-48 sticky top-0 z-30 table-cell items-center border-x border-b border-gray-300 border-x-neutral-300 bg-gray-100 text-left text-xs font-medium tracking-wider text-gray-600 backdrop-blur backdrop-filter">
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
                    class="sticky top-0 isolate z-30 table-cell content-end items-center border-x border-gray-300 border-x-neutral-300 bg-gray-100 py-1 text-right text-xs font-medium tracking-wider text-gray-600 backdrop-blur-2xl backdrop-filter"></th>
                </tr>
              </thead>
              <tbody
                class="relative isolate z-0 h-full w-full divide-y divide-gray-200 overflow-y-scroll">
                <template class="w-full" v-if="loading">
                  <tr class="w-full">
                    <td class="w-full" colspan="11">
                      <div
                        class="flex min-h-screen w-full items-center justify-center bg-gray-50 pb-80">
                        <JovieSpinner />
                        <span class="visually-hidden sr-only">
                          Loading...
                        </span>
                      </div>
                    </td>
                  </tr>
                </template>
                <template
                  v-else
                  v-for="(creator, index) in filteredCreators"
                  :key="creator">
                  <tr
                    v-if="creator"
                    @click="setCurrentContact($event, creator)"
                    class="border-1 group w-full flex-row overflow-y-visible border border-neutral-200 focus-visible:ring-indigo-700"
                    :class="[
                      {
                        'bg-neutral-100 hover:bg-neutral-100':
                          currentContact.id == creator.id,
                      },
                      'bg-white hover:bg-neutral-50',
                    ]">
                    <td
                      class="w-6 sticky left-0 bg-white overflow-auto whitespace-nowrap py-0.5 text-center text-xs font-bold text-gray-300 group-hover:text-neutral-500">
                      <div class="group mx-auto w-6">
                        <span
                          class="group-hover:block"
                          :class="[
                            {
                              hidden: !selectedCreators.includes(creator.id),
                            },
                            'block',
                          ]">
                          <form>
                            <input
                              type="checkbox"
                              name="selectCreatorCheckbox"
                              :value="creator.id"
                              class="h-3 w-3 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500 sm:left-6"
                              v-model="selectedCreators" />
                          </form>
                        </span>
                        <span
                          class="text-xs group-hover:hidden"
                          :class="[
                            { hidden: selectedCreators.includes(creator.id) },
                            'block',
                          ]">
                          {{ index + 1 }}
                        </span>
                      </div>
                      <!--                                                                    favourite-->
                    </td>
                    <td
                      class="w-4 sticky left-[26.5px] bg-white overflow-auto whitespace-nowrap px-2 py-1 text-center text-xs font-bold text-gray-300 group-hover:text-neutral-500">
                      <div
                        class="hidden cursor-pointer items-center lg:block"
                        @click="
                          $emit('updateCreator', {
                            id: creator.id,
                            index: index,
                            key: `crm_record_by_user.favourite`,
                            value: !creator.crm_record_by_user.favourite,
                          })
                        ">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          :class="{
                            'fill-red-500 text-red-500':
                              creator.crm_record_by_user.favourite,
                          }"
                          class="-mt-.5 h-3 w-3 hover:fill-red-500 hover:text-red-500"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                      </div>
                    </td>
                    <td
                      v-on:dblclick="cellActive"
                      class="w-60 sticky left-[55px] bg-white cursor-pointer whitespace-nowrap border pl-2 pr-0.5">
                      <div class="flex items-center justify-between">
                        <div class="mr-2 h-8 w-8 flex-shrink-0">
                          <div class="rounded-full bg-neutral-400 p-0.5">
                            <div class="rounded-full bg-white p-0">
                              <img
                                v-if="imageLoaded"
                                class="rounded-full object-cover object-center"
                                :src="creator.profile_pic_url"
                                @error="imageLoadingError()"
                                alt="Profile Image" />
                              <!--WIP Fixing image loading errors-->
                              <img
                                v-else
                                class="rounded-full object-cover object-center"
                                :src="asset('img/noimage.webp')"
                                alt="Profile Image" />
                            </div>
                          </div>
                        </div>

                        <div
                          v-if="cellActive"
                          class="text-sm text-gray-900 line-clamp-1">
                          <input
                            v-model="creator.meta.name"
                            @blur="$emit('updateCrmMeta', creator)"
                            autocomplete="off"
                            type="creator-name"
                            name="creator-name"
                            id="creator-name"
                            class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                            placeholder="Name"
                            aria-describedby="name-description" />
                        </div>
                        <div v-else class="text-sm text-gray-900 line-clamp-1">
                          {{ creator.meta.name }}
                        </div>
                        <div
                          @click="$emit('openSidebar', creator)"
                          class="mx-auto items-center rounded-full bg-neutral-200/0 p-1 text-neutral-400 hover:bg-neutral-200 active:border">
                          <ArrowsPointingOutIcon
                            class="hidden h-3 w-3 group-hover:block" />
                        </div>
                      </div>
                    </td>
                    <td
                      v-if="visibleColumns.includes('first_name')"
                      class="border-1 table-cell w-28 whitespace-nowrap border">
                      <div class="text-sm text-gray-900 line-clamp-1">
                        <input
                          v-model="creator.meta.first_name"
                          @blur="$emit('updateCrmMeta', creator)"
                          autocomplete="off"
                          type="creator-firstname"
                          name="creator-firstname"
                          id="creator-firname"
                          class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                          placeholder="First"
                          aria-describedby="email-description" />
                      </div>
                    </td>
                    <td
                      v-if="visibleColumns.includes('last_name')"
                      class="border-1 table-cell w-28 whitespace-nowrap border">
                      <div class="text-xs text-gray-900 line-clamp-1">
                        <input
                          v-model="creator.meta.last_name"
                          @blur="$emit('updateCrmMeta', creator)"
                          autocomplete="off"
                          type="creator-lastname"
                          name="creator-lastname"
                          id="creator-lastname"
                          class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                          placeholder="Last"
                          aria-describedby="email-description" />
                      </div>
                    </td>
                    <td
                      v-if="visibleColumns.includes('title')"
                      class="border-1 table-cell w-40 resize-x whitespace-nowrap border">
                      <div class="text-xs text-gray-900 line-clamp-1">
                        <input
                          v-model="creator.meta.platform_title"
                          @blur="$emit('updateCrmMeta', creator)"
                          autocomplete="off"
                          type="platform-title"
                          name="platform-title"
                          id="platform-title"
                          class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                          placeholder="Title"
                          aria-describedby="title" />
                      </div>
                    </td>
                    <td
                      v-if="visibleColumns.includes('employer')"
                      class="border-1 table-cell w-40 whitespace-nowrap border">
                      <div class="text-xs text-gray-900 line-clamp-1">
                        <input
                          v-model="creator.meta.platform_employer"
                          @blur="$emit('updateCrmMeta', creator)"
                          autocomplete="off"
                          type="platform-employer"
                          name="platform-employer"
                          id="platform-employer"
                          class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                          placeholder="Company"
                          aria-describedby="Company" />
                      </div>
                    </td>

                    <td
                      v-if="visibleColumns.includes('emails')"
                      class="border-1 table-cell w-40 whitespace-nowrap border focus:border-indigo-500">
                      <div class="text-xs text-gray-700 line-clamp-1">
                        <input
                          v-model="creator.meta.emails"
                          @blur="$emit('updateCrmMeta', creator)"
                          autocomplete="off"
                          type="creator-email"
                          name="creator-email"
                          id="creator-email"
                          class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                          placeholder="someone@gmail.com"
                          aria-describedby="email-description" />
                      </div>
                    </td>
                    <td
                      v-if="visibleColumns.includes('networks')"
                      class="border-1 w-18 items-center whitespace-nowrap border">
                      <a
                        v-for="network in networks"
                        :href="creator[`${network}_handler`]"
                        target="_blank"
                        class="inline-flex items-center justify-between rounded-full px-1 py-1 text-center text-xs font-bold text-gray-800">
                        <div class="mx-auto flex-col items-center">
                          <div
                            v-if="creator[`${network}_handler`]"
                            class="mx-auto items-center">
                            <SocialIcons
                              class="mx-auto"
                              height="14px"
                              setting.isVisable
                              :link="creator[`${network}_handler`]"
                              :icon="network" />
                          </div>
                          <div class="mx-auto items-center" v-else>
                            <div class="">
                              <SocialIcons
                                height="14px"
                                :link="creator[`${network}_handler`]"
                                :icon="network" />
                            </div>
                          </div>
                          <!--  <div class="">
                            <span
                              v-if="creator[`${network}_handler`]"
                              class="mx-auto items-center text-2xs font-bold text-neutral-400">
                              {{
                                formatCount(creator[`${network}_followers`])
                              }}</span
                            >
                          </div> -->
                        </div>
                      </a>
                    </td>
                    <td
                      v-if="visibleColumns.includes('crm_record_by_user.offer')"
                      class="border-1 table-cell w-12 whitespace-nowrap border">
                      <span
                        class="text-nuetral-800 inline-flex items-center rounded-full px-2 text-center text-xs font-bold leading-5">
                        $
                        <input
                          v-model="creator.crm_record_by_user.offer"
                          @blur="
                            $emit('updateCreator', {
                              id: creator.id,
                              index: index,
                              key: `crm_record_by_user.offer`,
                              value: creator.crm_record_by_user.offer,
                            })
                          "
                          autocomplete="off"
                          type="number"
                          name="creator-offer"
                          id="creator-offer"
                          class="block w-full border-0 bg-white/0 px-2 py-0.5 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                          :placeholder="
                            creator.crm_record_by_user.suggested_offer
                          "
                          aria-describedby="email-description" />
                      </span>
                    </td>

                    <td
                      v-if="visibleColumns.includes('crm_record_by_user.stage')"
                      class="border-1 relative isolate z-10 table-cell w-24 items-center whitespace-nowrap border">
                      <Popover
                        as="div"
                        class="relative z-10 inline-block w-full items-center text-left">
                        <Float
                          portal
                          :offset="0"
                          shift
                          placement="bottom-start">
                          <PopoverButton
                            class="flex w-full justify-between px-2">
                            <div
                              class="group my-0 -ml-1 inline-flex items-center justify-between rounded-full px-2 py-0.5 text-2xs font-medium leading-5 line-clamp-1"
                              :class="[
                                {
                                  'bg-indigo-50 text-indigo-600':
                                    creator.crm_record_by_user.stage_name ===
                                    'Lead',
                                },
                                {
                                  'bg-sky-50 text-sky-600':
                                    creator.crm_record_by_user.stage_name ===
                                    'Interested',
                                },
                                {
                                  'bg-pink-50 text-pink-600':
                                    creator.crm_record_by_user.stage_name ===
                                    'Negotiating',
                                },
                                {
                                  'bg-fuchsia-50 text-fuchsia-600':
                                    creator.crm_record_by_user.stage_name ===
                                    'In Progress',
                                },
                                {
                                  'bg-red-50 text-red-600':
                                    creator.crm_record_by_user.stage_name ===
                                    'Complete',
                                },
                              ]">
                              {{ creator.crm_record_by_user.stage_name }}
                            </div>
                            <div class="items-center">
                              <ChevronDownIcon
                                class="mt-1 h-4 w-4 text-neutral-600" />
                            </div>
                          </PopoverButton>
                          <transition
                            enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0"
                            enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-in"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0">
                            <PopoverPanel
                              class="z-30 mt-2 w-40 origin-top-right divide-y divide-gray-100 rounded-lg border border-neutral-200 bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus-visible:outline-none">
                              <div class="">
                                <div class="">
                                  <button
                                    v-for="(stage, key) in stages"
                                    @click="
                                      $emit('updateCreator', {
                                        id: creator.id,
                                        index: index,
                                        key: `crm_record_by_user.stage`,
                                        value: key,
                                      })
                                    "
                                    class="group flex w-full items-center bg-white px-2 py-1 text-xs text-neutral-600 first:rounded-t-lg first:pt-2 last:rounded-b-lg last:pb-2 hover:bg-neutral-100 hover:text-neutral-600">
                                    <div
                                      class="mr-2 text-xs font-bold opacity-50">
                                      {{ key + 1 }}
                                    </div>
                                    <div class="text-xs font-medium">
                                      {{ stage }}
                                    </div>
                                  </button>
                                </div>
                              </div>
                            </PopoverPanel>
                          </transition>
                        </Float>
                      </Popover>
                    </td>
                    <td
                      v-if="
                        visibleColumns.includes(
                          'crm_record_by_user.last_contacted'
                        )
                      "
                      class="border-1 table-cell w-40 items-center whitespace-nowrap border text-xs text-gray-500">
                      <Datepicker
                        v-model="creator.crm_record_by_user.last_contacted"
                        @update:modelValue="
                          $emit('updateCreator', {
                            id: creator.id,
                            index: index,
                            key: `crm_record_by_user.last_contacted`,
                            value: creator.crm_record_by_user.last_contacted,
                          })
                        "
                        autocomplete="off"
                        enableTimePicker="false"
                        monthNameFormat="short"
                        data-format="yyyy-MM-dd"
                        autoApply="true"
                        type="datetime-local"
                        :id="creator.id + '_datepicker'"
                        class="focus-visible:border-1 focus-visible:border-1 block w-full rounded-md border-0 bg-white/0 text-xs text-neutral-500 placeholder-neutral-300 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500"
                        placeholder="--/--/--"
                        aria-describedby="email-description" />
                      <!-- <input
                          v-model="creator.crm_record_by_user.last_contacted"
                          @click="
                           creator.crm_record_by_user.last_contacted$emit('updateCrmMeta', creator)  })
                          "
                          autocomplete="off"
                          enableTimePicker="false"
                          monthNameFormat="short"
                          data-format="yyyy-MM-dd"
                          autoApply="true"
                          type="datetime-local"
                          :id="creator.id + '_datepicker'"
                          class="focus-visible:border-1 focus-visible:border-1 block w-full rounded-md border-0 bg-white/0 px-2 py-1 text-xs text-neutral-500 placeholder-neutral-300 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500"
                          placeholder="--/--/--"
                          aria-describedby="email-description" /> -->
                    </td>
                    <td
                      v-if="
                        visibleColumns.includes('crm_record_by_user.rating')
                      "
                      class="w-18 table-cell whitespace-nowrap px-2 py-1 text-sm text-gray-500">
                      <star-rating
                        class="w-20"
                        :star-size="12"
                        :increment="0.5"
                        v-model:rating="creator.crm_record_by_user.rating"
                        @update:rating="
                          $emit('updateCreator', {
                            id: creator.id,
                            index: index,
                            key: `crm_record_by_user.rating`,
                            value: creator.crm_record_by_user.rating,
                          })
                        "></star-rating>
                    </td>
                    <td
                      class="flex w-full justify-end whitespace-nowrap px-2 py-1 text-right text-xs font-medium">
                      <div class="flex items-center justify-end text-right">
                        <div>
                          <router-link
                            :to="{
                              name: 'Creator Overview',
                              params: { id: creator.id },
                            }"
                            class="text-neutral-600 hover:text-indigo-900">
                            Manage
                          </router-link>
                        </div>
                        <Menu as="div" class="relative inline-block text-left">
                          <Float
                            enter="transition duration-200 ease-out"
                            enter-from="scale-95 opacity-0"
                            enter-to="scale-100 opacity-100"
                            leave="transition duration-150 ease-in"
                            leave-from="scale-100 opacity-100"
                            leave-to="scale-95 opacity-0"
                            tailwindcss-origin-class
                            flip
                            :offset="10"
                            shift
                            portal
                            arrow
                            placement="bottom-end">
                            <MenuButton
                              class="flex items-center rounded-full text-gray-400 hover:text-gray-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100">
                              <span class="sr-only">Open options</span>
                              <EllipsisVerticalIcon
                                class="z-0 h-5 w-5"
                                aria-hidden="true" />
                            </MenuButton>
                            <transition
                              enter-active-class="transition ease-out duration-100"
                              enter-from-class="transform opacity-0 scale-95"
                              enter-to-class="transform opacity-100 scale-100"
                              leave-active-class="transition ease-in duration-75"
                              leave-from-class="transform opacity-100 scale-100"
                              leave-to-class="transform opacity-0 scale-95">
                              <MenuItems
                                class="z-10 mt-2 w-40 origin-top-right rounded-md border border-neutral-200 bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus-visible:outline-none">
                                <div class="py-1">
                                  <MenuItem
                                    :disabled="!creator.emails[0]"
                                    v-slot="{ active }"
                                    class="items-center">
                                    <a
                                      @click="emailCreator(creator.emails[0])"
                                      href="#"
                                      class="cursor-pointer items-center text-neutral-400 hover:text-neutral-900"
                                      :class="[
                                        active
                                          ? 'bg-gray-100 text-gray-900'
                                          : 'text-gray-700',
                                        'block px-4 py-2 text-xs',
                                      ]">
                                      <EnvelopeIcon
                                        class="mr-2 inline h-4 w-4" />
                                      Email</a
                                    >
                                  </MenuItem>
                                  <MenuItem
                                    v-slot="{ active }"
                                    class="cursor-pointer items-center">
                                    <a
                                      href="#"
                                      @click="downloadVCF(creator)"
                                      class="cursor-pointer items-center text-neutral-400 hover:text-neutral-900"
                                      :class="[
                                        active
                                          ? 'bg-gray-100 text-gray-900'
                                          : 'text-gray-700',
                                        'block px-4 py-2 text-xs',
                                      ]">
                                      <CloudArrowDownIcon
                                        class="mr-2 inline h-4 w-4" />
                                      Download VCard
                                    </a>
                                  </MenuItem>
                                  <MenuItem
                                    v-if="filters.list"
                                    v-slot="{ active }"
                                    class="cursor-pointer items-center"
                                    @click="
                                      toggleCreatorsFromList(
                                        creator.id,
                                        filters.list,
                                        true
                                      )
                                    ">
                                    <a
                                      href="#"
                                      class="items-center text-neutral-400 hover:text-neutral-900"
                                      :class="[
                                        active
                                          ? 'bg-gray-100 text-gray-900'
                                          : 'text-gray-700',
                                        'block px-4 py-2 text-xs',
                                      ]">
                                      <TrashIcon class="mr-2 inline h-4 w-4" />
                                      Remove from list</a
                                    >
                                  </MenuItem>
                                  <MenuItem
                                    v-slot="{ active }"
                                    @click="
                                      toggleArchiveCreators(
                                        creator.id,
                                        !creator.crm_record_by_user.archived
                                      )
                                    "
                                    class="items-center">
                                    <a
                                      href="#"
                                      class="items-center text-neutral-400 hover:text-neutral-900"
                                      :class="[
                                        active
                                          ? 'bg-gray-100 text-gray-900'
                                          : 'text-gray-700',
                                        'block px-4 py-2 text-xs',
                                      ]">
                                      <ArchiveBoxIcon
                                        class="mr-2 inline h-4 w-4" />
                                      {{
                                        filters.type == 'archived' &&
                                        creator.crm_record_by_user.archived
                                          ? 'Unarchived'
                                          : 'Archive'
                                      }}
                                    </a>
                                  </MenuItem>
                                  <MenuItem
                                    v-if="currentUser.is_admin"
                                    v-slot="{ active }"
                                    class="items-center"
                                    @click="refresh(creator)"
                                    :disabled="adding">
                                    <a
                                      href="#"
                                      class="items-center text-neutral-400 hover:text-neutral-900"
                                      :class="[
                                        active
                                          ? 'bg-gray-100 text-gray-900'
                                          : 'text-gray-700',
                                        'block px-4 py-2 text-xs',
                                      ]">
                                      <ArrowPathIcon
                                        class="mr-2 inline h-4 w-4" />
                                      Refresh</a
                                    >
                                  </MenuItem>
                                </div>
                              </MenuItems>
                            </transition>
                          </Float>
                        </Menu>

                        <!-- This example requires Tailwind CSS v2.0+ -->
                      </div>

                      <!-- This example requires Tailwind CSS v2.0+ -->
                    </td>
                  </tr>
                </template>
              </tbody>
            </table>

            <Pagination
              class="z-50 w-full bg-blue-500"
              v-if="creatorRecords.length"
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
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import {
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
  Popover,
  PopoverButton,
  PopoverPanel,
  TransitionRoot,
} from '@headlessui/vue';
import StarRating from 'vue-star-rating';
import {
  EllipsisVerticalIcon,
  ArchiveBoxIcon,
  ChevronDownIcon,
  PlusIcon,
  BriefcaseIcon,
  UserIcon,
  NoSymbolIcon,
  StarIcon,
  TrashIcon,
  ArrowPathIcon,
  MagnifyingGlassIcon,
  ChevronUpIcon,
  Bars3BottomLeftIcon,
  AtSymbolIcon,
  CurrencyDollarIcon,
  EnvelopeIcon,
  LinkIcon,
  CalendarDaysIcon,
  ArrowDownCircleIcon,
  ArrowUpCircleIcon,
  ChevronRightIcon,
  CloudArrowDownIcon,
  AdjustmentsHorizontalIcon,
  XMarkIcon,
  UserGroupIcon,
  ArrowsPointingOutIcon,
} from '@heroicons/vue/24/solid';
import KeyboardShortcut from '../../components/KeyboardShortcut';
import Pagination from '../../components/Pagination';
import SocialIcons from '../../components/SocialIcons.vue';
import JovieSpinner from '../../components/JovieSpinner.vue';
import ImportService from '../../services/api/import.service';
import CrmTableSortableHeader from '../CrmTableSortableHeader.vue';
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue';
import ButtonGroup from '../../components/ButtonGroup.vue';
import JovieTooltip from '../../components/JovieTooltip.vue';
export default {
  name: 'CrmTable',
  components: {
    ArchiveBoxIcon,
    ChevronRightIcon,
    StarRating,
    KeyboardShortcut,
    MagnifyingGlassIcon,
    ButtonGroup,
    Menu,
    EnvelopeIcon,
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
    UserGroupIcon,
    ChevronDownIcon,
    PopoverButton,
    PopoverPanel,
    NoSymbolIcon,
    TrashIcon,
    Pagination,
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
    ArrowsPointingOutIcon,
  },
  data() {
    return {
      view: {
        atTopOfPage: true,
      },
      creatorRecords: [],
      searchQuery: '',
      currentRow: null,
      date: null,
      selectedCreators: [],
      activeCreator: {},
      currentContact: [],
      editingSocialHandle: true,
      searchVisible: false,
      imageLoaded: true,
      cellActive: false,
      settings: [
        {
          name: 'Show Follower Counts',
          icon: 'UserGroupIcon',
          isVisible: false,
          type: 'toggle',
        },
        {
          name: 'Import a CSV',
          icon: 'ArrowUpCircleIcon',
          isVisible: false,
          link: '/import',
        },
        {
          name: 'Export a CSV',
          icon: 'ArrowDownCircleIcon',
          isVisible: false,
        },
      ],
      columns: [
        {
          name: 'Name',
          key: 'full_name',
          icon: 'Bars3BottomLeftIcon',
          sortable: true,
          visible: true,
        },
        {
          name: 'First',
          key: 'first_name',
          icon: 'Bars3BottomLeftIcon',
          sortable: false,
          visible: false,
          breakpoint: '2xl',
          width: '18',
        },
        {
          name: 'Last',
          key: 'last_name',
          icon: 'Bars3BottomLeftIcon',
          visible: false,
          sortable: false,
          breakpoint: '2xl',
          width: '18',
        },
        {
          name: 'Title',
          key: 'title',
          icon: 'UserIcon',
          visible: true,
          breakpoint: '2xl',
        },
        {
          name: 'Company',
          key: 'employer',
          icon: 'BriefcaseIcon',
          visible: true,
          sortable: false,
          breakpoint: '2xl',
          width: '24',
        },

        {
          name: 'Email',
          key: 'emails',
          icon: 'AtSymbolIcon',
          visible: true,
          breakpoint: 'lg',
          width: '40',
        },

        {
          name: 'Social Links',
          key: 'networks',
          icon: 'LinkIcon',
          visible: true,
          width: '18',
        },
        {
          name: 'Offer',
          key: 'crm_record_by_user.offer',
          icon: 'CurrencyDollarIcon',
          sortable: true,
          visible: false,
          breakpoint: 'lg',
          width: '12',
        },
        {
          name: 'Stage',
          key: 'crm_record_by_user.stage',
          icon: 'ArrowDownCircleIcon',
          width: '24',
          sortable: true,
          visible: true,
          breakpoint: 'md',
        },
        {
          name: 'Last Contacted',
          key: 'crm_record_by_user.last_contacted',
          icon: 'CalendarDaysIcon',
          sortable: false,
          visible: false,
          breakpoint: '2xl',
          width: '24',
        },
        {
          name: 'Rating',
          key: 'crm_record_by_user.rating',
          icon: 'StarIcon',
          sortable: true,
          visible: true,
          breakpoint: '2xl',
          width: '24',
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
      this.nextContact();
    });
    this.$mousetrap.bind('space', () => {
      this.toggleContactSidebar();
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
  },
  // a beforeMount call to add a listener to the window
  beforeMount() {
    window.addEventListener('scroll', this.handleScroll);
  },
  methods: {
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
    imageLoadingError() {
      this.imageLoaded = false;
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
    generateVCF(Creator) {
      let vCard = 'BEGIN:VCARD\n';
      vCard += 'VERSION:3.0\n';
      //if creator has a first name
      if (Creator.first_name) {
        vCard += 'N:' + Creator.first_name + ' ' + Creator.last_name + '\n';
        vCard += 'FN:' + Creator.first_name + ' ' + Creator.last_name + '\n';
      } else {
        vCard += 'N:' + Creator.name + '\n';
        vCard += 'FN:' + Creator.name + '\n';
      }
      //if creator has a phone number
      if (Creator.phone) {
        vCard += 'TEL;TYPE=WORK,VOICE:' + Creator.phone + '\n';
      }
      //if creator has an email
      if (Creator.emails[0]) {
        vCard += 'EMAIL;TYPE=PREF,INTERNET:' + Creator.emails[0] + '\n';
      }
      if (Creator.company) {
        vCard += 'ORG:' + Creator.company + '\n';
      }
      if (Creator.title) {
        vCard += 'TITLE:' + Creator.title + '\n';
      }
      if (Creator.location) {
        vCard += 'ADR;TYPE=WORK:;;' + Creator.location + '\n';
      }
      if (Creator.website) {
        vCard += 'URL:' + Creator.website + '\n';
      }
      if (Creator.twitter_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=twitter:' + Creator.twitter_handler + '\n';
      }
      if (Creator.instagram_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=instagram:' + Creator.instagram_handler + '\n';
      }
      if (Creator.facebook_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=facebook:' + Creator.facebook_handler + '\n';
      }
      if (Creator.linkedin_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=linkedin:' + Creator.linkedin_handler + '\n';
      }
      if (Creator.youtube_handler) {
        vCard +=
          'X-SOCIALPROFILE;TYPE=youtube:' + Creator.youtube_handler + '\n';
      }
      if (Creator.tiktok_handler) {
        vCard += 'X-SOCIALPROFILE;TYPE=tiktok:' + Creator.tiktok_handler + '\n';
      }
      if (Creator.twitch_handler) {
        vCard += 'X-SOCIALPROFILE;TYPE=twitch:' + Creator.twitch_handler + '\n';
      }
      if (Creator.bio) {
        vCard += 'NOTE:' + Creator.bio + 'NOTE:Saved from Jovie\n';
      } else {
        vCard += 'NOTE:Saved from Jovie\n';
      }
      vCard += 'END:VCARD';
      return vCard;
    },
    downloadVCF(Creator) {
      let vCard = this.generateVCF(Creator);
      let blob = new Blob([vCard], { type: 'text/vcard' });
      let url = URL.createObjectURL(blob);
      let link = document.createElement('a');
      link.setAttribute('href', url);
      link.setAttribute(
        'download',
        `Jovie Contact ${Creator.first_name} ${Creator.last_name}.vcf`
      );
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
      //toggle this.$store.state.ContactSidebarOpen
      this.$store.state.ContactSidebarOpen =
        !this.$store.state.ContactSidebarOpen;
    },
    setActiveCreator(creator) {
      this.activeCreator = creator;
      //emit the active creator to the parent component
      this.$emit('activeCreator', creator);
      //log the id of the active creator in the console
      console.log('The active creator is ' + this.activeCreator);
    },
    setCurrentContact(e, creator) {
      this.currentContact = creator;
      if (e.target.name == 'selectCreatorCheckbox') {
        if (this.selectedCreators.includes(creator.id)) {
          this.selectedCreators.splice(
            this.selectedCreators.indexOf(creator.id),
            1
          );
        } else {
          this.selectedCreators.push(creator.id);
        }
      }
      this.$emit('setCurrentContact', creator);
    },
    nextContact() {
      const index = this.creatorRecords.indexOf(this.currentContact);
      if (index < this.creatorRecords.length - 1) {
        this.setCurrentContact(this.creatorRecords[index + 1]);
      }
    },
    previousContact() {
      const index = this.creatorRecords.indexOf(this.currentContact);
      if (index > 0) {
        this.setCurrentContact(this.creatorRecords[index - 1]);
      }
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
};
</script>
