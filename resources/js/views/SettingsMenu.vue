<template>
  <div>
    <!-- Other parent component content -->

    <!-- Reference the SidebarNavMenu component and pass the items prop -->
    <SidebarNavMenu :items="menuItems" />
  </div>
</template>

<script>
import SidebarNavMenu from '../components/SidebarNavMenu.vue';

export default {
  components: {
    SidebarNavMenu,
  },
  data() {
    return {
      menuItems: [
        {
          name: 'Workspace',
          icon: 'workspace',
          component: 'SettingsWorkspace',
        },
        { name: 'Plan', icon: 'plan', component: 'SettingsPlan' },
        {
          name: 'Profile',
          icon: 'profile',
          component: 'SettingsProfile',
        },
        {
          name: 'Security',
          icon: 'security',
          component: 'SettingsSecurity',
        },
      ],
    };
  },
};
</script>
