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
        v-on:keyup.enter="add()"
        tabindex="1"
        class="block w-full rounded-md border-2 border-indigo-300 py-3 pl-10 outline-indigo-200 placeholder:font-semibold placeholder:text-neutral-400 focus-visible:border-indigo-400 focus-visible:outline-none focus-visible:ring-indigo-500 active:border-indigo-500 sm:text-sm"
        placeholder="http://instagram.com/username" />
      <p v-if="network && errors[network]" class="mt-2 text-xs text-red-600">
        {{ errors[network][0] }}
      </p>
      <button
        :disabled="adding"
        @click="add()"
        class="group absolute inset-y-0 right-0 flex cursor-pointer py-2 pr-3"
        :class="{ 'disabled:opacity-25': adding }">
        <kbd
          class="inline-flex select-none items-center rounded border border-indigo-200 px-2 py-1 font-sans text-sm font-medium text-indigo-400 focus-visible:border-indigo-300 active:border-indigo-500 active:bg-indigo-500 active:text-white group-hover:border-indigo-400">
          <JovieSpinner v-if="loader" />
          <span v-if="adding">Adding...</span>
          <span v-else
            >Add to <span class="pl-0.5 font-semibold">Jovie</span></span
          >
        </kbd>
      </button>
    </div>
  </div>
  <div class="flex justify-between px-2 text-xs text-neutral-400">
    <div>
      Supports:
      <div class="inline-flex">
        <SocialIcons
          height="10px"
          width="10px"
          link="#"
          class="text-neutral-400"
          icon="twitch" />
        <SocialIcons
          height="10px"
          width="10px"
          link="#"
          class="text-neutral-400"
          icon="instagram" />
      </div>
    </div>
    <div class="flex">
      <router-link class="group items-center" to="Import"
        ><CloudArrowUpIcon
          class="mr-1 inline-flex h-3 w-3 items-center text-neutral-400 group-hover:text-neutral-500"></CloudArrowUpIcon
        ><span class="group-hover:text-neutral-500"
          >Upload a CSV File</span
        ></router-link
      >
    </div>
  </div>
</template>

<script>
import {
  UserIcon,
  ClipboardIcon,
  CloudArrowUpIcon,
} from '@heroicons/vue/24/solid';
import SocialIcons from './SocialIcons';
import ImportService from '../services/api/import.service';
import JovieSpinner from './JovieSpinner.vue';

export default {
  components: {
    UserIcon,
    SocialIcons,
    ClipboardIcon,
    JovieSpinner,
    CloudArrowUpIcon,
  },

  data() {
    return {
      socialMediaProfileUrl: '',
      adding: false,
      loader: false,
      network: null,
      errors: {},
    };
  },
  props: {
    finishedImport: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    add() {
      if (!this.socialMediaProfileUrl) {
        // need to build warning notification
        this.$notify({
          group: 'user',
          type: 'warning',
          title: 'You must enter a valid social url to continue.',
          text: 'Add the full URL of a social profile and try again.',
        });
        return;
      }
      if (!this.validateNetworkUrl(this.socialMediaProfileUrl)) {
        this.$notify({
          group: 'user',
          type: 'error',
          title: 'You must enter a valid social url for supported networks.',
          text: 'Try another url.',
        });
        return;
      }
      this.finishImport();
    },
    validateNetworkUrl(url) {
      // check for insta

      // Regex for verifying an instagram URL
      let regex =
        '(?:(?:http|https)://)?(?:www.)?(?:instagram.com|instagr.am)/([A-Za-z0-9-_]+)?(?:/)?';

      // Verify valid Instagram URL
      if (url.match(regex) && url.match(regex)[1]) {
        this.network = 'instagram';
        return true;
      }

      // Regex for verifying an twitch URL
      regex =
        '(?:(?:http|https)://)?(?:www.)?(?:twitch.tv|twitch.com)/([A-Za-z0-9-_.]+)?(?:/)?';
      // Verify valid Twitch URL
      if (url.match(regex)) {
        this.network = 'twitch';
        return true;
      }

      return false;
    },
    finishImport(mappedColumns = {}) {
      this.adding = true;
      this.loader = true;
      this.errors = [];
      var form = new FormData();
      form.append(this.network, this.socialMediaProfileUrl);
      ImportService.import(form)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              title: 'Import initiated',
              text: 'Your data is being imported.',
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
          this.loader = false;
          //emit event to refresh the table
          this.$emit('finsihedImport', true);
          Object.assign(this.$data, this.$options.data());
        });
    },
  },
};
</script>
