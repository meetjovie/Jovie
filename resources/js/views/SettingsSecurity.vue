<template>
  <div>
    <SectionHeader
      header="Security"
      subheader="Adjust your security settings" />
    <SectionWrapper
      v-if="!currentUser.google_id"
      header="Password"
      subheader="Edit your password">
      <AccountPassword />
    </SectionWrapper>
  </div>
</template>
<script>
import SectionWrapper from './../components/SectionWrapper.vue';
import SectionHeader from './../components/SectionHeader.vue';
import AccountPassword from './../components/Account/AccountPassword.vue';

export default {
  name: 'SettingsSecurity',
  components: {
    SectionHeader,
    SectionWrapper,
    AccountPassword,
  },
};
</script>
