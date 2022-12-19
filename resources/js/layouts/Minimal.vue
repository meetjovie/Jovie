<template>
  <div class="" id="app">
    <router-view />
  </div>
</template>

<script>
export default {
  name: 'Minimal',
  mounted() {
    console.log('mounted');
    if (
      localStorage.theme === 'dark' ||
      (!('theme' in localStorage) &&
        window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  },
};
</script>
<style>
/* your style */
</style>
