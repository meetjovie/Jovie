<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <span
    class="mr-1 inline-flex items-center font-medium first:rounded-l-md last:rounded-r-md only:rounded-md"
    :class="[
      {
        'py-0 pl-2 pr-0.5 text-[8px] font-light tracking-wider': size == 'xs',
      },
      {
        'py-0 pl-2 pr-0.5 text-[10px] font-light tracking-wider': size == 'sm',
      },
      {
        'py-0.5 pl-2 pr-0.5 text-[12px] font-light tracking-wider':
          size == 'md',
      },
      { 'py-0.5 pl-2.5 pr-1 text-sm ': size == 'lg' },
      { 'bg-neutral-100 text-neutral-900': color == 'none' },
      { 'bg-indigo-100 text-indigo-900': color == 'indigo' },
      { 'bg-blue-100 text-blue-900': color == 'blue' },
      { 'bg-green-100 text-green-900': color == 'green' },
      { 'bg-red-100 text-red-900': color == 'red' },
      { 'bg-orange-100 text-orange-900': color == 'orange' },
      { 'bg-purple-100 text-purple-900': color == 'purple' },
      { 'bg-pink-100 text-pink-900': color == 'pink' },
    ]">
    {{ text }}
    <button
      type="button"
      class="ml-0.5 inline-flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full focus-visible:bg-indigo-500 focus-visible:text-white focus-visible:outline-none"
      :class="[
        { 'py-0 pl-0.5 pr-0.5 text-[10px]': size == 'xs' },
        { 'py-0 pl-1 pr-1 text-2xs': size == 'sm' },
        { 'py-0.5 pl-2.5 pr-1 text-sm ': size == 'lg' },
        {
          'bg-neutral-100 text-neutral-700 hover:text-neutral-900 ':
            color == 'none',
        },
        {
          'bg-indigo-100 text-indigo-700  hover:text-indigo-900':
            color == 'indigo',
        },
        {
          'bg-blue-100 text-blue-700 hover:text-blue-900': color == 'blue',
        },
        {
          'bg-green-100 text-green-700 hover:text-green-900': color == 'green',
        },
        {
          'bg-red-100 text-red-700 hover:text-red-900': color == 'red',
        },
        {
          'bg-orange-100 text-orange-700 hover:text-orange-900':
            color == 'orange',
        },
        {
          'bg-purple-100 text-purple-700 hover:text-purple-900':
            color == 'purple',
        },
        { 'bg-pink-100 text-pink-700 hover:text-pink-900': color == 'pink' },
      ]">
      <span class="sr-only">Remove {{ text }}</span>
      <XIcon class="h-3 w-3" />
    </button>
  </span>
</template>
<script>
import { XIcon } from '@heroicons/vue/outline';
export default {
  components: {
    XIcon,
  },
  props: {
    text: {
      type: String,
      required: true,
      default: 'Tag',
    },
    size: {
      type: String,
      default: 'sm',
    },
    color: {
      type: String,
      default: 'none',
    },
  },
};
</script>
