<template>
    <div v-if="user"
        class="items-top flex max-h-screen min-h-screen justify-center overflow-hidden bg-gray-50 px-4 sm:items-center sm:px-6 lg:px-8">
        <div
            class="mt-8 max-w-md items-center space-y-8 pt-8 sm:mt-0">
            <div>
                <img
                    class="block-inline mx-auto mt-0 aspect-square w-48 rounded-full object-cover object-center sm:w-64 2xl:w-80"
                    :src="profilePic"
                    alt=""/>
                <div class="mx-auto mt-6 flex 2xl:mt-12">
                    <h2 class="mx-auto flex text-3xl font-extrabold text-gray-900">
                        {{ user.first_name +' '+user.last_name }}
                        <svg
                            v-if="user.is_verified"
                            xmlns="http://www.w3.org/2000/svg"
                            class="-mr-5 h-5 w-5 text-indigo-600"
                            viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"/>
                        </svg>
                    </h2>
                </div>
                <p class="mt-2 text-center text-sm text-gray-600">
                    {{ user.bio }}
                    <a
                        v-if="user.biolink"
                        :href="user.biolink"
                        class="font-medium text-indigo-600 hover:text-indigo-500">
                        {{ user.biolinktext }}
                    </a>
                </p>
            </div>
            <div class="mt-2 2xl:mt-8" v-if="user.creator_profile">
                <fieldset class="mt-0 2xl:mt-2">
                    <legend class="sr-only">Social links</legend>
                    <div class="flex items-center justify-between gap-2 sm:grid-cols-6">
                        <div
                            v-for="network in networks"
                            :key="network"
                            class="flex cursor-pointer items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase opacity-50 hover:bg-gray-100 hover:opacity-100 focus-visible:outline-none sm:flex-1">
                            <a v-if="user[`show_${network}`]" :href="user.creator_profile[`${network}_handler`]" target="_blank">
                                <SocialIcons height="24px" :icon="network"/>
                                <span class="sr-only">{{ network }}</span>
                            </a>
                        </div>
                    </div>
                </fieldset>
            </div>

            <a :href="user.call_to_action">
                <button
                    type="submit"
                    class="mt-2 mb-0 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                    {{ user.call_to_action_text }}
                </button>
            </a>

            <div class="border-t-2 border-gray-400 opacity-20"></div>
            <router-link
                class="group mt-1 py-4 text-center text-sm text-gray-500"
                to="creators">
                <div class="mx-auto mt-4 flex items-center justify-center text-center">
                    <JovieLogo
                        iconColor="black"
                        height="20px"
                        class="opacity-20 group-hover:opacity-100"/>
                </div>
                <div
                    class="bottom-0 w-full cursor-pointer items-center pb-4 font-semibold text-gray-900 opacity-20 group-hover:opacity-50">
                    Get your profile
                </div>
            </router-link>
        </div>
    </div>
</template>
<script>
import JovieLogo from '../components/JovieLogo.vue';
import ButtonGroup from '../components/ButtonGroup.vue';
import {MailOpenIcon} from '@heroicons/vue/solid';
import store from "../store";
import router from "../router";
import SocialIcons from '../components/SocialIcons'

export default {
    name: 'CreatorProfile',
    components: {JovieLogo, ButtonGroup, MailOpenIcon, SocialIcons},
    props: ['profile', 'socialNetworks'],
    data() {
        return {
            user: null,
            networks: []
        }
    },
    computed: {
        profilePic() {
            if (this.user.profile_pic_url) {
                return this.user.profile_pic_url
            }
            const networkCount = this.networks.length
            let profilePic = null;
            if (this.user.creator_profile) {
                for (let i=0; i<networkCount; i++) {
                    if (profilePic = this.user.creator_profile[`${this.networks[i]}_profile_pic`]) {
                        break
                    }
                }
            }
            if (!profilePic) {
                return this.user.default_image
            }
            return profilePic
        }
    },
    mounted() {
        if (!this.profile) {
            const username = this.$route.params.username
            store.dispatch('getPublicProfile', {username: username}).then(response => {
                if (response.status) {
                    this.user = response.data
                    this.networks = response.networks
                } else {
                    router.push({name: 'Home'})
                }
            }).catch(error => {
                router.push({name: 'Home'})
            })
        } else {
            this.user = this.profile
            this.networks = this.socialNetworks ?? []
        }
    }
};
</script>
