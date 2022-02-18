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
        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <component :is="icon" class="h-5 w-5 text-gray-400" />
      </div>
      <input
        :type="type"
        :name="name"
        :id="name"
        :disabled="disabled"
        :value="modelValue ?? value"
        @input="$emit('update:modelValue', $event.target.value)"
        class="block w-full border-gray-300 py-2 text-sm rounded-${{rounded}}-md text-neutral-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500"
        :class="[icon ? 'pl-10' : '']"
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
      default: null,
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
