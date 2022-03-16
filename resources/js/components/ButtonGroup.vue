<template>
  <button
    type="button"
    :disabled="disabled"
    class="group inline-flex items-center border border-neutral-200 px-4 py-2 text-sm font-medium shadow-sm first:rounded-l-md last:rounded-r-md only-of-type:rounded-md hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
    :class="[
      { 'py-0 text-xs': size == 'xs' },
      { 'py-1 text-sm': size == 'sm' },
      { 'bg-white text-red-900 hover:bg-indigo-500': style == 'secondary' },
      { 'bg-indigo-500 text-white': style == 'primary' },
      { 'bg-red-500 ': style == 'danger' },
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
      :is="icon"
      class="absolute -ml-1 mr-3 h-5 w-5"
      aria-hidden="true" />
    <p
      v-if="text"
      class="mx-auto text-center text-sm hover:text-white"
      :class="[
        { 'text-2xs': size == 'xs' },
        { 'py-0 text-xs': size == 'sm' },
        { 'bg-red-500 text-white ': style == 'danger' },
        { 'bg-white text-neutral-500': style == 'secondary' },
        { 'bg-indigo-500 text-white': style == 'primary' },
      ]">
      {{ text }}
    </p>
  </button>
</template>

<script>
import {
  MailIcon,
  SearchIcon,
  BanIcon,
  ChevronRightIcon,
} from '@heroicons/vue/solid';

export default {
  props: {
    text: {
      type: String,
      required: false,
    },
    icon: {
      type: String,
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    size: {
      type: String,
      default: 'md',
    },
    style: {
      type: String,
      default: 'primary',
    },
    rounded: {
      type: String,
      default: 'all',
    },
  },
  components: {
    MailIcon,
    SearchIcon,
    BanIcon,
    ChevronRightIcon,
  },
};
</script>
