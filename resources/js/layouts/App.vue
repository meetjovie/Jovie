<template>
  <div id="app" class="flex h-screen overflow-hidden bg-neutral-100">
    <div
      id="overlay"
      class="fixed inset-0 flex md:hidden"
      role="dialog"
      aria-modal="true">
      <div
        class="fixed inset-0 bg-neutral-600 bg-opacity-75"
        aria-hidden="true"></div>

      <div
        id="sidebar"
        class="relative flex w-full flex-1 flex-col bg-neutral-500/50 pt-5 pb-4 backdrop-blur-md">
        <div class="mx-auto flex h-screen w-full items-center justify-center">
          <a href="{{ route('dashboard') }}">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              width="39px"
              height="11px">
              <image
                x="0px"
                y="0px"
                width="69px"
                height="20px"
                xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACcAAAALCAMAAADLE2RKAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABj1BMVEX//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7///+eFSkTAAAAg3RSTlMATdnCqN8nY/vWMVrkFSwhEwUQNDgOAygrEeqw0DN++fFPAtzRpdIZeakUz+XggqpCm220lAlZi4w9/r248IYGpPdE89eNZwwfUsbBcjW3d/ixfMBp7wvyMulu23aAYFBBP7XseDyJr/0mYWKj5+EPF+IKNuYbXKK7s1ehv2uPbBqSzKPEmjsAAAABYktHRIRi0FpxAAAAB3RJTUUH5gIEERYvU8bXwQAAAS5JREFUGNNlkOk3gkEYxW+bPcSrDYmSrZSdSJYsKWsk+15U9n1L3H/cvPnAyf0w95nfuXPPzACyFEqlCvlSazQFeaiQLPqXKyZL8lApWSZMW14BVOp0MtJVVUtSDaA3GE1/c2aYaknW1VsarI1oslntzQ5HC1rNAra1/+Y6TE7SJWAn6YZHeBep7yZ7egXv+8n1i+0AOYghL4dH6MMovf4xjk9MMgBMkdOYmfUYESTnQqQBcNIeJucXqIaKzkVyibKWsUJGsCr63KQErNEXNdO1zhhC3Ngkt7Z3doN7+zgQ6cMj8lgSnSdxMgFxA9qACE/PAvI/KJKpKJDOFZ9roc4NF5e4EpYCrsmb2xzj3b14xMPj07NFHMDL61si7BfDeyYu1o9MJovYp+ornQS+Ad8rYVmvC0oPAAAAAElFTkSuQmCC" />
            </svg>
            <h2
              class="align-center mt-4 flex text-center text-sm font-bold text-white opacity-90">
              Your screen is too small. Jovie is built for larger devices.
            </h2>
          </a>
        </div>
      </div>
    </div>
    <!-- Narrow sidebar -->
    <div
      class="border-r-1 z-30 mx-auto hidden h-screen w-14 flex-col justify-between overflow-hidden bg-indigo-700 pb-2 md:flex">
      <div
        class="mx-auto flex w-full flex-col items-center justify-center py-4 text-center">
        <a href="/">
          <div
            class="mx-auto mt-2 -mr-4 flex-shrink-0 items-center justify-center text-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              width="71px"
              height="20px">
              <image
                x="0px"
                y="0px"
                width="50px"
                height="10px"
                class="mx-auto"
                xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEcAAAAUCAMAAADodNB0AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAACRlBMVEX//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7///8Cqp9UAAAAwHRSTlMAPOjl4PC0AQjB4W9F0QmBQcYKhQSx1c3ZaQMHBQIWZaPPy7J/O3CEfIJyBlF9X250OB1sprmRW1rbnw9D2orOiGvkx0m8yYks+rh5/Mg99sTeV3Og1HtjEbu/2C4Xoewz0vEgxdbCmhXcda4U8xNi+V79DZa6QKxNIq8o/mQ10BJPapeYp+aew6VOP/IcTJNS7yP3hsrX3aLn7jRZH+qQthtGJfXijbdIR6R6XcypEI8LDKsy49OMmw6qsBm9XN/3tA8RAAAAAWJLR0TBZGbvbgAAAAd0SU1FB+YCBBIVJZp400UAAAKsSURBVDjLpVT5O5RRFH5lhozGEhGDIbJnjCJb2YpJRLK0KFSabI1Mk9A0KZU2LSppXxTtqzYt86d1z5nvs2bqeTo/nPc95577fveee78LyOaywFWhULq5w6kt9FAqVEpPJxWL7GTqv+h4KajK20mFD+v4OpfBYleq8vtvHf8lAYGBS4P+WSdYE0Lwh12GiiZhZtV8OmHacN+IZZFRy4HomNjYuPgEyibGrIj1jkrS6XTJeopTVq4SValpq0Pm0UnPsEuWmeXJmE07WkNsbQ75XBHn5ctVBevm6hQAfvYpW68pJCgS44YNguSjmOKNQNy0qhKfOTql2MRYVr6ZUVfBcmJ8C5FKVBFUI9HxmZpoXrti62ydbdhOsKM2eOcuInX1DcLv3gPspdAHjQTx2EdgFNP2NxFrnq3T0tpGUCESB+qIJRWRN8HQLiACCKDwYFiZ8B16mM04RAnLlM5h1uk8UiJ8WxdluikR3nNU+G4kU2BFAuskHiPfYStVq8tVRBtx3NB74mRfFqS+nDKRP51COmeI9oNOSBV6ltqQBS/WOXfePtMuIJW+33ERGODEpcvkr1wlnU6ihcgTfrCC2nNNXEHW6dXzMTVcV6vVETk2241+xzmKBSOTSVwXgwvpDBG7idZhAbcGhbst69y5S5stqQ81mxOktgTxvHvN9x0L1IEP8sFDIJcTA4BRWnwxZB0dGuTriHTro9rHrdKpyDaSAi2TJ09HGUdF5Zg0+GxSpxrNnDEa9M+ZvABeTtcxif+wc1o8TI1yf8XcFiy4JsBxnzUWzilHGF6/EUPadnlWWw3/xG8nZXwNvHcrB/xYvJPfn/cfpr7W53gWPqbZhlTjqk+fe6SeZX9pFHGGm9XfEX/9ZpmwTHwnqjH+iIz0+EnU1JLxa1zVVFU5JoLfcqHrK3VV344AAAAASUVORK5CYII=" />
            </svg>
          </div>
        </a>
        <div
          v-for="navitem in nav"
          :key="navitem"
          class="z-50 mt-4 w-full flex-1">
          <router-link
            :to="navitem.route"
            class="group group flex cursor-pointer flex-col items-center rounded-l-lg py-3 text-2xs font-medium text-neutral-50 hover:bg-indigo-600 hover:text-white active:bg-indigo-700">
            <component :is="navitem.icon" class="h-5 w-5"></component>

            <div
              class="text-md middle-8 px-.5 absolute left-14 -mt-3 hidden w-24 rounded-r-lg border border-indigo-200/20 bg-white/40 py-3.5 font-bold text-indigo-700 shadow-2xl shadow-indigo-900/70 backdrop-blur-xl backdrop-saturate-150 backdrop-filter group-hover:block">
              {{ navitem.name }}
            </div>
          </router-link>
        </div>
      </div>
      <div
        class="mx-auto mt-4 flex justify-between border-t border-indigo-600 py-1 px-2 text-[8px]">
        <div class="divide-x-1 d justify-right flex gap-2">
          <div class="text-indigo-400 hover:text-neutral-200">
            <router-link to="/privacy">Legal</router-link>
          </div>
        </div>
      </div>
    </div>

    <!-- Static sidebar for desktop -->

    <div class="z-10 flex w-0 flex-1 flex-col overflow-hidden">
      <div
        class="border-1 relative z-50 flex h-10 flex-shrink-0 border-b bg-white/75 backdrop-blur-md backdrop-filter">
        <button
          id="showSidebar"
          class="border-r border-neutral-200 px-4 text-neutral-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-indigo-500 md:hidden">
          <span class="sr-only">Open sidebar</span>

          <svg
            class="h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h7" />
          </svg>
        </button>
        <div class="z-10 flex flex-1 justify-between px-2">
          <div class="z-10 flex flex-1 text-left">
            <div
              class="ml-0 px-4 py-2 text-left text-sm font-semibold text-indigo-600 sm:px-6 md:px-8">
              <nav class="z-10 flex" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                  <li>
                    <div>
                      <router-link
                        to="/dashboard"
                        class="text-gray-400 hover:text-gray-500">
                        <HomeIcon
                          class="h-5 w-5 flex-shrink-0"
                          aria-hidden="true" />
                        <span class="sr-only">Home</span>
                      </router-link>
                    </div>
                  </li>
                  <li>
                    <div class="flex items-center">
                      <svg
                        class="h-5 w-5 flex-shrink-0 text-gray-300"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        aria-hidden="true">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                      </svg>
                      <a
                        :href="currentRoutePath"
                        class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                        :aria-current="currentRouteName ? 'page' : undefined"
                        >{{ currentRouteName }}</a
                      >
                    </div>
                  </li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="z-10 flex items-center">
            <div class="inline-flex items-center space-x-4">
              <div
                v-if="!currentUser.current_team.current_subscription"
                as="router-link"
                to="/account"
                class="underline-2 cursor-pointer text-xs font-bold text-indigo-500 decoration-indigo-700 hover:underline">
                Upgrade
              </div>
              <SwitchTeams />
              <PopoverGroup>
                <Popover as="div" class="relative">
                  <PopoverButton
                    as="div"
                    type="button"
                    class="flex max-w-xs items-center rounded-full bg-white text-sm focus-visible:outline-none"
                    id="user-menu-button"
                    aria-expanded="false"
                    aria-haspopup="true"
                    @click="isShowing = !isShowing">
                    <span class="sr-only">Open user menu</span>

                    <SupportIcon
                      class="h-5 w-5 rounded-full text-neutral-400 transition duration-300 ease-in-out hover:text-neutral-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 active:bg-neutral-100 active:text-neutral-700" />
                  </PopoverButton>

                  <transition
                    enter-active-class="transition duration-150 ease-out"
                    enter-from-class="transform scale-95 opacity-0"
                    enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-150 ease-out"
                    leave-from-class="transform scale-100 opacity-100"
                    leave-to-class="transform scale-95 opacity-0">
                    <PopoverPanel
                      as="div"
                      active=""
                      id="profileDropdown"
                      class="absolute right-0 z-10 mt-4 w-40 origin-top-right rounded-lg bg-white shadow-lg shadow-xl ring-1 ring-black ring-opacity-5"
                      role="menu"
                      aria-orientation="vertical"
                      aria-labelledby="user-menu-button"
                      tabindex="-1">
                      <!-- Active: "bg-neutral-100", Not Active: "" -->

                      <div
                        v-for="helpmenuitem in helpmenuitems"
                        :key="helpmenuitem"
                        as="router-link"
                        :to="helpmenuitem.route"
                        class="inline-flex w-full cursor-pointer px-4 py-2 text-xs text-neutral-700 first:rounded-t-md hover:bg-indigo-700 hover:text-white"
                        role="menuitem"
                        tabindex="-1">
                        <component class="mr-4 h-4 w-4" :is="helpmenuitem.icon">
                        </component>
                        <router-link :to="helpmenuitem.route">
                          {{ helpmenuitem.name }}
                        </router-link>
                      </div>
                      <div
                        onclick="Chattrigger"
                        class="inline-flex w-full cursor-pointer rounded-b-md px-4 py-2 text-xs text-neutral-700 hover:bg-indigo-700 hover:text-white">
                        <ChatAltIcon class="mr-4 h-4 w-4" />
                        Chat
                      </div>
                    </PopoverPanel>
                  </transition>
                </Popover>
              </PopoverGroup>

              <PopoverGroup v-if="batches.length">
                <Popover as="div" class="relative">
                  <PopoverButton
                    as="div"
                    type="button"
                    class="rounded-full p-1 text-neutral-400 transition duration-300 ease-in-out hover:text-neutral-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 active:bg-neutral-100 active:text-neutral-700"
                    id="notification-button"
                    aria-expanded="false"
                    aria-haspopup="true"
                    @click="getImportBatches()">
                    <span class="sr-only">Open import notification</span>
                    <BellIcon
                      class="h-5 w-5 flex-shrink-0"
                      aria-hidden="true" />
                  </PopoverButton>

                  <transition
                    enter-active-class="transition ease-out duration-200"
                    enter-from-class="opacity-0 translate-y-1"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-150"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 translate-y-1">
                    <PopoverPanel
                      class="absolute left-0 z-10 mt-3 w-screen max-w-xs -translate-x-full transform px-2 sm:px-0">
                      <!-- Active: "bg-neutral-100", Not Active: "" -->
                      <div
                        class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                        <div class="relative gap-6 bg-white px-1 py-2 sm:gap-8">
                          <div
                            class="mx-auto inline-flex w-full items-center border-b pb-1">
                            <p class="px-2 text-xs font-bold text-neutral-400">
                              Notifications
                            </p>
                            <span
                              class="inline-flex items-center rounded bg-indigo-100 px-1 py-0 text-2xs font-medium text-indigo-800">
                              5
                            </span>
                          </div>

                          <div
                            as="div"
                            class="inline-flex w-full px-2 py-2 text-xs text-neutral-700 first:pt-3"
                            role="menuitem"
                            tabindex="-1"
                            v-for="batch in batches"
                            :key="batch.id">
                            <router-link
                              to="/imports"
                              class="group 0 block flex-shrink-0">
                              <div class="flex w-full items-center">
                                <div>
                                  <component
                                    class="mx-auto h-5 w-5 text-neutral-400"
                                    :is="'CloudUploadIcon'">
                                  </component>
                                </div>
                                <div class="ml-3 w-60">
                                  <p
                                    class="justify-between text-xs font-medium uppercase text-gray-700 group-hover:text-gray-900">
                                    {{ batch.name }}
                                  </p>
                                  <div class="w-full">
                                    <p
                                      class="text-xs font-medium text-gray-500">
                                      Total: {{ batch.initial_total_in_file }}
                                    </p>
                                  </div>
                                  <ProgressBar
                                    :percentage="batch.progress"
                                    class="mx-auto w-full" />
                                </div>
                              </div>
                            </router-link>
                          </div>
                        </div>
                      </div>
                    </PopoverPanel>
                  </transition>
                </Popover>
              </PopoverGroup>
            </div>

            <!-- Profile dropdown -->
            <PopoverGroup>
              <Popover as="div" class="relative ml-3 border-l px-4">
                <PopoverButton
                  as="div"
                  type="button"
                  class="flex max-w-xs items-center rounded-full bg-white text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-200 focus-visible:ring-offset-2"
                  id="user-menu-button"
                  aria-expanded="false"
                  aria-haspopup="true"
                  @click="isShowing = !isShowing">
                  <span class="sr-only">Open user menu</span>

                  <img
                    id="profile_pic_url_img"
                    ref="profile_pic_url_img"
                    class="h-8 w-8 rounded-full border border-neutral-200 object-cover object-center"
                    :src="
                      $store.state.AuthState.user.profile_pic_url ??
                      $store.state.AuthState.user.default_image
                    " />
                </PopoverButton>

                <transition
                  enter-active-class="transition duration-150 ease-out"
                  enter-from-class="transform scale-95 opacity-0"
                  enter-to-class="transform scale-100 opacity-100"
                  leave-active-class="transition duration-150 ease-out"
                  leave-from-class="transform scale-100 opacity-100"
                  leave-to-class="transform scale-95 opacity-0">
                  <PopoverPanel
                    as="div"
                    active=""
                    id="profileDropdown"
                    class="absolute right-0 z-10 mt-2 w-80 origin-top-right rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="user-menu-button"
                    tabindex="-1">
                    <!-- Active: "bg-neutral-100", Not Active: "" -->
                    <div
                      as="div"
                      class="block border-b-2 border-opacity-30 px-4 py-2 text-left text-xs font-bold text-neutral-400"
                      role="menuitem"
                      tabindex="-1"
                      id="user-menu-item-0">
                      <router-link
                        to="/account"
                        class="group 0 block flex-shrink-0 cursor-pointer">
                        <div class="flex items-center">
                          <div>
                            <img
                              class="inline-block h-6 w-6 rounded-full"
                              :src="
                                currentUser.profile_pic_url ??
                                currentUser.default_image
                              "
                              alt="" />
                          </div>
                          <div class="ml-3">
                            <p
                              class="justify-between text-xs font-medium text-gray-700 group-hover:text-gray-900">
                              {{ currentUser.first_name }}
                              {{ currentUser.last_name }}
                            </p>

                            <p class="text-xs font-light text-gray-500">
                              {{ currentUser.email }}
                            </p>
                          </div>
                        </div>
                      </router-link>
                    </div>
                    <div
                      v-for="dropdownmenuitem in dropdownmenuitems"
                      :key="dropdownmenuitem"
                      as="router-link"
                      :to="dropdownmenuitem.route"
                      class="first-rounded-t-md inline-flex w-full px-4 py-2 text-xs text-neutral-700 hover:bg-indigo-700 hover:text-white"
                      role="menuitem"
                      tabindex="-1">
                      <component
                        class="mr-4 h-4 w-4"
                        :is="dropdownmenuitem.icon">
                      </component>
                      <router-link :to="dropdownmenuitem.route">
                        {{ dropdownmenuitem.name }}
                      </router-link>
                    </div>
                    <div
                      as="div"
                      @click="$store.dispatch('logout')"
                      class="inline-flex w-full rounded-b-md px-4 py-2 text-xs text-neutral-700 hover:bg-indigo-700 hover:text-white"
                      role="menuitem"
                      tabindex="-1">
                      <component
                        class="mr-4 h-4 w-4"
                        is="LogoutIcon"></component>
                      Sign out
                    </div>
                  </PopoverPanel>
                </transition>
              </Popover>
            </PopoverGroup>
          </div>
        </div>
      </div>

      <main
        class="relative flex-1 overflow-y-auto focus-visible:outline-none"
        id="main">
        <div class="h-full">
          <div class="h-full">
            <AlertBanner
              v-if="currentUser.queued_count"
              design="primary"
              mobiletitle="Your subscribtion is inactive"
              title="Your imports are in progress"
              :cta="`There are a total of ${currentUser.queued_count} imports in progress. Once they are done, we would soon start scrapping them.`" />
            <router-view></router-view>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import {
  HomeIcon,
  SearchIcon,
  MailIcon,
  ChartBarIcon,
  ChevronLeftIcon,
  CheckCircleIcon,
  CloudUploadIcon,
  LogoutIcon,
  UserGroupIcon,
  FolderOpenIcon,
  CogIcon,
  BellIcon,
  CursorClickIcon,
  ChatAltIcon,
  SwitchHorizontalIcon,
  SpeakerphoneIcon,
  SupportIcon,
} from '@heroicons/vue/outline';
import {
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverGroup,
} from '@headlessui/vue';
import SwitchTeams from '../components/SwitchTeams.vue';
import AlertBanner from '../components/AlertBanner';
import ImportService from '../services/api/import.service';
import ProgressBar from '../components/ProgressBar';

export default {
  name: 'App',
  data() {
    return {
      errors: [],
      user: this.$store.state.AuthState.user,
      nav: [
        { name: 'Admin', route: '/admin', icon: CheckCircleIcon },
        { name: 'Dashboard', route: '/dashboard', icon: HomeIcon },
        { name: 'Search', route: '/discovery', icon: SearchIcon },
        { name: 'Contacts', route: '/contacts', icon: UserGroupIcon },
        { name: 'Pipeline', route: '/pipeline', icon: SwitchHorizontalIcon },
        { name: 'Import', route: '/import', icon: CloudUploadIcon },
        { name: 'Settings', route: '/account', icon: CogIcon },
      ],
      dropdownmenuitems: [
        { name: 'Profile', route: '/', icon: UserGroupIcon },
        { name: 'Settings', route: 'Account', icon: CogIcon },
      ],
      helpmenuitems: [
        { name: 'Shortcuts', route: 'Account', icon: CursorClickIcon },
        { name: 'Feedback', route: 'Account', icon: SpeakerphoneIcon },
      ],
      isShowing: false,
      isLoading: false,
      batches: [],
    };
  },
  mounted() {
    this.getImportBatches();
    setInterval(() => {
      this.getImportBatches();
    }, 5000);
  },
  methods: {
    getImportBatches() {
      ImportService.getImportBatches().then((response) => {
        response = response.data;
        if (response.status) {
          this.batches = response.batches;
        }
      });
    },
  },
  computed: {
    currentRouteName() {
      return this.$route.name;
    },
    currentRoutePath() {
      return this.$route.path;
    },
  },
  components: {
    Menu,
    MenuButton,
    HomeIcon,
    MenuItem,
    MenuItems,
    ChatAltIcon,
    ProgressBar,
    SearchIcon,
    BellIcon,
    SpeakerphoneIcon,
    MailIcon,
    CursorClickIcon,
    ChartBarIcon,
    CheckCircleIcon,
    CloudUploadIcon,
    UserGroupIcon,
    FolderOpenIcon,
    CogIcon,
    ChevronLeftIcon,
    LogoutIcon,
    SwitchHorizontalIcon,
    SwitchTeams,
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverGroup,
    SupportIcon,
    AlertBanner,
  },
};
</script>

<style scoped></style>
