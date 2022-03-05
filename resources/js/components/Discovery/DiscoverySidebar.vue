<template>
  <transition
    enter-active-class="transition duration-300 ease-out"
    enter-from-class="translate-x-48 opacity-95"
    enter-to-class="translate-x-0 opacity-100"
    leave-active-class="transition duration-150 ease-in"
    leave-from-class="scale-100 opacity-100"
    leave-to-class="scale-95 opacity-0">
    <PopoverPanel
      v-slot="{ open }"
      class="absolute right-0 top-0 z-50 mb-12 -mr-4 -mt-28 h-screen w-192 border border-neutral-200 bg-white/60 bg-clip-padding shadow-xl backdrop-blur-xl backdrop-brightness-150 backdrop-saturate-150 backdrop-filter">
      <div class="mt-4 flex justify-between px-4">
        <div>
          <XIcon class="h-5 w-5 text-neutral-700 hover:text-neutral-900" />
        </div>
        <div class="mr-4 flex space-x-2 text-xs text-neutral-400">
          <HeartIcon class="h-5 w-5 cursor-pointer hover:text-neutral-500" />
          <BanIcon class="h-5 w-5 cursor-pointer hover:text-neutral-500" />
          <div class="fixed top-4 text-right">
            <Menu as="div" class="relative z-20 inline-block text-left">
              <div>
                <MenuButton
                  class="inline-flex w-full justify-center rounded-md text-sm font-medium text-neutral-700 hover:text-neutral-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                  <DotsVerticalIcon
                    class="-mr-24 h-5 w-5 text-neutral-400 hover:text-neutral-700"
                    aria-hidden="true" />
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
                  class="absolute -right-12 z-50 mt-2 w-40 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus-visible:outline-none">
                  <div class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                      <button
                        :class="[
                          active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                          'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                        ]">
                        <UserIcon
                          :active="active"
                          class="mr-2 h-5 w-5 text-indigo-400"
                          aria-hidden="true" />
                        Add to CRM
                      </button>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <button
                        :class="[
                          active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                          'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                        ]">
                        <PlusIcon
                          :active="active"
                          class="mr-2 h-5 w-5 text-indigo-400"
                          aria-hidden="true" />
                        Add to list
                      </button>
                    </MenuItem>
                  </div>
                </MenuItems>
              </transition>
            </Menu>
          </div>
        </div>
      </div>
      <!--  <div class="absolute -left-60 h-40 w-60 rounded-md border-2 bg-white p-4">
        <input
          type="textarea"
          class="wrap h-24 w-full p-2"
          multiple
          placeholder="Add a note" />
      </div> -->
      <div class="grid grid-cols-5 py-2 px-4">
        <CreatorAvatar
          as="div"
          class="col-span-1 aspect-square items-center"
          size="lg" />
        <div class="col-span-3 block pr-6 pl-8">
          <div
            class="text-md relative z-10 inline-flex items-center font-bold text-neutral-700">
            <img
              src="https://unpkg.com/simple-icons@v6/icons/instagram.svg"
              class="relative mr-1 h-3 w-3 opacity-50" />
            <span class="-mt-0.5">Creator Name</span>
          </div>
          <div class="mt-1 text-xs font-medium text-neutral-500">
            Creator Bios are long and bording they ramble on and on and never
            seem to get anywhere omg this is so long I can't even finish this
            sentence I can't even finish this paragraph Im so sorry for this
            long sentence
          </div>
          <div>
            <CreatorTags size="sm" text="Category" />
            <CreatorTags size="sm" color="pink" text="Fashion" />
            <CreatorTags size="sm" color="blue" text="Music" />
            <CreatorTags size="sm" color="green" text="Sports" />
          </div>
          <div class="mx-auto mt-2 flex justify-start space-x-6">
            <CreatorSocialLinks iconstyle="horizontal" />
          </div>
        </div>
        <div class="col-span-1">
          <div
            class="mx-auto mt-6 inline-flex w-full items-center justify-center text-center text-neutral-400">
            <LocationMarkerIcon class="mr-1 h-4 w-4" /><span
              class="text-xs font-bold text-neutral-500"
              >New York, NY</span
            >
          </div>
          <div
            class="mx-auto inline-flex w-full justify-center text-sm text-neutral-400">
            <div class="mt-1 grid grid-cols-2 gap-4 border-neutral-200 pt-1">
              <div class="text-center">
                <div class="text-sm font-bold text-neutral-600">37K</div>
                <div class="text-[8px] text-neutral-400">Followers</div>
              </div>
              <div class="text-center">
                <div class="text-sm font-bold text-neutral-600">3%</div>
                <div class="text-[8px] text-neutral-400">Engagement</div>
              </div>
              <div class="text-center">
                <div class="text-sm font-bold text-neutral-600">3.5K</div>
                <div class="text-[8px] text-neutral-400">EF</div>
              </div>
              <div class="text-center">
                <div class="text-sm font-bold text-neutral-600">$0.50</div>
                <div class="text-[8px] text-neutral-400">CPE</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="border-b px-4"></div>
      <CreatorContentBar />
    </PopoverPanel>
  </transition>
</template>
<script>
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverOverlay,
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
} from '@headlessui/vue';
import CreatorAvatar from '../Creator/CreatorAvatar.vue';
import CreatorContentBar from '../Creator/CreatorContentBar.vue';
import CreatorSocialLinks from '../Creator/CreatorSocialLinks.vue';
import {
  XIcon,
  HeartIcon,
  BanIcon,
  ChartBarIcon,
  ChevronRightIcon,
  DotsVerticalIcon,
  ChevronDownIcon,
  ArchiveIcon,
  DuplicateIcon,
  PlusIcon,
  UserIcon,
  ThumbUpIcon,
  PlayIcon,
  ChatAlt2Icon,
  LocationMarkerIcon,
} from '@heroicons/vue/solid';
import CreatorTags from '../Creator/CreatorTags.vue';

export default {
  components: {
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverOverlay,
    CreatorAvatar,
    CreatorSocialLinks,
    XIcon,
    CreatorTags,
    HeartIcon,
    BanIcon,

    DotsVerticalIcon,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,

    PlusIcon,
    UserIcon,
    ThumbUpIcon,
    PlayIcon,
    ChatAlt2Icon,
    LocationMarkerIcon,
    CreatorContentBar,
  },
  data() {
    return {
      open: true,
      sociallinks: [
        {
          name: 'Facebook',
          followers: '1.5K',
          engagement: '3%',
          url: 'https://unpkg.com/simple-icons@v6/icons/facebook.svg',
        },
        {
          name: 'Twitter',
          followers: '13.2M',
          engagement: '3.5%',
          url: 'https://unpkg.com/simple-icons@v6/icons/twitter.svg',
        },
        {
          name: 'YouTube',
          followers: '1.5M',
          engagement: '4.5%',
          url: 'https://unpkg.com/simple-icons@v6/icons/youtube.svg',
        },
        {
          name: 'Tiktok',
          followers: '1.5K',
          engagement: '3%',
          url: 'https://unpkg.com/simple-icons@v6/icons/tiktok.svg',
        },
      ],
    };
  },
};
</script>
