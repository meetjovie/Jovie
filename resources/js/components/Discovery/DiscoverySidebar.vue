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
      class="absolute right-0 top-0 z-50 mb-12 -mr-4 -mt-28 h-screen w-192 bg-white/90 shadow-xl backdrop-blur-xl backdrop-saturate-150 backdrop-filter">
      <div class="mt-4 flex justify-between px-4">
        <div>
          <XIcon class="h-5 w-5 text-neutral-700 hover:text-neutral-900" />
        </div>
        <div>
          <CreatorFavoriteButton />
          <BanIcon />
        </div>
      </div>
      <div class="grid grid-cols-5 py-2 px-4">
        <CreatorAvatar
          as="div"
          class="col-span-1 aspect-square h-40 w-40"
          size="lg" />
        <div class="col-span-3 block px-4">
          <div class="text-md font-bold">Creator Name</div>
          <div class="text-sm">
            Creator Bios are long and bording they ramble on and on and never
            seem to get anywhere omg this is so long I can't even finish this
            sentence I can't even finish this paragraph Im so sorry for this
            long sentence
          </div>
          <CreatorTags size="small" text="Fashion" />
          <CreatorTags size="small" text="Music" />
          <CreatorTags size="small" text="Sports" />
          <div class="grid grid-cols-3 border-t">
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
      </div>

      <div class="border-b"></div>
      <div class="mx-auto grid grid-cols-3 justify-center">
        <div class="aspect-square h-32 w-32 bg-red-500"></div>
        <div class="aspect-square h-32 w-32 bg-red-500"></div>
        <div class="aspect-square h-32 w-32 bg-red-500"></div>
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
import { XIcon, HeartIcon, BanIcon } from '@heroicons/vue/solid';
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
  },
  data() {
    return {
      Popover: {
        open: true,
      },
      currentCreator: {
        name: 'Creator',
        avatar:
          'https://images.unsplash.com/photo-1518791841217-8f162f1e1131?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60',
        tags: ['#tag1', '#tag2'],
        category: '#category',
      },
    };
  },
};
</script>
