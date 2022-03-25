<template>
  <div>
    <ais-instant-search
      :search-client="searchClient"
      placeholderSearch="*"
      index-name="creators">
      <div class="min-h-screen bg-gray-100">
        <div class="">
          <div class="mx-auto flex">
            <div
              v-if="searchopen"
              class="z-10 hidden w-60 shrink-0 bg-neutral-50 shadow-lg lg:flex">
              <nav
                aria-label="Searchbar"
                class="min-h-screen divide-y divide-gray-300">
                <transition
                  enter-active-class="transition duration-300 ease-out"
                  enter-from-class="-translate-x-48 opacity-95"
                  enter-to-class="translate-x-0 opacity-100"
                  leave-active-class="transition duration-300 ease-in"
                  leave-from-class="scale-100 opacity-100"
                  leave-to-class="scale-95 opacity-0">
                  <DiscoverySearch :searchopen="searchopen"></DiscoverySearch>
                </transition>
              </nav>
            </div>
            <main class="flex-auto">
              <button @click="searchopen = !searchopen">
                <ChevronLeftIcon
                  v-if="searchopen"
                  class="ml-2 mt-1 h-5 w-5 text-gray-700 hover:text-indigo-700"
                  :class="{ 'text-indigo-700': searchopen }"
                  aria-hidden="true"></ChevronLeftIcon>
                <FilterIcon
                  v-if="searchopen == false"
                  class="ml-2 mt-1 h-5 w-5 text-gray-700 hover:text-indigo-700"></FilterIcon>
              </button>

              <DiscoveryStats></DiscoveryStats>
              <TabGroup :defaultIndex="0">
                <DiscoveryToolbar class="px-4"></DiscoveryToolbar>
                <div
                  class="min-w-full items-center divide-y divide-gray-200 overflow-y-scroll overscroll-contain">
                  <div
                    class="sticky top-0 flex justify-between bg-gray-50/90 backdrop-blur-2xl backdrop-saturate-150">
                    <div
                      scope="col"
                      class="hidden items-center px-2 py-1 text-center text-xs font-medium tracking-wider text-gray-500 lg:inline-flex">
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
                      <div class="sticky top-0 mx-auto items-center">
                        <ais-search-box
                          as="div"
                          class="mx-auto mt-1"
                          placeholder="Search for a creator,
      hashtag, or keyword..."
                          submit-title="Let's go!"
                          reset-title="Reset"
                          autofocus="true"
                          show-loading-indicator="true">
                          <template
                            v-slot="{
                              currentRefinement,
                              isSearchStalled,
                              refine,
                            }">
                            <div class="relative mt-1 flex items-center py-1">
                              <input
                                class="block w-96 rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                submit-title="Let's go!"
                                reset-title="Reset"
                                autofocus="true"
                                type="search"
                                placeholder="Search for a creator, hashtag, or keyword..."
                                :value="currentRefinement"
                                @input="refine($event.currentTarget.value)" />
                              <div
                                class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                <span
                                  mclass="-mr-14"
                                  :hidden="!isSearchStalled">
                                  <kbd
                                    class="inline-flex items-center px-2 font-sans text-sm font-medium text-gray-400">
                                    <JovieSpinner />
                                  </kbd>
                                </span>
                              </div>
                            </div>
                          </template>
                        </ais-search-box>
                      </div>
                    </div>

                    <div
                      class="relative px-6 py-3 text-right text-xs font-medium tracking-wider text-gray-500">
                      <!--  Hide results count until a search is performed -->
                      <div class="hidden w-60 2xl:block">
                        <ais-stats />
                      </div>
                      <div class="hidden w-40 lg:block 2xl:hidden">
                        <ais-stats />
                      </div>
                    </div>
                  </div>
                </div>
                <ais-infinite-hits :cache="cache">
                  <template v-slot:item="{ item }">
                    <div class="h-full divide-y divide-gray-200 bg-white">
                      <div
                        class="group border-1 flex border-collapse flex-row items-center overflow-y-visible border border-neutral-200 hover:bg-indigo-50 focus-visible:ring-indigo-700">
                        <div
                          class="mx-auto hidden flex-none items-center justify-between whitespace-nowrap py-1 px-4 text-center text-xs font-bold text-gray-300 group-hover:text-neutral-500 lg:table-cell">
                          <div class="mx-auto grid grid-cols-2 items-center">
                            <div class="group mx-auto">
                              <span class="mx-auto group-hover:hidden">
                                {{ item.id }}
                              </span>
                              <span class="mx-auto hidden group-hover:block">
                                <input
                                  id="comments-description"
                                  aria-describedby="comments-description"
                                  name="comments"
                                  type="checkbox"
                                  class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500" />
                              </span>
                            </div>
                            <div class="mx-auto">
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
                        </div>
                        <div
                          class="w-96 flex-none justify-center border-l px-4 py-1 xl:w-128">
                          <div class="flex items-center">
                            <div class="mr-2 h-24 w-24 flex-shrink-0">
                              <div class="rounded-full bg-neutral-200 p-0.5">
                                <img
                                  class="rounded-full object-cover object-center"
                                  :src="item.instagram_meta.profile_pic_url"
                                  alt="" />
                              </div>

                              <!--  <div class="mr-2 h-24 w-24 flex-shrink-0">
                                <img
                                    class="rounded-full border-2 object-cover object-center"
                                    :src="item.avatar"
                                    alt="" /> -->
                            </div>
                            <div class="w-96">
                              <div
                                class="flex text-xs font-medium text-gray-900">
                                {{ item.name }}
                                <div class="text-white">
                                  <svg
                                    v-if="item.instagram_is_verified"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-3 w-3"
                                    fill="indigo"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                  </svg>
                                </div>
                              </div>
                              <div
                                class="wrap -mt-1 h-14 text-2xs font-light text-gray-900">
                                <p class="line-clamp-2">
                                  {{ item.biography }}
                                </p>
                              </div>
                              <div
                                class="pt-.05 pb-1 text-xs font-medium text-gray-900">
                                <CreatorTags
                                  v-if="item.instagram_category"
                                  size="xs"
                                  color="none"
                                  :text="item.instagram_category" />
                                <!-- <CreatorTags
                                  v-if="item.tags > 0"
                                  size="xs"
                                  color="purple"
                                  :text="item.tags[1]" />
                                <CreatorTags
                                  size="xs"
                                  color="blue"
                                  text="Music" />
                                <CreatorTags
                                  size="xs"
                                  color="pink"
                                  text="Other" /> -->
                              </div>
                              <CreatorSocialLinks class="mt-1" />
                            </div>
                          </div>
                        </div>
                        <div class="grow items-center whitespace-nowrap px-4">
                          <div
                            class="grid w-24 grid-cols-1 lg:w-48 lg:grid-cols-2 xl:w-72 xl:grid-cols-3">
                            <img
                              v-for="media in item.instagram_media"
                              :key="media"
                              class="only-child:rounded-md aspect-square h-24 w-24 object-cover object-center first:rounded-l-md last:rounded-r-md"
                              :src="media.display_url" />
                          </div>
                        </div>
                        <div
                          class="border-1 mx-auto w-24 border-collapse border-r xl:w-48 2xl:w-72">
                          <div
                            class="grid text-center xl:grid-cols-2 2xl:grid-cols-3">
                            <div>
                              <div class="font-bold">
                                {{ formatCount(item.instagram_followers) }}
                              </div>
                              <div class="text-[8px] text-neutral-500">
                                Followers
                              </div>
                            </div>

                            <div class="hidden xl:block">
                              <div class="font-bold">
                                {{
                                  formatCount(item.instagram_engagement_rate)
                                }}
                              </div>
                              <div class="text-[8px] text-neutral-500">ER%</div>
                            </div>
                            <div class="hidden 2xl:block">
                              <div class="font-bold">
                                {{
                                  formatCount(
                                    item.instagram_meta.engaged_follows
                                  )
                                }}
                              </div>
                              <div class="text-[8px] text-neutral-500">EF</div>
                            </div>
                          </div>
                        </div>
                        <div
                          class="mx-auto grid grow grid-cols-2 items-center justify-between">
                          <div
                            class="W-28 mx-auto flex-grow px-6 py-1 text-sm text-gray-500">
                            <star-rating
                              class="w-20"
                              :star-size="12"
                              :increment="0.5"
                              v-model:rating="item.rating"></star-rating>
                          </div>
                          <div
                            class="justify-self-right mx-auto py-1 text-right text-xs font-medium">
                            <div class="mx-auto items-center gap-4">
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
                          </div>
                        </div>
                      </div>
                    </div>
                  </template>
                </ais-infinite-hits>
              </TabGroup>
            </main>
          </div>
        </div>
      </div>
    </ais-instant-search>
  </div>
</template>

<script>
import DiscoverySearch from '../components/Discovery/DiscoverySearch.vue';
import { instantMeiliSearch } from '@meilisearch/instant-meilisearch';
import InputGroup from '../components/InputGroup.vue';
import { TabGroup } from '@headlessui/vue';
import StarRating from 'vue-star-rating';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
import {
  DotsVerticalIcon,
  ChevronDownIcon,
  ChevronUpIcon,
  FilterIcon,
  ChevronLeftIcon,
  SearchIcon,
} from '@heroicons/vue/solid';
import CreatorTags from '../components/Creator/CreatorTags';
import CreatorSocialLinks from '../components/Creator/CreatorSocialLinks';
import DiscoveryCreatorTable from '../components/Discovery/DiscoveryCreatorTable.vue';
import DiscoverySidebar from '../components/Discovery/DiscoverySidebar.vue';
import DiscoveryMain from '../components/Discovery/DiscoveryMain.vue';
import DiscoveryStats from '../components/Discovery/DiscoveryStats.vue';
import DiscoveryToolbar from '../components/Discovery/DiscoveryToolbar.vue';
import { createInfiniteHitsSessionStorageCache } from 'instantsearch.js/es/lib/infiniteHitsCache';
import JovieSpinner from '../components/JovieSpinner.vue';

export default {
  components: {
    instantMeiliSearch,
    InputGroup,
    JovieSpinner,

    DiscoveryStats,
    DiscoveryToolbar,
    FilterIcon,
    ChevronLeftIcon,

    DiscoverySearch,
    TabGroup,
    StarRating,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    DotsVerticalIcon,
    ChevronDownIcon,
    SearchIcon,
    CreatorTags,
    CreatorSocialLinks,
    ChevronUpIcon,
  },
  data() {
    return {
      cache: createInfiniteHitsSessionStorageCache(),
      creators: [
        {
          id: 1,
          favorite: true,
          network: 'instagram',
          name: 'Martha Hoover',
          bio: "hello from the otherside. I'm a great person",
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
          timeline1: 'https://i.pravatar.cc/150?img=1',
          timeline2: 'https://i.pravatar.cc/150?img=2',
          timeline3: 'https://i.pravatar.cc/150?img=3',
        },
        {
          id: 2,
          favorite: false,
          network: 'tiktok',
          name: 'Candice Mccoy',
          bio: 'Candice Mccoy is a professional photographer and videographer. She has worked for a variety of clients, including the US Department of Agriculture, the US Department of Homeland Security, and the US Department of Education. She has also worked for a variety of clients, including the US Department of Agriculture, the US Department of Homeland Security, and the US Department of Education.',
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
          bio: 'Taylor Smith is a YouTube channel owner and founder of the YouTube channel Taylor Smith.',
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
          favorite: true,
          network: 'instagram',
          name: 'Alessandra Clause',
          bio: 'get the best of both worlds',
          firstname: 'Alessandra',
          lastname: 'Clause',
          email: '',
          rating: '5',
          followers: '1.2M',
          offer: '104K',
          stage: 'Onboarding',
          contacted: '9/1/2020',
          campaign: 'Zelf Beta',
          avatar: 'https://i.pravatar.cc/150?img=4',
        },
        {
          id: 5,
          favorite: false,
          network: 'instagram',
          name: 'Keira Jones',
          bio: 'Some time in the future when the world is a better place, I will be able to create a new reality.',
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
          bio: 'Let us be friends in the dark',
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
          bio: "When you're not in the spotlight, you're in the spotlight",
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
          bio: "let's talk about the future. Then we'll talk about the past. Finally, we'll talk about the present.",
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
          bio: 'Everyones favorite is not me but me',
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
          bio: 'Welcome to the real world she said to me',
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
      searchClient: instantMeiliSearch(
        process.env.MIX_MEILISEARCH_HOST,
        process.env.MIX_MEILISEARCH_KEY,
        {
          placeholderSearch: true, // default: true.
          primaryKey: 'id', // default: undefined
          // ...
        }
      ),
    };
  },
};
</script>
