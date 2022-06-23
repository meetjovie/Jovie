<template>
  <div>
    <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-gray-100">
      {{ text }}
    </h2>

    <p class="text-sm text-gray-600 dark:text-gray-400">
      Or if you already have an account
      {{ ' ' }}
      <router-link
        to="Login"
        class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
        login
      </router-link>
    </p>
    <ul v-if="error" class="mt-2 text-sm text-red-900 dark:text-red-200">
      <li>{{ error }}</li>
    </ul>
  </div>
</template>
<script>
export default {
  props: {
    text: {
      type: String,
      default: 'Create an account',
    },
    subtext: {
      type: String,
      default: '',
    },
  },
};
</script>
