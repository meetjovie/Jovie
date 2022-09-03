<template>
  <div class="">
    <div class="flex flex-col">
      <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
          <div
            class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
            <table class="min-w-full table-fixed divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 grow-0 items-center border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-1 text-center text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter">
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
                    Name
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter lg:table-cell">
                    First
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter xl:table-cell">
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
                    class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter xl:table-cell">
                    Last Contacted
                  </th>
                  <th
                    scope="col"
                    class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 backdrop-blur backdrop-filter">
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
                  <template
                    v-for="(network, indexN) in networks"
                    :key="network">
                    <tr
                      @click="setCurrentRow(creator, network)"
                      v-if="
                        creator.first_name.includes(searchQuery) &&
                        creator[`${network}_meta`] &&
                        Object.keys(creator[`${network}_meta`]).length &&
                        !creator.crm_record_by_user[`${network}_removed`] &&
                        (archived
                          ? creator.crm_record_by_user[`${network}_archived`]
                          : !creator.crm_record_by_user[`${network}_archived`])
                      "
                      class="border-1 group border-collapse overflow-y-visible border border-neutral-200 hover:bg-indigo-50 focus-visible:ring-indigo-700">
                      <td
                        class="w-20 flex-none overflow-auto whitespace-nowrap px-2 py-1 text-center text-xs font-bold text-gray-300 group-hover:text-neutral-500">
                        <div class="grid grid-cols-2 items-center gap-2">
                          <div class="group mx-auto mr-2">
                            <span class="group-hover:hidden">
                              {{ index + 1 }}
                            </span>
                            <span class="hidden group-hover:block">
                              <input
                                id="comments-description"
                                aria-describedby="comments-description"
                                name="comments"
                                type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500" />
                              <div
                                class="absolute top-0 left-12 flex h-12 items-center space-x-3 bg-gray-50 sm:left-16"></div>
                            </span>
                          </div>
                          <!--                                                                    favourite-->
                          <div
                            class="hidden cursor-pointer lg:block"
                            @click="
                              $emit('updateCreator', {
                                id: creator.id,
                                index: index,
                                network: network,
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
                      <td class="max-w-14 whitespace-nowrap border px-2">
                        <div class="flex items-center">
                          <div class="mr-2 h-8 w-8 flex-shrink-0">
                            <div
                              class="rounded-full p-0.5"
                              :class="[
                                {
                                  'bg-social-youtube/60': network == 'youtube',
                                },
                                { 'bg-social-twitch/90': network == 'twitch' },
                                {
                                  'bg-social-twitter/90': network == 'twitter',
                                },
                                {
                                  'bg-gradient-to-tr from-yellow-500/90 via-fuchsia-500/90 to-purple-500/90':
                                    network == 'instagram',
                                },
                                { 'bg-social-snapchat': network == 'snapchat' },
                                {
                                  'bg-gradient-to-l from-pink-700 to-sky-700':
                                    network == 'tiktok',
                                },
                              ]">
                              <div class="rounded-full bg-white p-0">
                                <img
                                  class="rounded-full object-cover object-center"
                                  :src="
                                    creator[`${network}_meta`]
                                      .profile_pic_url ??
                                    asset('img/noimage.webp')
                                  "
                                  alt="Profile Image" />
                              </div>
                            </div>
                          </div>
                          <div class="">
                            <router-link
                              :to="{
                                name: 'Creator Overview',
                                params: { id: creator.id },
                              }"
                              class="text-xs font-medium text-gray-900">
                              {{ creator[`${network}_name`] }}
                            </router-link>
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
                                network: network,
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
                        class="border-1 hidden w-24 border-collapse whitespace-nowrap border xl:table-cell">
                        <div class="text-xs text-gray-900 line-clamp-1">
                          <input
                            v-model="creator.last_name"
                            @blur="
                              $emit('updateCreator', {
                                id: creator.id,
                                index: index,
                                network: network,
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
                        class="border-1 hidden border-collapse whitespace-nowrap border focus-visible:border-indigo-500 lg:table-cell">
                        <div class="text-xs text-gray-700 line-clamp-1">
                          <input
                            v-model="creator.emails"
                            @blur="
                              $emit('updateCreator', {
                                id: creator.id,
                                index: index,
                                network: network,
                                key: `emails`,
                                value: creator.emails,
                              })
                            "
                            autocomplete="off"
                            type="creator-email"
                            name="creator-email"
                            id="creator-email"
                            class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus:border-indigo-700 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                            placeholder="someone@gmail.com"
                            aria-describedby="email-description" />
                        </div>
                      </td>
                      <td
                        class="border-1 w-4 border-collapse items-center whitespace-nowrap border">
                        <a
                          :href="creator[`${network}_handler`]"
                          target="_blank"
                          class="inline-flex items-center justify-between rounded-full px-3 py-1 text-center text-xs font-bold text-gray-800">
                          <div
                            class="mr-2 items-center opacity-30 group-hover:opacity-100">
                            <SocialIcons height="14px" :icon="network" />
                          </div>
                          {{ formatCount(creator[`${network}_followers`]) }}
                        </a>
                      </td>
                      <td
                        class="border-1 hidden w-20 border-collapse whitespace-nowrap border lg:table-cell">
                        <span
                          class="text-nuetral-800 inline-flex items-center rounded-full px-2 text-center text-xs font-bold leading-5">
                          $
                          <input
                            v-model="
                              creator.crm_record_by_user[`${network}_offer`]
                            "
                            @blur="
                              $emit('updateCreator', {
                                id: creator.id,
                                index: index,
                                network: network,
                                key: `crm_record_by_user.${network}_offer`,
                                value:
                                  creator.crm_record_by_user[
                                    `${network}_offer`
                                  ],
                              })
                            "
                            autocomplete="off"
                            type="creator-offer"
                            name="creator-offer"
                            id="creator-offer"
                            class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                            :placeholder="
                              creator.crm_record_by_user[
                                `${network}_suggested_offer`
                              ]
                            "
                            aria-describedby="email-description" />
                        </span>
                      </td>

                      <td
                        class="border-1 hidden w-32 border-collapse items-center whitespace-nowrap border md:table-cell">
                        <Popover
                          as="div"
                          class="relative inline-block pl-1 text-left">
                          <PopoverButton
                            class="w-18 group my-0 inline-flex items-center justify-between rounded-md px-1 py-0.5 text-2xs font-semibold leading-5"
                            :class="[
                              {
                                'bg-indigo-50 text-indigo-600':
                                  creator.crm_record_by_user.stage ===
                                  'Onboarding',
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
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="ml-2 h-3 w-3 hover:text-blue-700 group-hover:text-blue-900"
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
                              class="center-0 absolute z-30 mt-2 w-40 origin-top-right divide-y divide-gray-100 rounded-lg border border-neutral-200 bg-neutral-50 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-md focus-visible:outline-none">
                              <div class="">
                                <div class="">
                                  <button
                                    v-for="(stage, key) in stages"
                                    @click="
                                      $emit('updateCreator', {
                                        id: creator.id,
                                        index: index,
                                        network: network,
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
                        </Popover>
                      </td>
                      <td
                        class="border-1 hidden w-14 border-collapse items-center whitespace-nowrap border text-xs text-gray-500 xl:table-cell">
                        <input
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
                          placeholder="--/--/----"
                          aria-describedby="email-description" />
                      </td>
                      <td
                        class="W-28 whitespace-nowrap px-6 py-1 text-sm text-gray-500">
                        <star-rating
                          class="w-20"
                          :star-size="12"
                          :increment="0.5"
                          v-model:rating="creator.crm_record_by_user.rating"
                          @update:rating="
                            $emit('updateCreator', {
                              id: creator.id,
                              index: index,
                              network: network,
                              key: `crm_record_by_user.rating`,
                              value: $event,
                            })
                          "></star-rating>
                      </td>
                      <td
                        class="justify-right whitespace-nowrap py-1 text-right text-xs font-medium">
                        <div
                          class="justify-right grid grid-cols-2 items-center gap-4">
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
                                class="w-30 backdrop-fitler absolute right-10 z-10 mt-2 origin-top-right rounded-md bg-white/90 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl focus-visible:outline-none">
                                <div class="py-1">
                                  <MenuItem
                                    v-slot="{ active }"
                                    class="items-center"
                                    @click="
                                      $emit('updateCreator', {
                                        id: creator.id,
                                        index: index,
                                        network: network,
                                        key: `crm_record_by_user.muted`,
                                        value:
                                          !creator.crm_record_by_user.muted,
                                      })
                                    ">
                                    <a
                                      href="#"
                                      class="items-center text-neutral-400 hover:text-neutral-900"
                                      :class="[
                                        active
                                          ? 'bg-gray-100 text-gray-900'
                                          : 'text-gray-700',
                                        'block px-4 py-2 text-sm',
                                      ]">
                                      <NoSymbolIcon
                                        class="mr-2 inline h-4 w-4" />
                                      Mute</a
                                    >
                                  </MenuItem>
                                  <MenuItem
                                    v-slot="{ active }"
                                    @click="
                                      $emit('updateCreator', {
                                        id: creator.id,
                                        index: index,
                                        network: network,
                                        key: `crm_record_by_user.${network}_archived`,
                                        value:
                                          !creator.crm_record_by_user[
                                            `${network}_archived`
                                          ],
                                      })
                                    "
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
                                      <ArchiveBoxIcon
                                        class="mr-2 inline h-4 w-4" />
                                      {{
                                        creator.crm_record_by_user[
                                          `${network}_archived`
                                        ]
                                          ? 'Unarchived'
                                          : 'Archive'
                                      }}
                                    </a>
                                  </MenuItem>
                                  <MenuItem
                                    v-slot="{ active }"
                                    class="items-center"
                                    @click="
                                      $emit('updateCreator', {
                                        id: creator.id,
                                        index: index,
                                        network: network,
                                        key: `crm_record_by_user.${network}_removed`,
                                        value:
                                          !creator.crm_record_by_user[
                                            `${network}_removed`
                                          ],
                                      })
                                    ">
                                    <a
                                      href="#"
                                      class="items-center text-neutral-400 hover:text-neutral-900"
                                      :class="[
                                        active
                                          ? 'bg-gray-100 text-gray-900'
                                          : 'text-gray-700',
                                        'block px-4 py-2 text-sm',
                                      ]">
                                      <TrashIcon class="mr-2 inline h-4 w-4" />
                                      Remove</a
                                    >
                                  </MenuItem>
                                  <MenuItem
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
                          </Menu>

                          <!-- This example requires Tailwind CSS v2.0+ -->
                        </div>
                      </td>
                    </tr>
                  </template>
                </template>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <Pagination
      class="w-full"
      v-if="creators.length"
      :totalPages="creatorsMeta.last_page"
      :perPage="creatorsMeta.per_page"
      :currentPage="creatorsMeta.current_page"
      :disabled="loading"
      @pagechanged="$emit('pageChanged', $event)" />
  </div>
</template>

<script>
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
  NoSymbolIcon,
  TrashIcon,
  ArrowPathIcon,
} from '@heroicons/vue/24/solid';
import Pagination from '../../components/Pagination';
import SocialIcons from '../../components/SocialIcons.vue';
import JovieSpinner from '../../components/JovieSpinner.vue';
import ImportService from '../../services/api/import.service';
import CrmTableSortableHeader from '../CrmTableSortableHeader.vue';

export default {
  name: 'CrmTable',
  components: {
    ArchiveBoxIcon,
    StarRating,
    Menu,
    MenuButton,
    ArrowPathIcon,
    MenuItems,
    MenuItem,
    EllipsisVerticalIcon,
    SocialIcons,
    Popover,
    PopoverButton,
    PopoverPanel,
    NoSymbolIcon,
    TrashIcon,
    Pagination,
    JovieSpinner,
    CrmTableSortableHeader,
  },
  data() {
    return {
      searchQuery: [],
      currentRow: [],
    };
  },
  props: [
    'creators',
    'networks',
    'stages',
    'creatorsMeta',
    'loading',
    'archived',
  ],
  methods: {
    setCurrentRow(row) {
      this.currentRow = row;
      console.log(this.currentRow);
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

<style scoped></style>
