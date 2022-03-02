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
      class="absolute right-0 top-0 z-50 mb-12 -mr-4 -mt-28 h-screen w-192 border-l-4 border-neutral-50 bg-white/40 shadow-xl backdrop-blur-lg backdrop-brightness-150 backdrop-saturate-150 backdrop-filter">
      <div class="mt-4 flex justify-between px-4">
        <div>
          <XIcon class="h-5 w-5 text-neutral-700 hover:text-neutral-900" />
        </div>
        <div class="flex space-x-2 text-xs text-neutral-400">
          <span class="cursor-pointer hover:text-neutral-500">Add to CRM</span>
          <span class="cursor-pointer hover:text-neutral-500">Add to list</span>
          <HeartIcon class="h-5 w-5 cursor-pointer hover:text-neutral-500" />
          <BanIcon class="h-5 w-5 cursor-pointer hover:text-neutral-500" />
        </div>
      </div>
      <div class="absolute -left-80 h-40 w-60 rounded-md border-2 bg-white p-4">
        <input
          type="textarea"
          class="wrap h-24 w-full p-2"
          multiple
          placeholder="Add a note" />
      </div>
      <div class="grid grid-cols-5 py-2 px-4">
        <CreatorAvatar
          as="div"
          class="col-span-1 aspect-square items-center"
          size="lg" />
        <div class="col-span-3 block px-4">
          <div class="text-md font-bold text-neutral-700">Creator Name</div>
          <div class="mt-1 text-2xs font-medium text-neutral-500">
            Creator Bios are long and bording they ramble on and on and never
            seem to get anywhere omg this is so long I can't even finish this
            sentence I can't even finish this paragraph Im so sorry for this
            long sentence
          </div>
          <CreatorTags size="xs" text="Category" />
          <CreatorTags size="xs" color="pink" text="Fashion" />
          <CreatorTags size="xs" color="blue" text="Music" />
          <CreatorTags size="xs" color="green" text="Sports" />
          <div class="mt-2 grid grid-cols-3 border-t">
            <div class="text-center">
              <div class="text-md font-bold">37K</div>
              <div class="text-xs">Followers</div>
            </div>
            <div class="text-center">
              <div class="text-md font-bold">3%</div>
              <div class="text-xs">Engagement</div>
            </div>
            <div class="text-center">
              <div class="text-md font-bold">3.5K</div>
              <div class="text-xs">Engaged Followers</div>
            </div>
          </div>
        </div>
        <div class="col-span-1">
          <div
            class="mx-auto mb-1 inline-flex w-full items-baseline justify-center border-b text-sm text-neutral-400">
            <ChartBarIcon class="mr-1 h-4 w-4" /><span class="text-neutral-500"
              >Social Metrics</span
            >
          </div>
          <div v-for="sociallink in sociallinks" class="flex justify-between">
            <div>
              <img
                height="12"
                width="12"
                class="mx-auto"
                :src="sociallink.url" />
            </div>
            <span class="text-left text-xs text-neutral-500">{{
              sociallink.engagement
            }}</span>

            <span class="text-xs text-neutral-500">{{
              sociallink.followers
            }}</span>
          </div>
        </div>
      </div>

      <div class="border-b"></div>
      <div class="mx-auto mt-2 grid grid-cols-3 justify-center px-4">
        <img
          src="https://picsum.photos/220/300"
          class="mx-auto aspect-square h-60 w-60 justify-center first:rounded-l-lg last:rounded-r-lg" />
        <img
          src="https://picsum.photos/240/300"
          class="mx-auto aspect-square h-60 w-60 justify-center first:rounded-l-lg last:rounded-r-lg" />
        <img
          src="https://picsum.photos/230/300"
          class="mx-auto aspect-square h-60 w-60 justify-center first:rounded-l-lg last:rounded-r-lg" />
      </div>
    </PopoverPanel>
  </transition>
</template>
<script>
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverOverlay,
} from '@headlessui/vue';
import CreatorAvatar from '../Creator/CreatorAvatar.vue';
import CreatorSocialLinks from '../Creator/CreatorSocialLinks.vue';
import { XIcon, HeartIcon, BanIcon, ChartBarIcon } from '@heroicons/vue/solid';
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
    ChartBarIcon,
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
          name: 'Instagram',
          followers: '305K',
          engagement: '2.5%',
          url: 'https://unpkg.com/simple-icons@v6/icons/instagram.svg',
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
