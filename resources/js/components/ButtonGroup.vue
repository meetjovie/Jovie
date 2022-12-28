<template>
  <button
    type="button"
    :disabled="disabled"
    @click="trackClick()"
    class="group inline-flex items-center overflow-hidden font-medium first:rounded-l-md last:rounded-r-md only-of-type:rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
    :class="[
      success
        ? 'bg-green-500'
        : error
        ? 'bg-red-500'
        : disabled
        ? 'bg-slate-500'
        : '',
      //design seconday then bg color white
      design === 'secondary' ? 'bg-white' : '',
      //if toolbar then bg color white
      toolbar ? 'bg-white' : '',

      { 'py-0 px-2 text-xs': size == 'xs' },
      { 'py-1 px-2 text-sm': size == 'sm' },
      { 'py-3  px-4 text-base': size == 'base' },
      { 'py-2 px-4 text-lg': size == 'md' },
      { 'py-3 px-6 text-xl': size == 'hero' },
      {
        'border-slate-300 bg-white text-slate-600 shadow-sm hover:bg-indigo-500 hover:text-white   dark:border-jovieDark-border dark:bg-jovieDark-800 dark:hover:bg-jovieDark-700  ':
          design == 'secondary',
      },
      {
        'group flex cursor-pointer items-center rounded-md p-4 hover:bg-slate-100 disabled:cursor-not-allowed disabled:opacity-30 dark:hover:bg-jovieDark-800':
          design == 'toolbar',
      },
      {
        'hover:bg-indig-600 w-full  font-medium text-white  shadow-sm hover:bg-indigo-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900':
          design == 'primary',
      },
      {
        'mt-3 flex w-full items-center justify-center rounded-md border-none bg-indigo-500 text-base font-medium text-white shadow-xl shadow-indigo-700/30 hover:bg-indigo-800 hover:shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-700 sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0':
          design == 'hero',
      },
      { 'bg-red-500 text-white': design == 'danger' },
      {
        'bg-indigo-500 text-white active:bg-indigo-600': design == 'primary',
      },

      { 'rounded-r-md': rounded == 'right' },
      { 'rounded-l-md': rounded == 'left' },
      { 'rounded-t-md': rounded == 'top' },
      { 'rounded-b-md': rounded == 'bottom' },
      { 'rounded-md': rounded == 'all' },
      { 'rounded-tl-md': rounded == 'top-left' },
      { 'rounded-tr-md': rounded == 'top-right' },
      { 'rounded-bl-md': rounded == 'blt' },
      { 'rounded-br-md': rounded == 'br' },
    ]">
    <svg
      v-if="icon == 'google'"
      role="img"
      class="h-5 w-5"
      fill="currentColor"
      viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg">
      <title>Google</title>
      <path
        d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z" />
    </svg>
    <component
      v-else-if="icon"
      :is="icon"
      :class="[
        {
          'dark:group-hover:text-slate h-5 w-5 text-slate-400 group-hover:text-slate-600 dark:text-jovieDark-400 dark:group-hover:text-jovieDark-200':
            design == 'toolbar',
        },
        { 'absolute -ml-1 mr-3 h-5 w-5': design == 'secondary' },
      ]"
      aria-hidden="true" />
    <p
      v-if="text"
      class="mx-auto flex items-center text-center text-sm"
      :class="[
        { 'text-2xs': size == 'xs' },
        { 'text-xs': size == 'sm' },
        { 'sr-only': hideText },
      ]">
      {{ text }}<slot></slot>
    </p>
    <div v-if="loader" class="ml-2 transition-all">
      <JovieSpinner class="mr-2" :spinnerColor="loaderColor" />
    </div>
    <div v-else-if="success">
      <CheckCircleIcon class="h-5 w-5 text-white transition-all" />
    </div>

    <div v-else-if="error">
      <XCircleIcon class="h-5 w-5 text-white transition-all" />
    </div>
    <div v-else></div>
  </button>
</template>

<script>
import {
  EnvelopeIcon,
  MagnifyingGlassIcon,
  NoSymbolIcon,
  PlusCircleIcon,
  MinusCircleIcon,
  MinusIcon,
  AdjustmentsHorizontalIcon,
  PlusIcon,
  ChevronRightIcon,
} from '@heroicons/vue/24/solid';
import { XCircleIcon, CheckCircleIcon } from '@heroicons/vue/24/solid';

import JovieSpinner from '../components/JovieSpinner';

export default {
  methods: {
    trackClick() {
      window.analytics.track('Clicked Button', {
        label: this.text,
        page: this.$route.path,
      });
    },
  },
  props: {
    text: {
      type: String,
      default: null,
      required: false,
    },
    error: {
      type: String,
      default: '',
      required: false,
    },
    icon: {
      type: String,
      default: null,
      required: false,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    buttonlink: {
      type: String,
      default: null,
      required: false,
    },
    loaderPosition: {
      type: String,
      default: 'right',
      required: false,
    },
    size: {
      type: String,
      default: 'md',
    },
    loader: {
      type: Boolean,
      default: false,
    },
    loaderColor: {
      type: String,
      default: 'white',
    },
    design: {
      type: String,
      default: 'primary',
    },
    hideText: {
      type: Boolean,
      default: false,
    },
    rounded: {
      type: String,
      default: 'all',
    },
    success: {
      type: String,
      default: null,
    },
  },
  components: {
    EnvelopeIcon,
    MagnifyingGlassIcon,
    NoSymbolIcon,
    PlusIcon,
    CheckCircleIcon,
    AdjustmentsHorizontalIcon,
    MinusIcon,
    PlusCircleIcon,
    MinusCircleIcon,
    ChevronRightIcon,
    JovieSpinner,
    XCircleIcon,
  },
};
</script>
