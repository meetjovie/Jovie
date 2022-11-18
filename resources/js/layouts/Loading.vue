<template>
  <div class="h-screen items-center" id="app">
    <router-view />
    <div class="mt-16 flex h-80 flex-col items-center text-center">
      <JovieSpinner />
    </div>
  </div>
</template>

<script>
import JovieSpinner from './../components/JovieSpinner.vue';
export default {
  name: 'Loading',
  components: {
    JovieSpinner,
  },
  mounted() {
    console.log('mounted');
  },
};
</script>
<style>
/* your style */
</style>
