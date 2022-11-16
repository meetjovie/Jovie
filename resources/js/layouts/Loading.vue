<template>
  <div id="app">
    <router-view />

    Loading...
  </div>
</template>

<script>
import JovieSpinner from '../components/JovieSpinner.vue';
export default {
  name: 'Loading',

  mounted() {
    console.log('mounted');
  },
};
</script>
<style>
/* your style */
</style>
