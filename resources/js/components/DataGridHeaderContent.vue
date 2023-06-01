<template>
  <div class="flex w-full items-center">
    <div class="flex h-10 items-center justify-between px-4">
      <div v-if="!list" class="w-8 items-center">
        <JovieSpinner spinnerSize="xs" class="" v-if="taskLoading" />
        <component
          v-else
          :is="icon"
          :class="iconColor"
          class="h-4 w-4 items-center rounded-md text-purple-400"
          aria-hidden="true" />
      </div>
      <h1
        class="flex h-full items-center text-xs font-semibold capitalize text-slate-900 dark:text-jovieDark-100">
        <div v-if="list">
          <UserListEditable
            :loading="taskLoading"
            :list="list"
            @updateUserList="$emit('updateUserList', $event)" />
        </div>
        <div class="flex" v-else>
          {{ headerText === 'birthdays' ? headerText : headerText }}

          <!--   <span class="items-center text-sm font-semibold" v-if="!taskLoading">
            {{ contactCount + ' contacts' }}</span
          >
          <span
            class="items-center rounded bg-slate-300 text-xs font-semibold dark:bg-jovieDark-700"
            v-else></span> -->
        </div>
      </h1>
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
