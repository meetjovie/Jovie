<template>
  <SectionHeader header="Profile" subheader="Edit your user profile" />
  <SectionWrapper header="Profile" subheader="Edit your profile">
    <AccountProfile />
  </SectionWrapper>
</template>
<script>
import SectionHeader from './../components/SectionHeader.vue';
import SectionWrapper from './../components/SectionWrapper.vue';
export default {
  name: 'SettingsProfile',
  components: {
    SectionHeader,
    SectionWrapper,
  },
};
</script>
