<template>
  <div>
    <SectionHeader header="Preferences" />
    <SectionWrapper
      header="Calender Events"
      subheader="Set default settings for new calender events">
      Default Calender Description Text go here
    </SectionWrapper>
  </div>
</template>
<script>
import SectionHeader from '../components/SectionHeader.vue';
import SectionWrapper from '../components/SectionWrapper.vue';
export default {
  components: {
    SectionHeader,
    SectionWrapper,
  },
};
</script>
