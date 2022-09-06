<template>
  <div class="h-full flex-col justify-between">
    <div class="flex flex-col">
      <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
          <div
            class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
            <table
              class="min-w-full table-fixed divide-y divide-gray-200 overflow-x-scroll">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 grow-0 items-center border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-1 text-center text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter">
                    <div class="grid grid-cols-2 items-center">
                      <div class="h-5 items-center text-center">
                        <input
                          type="checkbox"
                          class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500 sm:left-6"
                          :checked="
                            indeterminate ||
                            selectedCreator.length === creators.length
                          "
                          :indeterminate="indeterminate"
                          @change="
                            selectedCreator = $event.target.checked
                              ? Creator.map((p) => p.email)
                              : []
                          " />
                        <!--  <input
                          id="comments"
                          aria-describedby="comments-description"
                          name="comments"
                          type="checkbox"
                          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500" /> -->
                      </div>
                      <div
                        class="group sr-only w-8 items-center text-center text-gray-300 hover:text-red-500">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-6 w-6 group-hover:fill-red-500"
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
                    </div>
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter">
                    <div
                      v-if="!selectedCreators.length > 0"
                      class="flex items-center space-x-3 bg-gray-50">
                      <button
                        type="button"
                        class="py-.5 inline-flex items-center rounded border border-gray-300 bg-white px-2 text-2xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">
                        Bulk edit
                      </button>
                      <button
                        type="button"
                        class="py-.5 inline-flex items-center rounded border border-gray-300 bg-white px-2 text-2xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">
                        Archive all
                      </button>
                      <Menu>
                        <Float portal placement="bottom-end">
                          <MenuButton
                            class="py-.5 inline-flex items-center rounded border border-gray-300 bg-white px-2 text-2xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30"
                            >Actions</MenuButton
                          >
                          <transition
                            enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0"
                            enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-in"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0">
                            <MenuItems
                              class="flex-col rounded-md border border-neutral-200 bg-neutral-50 px-2 shadow-xl">
                              <MenuItem v-slot="{ active }">
                                <button
                                  :class="[
                                    active
                                      ? 'bg-violet-500 text-white'
                                      : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                  ]">
                                  <EditIcon
                                    :active="active"
                                    class="mr-2 h-5 w-5 text-violet-400"
                                    aria-hidden="true" />
                                  Add to list
                                </button>
                              </MenuItem>
                              <MenuItem v-slot="{ active }">
                                <button
                                  :class="[
                                    active
                                      ? 'bg-violet-500 text-white'
                                      : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                  ]">
                                  <EditIcon
                                    :active="active"
                                    class="mr-2 h-5 w-5 text-violet-400"
                                    aria-hidden="true" />
                                  Archive
                                </button>
                              </MenuItem>
                              <MenuItem disabled>
                                <button
                                  :class="[
                                    active
                                      ? 'bg-violet-500 text-white'
                                      : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                  ]">
                                  <EditIcon
                                    :active="active"
                                    class="mr-2 h-5 w-5 text-violet-400"
                                    aria-hidden="true" />
                                  Remove From List
                                </button>
                              </MenuItem>
                            </MenuItems>
                          </transition>
                        </Float>
                      </Menu>
                    </div>
                    <div v-else>Name</div>
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter lg:table-cell">
                    First
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter 2xl:table-cell">
                    Last
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter lg:table-cell">
                    Email
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 table-cell items-center border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter">
                    <CrmTableSortableHeader name="Followers" />
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter lg:table-cell">
                    Offer
                  </th>

                  <!-- <th scope="col"
                            class="px-2 py-3 text-left text-xs font-medium text-gray-500  tracking-wider">
                            Campaign
                        </th> -->
                  <th
                    scope="col"
                    class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter md:table-cell">
                    Stage
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter 2xl:table-cell">
                    Last Contacted
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter 2xl:table-cell">
                    Rating
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-right text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter">
                    <span class="sr-only">Edit</span>
                    <input placeholder="Search" v-model="query" />
                  </th>
                </tr>
              </thead>
              <tbody class="h-full divide-y divide-gray-200 bg-white">
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
                  v-for="(creator, index) in creators"
                  :key="creator">
                  <tr
                    @click="
                      setCurrentContact(creator) &&
                        this.$store.ContactSidebarOpen
                    "
                    class="border-1 group border-collapse overflow-y-visible border border-neutral-200 focus-visible:ring-indigo-700"
                    :class="[
                      {
                        'bg-neutral-100 hover:bg-neutral-100':
                          currentContact.id == creator.id,
                      },
                      'bg-white hover:bg-neutral-50',
                    ]">
                    <td
                      class="w-20 flex-none overflow-auto whitespace-nowrap px-2 py-1 text-center text-xs font-bold text-gray-300 group-hover:text-neutral-500">
                      <div class="grid grid-cols-2 items-center gap-2">
                        <div class="group mx-auto mr-2">
                          <span v-if="currentCreator == creator">
                            <div
                              class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"></div>
                            <input
                              type="checkbox"
                              class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500 sm:left-6"
                              :value="creator.id"
                              v-model="selectedCreator" />
                            <!--      <input
                                id="comments-description"
                                aria-describedby="comments-description"
                                name="comments"
                                type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500" /> -->
                            <div
                              class="absolute top-0 left-12 flex h-12 items-center space-x-3 bg-gray-50 sm:left-16"></div>
                          </span>
                          <span v-else>
                            {{ index + 1 }}
                          </span>
                        </div>
                        <!--                                                                    favourite-->
                        <div
                          class="hidden cursor-pointer lg:block"
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
                            class="h-6 w-6 hover:fill-red-500 hover:text-red-500"
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
                      </div>
                    </td>
                    <td
                      class="max-w-14 sticky cursor-pointer whitespace-nowrap border px-2">
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
                        <div class="text-xs font-medium text-gray-900">
                          {{ creator.name }}
                        </div>
                      </div>
                    </td>
                    <td
                      class="border-1 hidden w-20 border-collapse whitespace-nowrap border lg:table-cell">
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
                      class="border-1 hidden w-24 border-collapse whitespace-nowrap border 2xl:table-cell">
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
                      class="border-1 min-w-20 hidden border-collapse whitespace-nowrap border focus-visible:border-indigo-500 lg:table-cell">
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
                          class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                          placeholder="someone@gmail.com"
                          aria-describedby="email-description" />
                      </div>
                    </td>
                    <td
                      class="border-1 w-4 border-collapse items-center whitespace-nowrap border">
                      <a
                        v-for="network in networks"
                        :href="creator[`${network}_handler`]"
                        target="_blank"
                        class="inline-flex items-center justify-between rounded-full px-3 py-1 text-center text-xs font-bold text-gray-800">
                        <div class="mx-auto flex-col items-center">
                          <div
                            v-if="creator[`${network}_handler`]"
                            class="mx-auto items-center group-hover:opacity-100"
                            :class="[
                              {
                                'opacity-100': creator[`${network}_handler`],
                              },
                              'opacity-30',
                            ]">
                            <Popover class="relative">
                              <Float portal placement="bottom-end">
                                <PopoverButton>
                                  <SocialIcons
                                    class="mx-auto"
                                    height="14px"
                                    :icon="network" />
                                </PopoverButton>
                                <PopoverPanel
                                  class="z-10 mt-3 w-screen max-w-sm -translate-x-1/2 transform px-4 sm:px-0 lg:max-w-3xl">
                                  <div
                                    class="w-40 rounded-md bg-gray-800 shadow-md">
                                    Hi
                                  </div>
                                </PopoverPanel>
                              </Float>
                            </Popover>
                          </div>
                          <div
                            class="mx-auto items-center opacity-30 group-hover:opacity-100"
                            v-else>
                            <SocialIcons
                              class="mx-auto"
                              height="14px"
                              :icon="network" />
                          </div>
                          <div class="">
                            <span
                              v-if="creator[`${network}_handler`]"
                              class="mx-auto items-center text-2xs font-bold text-neutral-400">
                              {{
                                formatCount(creator[`${network}_followers`])
                              }}</span
                            >
                          </div>
                        </div>
                      </a>
                    </td>
                    <td
                      class="border-1 hidden w-20 border-collapse whitespace-nowrap border lg:table-cell">
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
                                    class="hover:text-white' group flex w-full items-center bg-neutral-50 px-2 py-2 text-xs text-neutral-600 first:rounded-t-lg first:pt-2 last:rounded-b-lg last:pb-2 hover:bg-neutral-200">
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
                      class="border-1 hidden w-32 border-collapse items-center whitespace-nowrap border text-xs text-gray-500 2xl:table-cell">
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
                        class="focus-visible:border-1 focus-visible:border-1 block w-full rounded-md border-0 bg-white/0 px-2 py-1 text-xs text-neutral-500 placeholder-neutral-300 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500"
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
                        class="W-28 hidden whitespace-nowrap px-6 py-1 text-sm text-gray-500 2xl:table-cell">
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
                        class="flex w-12 whitespace-nowrap px-2 py-1 text-right text-xs font-medium">
                        <div class="justify-right flex items-center text-right">
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
                          <Menu
                            as="div"
                            class="relative inline-block text-left">
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
                                  class="w-30 backdrop-fitler z-10 mt-2 origin-top-right rounded-md bg-white/90 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl focus-visible:outline-none">
                                  <div class="py-1">
<!--                                    <MenuItem-->
<!--                                      v-slot="{ active }"-->
<!--                                      @click="-->
<!--                                        $emit('updateCreator', {-->
<!--                                          id: creator.id,-->
<!--                                          index: index,-->
<!--                                          network: network,-->
<!--                                          key: `crm_record_by_user.${network}_archived`,-->
<!--                                          value:-->
<!--                                            !creator.crm_record_by_user[-->
<!--                                              `${network}_archived`-->
<!--                                            ],-->
<!--                                        })-->
<!--                                      "-->
<!--                                      class="items-center">-->
<!--                                      <a-->
<!--                                        href="#"-->
<!--                                        class="items-center text-neutral-400 hover:text-neutral-900"-->
<!--                                        :class="[-->
<!--                                          active-->
<!--                                            ? 'bg-gray-100 text-gray-900'-->
<!--                                            : 'text-gray-700',-->
<!--                                          'block px-4 py-2 text-sm',-->
<!--                                        ]">-->
<!--                                        <ArchiveBoxIcon-->
<!--                                          class="mr-2 inline h-4 w-4" />-->
<!--                                        {{-->
<!--                                          creator.crm_record_by_user[-->
<!--                                            `${network}_archived`-->
<!--                                          ]-->
<!--                                            ? 'Unarchived'-->
<!--                                            : 'Archive'-->
<!--                                        }}-->
<!--                                      </a>-->
<!--                                    </MenuItem>-->
                                    <MenuItem
                                      v-slot="{ active }"
                                      class="items-center">
                                      <a
                                        href="#"
                                        class="items-center text-neutral-400 hover:text-neutral-900"
                                        :class="[
                                          active
                                            ? 'bg-gray-100 text-gray-900'
                                            : 'text-gray-700',
                                          'block px-4 py-2 text-sm',
                                        ]">
                                        <PlusIcon class="mr-2 inline h-4 w-4" />
                                        Add To List</a
                                      >
                                    </MenuItem>
                                    <MenuItem
                                        v-if="filters.list"
                                      v-slot="{ active }"
                                      class="items-center"
                                      @click="removeCreatorFromList(creator.id, index)">
                                      <a
                                        href="#"
                                        class="items-center text-neutral-400 hover:text-neutral-900"
                                        :class="[
                                          active
                                            ? 'bg-gray-100 text-gray-900'
                                            : 'text-gray-700',
                                          'block px-4 py-2 text-sm',
                                        ]">
                                        <TrashIcon
                                          class="mr-2 inline h-4 w-4" />
                                        Remove from list</a
                                      >
                                    </MenuItem>
                                    <MenuItem
                                      v-if="currentUser.is_admin && 0"
                                      v-slot="{ active }"
                                      class="items-center"
                                      @click="
                                        refresh(
                                          creator[`${network}_handler`],
                                          network
                                        )
                                      "
                                      :disabled="adding">
                                      <a
                                        href="#"
                                        class="items-center text-neutral-400 hover:text-neutral-900"
                                        :class="[
                                          active
                                            ? 'bg-gray-100 text-gray-900'
                                            : 'text-gray-700',
                                          'block px-4 py-2 text-sm',
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
      class="fixed bottom-0 w-full"
      v-if="creators.length"
      :totalPages="creatorsMeta.last_page"
      :perPage="creatorsMeta.per_page"
      :currentPage="creatorsMeta.current_page"
      :disabled="loading"
      @pagechanged="$emit('pageChanged', $event)" />
  </div>
</template>

<script>
import { Float } from '@headlessui-float/vue';
import { ref } from 'vue';
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
import StarRating from 'vue-star-rating';
import {
  EllipsisVerticalIcon,
  ArchiveBoxIcon,
  ChevronDownIcon,
  PlusIcon,
  NoSymbolIcon,
  TrashIcon,
  ArrowPathIcon,
} from '@heroicons/vue/24/solid';
import Pagination from '../../components/Pagination';
import SocialIcons from '../../components/SocialIcons.vue';
import JovieSpinner from '../../components/JovieSpinner.vue';
import ImportService from '../../services/api/import.service';
import CrmTableSortableHeader from '../CrmTableSortableHeader.vue';

const date = ref();

export default {
  name: 'CrmTable',
  components: {
    ArchiveBoxIcon,
    StarRating,
    Menu,
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
  },
  data() {
    return {
      searchQuery: [],
      currentRow: null,
      date: null,
      selectedCreators: [],
      activeCreator: {},
      currentContact: [],
      editingSocialHandle: true,
    };
  },
  props: [
    'filters',
    'creators',
    'networks',
    'stages',
    'creatorsMeta',
    'loading',
    'archived',
  ],
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
  },
  methods: {
      setCurrentRow(row) {
          this.currentRow = row;
          console.log(this.currentRow);
      },
      removeCreatorFromList(id, index) {
          this.$store.dispatch('removeCreatorFromList', {creatorId: id, list: this.filters.list}).then((response) => {
              response = response.data;
              if (response.status) {
                  this.creators.splice(index, 1);
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
                      type: 'success',
                      duration: 15000,
                      title: 'Successful',
                      text: response.message,
                  });
              }
          }).catch((error) => {
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
          }).finally((response) => {});;
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
      console.log('The current contact is ' + this.currentContact.id);
      //emit the current contact to the parent component
      this.$emit('currentContact', creator);
    },
    //method to change the currentContact to the next creator in the list
    nextContact() {
      //get the index of the current contact
      const index = this.creators.indexOf(this.currentContact);
      //if the index is less than the length of the creators array
      if (index < this.creators.length - 1) {
        //set the current contact to the next creator in the array
        this.currentContact = this.creators[index + 1];
        //emit the current contact to the parent component
        this.$emit('currentContact', this.currentContact);
        //log the id of the current contact in the console
        console.log('The current contact is ' + this.currentContact.id);
      }
    },
    previousContact() {
      //get the index of the current contact
      const index = this.creators.indexOf(this.currentContact);
      //if the index is greater than 0
      if (index > 0) {
        //set the current contact to the previous creator in the array
        this.currentContact = this.creators[index - 1];
        //emit the current contact to the parent component
        this.$emit('currentContact', this.currentContact);
        //log the id of the current contact in the console
        console.log('The current contact is ' + this.currentContact.id);
      }
    },
    refresh(url, network) {
      this.adding = true;
      var form = new FormData();
      form.append(network, url);
      ImportService.import(form)
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

/*
<script setup>
import { computed } from 'vue';

const selectedCreator = ref([]);
const checked = ref(false);
const indeterminate = computed(
  () =>
    selectedCreator.value.length > 0 &&
    selectedCreator.value.length < creators.length
);
</script>
*/
<style scoped></style>
