<template>
  <Popover>
    <PopoverButton class="group inline-flex items-center">
      <span
        class="-mt-1.5 items-center text-xs font-bold text-neutral-400 group-hover:text-neutral-700">
        {{
          currentUser.current_team
            ? currentUser.current_team.name
            : 'Select a team'
        }}
      </span>
      <ChevronDownIcon
        class="ml-1 -mt-1.5 h-5 w-5 text-neutral-500 group-hover:text-neutral-700" />
    </PopoverButton>

    <transition
      enter-active-class="transition duration-100 ease-out"
      enter-from-class="transform scale-95 opacity-0"
      enter-to-class="transform scale-100 opacity-100"
      leave-active-class="transition duration-75 ease-in"
      leave-from-class="transform scale-100 opacity-100"
      leave-to-class="transform scale-95 opacity-0">
      <PopoverPanel
        class="-middle-24 absolute mt-4 w-40 origin-bottom-left rounded-md bg-white/90 shadow-lg backdrop-blur-xl backdrop-saturate-150 backdrop-filter focus-visible:outline-none">
        <div class="">
          <div
            class="border-b px-4 pt-2 pb-1 text-xs font-bold text-neutral-400">
            Your teams:
          </div>
          <div v-if="currentUser.teams" v-for="team in currentUser.teams">
            <button
              @click="switchTeam(team.id)"
              class="group px-1 py-1 text-sm font-medium hover:bg-indigo-700 hover:text-white"
              :class="[
                active
                  ? 'bg-white px-1 py-2 font-bold text-indigo-700'
                  : 'text-sm text-gray-500',
                'group flex w-full items-center px-2 py-2 text-xs  last:rounded-b-md',
              ]">
              <ChevronRightIcon
                :active="active"
                class="mr-1 h-5 w-5 text-indigo-400 group-hover:text-white"
                aria-hidden="true" />
              {{ team.name }}
            </button>
          </div>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
</template>
<script>
import { ChevronDownIcon, ChevronRightIcon } from '@heroicons/vue/solid';
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverGroup,
} from '@headlessui/vue';
import TeamService from '../services/api/team.service';

export default {
  name: 'TeamDropdown',
  components: {
    ChevronDownIcon,
    Popover,
    PopoverButton,
    PopoverPanel,
    PopoverGroup,
    ChevronRightIcon,
  },
  computed: {
    currentUser() {
      return this.$store.state.AuthState.user;
    },
  },
  methods: {
    switchTeam(id) {
      TeamService.switchTeam(id).then((response) => {
        response = response.data;
        if (response.status) {
          this.$store.commit('switchTeam', response.team);
        }
      });
    },
  },
};
</script>
