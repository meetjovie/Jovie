<template>
  <div class="h-full w-full flex-col">
    <div class="flex h-full w-full flex-col">
      <div class="h-full overflow-x-scroll">
        <div class="inline-block min-w-full align-middle">
          <div
            class="overflow-x-scroll shadow-sm ring-1 ring-black ring-opacity-5">
            <table
              class="min-w-full table-auto divide-y divide-gray-200 overflow-x-scroll">
              <thead class="items-center bg-neutral-100">
                <tr class="h-10 items-center py-2">
                  <th
                    scope="col"
                    class="sticky top-0 z-10 items-center border-b border-gray-300 bg-gray-100 text-center text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter">
                    <div class="h-5 items-center text-center">
                      <input
                        type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500"
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
                      <!--  <input
                          id="comments"bulk edis
                          aria-describedby="comments-description"
                          name="comments"
                          type="checkbox"
                          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500" /> -->
                    </div>
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 items-center border-b border-gray-300 bg-gray-100 text-center text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter">
                    <span class="sr-only">Favorite</span>
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 items-center border-b border-gray-300 bg-gray-100 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter">
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
                                class="items-center"
                                @click="
                                  toggleCreatorsFromList(
                                    selectedCreators,
                                    filters.list,
                                    true
                                  )
                                ">
                                <button
                                  class="items-center text-neutral-400 hover:text-neutral-900"
                                  :class="[
                                    active
                                      ? 'bg-gray-100 text-gray-900'
                                      : 'text-gray-700',
                                    'block px-4 py-2 text-xs',
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
                                    'group inline w-full items-center rounded-b-md border border-t border-neutral-200 px-2 py-1 text-left text-xs font-bold ',
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
                        name="Name"
                        sortable />
                    </div>
                  </th>

                  <template v-for="column in columns">
                    <th
                      :key="column.key"
                      v-if="column.visible"
                      scope="col"
                      class="sticky top-0 z-10 table-cell items-center border-b border-gray-300 bg-gray-100 py-1 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter">
                      <CrmTableSortableHeader
                        :class="[
                          { 'hidden sm:block': column.breakpoint == 'sm' },
                          { 'hidden md:block': column.breakpoint == 'md' },
                          { 'hidden lg:block': column.breakpoint == 'lg' },
                          { 'hidden xl:block': column.breakpoint == 'xl' },
                          { 'hidden 2xl:block': column.breakpoint == '2xl' },
                          'block',
                        ]"
                        :sortable="column.sortable"
                        :icon="column.icon"
                        :name="column.name" />
                    </th>
                  </template>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 flex w-full items-center justify-end border-b border-gray-300 py-1 text-right text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter">
                    <div class="flex h-full w-60 content-end items-center px-2">
                      <div
                        class="group flex h-full w-full cursor-pointer items-center justify-end py-2 px-4 transition-all">
                        <div
                          class="flex items-center justify-end"
                          v-if="searchVisible">
                          <div class="flex w-40 rounded-md shadow-sm">
                            <div
                              class="relative flex flex-grow items-stretch focus-within:z-10">
                              <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <MagnifyingGlassIcon
                                  class="h-4 w-4 text-gray-400"
                                  aria-hidden="true" />
                              </div>
                              <input
                                placeholder="Search"
                                v-model="searchQuery"
                                class="block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>
                          </div>
                        </div>
                        <div
                          class="flex cursor-pointer items-center hover:bg-neutral-50"
                          v-else>
                          <MagnifyingGlassIcon
                            @click="toggleSearchVisible()"
                            class="mr-1 -mt-1 h-5 w-5 text-gray-400 group-hover:text-neutral-600" />
                        </div>
                      </div>
                      <div
                        class="w-18 group mr-2 h-full cursor-pointer items-center">
                        <Menu>
                          <Float
                            portal
                            class="pr-2"
                            :offset="14"
                            placement="bottom-end">
                            <MenuButton
                              class="inline-flex items-center rounded border border-gray-300 bg-white px-2 text-2xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">
                              <AdjustmentsHorizontalIcon
                                class="h-5 w-5 font-bold text-gray-400 group-hover:text-neutral-600"
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
                                class="w-60 flex-col rounded-md border border-neutral-200 bg-neutral-50 py-1 pl-2 pr-1 shadow-xl">
                                <MenuItem as="div" v-slot="{ active }">
                                  <div
                                    class="flex items-center border-b border-neutral-200 py-1">
                                    <span
                                      class="text-xs font-bold text-neutral-500 line-clamp-1">
                                      Display Columns
                                    </span>
                                  </div>
                                </MenuItem>
                                <MenuItem
                                  as="div"
                                  v-for="(column, index) in columns"
                                  v-slot="{ active }">
                                  <button
                                    :class="[
                                      active
                                        ? 'bg-gray-100 text-gray-600'
                                        : 'text-gray-400',
                                      'group flex w-full items-center justify-between rounded-md px-2 py-1 text-xs font-bold',
                                    ]">
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
                                          checked
                                            ? 'bg-indigo-600'
                                            : 'bg-gray-200'
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
                                </MenuItem>
                              </MenuItems>
                            </transition>
                          </Float>
                        </Menu>
                      </div>
                      <div
                        @click="exportToCSV()"
                        class="w-18 group mr-2 h-full cursor-pointer items-center">
                        <CloudArrowDownIcon class="h-5 w-5 text-neutral-400" />
                      </div>
                    </div>
                  </th>
                </tr>
              </thead>
              <tbody class="h-full w-full divide-y divide-gray-200 bg-white">
                <template v-if="loading">
                  <tr>
                    <td colspan="11">
                      <div
                        class="flex min-h-screen items-center justify-center bg-gray-50 pb-80">
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
                    @click="
                      setCurrentContact(creator) && $store.ContactSidebarOpen
                    "
                    class="border-1 group w-full border-collapse flex-row overflow-y-visible border border-neutral-200 focus-visible:ring-indigo-700"
                    :class="[
                      {
                        'bg-neutral-100 hover:bg-neutral-100':
                          currentContact.id == creator.id,
                      },
                      'bg-white hover:bg-neutral-50',
                    ]">
                    <td
                      class="w-12 overflow-auto whitespace-nowrap py-1 text-center text-xs font-bold text-gray-300 group-hover:text-neutral-500">
                      <div class="group mx-auto mr-2">
                        <span
                          class="group-hover:block"
                          :class="[
                            {
                              hidden: !selectedCreators.includes(creator.id),
                            },
                            'block',
                          ]">
                          <input
                            type="checkbox"
                            :name="creator.id"
                            :id="`creator_${creator.id}`"
                            :value="creator.id"
                            class="h-4 w-4 rounded border-gray-300 px-2 text-indigo-600 focus-visible:ring-indigo-500 sm:left-6"
                            v-model="selectedCreators" />
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
                      class="w-12 overflow-auto whitespace-nowrap px-2 py-1 text-center text-xs font-bold text-gray-300 group-hover:text-neutral-500">
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
                          class="-mt-.5 h-4 w-4 hover:fill-red-500 hover:text-red-500"
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
                      class="sticky w-60 cursor-pointer whitespace-nowrap border px-2">
                      <div class="flex items-center">
                        <div class="mr-2 h-8 w-8 flex-shrink-0">
                          <div
                            class="rounded-full bg-gradient-to-tr from-yellow-500/90 via-fuchsia-500/90 to-purple-500/90 p-0.5">
                            <div class="rounded-full bg-white p-0">
                              <img
                                class="rounded-full object-cover object-center"
                                :src="
                                  creator.profile_pic_url ??
                                  asset('img/noimage.webp')
                                "
                                alt="Profile Image" />
                            </div>
                          </div>
                        </div>
                        <div class="text-cs text-gray-900 line-clamp-1">
                          <input
                            v-model="creator.name"
                            autocomplete="off"
                            type="creator-name"
                            name="creator-name"
                            id="creator-name"
                            class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                            placeholder="Name"
                            aria-describedby="name-description" />
                        </div>
                      </div>
                    </td>
                    <td
                      v-if="visibleColumns.includes('first_name')"
                      class="border-1 hidden w-28 border-collapse whitespace-nowrap border 2xl:table-cell">
                      <div class="text-sm text-gray-900 line-clamp-1">
                        <input
                          v-model="creator.first_name"
                          @blur="
                            $emit('updateCreator', {
                              id: creator.id,
                              index: index,
                              key: `first_name`,
                              value: creator.first_name,
                            })
                          "
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
                      class="border-1 hidden w-28 border-collapse whitespace-nowrap border 2xl:table-cell">
                      <div class="text-xs text-gray-900 line-clamp-1">
                        <input
                          v-model="creator.last_name"
                          @blur="
                            $emit('updateCreator', {
                              id: creator.id,
                              index: index,
                              key: `last_name`,
                              value: creator.last_name,
                            })
                          "
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
                      v-if="visibleColumns.includes('emails')"
                      class="border-1 hidden w-40 border-collapse whitespace-nowrap border focus-visible:border-indigo-500 lg:table-cell">
                      <div class="text-xs text-gray-700 line-clamp-1">
                        <input
                          v-model="creator.emails"
                          @blur="
                            $emit('updateCreator', {
                              id: creator.id,
                              index: index,
                              key: `emails`,
                              value: creator.emails,
                            })
                          "
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
                      class="border-1 w-24 border-collapse items-center whitespace-nowrap border">
                      <a
                        v-for="network in networks"
                        :href="creator[`${network}_handler`]"
                        target="_blank"
                        class="inline-flex items-center justify-between rounded-full px-1 py-1 text-center text-xs font-bold text-gray-800">
                        <div class="mx-auto flex-col items-center">
                          <div
                            v-if="creator[`${network}_handler`]"
                            class="mx-auto items-center opacity-100 group-hover:opacity-100">
                            <SocialIcons
                              class="mx-auto"
                              height="14px"
                              :icon="network" />
                          </div>
                          <div class="mx-auto items-center" v-else>
                            <div class="opacity-10 hover:opacity-100">
                              <SocialIcons height="14px" :icon="network" />
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
                      class="border-1 hidden w-24 border-collapse whitespace-nowrap border lg:table-cell">
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
                          type="creator-offer"
                          name="creator-offer"
                          id="creator-offer"
                          class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                          :placeholder="
                            creator.crm_record_by_user.suggested_offer
                          "
                          aria-describedby="email-description" />
                      </span>
                    </td>

                    <td
                      v-if="visibleColumns.includes('crm_record_by_user.stage')"
                      class="border-1 hidden w-28 border-collapse items-center whitespace-nowrap border md:table-cell">
                      <Popover
                        as="div"
                        class="relative inline-block w-full items-center text-left">
                        <Float portal :offset="2" shift placement="bottom">
                          <PopoverButton
                            class="flex w-full justify-between px-2">
                            <div
                              class="group my-0 -ml-1 inline-flex items-center justify-between rounded-full px-2 py-0.5 text-2xs font-semibold leading-5 line-clamp-1"
                              :class="[
                                {
                                  'bg-indigo-50 text-indigo-600':
                                    creator.crm_record_by_user.stage === 'Lead',
                                },
                                {
                                  'bg-sky-50 text-sky-600':
                                    creator.crm_record_by_user.stage ===
                                    'Interested',
                                },
                                {
                                  'bg-pink-50 text-pink-600':
                                    creator.crm_record_by_user.stage ===
                                    'Negotiating',
                                },
                                {
                                  'bg-fuchsia-50 text-fuchsia-600':
                                    creator.crm_record_by_user.stage ===
                                    'In Progress',
                                },
                                {
                                  'bg-red-50 text-red-600':
                                    creator.crm_record_by_user.stage ===
                                    'Complete',
                                },
                              ]">
                              {{ creator.crm_record_by_user.stage }}
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
                              class="z-30 mt-2 w-28 origin-top-right divide-y divide-gray-100 rounded-lg border border-neutral-200 bg-neutral-50 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-md focus-visible:outline-none">
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
                                    class="group flex w-full items-center bg-neutral-50 px-2 py-2 text-xs text-neutral-600 first:rounded-t-lg first:pt-2 last:rounded-b-lg last:pb-2 hover:bg-neutral-200 hover:text-white">
                                    <div
                                      class="mr-2 text-xs font-bold opacity-50">
                                      {{ key + 1 }}
                                    </div>
                                    <div class="text-xs font-bold">
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
                      class="border-1 hidden w-40 border-collapse items-center whitespace-nowrap border text-xs text-gray-500 2xl:table-cell">
                      <Datepicker
                        v-model="creator.crm_record_by_user.last_contacted"
                        @click="
                          $emit('updateCreator', {
                            id: creator.id,
                            index: index,
                            key: `crm_record_by_user.last_contacted`,
                            value: !creator.crm_record_by_user.last_contacted,
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
                            $emit('updateCreator', {
                              id: creator.id,
                              index: index,
                              network: network,
                              key: `crm_record_by_user.last_contacted`,
                              value: !creator.crm_record_by_user.last_contacted,
                            })
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
                      class="hidden w-32 whitespace-nowrap px-6 py-1 text-sm text-gray-500 2xl:table-cell">
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
                            value: $event,
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
                                class="backdrop-fitler z-10 mt-2 w-28 origin-top-right rounded-md bg-neutral-50 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl focus-visible:outline-none">
                                <div class="py-1">
                                  <MenuItem
                                    v-slot="{ active }"
                                    class="items-center">
                                    <a
                                      :href="`mailto:` + creator.email"
                                      class="items-center text-neutral-400 hover:text-neutral-900"
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
                                    v-if="filters.list"
                                    v-slot="{ active }"
                                    class="items-center"
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
          </div>
        </div>
      </div>
    </div>
    <Pagination
      class="w-full justify-end"
      v-if="creatorRecords.length"
      :totalPages="creatorsMeta.last_page"
      :perPage="creatorsMeta.per_page"
      :currentPage="creatorsMeta.current_page"
      :disabled="loading"
      @pagechanged="$emit('pageChanged', $event)" />
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
} from '@headlessui/vue';
import StarIcon from 'vue-star-rating';
import {
  EllipsisVerticalIcon,
  ArchiveBoxIcon,
  ChevronDownIcon,
  PlusIcon,
  ChartBarIcon,
  NoSymbolIcon,
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
  CloudArrowDownIcon,
  AdjustmentsHorizontalIcon,
} from '@heroicons/vue/24/solid';

import Pagination from '../../components/Pagination';
import SocialIcons from '../../components/SocialIcons.vue';
import JovieSpinner from '../../components/JovieSpinner.vue';
import ImportService from '../../services/api/import.service';
import CrmTableSortableHeader from '../CrmTableSortableHeader.vue';
import { Switch } from '@headlessui/vue';

export default {
  name: 'CrmTable',
  components: {
    ArchiveBoxIcon,
    StarIcon,
    ChartBarIcon,
    MagnifyingGlassIcon,
    Menu,
    EnvelopeIcon,
    Switch,
    Datepicker,
    MenuButton,
    Float,
    ArrowPathIcon,
    MenuItems,
    MenuItem,
    EllipsisVerticalIcon,
    SocialIcons,
    Popover,
    ChevronDownIcon,
    PopoverButton,
    PopoverPanel,
    NoSymbolIcon,
    TrashIcon,
    Pagination,
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
  },
  data() {
    return {
      creatorRecords: [],
      searchQuery: '',
      currentRow: null,
      date: null,
      selectedCreators: [],
      activeCreator: {},
      currentContact: [],
      editingSocialHandle: true,
      searchVisible: true,
      columns: [
        {
          name: 'First',
          key: 'first_name',
          icon: 'Bars3BottomLeftIcon',
          visible: false,
          breakpoint: '2xl',
        },
        {
          name: 'Last',
          key: 'last_name',
          icon: 'Bars3BottomLeftIcon',
          visible: false,
          breakpoint: '2xl',
        },
        {
          name: 'Email',
          key: 'emails',
          icon: 'AtSymbolIcon',
          visible: true,
          breakpoint: 'lg',
        },
        {
          name: 'Social Link',
          key: 'networks',
          icon: 'LinkIcon',
          visible: true,
        },
        {
          name: 'Offer',
          key: 'crm_record_by_user.offer',
          icon: 'CurrencyDollarIcon',
          sortable: true,
          visible: true,
          breakpoint: 'lg',
        },
        {
          name: 'Stage',
          key: 'crm_record_by_user.stage',
          icon: 'ArrowDownCircleIcon',
          width: 'w-24',
          sortable: true,
          visible: true,
          breakpoint: 'md',
        },
        {
          name: 'Last Contacted',
          key: 'crm_record_by_user.last_contacted',
          icon: 'CalendarDaysIcon',
          sortable: false,
          visible: true,
          breakpoint: '2xl',
        },
        {
          name: 'Rating',
          key: 'crm_record_by_user.rating',
          icon: 'ChartBarIcon',
          sortable: true,
          visible: true,
          breakpoint: '2xl',
        },
      ],
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
  },
  computed: {
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
  },
  methods: {
    toggleSearchVisible() {
      this.searchVisible = !this.searchVisible;
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
              this.$store.state.ContactSidebarOpen = false
            }
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
    setCurrentContact(creator) {
      this.currentContact = creator;
      this.$emit('setCurrentContact', creator);
    },
    nextContact() {
      const index = this.creatorRecords.indexOf(this.currentContact);
      if (index < this.creatorRecords.length - 1) {
          this.setCurrentContact(this.creatorRecords[index + 1])
      }
    },
    previousContact() {
      const index = this.creatorRecords.indexOf(this.currentContact);
      if (index > 0) {
          this.setCurrentContact(this.creatorRecords[index - 1])
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
