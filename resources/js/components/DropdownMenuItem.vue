<template>
  <MenuItem as="div" v-slot="{ active }">
    <div
      class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-slate-600 dark:text-jovieDark-200"
      :class="{
        'bg-slate-200 text-slate-700 dark:bg-jovieDark-500 dark:text-jovieDark-100':
          active,
      }">
      <div class="flex w-full items-center">
        <slot>
          <div class="flex w-full items-center justify-between">
            <div class="flex w-full items-center">
              <div v-if="emoji" class="mr-2 text-xs font-bold">
                {{ emoji }}
              </div>
              <div v-else-if="icon" class="mr-2 items-center text-xs font-bold">
                <component :is="icon" class="h-3 w-3" />
              </div>
              <div v-else></div>

              <div class="text-xs font-normal tracking-wider">{{ name }}</div>
            </div>
            <div class="flex">
              <KBShortcut :shortcutKey="shortcut" />
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
  UserIcon,
} from '@heroicons/vue/24/outline';
import { MenuItem } from '@headlessui/vue';
export default {
  components: {
    KBShortcut,
    MenuItem,
    WrenchScrewdriverIcon,
    UserIcon,
    ChatBubbleLeftIcon,
    ChartBarIcon,
    ArrowLeftOnRectangleIcon,
  },
  props: {
    name: {
      type: String,
      required: true,
    },
    emoji: {
      type: String,
      required: false,
    },
    icon: {
      type: String,
      required: false,
    },
    shortcut: {
      type: String,
      required: false,
    },
  },
};
</script>
