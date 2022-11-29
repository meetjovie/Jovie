<template>
  <Menu v-slot="{ open }" as="div">
    <Float portal :offset="8" shift placement="right-end">
      <MenuButton
        class="rounded-full p-1 text-slate-400 transition duration-300 ease-in-out hover:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 active:bg-slate-100 active:text-slate-700"
        as="div">
        <SunIcon v-if="getTheme == 'light'" class="h-4 w-4 cursor-pointer" />
        <MoonIcon
          v-else-if="getTheme == 'dark'"
          class="h-4 w-4 cursor-pointer" />
        <ComputerDesktopIcon v-else class="h-4 w-4 cursor-pointer" />
      </MenuButton>
      <TransitionRoot
        :show="open"
        enter-active-class="transition duration-300 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-150 ease-out"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0">
        <MenuItems
          as="div"
          class="w-24 origin-bottom-left divide-y divide-gray-100 rounded-md border-slate-300 bg-white/60 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl backdrop-saturate-150 focus:outline-none dark:divide-gray-800 dark:border-slate-700 dark:bg-slate-900/60">
          <div class="px-1 py-1">
            <MenuItem v-slot="{ active }" as="div">
              <div
                @click="setTheme('light')"
                :class="[
                  active
                    ? 'bg-slate-300 text-slate-800 dark:bg-slate-700 dark:text-slate-100'
                    : ' text-slate-600  dark:text-slate-400',
                  'flex cursor-pointer items-center rounded-md px-2 py-1 text-xs',
                ]">
                <SunIcon class="mr-2 h-4 w-4 cursor-pointer" />
                Light
              </div>
            </MenuItem>
            <MenuItem v-slot="{ active }" as="div">
              <div
                @click="setTheme('dark')"
                :class="[
                  active
                    ? 'bg-slate-300 text-slate-800 dark:bg-slate-700 dark:text-slate-100'
                    : ' text-slate-600  dark:text-slate-400',
                  'flex cursor-pointer items-center rounded-md px-2 py-1 text-xs',
                ]">
                <MoonIcon class="mr-2 h-4 w-4 cursor-pointer" />
                Dark
              </div>
            </MenuItem>
            <MenuItem v-slot="{ active }" as="div">
              <div
                @click="setTheme('system')"
                :class="[
                  active
                    ? 'bg-slate-300 text-slate-800 dark:bg-slate-700 dark:text-slate-100'
                    : ' text-slate-600  dark:text-slate-400',
                  'flex cursor-pointer items-center rounded-md px-2 py-1 text-xs',
                ]">
                <ComputerDesktopIcon class="mr-2 h-4 w-4 cursor-pointer" />
                System
              </div>
            </MenuItem>
          </div>
        </MenuItems>
      </TransitionRoot>
    </Float>
  </Menu>
</template>
<script>
import {
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
  TransitionRoot,
} from '@headlessui/vue';
import {
  SunIcon,
  MoonIcon,
  ComputerDesktopIcon,
} from '@heroicons/vue/24/outline';
import { Float } from '@headlessui-float/vue';

export default {
  components: {
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
    TransitionRoot,
    SunIcon,
    MoonIcon,
    ComputerDesktopIcon,
    Float,
  },
  data() {
    return {
      open: false,
    };
  },

  computed: {
    getTheme() {
      return localStorage.getItem('theme') || 'light';
    },
  },
  methods: {
    setTheme(theme) {
      console.log('Theme is set to ' + theme);
      if (theme == 'light' || theme == 'dark') {
        localStorage.theme = theme;
      } else {
        localStorage.removeItem('theme');
      }
      // On page load or when changing themes, best to add inline in `head` to avoid FOUC
      if (
        localStorage.theme === 'dark' ||
        (!('theme' in localStorage) &&
          window.matchMedia('(prefers-color-scheme: dark)').matches)
      ) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
      //update the computed property getTheme
      this.getTheme;
    },
  },
};
</script>
