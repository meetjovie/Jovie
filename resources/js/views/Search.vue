<template>
    <div>
        <ais-instant-search
            :search-client="searchClient"
            :search-function="searchFunction"
            placeholderSearch=""
            index-name="creators">
            <div class="min-h-screen bg-gray-100">
                <div class="">
                    <div class="mx-auto flex">
                        <div
                            v-if="searchopen"
                            class="z-10 hidden w-60 shrink-0 bg-neutral-50 shadow-lg lg:flex">
                            <nav
                                aria-label="Searchbar"
                                class="min-h-screen divide-y divide-gray-300">
                                <transition
                                    enter-active-class="transition duration-300 ease-out"
                                    enter-from-class="-translate-x-48 opacity-95"
                                    enter-to-class="translate-x-0 opacity-100"
                                    leave-active-class="transition duration-300 ease-in"
                                    leave-from-class="scale-100 opacity-100"
                                    leave-to-class="scale-95 opacity-0">
                                    <DiscoverySearch :searchopen="searchopen"></DiscoverySearch>
                                </transition>
                            </nav>
                        </div>
                        <main class="flex-auto">
                            <!--  <DiscoveryStats></DiscoveryStats> -->
                            <TabGroup :defaultIndex="0">
                                 <DiscoveryToolbar
                                     class="px-4">
                                 </DiscoveryToolbar>

                                <div
                                    class="sticky top-0 min-w-full items-center divide-y divide-gray-200 overflow-y-scroll">
                                    <div
                                        class="sticky top-0 z-10 flex grid grid-cols-3 items-center justify-between bg-gray-50/90 backdrop-blur-2xl backdrop-saturate-150">
                                        <div
                                            scope="col"
                                            class="hidden items-center px-2 py-1 text-center text-xs font-medium tracking-wider text-gray-500 lg:inline-flex">
                                            <div class="grid grid-cols-2 items-center">
                                                <button @click="searchopen = !searchopen">
                                                    <ChevronLeftIcon
                                                        v-if="searchopen"
                                                        class="ml-2 mt-0.5 h-5 w-5 text-gray-400 hover:text-indigo-700"
                                                        :class="{ 'text-indigo-700': searchopen }"
                                                        aria-hidden="true"></ChevronLeftIcon>
                                                    <FilterIcon
                                                        v-if="searchopen == false"
                                                        class="mx-2 mt-0.5 h-5 w-5 text-gray-400 hover:text-indigo-700"></FilterIcon>
                                                </button>
                                                <div class="h-5 items-center text-center">
                                                    <!--  <input
                                                                                id="comments"
                                                                                aria-describedby="comments-description"
                                                                                name="comments"
                                                                                type="checkbox"
                                                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500" /> -->
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
                                        </div>
                                        <div
                                            class="sticky top-0 mx-auto w-full items-center text-center">
                                            <div class="mx-auto inline-flex w-full items-center">
                                                <SearchIcon
                                                    class="mr-1 mt-0.5 inline-flex h-7 w-7 text-gray-400"
                                                    aria-hidden="true"></SearchIcon>
                                                <ais-search-box
                                                    as="div"
                                                    class="mx-auto mt-1 w-full border-0 outline-0 ring-0 focus:outline-none"
                                                    placeholder="Search for a creator,
      hashtag, or keyword..."
                                                    submit-title="Let's go!"
                                                    reset-title="Reset"
                                                    autofocus="true"
                                                    show-loading-indicator="true">
                                                    <template
                                                        v-slot="{
                              currentRefinement,
                              isSearchStalled,
                              refine,
                            }">
                                                        <div
                                                            class="relative mx-auto mt-1 flex w-full items-center py-1">
                                                            <AppDebouncedSearchBox :delay="200"/>
                                                            <!-- <input
                                                              class="flex-auto rounded-md border-0 bg-white/0 py-2 text-base leading-6 text-gray-500 placeholder-gray-500 outline-0 ring-0 focus-visible:border-0 focus-visible:placeholder-gray-400 focus-visible:outline-none focus-visible:outline-none focus-visible:ring-0"
                                                              submit-title="Let's go!"
                                                              reset-title="Reset"
                                                              autofocus="true"
                                                              type="search"
                                                              placeholder="Search for a creator, hashtag, or keyword..."
                                                              :value="currentRefinement"
                                                              @input="refine($event.currentTarget.value)" /> -->

                                                            <div
                                                                class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                <span
                                    mclass="-mr-14"
                                    :hidden="!isSearchStalled">
                                  <kbd
                                      class="inline-flex items-center px-2 font-sans text-sm font-medium text-gray-400">
                                    <JovieSpinner/>
                                  </kbd>
                                </span>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </ais-search-box>
                                            </div>
                                        </div>
                                        <div
                                            class="justfy-right relative items-center px-6 py-3 text-right text-xs font-medium tracking-wider text-gray-500">
                                            <!--  Hide results count until a search is performed -->
                                            <div
                                                class="justify-right hidden w-full items-center lg:block">
                                                <div class="justify-right inline-flex items-center">
                                                    <div class="">
                                                        <ais-stats>
                                                            <template v-slot="{ nbHits, processingTimeMS }">
                                                                {{ nbHits }} creators
                                                                <br/>
                                                                <div
                                                                    class="inline-flex items-center text-2xs text-neutral-400">
                                                                    <div class="group">
                                                                        <JovieTooltip text="Search speed"/>

                                                                        <LightningBoltIcon
                                                                            class="mr-1 h-3 w-3 text-neutral-400 hover:text-indigo-400"></LightningBoltIcon>
                                                                    </div>
                                                                    <span>
                                    {{ (processingTimeMS / 1000).toFixed(1) }}
                                    Seconds</span
                                                                    >
                                                                </div>
                                                            </template>
                                                        </ais-stats>
                                                    </div>
                                                    <div class="">
                                                        <ChevronRightIcon
                                                            @click="toggleSidebar"
                                                            class="mx-2 mt-0.5 h-5 w-5 cursor-pointer text-gray-400 hover:text-indigo-700"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ais-state-results>
                                    <template v-slot="{ results: { hits } }">
                                        <ais-infinite-hits ref="hitResults" v-if="hits.length > 0" :cache="cache">
                                            <template v-slot:item="{ item, index }">
                                                <div
                                                    v-if="!checkIfMuted(item.crms) && checkIfAll(item.crms)"
                                                    @click="setCurrentCreator(item, index)"
                                                    class="h-full divide-y divide-gray-200 bg-white">
                                                    <div
                                                        :class="{
                              'bg-indigo-200': item.id == selectedCreator.id,
                            }"
                                                        class="group border-1 flex border-collapse flex-row items-center overflow-y-visible border border-neutral-200 hover:bg-indigo-50 active:bg-indigo-100">
                                                        <div
                                                            class="mx-auto hidden flex-none items-center justify-between whitespace-nowrap py-1 px-4 text-center text-xs font-bold text-gray-300 group-hover:text-neutral-500 lg:table-cell">
                                                            <div class="mx-auto items-center">
                                                                <div class="group mx-auto w-4">
                                  <span class="mx-auto group-hover:hidden">
                                    {{ formatCount(index + 1) }}
                                  </span>
                                                                    <span
                                                                        class="mx-auto hidden group-hover:block">
                                    <input
                                        id="comments-description"
                                        aria-describedby="comments-description"
                                        name="comments"
                                        type="checkbox"
                                        autocomplete="off"
                                        autocorrect="off"
                                        autocapitalize="none"
                                        spellcheck="false"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus-visible:ring-indigo-500"/>
                                  </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="w-96 flex-none justify-center border-l px-4 py-1 xl:w-128">
                                                            <div class="flex items-center">
                                                                <div class="mr-2 h-24 w-24 flex-shrink-0">
                                                                    <div
                                                                        @click="toggleSidebar"
                                                                        class="rounded-full bg-neutral-200 p-0.5">
                                                                        <img
                                                                            class="rounded-full object-cover object-center"
                                                                            :src="
                                        item.instagram_meta.profile_pic_url ??
                                        currentUser.default_image
                                      "
                                                                            alt=""/>
                                                                    </div>

                                                                    <!--  <div class="mr-2 h-24 w-24 flex-shrink-0">
                                                                                                    <img
                                                                                                        class="rounded-full border-2 object-cover object-center"
                                                                                                        :src="item.avatar"
                                                                                                        alt="" /> -->
                                                                </div>
                                                                <div class="w-96">
                                                                    <div
                                                                        class="flex text-xs font-medium text-gray-900">
                                    <span
                                        @click="sidebarOpen = true"
                                        class="cursor-pointer line-clamp-1">
                                      {{
                                            item.instagram_name ?? item.twitter_name
                                        }}</span
                                    >
                                                                        <div class="text-white">
                                                                            <!-- <VerifiedBadge
                                                                                                                    :verified="
                                                                                                                      item.instagram_is_verified
                                                                                                                    " /> -->
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="wrap -mt-1 h-8 text-2xs font-light text-gray-900">
                                                                        <p class="line-clamp-2">
                                                                            {{ item.biography }}
                                                                        </p>
                                                                    </div>
                                                                    <div
                                                                        class="pt-.05 pb-1 text-xs font-medium text-gray-900 line-clamp-1">
                                                                        <CreatorTags
                                                                            v-if="item.instagram_category"
                                                                            size="xs"
                                                                            :showX="false"
                                                                            color="none"
                                                                            :text="item.instagram_category"/>
                                                                        <!-- <CreatorTags
                                                                                                          v-if="item.tags > 0"
                                                                                                          size="xs"
                                                                                                          color="purple"
                                                                                                          :text="item.tags[1]" />
                                                                                                        <CreatorTags
                                                                                                          size="xs"
                                                                                                          color="blue"
                                                                                                          text="Music" />
                                                                                                        <CreatorTags
                                                                                                          size="xs"
                                                                                                          color="pink"
                                                                                                          text="Other" /> -->
                                                                    </div>

                                                                    <div
                                                                        class="mt-1 grid w-80 grid-cols-6 items-center justify-start text-center">
                                                                        <div
                                                                            class="text-neutral-5 mx-auto cursor-pointer justify-center text-center"
                                                                            :class="[
                                        {
                                          'opacity-10':
                                            item.instagram_handler == null,
                                        },
                                        'opacity-100',
                                      ]"
                                                                            @click="
                                        openLink(
                                          ('https://instagram.com/',
                                          item.instagram_handler),
                                          true
                                        )
                                      ">
                                                                            <SocialIcons
                                                                                height="14px"
                                                                                class="z-0"
                                                                                icon="instagram"/>
                                                                            <div
                                                                                class="mx-auto text-center text-2xs text-neutral-500">
                                                                                {{
                                                                                    formatCount(item.instagram_followers)
                                                                                }}
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-neutral-5 mx-auto cursor-pointer justify-center text-center"
                                                                            :class="[
                                        {
                                          'opacity-100': item.tiktok_handler,
                                        },
                                        'opacity-20',
                                      ]"
                                                                            @click="
                                        openLink(
                                          ('https://tiktok.com/',
                                          item.tiktok_handler),
                                          true
                                        )
                                      ">
                                                                            <SocialIcons
                                                                                height="14px"
                                                                                class="z-0 mx-auto"
                                                                                icon="tiktok"/>
                                                                            <div
                                                                                class="mx-auto text-center text-2xs text-neutral-500"
                                                                                :class="[
                                          {
                                            'opacity-100':
                                              item.youtube_followers > 0,
                                          },
                                          'opacity-20',
                                        ]">
                                                                                {{
                                                                                    formatCount(item.youtube_followers)
                                                                                }}
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-neutral-5 mx-auto cursor-pointer justify-center text-center"
                                                                            :class="[
                                        {
                                          'opacity-100': item.twitter_handler,
                                        },
                                        'opacity-20',
                                      ]"
                                                                            @click="
                                        openLink(
                                          ('https://twitter.com/',
                                          item.twitter_handler),
                                          true
                                        )
                                      ">
                                                                            <SocialIcons
                                                                                height="14px"
                                                                                class="z-0 mx-auto"
                                                                                icon="twitter"/>
                                                                            <div
                                                                                class="mx-auto text-center text-2xs text-neutral-500"
                                                                                :class="[
                                          {
                                            'opacity-100':
                                              item.twitter_followers > 0,
                                          },
                                          'opacity-20',
                                        ]">
                                                                                {{
                                                                                    formatCount(item.twitter_followers)
                                                                                }}
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-neutral-5 mx-auto cursor-pointer justify-center text-center"
                                                                            :class="[
                                        {
                                          'opacity-100': item.youtube_handler,
                                        },
                                        'opacity-20',
                                      ]"
                                                                            @click="
                                        openLink(
                                          ('https://youtube.com/',
                                          item.youtube_handler),
                                          true
                                        )
                                      ">
                                                                            <SocialIcons
                                                                                height="14px"
                                                                                class="z-0 mx-auto"
                                                                                icon="youtube"/>
                                                                            <div
                                                                                class="mx-auto text-center text-2xs text-neutral-500"
                                                                                :class="[
                                          {
                                            'opacity-100':
                                              item.youtube_followers > 0,
                                          },
                                          'opacity-20',
                                        ]">
                                                                                {{
                                                                                    formatCount(item.youtube_followers)
                                                                                }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="grow items-center whitespace-nowrap px-4">
                                                            <div
                                                                @click="toggleSidebar"
                                                                class="grid w-24 grid-cols-1 lg:w-48 lg:grid-cols-2 xl:w-72 xl:grid-cols-3">
                                                                <img
                                                                    v-for="media in item.instagram_media"
                                                                    :key="media"
                                                                    class="only-child:rounded-md aspect-square h-24 w-24 object-cover object-center line-clamp-1 first:rounded-l-md last:rounded-r-md"
                                                                    :src="media.display_url"/>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="border-1 mx-auto w-24 border-collapse border-r xl:w-48 2xl:w-72">
                                                            <div
                                                                class="grid text-center xl:grid-cols-2 2xl:grid-cols-3">
                                                                <div>
                                                                    <div class="font-bold">
                                                                        {{ formatCount(item.instagram_followers) }}
                                                                    </div>
                                                                    <div class="text-[8px] text-neutral-500">
                                                                        Followers
                                                                    </div>
                                                                </div>

                                                                <div class="hidden xl:block">
                                                                    <div class="font-bold">
                                                                        {{
                                                                            formatCount(
                                                                                item.instagram_engagement_rate
                                                                            )
                                                                        }}%
                                                                    </div>
                                                                    <div class="text-[8px] text-neutral-500">
                                                                        ER
                                                                    </div>
                                                                </div>
                                                                <div class="hidden 2xl:block">
                                                                    <div class="font-bold">
                                                                        {{
                                                                            formatCount(
                                                                                item.instagram_meta.engaged_follows
                                                                            )
                                                                        }}
                                                                    </div>
                                                                    <div class="text-[8px] text-neutral-500">
                                                                        EF
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="mx-auto grid grow grid-cols-2 items-center justify-between">
                                                            <div
                                                                class="W-28 mx-auto flex-grow px-6 py-1 text-sm text-gray-500">
                                                                <star-rating
                                                                    class="w-20"
                                                                    :star-size="12"
                                                                    :increment="0.5"
                                                                    v-model:rating="item.rating"></star-rating>
                                                            </div>
                                                            <div
                                                                class="justify-self-right mx-auto py-1 text-right text-xs font-medium">
                                                                <div class="mx-auto items-center gap-4">
                                                                    <Menu
                                                                        as="div"
                                                                        class="relative inline-block text-left">
                                                                        <div class="inline-flex space-x-2">
                                                                            <PlusIcon
                                                                                @click="addToCrm(selectedCreator.id)"
                                                                                class="h-5 w-5 cursor-pointer text-gray-500 hover:text-indigo-500"/>

                                                                            <MenuButton
                                                                                class="flex items-center rounded-full text-gray-400 hover:text-gray-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-100">
                                        <span class="sr-only"
                                        >Open options</span
                                        >
                                                                                <DotsVerticalIcon
                                                                                    class="h-5 w-5"
                                                                                    aria-hidden="true"/>
                                                                            </MenuButton>
                                                                        </div>
                                                                        <transition
                                                                            enter-active-class="transition ease-out duration-100"
                                                                            enter-from-class="transform opacity-0 scale-95"
                                                                            enter-to-class="transform opacity-100 scale-100"
                                                                            leave-active-class="transition ease-in duration-75"
                                                                            leave-from-class="transform opacity-100 scale-100"
                                                                            leave-to-class="transform opacity-0 scale-95">
                                                                            <MenuItems
                                                                                class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus-visible:outline-none">
                                                                                <div class="py-1">
                                                                                    <MenuItem v-slot="{ active }">
                                                                                        <a
                                                                                            v-for="menu in creatorMenu"
                                                                                            href="#"
                                                                                            :class="[
                                                active
                                                  ? 'bg-gray-100 text-gray-900'
                                                  : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                              ]">
                                                                                            <PlusIcon
                                                                                                class="mr-2 h-4 w-4 cursor-pointer hover:text-indigo-700"
                                                                                                aria-hidden="true"/>
                                                                                            Add to contacts</a
                                                                                        >
                                                                                    </MenuItem>
                                                                                    <MenuItem v-slot="{ active }">
                                                                                        <a
                                                                                            href="#"
                                                                                            :class="[
                                                active
                                                  ? 'bg-gray-100 text-gray-900'
                                                  : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                              ]"
                                                                                        >Shortlist</a
                                                                                        >
                                                                                    </MenuItem>
                                                                                    <MenuItem v-slot="{ active }">
                                                                                        <a
                                                                                            href="#"
                                                                                            :class="[
                                                active
                                                  ? 'bg-gray-100 text-gray-900'
                                                  : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                              ]"
                                                                                        >Dismiss</a
                                                                                        >
                                                                                    </MenuItem>
                                                                                    <MenuItem v-slot="{ active }">
                                                                                        <a
                                                                                            href="#"
                                                                                            :class="[
                                                active
                                                  ? 'bg-gray-100 text-gray-900'
                                                  : 'text-gray-700',
                                                'block px-4 py-2 text-sm',
                                              ]"
                                                                                        >Mute</a
                                                                                        >
                                                                                    </MenuItem>
                                                                                </div>
                                                                            </MenuItems>
                                                                        </transition>
                                                                    </Menu>

                                                                    <!-- This example requires Tailwind CSS v2.0+ -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-observe-visibility="visibilityChanged"></div>
                                            </template>
                                        </ais-infinite-hits>

                                        <div v-else class="mx-auto w-full items-center">
                                            <div
                                                class="mx-auto mt-24 max-w-xl items-center p-12 text-center text-sm font-bold text-neutral-500">
                                                <ChevronUpIcon
                                                    class="mx-auto h-24 w-24 text-neutral-200"
                                                    aria-hidden="true"/>
                                                <span class="text-xl text-neutral-700"
                                                ><span class="font-bold">Jovie</span>
                          <span class="font-medium">
                            Creator Search.</span
                          ></span
                                                ><br/>
                                                Enter a search term above to start. <br/>Refine your
                                                audience with
                                                <span
                                                    @click="searchopen = true"
                                                    class="cursor-pointer font-bold text-indigo-500"
                                                >filters</span
                                                >.
                                            </div>
                                        </div>
                                    </template>
                                </ais-state-results>
                            </TabGroup>
                        </main>
                        <TransitionRoot
                            show="{sidebarOpen}"
                            enter="transition-opacity duration-300 ease-in"
                            enterFrom="translate-x-190 opacity-80"
                            enterTo="translate-x-0 opacity-100"
                            leave="transition-opacity duration-300"
                            leaveFrom="translate-x-0 opacity-100"
                            leaveTo="translate-x-80 opacity-80">
                            <div
                                v-if="sidebarOpen"
                                class="fixed right-0 z-10 hidden w-60 shrink-0 bg-neutral-50 shadow-lg lg:flex">
                                <div
                                    class="absolute top-0 right-0 z-50 mb-12 h-screen w-192 border border-neutral-200 bg-white/60 bg-clip-padding shadow-xl backdrop-blur-xl backdrop-brightness-150 backdrop-saturate-150 backdrop-filter">
                                    <div class="mt-4 flex justify-between px-4">
                                        <div class="group" @click="sidebarOpen = false">
                                            <XIcon
                                                class="h-5 w-5 cursor-pointer text-neutral-700 hover:text-neutral-900 active:text-neutral-400 group-active:text-indigo-700"/>
                                        </div>
                                        <div class="mr-4 flex space-x-2 text-xs text-neutral-400">
                                            <HeartIcon
                                                class="h-5 w-5 cursor-pointer hover:text-neutral-500"/>
                                            <BanIcon
                                                class="h-5 w-5 cursor-pointer hover:text-neutral-500"/>
                                            <div class="fixed top-4 text-right">
                                                <Menu
                                                    as="div"
                                                    class="relative z-20 inline-block text-left">
                                                    <div>
                                                        <MenuButton
                                                            class="inline-flex w-full justify-center rounded-md text-sm font-medium text-neutral-700 hover:text-neutral-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                                                            <DotsVerticalIcon
                                                                class="-mr-24 h-5 w-5 text-neutral-400 hover:text-neutral-700"
                                                                aria-hidden="true"/>
                                                        </MenuButton>
                                                    </div>

                                                    <transition
                                                        enter-active-class="transition duration-100 ease-out"
                                                        enter-from-class="transform scale-95 opacity-0"
                                                        enter-to-class="transform scale-100 opacity-100"
                                                        leave-active-class="transition duration-75 ease-in"
                                                        leave-from-class="transform scale-100 opacity-100"
                                                        leave-to-class="transform scale-95 opacity-0">
                                                        <MenuItems
                                                            class="absolute -right-12 z-50 mt-2 w-40 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus-visible:outline-none">
                                                            <div class="px-1 py-1">
                                                                <MenuItem
                                                                    v-slot="{ active }"
                                                                    @click="addToCrm(selectedCreator.id)">
                                                                    <button
                                                                        :class="[
                                      active
                                        ? 'bg-indigo-500 text-white'
                                        : 'text-gray-900',
                                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                    ]">
                                                                        <UserIcon
                                                                            :active="active"
                                                                            class="mr-2 h-5 w-5 text-indigo-400"
                                                                            aria-hidden="true"/>
                                                                        Add to contacts
                                                                    </button>
                                                                </MenuItem>
                                                                <MenuItem v-slot="{ active }">
                                                                    <button
                                                                        :class="[
                                      active
                                        ? 'bg-indigo-500 text-white'
                                        : 'text-gray-900',
                                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                    ]">
                                                                        <PlusIcon
                                                                            :active="active"
                                                                            class="mr-2 h-5 w-5 text-indigo-400"
                                                                            aria-hidden="true"/>
                                                                        Add to list
                                                                    </button>
                                                                </MenuItem>
                                                            </div>
                                                        </MenuItems>
                                                    </transition>
                                                </Menu>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-5 py-2 px-4">
                                        <CreatorAvatar
                                            :imageUrl="
                        selectedCreator.instagram_meta.profile_pic_url ??
                        selectedCreator.twitter_meta.profile_image_url ??
                        currentUser.default_image
                      "
                                            as="div"
                                            class="col-span-1 aspect-square items-center"
                                            size="md"/>
                                        <div class="col-span-3 block pr-6 pl-8">
                                            <div
                                                class="text-md relative z-10 inline-flex items-center font-bold text-neutral-700">
                                                <!--  <VerifiedBadge
                                                                          :verified="selectedCreator.instagram_is_verified" /> -->
                                                <span class="-mt-0.5">{{
                                                        selectedCreator.full_name ??
                                                        selectedCreator.instagram_name ??
                                                        selectedCreator.twitter_name
                                                    }}</span>
                                            </div>
                                            <div
                                                class="mt-1 h-20 text-xs font-medium text-neutral-500 line-clamp-4">
                                                {{
                                                    selectedCreator.instagram_biography ??
                                                    selectedCreator.twitter_biography
                                                }}
                                            </div>
                                            <div class="h-8">
                                                <CreatorTags
                                                    v-if="selectedCreator.instagram_category"
                                                    size="sm"
                                                    :showX="false"
                                                    :text="selectedCreator.instagram_category"/>
                                                <!-- <CreatorTags
                                                                                size="sm"
                                                                                color="pink"
                                                                                text="Fashion" />
                                                                              <CreatorTags
                                                                                size="sm"
                                                                                color="blue"
                                                                                text="Music" />
                                                                              <CreatorTags
                                                                                size="sm"
                                                                                color="green"
                                                                                text="Sports" /> -->
                                            </div>

                                            <div class="mx-auto mt-2 flex justify-start space-x-6">
                                                <div
                                                    class="mt-1 grid w-80 grid-cols-6 items-center justify-start text-center">
                                                    <div
                                                        class="text-neutral-5 mx-auto cursor-pointer justify-center text-center"
                                                        :class="[
                              {
                                'opacity-10':
                                  selectedCreator.instagram_handler == null,
                              },
                              'opacity-100',
                            ]"
                                                        @click="
                              openLink(
                                ('https://instagram.com/',
                                selectedCreator.instagram_handler),
                                true
                              )
                            ">
                                                        <SocialIcons
                                                            height="14px"
                                                            class="z-0 mx-auto"
                                                            icon="instagram"/>
                                                        <div
                                                            class="mx-auto text-center text-2xs text-neutral-500">
                                                            {{
                                                                formatCount(selectedCreator.instagram_followers)
                                                            }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="text-neutral-5 mx-auto cursor-pointer justify-center text-center"
                                                        :class="[
                              {
                                'opacity-100': selectedCreator.tiktok_handler,
                              },
                              'opacity-20',
                            ]"
                                                        @click="
                              openLink(
                                ('https://tiktok.com/',
                                selectedCreator.tiktok_handler),
                                true
                              )
                            ">
                                                        <SocialIcons
                                                            height="14px"
                                                            class="z-0 mx-auto"
                                                            icon="tiktok"/>
                                                        <div
                                                            class="mx-auto text-center text-2xs text-neutral-500"
                                                            :class="[
                                {
                                  'opacity-100':
                                    selectedCreator.youtube_followers > 0,
                                },
                                'opacity-20',
                              ]">
                                                            {{
                                                                formatCount(selectedCreator.youtube_followers)
                                                            }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="text-neutral-5 mx-auto cursor-pointer justify-center text-center"
                                                        :class="[
                              {
                                'opacity-100': selectedCreator.twitter_handler,
                              },
                              'opacity-20',
                            ]"
                                                        @click="
                              openLink(
                                ('https://twitter.com/',
                                selectedCreator.twitter_handler),
                                true
                              )
                            ">
                                                        <SocialIcons
                                                            height="14px"
                                                            class="z-0 mx-auto"
                                                            icon="twitter"/>
                                                        <div
                                                            class="mx-auto text-center text-2xs text-neutral-500"
                                                            :class="[
                                {
                                  'opacity-100':
                                    selectedCreator.twitter_followers > 0,
                                },
                                'opacity-20',
                              ]">
                                                            {{
                                                                formatCount(selectedCreator.twitter_followers)
                                                            }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="text-neutral-5 mx-auto cursor-pointer justify-center text-center"
                                                        :class="[
                              {
                                'opacity-100': selectedCreator.youtube_handler,
                              },
                              'opacity-20',
                            ]"
                                                        @click="
                              openLink(
                                ('https://youtube.com/',
                                selectedCreator.youtube_handler),
                                true
                              )
                            ">
                                                        <SocialIcons
                                                            height="14px"
                                                            class="z-0 mx-auto"
                                                            icon="youtube"/>
                                                        <div
                                                            class="mx-auto text-center text-2xs text-neutral-500"
                                                            :class="[
                                {
                                  'opacity-100':
                                    selectedCreator.youtube_followers > 0,
                                },
                                'opacity-20',
                              ]">
                                                            {{
                                                                formatCount(selectedCreator.youtube_followers)
                                                            }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-1">
                                            <div
                                                class="mx-auto mt-6 inline-flex w-full items-center justify-center text-center text-neutral-400">
                                                <LocationMarkerIcon
                                                    v-if="
                            selectedCreator.instagram_meta.country ||
                            selectedCreator.instagram_meta.city
                          "
                                                    class="mr-1 h-4 w-4"/>
                                                <span
                                                    v-if="selectedCreator.instagram_meta.city"
                                                    class="text-xs font-bold text-neutral-500"
                                                >{{ selectedCreator.city }}</span
                                                ><span
                                                v-if="selectedCreator.instagram_meta.country"
                                                class="text-xs font-bold text-neutral-500"
                                            >{{ selectedCreator.country }}</span
                                            >
                                            </div>
                                            <div
                                                class="mx-auto inline-flex w-full justify-center text-sm text-neutral-400">
                                                <div
                                                    class="mt-1 grid grid-cols-2 gap-4 border-neutral-200 pt-1">
                                                    <div class="text-center">
                                                        <div class="text-sm font-bold text-neutral-600">
                                                            {{
                                                                formatCount(selectedCreator.instagram_followers)
                                                            }}
                                                        </div>
                                                        <div class="text-[8px] text-neutral-400">
                                                            Followers
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="text-sm font-bold text-neutral-600">
                                                            {{
                                                                formatCount(
                                                                    selectedCreator.instagram_engagement_rate
                                                                )
                                                            }}%
                                                        </div>
                                                        <div class="text-[8px] text-neutral-400">
                                                            Engagement
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="text-sm font-bold text-neutral-600">
                                                            {{
                                                                formatCount(
                                                                    selectedCreator.instagram_meta.engaged_follows
                                                                )
                                                            }}
                                                        </div>
                                                        <div class="text-[8px] text-neutral-400">EF</div>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="text-sm font-bold text-neutral-600">
                                                            $0.50
                                                        </div>
                                                        <div class="text-[8px] text-neutral-400">CPE</div>
                                                    </div>
                                                    <div
                                                        class="mx-auto w-full flex-grow justify-center px-6 py-1 text-sm text-gray-500">
                                                        <star-rating
                                                            class="w-full"
                                                            :star-size="12"
                                                            :increment="0.5"
                                                            v-model:rating="
                                selectedCreator.rating
                              "></star-rating>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="mx-auto items-center justify-center py-5 text-center sm:p-6">
                                        <form class="mt-5 sm:flex sm:items-center">
                      <span
                          class="mr-4 mt-1 items-center text-sm font-bold text-neutral-500"
                      >Contact options:
                      </span>
                                            <div
                                                class="relative mt-1 w-full rounded-md shadow-sm sm:max-w-sm">
                                                <div
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3">
                                                    <DuplicateIcon
                                                        tooltip="Copy to clipboard"
                                                        @click="copyToClipboard(selectedCreator.emails[0])"
                                                        class="h-5 w-5 cursor-pointer text-gray-400 hover:text-neutral-700 active:mt-0.5 active:mr-0.5 active:text-neutral-500"
                                                        aria-hidden="true"/>
                                                </div>
                                                <input
                                                    type="email"
                                                    name="email"
                                                    id="email"
                                                    :value="selectedCreator.emails[0]"
                                                    class="z-10 mt-0.5 block w-full rounded-md border-gray-300 bg-transparent bg-white/0 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                                            </div>
                                            <button
                                                type="submit"
                                                class="mt-3 inline-flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2.5 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                Add to contacts
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mt-2 grid grid-cols-3 border-b">
                                        <div
                                            v-for="media in selectedCreator.instagram_media"
                                            class="group justify-center">
                                            <img
                                                :src="media.display_url"
                                                class="mx-auto aspect-square h-full justify-center object-cover object-center"/>

                                            <div
                                                class="flex justify-between border-t border-b border-neutral-200 bg-neutral-200/20 px-6 py-0.5 text-center text-neutral-700 backdrop-blur-xl backdrop-saturate-150 backdrop-filter">
                                                <div class="inline-flex text-xs">
                                                    <ThumbUpIcon class="mt-0.5 mr-0.5 h-3 w-3"/>
                                                    {{ formatCount(media.likes) }}
                                                </div>
                                                <div class="inline-flex text-xs">
                                                    <PlayIcon class="mt-0.5 mr-0.5 h-3 w-3"/>
                                                    {{ formatCount(media.views) }}
                                                </div>
                                                <div class="inline-flex text-xs">
                                                    <ChatAlt2Icon class="mt-0.5 mr-0.5 h-3 w-3"/>
                                                    {{ formatCount(media.comments) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </TransitionRoot>
                    </div>
                </div>
            </div>
        </ais-instant-search>
    </div>
</template>

<script>
import {connectInfiniteHits} from 'instantsearch.js/es/connectors';
import DiscoverySearch from '../components/Discovery/DiscoverySearch.vue';
import {instantMeiliSearch} from '@meilisearch/instant-meilisearch';
import InputGroup from '../components/InputGroup.vue';
import {TabGroup} from '@headlessui/vue';
import StarRating from 'vue-star-rating';
import {
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverGroup,
    TransitionRoot,
} from '@headlessui/vue';
import {
    DotsVerticalIcon,
    ChevronDownIcon,
    ChevronUpIcon,
    FilterIcon,
    HeartIcon,
    ChevronRightIcon,
    PlayIcon,
    ThumbUpIcon,
    LocationMarkerIcon,
    ChatAlt2Icon,
    BanIcon,
    ChevronLeftIcon,
    SearchIcon,
    PlusIcon,
    DuplicateIcon,
    XIcon,
} from '@heroicons/vue/solid';
import {LightningBoltIcon} from '@heroicons/vue/outline';
import CreatorTags from '../components/Creator/CreatorTags';
import CreatorSocialLinks from '../components/Creator/CreatorSocialLinks';
import DiscoveryStats from '../components/Discovery/DiscoveryStats.vue';
import DiscoveryToolbar from '../components/Discovery/DiscoveryToolbar.vue';
import {createInfiniteHitsSessionStorageCache} from 'instantsearch.js/es/lib/infiniteHitsCache';
import JovieSpinner from '../components/JovieSpinner.vue';
import SocialIcons from '../components/SocialIcons.vue';
import JovieTooltip from '../components/JovieTooltip.vue';
import CreatorMediaItem from '../components/TimelineMedia/CreatorMediaItem.vue';
import VerifiedBadge from '../components/VerifiedBadge.vue';
import CreatorAvatar from '../components/Creator/CreatorAvatar.vue';
import ButtonGroup from '../components/ButtonGroup.vue';
import UserService from '../services/api/user.service';
import AppDebouncedSearchBox from '../components/AppDebouncedSearchBox.vue';

export default {
    components: {
        instantMeiliSearch,
        AppDebouncedSearchBox,
        InputGroup,
        VerifiedBadge,
        CreatorAvatar,
        CreatorSocialLinks,
        JovieSpinner,
        XIcon,
        TabGroup,
        SocialIcons,
        DiscoveryStats,
        DuplicateIcon,
        DiscoveryToolbar,
        HeartIcon,
        BanIcon,
        FilterIcon,
        ChevronLeftIcon,
        DiscoverySearch,
        StarRating,
        PlayIcon,
        ThumbUpIcon,
        LocationMarkerIcon,
        ChevronRightIcon,
        ChatAlt2Icon,
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        CreatorMediaItem,
        DotsVerticalIcon,
        ChevronDownIcon,
        SearchIcon,
        CreatorTags,
        CreatorSocialLinks,
        ChevronUpIcon,
        LightningBoltIcon,
        Popover,
        PopoverButton,
        ButtonGroup,
        PopoverGroup,
        PopoverPanel,
        PlusIcon,
        JovieTooltip,
    },
    mounted() {
        this.$mousetrap.bind(['space'], this.toggleSidebar);
        this.$mousetrap.bind(['command+k', 'ctrl+k'], this.clearSearch);
        this.$mousetrap.bind(['up'], this.logIt);
        this.$mousetrap.bind('down', this.setNextCreator);
        this.$mousetrap.bind('right', this.addToSelected);
        this.$mousetrap.bind('left', this.addToRejected);
    },
    computed: {
        searchPlaceholder() {
            if (navigator.appVersion.indexOf('Mac') !== -1) {
                return 'Search - ⌘k to focus';
            } else if (navigator.appVersion.indexOf('Win') !== -1) {
                return 'Search - Win + k to focus';
            } else {
                return 'Search';
            }
        },
    },
    methods: {
        async addToSelected() {
            if (!this.selectedCreator) return
            let params = {
                id: this.selectedCreator.id,
                key: 'crm_record_by_user.selected',
                value: 1
            }
            await this.$store.dispatch('updateCreator', params).then((response) => {
                response = response.data;
                if (response.status) {
                    this.$refs.hitResults.items.splice(this.selectedCreatorIndex, 1)
                }
            })
        },
        async addToRejected() {
            if (!this.selectedCreator) return
            let params = {
                id: this.selectedCreator.id,
                key: 'crm_record_by_user.rejected',
                value: 1
            }
            await this.$store.dispatch('updateCreator', params).then((response) => {
                response = response.data;
                if (response.status) {
                    this.$refs.hitResults.items.splice(this.selectedCreatorIndex, 1)
                }
            })
        },
        checkIfMuted(crms) {
            if (crms == undefined) return false
            crms = JSON.parse(JSON.stringify(crms))
            if (!crms.length) return false
            const length = crms.length
            const currentUser = this.currentUser
            let muted = false;
            for (let i=0; i<length; i++) {
                if (crms[i].user_id == currentUser.id) {
                    muted = crms[i].muted == 1 ? true : false
                    break
                }
            }
            return muted;
        },
        checkIfAll(crms) {
            if (crms == undefined) return true
            crms = JSON.parse(JSON.stringify(crms))
            if (!crms.length) return true
            const length = crms.length
            const currentUser = this.currentUser
            let all = true;
            for (let i=0; i<length; i++) {
                if (crms[i].user_id == currentUser.id) {
                    all = crms[i].selected == 1 || crms[i].rejected == 1 ? false : true
                    break
                }
            }
            return all;
        },
        addToCrm(creatorId) {
            UserService.addCreatorToCrm(creatorId).then((response) => {
                response = response.data;
                if (response.status) {
                    alert(response.message);
                }
            });
        },
        logIt(e) {
            console.log(e);
            return false;
        },
        //write a vue method to copy the value of an input to the clipboard

        copyToClipboard(text) {
            //if text is undefined then return null

            //add text to clipboard
            navigator.clipboard.writeText(text);
        },
        setCurrentCreator(item, index) {
            this.selectedCreator = item;
            this.selectedCreatorIndex = index;
        },
        setNextCreator(item) {
            this.selectedCreator = [this.selectedCreator.index + 1];
        },
        clearSearch() {
            //move focus to the search box and clear the current search from instantsearch
            this.$refs.search.focus();
        },
        visibilityChanged(isVisible, entry) {
            this.isVisible = isVisible;
            console.log(entry);
        },
        toggleSidebar() {
            if (this.sidebarOpen) {
                this.sidebarOpen = false;
            } else {
                this.sidebarOpen = true;
            }
        },
    },
    data() {
        return {
            sidebarOpen: false,
            creatorMenu: [
                {
                    name: 'Add to contacts',
                    icon: PlusIcon,
                },
            ],
            cache: createInfiniteHitsSessionStorageCache(),
            searchopen: true,
            selectedCreator: {},
            selectedCreatorIndex: [],
            searchClient: instantMeiliSearch(
                // 'https://search.jov.ie/',
                // 'geDQZEly7c4a5062c9da2683eebb23ae1b1219cd233191bceb73f1084385eb75dd76b340',
                process.env.MIX_MEILISEARCH_HOST,
                process.env.MIX_MEILISEARCH_FRONT_KEY,
                {
                    placeholderSearch: true, // default: true.
                    primaryKey: 'id', // default: undefined
                    // ...
                }
            ),
            searchFunction(helper) {
                // helper.state.query = 'tim'
                let res = helper.search();
                console.log('results');
                console.log(res);
                console.log('res');
                console.log('this.state');
                console.log(this.state);
                // }
            },
        };
    },
};
</script>
