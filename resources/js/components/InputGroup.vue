<template>
  <div class="">
    <div class="relative mt-1">
      <div
        v-if="socialicon"
        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
        :class="{ 'pl-1': rounded == 'sm' }">
        <SocialIcons
          class="text-slate-400 opacity-40 dark:text-jovieDark-600"
          link="#"
          width="12px"
          height="12px"
          :icon="socialicon" />
      </div>
      <div
        v-if="icon"
        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
        :class="{ 'pl-1': rounded == 'sm' }">
        <component
          :is="icon"
          class="z-10 h-5 w-5 text-slate-400 dark:text-jovieDark-200"
          :class="{ 'h-3 w-3': rounded == 'sm' }" />
      </div>

      <div class="relative">
        <input
          ref="input"
          :autocomplete="autocomplete"
          :type="
            passwordRevealToggle ? (passwordReveal ? 'text' : 'password') : type
          "
          :name="name"
          :id="id"
          :v-focus="focused"
          :disabled="disabled"
          :value="modelValue ?? value"
          @blur="$emit('blur')"
          @input="$emit('update:modelValue', $event.target.value)"
          class="peer block w-full appearance-none rounded-md border border-slate-300 px-3 py-2 placeholder-slate-400 placeholder-opacity-0 shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-indigo-500 dark:border-jovieDark-border dark:bg-jovieDark-800 dark:text-jovieDark-200 sm:text-sm"
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
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
          <div v-if="loader" class="transition-all"><JovieSpinner /></div>
          <div v-else>
            <div v-if="valid">
              <CheckCircleIcon
                class="pointer-events-none h-5 w-5 text-indigo-500 dark:text-indigo-300"
                aria-hidden="true" />
            </div>
            <div v-if="isInvalid">
              <ExclamationCircleIcon
                class="pointer-events-none h-5 w-5 text-red-500 dark:text-red-300"
                aria-hidden="true" />
            </div>
            <div
              class="cursor-pointer"
              v-if="passwordRevealToggle"
              @click="togglePasswordReveal"
              :class="{ 'pl-1': rounded == 'sm' }">
              <EyeIcon
                v-if="passwordReveal"
                class="z-10 h-5 w-5 cursor-pointer text-slate-400 hover:text-slate-600 dark:text-jovieDark-200 hover:dark:text-jovieDark-100"
                :class="{ 'h-3 w-3': rounded == 'sm' }" />
              <EyeSlashIcon
                v-else
                class="z-10 h-5 w-5 cursor-pointer text-slate-400 hover:text-slate-600 dark:text-jovieDark-200 hover:dark:text-jovieDark-100"
                :class="{ 'h-3 w-3': rounded == 'sm' }" />
            </div>
          </div>
        </div>
        <label
          v-if="label"
          :for="name"
          :id="id"
          class="absolute -top-2.5 left-0 ml-3 block cursor-text bg-white px-1 text-xs font-medium text-slate-500 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-medium peer-placeholder-shown:text-slate-400 peer-focus:left-0 peer-focus:-top-2.5 peer-focus:text-xs peer-focus:font-medium dark:bg-jovieDark-800 dark:text-jovieDark-300"
          >{{ label }}</label
        >
      </div>
      <div v-if="error" class="mt-2 text-xs text-red-600 dark:text-red-300">
        {{ error }}
      </div>
    </div>
  </div>
</template>

<script>
import {
  MagnifyingGlassIcon,
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
  CheckCircleIcon,
  EyeIcon,
  EyeSlashIcon,
} from '@heroicons/vue/24/solid';
import JovieSpinner from '../components/JovieSpinner.vue';
import SocialIcons from '../components/SocialIcons.vue';

export default {
  name: 'InputGroup',
  data() {
    return {
      passwordReveal: false,
    };
  },
  methods: {
    togglePasswordReveal() {
      this.passwordReveal = !this.passwordReveal;
    },
    focusInput() {
      //next tick focus input
      this.$nextTick(() => {
        this.$refs.input.focus();
      });
    },
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
    passwordRevealToggle: {
      type: Boolean,
      default: false,
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
    autocomplete: {
      type: String,
      default: 'off',
    },
    isInvalid: {
      type: Boolean,
      default: false,
    },
    loader: {
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
    socialicon: {
      type: String,
      default: 'twitter',
    },
  },
  components: {
    EnvelopeIcon,
    MagnifyingGlassIcon,
    PhotoIcon,
    MapPinIcon,
    ArrowTrendingUpIcon,
    ArrowTrendingDownIcon,
    TagIcon,
    UserIcon,
    CheckCircleIcon,
    UsersIcon,
    ExclamationCircleIcon,
    ArrowSmallUpIcon,
    ArrowSmallDownIcon,
    BriefcaseIcon,
    SocialIcons,
    JovieSpinner,
    EyeIcon,
    EyeSlashIcon,
  },
};
</script>
