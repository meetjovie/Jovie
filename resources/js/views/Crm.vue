<template>
  <div class="h-full w-full">
    <div id="crm" class="mx-auto flex h-full w-full min-w-full">
      <div class="flex h-full w-full">
        <TransitionRoot
          :show="$store.state.CRMSidebarOpen"
          enter="transition ease-in-out duration-300 transform"
          enter-from="-translate-x-full"
          enter-to="translate-x-0"
          leave="transition ease-in-out duration-300 transform"
          leave-from="translate-x-0"
          leave-to="-translate-x-full">
          <!--  :class="[{ '-mt-20': $store.state.CRMSidebarOpen }, '-mt-10']" -->
          <div
            class="top-0 z-30 mx-auto flex h-screen w-60 flex-col justify-between overflow-hidden border-r border-gray-100 bg-white py-4">
            <div>
              <div class="w-full flex-col px-2">
                <div class="flex h-8 w-full items-center justify-between">
                  <!-- <SwitchTeams /> -->
                  <JovieDropdownMenu
                    :items="currentUser.teams"
                    :numbered="true"
                    size="md"
                    :searchable="false">
                    <template #triggerButton>
                      <div
                        class="flex w-full items-center justify-between rounded-md px-2 py-1 hover:bg-gray-100">
                        <div class="flex">
                          <div
                            class="items-center text-2xs font-medium text-gray-700 line-clamp-1 group-hover:text-gray-800">
                            {{
                              currentUser.current_team
                                ? currentUser.current_team.name
                                : 'Select a team'
                            }}
                          </div>
                        </div>
                      </div>
                    </template>
                    <template #menuTop>
                      <div class="">
                        <div
                          class="border-b px-4 pt-2 pb-1 text-center text-xs font-semibold text-gray-700">
                          Your workspaces:
                        </div>
                      </div>
                    </template>
                    <template #menuBottom>
                      <router-link
                        to="/accounts"
                        class="group rounded-md px-1 py-1 text-center text-sm font-medium hover:bg-gray-200 hover:text-gray-700"
                        :class="[
                          active
                            ? 'bg-white px-1 py-2  text-gray-800'
                            : 'text-sm text-gray-700',
                          'group flex w-full items-center px-2 py-2 text-2xs  ',
                        ]">
                        <PlusCircleIcon
                          :active="active"
                          class="mr-2 h-4 w-4 text-gray-500"
                          aria-hidden="true" />
                        Create workspace
                      </router-link>
                    </template>
                  </JovieDropdownMenu>
                  <div class="items-center">
                    <JovieDropdownMenu
                      :searchable="false"
                      :items="profileMenuItems">
                      <template #triggerButton>
                        <div
                          class="mx-auto h-6 w-6 items-center rounded-full border border-neutral-200 hover:bg-gray-100">
                          <img
                            class="h-5 w-5 items-center rounded-full object-cover"
                            :src="
                              $store.state.AuthState.user.profile_pic_url ??
                              $store.state.AuthState.user.default_image
                            "
                            alt="User Avatar" />
                        </div>
                      </template>
                      <template #menuTop>
                        <div class="ml-3 cursor-default">
                          <p
                            class="justify-between text-xs font-medium text-gray-700 group-hover:text-gray-900">
                            {{ currentUser.first_name }}
                            {{ currentUser.last_name }}
                          </p>

                          <p
                            class="text-2xs font-medium text-gray-400 group-hover:text-gray-700">
                            {{ currentUser.email }}
                          </p>
                        </div>
                        <MenuItem as="div" role="menuitem" tabindex="-1">
                          <router-link
                            v-if="currentUser.username"
                            class="flex w-full cursor-pointer px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-700"
                            :to="profileLink">
                            <div
                              class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-gray-600"
                              :class="{
                                'bg-gray-200 text-gray-700': active,
                              }">
                              <component
                                class="mr-4 h-4 w-4 cursor-pointer"
                                is="UserIcon">
                              </component
                              >Your profile
                            </div>
                          </router-link>
                          <router-link
                            v-else
                            class="flex w-full cursor-pointer px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-700"
                            to="edit-profile">
                            <div
                              class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-gray-600"
                              :class="{
                                'bg-gray-200 text-gray-700': active,
                              }">
                              <component
                                class="mr-4 h-4 w-4 cursor-pointer"
                                is="CogIcon">
                              </component
                              >Setup Your profile
                            </div>
                          </router-link>
                        </MenuItem>
                      </template>
                      <!-- <template #menuBottom>
                        <router-link
                          v-if="currentUser.username"
                          class="first-rounded-t-md inline-flex w-full cursor-pointer px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-700"
                          :to="profileLink">
                          <component
                            class="mr-4 h-4 w-4 cursor-pointer"
                            is="UserIcon">
                          </component
                          >Your profile
                        </router-link>
                        <router-link
                          v-else
                          class="first-rounded-t-md inline-flex w-full cursor-pointer px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-700"
                          to="edit-profile">
                          <component
                            class="mr-4 h-4 w-4 cursor-pointer"
                            is="CogIcon">
                          </component
                          >Setup Your profile
                        </router-link>
                        <div
                          v-for="dropdownmenuitem in dropdownmenuitems"
                          :key="dropdownmenuitem"
                          as="router-link"
                          :to="dropdownmenuitem.route"
                          class="first-rounded-t-md inline-flex w-full cursor-pointer text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-700"
                          role="menuitem"
                          tabindex="-1">
                          <router-link
                            class="first-rounded-t-md inline-flex w-full cursor-pointer justify-between px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-700"
                            :to="dropdownmenuitem.route">
                            <div class="flex">
                              <component
                                class="mr-4 h-4 w-4 cursor-pointer"
                                :is="dropdownmenuitem.icon">
                              </component>
                              {{ dropdownmenuitem.name }}
                            </div>
                            <div>
                              <span
                                v-if="dropdownmenuitem.badge"
                                class="ml-2 inline-flex items-center rounded bg-pink-100 px-1 text-2xs font-medium text-pink-800"
                                >Download</span
                              >
                            </div>
                          </router-link>
                        </div>
                        <router-link
                          to="slack-community"
                          class="inline-flex w-full cursor-pointer px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-700"
                          role="menuitem">
                          <component class="mr-4 h-4 w-4" is="LifebuoyIcon">
                          </component>
                          Slack community
                        </router-link>
                        <div
                          as="div"
                          @click="$store.dispatch('logout')"
                          class="inline-flex w-full cursor-pointer rounded-b-md px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-700"
                          role="menuitem"
                          tabindex="-1">
                          <component
                            class="mr-4 h-4 w-4"
                            is="ArrowLeftOnRectangleIcon">
                          </component>
                          Sign out
                        </div>
                      </template> -->
                      <template #menuBottom>
                        <MenuItem
                          as="div"
                          @click="$store.dispatch('logout')"
                          class="inline-flex w-full cursor-pointer rounded-b-md px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 hover:text-gray-700"
                          role="menuitem"
                          tabindex="-1">
                          <component
                            class="mr-4 h-4 w-4"
                            is="ArrowLeftOnRectangleIcon">
                          </component>
                          Sign out
                        </MenuItem>
                      </template>
                    </JovieDropdownMenu>
                  </div>
                </div>
                <Menu v-slot="{ open }">
                  <MenuButton class="w-full" as="div">
                    <JovieTooltip
                      shortcuts="{ key: 's', key: 'c', key: 't' }"
                      text="Show All Contacts">
                      <button
                        @click="setFiltersType('all')"
                        class="group mt-4 flex h-8 w-full items-center justify-between rounded-md px-1 text-left tracking-wide hover:bg-gray-200 hover:text-gray-900"
                        :class="[
                          filters.type == 'all'
                            ? 'text-sm font-bold text-gray-900  '
                            : 'text-sm font-light text-gray-900',
                        ]">
                        <div class="flex items-center text-xs">
                          <ChevronRightIcon
                            class="mr-1 h-5 w-5 rounded-md p-1 text-gray-400"
                            :class="[
                              {
                                'rotate-90 transform': open,
                              },
                            ]"
                            aria-hidden="true" />
                          Contacts
                        </div>
                        <div
                          @click="showCreatorModal = true"
                          class="items-center rounded-md p-1 hover:bg-gray-300 hover:text-gray-50">
                          <span
                            class="text-xs font-light text-gray-900 group-hover:hidden group-hover:text-gray-900"
                            >{{ counts.total }}</span
                          >

                          <PlusIcon
                            class="hidden h-3 w-3 text-gray-400 active:text-white group-hover:block"></PlusIcon>
                        </div>
                      </button>
                    </JovieTooltip>
                  </MenuButton>
                  <TransitionRoot
                    :show="open"
                    transition="transition ease-out duration-300"
                    enter-from="transform opacity-0 scale-95"
                    enter-to="transform opacity-100 scale-100"
                    leave-from="transform opacity-100 scale-100"
                    leave-to="transform opacity-0 scale-95">
                    <MenuItems static>
                      <div class="pl-4">
                        <MenuItem>
                          <JovieTooltip
                            :shortcut.key="{
                              key1: 'G',
                              key2: 'A',
                              delimiter: 'then',
                            }"
                            text="Show Archived Contacts">
                            <button
                              @click="setFiltersType('archived')"
                              class="group flex h-8 w-full items-center justify-between rounded-md px-1 py-1 text-left tracking-wide hover:bg-gray-200 hover:text-gray-900"
                              :class="[
                                filters.type == 'archived'
                                  ? 'text-sm font-bold text-gray-900 '
                                  : 'text-sm font-light text-gray-900',
                              ]">
                              <div class="flex items-center text-xs">
                                <ArchiveBoxIcon
                                  class="mr-1 h-5 w-5 rounded-md p-1 text-sky-400"
                                  aria-hidden="true" />Archived
                              </div>
                              <div
                                class="items-center rounded-md p-1 hover:text-gray-50">
                                <span
                                  class="text-xs font-light text-gray-700 group-hover:text-gray-900"
                                  >{{ counts.archived }}</span
                                >
                              </div>
                            </button>
                          </JovieTooltip>
                        </MenuItem>
                        <MenuItem>
                          <JovieTooltip
                            :shortcut="'G then F'"
                            text="Show Favorites">
                            <button
                              @click="setFiltersType('favourites')"
                              class="group flex h-8 w-full items-center justify-between rounded-md px-1 py-1 text-left tracking-wide hover:bg-gray-200 hover:text-gray-900"
                              :class="[
                                filters.type == 'favourites'
                                  ? 'text-sm font-bold text-gray-900 '
                                  : 'text-sm font-light text-gray-900',
                              ]">
                              <div class="flex items-center text-xs">
                                <HeartIcon
                                  class="mr-1 h-5 w-5 rounded-md p-1 text-red-400"
                                  aria-hidden="true" />Favorite
                              </div>
                              <div
                                class="items-center rounded-md p-1 hover:text-gray-50">
                                <span
                                  class="text-xs font-light text-gray-700 group-hover:text-gray-900"
                                  >{{ counts.favourites }}</span
                                >
                              </div>
                            </button>
                          </JovieTooltip>
                        </MenuItem>
                      </div>
                    </MenuItems>
                  </TransitionRoot>
                </Menu>
              </div>
              <div class="flex-col justify-evenly space-y-4 px-2 py-4">
                <MenuList
                  v-if="pinnedUserLists.length"
                  ref="menuListPinned"
                  @getUserLists="getUserLists"
                  @setFiltersType="setFiltersType"
                  @openEmojiPicker="openEmojiPicker"
                  menuName="Pinned"
                  :selectedList="filters.list"
                  @setFilterList="setFilterList"
                  :menuItems="pinnedUserLists"></MenuList>
                <!--    Team Specific Lists -->
                <MenuList
                  ref="menuListAll"
                  @getUserLists="getUserLists"
                  @setFiltersType="setFiltersType"
                  @openEmojiPicker="openEmojiPicker"
                  menuName="Lists"
                  @setFilterList="setFilterList"
                  :selectedList="filters.list"
                  :draggable="true"
                  @end="sortLists"
                  :menuItems="filteredUsersLists"></MenuList>
              </div>
            </div>
            <div class="flex-shrink-0 border-t border-gray-200 py-2 px-2">
              <JovieTooltip text="Import a new contact to Jovie">
                <div
                  @click="showCreatorModal = true"
                  class="rouned-md mb-2 flex cursor-pointer items-center rounded-md py-2 text-xs font-semibold text-gray-600 hover:bg-gray-200 hover:text-gray-900">
                  <PlusIcon
                    class="mr-1 h-5 w-5 rounded-md p-1 text-gray-500"
                    aria-hidden="true" />New Contact
                </div>
              </JovieTooltip>
              <JovieTooltip text="Upload a csv file to import contacts">
                <router-link
                  to="import"
                  class="rouned-md mb-2 flex cursor-pointer items-center justify-between rounded-md py-2 text-xs font-semibold text-gray-600 hover:bg-gray-200 hover:text-gray-900">
                  <div class="flex items-center">
                    <CloudArrowUpIcon
                      class="mr-1 h-5 w-5 rounded-md p-1 text-sky-400"
                      aria-hidden="true" />Upload A CSV
                  </div>
                  <div class="items-center">
                    <CreatorTags
                      v-if="!currentUser.current_team.current_subscription"
                      :showX="false"
                      text="Pro"
                      color="blue" />
                  </div>
                </router-link>
              </JovieTooltip>

              <div class="mt-1 flex items-center justify-between py-1">
                <ProgressBar
                  invertedColor
                  :percentage="
                    100 -
                    (currentUser.current_team.credits /
                      (currentUser.current_team.current_subscription?.credits ||
                        10)) *
                      100
                  "
                  :label="
                    (currentUser.current_team.current_subscription?.credits ||
                      10) -
                    currentUser.current_team.credits +
                    ' of ' +
                    (currentUser.current_team.current_subscription?.credits ||
                      10) +
                    ' contacts'
                  " />

                <Menu>
                  <Float portal :offset="0" shift placement="right-end">
                    <MenuButton
                      as="div"
                      class="rounded-full p-1 text-gray-400 transition duration-300 ease-in-out hover:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 active:bg-gray-100 active:text-gray-700"
                      id="notification-button"
                      aria-expanded="false"
                      aria-haspopup="true"
                      @click="getNotifications()">
                      <span class="sr-only">Open import notification</span>
                      <span
                        v-if="newNotification"
                        class="absolute top-6 -mt-1 ml-4 flex h-1 w-1">
                        <span
                          class="absolute inline-flex h-full w-full animate-ping rounded-full bg-indigo-400 opacity-75"></span>
                        <span
                          class="relative inline-flex h-1 w-1 rounded-full bg-indigo-500"></span>
                      </span>

                      <BellIcon
                        class="h-4 w-4 flex-shrink-0 cursor-pointer"
                        aria-hidden="true">
                      </BellIcon>
                    </MenuButton>

                    <transition
                      enter-active-class="transition duration-150 ease-out"
                      enter-from-class="transform scale-95 opacity-0"
                      enter-to-class="transform scale-100 opacity-100"
                      leave-active-class="transition duration-150 ease-out"
                      leave-from-class="transform scale-100 opacity-100"
                      leave-to-class="transform scale-95 opacity-0">
                      <MenuItems
                        class="z-10 w-96 transform rounded-lg border border-gray-200 bg-white/60 bg-clip-padding px-2 pb-2 pt-1 shadow-lg outline-0 ring-0 backdrop-blur-2xl backdrop-saturate-150 backdrop-filter focus:border-transparent focus:ring-0 focus:ring-transparent focus:ring-offset-0 sm:px-0">
                        <div class="overflow-hidden rounded-lg">
                          <div class="relative h-80 gap-6 px-1 sm:gap-8">
                            <div
                              class="mx-auto inline-flex w-full items-center border-b pb-1">
                              <p
                                class="px-2 pt-2 text-xs font-bold text-gray-400">
                                Notifications
                              </p>
                            </div>
                            <div
                              class="overflow-y-scroll"
                              v-if="notifications.length">
                              <template
                                v-for="notification in notifications"
                                :key="notification.id">
                                <div
                                  v-if="notification.is_batch"
                                  as="div"
                                  class="inline-flex w-full border-b px-2 py-2 text-xs text-gray-700 first:pt-3"
                                  role="menuitem"
                                  tabindex="-1">
                                  <router-link
                                    to="/imports"
                                    class="0 group block flex-shrink-0">
                                    <div
                                      class="flex w-full items-center justify-between">
                                      <div class="px-2">
                                        <component
                                          class="mx-auto h-5 w-5 text-gray-400"
                                          :is="'CloudArrowUpIcon'">
                                        </component>
                                      </div>
                                      <div class="ml-3 w-60">
                                        <p
                                          class="justify-between text-2xs font-medium uppercase text-gray-700 group-hover:text-gray-900">
                                          {{ notification.message }}
                                          <span
                                            class="text-2xs font-light text-gray-500"
                                            >-
                                            {{ notification.typeMessage }}</span
                                          >
                                        </p>
                                        <div class="w-full">
                                          <span
                                            class="text-2xs font-medium text-gray-500">
                                            Total:
                                            {{
                                              notification.initial_total_in_file
                                            }}
                                          </span>
                                          |
                                          <span
                                            class="text-2xs font-medium text-gray-500">
                                            Successful:
                                            {{ notification.successful }}
                                          </span>
                                        </div>
                                        <ProgressBar
                                          :percentage="notification.progress"
                                          class="mx-auto w-full" />
                                      </div>
                                      <div
                                        class="mx-auto px-2 font-bold text-gray-300 line-clamp-2">
                                        {{ notification.created_at_formatted }}
                                      </div>
                                    </div>
                                  </router-link>
                                </div>
                                <div
                                  v-else
                                  as="div"
                                  class="inline-flex w-full border-b px-2 py-2 text-xs text-gray-700 first:pt-3"
                                  role="menuitem"
                                  tabindex="-1">
                                  <router-link
                                    to="/imports"
                                    class="0 group block flex-shrink-0">
                                    <div
                                      class="flex w-full items-center justify-between">
                                      <div class="px-2">
                                        <component
                                          class="mx-auto h-5 w-5 text-gray-400"
                                          :is="'CloudArrowUpIcon'">
                                        </component>
                                      </div>
                                      <div class="ml-3 w-60">
                                        <p
                                          class="mx-auto text-2xs text-red-400"
                                          v-if="
                                            !notification.is_error &&
                                            notification.meta &&
                                            notification.meta.total_jobs
                                          ">
                                          Completed
                                          {{ notification.meta.type }} import at
                                          {{ notification.created_at }}
                                        </p>
                                        <p
                                          class="mx-auto text-2xs text-red-400"
                                          v-else-if="notification.is_error">
                                          {{ notification.message }}
                                          <span
                                            v-if="
                                              notification.meta &&
                                              notification.meta.name
                                            ">
                                            <b
                                              >({{ notification.meta.name }})</b
                                            ></span
                                          >
                                        </p>
                                        <p
                                          class="mx-auto text-2xs text-blue-500"
                                          v-else>
                                          {{ notification.message }}
                                        </p>
                                      </div>
                                      <div
                                        class="mx-auto px-2 font-bold text-gray-300 line-clamp-2">
                                        {{ notification.created_at_formatted }}
                                      </div>
                                    </div>
                                  </router-link>
                                </div>
                              </template>
                            </div>
                            <div
                              class="mx-auto w-full items-center py-4 text-center"
                              v-else>
                              <span
                                class="mx-auto items-center text-sm font-bold text-gray-400"
                                ><FaceSmileIcon
                                  class="mx-auto h-14 w-14 text-gray-200" />No
                                notifications</span
                              >
                            </div>
                          </div>
                        </div>
                      </MenuItems>
                    </transition>
                  </Float>
                </Menu>
              </div>
              <div
                v-if="!currentUser.current_team.credits"
                class="flex items-center justify-between">
                <div class="flex items-center px-2">
                  <span class="text-2xs text-gray-400"
                    >Account quota exceeded
                  </span>
                  <ChevronRightIcon
                    class="h-3 w-3 text-gray-400"
                    aria-hidden="true" />
                </div>
                <div
                  as="router-link"
                  to="/billing"
                  class="underline-2 cursor-pointer text-center text-xs font-bold text-indigo-500 decoration-indigo-700 hover:underline">
                  Upgrade
                </div>
              </div>
            </div>
          </div>
        </TransitionRoot>

        <div
          class="h-full w-full overflow-hidden transition-all duration-200 ease-in-out">
          <div class="mx-auto h-full w-full">
            <div class="h-full w-full">
              <div class="flex h-full w-full flex-col">
                <div class="mx-auto h-full w-full p-0">
                  <div class="inline-block h-full w-full align-middle">
                    <div class="h-full w-full">
                      <!--  Show import screen if no creators -->
                      <div
                        v-if="!loading && !creators.length && !showImporting"
                        class="mx-auto h-full max-w-7xl items-center px-4 sm:px-6 lg:px-8">
                        <div class="mx-auto max-w-xl">
                          <div
                            class="container mx-auto mt-24 max-w-3xl py-24 px-4 sm:px-6 lg:px-8">
                            <div>
                              <h1 class="text-md font-bold">
                                You don't have any contacts yet.
                              </h1>
                              <span class="text-sm font-medium text-gray-900"
                                >Enter a Twitch or Instagram url to add someone
                                to Jovie.</span
                              >
                            </div>
                            <SocialInput
                              class="py-12"
                              :list="filters.list"
                              @finishImport="closeImportCreatorModal" />
                            <InternalMarketingChromeExtension class="mt-24" />
                          </div>
                        </div>
                      </div>
                      <!-- Show loading screen if the users first ever import is loading -->

                      <div
                        v-else-if="showImporting && !creators.length"
                        class="mx-auto h-full max-w-7xl items-center px-4 sm:px-6 lg:px-8">
                        <div class="mx-auto max-w-xl">
                          <div
                            class="container mx-auto mt-24 max-w-3xl py-24 px-4 sm:px-6 lg:px-8">
                            <div>
                              <ArrowPathIcon
                                class="mt-1 mr-2 h-4 w-4 animate-spin-slow items-center" />
                              <h1 class="text-md font-bold">
                                You've just initated an import.
                              </h1>
                              <span class="text-sm font-medium text-gray-900"
                                >You'll see creators populate this space
                                soon.</span
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Show the crm if there are creators -->
                      <CrmTable
                        class="overflow-hidden"
                        v-else
                        ref="crmTable"
                        @updateCreator="updateCreator"
                        @updateCrmMeta="updateCrmMeta"
                        @crmCounts="crmCounts"
                        :counts="counts"
                        @updateListCount="updateListCount"
                        @pageChanged="pageChanged"
                        @setCurrentContact="setCurrentContact"
                        @openSidebar="openSidebarContact"
                        @setOrder="setOrder"
                        :header="filters.type"
                        @importCSV="importCSV"
                        :subheader="counts"
                        :filters="filters"
                        :userLists="userLists"
                        :creators="creators"
                        :networks="networks"
                        :stages="stages"
                        :creatorsMeta="creatorsMeta"
                        :loading="loading">
                        <slot header="header"></slot>
                      </CrmTable>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <TransitionRoot
          :show="$store.state.ContactSidebarOpen"
          enter="transition ease-in-out duration-300 transform"
          enter-from="translate-x-full"
          enter-to="-translate-x-0"
          leave="transition ease-in-out duration-300 transform"
          leave-from="-translate-x-0"
          leave-to="translate-x-full">
          <aside class="z-30 hidden h-full border-l border-gray-200 xl:block">
            <ContactSidebar
              @updateCrmMeta="updateCrmMeta"
              :jovie="true"
              :creatorsData="currentContact" />
          </aside>
        </TransitionRoot>
      </div>

      <ImportCreatorModal
        :open="showCreatorModal"
        :list="filters.list"
        @closeModal="closeImportCreatorModal" />

      <EmojiPickerModal
        v-show="openEmojis"
        @emojiSelected="emojiSelected($event)"
        class="absolute left-60 w-4 cursor-pointer select-none items-center rounded-md bg-gray-50 text-center text-xs transition-all">
      </EmojiPickerModal>
    </div>
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
  TransitionRoot,
  TransitionChild,
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverGroup,
} from '@headlessui/vue';
import {
  ChevronDownIcon,
  CreditCardIcon,
  CogIcon,
  ChevronRightIcon,
  CloudArrowDownIcon,
  CheckIcon,
  UserGroupIcon,
  EllipsisVerticalIcon,
  PlusIcon,
  PlusCircleIcon,
  HeartIcon,
  UserIcon,
  ArchiveBoxIcon,
  CloudArrowUpIcon,
  ArrowLeftOnRectangleIcon,
  ArrowPathIcon,
  BellIcon,
} from '@heroicons/vue/24/solid';

import UserService from '../services/api/user.service';
import CrmTable from '../components/Crm/CrmTable';
import ImportCreatorModal from '../components/ImportCreatorModal';
import SocialInput from '../components/SocialInput';
import InternalMarketingChromeExtension from '../components/InternalMarketingChromeExtension';
import MenuList from '../components/MenuList';
import ProgressBar from '../components/ProgressBar';
import SwitchTeams from '../components/SwitchTeams';
import JovieTooltip from '../components/JovieTooltip.vue';
import EmojiPickerModal from '../components/EmojiPickerModal.vue';
import ContactSidebar from '../components/ContactSidebar.vue';
import VueMousetrapPlugin from 'vue-mousetrap';
import CreatorTags from '../components/Creator/CreatorTags.vue';
import { Float } from '@headlessui-float/vue';
import JovieDropdownMenu from '../components/JovieDropdownMenu.vue';
import ImportService from '../services/api/import.service';

export default {
  name: 'CRM',
  components: {
    CreditCardIcon,
    UserIcon,
    CogIcon,
    ArrowPathIcon,
    EmojiPickerModal,
    Float,
    CloudArrowDownIcon,
    PlusIcon,
    PlusCircleIcon,
    SwitchTeams,
    TabGroup,
    Menu,
    MenuItem,
    MenuItems,
    PopoverGroup,
    Popover,
    MenuList,
    PopoverButton,
    PopoverPanel,
    HeartIcon,
    ContactSidebar,
    ProgressBar,
    TabList,
    Tab,
    InternalMarketingChromeExtension,
    ImportCreatorModal,
    SocialInput,
    TransitionRoot,
    TabPanels,
    TabPanel,
    MenuList,
    ChevronRightIcon,
    Combobox,
    EllipsisVerticalIcon,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    ChevronDownIcon,
    CheckIcon,
    ArchiveBoxIcon,
    ArrowLeftOnRectangleIcon,
    UserGroupIcon,
    CloudArrowUpIcon,
    CrmTable,
    JovieTooltip,
    vueMousetrapPlugin: VueMousetrapPlugin,
    CreatorTags,
    TransitionChild,
    JovieDropdownMenu,
    BellIcon,
  },
  data() {
    return {
      dropdownmenuitems: [
        {
          name: 'Chrome Extension',
          route: '/chrome-extension',
          badge: 'Download',
          badgeColor: 'pink',
          icon: CloudArrowDownIcon,
        },
        { name: 'Billing', route: '/billing', icon: CreditCardIcon },
        { name: 'Settings', route: 'Account', icon: CogIcon },
      ],
      counts: {},
      stages: [],
      networks: [],
      userLists: [],
      showCreatorModal: false,
      loading: false,
      creatorsMeta: {},
      /*  activeCreator: [], */
      currentContact: [],
      innerWidth: window.innerWidth,
      profileLink: this.$store.state.AuthState.user.username || '',
      lists: [],
      profileMenuItems: [
        {
          id: 2,
          name: 'Settings',
          route: 'Account',
          icon: 'CogIcon',
        },
        {
          id: 3,
          name: 'Billing',
          route: '/billing',
          icon: 'CreditCardIcon',
        },
        {
          id: 4,
          name: 'Slack Community',
          route: '/slack-community',
          icon: 'LifebuoyIcon',
        },
        {
          id: 5,
          name: 'Chrome Extension',
          route: '/chrome-extension',
          icon: 'CloudArrowDownIcon',
        },
      ],

      query: '',
      filters: {
        list: '',
        type: 'all',
        page: 1,
        sort: '',
        order: '',
      },
      searchList: '',
      abortController: null,
      openEmojis: false,
      selectedList: null,
      currentSortBy: 'id',
      currentSortOrder: 'desc',
    };
  },
  watch: {
    filters: {
      deep: true,
      handler: function (val) {
        delete val.page;
        localStorage.setItem('filters', JSON.stringify(val));
      },
    },
    creators: {
      deep: true,
      handler: function () {
        this.crmCounts();
      },
    },
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize());
  },
  computed: {
    showImporting() {
      if (this.userLists.length && this.filters.type == 'list') {
        let list = this.userLists.find((list) => list.id == this.filters.list);
        if (list) {
          return list.updating_list;
        }
      }
      return false;
    },
    sortedCreators() {
      return this.creators.sort((a, b) => {
        let modifier = 1;
        if (this.currentSortDir === 'desc') modifier = -1;
        if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
        if (a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
        return 0;
      });
    },
    filteredUsersLists() {
      if (!this.searchList) this.filters.list = null;
      let filters = localStorage.getItem('filters');
      if (filters) {
        this.filters = JSON.parse(filters);
      }
      return this.userLists.filter((list) =>
        list.name.toLowerCase().match(this.searchList.toLowerCase())
      );
    },
    pinnedUserLists() {
      return this.userLists.filter((list) => list.pinned);
    },
  },
  async mounted() {
    await this.getUserLists();
    this.getCrmCreators();
    this.crmCounts();
    this.$mousetrap.bind(['e'], console.log('working'));

    // this.getNotifications();
    // setInterval(() => {
    //   this.getNotifications();
    // }, 5000);
    this.listenEvents(
      `notification.${this.currentUser.current_team.id}`,
      'Notification',
      (data) => {
        this.newNotification = true;
      }
    );
    this.getNotifications();

    this.$nextTick(() => {
      window.addEventListener('resize', this.onResize());
    });

    if (!this.$store.state.crmEventsRegistered) {
      this.listenEvents(
        `userListDuplicated.${this.currentUser.current_team.id}`,
        'UserListDuplicated',
        async (data) => {
          await this.getUserLists();
          setTimeout(() => {
            let list = this.userLists.find((list) => list.id == data.list);
            if (list) {
              list.updating_list = null;
              this.setFilterList(list.id);
            }
          }, 200);
        }
      );

      this.listenEvents(
        `importListCreated.${this.currentUser.current_team.id}`,
        'ImportListCreated',
        async (data) => {
          await this.getUserLists();
          setTimeout(() => {
            let list = this.userLists.find((list) => list.id == data.list);
            if (list) {
              this.setFilterList(list.id);
            }
          }, 200);
        }
      );

      this.listenEvents(
        `userListImported.${this.currentUser.current_team.id}`,
        'UserListImported',
        (data) => {
          let index = this.userLists.findIndex((list) => list.id == data.list);
          if (index >= 0) {
            this.userLists[index].updating_list = null;
          }
          this.$store.state.showImportProgress = data.remaining;
          if (!data.remaining) {
            this.getUserLists();
          }
        }
      );

      this.listenEvents(
        `userListImportTriggered.${this.currentUser.current_team.id}`,
        'UserListImportTriggered',
        (data) => {
          let index = this.userLists.findIndex((list) => list.id == data.list);
          if (index >= 0) {
            this.userLists[index].updating_list = true;
            this.$store.state.showImportProgress = data.remaining;
          }
        }
      );

      this.listenEvents(
        `creatorImported.${this.currentUser.current_team.id}`,
        'CreatorImported',
        (data) => {
          if (!data.list) {
            this.$store.state.importProgressSingleCount--;
          }
          if (
            (data.list && this.filters.type != 'list') ||
            (!data.list && this.filters.type != 'all')
          ) {
            return;
          }

          if (
            (data.list && data.list == this.filters.list) ||
            this.filters.type == 'all'
          ) {
            let newCreator = JSON.parse(window.atob(data.creator));
            let index = this.creators.findIndex(
              (creator) => creator.id == newCreator.id
            );

            if (index >= 0) {
              this.creators[index] = newCreator;
            } else {
              if (this.filters.page === 1 && this.creators.length == 50) {
                this.creators.pop();
              }
              if (this.creators.length) {
                this.creators.splice(0, 0, newCreator);
              } else {
                this.creators.push(newCreator);
              }
            }
          }
        }
      );
      this.$store.state.crmEventsRegistered = true;
    }
  },
  methods: {
    getNotifications() {
      ImportService.getNotifications().then((response) => {
        response = response.data;
        if (response.status) {
          this.notifications = response.notifications;
          this.newNotification = false;
          this.$store.state.showImportProgress = this.notifications.filter(
            (notification) => {
              return notification.is_batch && notification.progress < 100;
            }
          ).length;
        }
      });
    },
    closeImportCreatorModal() {
      this.showCreatorModal = false;
    },
    onResize() {
      this.windowWidth = window.innerWidth;
    },
    openEmojiPicker(item) {
      this.selectedList = item;
      this.openEmojis = true;
    },
    emojiSelected(emoji) {
      //take the value of the selected emoji and set it to the emoji variable
      this.selectedList.emoji = emoji.i;
      this.$refs.menuListAll.updateList(
        JSON.parse(JSON.stringify(this.selectedList))
      );
      this.selectedList = null;
      this.openEmojis = false;
    },
    openSidebarContact(contact) {
      //if the sidebar is not open, open it and set the current contact
      if (!this.$store.state.ContactSidebarOpen) {
        this.$store.state.ContactSidebarOpen = true;
        this.currentContact = contact;
      } else {
        //if the sidebar is open and the current contact is the same as the one clicked, close the sidebar
        if (this.currentContact.id == contact.id) {
          this.$store.state.ContactSidebarOpen = false;
          this.currentContact = null;
        } else {
          //if the sidebar is open and the current contact is not the same as the one clicked, set the current contact to the one clicked
          this.currentContact = contact;
        }
      }
      /*  this.currentContact = contact;
      this.$store.state.ContactSidebarOpen = true; */
    },

    setCurrentContact(contact) {
      this.currentContact = contact;
    },
    setFiltersType(type) {
      this.filters.type = this.filters.type == type ? 'all' : type;
      this.filters.list = null;
      this.getCrmCreators();
    },
    setFilterList(list) {
      this.filters.type = 'list';
      this.filters.list = this.filters.list == list ? null : list;
      this.getCrmCreators();
    },
    sortLists(e, listId) {
      UserService.sortLists(
        { newIndex: e.newIndex, oldIndex: e.oldIndex },
        e.item.id
      )
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
          } else {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
            // show toast error here later
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
            if (this.errors.list[0]) {
              this.$notify({
                group: 'user',
                type: 'success',
                duration: 15000,
                title: 'Successful',
                text: this.errors.list[0],
              });
            }
          }
        })
        .finally((response) => {});
    },
    getUserLists() {
      UserService.getUserLists().then((response) => {
        response = response.data;
        if (response.status) {
          this.userLists = [];
          this.userLists = response.lists;
        }
      });
    },
    pageChanged({ page }) {
      this.filters.page = page;
      this.getCrmCreators();
    },
    changeTab(index) {
      Object.assign(this.$data, this.$options.data());
      if (index == 1) {
        this.filters.archived = 1;
      } else {
        this.filters.archived = 0;
      }
    },
    setOrder({ sortBy, sortOrder }) {
      this.filters.sort = sortBy;
      this.filters.order = sortOrder;
    },
    getCrmCreators(filters = {}) {
      this.loading = true;
      let data = JSON.parse(JSON.stringify(this.filters));
      if (this.abortController) {
        this.abortController.abort();
      }
      this.abortController = new AbortController();
      const signal = this.abortController.signal;
      UserService.getCrmCreators(data, signal).then((response) => {
        this.loading = false;
        response = response.data;
        if (response.status) {
          this.$store.commit('setCrmRecords', response.creators.data);
          this.networks = response.networks;
          this.stages = response.stages;
          this.counts = response.counts;
          this.creatorsMeta = response.creators;
          this.filters.page = response.creators.current_page;
        }
      });
    },
    crmCounts() {
      UserService.crmCounts().then((response) => {
        response = response.data;
        if (response.status) {
          this.counts = response.counts;
        }
      });
    },
    updateListCount(params) {
      let list = this.userLists.find((list) => list.id == params.list_id);
      if (list) {
        if (params.remove) {
          list.creators_count -= params.count;
        } else {
          list.creators_count += params.count;
        }
      }
    },
    exportCrmCreators() {
      let obj = JSON.parse(JSON.stringify(this.filters));
      if (obj.list) {
        obj.list = obj.list.id;
      }
      UserService.exportCrmCreators(obj).then((response) => {
        var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');

        fileLink.href = fileURL;
        fileLink.setAttribute(
          'download',
          `${this.filters.list ? this.filters.list.name : 'creators'}.csv`
        );
        document.body.appendChild(fileLink);

        fileLink.click();
      });
    },
    updateCreator(params) {
      this.$store.dispatch('updateCreator', params).then((response) => {
        response = response.data;
        if (response.status) {
          if (response.data == null) {
            this.creators.splice(params.index, 1);
          } else {
            this.creators[params.index] = response.data;
          }
          this.crmCounts();
        }
      });
    },
    updateCrmMeta(creator = null) {
      console.log('creator');
      console.log(creator);
      if (creator == null) {
        creator = this.currentContact;
      }
      if (!creator) return;
      this.$store
        .dispatch('updateCrmMeta', { id: creator.crm_id, meta: creator.meta })
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.currentContact = response.data;
            this.crmCounts();
          }
        });
    },
  },
};
</script>

<style scoped></style>
