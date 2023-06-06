<template>
  <div
    @contextmenu.prevent="handleContextMenu($event, contact)"
    class="h-36 divide-y divide-gray-200 overflow-hidden rounded border border-slate-200 bg-white shadow hover:bg-slate-50 dark:border-jovieDark-border dark:bg-jovieDark-800">
    <div
      @click="$emit('openSidebar', { contact: contact })"
      class="flex w-full items-center justify-between">
      <ContactAvatar class="-left-4 -top-6" :height="20" :contact="contact" />
      <div class="flex-1 truncate">
        <div class="flex w-full items-start justify-between py-2">
          <h3
            class="line-clamp-1 truncate text-sm font-medium text-slate-900 dark:text-jovieDark-100">
            {{ contact.full_name || 'First Last' }}
            <p
              class="mt-1 line-clamp-1 truncate text-2xs text-slate-500 dark:text-jovieDark-300">
              {{ contact.job_title || 'Job Title' }}
            </p>
          </h3>
          <div class="flex">
            <div
              class="hidden w-8 cursor-pointer items-center px-2 text-slate-400 dark:text-jovieDark-400 lg:block"
              @click="
                $emit('updateContact', {
                  id: contact.id,
                  key: `favourite`,
                  value: !contact.favourite,
                })
              ">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                :class="{
                  'fill-red-500 text-red-500': contact.favourite,
                }"
                class="-mt-.5 h-4 w-4 hover:fill-red-500 hover:text-red-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
            </div>
            <button
              ref="contextMenuButton"
              @click="handleMenuButton($event, contact)"
              class="flex items-center rounded-full text-slate-400 transition-all hover:text-slate-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-100 active:bg-slate-200 group-hover:text-slate-400 dark:hover:text-slate-400 dark:active:bg-slate-800 dark:group-hover:text-slate-600">
              <span class="sr-only">Open options</span>
              <EllipsisVerticalIcon
                class="z-0 h-4 w-4 active:scale-95"
                aria-hidden="true" />
            </button>
          </div>
        </div>
        <span
          class="inline-flex flex-shrink-0 items-center rounded-full bg-purple-50 px-1.5 py-0.5 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-600/20"
          >{{ contact.emails[0] || 'Tag' }}</span
        >

        <DataGridSocialLinksCell :contact="contact.id" />
      </div>
    </div>

    <div class="-mt-px flex divide-x divide-slate-200">
      <div class="flex w-0 flex-1">
        <a
          :href="`mailto:${contact.emails[0]}`"
          class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent text-xs font-semibold text-slate-900 dark:text-jovieDark-100">
          <EnvelopeIcon
            class="h-5 w-5 text-slate-400 dark:text-jovieDark-200"
            aria-hidden="true" />
          Email
        </a>
      </div>
      <div class="-ml-px flex w-0 flex-1">
        <a
          :href="`tel:${contact.telephone}`"
          class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent text-xs font-semibold text-slate-900 dark:text-jovieDark-100">
          <PhoneIcon
            class="h-5 w-5 text-slate-400 dark:text-jovieDark-200"
            aria-hidden="true" />
          Call
        </a>
      </div>
    </div>
  </div>
</template>
<script>
import ContactAvatar from './ContactAvatar.vue';
import DataGridSocialLinksCell from './DataGridSocialLinksCell.vue';
import ContactContextMenu from './ContactContextMenu.vue';
import {
  EnvelopeIcon,
  PhoneIcon,
  EllipsisVerticalIcon,
} from '@heroicons/vue/24/outline';
export default {
  components: {
    ContactAvatar,
    DataGridSocialLinksCell,
    ContactContextMenu,
    EnvelopeIcon,
    PhoneIcon,
    EllipsisVerticalIcon,
  },

  methods: {
    handleMenuButton(event, contact) {
      event.preventDefault(); // Prevents the default context menu from showing up
      const coordinates = {
        x: event.pageX, // Extract the x-coordinate from the event
        y: event.pageY, // Extract the y-coordinate from the event
      };

      console.log('context menu clicked ' + contact.full_name);
      this.$emit('contextMenuButtonClicked', contact, coordinates);
    },
    handleContextMenu(event, contact) {
      event.preventDefault(); // Prevents the default context menu from showing up
      const coordinates = {
        x: event.pageX, // Extract the x-coordinate from the event
        y: event.pageY, // Extract the y-coordinate from the event
      };

      console.log('context menu clicked ' + contact.full_name);
      this.$emit('contextMenuClicked', contact, coordinates);
    },
  },
  props: {
    contact: {
      type: Object,
      required: true,
    },
  },
};
</script>
