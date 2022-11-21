<template>
  <div class="h-screen items-center" id="app">
    <router-view />
    <div class="flex h-screen items-center text-center">
      <div class="mx-auto">
        <JovieSpinner />
      </div>
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
