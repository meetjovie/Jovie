<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="mx-auto max-w-lg">
    <ul
      role="list"
      class="mt-6 divide-y divide-gray-200 border-t border-b border-gray-200">
      <li v-for="(item, itemIdx) in items" :key="itemIdx">
        <div class="group relative flex items-start space-x-3 py-4">
          <div class="flex-shrink-0">
            <span
              :class="[
                item.iconColor,
                'inline-flex h-10 w-10 items-center justify-center rounded-lg',
              ]">
              <component
                :is="item.icon"
                class="h-6 w-6 text-white"
                aria-hidden="true" />
            </span>
          </div>
          <div class="min-w-0 flex-1">
            <div class="text-sm font-medium text-gray-900">
              <a :href="item.href">
                <span class="absolute inset-0" aria-hidden="true" />
                {{ item.name }}
              </a>
            </div>
            <p class="text-sm text-gray-500">{{ item.description }}</p>
          </div>
          <div class="flex-shrink-0 self-center">
            <ChevronRightIcon
              class="h-5 w-5 text-gray-400 group-hover:text-gray-500"
              aria-hidden="true" />
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { CloudArrowDownIcon, ChevronRightIcon } from '@heroicons/vue/24/solid';
import { CloudArrowUpIcon } from '@heroicons/vue/24/outline';

const items = [
  {
    name: 'Bulk Upload Contacts',
    description: 'Upload a CSV File to Jovie.',
    href: '/import',
    iconColor: 'bg-purple-500',
    icon: CloudArrowUpIcon,
  },
  {
    name: 'Download Jovie Chrome Extension',
    description:
      'Save contacts without leaving social media & see enriched contact details inside Gmail.',
    href: '/chrome-extension',
    iconColor: 'bg-pink-500',
    icon: CloudArrowDownIcon,
  },
];
</script>
