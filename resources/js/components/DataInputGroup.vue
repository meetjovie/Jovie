<template>
  <div class="group/bg-slate-50 dark:group/bg-slate-800 input mt-1 flex">
    <div
      v-if="sortable"
      class="group/move active:grabbing flex w-3 cursor-grab items-center">
      <EllipsisVerticalIcon
        class="h-5 w-5 text-slate-400/0 group-hover/draggable:text-slate-400 group-hover/move:text-slate-700 dark:text-jovieDark-600 dark:text-jovieDark-600/0 dark:group-hover/draggable:text-slate-600 dark:group-hover/move:text-slate-300" />
    </div>
    <div class="group relative mt-1 w-full">
      <div class="relative">
        <div
          v-if="icon"
          class="pointer-events-none absolute inset-y-0 -top-8 left-0 z-20 flex items-center pl-3">
          <component
            :is="icon"
            class="h-3 w-3 text-slate-400 dark:text-jovieDark-600" />
        </div>
        <div
          v-if="socialicon"
          class="opacity/50 pointer-events-none absolute inset-y-0 -top-8 left-0 z-20 flex items-center pl-3">
          <SocialIcons
            class="text-slate-400 opacity-40 dark:text-jovieDark-600"
            link="#"
            width="12px"
            height="12px"
            :icon="socialicon" />
        </div>
        <div
          v-if="currency"
          class="opacity/50 pointer-events-none absolute inset-y-0 -top-8 left-0 z-20 flex items-center pl-3">
          <CurrencyDollarIcon
            class="h-3 w-3 text-slate-400 dark:text-jovieDark-400" />
        </div>
        <input
          :autocomplete="autocomplete"
          :type="type === 'date' ? 'text' : type"
          :name="name"
          :id="id"
          :v-focus="focused"
          :disabled="disabled"
          :value="modelValue ?? value"
          @blur="$emit('blur')"
          @input="$emit('update:modelValue', $event.target.value)"
          @change="$emit('updateModelValue', $event.target.value)"
          class="input-field disable:cursor-none h-8 w-full rounded border border-slate-300 border-opacity-0 px-2 py-2 leading-none text-slate-700 placeholder-transparent outline-none transition focus:border-indigo-500 group-hover:border-opacity-100 group-hover:bg-slate-50 dark:border-jovieDark-border/0 dark:bg-jovieDark-900 dark:text-jovieDark-100 dark:hover:bg-jovieDark-800 dark:focus:border-indigo-400 dark:group-hover:border-jovieDark-border dark:group-hover:bg-jovieDark-800"
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
            { 'pr-18': action2 },
            { 'pr-14': action || isCopyable },
          ]"
          :placeholder="type == 'date' ? 'mm/dd/yyyy' : label" />
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
          <div
            v-if="action && (modelValue || value)"
            @click="$emit('actionMethod')"
            class="group/action px-1">
            <component
              :is="action"
              class="hidden h-5 w-5 cursor-pointer text-slate-400 dark:text-jovieDark-600 dark:active:text-slate-100 dark:group-hover/action:text-slate-400" />
          </div>
          <div
            v-if="action2 && (modelValue || value)"
            @click="$emit('actionMethod2')"
            class="group/action px-1">
            <component
              :is="action2"
              class="hidden h-5 w-5 cursor-pointer text-slate-400 dark:text-jovieDark-600 dark:active:text-slate-100 dark:group-hover/action:text-slate-400" />
          </div>
          <div v-if="type == 'date'" class="group/action px-1">
            <JovieDatePicker
              :value="modelValue"
              @update:modelValue="
                $emit('update:modelValue', $event);
                $emit('blur');
              "
              class="isolate z-50" />
          </div>
          <div v-if="loader" class="pointer-events-none transition-all">
            <JovieSpinner />
          </div>
          <div v-else>
            <div
              class="pointer-events-none text-indigo-500 dark:text-indigo-400"
              v-if="valid">
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
            <div
              class="pointer-events-none text-red-500 dark:text-red-400"
              v-else-if="isInvalid">
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
              @click="copyToClipboard(modelValue || value)"
              class="group/copy cursor-pointer text-red-500 dark:text-red-400"
              v-else-if="isCopyable && (modelValue || value)">
              <ClipboardDocumentIcon
                v-if="!itemCopied"
                class="hidden h-5 w-5 cursor-pointer text-slate-400 active:text-slate-900 group-hover:block group-hover/copy:text-slate-500 dark:text-jovieDark-600" />
              <ClipboardDocumentCheckIcon
                v-else
                class="hidden h-5 w-5 cursor-pointer text-slate-400 active:text-slate-900 group-hover:block group-hover/copy:text-slate-500 dark:text-jovieDark-600" />
            </div>
          </div>
        </div>
        <label
          v-if="label"
          :for="name"
          :id="id"
          class="peer-focus:text-[8px]] absolute -top-2.5 left-0 ml-2 block cursor-text rounded-t-md border-t border-transparent bg-white px-1 pl-5 text-xs font-medium capitalize text-slate-400 transition-all group-hover:bg-slate-50 group-hover:text-slate-500 peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-slate-400 peer-focus:-top-2 peer-focus:left-0 peer-focus:font-medium dark:bg-jovieDark-900 dark:text-jovieDark-200 dark:hover:bg-jovieDark-800 group-hover:dark:border-jovieDark-border dark:group-hover:bg-jovieDark-800 dark:group-hover:text-slate-200 dark:peer-placeholder-shown:text-slate-200"
          >{{ label }}</label
        >
      </div>
      <div v-if="error" class="mt-2 text-xs text-red-600 dark:text-red-400">
        {{ error }}
      </div>
    </div>
  </div>
</template>

<script>
import JovieDatePicker from '../components/JovieDatePicker.vue';
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
  CurrencyDollarIcon,
  EnvelopeIcon,
  PhotoIcon,
  MapPinIcon,
  ArrowTrendingUpIcon,
  ArrowTrendingDownIcon,
  ExclamationCircleIcon,
  CalendarDaysIcon,
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
import VueTailwindDatepicker from 'vue-tailwind-datepicker';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import { Float } from '@headlessui-float/vue';
import GlassmorphismContainer from './GlassmorphismContainer.vue';
export default {
  name: 'InputGroup',
  data() {
    return {
      open: false,
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
    action2: {
      type: String,
      default: null,
    },
    actionMethod2: {
      type: String,
      default: null,
    },
    actionMethod: {
      type: String,
      default: null,
    },
    socialicon: {
      type: String,
    },
    sortable: {
      type: Boolean,
      default: true,
    },
    currency: {
      type: Boolean,
      default: false,
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
    GlassmorphismContainer,
    Popover,
    PopoverButton,
    PopoverPanel,
    Float,
    MapPinIcon,
    JovieDatePicker,
    ArrowTrendingUpIcon,
    ArrowTrendingDownIcon,
    TagIcon,
    UserIcon,
    CurrencyDollarIcon,
    SocialIcons,
    CalendarDaysIcon,
    ClipboardDocumentIcon,
    CheckCircleIcon,
    UsersIcon,
    ExclamationCircleIcon,
    ArrowSmallUpIcon,
    ArrowSmallDownIcon,
    BriefcaseIcon,
    VueTailwindDatepicker,
    JovieSpinner,
    PhoneIcon,
    ClipboardDocumentCheckIcon,
  },
  methods: {
    copyToClipboard(value) {
      ///emit copy to clipboard
      this.$emit('copy', value);
      this.itemCopied = true;
      //after 2 seconds set itemCopied to false
      setTimeout(() => {
        this.itemCopied = false;
      }, 2000);
    },
  },
};
</script>
