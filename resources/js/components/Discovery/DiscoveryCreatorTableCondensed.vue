<template>
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
        <th
          scope="col"
          class="relative px-6 py-3 text-right text-xs font-medium tracking-wider text-gray-500">
          <span class="sr-only">Edit</span>
          <div class="hidden w-60 2xl:block">Showing 50 of 1,500 results</div>
          <div class="hidden w-40 lg:block 2xl:hidden">50 of 1,500</div>
        </th>
      </tr>
    </thead>
    <tbody class="h-full divide-y divide-gray-200 bg-white">
      <tr
        v-for="creator in creators"
        :key="creator"
        class="border-1 group border-collapse overflow-y-visible border border-neutral-200 hover:bg-indigo-50 focus-visible:ring-indigo-700">
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
            <div class="mr-2 h-5 w-5 flex-shrink-0">
              <img
                class="rounded-full border-2 object-cover object-center"
                :src="creator.avatar"
                alt="" />
            </div>
            <div class="">
              <div class="text-xs font-medium text-gray-900">
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
              class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
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
              class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
              placeholder="Last"
              aria-describedby="email-description" />
          </div>
        </td>
        <td
          class="border-1 hidden border-collapse whitespace-nowrap border focus-visible:border-indigo-500 lg:table-cell">
          <div class="text-xs text-gray-700 line-clamp-1">
            <input
              v-model="creator.email"
              autocomplete="off"
              type="creator-email"
              name="creator-email"
              id="creator-email"
              class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
              placeholder="creatoremail@gmail.com"
              aria-describedby="email-description" />
          </div>
        </td>
        <td
          class="border-1 w-14 border-collapse items-center whitespace-nowrap border px-2 py-1">
          <span
            class="text-nuetral-800 inline-flex rounded-full px-2 text-center text-xs font-bold leading-5">
            <div v-if="creator.network === instagram">
              <svg
                class="h-5 w-5"
                role="img"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <title>Instagram</title>
                <path
                  d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
              </svg>
            </div>
            <div v-if="creator.network === tiktok">
              <svg
                class="h-5 w-5"
                role="img"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <title>TikTok</title>
                <path
                  d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
              </svg>
            </div>
            <div v-else></div>
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
              class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
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
          <Menu as="div" class="relative inline-block text-left">
            <div>
              <MenuButton
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
              </MenuButton>
            </div>
            <transition
              enter-active-class="transition duration-100 ease-out"
              enter-from-class="transform scale-95 opacity-0"
              enter-to-class="transform scale-100 opacity-100"
              leave-active-class="transition duration-75 ease-in"
              leave-from-class="transform scale-100 opacity-100"
              leave-to-class="transform scale-95 opacity-0">
              <MenuItems
                class="center-0 absolute z-30 mt-2 w-40 origin-top-right divide-y divide-gray-100 bg-white/90 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-md focus-visible:outline-none">
                <div class="">
                  <MenuItem v-slot="{ active }">
                    <button
                      :class="[
                        active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex w-full items-center  text-xs',
                      ]">
                      <EditIcon
                        :active="active"
                        class="mr-2 h-5 w-5 text-indigo-400"
                        aria-hidden="true" />
                      Interested
                    </button>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <button
                      :class="[
                        active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex w-full items-center text-xs',
                      ]">
                      <DocumentDuplicateIcon
                        :active="active"
                        class="mr-2 h-5 w-5 text-indigo-400"
                        aria-hidden="true" />
                      Not Interested
                    </button>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <button
                      :class="[
                        active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex w-full items-center text-xs',
                      ]">
                      <ArchiveBoxIcon
                        :active="active"
                        class="mr-2 h-5 w-5 text-indigo-400"
                        aria-hidden="true" />
                      Negotiating
                    </button>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <button
                      :class="[
                        active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex w-full items-center  text-xs',
                      ]">
                      <MoveIcon
                        :active="active"
                        class="mr-2 h-5 w-5 text-indigo-400"
                        aria-hidden="true" />
                      Shortlisted
                    </button>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <button
                      :class="[
                        active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex w-full items-center  text-xs',
                      ]">
                      <DeleteIcon
                        :active="active"
                        class="mr-2 h-5 w-5 text-indigo-400"
                        aria-hidden="true" />
                      Back Up
                    </button>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <button
                      :class="[
                        active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex w-full items-center  text-xs',
                      ]">
                      <DeleteIcon
                        :active="active"
                        class="mr-2 h-5 w-5 text-indigo-400"
                        aria-hidden="true" />
                      Participating
                    </button>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <button
                      :class="[
                        active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex w-full items-center  text-xs',
                      ]">
                      <DeleteIcon
                        :active="active"
                        class="mr-2 h-5 w-5 rounded-b-md text-indigo-400"
                        aria-hidden="true" />
                      Complete
                    </button>
                  </MenuItem>
                </div>
              </MenuItems>
            </transition>
          </Menu>
        </td>
        <td
          class="border-1 hidden w-14 border-collapse items-center whitespace-nowrap border text-xs text-gray-500 xl:table-cell">
          <input
            v-model="creator.contacted"
            autocomplete="off"
            type="creator-offer"
            name="creator-offer"
            id="creator-offer"
            class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
            placeholder="--/--/----"
            aria-describedby="email-description" />
        </td>
        <td class="W-28 whitespace-nowrap px-6 py-1 text-sm text-gray-500">
          <star-rating
            class="w-20"
            :star-size="12"
            :increment="0.5"
            v-model:rating="creator.rating"></star-rating>
        </td>
        <td
          class="justify-right whitespace-nowrap py-1 text-right text-xs font-medium">
          <div class="justify-right grid grid-cols-2 items-center gap-4">
            <div>
              <a
                href="/creatoroverview"
                class="text-indigo-600 hover:text-indigo-900"
                >Manage</a
              >
            </div>
            <Menu as="div" class="relative inline-block text-left">
              <div>
                <MenuButton
                  class="flex items-center rounded-full text-gray-400 hover:text-gray-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100">
                  <span class="sr-only">Open options</span>
                  <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true" />
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
                  class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus-visible:outline-none">
                  <div class="py-1">
                    <MenuItem v-slot="{ active }">
                      <a
                        href="#"
                        :class="[
                          active
                            ? 'bg-gray-100 text-gray-900'
                            : 'text-gray-700',
                          'block px-4 py-2 text-sm',
                        ]"
                        >Archive</a
                      >
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <a
                        href="#"
                        :class="[
                          active
                            ? 'bg-gray-100 text-gray-900'
                            : 'text-gray-700',
                          'block px-4 py-2 text-sm',
                        ]"
                        >Mute</a
                      >
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <a
                        href="#"
                        :class="[
                          active
                            ? 'bg-gray-100 text-gray-900'
                            : 'text-gray-700',
                          'block px-4 py-2 text-sm',
                        ]"
                        >Remove</a
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
} from '@headlessui/vue';
import StarRating from 'vue-star-rating';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
import {
  EllipsisVerticalIcon,
  ChevronDownIcon,
  CheckIcon,
  MagnifyingGlassCircleIcon,
} from '@heroicons/vue/24/solid';

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
    EllipsisVerticalIcon,
    ChevronDownIcon,
    CheckIcon,
    MagnifyingGlassCircleIcon,
  },
  data() {
    return {
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
          stage: 'Lead',
          contacted: '1/12/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=1',
        },
        {
          id: 2,
          favorite: false,
          network: 'tiktok',
          name: 'Candice Mccoy',
          firstname: 'Candice',
          lastname: 'Mccoy',
          email: 'candicem@gmail.com',
          rating: '3',
          followers: '1.2M',
          offer: '12K',
          stage: 'Lead',
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
          stage: 'Lead',
          contacted: '1/1e/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=3',
        },
        {
          id: 4,
          favorite: true,
          network: 'instagram',
          name: 'Alessandra Clause',
          firstname: 'Alessandra',
          lastname: 'Clause',
          email: '',
          rating: '5',
          followers: '1.2M',
          offer: '104K',
          stage: 'Lead',
          contacted: '9/1/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=4',
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
          network: 'instagram',
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
          network: 'instagram',
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
          network: 'instagram',
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
