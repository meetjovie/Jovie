<template>
  <div>
    <!-- <Menu>
    <Float portal :offset="8" shift placement="bottom-start">
      <MenuButton>
        <div
          class="flex w-full items-center justify-between rounded-md px-2 py-1 hover:bg-slate-100">
          <div class="flex">
           

            <div
              class="items-center text-2xs font-medium text-slate-700 line-clamp-1 group-hover:text-slate-800">
              {{
                currentUser.current_team
                  ? currentUser.current_team.name
                  : 'Select a team'
              }}
            </div>
          </div>
        </div>
      </MenuButton>

      <transition
        enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-75 ease-in"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0">
        <MenuItems
          as="div"
          class="z-30 mt-2 max-h-80 w-60 origin-top-right divide-y divide-slate-100 rounded-lg border border-slate-200 bg-white/60 bg-clip-padding px-2 pb-2 pt-1 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl backdrop-saturate-150 backdrop-filter focus-visible:outline-none">
          <div class="">
            <div
              class="border-b px-4 pt-2 pb-1 text-center text-xs font-semibold text-slate-700">
              Your workspaces:
            </div>
            <div v-if="currentUser.teams">
              <div v-for="team in currentUser.teams">
                <button
                  @click="switchTeam(team.id)"
                  class="group px-1 py-1 text-sm font-medium hover:bg-slate-200 hover:text-slate-700"
                  :class="[
                    active
                      ? 'bg-white px-1 py-2 text-slate-800'
                      : 'text-sm text-slate-700',
                    'group flex w-full items-center px-2 py-2 text-xs ',
                  ]">
                  <ChevronRightIcon
                    :active="active"
                    class="mr-1 h-5 w-5 text-slate-400 group-hover:text-slate-700"
                    aria-hidden="true" />
                  {{ team.name }}
                </button>
              </div>
            </div>
            <div>
              <router-link
                to="/accounts"
                class="group px-1 py-1 text-sm font-medium hover:bg-slate-200 hover:text-slate-700"
                :class="[
                  active
                    ? 'bg-white px-1 py-2  text-slate-800'
                    : 'text-sm text-slate-700',
                  'group flex w-full items-center px-2 py-2 text-xs  last:rounded-b-md',
                ]">
                <PlusCircleIcon
                  :active="active"
                  class="mr-1 h-5 w-5 text-slate-700"
                  aria-hidden="true" />
                Join or create workspace
              </router-link>
            </div>
          </div>
        </MenuItems>
      </transition>
    </Float>
  </Menu> -->
    <!--  <JovieDropdownMenu :items="currentUser.current_team">
    </JovieDropdownMenu> -->
    <!--  <template #triggerButton>
      <div
        class="flex w-full items-center justify-between rounded-md px-2 py-1 hover:bg-slate-100">
        <div class="flex">
   
    Hi
 <div
            class="items-center text-2xs font-medium text-slate-700 line-clamp-1 group-hover:text-slate-800">
            {{
              currentUser.current_team
                ? currentUser.current_team.name
                : 'Select a team'
            }}
          </div> 
        </div>
      </div>
    </template> -->
    <!-- <template #menuBottom>
      <router-link
        to="/accounts"
        class="group px-1 py-1 text-sm font-medium hover:bg-slate-200 hover:text-slate-700"
        :class="[
          active
            ? 'bg-white px-1 py-2  text-slate-800'
            : 'text-sm text-slate-700',
          'group flex w-full items-center px-2 py-2 text-xs  last:rounded-b-md',
        ]">
        <PlusCircleIcon
          :active="active"
          class="mr-1 h-5 w-5 text-slate-700"
          aria-hidden="true" />
        Join or create workspace
      </router-link>
    </template> -->
  </div>
</template>
<script>
import { Float } from '@headlessui-float/vue';
import JovieDropdownMenu from '../components/JovieDropdownMenu.vue';
import {
  ChevronDownIcon,
  ChevronUpIcon,
  ChevronRightIcon,
  UserGroupIcon,
  PlusCircleIcon,
} from '@heroicons/vue/24/solid';
import {
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverGroup,
} from '@headlessui/vue';
import TeamService from '../services/api/team.service';

export default {
  name: 'TeamDropdown',
  components: {
    JovieDropdownMenu,
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
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
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
