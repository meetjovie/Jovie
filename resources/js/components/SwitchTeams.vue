<template>
  <Popover>
    <Float portal :offset="8" shift placement="right-start">
      <PopoverButton>
        <div
          class="flex w-full items-center justify-between rounded-md px-2 py-1 hover:bg-gray-200">
          <div class="flex">
            <!-- <UserGroupIcon
              class="mr-1 h-4 w-4 text-gray-500 group-hover:text-gray-600" /> -->

            <div
              class="items-center text-2xs font-medium text-gray-500 line-clamp-1 group-hover:text-gray-600">
              {{
                currentUser.current_team
                  ? currentUser.current_team.name
                  : 'Select a team'
              }}
            </div>
          </div>
        </div>
      </PopoverButton>

      <transition
        enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-75 ease-in"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0">
        <PopoverPanel
          class="w-52 origin-left rounded-md border border-gray-200 bg-white/90 shadow-lg backdrop-blur-xl backdrop-saturate-150 backdrop-filter focus-visible:outline-none">
          <div class="">
            <div
              class="border-b bg-gray-50 px-4 pt-2 pb-1 text-center text-xs font-semibold text-gray-400">
              Your teams:
            </div>
            <div v-if="currentUser.teams">
              <div v-for="team in currentUser.teams">
                <button
                  @click="switchTeam(team.id)"
                  class="group px-1 py-1 text-sm font-medium hover:bg-indigo-700 hover:text-white"
                  :class="[
                    active
                      ? 'bg-white px-1 py-2 font-bold text-indigo-700'
                      : 'text-sm text-gray-500',
                    'group flex w-full items-center px-2 py-2 text-xs ',
                  ]">
                  <ChevronRightIcon
                    :active="active"
                    class="mr-1 h-5 w-5 text-indigo-400 group-hover:text-white"
                    aria-hidden="true" />
                  {{ team.name }}
                </button>
              </div>
            </div>
            <div>
              <router-link
                to="/accounts"
                class="group px-1 py-1 text-sm font-medium hover:bg-indigo-700 hover:text-white"
                :class="[
                  active
                    ? 'bg-white px-1 py-2 font-bold text-indigo-700'
                    : 'text-sm text-gray-500',
                  'group flex w-full items-center px-2 py-2 text-xs  last:rounded-b-md',
                ]">
                <PlusCircleIcon
                  :active="active"
                  class="mr-1 h-5 w-5 text-indigo-400 group-hover:text-white"
                  aria-hidden="true" />
                Join or create workspace
              </router-link>
            </div>
          </div>
        </PopoverPanel>
      </transition>
    </Float>
  </Popover>
</template>
<script>
import { Float } from '@headlessui-float/vue';
import {
  ChevronDownIcon,
  ChevronUpIcon,
  ChevronRightIcon,
  UserGroupIcon,
  PlusCircleIcon,
} from '@heroicons/vue/24/solid';
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
    Float,
    PopoverButton,
    PopoverPanel,
    UserGroupIcon,
    PopoverGroup,
    PlusCircleIcon,
    ChevronRightIcon,
    ChevronUpIcon,
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
