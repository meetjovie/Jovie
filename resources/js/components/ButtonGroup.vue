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
        ? 'bg-gray-500'
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
        'bg-white shadow-sm   hover:bg-indigo-500 hover:text-white  ':
          design == 'secondary',
      },
      {
        'group flex cursor-pointer items-center rounded-md p-4 hover:bg-gray-100 disabled:cursor-not-allowed disabled:opacity-30':
          design == 'toolbar',
      },
      {
        'hover:bg-indig-600 w-full  font-medium text-white  shadow-sm hover:bg-indigo-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-900':
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
    <component
      v-if="icon"
      :is="icon"
      :class="[
        {
          'h-5 w-5 text-gray-400 group-hover:text-neutral-600':
            design == 'toolbar',
        },
        { 'absolute -ml-1 mr-3 h-5 w-5': design == 'secondary' },
      ]"
      aria-hidden="true" />
    <p
      v-if="text"
      class="mx-auto text-center text-sm"
      :class="[
        { 'text-2xs': size == 'xs' },
        { 'text-xs': size == 'sm' },
        { 'sr-only': hideText },
      ]">
      {{ text }}
    </p>
    <div v-if="loader" class="ml-2 transition-all">
      <JovieSpinner class="mr-2" :spinnerColor="loaderColor" />
    </div>
    <div v-else-if="success">
      <CheckIcon class="h-5 w-5 text-white transition-all" />
    </div>

    <div v-else-if="error">
      <XMarkIcon class="h-5 w-5 text-white transition-all" />
    </div>
    <div v-else></div>
  </button>
  <!-- <a
    href="#_"
    class="group relative inline-block overflow-hidden rounded bg-indigo-600 px-5 py-2.5 font-medium text-white">
    <span
      :class="[{ 'w-full': success }, { 'w-0': !success }]"
      class="absolute top-0 left-0 mb-0 flex h-full w-0 translate-y-0 transform border border-green-500 bg-green-500 opacity-100 transition-all duration-200 ease-out"></span>
    <span class="relative">
      <component
        v-if="icon"
        :is="icon"
        class="relative"
        :class="[
          {
            'h-5 w-5 text-gray-400 group-hover:text-neutral-600':
              design == 'toolbar',
          },
          { 'absolute -ml-1 mr-3 h-5 w-5': design == 'secondary' },
        ]"
        aria-hidden="true" />
      <p
        v-if="text"
        class="mx-auto text-center text-sm"
        :class="[
          { 'text-2xs': size == 'xs' },
          { 'text-xs': size == 'sm' },
          { 'sr-only': hideText },
        ]">
        {{ text }}
      </p>
    </span>
  </a> -->
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
  XMarkIcon,
} from '@heroicons/vue/24/solid';
import { CheckIcon } from '@heroicons/vue/24/solid';

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
    CheckIcon,
    AdjustmentsHorizontalIcon,
    MinusIcon,
    PlusCircleIcon,
    MinusCircleIcon,
    ChevronRightIcon,
    JovieSpinner,
    XMarkIcon,
  },
};
</script>
