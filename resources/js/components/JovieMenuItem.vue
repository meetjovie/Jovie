<template>
  <JovieTooltip
    v-if="!hideIfEmpty || !hide || count > 0"
    as="template"
    :tooltipText="description">
    <MenuItem class="group/menuItem" v-slot="{ active }">
      <component
        :is="routerLink ? 'router-link' : 'div'"
        @click="handleClick()"
        class="w-full"
        active-class="bg-slate-100  w-full dark:bg-jovieDark-500 rounded dark:text-jovieDark-200"
        :to="{ name: component }">
        <div
          :class="[
            active || selected
              ? 'bg-slate-100 dark:bg-jovieDark-500 dark:text-jovieDark-200 '
              : 'text-slate-900 dark:text-jovieDark-100',
            'focus:ring-none group flex w-full items-center justify-between rounded px-2 py-1  text-xs focus:border-none  focus:outline-none ',
          ]">
          <div class="flex items-center">
            <Bars3Icon
              v-if="draggable"
              class="h-3 w-3 cursor-grab text-slate-700/0 active:cursor-grabbing active:text-slate-900 group-hover/menuItem:text-slate-900 dark:text-jovieDark-300/0 dark:active:text-slate-100 dark:group-hover/menuItem:text-slate-100"></Bars3Icon>
            <component
              :is="icon"
              :class="`${iconColor}`"
              class="h-3 w-3 text-slate-400 dark:text-jovieDark-400"
              aria-hidden="true" />
          </div>
          <div class="flex w-full px-2">
            <slot name="name">
              <span class="line-clamp-1">{{ name }}</span></slot
            >
          </div>

          <div class="items-center rounded hover:text-slate-50">
            <ArrowPathIcon
              v-if="loading"
              class="mx-auto mr-2 mt-1 h-4 w-4 animate-spin-slow items-center group-hover/list:hidden group-hover/list:text-slate-800 dark:group-hover/list:text-slate-200" />

            <span
              v-else-if="count"
              class="text-xs font-light text-slate-700 group-hover:text-slate-900 dark:text-jovieDark-300 dark:group-hover:text-slate-100"
              >{{ count }}</span
            >
          </div>
        </div>
      </component>
    </MenuItem>
  </JovieTooltip>
</template>

<script>
import { MenuItem } from '@headlessui/vue';
import JovieTooltip from './JovieTooltip.vue';
import {
  UserPlusIcon,
  SparklesIcon,
  ArrowPathIcon,
  CloudArrowUpIcon,
  GlobeAltIcon,
  CreditCardIcon,
  Bars3Icon,
  UserIcon,
  DocumentDuplicateIcon,
  HeartIcon,
  CogIcon,
  CakeIcon,
  LockClosedIcon,
  ArchiveBoxIcon,
} from '@heroicons/vue/24/solid';

export default {
  components: {
    MenuItem,
    JovieTooltip,
    CakeIcon,
    ArchiveBoxIcon,
    CogIcon,
    UserPlusIcon,
    DocumentDuplicateIcon,
    HeartIcon,
    Bars3Icon,
    SparklesIcon,
    CloudArrowUpIcon,
    GlobeAltIcon,
    ArrowPathIcon,
    LockClosedIcon,
    CreditCardIcon,
    UserIcon,
  },
  methods: {
    handleClick() {
      this.$emit('button-click');
    },
  },
  props: {
    draggable: {
      type: Boolean,
      required: false,
      default: false,
    },
    icon: {
      type: String,
      required: true,
    },
    loading: {
      type: Boolean,
      required: false,
      default: false,
    },
    disableRouterLink: {
      type: Boolean,
      required: false,
      default: false,
    },
    header: {
      type: Boolean,
      required: false,
      default: false,
    },
    hideIfEmpty: {
      type: Boolean,
      required: false,
      default: false,
    },
    routerLink: {
      type: Boolean,
      required: false,
      default: true,
    },
    hide: {
      type: Boolean,
      required: false,
      default: false,
    },
    active: {
      type: Boolean,
      required: false,
      default: false,
    },
    count: {
      type: Number,
      required: false,
    },
    name: {
      type: String,
      required: true,
    },
    selected: {
      type: Boolean,
      required: false,
      default: false,
    },
    description: {
      type: String,
      required: false,
      default: null,
    },
    iconColor: {
      type: String,
      required: false,
      default: 'text-slate-400 dark:text-jovieDark-400',
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
