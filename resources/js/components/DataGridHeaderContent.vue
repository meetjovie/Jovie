<template>
  <div class="h-10 w-full items-center px-4">
    <h1
      v-if="!loading"
      class="flex items-center text-sm font-semibold capitalize text-slate-900 dark:text-jovieDark-100">
      <component
        :is="icon"
        :class="iconColor"
        class="mr-1 h-4 w-4 rounded-md text-purple-400"
        aria-hidden="true" />
      {{ headerText + ' Contacts' }}
    </h1>
    <h1 v-else class="mr-2 h-4 w-60 animate-pulse rounded-sm bg-slate-300"></h1>
    <p v-if="!loading" class="text-2xs font-light text-slate-600">
      {{ contactCount }}
    </p>
    <p v-else class="h-3 w-20 animate-pulse rounded-sm bg-slate-300"></p>
  </div>
</template>
<script>
import { UserGroupIcon, HeartIcon, UserIcon } from '@heroicons/vue/24/solid';

export default {
  props: {
    header: {
      type: String,
      required: true,
    },
    subheader: {
      type: Object,
      required: true,
    },
    loading: {
      type: Boolean,
      default: false,
    },
  },
  components: {
    UserGroupIcon,
    HeartIcon,
    UserIcon,
  },
  computed: {
    icon() {
      if (this.header.includes('all')) {
        return UserGroupIcon;
      } else if (this.header.includes('favourites')) {
        return HeartIcon;
      } else {
        return UserIcon;
      }
    },
    iconColor() {
      if (this.header.includes('favourites')) {
        return 'text-red-400';
      } else if (this.header.includes('archive')) {
        return 'text-blue-400';
      } else {
        return 'text-purple-400';
      }
    },
    contactCount() {
      if (this.header.includes('all')) {
        return `${this.subheader.total} Contacts`;
      } else {
        return `${this.subheader[this.header]} Contacts`;
      }
    },
    headerText() {
      if (this.header.includes('favourites')) {
        return 'Favorited';
      } else {
        return this.header;
      }
    },
  },
};
</script>
