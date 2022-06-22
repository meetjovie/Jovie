<template>
  <div class="">
    <div class="relative mt-1">
      <div
        v-if="socialicon"
        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
        :class="{ 'pl-1': rounded == 'sm' }">
        <component
          :is="socialicon"
          class="h-5 w-5 text-gray-400"
          :class="{ 'h-3 w-3': rounded == 'sm' }" />
      </div>
      <div
        v-if="icon"
        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
        :class="{ 'pl-1': rounded == 'sm' }">
        <component
          :is="icon"
          class="h-5 w-5 text-gray-400"
          :class="{ 'h-3 w-3': rounded == 'sm' }" />
      </div>
      <div class="relative">
        <input
          :type="type"
          :name="name"
          :id="name"
          :disabled="disabled"
          :value="modelValue ?? value"
          @blur="$emit('blur')"
          @input="$emit('update:modelValue', $event.target.value)"
          class="peer block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 placeholder-opacity-0 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 sm:text-sm"
          :class="[
            icon ? 'pl-10' : '',
            { 'rounded-r-md': rounded == 'right' },
            { 'rounded-l-md': rounded == 'left' },
            { 'rounded-t-md': rounded == 'top' },
            { 'rounded-b-md': rounded == 'bottom' },
            { 'rounded-md': rounded == 'all' },
            { 'rounded-tl-md': rounded == 'top-left' },
            { 'rounded-tr-md': rounded == 'top-right' },
            { 'rounded-bl-md': rounded == 'bottom-left' },
            { 'rounded-br-md': rounded == 'bottom-right' },
            { 'py-0 text-xs': size == 'sm' },
          ]"
          :placeholder="placeholder" />
        <label
          v-if="label"
          :for="name"
          :id="name"
          class="absolute -top-2.5 left-0 ml-3 block cursor-text bg-white px-1 text-xs font-medium text-gray-500 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-gray-400 peer-focus:left-0 peer-focus:-top-2.5 peer-focus:text-xs peer-focus:font-medium"
          >{{ label }}</label
        >

        <p v-if="error" class="mt-2 text-sm text-red-600">{{ error }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import {
  SearchIcon,
  MailIcon,
  PhotographIcon,
  LocationMarkerIcon,
  TrendingUpIcon,
  TrendingDownIcon,
  TagIcon,
  UserIcon,
  UsersIcon,
  ArrowSmUpIcon,
  ArrowSmDownIcon,
  BriefcaseIcon,
} from '@heroicons/vue/solid';

export default {
  name: 'InputGroup',
  props: {
    label: {
      type: String,
      default: null,
    },
    name: String,
    type: {
      type: String,
      default: 'text',
    },
    placeholder: {
      type: String,
      default: null,
    },

    disabled: Boolean,
    icon: String,
    value: String,
    modelValue: {},
    error: String,
    rounded: {
      type: String,
      default: 'all',
    },
    size: {
      type: String,
      default: 'md',
    },
    socialicon: {
      type: String,
      default: 'twitter',
    },
  },
  components: {
    MailIcon,
    SearchIcon,
    PhotographIcon,
    LocationMarkerIcon,
    TrendingUpIcon,
    TrendingDownIcon,
    TagIcon,
    UserIcon,
    UsersIcon,
    ArrowSmUpIcon,
    ArrowSmDownIcon,
    BriefcaseIcon,
  },
};
</script>
