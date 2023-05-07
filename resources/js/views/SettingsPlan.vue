<template>
  <div>
    <SectionHeader header="Plan" subheader="Change or modify your plan" />
    <img
      class="h-8 w-auto"
      src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
      alt="Your Company" />
  </div>
</template>
<script>
import SectionHeader from './../components/SectionHeader.vue';
export default {
  name: 'SettingsPlan',
  components: {
    SectionHeader,
  },
};
</script>
