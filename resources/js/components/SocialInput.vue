<template>
  <div>
    <label for="email" class="sr-only">Social Media Profile URL</label>
    <div class="relative mt-1 rounded-md shadow-sm">
      <div
        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <SocialIcons
          v-if="socialMediaProfileUrl.includes('instagram')"
          icon="instagram"
          height="20"
          width="20" />
        <SocialIcons
          v-else-if="socialMediaProfileUrl.includes('facebook')"
          icon="facebook"
          height="20"
          width="20" />
        <SocialIcons
          v-else-if="socialMediaProfileUrl.includes('youtube')"
          icon="youtube"
          height="20"
          width="20" />
        <SocialIcons
          v-else-if="socialMediaProfileUrl.includes('linkedin')"
          icon="linkedin"
          height="20"
          width="20" />
        <SocialIcons
          v-else-if="socialMediaProfileUrl.includes('twitch')"
          icon="twitch"
          height="20"
          width="20" />
        <SocialIcons
          v-else-if="socialMediaProfileUrl.includes('snapchat')"
          icon="snapchat"
          height="20"
          width="20" />

        <SocialIcons
          v-else-if="socialMediaProfileUrl.includes('tiktok')"
          icon="tiktok"
          height="20"
          width="20" />
        <SocialIcons
          v-else-if="socialMediaProfileUrl.includes('twitter')"
          height="20"
          width="20" />
        <UserIcon v-else class="h-5 w-5 text-gray-400" />
      </div>
      <input
        v-model="socialMediaProfileUrl"
        type="social-media-profile-url"
        name="social-media-profile-url"
        id="social-media-profile-url"
        tabindex="1"
        class="border-1 block w-full rounded-md border-indigo-300 py-2 pl-10 placeholder:font-semibold placeholder:text-neutral-400 focus:border-indigo-400 focus:ring-indigo-500 active:border-indigo-500 sm:text-sm"
        placeholder="http://instagram.com/username" />
      <div
        class="group absolute inset-y-0 right-0 flex cursor-pointer py-1.5 pr-3 active:pt-2">
        <kbd
          tabindex="2"
          class="inline-flex select-none items-center rounded border border-indigo-200 px-2 font-sans text-sm font-medium text-indigo-400 focus:bg-indigo-500 focus:text-white active:border-indigo-500 group-hover:border-indigo-400">
          Add to Jovie
        </kbd>
      </div>
    </div>
  </div>
</template>

<script>
import { UserIcon, ClipboardIcon } from '@heroicons/vue/solid';
import SocialIcons from './SocialIcons';

export default {
  components: {
    UserIcon,
    SocialIcons,
    ClipboardIcon,
  },

  props: {
    socialMediaProfileUrl: {
      type: String,
      default: '',
    },
  },
};
</script>
