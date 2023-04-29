<template>
  <div class="flex w-full items-center">
    <div class="h-10 items-center px-4" v-if="!loading">
      <h1
        class="flex items-center text-sm font-semibold capitalize text-slate-900 dark:text-jovieDark-100">
        <template v-if="list">
          <UserListEditable
            :loading="taskLoading"
            :list="list"
            @updateUserList="$emit('updateUserList', $event)" />
        </template>
        <template v-else>
          <JovieSpinner spinnerSize="xs" class="mr-1" v-if="taskLoading" />
          <component
            v-else
            :is="icon"
            :class="iconColor"
            class="mr-1 h-4 w-4 rounded-md text-purple-400"
            aria-hidden="true" />

          {{ headerText + ' Contacts' }}
        </template>
      </h1>
      <p v-if="!taskLoading" class="text-2xs font-light text-slate-600">
        {{ contactCount + ' Contacts' }}
      </p>
      <!--      <p v-else class="h-3 w-20 animate-pulse rounded-sm bg-slate-300"></p>-->
    </div>
  </div>
</template>
<script>
import {
  UserGroupIcon,
  HeartIcon,
  UserIcon,
  ArchiveBoxIcon,
} from '@heroicons/vue/24/solid';
import JovieSpinner from './JovieSpinner.vue';
import UserListEditable from './Crm/UserListEditable.vue';

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
    taskLoading: {
      type: Boolean,
      default: false,
    },
    list: {
      type: Object,
      required: false,
    },
  },
  components: {
    UserListEditable,
    UserGroupIcon,
    HeartIcon,
    UserIcon,
    ArchiveBoxIcon,
    JovieSpinner,
  },
  computed: {
    icon() {
      if (this.header.includes('all')) {
        return UserGroupIcon;
      } else if (this.header.includes('favourites')) {
        return HeartIcon;
      } else if (this.header.includes('archived')) {
        return ArchiveBoxIcon;
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
        return `${this.subheader.total}`;
      } else if (this.list) {
        return `${this.subheader[`list_${this.list.id}`]}`;
      } else {
        console.log('this.subheader[this.header]');
        console.log(this.subheader[this.header]);
        return this.subheader[this.header] ?? '';
      }
    },
    headerText() {
      if (this.header.includes('favourites')) {
        return 'Favorited';
      } else {
        return this.header ?? '';
      }
    },
  },
};
</script>
