<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Popover class="relative" v-slot="{ open }">
    <PopoverButton
    @click="getImportBatches()"
      :class="[
        open ? 'text-slate-900' : 'text-slate-500',
        'group inline-flex items-center rounded-md bg-white text-base font-medium hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2',
      ]">
     <span class="sr-only">Open import notification</span>
                    <BellIcon
                      class="h-5 w-5 flex-shrink-0"
                      aria-hidden="true" />
    </PopoverButton>

    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 translate-y-1"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 translate-y-1">
      <PopoverPanel
        class="absolute left-1/2 z-10 mt-3 w-screen max-w-md -translate-x-1/2 transform px-2 sm:px-0">
        <div
          class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
          <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">


                              </p>

                              <p
                                class="text-xs font-medium text-slate-500 group-hover:text-slate-700">
                            
                              </p>
                              <p
                                class="text-xs font-medium text-slate-500 group-hover:text-slate-700">
                              

            <a
            v-for="batch in batches"
              :key="batch.id"
              
              class="-m-3 flex items-start rounded-lg p-3 transition duration-150 ease-in-out hover:bg-slate-50">
              <component
                :is="item.icon"
                class="h-6 w-6 flex-shrink-0 text-indigo-600"
                aria-hidden="true" />
              <div class="ml-4">
                <p class="text-base font-medium text-slate-900">
                  {{ batch.name }}
                </p>
                <p class="mt-1 text-sm text-slate-500">
                     total: {{ batch.initial_total_in_file }}
                </p>
                  progress: {{ batch.progress }} %
              </div>
            </a>
          </div>
          <div class="bg-slate-50 px-5 py-5 sm:px-8 sm:py-8">
            <div>
              <h3
                class="text-sm font-medium uppercase tracking-wide text-slate-500">
                Recent Posts
              </h3>
              <ul role="list" class="mt-4 space-y-4">
                <li
                  v-for="post in recentPosts"
                  :key="post.id"
                  class="truncate text-base">
                  <a
                    :href="post.href"
                    class="font-medium text-slate-900 transition duration-150 ease-in-out hover:text-slate-700">
                    {{ post.name }}
                  </a>
                </li>
              </ul>
            </div>
            <div class="mt-5 text-sm">
              <a
                href="#"
                class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500">
                View all notifications <span aria-hidden="true">&rarr;</span></a
              >
            </div>
          </div>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
</template>

<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import { ChevronDownIcon } from '@heroicons/vue/24/solid';
import {
  BookmarkSquareIcon,
  CalendarIcon,
  ShieldCheckIcon,
  LifebuoyIcon,
} from '@heroicons/vue/24/outline';



const resources = [
  {
    name: 'Help Center',
    description:
      'Get all of your questions answered in our forums or contact support.',
    href: '#',
    icon: LifebuoyIcon,
  },
  {
    name: 'Guides',
    description:
      'Learn how to maximize our platform to get the most out of it.',
    href: '#',
    icon: BookmarkSquareIcon,
  },
  {
    name: 'Events',
    description:
      'See what meet-ups and other events we might be planning near you.',
    href: '#',
    icon: CalendarIcon,
  },
  {
    name: 'Security',
    description: 'Understand how we take your privacy seriously.',
    href: '#',
    icon: ShieldCheckIcon,
  },
];
const recentPosts = [
  { id: 1, name: 'Boost your conversion rate', href: '#' },
  {
    id: 2,
    name: 'How to use search engine optimization to drive traffic to your site',
    href: '#',
  },
  { id: 3, name: 'Improve your customer experience', href: '#' },
];

export default {
    props: {
       
            batches: {
                type: Array,
                required: true,
            },
            
        },
}

</script>
