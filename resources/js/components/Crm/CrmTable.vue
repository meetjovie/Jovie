<template>
    <div class="overflow-hidden">
        <table class="min-w-full overflow-none overscroll-contain divide-y divide-gray-200">
            <thead class=" bg-gray-50 sticky top-0 ">
            <tr>
                <th
                    scope="col"
                    class="items-center px-2 py-1 text-center text-xs font-medium tracking-wider text-gray-500">
                    <div class="grid grid-cols-2 items-center">
                        <div class="h-5 items-center text-center">
                            <input
                                id="comments"
                                aria-describedby="comments-description"
                                name="comments"
                                type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500"/>
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
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                    </div>
                </th>
                <th
                    scope="col"
                    class="px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
                    Creator
                </th>
                <th
                    scope="col"
                    class="hidden px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 lg:table-cell">
                    First
                </th>
                <th
                    scope="col"
                    class="hidden px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 xl:flex">
                    Last
                </th>
                <th
                    scope="col"
                    class="hidden px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 lg:table-cell">
                    Email
                </th>
                <th
                    scope="col"
                    class="flex items-center px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
                    Followers
                </th>
                <th
                    scope="col"
                    class="hidden px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 lg:table-cell">
                    Offer
                </th>

                <!-- <th scope="col"
                            class="px-2 py-3 text-left text-xs font-medium text-gray-500  tracking-wider">
                            Campaign
                        </th> -->
                <th
                    scope="col"
                    class="hidden px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 md:table-cell">
                    Stage
                </th>
                <th
                    scope="col"
                    class="hidden px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500 xl:table-cell">
                    Contacted
                </th>
                <th
                    scope="col"
                    class="px-2 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
                    Rating
                </th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody class="h-full divide-y divide-gray-200 bg-white">
            <template v-if="loading">
                <tr>
                    <td colspan="11">
                        <div class="flex justify-center items-center">
                            <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full" role="status">
                                <span class="visually-hidden sr-only">Loading...</span>
                            </div>
                        </div>
                    </td>
                </tr>
            </template>
            <template v-else v-for="(creator, index) in creators" :key="creator">
                <template v-for="(network, indexN) in networks" :key="network">
                    <tr v-if="creator[`${network}_meta`] && Object.keys(creator[`${network}_meta`]).length && !creator.crm_record_by_user[`${network}_removed`] &&  (arcvhied ? creator.crm_record_by_user[`${network}_archived`] : !creator.crm_record_by_user[`${network}_archived`])"
                        class="group border-1 border-collapse overflow-y-visible border border-neutral-200 hover:bg-indigo-50 focus-visible:ring-indigo-700">
                        <td
                            class="w-14 whitespace-nowrap px-2 py-1 text-center text-xs font-bold text-gray-300 group-hover:text-neutral-500">
                            <div class="grid grid-cols-2 items-center">
                                <div class="group mr-2">
                                                                      <span class="group-hover:hidden">
                                                                        {{ (indexN + 1) }}
                                                                      </span>
                                    <span class="hidden group-hover:block">
                                                                            <input
                                                                                id="comments-description"
                                                                                aria-describedby="comments-description"
                                                                                name="comments"
                                                                                type="checkbox"
                                                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500"/>
                                                                        </span>
                                </div>
                                <!--                                                                    favourite-->
                                <div class="cursor-pointer"
                                     @click="$emit('updateCreator', {id:creator.id, index: index, network: network, key: `crm_record_by_user.favourite`, value: !creator.crm_record_by_user.favourite})">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        :class="{'text-red-500 fill-red-500' : creator.crm_record_by_user.favourite}"
                                        class="h-6 w-6 hover:fill-red-500 hover:text-red-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </td>
                        <td class="whitespace-nowrap border px-2">
                            <div class="flex items-center">
                                <div class="mr-2 h-8 w-8 flex-shrink-0">
                                    <div class="p-0.5 rounded-full" :class="
                                                                            {'bg-social-youtube/60':network == 'youtube'},
                                                                            {'bg-social-twitter/90' : network == 'twitter'},
                                                                            {'bg-gradient-to-tr from-yellow-500/90 via-fuchsia-500/90 to-purple-500/90' : network == 'instagram'},
                                                                            {'bg-social-snapchat' : network == 'snapchat'},
                                                                            {'bg-gradient-to-l from-pink-700 to-sky-700' : network =='tiktok'}">
                                        <div class="bg-white p-0 rounded-full">
                                            <img
                                                class="rounded-full object-cover object-center"

                                                :src="creator[`${network}_meta`].profile_pic_url"
                                                alt=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <router-link :to="{name: 'Creator Overview', params: {id: creator.id}}"
                                        class="text-xs font-medium text-gray-900">
                                        {{ creator[`${network}_name`] }}
                                    </router-link>
                                </div>
                            </div>
                        </td>
                        <td
                            class="border-1 hidden w-20 border-collapse whitespace-nowrap border lg:table-cell">
                            <div class="text-sm text-gray-900 line-clamp-1">
                                <input
                                    v-model="creator.first_name"
                                    @blur="$emit('updateCreator', {id:creator.id, index: index, network: network, key: `first_name`, value: creator.first_name})"
                                    autocomplete="off"
                                    type="creator-firstname"
                                    name="creator-firstname"
                                    id="creator-firname"
                                    class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                                    placeholder="First"
                                    aria-describedby="email-description"/>
                            </div>
                        </td>
                        <td
                            class="border-1 hidden w-24 border-collapse whitespace-nowrap border xl:table-cell">
                            <div class="text-xs text-gray-900 line-clamp-1">
                                <input
                                    v-model="creator.last_name"
                                    @blur="$emit('updateCreator', {id:creator.id, index: index, network: network, key: `last_name`, value: creator.last_name})"
                                    autocomplete="off"
                                    type="creator-lastname"
                                    name="creator-lastname"
                                    id="creator-lastname"
                                    class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                                    placeholder="Last"
                                    aria-describedby="email-description"/>
                            </div>
                        </td>
                        <td
                            class="border-1 hidden border-collapse whitespace-nowrap border focus-visible:border-indigo-500 lg:table-cell">
                            <div class="text-xs text-gray-700 line-clamp-1">
                                <input
                                    v-model="creator.emails"
                                    @blur="$emit('updateCreator', {id:creator.id, index: index, network: network, key: `emails`, value: creator.emails})"
                                    autocomplete="off"
                                    type="creator-email"
                                    name="creator-email"
                                    id="creator-email"
                                    class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                                    placeholder="creatoremail@gmail.com"
                                    aria-describedby="email-description"/>
                            </div>
                        </td>
                        <td
                            class="border-1 w-14 border-collapse items-center whitespace-nowrap border">
                            <a :href="creator[`${network}_handler`]" target="_blank"
                               class="text-nuetral-800 inline-flex items-center rounded-full  px-3 py-1 text-center justify-between text-xs font-bold">
                                <div
                                    class="mr-2 group-hover:opacity-100 opacity-30 items-center">
                                    <SocialIcons height="14px"
                                                 :icon="network"/>
                                </div>
                                {{ formatCount(creator[`${network}_followers`]) }}
                            </a>
                        </td>
                        <td class="border-1 hidden w-20 border-collapse whitespace-nowrap border lg:table-cell">
                                                      <span
                                                          class="text-nuetral-800 inline-flex items-center rounded-full px-2 text-center text-xs font-bold leading-5">
                                                        $
                                                        <input
                                                            v-model="creator.crm_record_by_user[`${network}_offer`]"
                                                            @blur="$emit('updateCreator', {id:creator.id, index: index, network: network, key: `crm_record_by_user.${network}_offer`, value: creator.crm_record_by_user[`${network}_offer`]})"
                                                            autocomplete="off"
                                                            type="creator-offer"
                                                            name="creator-offer"
                                                            id="creator-offer"
                                                            class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"

                                                            :placeholder="creator.crm_record_by_user[`${network}_suggested_offer`]"
                                                            aria-describedby="email-description"/>
                                                      </span>
                        </td>
                        <!-- <td class="px-2 py-1 border border-collapse border-1 whitespace-nowrap">
                                             <span
                                                 class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-nuetral-800">
                                                   {{creator.campaign}}
                                             </span>
                                </td> -->
                        <td
                            class="border-1 hidden w-32 border-collapse items-center whitespace-nowrap border md:table-cell">
                            <Popover
                                as="div"
                                class="relative inline-block text-left">
                                <PopoverButton
                                    class="group my-0 inline-flex w-32 items-center justify-between rounded-sm bg-blue-100 px-2 py-1 text-xs font-semibold leading-5 text-blue-800">
                                    {{
                                        creator.crm_record_by_user.stage
                                    }}
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="ml-2 h-4 w-4 hover:text-blue-700 group-hover:text-blue-900"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </PopoverButton>
                                <transition
                                    enter-active-class="transition duration-100 ease-out"
                                    enter-from-class="transform scale-95 opacity-0"
                                    enter-to-class="transform scale-100 opacity-100"
                                    leave-active-class="transition duration-75 ease-in"
                                    leave-from-class="transform scale-100 opacity-100"
                                    leave-to-class="transform scale-95 opacity-0">
                                    <PopoverPanel
                                        class="center-0 absolute z-30 w-40 rounded-lg mt-2 origin-top-right divide-y divide-gray-100 bg-white/60 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-md focus-visible:outline-none">
                                        <div class="">
                                            <div class="">
                                                <button
                                                    v-for="(stage, key) in stages"
                                                    @click="$emit('updateCreator', {id:creator.id, index: index, network: network, key: `crm_record_by_user.stage`, value: key})"
                                                    :class="[creator.crm_record_by_user.stage == key ? 'bg-indigo-500 text-neutral-700': 'text-gray-900','flex w-full items-center group first:rounded-t-lg last:rounded-b-lg px-2 py-2 first:pt-2 last:pb-2 text-neutral-700 hover:bg-indigo-700 hover:text-white text-xs']">
                                                    <div
                                                        class="mr-2 font-bold  opacity-50">
                                                        {{ key + 1 }}
                                                    </div>
                                                    <div class="font-bold">
                                                        {{ stage }}
                                                    </div>
                                                </button>
                                            </div>

                                        </div>
                                    </PopoverPanel>
                                </transition>
                            </Popover>
                        </td>
                        <td
                            class="border-1 hidden w-14 border-collapse items-center whitespace-nowrap border text-xs text-gray-500 xl:table-cell">
                            <input
                                v-model="creator.crm_record_by_user.last_contacted"
                                @click="$emit('updateCreator', {id:creator.id, index: index, network: network, key: `crm_record_by_user.last_contacted`, value: !creator.crm_record_by_user.last_contacted})"
                                autocomplete="off"
                                enableTimePicker="false"
                                monthNameFormat="short"
                                data-format="yyyy-MM-dd"
                                autoApply="true"
                                type="datetime-local"
                                :id="creator.id+'_datepicker'"
                                class="block w-full px-2 py-1 placeholder-neutral-300 focus-visible:border-1 bg-white/0 text-xs border-0 text-neutral-500 rounded-md focus:border-1 focus:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500"
                                placeholder="--/--/----"
                                aria-describedby="email-description"/>
                        </td>
                        <td
                            class="W-28 whitespace-nowrap px-6 py-1 text-sm text-gray-500">
                            <star-rating
                                class="w-20"
                                :star-size="12"
                                :increment="0.5"
                                v-model:rating="creator.crm_record_by_user.rating"
                                @update:rating="$emit('updateCreator', {id:creator.id, index: index, network: network, key: `crm_record_by_user.rating`, value: $event})"
                            ></star-rating>
                        </td>
                        <td
                            class="justify-right whitespace-nowrap py-1 text-right text-xs font-medium">
                            <div
                                class="justify-right grid grid-cols-2 items-center gap-4">
                                <div>
                                    <router-link :to="{name: 'Creator Overview', params: {id: creator.id}}" class="text-indigo-600 hover:text-indigo-900">
                                        Manage
                                    </router-link>
                                </div>
                                <Menu as="div"
                                      class="relative inline-block text-left">
                                    <MenuButton
                                        class="flex items-center rounded-full text-gray-400 hover:text-gray-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100">
                                                                                <span
                                                                                    class="sr-only">Open options</span>
                                        <DotsVerticalIcon
                                            class="h-5 w-5 z-0"
                                            aria-hidden="true"/>
                                    </MenuButton>
                                    <transition
                                        enter-active-class="transition ease-out duration-100"
                                        enter-from-class="transform opacity-0 scale-95"
                                        enter-to-class="transform opacity-100 scale-100"
                                        leave-active-class="transition ease-in duration-75"
                                        leave-from-class="transform opacity-100 scale-100"
                                        leave-to-class="transform opacity-0 scale-95">
                                        <MenuItems
                                            class="absolute right-10 z-10 mt-2 w-30 origin-top-right rounded-md bg-white/90 backdrop-fitler backdrop-blur-2xl shadow-lg ring-1 ring-black ring-opacity-5 focus-visible:outline-none">
                                            <div class="py-1">
                                                <MenuItem v-slot="{ active }"
                                                          class="items-center"
                                                          @click="$emit('updateCreator', {id:creator.id, index: index, network: network, key: `crm_record_by_user.muted`, value: !creator.crm_record_by_user.muted})">
                                                    <a
                                                        href="#"
                                                        class="items-center text-neutral-400 hover:text-neutral-900"
                                                        :class="[active  ? 'bg-gray-100 text-gray-900'  : 'text-gray-700','block px-4 py-2 text-sm']">
                                                        <BanIcon
                                                            class="inline mr-2 h-4 w-4"/>
                                                        Mute</a>
                                                </MenuItem>
                                                <MenuItem v-slot="{ active }"
                                                          class="items-center"
                                                          @click="$emit('updateCreator', {id:creator.id, index: index, network: network, key: `crm_record_by_user.${network}_archived`, value: !creator.crm_record_by_user[`${network}_archived`]})">
                                                    <a
                                                        href="#"
                                                        class="items-center text-neutral-400 hover:text-neutral-900"
                                                        :class="[
                                                                                        active
                                                                                        ? 'bg-gray-100 text-gray-900'
                                                                                        : 'text-gray-700',
                                                                                        'block px-4 py-2 text-sm',
                                                                                        ]">
                                                        <ArchiveIcon
                                                            class="inline mr-2 h-4 w-4"/>
                                                        {{ creator.crm_record_by_user[`${network}_archived`] ? 'UnArchived' : 'Archive'}}

                                                    </a>

                                                </MenuItem>
                                                <MenuItem v-slot="{ active }"
                                                          class="items-center"
                                                          @click="$emit('updateCreator', {id:creator.id, index: index, network: network, key: `crm_record_by_user.${network}_removed`, value: !creator.crm_record_by_user[`${network}_removed`]})">
                                                    <a
                                                        href="#"
                                                        class="items-center text-neutral-400 hover:text-neutral-900"
                                                        :class="[active  ? 'bg-gray-100 text-gray-900'  : 'text-gray-700','block px-4 py-2 text-sm']">
                                                        <TrashIcon
                                                            class="inline mr-2 h-4 w-4"/>
                                                        Remove</a
                                                    >
                                                </MenuItem>
                                            </div>
                                        </MenuItems>
                                    </transition>
                                </Menu>

                                <!-- This example requires Tailwind CSS v2.0+ -->
                            </div>
                        </td>
                    </tr>
                </template>
            </template>
            </tbody>
        </table>
        <Pagination
            v-if="creators.length"
            :totalPages="creatorsMeta.last_page"
            :perPage="creatorsMeta.per_page"
            :currentPage="creatorsMeta.current_page"
            :disabled="loading"
            @pagechanged="$emit('pageChanged', $event)"
        />
    </div>
</template>

<script>

import {
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    Popover,
    PopoverButton,
    PopoverPanel
} from '@headlessui/vue';
import StarRating from 'vue-star-rating';
import {
    DotsVerticalIcon,
    ArchiveIcon,
    DuplicateIcon,
    BanIcon,
    TrashIcon,

} from '@heroicons/vue/solid';
import Pagination from '../../components/Pagination';
import SocialIcons from '../../components/SocialIcons.vue';

export default {
    name: "CrmTable",
    components: {
        DuplicateIcon,
        ArchiveIcon,
        StarRating,
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        DotsVerticalIcon,
        SocialIcons,
        Popover,
        PopoverButton,
        PopoverPanel,
        BanIcon,
        TrashIcon,
        Pagination,
    },
    props: ['creators', 'networks', 'stages', 'creatorsMeta', 'loading', 'arcvhied']
}
</script>

<style scoped>

</style>
