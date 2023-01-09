<template>
  <div class="absolute right-0 bottom-0 items-center py-4 px-4">
    <ul class="inline-flex items-center gap-x-2">
      <router-link
        to="/api"
        class="text-2xs font-bold text-slate-400 hover:text-slate-500 active:text-indigo-500">
        API
      </router-link>
      <router-link
        to="/privacy"
        class="text-2xs font-bold text-slate-400 hover:text-slate-500 active:text-indigo-500">
        Legal
      </router-link>
      <router-link
        to="/status"
        class="text-2xs font-bold text-slate-400 hover:text-slate-500 active:text-indigo-500">
        Status
      </router-link>
      <DarkModeToggle placement="left-end" />
    </ul>
  </div>
</template>
<script>
import DarkModeToggle from '../../components/DarkModeToggle.vue';
export default {
  name: 'AuthFooter',
  components: {
    DarkModeToggle,
  },
};
</script>
