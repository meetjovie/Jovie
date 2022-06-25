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
                    width="20"/>
                <SocialIcons
                    v-else-if="socialMediaProfileUrl.includes('facebook')"
                    icon="facebook"
                    height="20"
                    width="20"/>
                <SocialIcons
                    v-else-if="socialMediaProfileUrl.includes('youtube')"
                    icon="youtube"
                    height="20"
                    width="20"/>
                <SocialIcons
                    v-else-if="socialMediaProfileUrl.includes('linkedin')"
                    icon="linkedin"
                    height="20"
                    width="20"/>
                <SocialIcons
                    v-else-if="socialMediaProfileUrl.includes('twitch')"
                    icon="twitch"
                    height="20"
                    width="20"/>
                <SocialIcons
                    v-else-if="socialMediaProfileUrl.includes('snapchat')"
                    icon="snapchat"
                    height="20"
                    width="20"/>

                <SocialIcons
                    v-else-if="socialMediaProfileUrl.includes('tiktok')"
                    icon="tiktok"
                    height="20"
                    width="20"/>
                <SocialIcons
                    v-else-if="socialMediaProfileUrl.includes('twitter')"
                    height="20"
                    width="20"/>
                <UserIcon v-else class="h-5 w-5 text-gray-400"/>
            </div>
            <input
                v-model="socialMediaProfileUrl"
                type="social-media-profile-url"
                name="social-media-profile-url"
                id="social-media-profile-url"
                tabindex="1"
                class="block w-full rounded-md border-2 border-indigo-300 py-3 pl-10 outline-indigo-200 placeholder:font-semibold placeholder:text-neutral-400 focus:border-indigo-400 focus:outline-none focus:ring-indigo-500 active:border-indigo-500 sm:text-sm"
                placeholder="http://instagram.com/username"/>
            <button
                :disabled="adding"
                @click="add()"
                class="group absolute inset-y-0 right-0 flex cursor-pointer py-2 pr-3" :class="{'disabled:opacity-25' : adding}">
                <kbd
                    tabindex="2"
                    class="inline-flex select-none items-center rounded border border-indigo-200 px-2 font-sans text-sm font-medium text-indigo-400 focus:border-indigo-300 active:border-indigo-500 active:bg-indigo-500 active:text-white group-hover:border-indigo-400">
                    Add to <span class="pl-0.5 font-semibold">Jovie</span>
                </kbd>
            </button>
        </div>
    </div>
    <div class="text-xs text-neutral-400">
        Supports:
        <div class="inline-flex">
            <SocialIcons
                height="10px"
                width="10px"
                class="text-neutral-400"
                icon="twitch"/>
            <SocialIcons
                height="10px"
                width="10px"
                class="text-neutral-400"
                icon="instagram"/>
        </div>
    </div>
</template>

<script>
import {UserIcon, ClipboardIcon} from '@heroicons/vue/solid';
import SocialIcons from './SocialIcons';

export default {
    components: {
        UserIcon,
        SocialIcons,
        ClipboardIcon,
    },

    data() {
        return {
            socialMediaProfileUrl: '',
            adding: false
        }
    },
    methods: {
        add() {
            if (!this.socialMediaProfileUrl) {
                // need to build warning notification
                this.$notify({
                    group: 'user',
                    type: 'warning',
                    title: 'You must enter a url to continue.',
                    text: 'This may take a few minutes.',
                });
                return
            }
            if (!this.validateNetworkUrl(this.socialMediaProfileUrl)) {
                this.$notify({
                    group: 'user',
                    type: 'error',
                    title: 'You must enter a valid url for supported networks.',
                    text: 'Try another url.',
                });
                return
            }
            console.log('adding');
            this.adding = true
            setTimeout(() => {
                this.adding = false
            }, 2000)
        },
        validateNetworkUrl(url) {
            // check for insta

            // Regex for verifying an instagram URL
            let regex = '(?:(?:http|https)://)?(?:www.)?(?:instagram.com|instagr.am)/([A-Za-z0-9-_]+)?(?:/)?'

            // Verify valid Instagram URL
            if (url.match(regex) && url.match(regex)[1]) {
                return true
            }

            // Regex for verifying an twitch URL
            regex = '(?:(?:http|https)://)?(?:www.)?(?:twitch.tv|twitch.com)/([A-Za-z0-9-_.]+)?(?:/)?'
            // Verify valid Twitch URL
            if (url.match(regex) ) {
                return true
            }

            return false;
        }
    }
};
</script>
