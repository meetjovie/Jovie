<template>
  <div class="">
    <label
      v-if="label"
      :for="name"
      class="block text-sm font-medium text-gray-700"
      >{{ label }}</label
    >
    <div class="relative mt-1 shadow-sm">
      <div
        v-if="icon"
        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
        :class="{ 'pl-1': rounded == 'sm' }">
        <component
          :is="icon"
          class="h-5 w-5 text-gray-400"
          :class="{ 'h-3 w-3': rounded == 'sm' }" />
      </div>
      <input
        :type="type"
        :name="name"
        :id="name"
        :disabled="disabled"
        :value="modelValue ?? value"
        @input="$emit('update:modelValue', $event.target.value)"
        class="block w-full border-gray-300 py-2 text-sm text-neutral-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500"
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
      <p v-if="error" class="mt-2 text-sm text-red-600">{{ error }}</p>
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
    },
    name: String,
    type: {
      type: String,
      default: 'text',
    },
    placeholder: String,
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
