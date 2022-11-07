<template>
  <div class="">
    <div class="group relative mt-1">
      <div class="relative">
        <div
          v-if="icon"
          class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
          <component :is="icon" class="h-5 w-5 text-neutral-400" />
        </div>
        <div
          v-if="socialicon"
          class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
          <SocialIcons
            class="text-neutral-400"
            link="#"
            width="16px"
            height="16px"
            :icon="socialicon" />
        </div>
        <input
          :autocomplete="autocomplete"
          :type="type"
          :name="name"
          :id="id"
          :v-focus="focused"
          :disabled="disabled"
          :value="modelValue ?? value"
          @blur="$emit('blur')"
          @input="$emit('update:modelValue', $event.target.value)"
          class="input-field h-8 w-full rounded border border-gray-300 border-opacity-0 py-2 px-2 leading-none text-gray-700 placeholder-transparent outline-none transition focus:border-indigo-500 group-hover:border-opacity-100 group-hover:bg-gray-100"
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
            { 'py-0 text-xs': size == 'md' },
            { 'pl-10': socialicon },
          ]"
          :placeholder="label" />
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
          <div v-if="loader" class="pointer-events-none transition-all">
            <JovieSpinner />
          </div>
          <div v-else>
            <div class="pointer-events-none text-indigo-500" v-if="valid">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div class="pointer-events-none text-red-500" v-else-if="isInvalid">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div
              class="group/copy cursor-pointer text-red-500"
              v-else-if="isCopyable && (modelValue || value)">
              <DocumentDuplicateIcon
                @click="copyToClipboard"
                class="hidden h-5 w-5 cursor-pointer text-gray-400 active:text-gray-900 group-hover:block group-hover/copy:text-gray-500" />
            </div>
          </div>
        </div>
        <label
          v-if="label"
          :for="name"
          :id="id"
          class="peer-focus:text-[8px]] absolute -top-2.5 left-0 ml-2 block cursor-text rounded-t-md bg-white px-1 text-xs font-medium text-gray-400 transition-all group-hover:border-t group-hover:bg-neutral-100 group-hover:text-neutral-500 peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-neutral-400 peer-focus:left-0 peer-focus:-top-2 peer-focus:font-medium"
          >{{ label }}</label
        >
      </div>
      <div v-if="error" class="mt-2 text-xs text-red-600">{{ error }}</div>
    </div>
  </div>
</template>

<script>
import JovieSpinner from '../components/JovieSpinner.vue';
import SocialIcons from '../components/SocialIcons.vue';
import {
  MagnifyingGlassIcon,
  CameraIcon,
  VideoCameraIcon,
  ChatBubbleLeftEllipsisIcon,
  PhoneIcon,
  LinkIcon,
  EnvelopeIcon,
  PhotoIcon,
  MapPinIcon,
  ArrowTrendingUpIcon,
  ArrowTrendingDownIcon,
  ExclamationCircleIcon,
  TagIcon,
  UserIcon,
  UsersIcon,
  ArrowSmallUpIcon,
  ArrowSmallDownIcon,
  BriefcaseIcon,
  DocumentDuplicateIcon,
  CheckCircleIcon,
} from '@heroicons/vue/24/solid';
export default {
  name: 'InputGroup',

  props: {
    label: {
      type: String,
      default: null,
    },
    id: String,
    name: String,
    type: {
      type: String,
      default: 'text',
    },
    placeholder: {
      type: String,
      default: null,
    },
    focused: { type: Boolean, default: false },
    disabled: Boolean,
    icon: String,
    value: String,
    modelValue: {},
    error: {
      type: String,
      default: null,
    },
    isCopyable: {
      type: Boolean,
      default: false,
    },
    isCopied: {
      type: Boolean,
      default: false,
    },
    autocomplete: {
      type: String,
      default: 'off',
    },
    isInvalid: {
      type: Boolean,
      default: false,
    },
    rounded: {
      type: String,
      default: 'all',
    },
    valid: {
      type: Boolean,
      default: false,
    },
    size: {
      type: String,
      default: 'md',
    },
    loader: {
      type: Boolean,
      default: false,
    },
    socialicon: {
      type: String,
    },
  },
  components: {
    EnvelopeIcon,
    VideoCameraIcon,
    ChatBubbleLeftEllipsisIcon,
    CameraIcon,
    LinkIcon,
    MagnifyingGlassIcon,
    PhotoIcon,
    MapPinIcon,
    ArrowTrendingUpIcon,
    ArrowTrendingDownIcon,
    TagIcon,
    UserIcon,
    SocialIcons,
    DocumentDuplicateIcon,
    CheckCircleIcon,
    UsersIcon,
    ExclamationCircleIcon,
    ArrowSmallUpIcon,
    ArrowSmallDownIcon,
    BriefcaseIcon,
    JovieSpinner,
    PhoneIcon,
  },
  methods: {
    copyToClipboard() {
      this.$emit('copyToClipboard');
    },
  },
};
</script>
