<template>
  <div
    class="divide-y divide-slate-200 overflow-hidden rounded-lg bg-gray-200 shadow dark:divide-jovieDark-border dark:bg-jovieDark-800 sm:grid sm:grid-cols-2 sm:gap-px sm:divide-y-0">
    <div
      v-for="(action, actionIdx) in actions"
      :key="action.name"
      @click="actionSelected(action)"
      :class="[
        actionIdx === 0 ? 'rounded-tl-lg rounded-tr-lg sm:rounded-tr-none' : '',
        actionIdx === 1 ? 'sm:rounded-tr-lg' : '',
        actionIdx === actions.length - 2 ? 'sm:rounded-bl-lg' : '',
        actionIdx === actions.length - 1
          ? 'rounded-bl-lg rounded-br-lg sm:rounded-bl-none'
          : '',
        'group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 dark:bg-jovieDark-900',
      ]">
      <div>
        <span class="inline-flex rounded-lg p-3 text-xl ring-4 ring-white">
          {{ action.icon }}
        </span>
      </div>
      <div class="mt-8">
        <h3
          class="text-base font-semibold leading-6 text-gray-900 dark:text-jovieDark-100">
          <a :href="action.href" class="focus:outline-none">
            <!-- Extend touch target to entire panel -->
            <span class="absolute inset-0" aria-hidden="true" />
            {{ action.name }}
          </a>
        </h3>
        <p class="mt-2 text-sm text-gray-500">
          {{ action.description }}
        </p>
      </div>
      <span
        class="pointer-events-none absolute right-6 top-6 text-slate-300 group-hover:text-gray-400 dark:text-jovieDark-700 dark:group-hover:text-jovieDark-600"
        aria-hidden="true">
        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path
            d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z" />
        </svg>
      </span>
    </div>
  </div>
</template>

<script>
import {
  AcademicCapIcon,
  BanknotesIcon,
  CheckBadgeIcon,
  ClockIcon,
  ReceiptRefundIcon,
  UsersIcon,
} from '@heroicons/vue/24/outline';

export default {
  name: 'ActionListGrid',
  props: {
    actions: {
      type: Array,
      default: [
        {
          title: 'Sales Pipline',
          description: 'Keep track of your leads and opportunities.',

          emoji: '👋',
          icon: ClockIcon,
          iconForeground: 'text-teal-700',
          iconBackground: 'bg-teal-50',
        },
        {
          title: 'Influencer Marketing Campaign',
          description: 'Find and hire influencers for your next campaign.',
          emoji: '📣',
          href: '#',
          icon: CheckBadgeIcon,
          iconForeground: 'text-purple-700',
          iconBackground: 'bg-purple-50',
        },
        {
          title: 'Personal CRM',
          description: 'Keep track of your friends and family.',
          emoji: '👨‍💼',
          href: '#',
          icon: UsersIcon,
          iconForeground: 'text-sky-700',
          iconBackground: 'bg-sky-50',
        },
        {
          title: 'Startup Fundraising',
          description: 'Manage your seed round fundraising.',
          emoji: '📈',
          href: '#',
          icon: BanknotesIcon,
          iconForeground: 'text-yellow-700',
          iconBackground: 'bg-yellow-50',
        },
      ],
    },
  },
  data() {
    return {
      selectedAction: null,
    };
  },
  methods: {
    actionSelected(action) {
      this.selectedAction = action.id;
      this.$emit('selected', this.selectedAction);
    },
  },
};
</script>
