<template>
  <div id="crm" class="mx-auto w-full min-w-full">
    <TabGroup :defaultIndex="0" as="div">
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
        <div class="items-center">
          <Listbox as="div" v-model="selected">
            <div class="relative mt-2 items-center">
              <ListboxButton
                class="relative hidden w-60 cursor-default items-center rounded-md border border-gray-300 bg-white py-1 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-xs lg:block">
                <span class="block truncate">Filter by list</span>
                <span
                  class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                  <ChevronDownIcon
                    class="h-5 w-5 text-gray-400"
                    aria-hidden="true" />
                </span>
              </ListboxButton>
              <transition
                leave-active-class="transition ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0">
                <ListboxOptions
                  class="absolute z-10 mt-1 max-h-60 w-60 overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-xs">
                  <ListboxOption as="template" v-slot="{ active, selected }">
                    <li
                      :class="[
                        active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                        'relative cursor-default select-none py-2 pl-3 pr-9',
                      ]">
                      <span
                        :class="[
                          selected ? 'font-semibold' : 'font-normal',
                          'block truncate',
                        ]">
                        This is a list
                      </span>

                      <span
                        v-if="selected"
                        :class="[
                          active ? 'text-white' : 'text-indigo-600',
                          'absolute inset-y-0 right-0 flex items-center pr-4',
                        ]">
                        <CheckIcon class="h-5 w-5" aria-hidden="true" />
                      </span>
                    </li>
                  </ListboxOption>
                  <ListboxOption as="template" v-slot="{ active, selected }">
                    <li
                      :class="[
                        active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                        'relative cursor-default select-none py-2 pl-3 pr-9',
                      ]">
                      <span
                        :class="[
                          selected ? 'font-semibold' : 'font-normal',
                          'block truncate',
                        ]">
                        An so is this
                      </span>

                      <span
                        v-if="selected"
                        :class="[
                          active ? 'text-white' : 'text-indigo-600',
                          'absolute inset-y-0 right-0 flex items-center pr-4',
                        ]">
                        <CheckIcon class="h-5 w-5" aria-hidden="true" />
                      </span>
                    </li>
                  </ListboxOption>
                </ListboxOptions>
              </transition>
            </div>
          </Listbox>
        </div>
        <div class="items-center px-2">
          <span
            class="relative z-0 inline-flex h-full items-center rounded-md shadow-sm">
            <button
              type="button"
              class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white py-1 px-4 text-xs font-medium text-gray-700 hover:bg-indigo-600 hover:text-white focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
              Add creator
            </button>
            <Menu as="span" class="relative -ml-px block">
              <MenuButton
                class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-1 text-xs font-medium text-gray-500 hover:bg-gray-50 focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
                <span class="sr-only text-xs">Add creator</span>
                <ChevronDownIcon class="h-4 w-4" aria-hidden="true" />
              </MenuButton>
              <transition
                enter-active-class="transition ease-out duration-100"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95">
                <MenuItems
                  class="-0 absolute z-40 mt-2 -mr-1 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus-visible:outline-none">
                  <div class="py-1">
                    <MenuItem>
                      <a
                        :href="item.href"
                        :class="[
                          active
                            ? 'bg-gray-100 text-gray-900'
                            : 'text-gray-700',
                          'block px-4 py-2 text-xs',
                        ]">
                        Import from CSV
                      </a>
                    </MenuItem>
                    <MenuItem>
                      <a
                        :href="item.href"
                        :class="[
                          active
                            ? 'bg-gray-100 text-gray-900'
                            : 'text-gray-700',
                          'block px-4 py-2 text-xs',
                        ]">
                        Import from list
                      </a>
                    </MenuItem>
                  </div>
                </MenuItems>
              </transition>
            </Menu>
          </span>
        </div>
      </div>
      <TabPanels>
        <TabPanel>
          <div id="crm" class="mx-auto w-full min-w-full">
            <div class="w-full">
              <div class="flex w-full flex-col">
                <div class="mx-auto w-full p-0">
                  <div class="inline-block w-full align-middle">
                    <div
                      class="overflow-hidden border-b border-gray-200 shadow">
                      <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                          <tr>
                            <th
                              scope="col"
                              class="items-center px-2 py-1 text-center text-xs font-medium tracking-wider text-gray-500">
                              <div class="grid grid-cols-2 items-center">
                                <div class="h-5 items-center text-center">
                                  <input
                                    id="comments"
                                    aria-describedby="comments-description"
                                    name="comments"
                                    type="checkbox"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500" />
                                </div>
                                <div
                                  class="group sr-only items-center text-center text-gray-300 hover:text-red-500">
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
                              class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
                              Creator
                            </th>
                            <th
                              scope="col"
                              class="hidden px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 lg:table-cell">
                              First
                            </th>
                            <th
                              scope="col"
                              class="hidden px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 xl:flex">
                              Last
                            </th>
                            <th
                              scope="col"
                              class="hidden px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 lg:table-cell">
                              Email
                            </th>
                            <th
                              scope="col"
                              class="flex items-center px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
                              Followers
                            </th>
                            <th
                              scope="col"
                              class="hidden px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 lg:table-cell">
                              Offer
                            </th>

                            <!-- <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500  tracking-wider">
                                        Campaign
                                    </th> -->
                            <th
                              scope="col"
                              class="hidden px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 md:table-cell">
                              Stage
                            </th>
                            <th
                              scope="col"
                              class="hidden px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 xl:table-cell">
                              Contacted
                            </th>
                            <th
                              scope="col"
                              class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
                              Rating
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                              <span class="sr-only">Edit</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="h-full divide-y divide-gray-200 bg-white">
                          <tr
                            v-for="creator in creators"
                            :key="creator"
                            class="group border-1 border-collapse overflow-y-visible border border-neutral-200 hover:bg-indigo-50 focus:ring-indigo-700">
                            <td
                              class="w-14 whitespace-nowrap px-2 py-1 text-center text-xs font-bold text-gray-300 group-hover:text-neutral-500">
                              <div class="grid grid-cols-2 items-center">
                                <div class="group mr-2">
                                  <span class="group-hover:hidden">
                                    {{ creator.id }}
                                  </span>
                                  <span class="hidden group-hover:block">
                                    <input
                                      id="comments-description"
                                      aria-describedby="comments-description"
                                      name="comments"
                                      type="checkbox"
                                      class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500" />
                                  </span>
                                </div>
                                <div>
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
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
                            <td class="whitespace-nowrap border px-2">
                              <div class="flex items-center">
                                <div class="mr-2 h-8 w-8 flex-shrink-0">
                                  <div class="p-0.5 rounded-full" :class="{
                                      'bg-social-youtube/60':
                                        creator.network == 'youtube',
                                    }, {'bg-social-twitter/90' : creator.network == 'twitter'}, {'bg-gradient-to-tr from-yellow-500/90 via-fuchsia-500/90 to-purple-500/90' : creator.network == 'instagram'}, {'bg-social-snapchat' : creator.network == 'snapchat'}, {'bg-gradient-to-l from-pink-700 to-sky-700' : creator.network =='tiktok'}"
                                    >
                                <div class="bg-white p-0 rounded-full">
                                  <img
                                    class="rounded-full object-cover object-center"
                                    
                                    :src="creator.avatar"
                                    alt="" />
                                    </div>
                                    </div>
                                </div>
                                <div class="">
                                  <div
                                    class="text-xs font-medium text-gray-900">
                                    {{ creator.name }}
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td
                              class="border-1 hidden w-24 border-collapse whitespace-nowrap border lg:table-cell">
                              <div class="text-sm text-gray-900 line-clamp-1">
                                <input
                                  v-model="creator.firstname"
                                  autocomplete="off"
                                  type="creator-firstname"
                                  name="creator-firstname"
                                  id="creator-firname"
                                  class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus:border-2 focus:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                                  placeholder="First"
                                  aria-describedby="email-description" />
                              </div>
                            </td>
                            <td
                              class="border-1 hidden w-20 border-collapse whitespace-nowrap border xl:table-cell">
                              <div class="text-xs text-gray-900 line-clamp-1">
                                <input
                                  v-model="creator.lastname"
                                  autocomplete="off"
                                  type="creator-lastname"
                                  name="creator-lastname"
                                  id="creator-lastname"
                                  class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus:border-2 focus:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                                  placeholder="Last"
                                  aria-describedby="email-description" />
                              </div>
                            </td>
                            <td
                              class="border-1 hidden border-collapse whitespace-nowrap border focus:border-indigo-500 lg:table-cell">
                              <div class="text-xs text-gray-700 line-clamp-1">
                                <input
                                  v-model="creator.email"
                                  autocomplete="off"
                                  type="creator-email"
                                  name="creator-email"
                                  id="creator-email"
                                  class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus:border-2 focus:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                                  placeholder="creatoremail@gmail.com"
                                  aria-describedby="email-description" />
                              </div>
                            </td>
                            <td
                              class="border-1 w-14 border-collapse items-center whitespace-nowrap border px-2 py-1">
                              <span
                                class="text-nuetral-800 inline-flex items-center rounded-full px-2 text-center justify-between text-xs font-bold">
                                <div class="mr-2 group-hover:opacity-100 opacity-30 items-center">
                                <SocialIcons height="14px" :icon="creator.network" />
                                </div>
                                {{ creator.followers }}
                              </span>
                            </td>
                            <td
                              class="border-1 hidden w-20 border-collapse whitespace-nowrap border lg:table-cell">
                              <span
                                class="text-nuetral-800 inline-flex items-center rounded-full px-2 text-center text-xs font-bold leading-5">
                                $
                                <input
                                  v-model="creator.offer"
                                  autocomplete="off"
                                  type="creator-offer"
                                  name="creator-offer"
                                  id="creator-offer"
                                  class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus:border-2 focus:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                                  placeholder="5,000"
                                  aria-describedby="email-description" />
                              </span>
                            </td>
                            <!-- <td class="px-2 py-1 border border-collapse border-1 whitespace-nowrap">
                                                 <span
                                                     class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-nuetral-800">
                                                       {{creator.campaign}}
                                                 </span>
                                    </td> -->
                            <td
                              class="border-1 hidden w-32 border-collapse items-center whitespace-nowrap border md:table-cell">
                              <Popover
                                as="div"
                                class="relative inline-block text-left">
                                  <PopoverButton
                                    class="group my-0 inline-flex w-32 items-center justify-between rounded-sm bg-blue-100 px-2 py-1 text-xs font-semibold leading-5 text-blue-800">
                                    {{ creator.stage }}
                                    <svg
                                      xmlns="http://www.w3.org/2000/svg"
                                      class="ml-2 h-4 w-4 hover:text-blue-700 group-hover:text-blue-900"
                                      fill="none"
                                      viewBox="0 0 24 24"
                                      stroke="currentColor">
                                      <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                    </svg>
                                  </PopoverButton>
                                <transition
                                  enter-active-class="transition duration-100 ease-out"
                                  enter-from-class="transform scale-95 opacity-0"
                                  enter-to-class="transform scale-100 opacity-100"
                                  leave-active-class="transition duration-75 ease-in"
                                  leave-from-class="transform scale-100 opacity-100"
                                  leave-to-class="transform scale-95 opacity-0">
                                  <PopoverPanel
                                    class="center-0 absolute z-30 w-60 rounded-lg mt-2 origin-top-right divide-y divide-gray-100 bg-white/60 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-md focus:outline-none">
                                    <div class="">
                                      <div class="">
                                        <button
                                          :class="[
                                            active
                                              ? 'bg-indigo-500 text-neutral-700'
                                              : 'text-gray-900',
                                            'flex w-full items-center group first:rounded-t-lg last:rounded-b-lg px-2 py-2 first:pt-2 last:pb-2 text-neutral-700 hover:bg-indigo-700 hover:text-white text-xs',
                                          ]">
                                          <div class="mr-2 font-bold  opacity-50">1</div>
                                          <div class="font-bold">Interested</div>
                                        </button>
                                     
                                        <button
                                          :class="[
                                            active
                                              ? 'bg-indigo-500 text-neutral-700'
                                              : 'text-gray-900',
                                            'flex w-full items-center group first:rounded-t-lg last:rounded-b-lg px-2 py-2 first:pt-2 last:pb-2 text-neutral-700 hover:bg-indigo-700 hover:text-white text-xs',
                                          ]">
                                          <div class="mr-2 font-bold  opacity-50">2</div>
                                          <div class="font-bold">Negotiating</div>
                                        </button>
                                         <button
                                          :class="[
                                            active
                                              ? 'bg-indigo-500 text-neutral-700'
                                              : 'text-gray-900',
                                            'flex w-full items-center group first:rounded-t-lg last:rounded-b-lg px-2 py-2 first:pt-2 last:pb-2 text-neutral-700 hover:bg-indigo-700 hover:text-white text-xs',
                                          ]">
                                          <div class="mr-2 font-bold  opacity-50">3</div>
                                          <div class="font-bold">In Progress</div>
                                        </button>
                                         <button
                                          :class="[
                                            active
                                              ? 'bg-indigo-500 text-neutral-700'
                                              : 'text-gray-900',
                                            'flex w-full items-center group first:rounded-t-lg last:rounded-b-lg px-2 py-2 first:pt-2 last:pb-2 text-neutral-700 hover:bg-indigo-700 hover:text-white text-xs',
                                          ]">
                                          <div class="mr-2 font-bold  opacity-50">4</div>
                                          <div class="font-bold">Complete</div>
                                        </button>
                                      </div>
                                      
                                    </div>
                                  </PopoverPanel>
                                </transition>
                              </Popover>
                            </td>
                            <td
                              class="border-1 hidden w-14 border-collapse items-center whitespace-nowrap border text-xs text-gray-500 xl:table-cell">
                              <input
                                v-model="creator.contacted"
                                autocomplete="off"
                                type="creator-offer"
                                name="creator-offer"
                                id="creator-offer"
                                class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus:border-2 focus:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                                placeholder="--/--/----"
                                aria-describedby="email-description" />
                            </td>
                            <td
                              class="W-28 whitespace-nowrap px-6 py-1 text-sm text-gray-500">
                              <star-rating
                                class="w-20"
                                :star-size="12"
                                :increment="0.5"
                                v-model:rating="creator.rating"></star-rating>
                            </td>
                            <td
                              class="justify-right whitespace-nowrap py-1 text-right text-xs font-medium">
                              <div
                                class="justify-right grid grid-cols-2 items-center gap-4">
                                <div>
                                  <a
                                    href="/creatoroverview"
                                    class="text-indigo-600 hover:text-indigo-900"
                                    >Manage</a
                                  >
                                </div>
                                <Menu
                                  as="div"
                                  class="relative inline-block text-left">
                                  <div>
                                    <MenuButton
                                      class="flex items-center rounded-full text-gray-400 hover:text-gray-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100">
                                      <span class="sr-only">Open options</span>
                                      <DotsVerticalIcon
                                        class="h-5 w-5"
                                        aria-hidden="true" />
                                    </MenuButton>
                                  </div>
                                  <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems
                                      class="absolute right-10 z-10 mt-2 w-30 origin-top-right rounded-md bg-white/90 backdrop-fitler backdrop-blur-2xl shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                      <div class="py-1">
                                        <MenuItem v-slot="{ active }">
                                          <a
                                            href="#"
                                            class="items-center text-neutral-400 hover:text-neutral-900"
                                            :class="[
                                              active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                              'block px-4 py-2 text-sm',
                                            ]">
                                            <ArchiveIcon class="inline mr-2 h-5 w-5"/>
                                            Archive</a>
                                          
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                          <a
                                            href="#"
                                           class="items-center text-neutral-400 hover:text-neutral-900"
                                            :class="[
                                              active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                              'block px-4 py-2 text-sm',
                                            ]"
                                            >
                                            <BanIcon class="inline mr-2 h-5 w-5"/>
                                            Mute</a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                          <a
                                            href="#"
                                            class="items-center text-neutral-400 hover:text-neutral-900"
                                            :class="[
                                              active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                              'block px-4 py-2 text-sm',
                                            ]"
                                            >
                                            <TrashIcon class="inline mr-2 h-5 w-5"/>
                                            Remove</a
                                          >
                                        </MenuItem>
                                      </div>
                                    </MenuItems>
                                  </transition>
                                </Menu>

                                <!-- This example requires Tailwind CSS v2.0+ -->
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </TabPanel>
        <TabPanel>Content 2</TabPanel>
      </TabPanels>
    </TabGroup>
  </div>
</template>

<script>
import {
  Listbox,
  ListboxButton,
  ListboxOptions,
  ListboxOption,
  TabGroup,
  TabList,
  Tab,
  TabPanels,
  TabPanel,
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
  Popover,
  PopoverButton,
  PopoverPanel
} from '@headlessui/vue';
import StarRating from 'vue-star-rating';
import {
  DotsVerticalIcon,
  ChevronDownIcon,
  CheckIcon,
  SearchCircleIcon,
  ArchiveIcon,
  DuplicateIcon,
  BanIcon,
  TrashIcon,

} from '@heroicons/vue/solid';
import SocialIcons from '../components/SocialIcons.vue';

const people = [
  { id: 1, name: 'Wade Cooper' },
  { id: 2, name: 'Arlene Mccoy' },
  { id: 3, name: 'Devon Webb' },
  { id: 4, name: 'Tom Cook' },
  { id: 5, name: 'Tanya Fox' },
  { id: 6, name: 'Hellen Schmidt' },
  { id: 7, name: 'Caroline Schultz' },
  { id: 8, name: 'Mason Heaney' },
  { id: 9, name: 'Claudie Smitham' },
  { id: 10, name: 'Emil Schaefer' },
];

export default {
  name: 'CRM',
  components: {
    DuplicateIcon,
    ArchiveIcon,
    TabGroup,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
    StarRating,
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    DotsVerticalIcon,
    ChevronDownIcon,
    CheckIcon,
    SearchCircleIcon,
    SocialIcons,
    Popover,
    PopoverButton,
    PopoverPanel,
    BanIcon,
    TrashIcon,
  },
  data() {
    return {
      stages: [
        { icon: BanIcon, name: 'Interested' },
        { icon: SearchCircleIcon, name: 'Qualified' },]
    
      ,
      creators: [
        {
          id: 1,
          favorite: true,
          network: 'instagram',
          name: 'Martha Hoover',
          firstname: 'Marth',
          lastname: 'Hoover',
          email: 'mhoover@gmail.com',
          rating: '4.3',
          followers: '1.5M',
          offer: '240K',
          stage: 'Onboarding',
          contacted: '1/12/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=1',
        },
        {
          id: 2,
          favorite: false,
          network: 'twitter',
          name: 'Candice Mccoy',
          firstname: 'Candice',
          lastname: 'Mccoy',
          email: 'candicem@gmail.com',
          rating: '3',
          followers: '1.2M',
          offer: '12K',
          stage: 'Onboarding',
          contacted: '1/1e/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=2',
        },
        {
          id: 3,
          favorite: false,
          network: 'youtube',
          name: 'Taylor Smith',
          firstname: 'Taylor',
          lastname: 'Smith',
          email: '',
          rating: '2',
          followers: '1.2K',
          offer: '104K',
          stage: 'Onboarding',
          contacted: '1/1e/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=3',
        },
        {
          id: 4,
          favorite: false,
          network: 'instagram',
          name: 'Taylor Smith',
          firstname: 'Taylor',
          lastname: 'Smith',
          email: '',
          rating: '2',
          followers: '47.2K',
          offer: '900K',
          stage: 'Onboarding',
          contacted: '1/1e/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=3',
        },
        {
          id: 5,
          favorite: false,
          network: 'instagram',
          name: 'Keira Jones',
          firstname: 'Keira',
          lastname: 'Jones',
          email: '',
          rating: '4.9',
          followers: '4.2M',
          offer: '344K',
          stage: 'Negotiating',
          contacted: '3/2/2022',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=5',
        },
        {
          id: 6,
          favorite: false,
          network: 'snapchat',
          name: 'Mila Vance',
          firstname: 'Mila',
          lastname: 'Vance',
          email: '',
          rating: '2.9',
          followers: '1.2K',
          offer: '104K',
          stage: 'Complete',
          contacted: '1/11/2022',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=6',
        },
        {
          id: 7,
          favorite: false,
          network: 'tiktok',
          name: 'Kylie Brent',
          firstname: 'Kylie',
          lastname: 'Brent',
          email: '',
          rating: '1.2',
          followers: '1.2B',
          offer: '10K',
          stage: 'Interested',
          contacted: '4/5/2021',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=7',
        },
        {
          id: 8,
          favorite: false,
          network: 'instagram',
          name: 'Sophia Dustin',
          firstname: 'Sophia',
          lastname: 'Dustin',
          email: '',
          rating: '4.9',
          followers: '4.2M',
          offer: '344K',
          stage: 'Negotiating',
          contacted: '3/2/2022',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=8',
        },
        {
          id: 9,
          favorite: false,
          network: 'snapchat',
          name: 'James Johnson',
          firstname: 'James',
          lastname: 'Johnson',
          email: '',
          rating: '2.9',
          followers: '1.2K',
          offer: '104K',
          stage: 'Complete',
          contacted: '1/11/2022',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=9',
        },
        {
          id: 10,
          favorite: false,
          network: 'instagram',
          name: 'Mike Croft',
          firstname: 'Mike',
          lastname: 'Croft',
          email: '',
          rating: '1.2',
          followers: '1.2B',
          offer: '10K',
          stage: 'Interested',
          contacted: '4/5/2021',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=10',
        },
      ],
    };
  },
};
</script>

<style scoped></style>
