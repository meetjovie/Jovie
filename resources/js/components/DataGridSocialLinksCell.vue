<template>
    <div>
        <div
            v-for="(social, index) in socialLinks"
            :key="social.network"
            class="isolate inline-flex items-center justify-between rounded-full px-1 py-1 text-center text-xs font-bold text-slate-800">
            <div class=".clear-both mx-auto flex-col items-center">
                <div class="mx-auto items-center">
                    <SocialIcons
                        v-if="social.url"
                        :counts-visible="showCount"
                        :linkDisabled="!social.url"
                        class="mx-auto"
                        height="14px"
                        :followers="social.followers ? formatCount(social.followers) : social.followers"
                        setting.isVisable
                        :link="social.url ?? '#'"
                        :icon="social.network" />

                    <div
                        @click="editSocialNetworkURL(social.network)"
                        class="group cursor-pointer text-center"
                        v-else>
                        <SocialIcons
                            :icon="social.network"
                            :class="{
                  'group-hover:hidden': !socialURLEditing[index],
                  'group-hover:block': socialURLEditing[index],
                }"
                            linkDisabled
                            :link="social.url || social.url"
                            height="14"
                            width="14"
                            class="mx-auto block h-4 w-4 cursor-pointer text-slate-400 dark:text-jovieDark-600"
                            aria-hidden="true"
                            :countsVisible="showCount" />

                        <PlusIcon
                            :class="{
                  'group-hover:hidden': socialURLEditing[index],
                  'group-hover:block': !socialURLEditing[index],
                }"
                            class="mx-auto hidden h-4 w-4 cursor-pointer text-slate-700 dark:text-jovieDark-300" />
                    </div>
                </div>
            </div>
        </div>
        <TransitionRoot
            :show="socialURLEditing"
            enter="transition ease-out duration-300"
            enter-from="opacity-0 -translate-y-1/2"
            enter-to="opacity-100 translate-y-0"
            leave="transition ease-in duration-300"
            leave-from="opacity-100 translate-y-0"
            leave-to="opacity-0 -translate-y-1/2">
            <div>
                <SocialInput
                    v-model="socialMediaProfileUrl"
                    :updating="true"
                    @finishImport="saveSocialNetworkURL"
                    @saveSocialNetworkURL="saveSocialNetworkURL()"
                    @cancelEdit="cancelEdit()"
                    minimalDesign />
            </div>
        </TransitionRoot>
    </div>
</template>

<script>
import SocialIcons from "./SocialIcons.vue";
import {
    XMarkIcon,
    PlusIcon,
} from '@heroicons/vue/24/solid';
import SocialInput from "./SocialInput.vue";
import {TransitionRoot} from "@headlessui/vue";
export default {
    name: "DataGridSocialLinksCell",
    components: {
        TransitionRoot,
        SocialInput,
        SocialIcons,
        XMarkIcon,
        PlusIcon,
    },
    props: {
        socialLinks: Array,
        showCount: Boolean,
        contactId: Number,
        row: Number,
    },
    data() {
        return {
            socialURLEditing: false,
            socialMediaProfileUrl: '',
            currentNetwork: null,
        }
    },
    methods: {
        editSocialNetworkURL(network) {
            this.setNetwork(network);
            this.socialURLEditing = true;
            this.$refs.editInput.focus();
        },
        setNetwork(network) {
            this.currentNetwork = network
            if (network == 'instagram') {
                this.socialMediaProfileUrl = 'https://instagram.com/';
            } else if (network == 'twitter') {
                this.socialMediaProfileUrl = 'https://twitter.com/';
            } else if (network == 'linkedin') {
                this.socialMediaProfileUrl = 'https://linkedin.com/in/';
            } else if (network == 'youtube') {
                this.socialMediaProfileUrl = 'https://youtube.com/';
            } else if (network == 'tiktok') {
                this.socialMediaProfileUrl = 'https://tiktok.com/@';
            } else if (network == 'twitch') {
                this.socialMediaProfileUrl = 'https://twitch.tv/';
            } else {
                this.socialMediaProfileUrl = '';
            }
        },
        saveSocialNetworkURL() {
            this.$emit('updateContact', {
                id: this.contactId,
                index: this.row,
                key: `${this.currentNetwork}`,
                value: this.socialMediaProfileUrl,
            })
            this.socialURLEditing = false;
            //notify the user
        },
        cancelEdit() {
            this.socialURLEditing = false;
            //notify the user
            this.$notify({
                group: 'user',
                type: 'error',
                title: 'Link Not Saved',
                text: 'The new social link has not been saved',
            });
        },
    }
}
</script>

<style scoped>

</style>
