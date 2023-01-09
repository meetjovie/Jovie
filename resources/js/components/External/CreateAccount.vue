<template>
  <div>
    <h2
      class="mt-6 text-center text-xl font-semibold text-slate-900 dark:text-jovieDark-100">
      {{ text }}
    </h2>

    <!-- <p class="text-center text-2xs text-slate-600 dark:text-jovieDark-400">
      Or if you already have an account
      {{ ' ' }}
      <router-link
        to="Login"
        class="text-center font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-300 dark:hover:text-indigo-400">
        login
      </router-link>
    </p> -->
    <ul v-if="error" class="mt-2 text-sm text-red-900 dark:text-red-100">
      <li>{{ error }}</li>
    </ul>
  </div>
</template>
<script>
export default {
  props: {
    text: {
      type: String,
      default: 'Create a Jovie account',
    },
    subtext: {
      type: String,
      default: '',
    },
  },
};
</script>
