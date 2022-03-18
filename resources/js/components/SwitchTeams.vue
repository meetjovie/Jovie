<template>
    <Menu>
        <MenuButton class="-mt-1 inline-flex items-center border-x px-4">
            <span class="text-2xs font-bold text-neutral-700">
                {{ currentUser.current_team ? currentUser.current_team.name : 'Select a team' }} </span>
            <ChevronDownIcon class="ml-1 h-5 w-5 text-neutral-500"/>
        </MenuButton>

        <transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0">
            <MenuItems
                class="-middle-24 absolute mt-24 w-40 origin-bottom-left divide-y divide-gray-100 rounded-md bg-white/60 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-xl backdrop-saturate-150 backdrop-filter focus-visible:outline-none">
                <div class="px-1 py-1">
                    <MenuItem
                        v-slot="{ active }" v-if="currentUser.teams" v-for="team in currentUser.teams">
                        <button
                            @click="switchTeam(team.id)"
                            :class="[
                                active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                              ]">
                            <ChevronRightIcon
                                :active="active"
                                class="mr-2 h-5 w-5 text-indigo-400"
                                aria-hidden="true"/>
                            {{ team.name }}
                        </button>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>
<script>
import {ChevronDownIcon, ChevronRightIcon} from '@heroicons/vue/solid';
import {Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue';
import TeamService from "../services/api/team.service";

export default {
    name: 'TeamDropdown',
    components: {
        ChevronDownIcon,
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        ChevronRightIcon,
    },
    computed: {
        currentUser() {
            return this.$store.state.AuthState.user
        }
    },
    methods: {
        switchTeam(id) {
            TeamService.switchTeam(id).then(response => {
                response = response.data
                if (response.status) {
                    this.$store.commit('switchTeam', response.team)
                }
            })
        }
    }
};
</script>
