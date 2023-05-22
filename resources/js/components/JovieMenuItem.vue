<template>
  <MenuItem v-slot="{ active }">
    <router-link
      active-class="bg-slate-100 dark:bg-jovieDark-500 rounded dark:text-jovieDark-200"
      :to="{ name: component }">
      <div
        :class="[
          active
            ? 'bg-slate-100 dark:bg-jovieDark-500 dark:text-jovieDark-200'
            : 'text-slate-900 dark:text-jovieDark-100',
          'group flex w-full items-center rounded px-2 py-1 text-xs',
        ]">
        <component
          :is="icon"
          class="mr-2 h-3 w-3 text-slate-400 dark:text-jovieDark-400"
          aria-hidden="true" />
        {{ name }}
      </div>
    </router-link>
  </MenuItem>
</template>

<script>
import { MenuItem } from '@headlessui/vue';
import {
  UserPlusIcon,
  SparklesIcon,
  CloudArrowUpIcon,
  GlobeAltIcon,
  CreditCardIcon,
  UserIcon,
  CogIcon,
  LockClosedIcon,
} from '@heroicons/vue/24/solid';

export default {
  components: {
    MenuItem,
    CogIcon,
    UserPlusIcon,
    SparklesIcon,
    CloudArrowUpIcon,
    GlobeAltIcon,
    LockClosedIcon,
    CreditCardIcon,
    UserIcon,
  },
  props: {
    icon: {
      type: String,
      required: true,
    },
    header: {
      type: Boolean,
      required: false,
      default: false,
    },
    active: {
      type: Boolean,
      required: false,
      default: false,
    },
    name: {
      type: String,
      required: true,
    },
    disabled: {
      type: Boolean,
      required: false,
      default: false,
    },
    component: {
      type: String,
      required: false,
      default: null,
    },
  },
};
</script>
