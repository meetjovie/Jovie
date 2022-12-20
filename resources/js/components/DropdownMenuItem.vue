<template>
  <div
    v-if="seperator"
    class="divide my-1 w-full divide-slate-200 dark:divide-jovieDark-border" />
  <MenuItem v-else :disabled="disabled" as="div" v-slot="{ active }">
    <div
      :class="{
        'cursor-not-allowed opacity-50 saturate-0': disabled,
        'bg-slate-200 text-slate-700 dark:bg-jovieDark-500 dark:text-jovieDark-100':
          active,
      }"
      class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1.5 text-xs text-slate-600 dark:text-jovieDark-200">
      <div class="flex w-full items-center">
        <slot>
          <div class="flex w-full items-center justify-between">
            <div class="flex w-full items-center">
              <div
                v-if="checkable"
                class="mr-2 w-3 text-xs font-bold opacity-50">
                <CheckIcon
                  v-if="checked"
                  class="h-4 w-4 font-bold text-slate-600 hover:text-slate-700 dark:text-jovieDark-300 dark:hover:text-slate-200" />
              </div>

              <div v-if="emoji" class="mr-2 text-xs font-bold">
                {{ emoji }}
              </div>
              <div
                v-else-if="colorDot"
                class="mr-2 text-xs font-bold opacity-50">
                <span
                  class="inline-block h-2 w-2 flex-shrink-0 rounded-full"
                  :class="dotClass"></span>
              </div>
              <div v-else-if="icon" class="mr-2 items-center text-xs font-bold">
                <component
                  :is="icon"
                  class="h-3 w-3"
                  :class="{
                    'text-slate-600 dark:text-jovieDark-200': !color,
                    [color]: color,
                  }" />
              </div>
              <div v-else></div>

              <div class="text-xs font-normal tracking-wider">{{ name }}</div>
            </div>
            <div class="flex">
              <KBShortcut
                :sequence="shortcutSequence"
                :shortcutKey="shortcutKey" />
            </div>
          </div>
        </slot>
      </div>
    </div>
  </MenuItem>
</template>
<script>
import KBShortcut from './KBShortcut.vue';
import {
  ChatBubbleLeftIcon,
  ArrowLeftOnRectangleIcon,
  ChartBarIcon,
  WrenchScrewdriverIcon,
  ComputerDesktopIcon,
  UserIcon,
  SunIcon,
  MoonIcon,
  EnvelopeIcon,
  ChatBubbleOvalLeftEllipsisIcon,
  PhoneIcon,
  CalendarDaysIcon,
  ChatBubbleLeftEllipsisIcon,
  CheckIcon,
  ArrowPathIcon,
} from '@heroicons/vue/24/solid';
import { MenuItem } from '@headlessui/vue';
export default {
  components: {
    KBShortcut,
    MenuItem,
    PhoneIcon,
    SunIcon,
    MoonIcon,
    CalendarDaysIcon,
    ChatBubbleOvalLeftEllipsisIcon,
    EnvelopeIcon,
    ComputerDesktopIcon,
    WrenchScrewdriverIcon,
    UserIcon,
    CheckIcon,
    ArrowPathIcon,
    ChatBubbleLeftEllipsisIcon,
    ChatBubbleLeftIcon,
    ChartBarIcon,
    ArrowLeftOnRectangleIcon,
  },
  computed: {
    dotClass() {
      switch (this.colorDot) {
        case 'indigo':
          return 'bg-indigo-600 text-indigo-600 dark:bg-indigo-400';
        case 'sky':
          return 'bg-sky-600 text-sky-600 dark:bg-sky-400';
        case 'green':
          return 'bg-green-600 text-green-600 dark:bg-green-400';
        case 'yellow':
          return 'bg-yellow-600 text-yellow-600 dark:bg-yellow-400';
        case 'orange':
          return 'bg-orange-600 text-orange-600 dark:bg-orange-400';
        case 'red':
          return 'bg-red-600 text-red-600 dark:bg-red-400';
        case 'pink':
          return 'bg-pink-600 text-pink-600 dark:bg-pink-400';
        case 'purple':
          return 'bg-purple-600 text-purple-600 dark:bg-purple-400';
        case 'gray':
          return 'bg-gray-600 text-gray-600 dark:bg-gray-400';
        case 'fuchsia':
          return 'bg-fuchsia-600 text-fuchsia-600 dark:bg-fuchsia-400';
        case 'lime':
          return 'bg-lime-600 text-lime-600 dark:bg-lime-400';
        case 'slate':
          return 'bg-slate-600 text-slate-600 dark:bg-slate-400';
        default:
          return null;
      }
    },
  },

  props: {
    name: {
      type: String,
      required: true,
    },
    color: {
      type: String,
      required: false,
    },
    colorDot: {
      type: String,
      required: false,
    },
    emoji: {
      type: String,
      required: false,
    },
    icon: {
      type: String,
      required: false,
    },
    numbered: {
      type: Boolean,
      required: false,
      default: false,
    },
    checked: {
      type: Boolean,
      required: false,
      default: false,
    },
    shortcutKey: {
      type: Array,
      required: false,
      default: () => [],
    },
    disabled: {
      type: Boolean,
      required: false,
      default: false,
    },
    seperator: {
      type: Boolean,
      required: false,
      default: false,
    },
    checkable: {
      type: Boolean,
      required: false,
      default: false,
    },
    shortuctSequence: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
};
</script>
