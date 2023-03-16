<template>
  <div class="h-full w-full dark:bg-jovieDark-900">
    <div id="crm" class="mx-auto flex h-full w-full min-w-full">
      <div class="flex h-full w-full">
        <JovieSidebar @toggleShowSupportModal="toggleShowSupportModal()">
          <template #main>
            <div class="">
              <div class="mt-2 w-full px-4">
                <div
                  class="rouned-md group mx-auto my-2 flex w-40 cursor-pointer items-center justify-between rounded-md border bg-slate-100 bg-slate-400 py-1 px-2 text-xs font-semibold text-slate-600 hover:bg-slate-300 dark:border-jovieDark-border dark:bg-jovieDark-border dark:text-jovieDark-300 hover:dark:bg-jovieDark-600">
                  <div class="flex items-center text-xs">
                    <PlusIcon
                      class="mr-1 h-5 w-5 rounded-md p-1 text-xs text-purple-600 dark:text-purple-400"
                      aria-hidden="true" />
                      <Menu>
                          <Float portal :offset="2" placement="bottom-start">
                              <MenuButton
                                  class="inline-flex items-center rounded border border-slate-300 py-0.5 px-2 text-2xs font-light text-slate-700 hover:bg-slate-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30 dark:border-jovieDark-border dark:border-jovieDark-border dark:text-jovieDark-300 dark:hover:bg-jovieDark-800">
                                  <ChatBubbleLeftIcon
                                      class="h-3 w-3 text-slate-400 hover:text-slate-500 dark:text-jovieDark-600 dark:hover:text-slate-400"
                                      aria-hidden="true" />
                                  <span class="px-2 text-center line-clamp-1">New Contact</span>
                                  <ChevronDownIcon
                                      class="-mr-1 h-4 w-4 text-slate-400 hover:text-slate-500 dark:text-jovieDark-600 dark:hover:text-slate-400"
                                      aria-hidden="true" />
                              </MenuButton>
                              <transition
                                  enter-active-class="transition duration-100 ease-out"
                                  enter-from-class="transform scale-95 opacity-0"
                                  enter-to-class="transform scale-100 opacity-100"
                                  leave-active-class="transition duration-75 ease-in"
                                  leave-from-class="transform scale-100 opacity-100"
                                  leave-to-class="transform scale-95 opacity-0">
                                  <MenuItems
                                      class="z-10 mt-2 w-48 origin-top-right rounded-md border border-slate-300 bg-white/60 py-1 px-1 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl backdrop-saturate-150 backdrop-filter focus-visible:outline-none dark:border-jovieDark-border dark:bg-jovieDark-900/60">
                                      <div class="py-1">
                                          <DropdownMenuItem
                                              @click="openImportContactModal()"
                                              name="New Contact"
                                              color="text-blue-600 dark:text-blue-400"
                                              icon="PhoneIcon" />
                                          <DropdownMenuItem
                                              @click="openImportContactModal(true)"
                                              name="Import contact from social"
                                              color="text-blue-600 dark:text-blue-400"
                                              icon="PhoneIcon" />
                                      </div>
                                  </MenuItems>
                              </transition>
                          </Float>
                      </Menu>
                  </div>
                  <div class="items-center">
                    <KBShortcut shortcutKey="C"></KBShortcut>
                  </div>
                </div>
              </div>

              <Menu v-slot="{ open }">
                <MenuItems static>
                  <div class="w-full flex-col px-2">
                    <MenuItem class="w-full" v-slot="{ active }" as="div">
                      <button
                        @click="setFiltersType('all')"
                        class="group mt-4 flex h-8 w-full items-center justify-between rounded-md px-1 text-left tracking-wide focus:outline-none focus:ring-0"
                        :class="[
                          filters.type == 'all'
                            ? 'text-sm font-bold text-slate-900 dark:text-jovieDark-100 '
                            : 'text-sm font-light text-slate-900 dark:text-jovieDark-100',
                          active
                            ? 'bg-slate-200 text-slate-700 dark:bg-jovieDark-border dark:text-jovieDark-100'
                            : '',
                        ]">
                        <div class="flex items-center text-xs">
                          <ChevronRightIcon
                            @click="toggleContactMenuOpen"
                            :class="[
                              contactMenuOpen ? 'rotate-90 transform' : '',
                            ]"
                            class="mr-1 h-5 w-5 rounded-md p-1 text-slate-400 dark:text-jovieDark-400"
                            aria-hidden="true">
                          </ChevronRightIcon>
                          All Contacts
                        </div>
                        <div
                          @click="showCreatorModal = true"
                          class="items-center rounded-md p-1 hover:bg-slate-300 hover:text-slate-50 hover:dark:bg-jovieDark-600 hover:dark:text-jovieDark-900">
                          <span
                            class="text-xs font-light text-slate-900 group-hover:hidden group-hover:text-slate-900 dark:text-jovieDark-100 group-hover:dark:text-jovieDark-100"
                            >{{ counts.total }}</span
                          >
                          <PlusIcon
                            class="hidden h-3 w-3 text-slate-400 active:text-white group-hover:block"></PlusIcon>
                        </div>
                      </button>
                    </MenuItem>
                    <TransitionRoot
                      :show="contactMenuOpen"
                      transition="transition ease-out duration-300"
                      enter-from="transform opacity-0 scale-95"
                      enter-to="transform opacity-100 scale-100"
                      leave-from="transform opacity-100 scale-100"
                      leave-to="transform opacity-0 scale-95">
                      <div class="pl-4">
                        <MenuItem
                          class="w-full"
                          as="div"
                          @click="setFiltersType('favourites')"
                          v-slot="{ active }">
                          <button
                            class="group flex h-8 w-full items-center justify-between rounded-md px-1 py-1 text-left tracking-wide"
                            :class="[
                              filters.type == 'favourites'
                                ? 'text-sm font-bold text-slate-900 dark:text-jovieDark-100 '
                                : 'text-sm font-light text-slate-900 dark:text-jovieDark-100',
                              active
                                ? 'bg-slate-200 text-slate-700 dark:bg-jovieDark-border dark:text-jovieDark-100'
                                : '',
                            ]">
                            <div class="flex items-center text-xs">
                              <HeartIcon
                                class="mr-1 h-5 w-5 rounded-md p-1 text-red-400"
                                aria-hidden="true" />Favorited
                            </div>
                            <div
                              class="items-center rounded-md p-1 hover:text-slate-50">
                              <span
                                class="text-xs font-light text-slate-700 group-hover:text-slate-900 dark:text-jovieDark-300 dark:group-hover:text-slate-100"
                                >{{ counts.favourites }}</span
                              >
                            </div>
                          </button>
                        </MenuItem>
                        <MenuItem
                          as="div"
                          @click="setFiltersType('archived')"
                          v-slot="{ active }">
                          <button
                            class="group flex h-8 w-full items-center justify-between rounded-md px-1 py-1 text-left tracking-wide"
                            :class="[
                              filters.type == 'archived'
                                ? 'text-sm font-bold text-slate-900 dark:text-jovieDark-100 '
                                : 'text-sm font-light text-slate-900 dark:text-jovieDark-100',
                              active
                                ? 'bg-slate-200 text-slate-700 dark:bg-jovieDark-border dark:text-jovieDark-100'
                                : '',
                            ]">
                            <div class="flex items-center text-xs">
                              <ArchiveBoxIcon
                                class="mr-1 h-5 w-5 rounded-md p-1 text-sky-400"
                                aria-hidden="true" />Archived
                            </div>
                            <div
                              class="items-center rounded-md p-1 hover:text-slate-50 dark:hover:text-slate-800">
                              <span
                                class="text-xs font-light text-slate-700 group-hover:text-slate-900 dark:text-jovieDark-300 dark:group-hover:text-slate-100"
                                >{{ counts.archived }}</span
                              >
                            </div>
                          </button>
                        </MenuItem>
                      </div>
                    </TransitionRoot>
                  </div>
                  <div
                    class="flex-col justify-evenly space-y-4 overflow-auto px-2 py-4">
                    <Suspense>
                      <template #default>
                        <MenuList
                          v-if="pinnedUserLists.length"
                          ref="menuListPinned"
                          @getUserLists="getUserLists"
                          @setFiltersType="setFiltersType"
                          menuName="Pinned"
                          :selectedList="filters.list"
                          @onListDrop="onListDrop($event)"
                          @updateUserList="updateUserList($event)"
                          @setFilterList="setFilterList"
                          @updateMenuItems="pinnedUserLists = $event"
                          :menuItems="pinnedUserLists"></MenuList>
                      </template>
                      <template #fallback> Loading... </template>
                    </Suspense>
                    <!--    Team Specific Lists -->
                    <Suspense>
                      <template #default>
                        <MenuList
                            :key="listKey"
                          ref="menuListAll"
                          @getUserLists="getUserLists"
                          @setFiltersType="setFiltersType"
                          menuName="Lists"
                          @setFilterList="setFilterList"
                          :selectedList="filters.list"
                          :draggable="true"
                          @updateUserList="updateUserList($event)"
                          @onListDrop="onListDrop($event)"
                          @end="sortLists"
                          @updateMenuItems="filteredUsersLists = $event"
                          :menuItems="filteredUsersLists"></MenuList>
                      </template>
                      <template #fallback> Loading... </template>
                    </Suspense>
                  </div>
                </MenuItems>
              </Menu>
            </div>
          </template>
          <template #footer>
            <div>
              <div class="py-2">
                <AlertBanner
                  sidebar
                  class="hidden sm:block"
                  v-if="this.$store.state.chromeExtensionInstalled === false"
                  design="primary"
                  :mobiletitle="`Install Jovie Chrome Extension`"
                  :title="`Install Chrome Extension`"
                  :cta="`Install Extension`"
                  :subtitle="`Eeasily add contacts from any website.`"
                  ctaLink="chrome-extension" />
              </div>

              <div
                class="flex-shrink-0 border-t border-slate-200 py-2 px-2 dark:border-jovieDark-border">
                <Menu>
                  <MenuItems static>
                    <MenuItem as="div" v-slot="{ active }">
                      <router-link
                        to="import"
                        :class="[
                          active
                            ? 'bg-slate-200  text-slate-900 dark:bg-jovieDark-border dark:text-jovieDark-100'
                            : 'text-slate-700',
                        ]"
                        class="rouned-md mb-2 flex cursor-pointer items-center justify-between rounded-md py-2 text-xs font-semibold text-slate-600 dark:text-jovieDark-300">
                        <div class="flex items-center">
                          <CloudArrowUpIcon
                            class="mr-1 h-5 w-5 rounded-md p-1 text-sky-400 dark:text-sky-400"
                            aria-hidden="true" />Upload A CSV
                        </div>
                        <div class="items-center">
                          <ContactTags
                            v-if="
                              !currentUser.current_team.current_subscription
                            "
                            :showX="false"
                            text="Pro"
                            color="blue" />
                        </div>
                      </router-link>
                    </MenuItem>
                    <MenuItem v-slot="{ active }" as="div">
                      <div
                        @click="toggleShowSupportModal()"
                        :class="[
                          active
                            ? 'bg-slate-200 text-slate-700 dark:bg-jovieDark-border dark:text-jovieDark-100'
                            : '',
                          'mb-2 flex cursor-pointer items-center rounded-md py-2 text-xs font-semibold text-slate-600 hover:text-slate-900 dark:text-jovieDark-300 hover:dark:text-jovieDark-100',
                        ]">
                        <ChatBubbleLeftIcon
                          class="mr-1 h-5 w-5 rounded-md p-1 text-pink-500 dark:text-pink-600"
                          aria-hidden="true" />
                        Help & Support
                      </div>
                    </MenuItem>
                  </MenuItems>
                </Menu>
                <div class="mt-1 flex items-center justify-between py-1">
                  <div
                    @click="openUpgradeModal()"
                    class="mr-1 flex w-full cursor-pointer items-center justify-between rounded-md border border-slate-200 py-2 px-2 shadow-sm hover:bg-slate-50 dark:border-jovieDark-border dark:bg-jovieDark-800">
                    <div class="flex items-center">
                      <ArrowUpCircleIcon class="mr-1 h-4 w-4 text-slate-500" />
                      <span
                        class="text-xs text-slate-700 dark:text-jovieDark-100"
                        >Free Plan</span
                      >
                    </div>
                    <div class="flex items-center">
                      <span
                        class="cursor-pointer items-center text-2xs text-indigo-700 dark:text-indigo-400"
                        >Learn more</span
                      >
                    </div>
                  </div>

                  <Menu>
                    <Float portal :offset="0" shift placement="right-end">
                      <MenuButton
                        as="div"
                        class="rounded-full p-1 text-slate-400 transition duration-300 ease-in-out hover:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 active:bg-slate-100 active:text-slate-700"
                        id="notification-button"
                        aria-expanded="false"
                        aria-haspopup="true"
                        @click="getNotifications()">
                        <span class="sr-only">Open import notification</span>
                        <span
                          v-if="newNotification"
                          class="absolute top-6 -mt-1 ml-4 flex h-1 w-1">
                          <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-indigo-400 opacity-75 dark:bg-indigo-600"></span>
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
                        <MenuItems>
                          <GlassmorphismContainer
                            class="z-10 w-96 transform rounded-lg px-2 pb-2 pt-1 outline-0 ring-0 focus-visible:border-transparent focus-visible:ring-0 focus-visible:ring-transparent focus-visible:ring-offset-0 sm:px-0">
                            <div class="overflow-hidden rounded-lg">
                              <div class="relative h-80 gap-6 px-1 sm:gap-8">
                                <div
                                  class="mx-auto inline-flex w-full items-center border-b pb-1">
                                  <p
                                    class="px-2 pt-2 text-xs font-bold text-slate-400">
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
                                      class="inline-flex w-full border-b px-2 py-2 text-xs text-slate-700 first:pt-3"
                                      role="menuitem"
                                      tabindex="-1">
                                      <router-link
                                        to="/imports"
                                        class="0 group block flex-shrink-0">
                                        <div
                                          class="flex w-full items-center justify-between">
                                          <div class="px-2">
                                            <component
                                              class="mx-auto h-5 w-5 text-slate-400"
                                              :is="'CloudArrowUpIcon'">
                                            </component>
                                          </div>
                                          <div class="ml-3 w-full">
                                            <p
                                              class="justify-between text-2xs font-medium uppercase text-slate-700 group-hover:text-slate-900 dark:text-jovieDark-300 hover:dark:text-jovieDark-100 dark:group-hover:text-slate-100">
                                              {{ notification.message }}
                                              <span
                                                class="text-2xs font-light text-slate-500"
                                                >-
                                                {{
                                                  notification.typeMessage
                                                }}</span
                                              >
                                            </p>
                                            <div class="w-full">
                                              <span
                                                class="text-2xs font-medium text-slate-500">
                                                Total:
                                                {{
                                                  notification.initial_total_in_file
                                                }}
                                              </span>
                                              |
                                              <span
                                                class="text-2xs font-medium text-slate-500">
                                                Successful:
                                                {{ notification.successful }}
                                              </span>
                                            </div>
                                            <ProgressBar
                                              :percentage="
                                                notification.progress
                                              "
                                              class="mx-auto w-full" />
                                          </div>
                                          <div
                                            class="mx-auto px-2 font-bold text-slate-300 line-clamp-2">
                                            {{
                                              notification.created_at_formatted
                                            }}
                                          </div>
                                        </div>
                                      </router-link>
                                    </div>
                                    <div
                                      v-else
                                      as="div"
                                      class="inline-flex w-full border-b px-2 py-2 text-xs text-slate-700 first:pt-3"
                                      role="menuitem"
                                      tabindex="-1">
                                      <router-link
                                        to="/imports"
                                        class="0 group block flex-shrink-0">
                                        <div
                                          class="flex w-full items-center justify-between">
                                          <div class="px-2">
                                            <component
                                              class="mx-auto h-5 w-5 text-slate-400"
                                              :is="'CloudArrowUpIcon'">
                                            </component>
                                          </div>
                                          <div class="ml-3 w-full">
                                            <p
                                              class="mx-auto text-2xs text-red-400"
                                              v-if="
                                                !notification.is_error &&
                                                notification.meta &&
                                                notification.meta.total_jobs
                                              ">
                                              Completed
                                              {{ notification.meta.type }}
                                              import at
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
                                                  >({{
                                                    notification.meta.name
                                                  }})</b
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
                                            class="mx-auto px-2 font-bold text-slate-300 line-clamp-2">
                                            {{
                                              notification.created_at_formatted
                                            }}
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
                                    class="mx-auto items-center text-sm font-bold text-slate-400"
                                    ><FaceSmileIcon
                                      class="mx-auto h-14 w-14 text-slate-200" />No
                                    notifications</span
                                  >
                                </div>
                              </div>
                            </div>
                          </GlassmorphismContainer>
                        </MenuItems>
                      </transition>
                    </Float>
                  </Menu>

                  <DarkModeToggle />
                </div>
                <div
                  v-if="!currentUser.current_team.credits"
                  class="flex items-center justify-between">
                  <div class="flex items-center px-2">
                    <span class="text-2xs text-slate-400"
                      >Account quota exceeded
                    </span>
                    <ChevronRightIcon
                      class="h-3 w-3 text-slate-400"
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
          </template>
        </JovieSidebar>
        <div
          class="h-full w-full overflow-hidden transition-all duration-200 ease-in-out">
          <div class="mx-auto h-full w-full">
            <div class="h-full w-full">
              <div class="flex h-full w-full flex-col">
                <div class="mx-auto h-full w-full p-0">
                  <div class="inline-block h-full w-full align-middle">
                    <div class="h-full w-full dark:bg-jovieDark-900">
                      <!--  Show import screen if no contacts -->
                      <!--  <div
                        v-if="!loading && !contacts.length && !showImporting"
                        class="mx-auto h-full max-w-7xl items-center px-4 dark:bg-jovieDark-900 sm:px-6 lg:px-8">
                        <div class="mx-auto max-w-xl">
                          <div
                            class="container mx-auto mt-24 max-w-3xl py-24 px-4 sm:px-6 lg:px-8">
                            <div>
                              <h1
                                class="text-md font-bold dark:text-jovieDark-100">
                                You don't have any contacts yet.
                              </h1>
                              <span
                                class="text-sm font-medium text-slate-900 dark:text-jovieDark-200"
                                >Enter a Twitch or Instagram url to add someone
                                to Jovie.</span
                              >
                            </div>
                            <SocialInput
                              class="py-12"
                              :list="filters.list"
                              @finishImport="closeImportContactModal" />
                            <InternalMarketingChromeExtension class="mt-24" />
                          </div>
                        </div>
                      </div>


                      <div
                        v-else-if="showImporting && !contacts.length"
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
                              <span class="text-sm font-medium text-slate-900"
                                >You'll see contacts populate this space
                                soon.</span
                              >
                            </div>
                          </div>
                        </div>
                      </div> -->
                      <!-- Show the crm if there are contacts -->
                      <div>
                        <!--  <CrmTable
                          class="overflow-hidden"
                          ref="crmTable"
                          @addContact="showCreatorModal = true"
                          @updateContact="updateContact"
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
                          :contacts="contacts"
                          :networks="networks"
                          :stages="stages"
                          :contactsMeta="contactsMeta"
                          :loading="loading">
                          <slot header="header"></slot>
                        </CrmTable> -->
                        <DataGrid
                          v-if="columns.length"
                          class="overflow-hidden"
                          ref="crmTableGrid"
                          @addContact="showCreatorModal = true"
                          @updateContact="updateContact"
                          @crmCounts="crmCounts"
                          :counts="counts"
                          @updateListCount="updateListCount"
                          @pageChanged="pageChanged"
                          @getCrmContacts="getCrmContacts"
                          @setCurrentContact="setCurrentContact"
                          @openSidebar="openSidebarContact"
                          @getHeaders="getHeaders"
                          @getFields="getFields"
                          @setOrder="setOrder"
                          :header="filters.type === 'list' ? filters.currentList.name : filters.type"
                          @importCSV="importCSV"
                          :subheader="counts"
                          :filters="filters"
                          :userLists="userLists"
                          :networks="networks"
                          :stages="stages"
                          :columns="columns"
                          :loading="loading"
                          :taskLoading="taskLoading"
                          :headersLoaded="headersLoaded">
                          <slot header="header"></slot>
                        </DataGrid>
                      </div>
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
          <aside
            class="z-30 hidden h-full w-80 border-l border-slate-200 dark:border-jovieDark-border xl:block">
            <ContactSidebar
              @updateContact="updateContact"
              @getHeaders="getHeaders"
              :jovie="true"
              :contactData="currentContact" />
          </aside>
        </TransitionRoot>
      </div>
      <JovieUpgradeModal
        @close="closeUpgradeModal()"
        :open="showUpgradeModal" />
      <ImportContactModal
        :open="showContactModal"
        :fromSocial="importFromSocial"
        :list="filters.list"
        @contactImported="contactImported($event)"
        @closeModal="closeImportContactModal()" />

      <SupportModal
        @close="toggleShowSupportModal()"
        @message="launchSupportChat()"
        :open="showSupportModal" />
    </div>
  </div>
</template>

<script>
import GlassmorphismContainer from '../components/GlassmorphismContainer.vue';
import SupportModal from '../components/SupportModal.vue';
import JovieSidebar from '../components/JovieSidebar.vue';
import AlertBanner from '../components/AlertBanner.vue';
import MenuList from '../components/MenuList.vue';

import DarkModeToggle from '../components/DarkModeToggle.vue';

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
  ArrowUpCircleIcon,
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
  SunIcon,
  MoonIcon,
  ChatBubbleLeftIcon,
  SparklesIcon,
  ComputerDesktopIcon,
} from '@heroicons/vue/24/solid';
import DataGrid from '../components/DataGrid.vue';
import JovieUpgradeModal from '../components/JovieUpgradeModal.vue';

import UserService from '../services/api/user.service';
import CrmTable from '../components/Crm/CrmTable';
import ImportContactModal from '../components/ImportContactModal.vue';
import SocialInput from '../components/SocialInput';
import InternalMarketingChromeExtension from '../components/InternalMarketingChromeExtension';

import { defineAsyncComponent } from 'vue';
import ProgressBar from '../components/ProgressBar';
import SwitchTeams from '../components/SwitchTeams';

import ContactSidebar from '../components/ContactSidebar.vue';
import VueMousetrapPlugin from 'vue-mousetrap';
import ContactTags from '../components/Contact/ContactTags.vue';
import { Float } from '@headlessui-float/vue';
import JovieDropdownMenu from '../components/JovieDropdownMenu.vue';
import ImportService from '../services/api/import.service';
import KBShortcut from '../components/KBShortcut.vue';
import elementaryIcon from 'vue-simple-icons/icons/ElementaryIcon';
import FieldService from '../services/api/field.service';
import DropdownMenuItem from "../components/DropdownMenuItem.vue";

export default {
  name: 'CRM',
  components: {
      DropdownMenuItem,
    CreditCardIcon,
    JovieSidebar,
    UserIcon,
    CogIcon,
    ArrowUpCircleIcon,
    ArrowPathIcon,
    AlertBanner,
    GlassmorphismContainer,
    DataGrid,
    Float,
    CloudArrowDownIcon,
    PlusIcon,
    PlusCircleIcon,
    SwitchTeams,
    JovieUpgradeModal,
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
    ChatBubbleLeftIcon,
    ProgressBar,
    SupportModal,
    TabList,
    Tab,
    DarkModeToggle,
    InternalMarketingChromeExtension,
    ImportContactModal,
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
    KBShortcut,
    ChevronDownIcon,
    CheckIcon,
    ArchiveBoxIcon,
    ArrowLeftOnRectangleIcon,
    UserGroupIcon,
    CloudArrowUpIcon,
    SupportModal,
    CrmTable,
    vueMousetrapPlugin: VueMousetrapPlugin,
    ContactTags,
    TransitionChild,
    JovieDropdownMenu,
    BellIcon,
    SunIcon,
    SparklesIcon,
    MoonIcon,
    ComputerDesktopIcon,
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
      contactMenuOpen: true,
      counts: {},
      stages: [],
      networks: [],
      userLists: [],
      showCreatorModal: false,
      showSuccessModal: false,
      showSupportModal: false,
      showUpgradeModal: false,
      loading: false,
      taskLoading: false,
      contactsMeta: {},
      /*  activeCreator: [], */
      currentContact: [],
      innerWidth: window.innerWidth,

      lists: [],

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
      columns: [],
      crmCounting: false,
      listKey: 0,
      showContactModal: false,
      importFromSocial: false
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
    contacts: {
      deep: true,
      handler: function () {
        // this.crmCounts();
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
          return list.updating;
        }
      }
      return false;
    },
    sortedCreators() {
      return this.contacts.sort((a, b) => {
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
    await this.getHeaders();
    this.getCrmContacts();
    this.crmCounts();
    //c sets openCreatorModal to true
    this.$mousetrap.bind(['c'], () => {
      this.showCreatorModal = true;
    });
    //? sets openSupportModal to true
    this.$mousetrap.bind(['?'], () => {
      this.showSupportModal = true;
    });
    //shift+c redirect the page to /import
    this.$mousetrap.bind(['shift+c'], () => {
      this.$router.push('/import');
    });
    //enter key opens overview page
    this.$mousetrap.bind(['enter'], () => {
      this.$router.push('/overview');
    });

    // this.getNotifications();
    // setInterval(() => {
    //   this.getNotifications();
    // }, 5000);
    if (!this.$store.state.crmEventsRegistered) {
      this.listenEvents(
        `notification.${this.currentUser.current_team.id}`,
        'Notification',
        (data) => {
          this.newNotification = true;
        }
      );
      this.listenEvents(
        `userListDuplicated.${this.currentUser.current_team.id}`,
        'UserListDuplicated',
        async (data) => {
          this.getUserLists().then(() => {
              let list = this.userLists.find((list) => list.id == data.list);
              if (list) {
                  list.updating = null;
                  this.setFilterList(list.id);
              }
          })
        }
      );

      this.listenEvents(
        `importListCreated.${this.currentUser.current_team.id}`,
        'ImportListCreated',
        async (data) => {
          this.getUserLists().then(() => {
              let list = this.userLists.find((list) => list.id == data.list);
              if (list) {
                  this.setFilterList(list.id);
              }
          })
        }
      );

      this.listenEvents(
        `userListImported.${this.currentUser.current_team.id}`,
        'UserListImported',
        (data) => {
          this.getUserLists().then(() => {
              this.$store.state.showImportProgress = data.remaining;
              if (!data.remaining) {
                  this.getUserLists();
              }
          })
        }
      );

      this.listenEvents(
        `userListImportTriggered.${this.currentUser.current_team.id}`,
        'UserListImportTriggered',
        (data) => {
            this.getUserLists().then(() => {
                this.$store.state.showImportProgress = data.remaining;
            })
        }
      );

      this.listenEvents(
        `contactImported.${this.currentUser.current_team.id}`,
        'ContactImported',
        (data) => {
            console.log('datadata');
            console.log(data);
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
            let newContact = JSON.parse(window.atob(data.contact));
            let index = this.contacts.findIndex(
              (contact) => contact.id == newContact.id
            );
            if (index >= 0) {
              this.contacts[index] = newContact;
            } else if (! data.updating_existing) {
              if (this.filters.page === 1 && this.contacts.length == 50) {
                this.contacts.pop();
              }
              if (this.contacts.length) {
                this.contacts.splice(0, 0, newContact);
              } else {
                this.contacts.push(newContact);
              }
            }
          }
        }
      );
      this.$store.state.crmEventsRegistered = true;
    }

    this.getNotifications();

    this.$nextTick(() => {
      window.addEventListener('resize', this.onResize());
    });
  },
  methods: {
      openImportContactModal(fromSocial = false) {
          this.importFromSocial = fromSocial;
          this.$nextTick(() => {
              this.showContactModal = true;
          })
      },
      contactImported(data) {
          if (
              (data.list && data.list == this.filters.list) ||
              this.filters.type == 'all'
          ) {
              if (this.filters.page === 1 && this.contacts.length == 50) {
                  this.contacts.pop();
                  this.contacts.splice(0, 0, data.contact);
              } else {
                  this.contacts.push(data.contact);
              }
          }
      },
      updateUserList(event) {
          this.$refs.crmTableGrid.updateUserList(event)
      },
    getHeaders() {
      this.headersLoaded = false;
      FieldService.getHeaderFields(this.filters.list)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.headersLoaded = true;
            this.columns = [];
            this.columns = response.data;
          }
        })
        .catch((error) => {
            console.log('error');
            console.log(error);
          if (error.response && error.response.status == 422) {
            this.errors = error.data.errors;
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {
          // this.saving = false;
          this.headersLoaded = true;
        });
    },
    onListDrop(listId) {
      this.$refs.crmTableGrid.toggleContactsFromList(
        this.$store.state.currentlyDraggedContact,
        listId,
        false
      );
    },
    toggleShowSupportModal() {
      this.showSupportModal = !this.showSupportModal;
    },
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
    closeImportContactModal() {
      this.showContactModal = false;
    },
    closeUpgradeModal() {
      this.showUpgradeModal = !this.showUpgradeModal;
    },
    onResize() {
      this.windowWidth = window.innerWidth;
    },
    openUpgradeModal() {
      this.showUpgradeModal = true;
    },

    toggleContactMenuOpen() {
      this.contactMenuOpen = !this.contactMenuOpen;
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
    openSidebarContact(obj) {
      console.log('objobj');
      console.log(obj);
      let { contact, index } = obj;
      //if the sidebar is not open, open it and set the current contact
      contact.index = index;
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
      this.loading = true;
      this.filters.type = this.filters.type == type ? 'all' : type;
      this.filters.list = null;
      this.$store.state.overviewList = null
      this.filters.currentList = null;
      this.getCrmContacts();
      this.loading = false;
    },
    setFilterList(list) {
      this.filters.type = 'list';
      this.filters.list = this.filters.list == list ? null : list;
      if (this.filters.list) {
          list = this.userLists.find(l => l.id === list)
          this.filters.currentList = list ?? null
          this.$store.state.overviewList = list ?? null
      } else {
          this.filters.type = 'all';
          this.filters.currentList = null
          this.$store.state.overviewList = null
      }
      this.getCrmContacts();
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
            console.log('error');
            console.log(error);
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
        return new Promise((resolve, reject) => {
            UserService.getUserLists().then((response) => {
                response = response.data;
                if (response.status) {
                    this.listKey = this.listKey+1
                    this.userLists = [];
                    this.userLists = response.lists;
                    if (this.filters.list) {
                        let list = this.userLists.find(l => l.id === this.filters.list)
                        if (list) {
                            this.filters.currentList = list
                        }
                    }
                }
                return resolve()
            });
        })
    },
    pageChanged({ page }) {
      this.filters.page = page;
      this.getCrmContacts();
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
    getCrmContacts(filters = {}) {
      this.taskLoading = true;
      let data = JSON.parse(JSON.stringify(this.filters));
      if (this.abortController) {
        this.abortController.abort();
      }
      this.abortController = new AbortController();
      const signal = this.abortController.signal;
      UserService.getCrmContacts(data, signal).then((response) => {
        this.taskLoading = false;
        response = response.data;
        if (response.status) {
          this.$store.commit('setCrmRecords', response.contacts.data);
          this.networks = response.networks;
          this.stages = response.stages;
          this.counts.archived = response.counts.archived;
          this.counts.favourites = response.counts.favourites;
          this.counts.total = response.counts.total;
          this.contactsMeta = {
              current_page: response.contacts.current_page,
              first_page_url: response.contacts.first_page_url,
              from: response.contacts.from,
              last_page: response.contacts.last_page,
              last_page_url: response.contacts.last_page_url,
              next_page_url: response.contacts.next_page_url,
              path: response.contacts.path,
              per_page: response.contacts.per_page,
              prev_page_url: response.contacts.prev_page_url,
              to: response.contacts.to,
              total: response.contacts.total,
          };
          this.filters.page = response.contacts.current_page;
        }
      });
    },
    crmCounts() {
      if (this.crmCounting) {
        return;
      }
      this.crmCounting = true;
      UserService.crmCounts()
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.counts = response.counts;
            this.userLists.forEach(list => {
                this.counts[`list_${list.id}`] = list.contacts_count
            })
          }
        })
        .catch((error) => {
            console.log('error');
            console.log(error);
        })
        .finally(() => {
          this.crmCounting = false;
        });
    },
    updateListCount(params) {
      let list = this.userLists.find((list) => list.id == params.list_id);
      let selectedContacts = this.$store.state.crmRecords.filter((contact) =>
        params.contactIds.includes(contact.id)
      );
      if (list) {
        if (params.remove) {
          selectedContacts.forEach((contact) => {
            if (
              contact.user_lists.filter((list) => list.id != params.list.id).length
            ) {
              list.contacts_count -= 1;
            }
          });
        } else {
          selectedContacts.forEach((contact) => {
            if (
              contact.user_lists.filter((list) => list.id == params.list.id).length
            ) {
              list.contacts_count += 1;
            }
          });
        }
      }
    },
    exportCrmContacts() {
      let obj = JSON.parse(JSON.stringify(this.filters));
      if (obj.list) {
        obj.list = obj.list.id;
      }
      UserService.exportCrmContacts(obj).then((response) => {
        var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');

        fileLink.href = fileURL;
        fileLink.setAttribute(
          'download',
          `${this.filters.list ? this.filters.list.name : 'contacts'}.csv`
        );
        document.body.appendChild(fileLink);

        fileLink.click();
      });
    },
    updateContact(params) {
        console.log('paramsparams');
        console.log(params);
        this.$store.dispatch('updateContact', params).then((response) => {
        response = response.data;
        if (response.status) {
          if (response.data == null) {
            this.contacts.splice(params.index, 1);
          } else {
            this.contacts[params.index] = response.data;
          }
          this.crmCounts();
        }
      });
    },
  },
};
</script>

<style scoped></style>
