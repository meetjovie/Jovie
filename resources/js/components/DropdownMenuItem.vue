<template>
  <MenuItem :disabled="disabled" as="div" v-slot="{ active }">
    <div
      :class="{
        'cursor-not-allowed opacity-50': disabled,
        'bg-slate-200 text-slate-700 dark:bg-jovieDark-500 dark:text-jovieDark-100':
          active,
      }"
      class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1.5 text-xs text-slate-600 dark:text-jovieDark-200">
      <div class="flex w-full items-center">
        <slot>
          <div class="flex w-full items-center justify-between">
            <div class="flex w-full items-center">
              <div v-if="emoji" class="mr-2 text-xs font-bold">
                {{ emoji }}
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
              <KBShortcut :sequence="shortuctSequence" :shortcutKey="Key" />
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
  CheckCircleIcon,
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
    CheckCircleIcon,
    ArrowPathIcon,
    ChatBubbleLeftEllipsisIcon,
    ChatBubbleLeftIcon,
    ChartBarIcon,
    ArrowLeftOnRectangleIcon,
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
    shortcutKey: {
      type: Array,
      required: false,
      default: ['shift', 'alt', 'c'],
    },
    disabled: {
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
