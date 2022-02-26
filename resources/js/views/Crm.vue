<template>
    <div id="crm" class="mx-auto w-full min-w-full">
        <TabGroup :defaultIndex="0" as="div">
            <div class="items-bottom flex w-full justify-between border-b bg-white">
                <div>
                    <div class="relative mx-auto w-full rounded sm:hidden">
                        <div class="absolute inset-0 z-0 m-auto mr-4 h-6 w-6">
                            <img
                                class="icon icon-tabler icon-tabler-selector"
                                src=""
                                alt="selector"/>
                        </div>
                    </div>
                    <TabList
                        class="items-bottom hidden h-12 rounded bg-white sm:block xl:mx-0 xl:w-full">
                        <div class="flex h-12 px-5">
                            <Tab v-slot="{ selected }" as="template">
                                <button
                                    class="w-24"
                                    :class="[
                    selected
                      ? 'text-indigo text-sm underline decoration-indigo-700 decoration-4 underline-offset-8'
                      : 'text-sm text-neutral-700',
                  ]">
                                    <span class="mb-3">Creators</span>
                                </button>
                            </Tab>
                            <Tab v-slot="{ selected }" as="template">
                                <button
                                    class="w-24"
                                    :class="[
                    selected
                      ? 'text-indigo text-sm underline decoration-indigo-700 decoration-4 underline-offset-8'
                      : 'text-sm text-neutral-700',
                  ]">
                                    <span class="mb-3">Archived</span>
                                </button>
                            </Tab>
                        </div>
                    </TabList>
                </div>
                <div class="items-center w-60">
                    <Combobox as="div" v-model="filters.list">
                        <div class="relative mt-1 ">
                            <ComboboxInput
                                class="w-full rounded-md border border-gray-300 bg-white py-1 pl-3 pr-10 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                                :displayValue="(list) => (list ? list.name : '')"
                                @change="searchList = $event.target.value"/>
                            <ComboboxButton
                                class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                <ChevronDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
                            </ComboboxButton>

                            <ComboboxOptions v-if="filteredUsersLists.length > 0"  class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                <ComboboxOption v-for="list in filteredUsersLists" :key="list.id" :value="list" as="template"
                                                v-slot="{ active, selected }">
                                    <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-indigo-600 text-white' : 'text-gray-900']">
                                        <span :class="['block truncate', selected && 'font-semibold']">
                                        {{ list.name }}
                                        </span>

                                                                    <span v-if="selected"
                                                                        :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-indigo-600']">
                                        <CheckIcon class="h-5 w-5" aria-hidden="true"/>
                                        </span>
                                    </li>
                                </ComboboxOption>
                            </ComboboxOptions>
                        </div>
                    </Combobox>
                </div>
                <div class="items-center px-2">
                    <Menu as="div" class="relative inline-block items-center text-left">
                       <span class="relative z-0 inline-flex py-1 rounded-md ">
                            <button as="router-link" to="/import" type="button" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white py-2 px-3 text-xs font-medium text-gray-700 hover:bg-indigo-600 hover:text-white focus-visible:z-10 focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500">
                            Add creator
                            </button>
                            <MenuButton as="div" class="-ml-px relative inline-flex items-center px-3 py-2 rounded-r-md border border-gray-300 shadow-sm bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100 focus-visible:ring-indigo-500">
                                <ChevronDownIcon class="h-4 w-4" aria-hidden="true" />
                            </MenuButton>
                        </span>
                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="origin-top-right absolute z-30 right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus-visible:outline-none">
                                <div class="">
                                <MenuItem v-slot="{ active }">
                                    <router-link to="/import" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex first:pt-3 last:pt-3 items-center px-4 py-2 text-sm']">
                                    <CloudUploadIcon class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                    Import a csv
                                    </router-link>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex items-center first:pt-3 last:pt-3 px-4 py-2 text-sm']">
                                    <DownloadIcon class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                    Export a csv
                                    </a>
                                </MenuItem>

                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
            <TabPanels>
                <TabPanel>
                    <div class="mx-auto w-full min-w-full">
                        <div class="w-full">
                            <div class="flex w-full flex-col">
                                <div class="mx-auto w-full p-0">
                                    <div class="inline-block w-full align-middle">
                                        <div
                                            class="overflow-hidden border-b border-gray-200 shadow">
                                                <div v-if="creators.length < 1" class="max-w-7xl items-center py-24 mx-auto px-4 sm:px-6 lg:px-8">
                                                    <div class="max-w-xl mx-auto">
                                                        <button type="button" class="relative block w-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                            </svg>
                                                            <span class="mt-2 block text-sm font-bold text-gray-900"> Select a file to upload </span>
                                                            <span class="mt-2 block text-xs font-medium text-gray-400"> or drag and drop csv files</span>
                                                        </button>
                                                    </div>
                                                </div>

                                            <table class="min-w-full  divide-y divide-gray-200">
                                                <thead class=" bg-gray-50">
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
                                                        class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
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
                                                        class="hidden px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 xl:table-cell">
                                                        Contacted
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
                                                        Rating
                                                    </th>
                                                    <th scope="col" class="relative px-6 py-3">
                                                        <span class="sr-only">Edit</span>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="h-full divide-y divide-gray-200 bg-white">
                                                <template v-for="(creator, index) in creators" :key="creator">
                                                    <template v-for="(network, indexN) in networks" :key="network">
                                                        <tr v-if="creator[`${network}_meta`]"
                                                            class="group border-1 border-collapse overflow-y-visible border border-neutral-200 hover:bg-indigo-50 focus-visible:ring-indigo-700">
                                                            <td
                                                                class="w-14 whitespace-nowrap px-2 py-1 text-center text-xs font-bold text-gray-300 group-hover:text-neutral-500">
                                                                <div class="grid grid-cols-2 items-center">
                                                                    <div class="group mr-2">
                                                                      <span class="group-hover:hidden">
                                                                        {{ indexN+1 }}
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
                                                                    <div class="cursor-pointer" @click="updateCreator(creator, index, creator.crm_record_by_user.favourite)">
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
                                                                        <div
                                                                            class="text-xs font-medium text-gray-900">
                                                                            {{ creator[`${network}_name`] }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="border-1 hidden w-24 border-collapse whitespace-nowrap border lg:table-cell">
                                                                <div class="text-sm text-gray-900 line-clamp-1">
                                                                    <input
                                                                        v-model="creator.first_name"
                                                                        @blur="updateCreator(creator, index)"
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
                                                                class="border-1 hidden w-20 border-collapse whitespace-nowrap border xl:table-cell">
                                                                <div class="text-xs text-gray-900 line-clamp-1">
                                                                    <input
                                                                        v-model="creator.last_name"
                                                                        @blur="updateCreator(creator, index)"
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
                                                                        @blur="updateCreator(creator, index)"
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
                                                            autocomplete="off"
                                                            type="creator-offer"
                                                            name="creator-offer"
                                                            id="creator-offer"
                                                            class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                                                            placeholder="5,000"
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
                                                                            creator.crm_record_by_user[`${network}_stage`]
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
                                                                                        v-for="(stage, index) in stages"
                                                                                        @click="updateCrmCreator(index, `crm_record_by_user.${network}_stage`, stage)"
                                                                                        :class="[creator.crm_record_by_user[`${network}_stage`] == stage ? 'bg-indigo-500 text-neutral-700': 'text-gray-900','flex w-full items-center group first:rounded-t-lg last:rounded-b-lg px-2 py-2 first:pt-2 last:pb-2 text-neutral-700 hover:bg-indigo-700 hover:text-white text-xs']">
                                                                                        <div
                                                                                            class="mr-2 font-bold  opacity-50">
                                                                                            {{ index + 1 }}
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
                                                                    autocomplete="off"
                                                                    type="creator-offer"
                                                                    name="creator-offer"
                                                                    id="creator-offer"
                                                                    class="block w-full bg-white/0 px-2 py-1 placeholder-neutral-300 focus-visible:border-2 focus-visible:border-indigo-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
                                                                    placeholder="--/--/----"
                                                                    aria-describedby="email-description"/>
                                                            </td>
                                                            <td
                                                                class="W-28 whitespace-nowrap px-6 py-1 text-sm text-gray-500">
                                                                <star-rating
                                                                    class="w-20"
                                                                    :star-size="12"
                                                                    :increment="0.5"
                                                                    v-model:rating="creator.rating"></star-rating>
                                                            </td>
                                                            <td
                                                                class="justify-right whitespace-nowrap py-1 text-right text-xs font-medium">
                                                                <div
                                                                    class="justify-right grid grid-cols-2 items-center gap-4">
                                                                    <div>
                                                                        <a
                                                                            href="/creatoroverview"
                                                                            class="text-indigo-600 hover:text-indigo-900"
                                                                        >Manage</a
                                                                        >
                                                                    </div>
                                                                    <Menu as="div" class="relative inline-block text-left">
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
                                                                                    <MenuItem v-slot="{ active }" class="items-center">
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
                                                                                            Archive</a>

                                                                                    </MenuItem>
                                                                                    <MenuItem v-slot="{ active }" class="items-center">
                                                                                        <a
                                                                                            href="#"
                                                                                            class="items-center text-neutral-400 hover:text-neutral-900"
                                                                                            :class="[active  ? 'bg-gray-100 text-gray-900'  : 'text-gray-700','block px-4 py-2 text-sm']">
                                                                                            <BanIcon
                                                                                                class="inline mr-2 h-4 w-4"/>
                                                                                            Mute</a>
                                                                                    </MenuItem>
                                                                                    <MenuItem v-slot="{ active }" class="items-center">
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
                                                @pagechanged="pageChanged"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </TabPanel>
                <TabPanel>Content 2</TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>

<script>
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxOptions,
    ComboboxOption,
    TabGroup,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
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
    ChevronDownIcon,
    DownloadIcon,
    CheckIcon,
    SearchCircleIcon,
    ArchiveIcon,
    DuplicateIcon,
    BanIcon,
    TrashIcon,
    CloudUploadIcon

} from '@heroicons/vue/solid';
import SocialIcons from '../components/SocialIcons.vue';
import UserService from "../services/api/user.service";
import Pagination from '../components/Pagination';
import store from "../store";

export default {
    name: 'CRM',
    components: {
        DuplicateIcon,
        ArchiveIcon,
        DownloadIcon,
        TabGroup,
        TabList,
        Tab,
        TabPanels,
        TabPanel,
        StarRating,
        Combobox,
        ComboboxInput,
        ComboboxButton,
        ComboboxOptions,
        ComboboxOption,
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        DotsVerticalIcon,
        ChevronDownIcon,
        CheckIcon,
        SearchCircleIcon,
        SocialIcons,
        Popover,
        PopoverButton,
        PopoverPanel,
        BanIcon,
        TrashIcon,
        Pagination,
        CloudUploadIcon
    },
    data() {
        return {
            stages: [],
            loading: false,
            creators: [],
            creatorsMeta: {},
            networks: [],
            userLists: [],
            filters: {
                list: null,
                archive: 0,
                page: 1
            },
            searchList: ''
        };
    },
    watch: {
        filters: {
            deep: true,
            handler: function (val) {
                this.getCrmCreators(val)
            }
        }
    },
    computed: {
        filteredUsersLists() {
            if (!this.searchList) this.filters.list = null
            return this.userLists.filter(list => list.name.toLowerCase().match(this.searchList.toLowerCase()))
        }
    },
    mounted() {
        this.getCrmCreators()
        this.getUserLists()
    },
    methods: {
        updateCreator(creator, index, favourite = false) {
            let data = {
                'id': creator.id,
                'first_name': creator.first_name,
                'last_name': creator.last_name,
                'emails': typeof creator.emails === "string" ? creator.emails.split(',') : creator.emails,
                'favourite': favourite === false ? creator.crm_record_by_user.favourite : !favourite
            }
            this.$store.dispatch('updateCreator', data).then(response => {
                response = response.data
                if (response.status) {
                    for (let [key, value] of Object.entries(data)) {
                        if (key == 'favourite') {
                            this.creators[index].crm_record_by_user[key] = value
                        } else {
                            this.creators[index][key] = value
                        }
                    }
                }
            })
        },
        getUserLists() {
            UserService.getUserLists()
                .then(response => {
                    response = response.data
                    if (response.status) {
                        this.userLists = response.lists
                    }
                })
        },
        pageChanged({page}) {
            this.filters.page = page
        },
        getCrmCreators(filters = {}) {
            this.loading = true
            let data = {}
            data.page = filters.page ? filters.page : 1
            data.list = this.filters.list?.id
            UserService.getCrmCreators(data)
                .then(response => {
                    this.loading = false
                    response = response.data
                    if (response.status) {
                        this.creators = response.creators.data
                        delete response.creators.data
                        this.creatorsMeta = response.creators
                        this.filters.page = response.creators.current_page
                        this.networks = response.networks
                        this.stages = response.stages
                    }
                })
        },
        updateCrmCreator(index, key, value) {
            console.log(key);
            let keySplits = key.split('.')
            if (keySplits.length > 1) {
                var key1 = keySplits[0]
                var key2 = keySplits[1]
                let obj = this.creators[index][key1];
                obj[key2] = value
                this.creators[index][key1] = obj
                console.log(this.creators);
            } else {
                this.creators[index][key1] = value
            }
            console.log(this.creators);
        }
    }
};
</script>

<style scoped></style>
