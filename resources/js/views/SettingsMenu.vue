<template>
  <div class="space-y-4 px-4">
    <div v-for="item in userMenuItems" :key="item.id">
      <!-- Other parent component content -->
      <div
        :class="[
          active
            ? 'bg-slate-100 dark:bg-jovieDark-500 dark:text-jovieDark-200'
            : 'text-slate-900 dark:text-jovieDark-100',
          'group flex w-full items-center rounded px-2 py-1 text-xs capitalize',
        ]">
        <component
          :is="item.icon"
          class="mr-2 h-3 w-3 text-slate-400 dark:text-jovieDark-400"
          aria-hidden="true" />
        {{ item.name }}
      </div>
      <SidebarNavMenu :items="item.items" />
    </div>
  </div>
</template>
<style>
active {
  @apply text-white;
}
</style>

<script>
import SidebarNavMenu from '../components/SidebarNavMenu.vue';
import JovieMenuItem from '../components/JovieMenuItem.vue';
import { UserIcon, UserGroupIcon } from '@heroicons/vue/24/solid';
export default {
  components: {
    SidebarNavMenu,
    JovieMenuItem,
    UserIcon,
    UserGroupIcon,
  },

  data() {
    return {
      userMenuItems: {
        workspace: {
          id: '2',
          name: 'workspace',
          icon: 'UserGroupIcon',
          items: [
            {
              name: 'General',
              icon: 'SparklesIcon',
              component: 'SettingsWorkspace',
            },
            { name: 'Plan', icon: 'CreditCardIcon', component: 'SettingsPlan' },
          ],
        },
        account: {
          id: '1',
          name: 'account',
          icon: 'UserIcon',
          items: [
            {
              name: 'Security',
              icon: 'LockClosedIcon',
              component: 'SettingsSecurity',
            },
            {
              name: 'Profile',
              icon: 'UserIcon',
              component: 'SettingsProfile',
            },
          ],
        },
      },
    };
  },
};
</script>
