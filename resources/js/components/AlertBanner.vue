<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div>
    <div
      v-if="!dismissed && !sidebar"
      class="relative"
      :class="[
        { 'bg-indigo-500': design == 'primary' },
        { 'bg-red-500 ': design == 'danger' },
      ]">
      <div class="mx-auto max-w-7xl py-3 px-3 text-center sm:px-6 lg:px-8">
        <div class="inline-flex pr-16 sm:px-16 sm:text-center">
          <p class="text-sm font-medium text-white">
            <span class="md:hidden"> {{ mobiletitle }} </span>
            <span class="hidden md:inline">
              {{ title }}
            </span>
            <span v-if="cta" class="block sm:ml-2 sm:inline-block">
              <router-link
                :to="{ name: ctaLink }"
                class="cursor-pointer font-bold text-white underline">
                {{ cta }}<span aria-hidden="true">&rarr;</span>
              </router-link>
            </span>
          </p>
          <slot></slot>
        </div>

        <div
          v-if="dismissable"
          class="absolute inset-y-0 right-0 flex items-start pt-1 pr-1 sm:items-start sm:pt-1 sm:pr-2">
          <button
            @click="dismissed = true"
            type="button"
            class="group flex rounded-md p-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white">
            <span class="sr-only">Dismiss</span>
            <XMarkIcon
              class="active:text-neutal-100 h-6 w-6 rounded-full p-1 font-medium text-slate-50 transition duration-300 ease-in-out active:bg-slate-100/30 active:text-slate-400 group-hover:font-bold group-hover:text-white"
              aria-hidden="true" />
          </button>
        </div>
      </div>
    </div>
    <div v-if="sidebar && !dismissed" class="relative px-2">
      <router-link
        :to="ctaLink"
        class="flex flex-col rounded-lg border border-slate-300 px-2 py-2 dark:border-jovieDark-border">
        <span
          class="text-xs font-semibold text-slate-700 dark:text-jovieDark-200"
          >{{ title }}</span
        >
        <span
          class="text-2xs font-medium text-slate-600 dark:text-jovieDark-400"
          >{{ subtitle }}</span
        >

        <ButtonGroup
          class="group/button z-20 mt-4 w-full cursor-pointer rounded-lg bg-gradient-to-r from-indigo-500 to-purple-500 px-2 py-2 text-white"
          :text="cta">
          <svg
            role="img"
            class="ml-2 h-5 w-5 transform transition-transform duration-300 ease-in-out group-hover/button:rotate-180"
            fill="white"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <title>Google Chrome</title>
            <path
              d="M12 0C8.21 0 4.831 1.757 2.632 4.501l3.953 6.848A5.454 5.454 0 0 1 12 6.545h10.691A12 12 0 0 0 12 0zM1.931 5.47A11.943 11.943 0 0 0 0 12c0 6.012 4.42 10.991 10.189 11.864l3.953-6.847a5.45 5.45 0 0 1-6.865-2.29zm13.342 2.166a5.446 5.446 0 0 1 1.45 7.09l.002.001h-.002l-5.344 9.257c.206.01.413.016.621.016 6.627 0 12-5.373 12-12 0-1.54-.29-3.011-.818-4.364zM12 16.364a4.364 4.364 0 1 1 0-8.728 4.364 4.364 0 0 1 0 8.728Z" />
          </svg>
        </ButtonGroup>
      </router-link>
    </div>
  </div>
</template>

<script>
import { XMarkIcon } from '@heroicons/vue/24/outline';
import ButtonGroup from './../components/ButtonGroup.vue';

export default {
  data() {
    return {};
  },
  components: {
    XMarkIcon,
    ButtonGroup,
  },
  props: {
    design: {
      type: String,
      default: 'primary',
    },
    title: {
      type: String,
      default: '',
    },
    subtitle: {
      type: String,
      default: '',
    },
    mobiletitle: {
      type: String,
      default: '',
    },
    cta: {
      type: String,
      default: '',
    },
    ctaLink: {
      type: String,
      default: '',
    },
    dismissable: {
      type: Boolean,
      default: true,
    },
    dismissed: {
      type: Boolean,
      default: false,
    },
    sidebar: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
