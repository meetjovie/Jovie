<template>
  <RadioGroup v-model="selectedItems">
    <RadioGroupLabel
      v-if="label"
      class="text-base font-medium text-slate-900 dark:text-jovieDark-100"
      >{{ label }}</RadioGroupLabel
    >

    <div
      class="mx-auto mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
      <RadioGroupOption
        as="template"
        v-for="item in items"
        :key="item.id"
        :value="item"
        v-slot="{ checked, active }">
        <div
          :class="[
            checked
              ? 'border-transparent'
              : 'border-gray-300 dark:border-jovieDark-border',
            active ? 'border-jovieDark-border ring-2 ring-indigo-500' : '',
            'relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none dark:bg-jovieDark-800',
          ]">
          <span class="flex flex-1">
            <span class="flex flex-col">
              <component
                :is="item.icon"
                class="h-6 w-6 text-gray-400 dark:text-jovieDark-200" />
              <RadioGroupLabel
                as="span"
                class="block text-sm font-medium text-slate-900 dark:text-jovieDark-100"
                >{{ item.title }}</RadioGroupLabel
              >
              <RadioGroupDescription
                as="span"
                class="mt-1 flex items-center text-sm text-slate-500 dark:text-jovieDark-400"
                >{{ item.description }}</RadioGroupDescription
              >
              <RadioGroupDescription
                as="span"
                class="mt-6 text-sm font-medium text-slate-900 dark:text-jovieDark-100"
                >{{ item.cta }}</RadioGroupDescription
              >
            </span>
          </span>
          <CheckCircleIcon
            :class="[!checked ? 'invisible' : '', 'h-5 w-5 text-indigo-600']"
            aria-hidden="true" />
          <span
            :class="[
              active ? 'border' : 'border-2',
              checked ? 'border-indigo-500' : 'border-transparent',
              'pointer-events-none absolute -inset-px rounded-lg',
            ]"
            aria-hidden="true" />
        </div>
      </RadioGroupOption>
    </div>
  </RadioGroup>
</template>

<script setup>
import { ref } from 'vue';

import {
  RadioGroup,
  RadioGroupDescription,
  RadioGroupLabel,
  RadioGroupOption,
} from '@headlessui/vue';
import { CheckCircleIcon, UserIcon, UsersIcon } from '@heroicons/vue/20/solid';
const items = [
  {
    id: 1,
    title: 'With my team',
    description: 'Collaborate with your team on a shared workspace.',
    cta: 'Try free',
    icon: 'UsersIcon',
  },
  {
    id: 2,
    title: 'For myself',
    icon: 'UserIcon',
    description: 'Use Jovie for yourself and your personal projects.',
  },
];

const selectedItems = ref(items[0]);
</script>
