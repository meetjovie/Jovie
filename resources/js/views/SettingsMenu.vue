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
          path: '/workspace',
        },
        { name: 'Plan', icon: 'plan', path: '/plan' },
        {
          name: 'Billing',
          icon: 'billing',
          path: '/billing',
        },
        {
          name: 'Profile',
          icon: 'profile',
          path: '/profile',
        },
        {
          name: 'Security',
          icon: 'security',
          path: '/security',
        },
      ],
    };
  },
};
</script>
