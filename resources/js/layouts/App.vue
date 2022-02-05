<template>
    <div id="app" class="h-screen flex overflow-hidden bg-neutral-100">
        <div
            id="overlay"
            class="fixed inset-0 flex z-40 md:hidden"
            role="dialog"
            aria-modal="true"
        >
            <div
                class="fixed inset-0 bg-neutral-600 bg-opacity-75"
                aria-hidden="true"
            ></div>

            <div
                id="sidebar"
                class="relative flex-1 flex flex-col w-full pt-5 pb-4 bg-neutral-500/50 backdrop-blur-md"
            >
                <div
                    class="flex w-full h-screen justify-center items-center mx-auto"
                >
                    <a href="{{ route('dashboard') }}">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="39px"
                            height="11px"
                        >
                            <image
                                x="0px"
                                y="0px"
                                width="69px"
                                height="20px"
                                xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACcAAAALCAMAAADLE2RKAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABj1BMVEX//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7///+eFSkTAAAAg3RSTlMATdnCqN8nY/vWMVrkFSwhEwUQNDgOAygrEeqw0DN++fFPAtzRpdIZeakUz+XggqpCm220lAlZi4w9/r248IYGpPdE89eNZwwfUsbBcjW3d/ixfMBp7wvyMulu23aAYFBBP7XseDyJr/0mYWKj5+EPF+IKNuYbXKK7s1ehv2uPbBqSzKPEmjsAAAABYktHRIRi0FpxAAAAB3RJTUUH5gIEERYvU8bXwQAAAS5JREFUGNNlkOk3gkEYxW+bPcSrDYmSrZSdSJYsKWsk+15U9n1L3H/cvPnAyf0w95nfuXPPzACyFEqlCvlSazQFeaiQLPqXKyZL8lApWSZMW14BVOp0MtJVVUtSDaA3GE1/c2aYaknW1VsarI1oslntzQ5HC1rNAra1/+Y6TE7SJWAn6YZHeBep7yZ7egXv+8n1i+0AOYghL4dH6MMovf4xjk9MMgBMkdOYmfUYESTnQqQBcNIeJucXqIaKzkVyibKWsUJGsCr63KQErNEXNdO1zhhC3Ngkt7Z3doN7+zgQ6cMj8lgSnSdxMgFxA9qACE/PAvI/KJKpKJDOFZ9roc4NF5e4EpYCrsmb2xzj3b14xMPj07NFHMDL61si7BfDeyYu1o9MJovYp+ornQS+Ad8rYVmvC0oPAAAAAElFTkSuQmCC"
                            />
                        </svg>
                        <h2
                            class="flex font-bold text-center text-white opacity-90 mt-4 align-center text-sm"
                        >
                            Your screen is too small. Jovie is built for larger
                            devices.
                        </h2>
                    </a>
                </div>
            </div>
        </div>
        <!-- Narrow sidebar -->
        <div
            class="hidden w-14 mx-auto h-screen pb-2 bg-indigo-700 border-r-1 justify-between flex-col overflow-hidden md:flex"
        >
            <div
                class="w-full py-4 mx-auto flex flex-col justify-center text-center items-center"
            >
                <a href="/">
                    <div
                        class="flex-shrink-0 mt-2 -mr-4 justify-center mx-auto text-center items-center"
                    >
                       <svg 
 xmlns="http://www.w3.org/2000/svg"
 xmlns:xlink="http://www.w3.org/1999/xlink"
 width="71px" height="20px">
<image  x="0px" y="0px" width="50px" height="10px" class="mx-auto" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEcAAAAUCAMAAADodNB0AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAACRlBMVEX//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7//v7///8Cqp9UAAAAwHRSTlMAPOjl4PC0AQjB4W9F0QmBQcYKhQSx1c3ZaQMHBQIWZaPPy7J/O3CEfIJyBlF9X250OB1sprmRW1rbnw9D2orOiGvkx0m8yYks+rh5/Mg99sTeV3Og1HtjEbu/2C4Xoewz0vEgxdbCmhXcda4U8xNi+V79DZa6QKxNIq8o/mQ10BJPapeYp+aew6VOP/IcTJNS7yP3hsrX3aLn7jRZH+qQthtGJfXijbdIR6R6XcypEI8LDKsy49OMmw6qsBm9XN/3tA8RAAAAAWJLR0TBZGbvbgAAAAd0SU1FB+YCBBIVJZp400UAAAKsSURBVDjLpVT5O5RRFH5lhozGEhGDIbJnjCJb2YpJRLK0KFSabI1Mk9A0KZU2LSppXxTtqzYt86d1z5nvs2bqeTo/nPc95577fveee78LyOaywFWhULq5w6kt9FAqVEpPJxWL7GTqv+h4KajK20mFD+v4OpfBYleq8vtvHf8lAYGBS4P+WSdYE0Lwh12GiiZhZtV8OmHacN+IZZFRy4HomNjYuPgEyibGrIj1jkrS6XTJeopTVq4SValpq0Pm0UnPsEuWmeXJmE07WkNsbQ75XBHn5ctVBevm6hQAfvYpW68pJCgS44YNguSjmOKNQNy0qhKfOTql2MRYVr6ZUVfBcmJ8C5FKVBFUI9HxmZpoXrti62ydbdhOsKM2eOcuInX1DcLv3gPspdAHjQTx2EdgFNP2NxFrnq3T0tpGUCESB+qIJRWRN8HQLiACCKDwYFiZ8B16mM04RAnLlM5h1uk8UiJ8WxdluikR3nNU+G4kU2BFAuskHiPfYStVq8tVRBtx3NB74mRfFqS+nDKRP51COmeI9oNOSBV6ltqQBS/WOXfePtMuIJW+33ERGODEpcvkr1wlnU6ihcgTfrCC2nNNXEHW6dXzMTVcV6vVETk2241+xzmKBSOTSVwXgwvpDBG7idZhAbcGhbst69y5S5stqQ81mxOktgTxvHvN9x0L1IEP8sFDIJcTA4BRWnwxZB0dGuTriHTro9rHrdKpyDaSAi2TJ09HGUdF5Zg0+GxSpxrNnDEa9M+ZvABeTtcxif+wc1o8TI1yf8XcFiy4JsBxnzUWzilHGF6/EUPadnlWWw3/xG8nZXwNvHcrB/xYvJPfn/cfpr7W53gWPqbZhlTjqk+fe6SeZX9pFHGGm9XfEX/9ZpmwTHwnqjH+iIz0+EnU1JLxa1zVVFU5JoLfcqHrK3VV344AAAAASUVORK5CYII=" />
</svg>
                    </div>
                </a>
                <div v-for="navitem in nav" class="flex-1 mt-4 w-full">
                    <div :href="navitem.href" :to="navitem.route" class="cursor-pointer group text-neutral-50 hover:bg-indigo-600 active:bg-indigo-700 rounded-l-lg hover:text-white group py-3 flex flex-col items-center text-2xs font-medium">
                        
                        <component :is="navitem.icon" class="h-5 w-5"></component>
                            
                        <span class="mt-2 sr-only">{{navitem.name}}</span>
                        <div class="hidden group-hover:block absolute left-14 z-20  middle-8 rounded-r-lg bg-white/50 border-indigo-200/20 border backdrop-filter  shadow-indigo-900/70 backdrop-blur-md shadow-2xl py-3.5 -mt-3 px-.5 text-indigo-700 font-bold w-24">
                            <ChervronLeft class="-ml-2h-5 w-5 text-neutral-900" />
                            {{navitem.name}}
                        </div>
                    </div>
                    
                </div>
            </div>
            <div
                class="flex text-[8px] justify-between mx-auto border-indigo-600 border-t mt-4 py-1 px-2"
            >
                <div class="flex divide-x-1 gap-2 d justify-right">
                    <div class="text-neutral-400 hover:text-neutral-200">
                        <a href="/privacy">Privacy</a><br>
                        <a href="/terms">Terms</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Static sidebar for desktop -->

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div
                class="relative z-30 flex-shrink-0 flex h-10 bg-white border-1 border-b"
            >
                <button
                    id="showSidebar"
                    class="px-4 border-r border-neutral-200 text-neutral-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-indigo-500 md:hidden"
                >
                    <span class="sr-only">Open sidebar</span>

                    <svg
                        class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7"
                        />
                    </svg>
                </button>
                <div class="flex-1 px-2 flex justify-between">
                    <div class="flex-1 flex text-left">
                        <div
                            class="ml-0 px-4 py-2 sm:px-6 md:px-8 text-left text-sm font-semibold text-indigo-600"
                        >
                            <nav class="flex" aria-label="Breadcrumb">
                                <ol
                                    role="list"
                                    class="flex items-center space-x-4"
                                >
                                    <li>
                                        <div>
                                            <a
                                                href="/"
                                                class="text-gray-400 hover:text-gray-500"
                                            >
                                                <HomeIcon
                                                    class="flex-shrink-0 h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                                <span class="sr-only"
                                                    >Home</span
                                                >
                                            </a>
                                        </div>
                                    </li>
                                    <li v-for="page in pages" :key="page.name">
                                        <div class="flex items-center">
                                            <svg
                                                class="flex-shrink-0 h-5 w-5 text-gray-300"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z"
                                                />
                                            </svg>
                                            <a
                                                :href="page.href"
                                                class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                                                :aria-current="
                                                    page.current
                                                        ? 'page'
                                                        : undefined
                                                "
                                                >{{ page.name }}</a
                                            >
                                        </div>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="ml-2 flex items-center md:ml-6">
                        <button
                            class="bg-white p-1 rounded-full text-neutral-400 hover:text-neutral-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500"
                        >
                            <span class="sr-only">View notifications</span>

                            <svg
                                class="h-6 w-6"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                />
                            </svg>
                        </button>

                        <!-- Profile dropdown -->
                        <Menu as="div" class="ml-3 relative border-l px-4">
                            <MenuButton
                                as="div"
                                type="button"
                                class="max-w-xs bg-white flex items-center text-sm rounded-full focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                                @click="isShowing = !isShowing"
                            >
                                <span class="sr-only">Open user menu</span>
                                <img
                                    class="h-8 w-8 rounded-full object-cover"
                                    src="https://ui-avatars.com/api/?name=&color=7F9CF5&background=EBF4FF"
                                />
                            </MenuButton>

                            <MenuList>
                                <transition
                                    enter-active-class="transition duration-150 ease-out"
                                    enter-from-class="transform scale-95 opacity-0"
                                    enter-to-class="transform scale-100 opacity-100"
                                    leave-active-class="transition duration-150 ease-out"
                                    leave-from-class="transform scale-100 opacity-100"
                                    leave-to-class="transform scale-95 opacity-0"
                                >
                                    <MenuItems
                                        as="div"
                                        active=""
                                        id="profileDropdown"
                                        class="origin-top-right absolute backdrop-blur-xl d-none right-0 mt-2 w-60 rounded-md shadow-xl py-1 bg-white/90 z-20"
                                        role="menu"
                                        aria-orientation="vertical"
                                        aria-labelledby="user-menu-button"
                                        tabindex="-1"
                                    >
                                        <!-- Active: "bg-neutral-100", Not Active: "" -->
                                        <MenuItem
                                            v-bind:is="user"
                                            as="div"
                                            href="#"
                                            class="block px-4 py-4 text-sm font-bold text-neutral-700 border-b-2 border-opacity-30 text-left"
                                            role="menuitem"
                                            tabindex="-1"
                                            id="user-menu-item-0"
                                            >Hi User ! !</MenuItem
                                        >
                                        <MenuItem
                                            as="div"
                                            href="/billing"
                                            class="block hover:bg-indigo-700 hover:text-white px-4 py-2 text-sm text-neutral-700"
                                            role="menuitem"
                                            tabindex="-1"
                                            >Billing</MenuItem
                                        >
                                        <MenuItem
                                            as="div"
                                            href=""
                                            class="block hover:bg-indigo-700 hover:text-white px-4 py-2 text-sm text-neutral-700"
                                            role="menuitem"
                                            tabindex="-1"
                                            >Settings</MenuItem
                                        >

                                        <MenuItem
                                            as="div"
                                            action=""
                                            method="get"
                                            class="group block hover:bg-indigo-700 hover:text-white"
                                        >
                                            <button
                                                type="submit"
                                                class="block group-hover:text-white px-4 py-2 text-sm text-neutral-700"
                                                role="menuitem"
                                                tabindex="-1"
                                                id="user-menu-item-2"
                                            >
                                                Sign out
                                            </button>
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </MenuList>
                        </Menu>
                    </div>
                </div>
            </div>

            <main
                class="flex-1 relative overflow-y-auto focus-visible:outline-none"
                id="main"
            >
                <div class="h-full">
                    <div class="h-full">
                        <router-view></router-view>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import { HomeIcon, SearchIcon, MailIcon, ChartBarIcon, ChevronLeftIcon, CheckCircleIcon,CloudUploadIcon, UserGroupIcon, FolderOpenIcon, CogIcon } from "@heroicons/vue/outline";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";

const pages = [
    { name: "CRM", href: "/outreach", current: false },
    { name: "Creators", href: "#", current: true },
];


export default {
    name: "App",
    data() {
        return {
            user: this.$store.state.AuthState.user,
            nav:[
                {name: "Admin", route: "/admin", icon: CheckCircleIcon},
                {name: "Dashboard", route: "/dashboard", icon: HomeIcon},
                {name: "Search", route: "/discovery", icon: SearchIcon},
                {name: "Outreach", route: "/outreach", icon: MailIcon},
                {name: "Campaings", route: "/campaigns", icon: FolderOpenIcon},
                {name: "CRM", route: "/crm", icon: UserGroupIcon},
                {name: "Analytics", route: "/analytics", icon: ChartBarIcon},
                {name: "Import", route: "/import", icon: CloudUploadIcon},
                {name: "Settings", route: "/settings", icon: CogIcon},

                
            ],
        };
    },
    mounted() {},
    computed: {
        currentRouteName() {
            return this.$route.name;
        },
    },
    components: {
        Menu,
        MenuButton,
        HomeIcon,
        MenuItem,
        MenuItems,
        SearchIcon,
        MailIcon,
        ChartBarIcon,
        CheckCircleIcon,
        CloudUploadIcon,
        UserGroupIcon,
        FolderOpenIcon,
        CogIcon,
        ChevronLeftIcon,
    },
    setup() {
        return {
            pages,
        };
    },
};
</script>

<style scoped></style>
