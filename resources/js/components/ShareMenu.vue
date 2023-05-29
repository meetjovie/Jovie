<template>
  <div>
    <JovieDropdownMenu
      :searchable="false"
      :items="contacts"
      placement="bottom-start">
      <template #triggerButton>
        <ContactAvatarCluster :contacts="contacts" />
      </template>
    </JovieDropdownMenu>
  </div>
</template>
<script>
import ContactAvatarCluster from './ContactAvatarCluster.vue';
import JovieDropdownMenu from './JovieDropdownMenu.vue';
export default {
  props: {
    contacts: Array,
  },
  components: {
    ContactAvatarCluster,
    JovieDropdownMenu,
  },
};
</script>
