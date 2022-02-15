<template>
  <div class="absolute right-0 bottom-0 py-4 px-4">
    <ul class="inline-flex gap-x-2">
      <router-link
        to="/privacy"
        class="text-2xs font-bold text-neutral-400 hover:text-neutral-500 active:text-indigo-500">
        Legal
      </router-link>
      <router-link
        to="/status"
        class="text-2xs font-bold text-neutral-400 hover:text-neutral-500 active:text-indigo-500">
        Status
      </router-link>
    </ul>
  </div>
</template>
<script>
export default {
  name: 'AuthFooter',
};
</script>
