<template>
  <div id="app">
    <router-view />
    <div class="flex min-h-screen flex-col">Loading...</div>
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
