<template>
    <PopoverPanel v-slot="{ open }" class="absolute z-50 bg-white/90 backdrop-blur-xl backdrop-saturate-150 shadow-xl backdrop-filter w-192 mb-12 right-0 -mr-4 -mt-28 top-0 h-screen">
                <div class="flex justify-between px-4 mt-4">
                    <div>
                        <XIcon class="h-5 w-5 text-neutral-700 hover:text-neutral-900" />
                    </div>
                    <div>
                       <CreatorFavoriteButton />
                        <BanIcon />
                    </div>
                </div>
                <div class="grid grid-cols-5 py-2 px-4">
                    <CreatorAvatar as="div" class="col-span-1 w-40 h-40 aspect-square" size="lg" />
                    <div class="block col-span-3 px-4">
                        <div class="text-md font-bold">Creator Name</div>
                        <div class="text-sm">Creator Bios are long and bording
                            they ramble on and on and never seem to get anywhere
                            omg this is so long
                            I can't even finish this sentence
                            I can't even finish this paragraph
                            Im so sorry for this long sentence
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
                <div class="grid grid-cols-3 mx-auto justify-center">
                    <div class="bg-red-500 w-32 h-32 aspect-square"></div>
                    <div class="bg-red-500 w-32 h-32 aspect-square"></div>
                    <div class="bg-red-500 w-32 h-32 aspect-square"></div>

                </div>
    </PopoverPanel>
</template>
<script>
import { Popover, PopoverButton, PopoverPanel, PopoverOverlay } from '@headlessui/vue'
import CreatorAvatar from '../Creator/CreatorAvatar.vue'
import CreatorSocialLinks from '../Creator/CreatorSocialLinks.vue'
import { XIcon, HeartIcon, BanIcon } from '@heroicons/vue/solid'
import CreatorTags from '../Creator/CreatorTags.vue'


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
  data () {
      return {
          Popover: {
                open: true,
            },
            currentCreator:
                {
                    name: 'Creator',
                    avatar: 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60',
                    tags: ['#tag1', '#tag2'],
                    category: '#category',
                },
        }
    },
    
}
</script>