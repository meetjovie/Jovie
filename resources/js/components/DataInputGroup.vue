<template>
  <div class="group/datainput mt-1 flex">
    <div class="group/move active:grabbing flex w-3 cursor-grab items-center">
      <EllipsisVerticalIcon
        class="h-5 w-5 text-neutral-400/0 group-hover/draggable:text-neutral-400 group-hover/move:text-neutral-700" />
    </div>
    <div class="group relative mt-1 w-full">
      <div class="relative">
        <div
          v-if="icon"
          class="pointer-events-none absolute inset-y-0 -top-8 left-0 z-20 flex items-center pl-3">
          <component :is="icon" class="h-3 w-3 text-neutral-400" />
        </div>
        <div
          v-if="socialicon"
          class="opacity/50 pointer-events-none absolute inset-y-0 -top-8 left-0 z-20 flex items-center pl-3">
          <SocialIcons
            class="text-neutral-400"
            link="#"
            width="12px"
            height="12px"
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
          class="input-field prrounded h-8 w-full border border-gray-300 border-opacity-0 py-2 px-2 leading-none text-gray-700 placeholder-transparent outline-none transition focus:border-indigo-500 group-hover:border-opacity-100 group-hover:bg-gray-100"
          :class="[
            icon ? 'pl-4' : '',
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
            { 'pl-4': socialicon },
            { 'pr-14': action || isCopyable },
          ]"
          :placeholder="label" />
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
          <div v-if="action && (modelValue || value)" class="group/action px-1">
            <component
              @click="$emit('action')"
              :is="action"
              class="hidden h-5 w-5 cursor-pointer text-gray-400 active:text-gray-900 group-hover:block group-hover/action:text-neutral-500" />
          </div>
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
              <ClipboardDocumentIcon
                v-if="!itemCopied"
                @click="copyToClipboard"
                class="hidden h-5 w-5 cursor-pointer text-gray-400 active:text-gray-900 group-hover:block group-hover/copy:text-gray-500" />
              <ClipboardDocumentCheckIcon
                v-else
                @click="copyToClipboard"
                class="hidden h-5 w-5 cursor-pointer text-gray-400 active:text-gray-900 group-hover:block group-hover/copy:text-gray-500" />
            </div>
          </div>
        </div>
        <label
          v-if="label"
          :for="name"
          :id="id"
          class="peer-focus:text-[8px]] absolute -top-2.5 left-0 ml-2 block cursor-text rounded-t-md bg-white px-1 pl-5 text-xs font-medium text-gray-400 transition-all group-hover:border-t group-hover:bg-neutral-100 group-hover:text-neutral-500 peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-neutral-400 peer-focus:left-0 peer-focus:-top-2 peer-focus:font-medium"
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
  ArrowTopRightOnSquareIcon,
  ClipboardDocumentCheckIcon,
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
  ClipboardDocumentIcon,
  CheckCircleIcon,
  EllipsisVerticalIcon,
} from '@heroicons/vue/24/solid';
export default {
  name: 'InputGroup',
  data() {
    return {
      itemCopied: false,
    };
  },
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
    action: {
      type: String,
      default: null,
    },
    socialicon: {
      type: String,
    },
  },
  components: {
    EnvelopeIcon,
    EllipsisVerticalIcon,
    VideoCameraIcon,
    ChatBubbleLeftEllipsisIcon,
    CameraIcon,
    ArrowTopRightOnSquareIcon,
    LinkIcon,
    MagnifyingGlassIcon,
    PhotoIcon,
    MapPinIcon,
    ArrowTrendingUpIcon,
    ArrowTrendingDownIcon,
    TagIcon,
    UserIcon,
    SocialIcons,
    ClipboardDocumentIcon,
    CheckCircleIcon,
    UsersIcon,
    ExclamationCircleIcon,
    ArrowSmallUpIcon,
    ArrowSmallDownIcon,
    BriefcaseIcon,
    JovieSpinner,
    PhoneIcon,
    ClipboardDocumentCheckIcon,
  },
  methods: {
    copyToClipboard() {
      this.itemCopied = false;
      this.$emit('copyToClipboard');
      this.itemCopied = true;
      //reset value after 10 seconds
      setTimeout(() => {
        this.itemCopied = false;
      }, 10000);
    },
  },
};
</script>
