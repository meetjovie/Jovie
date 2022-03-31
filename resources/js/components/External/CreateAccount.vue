<template>
  <div>
    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
      {{ text }}
    </h2>
    <slot>
      <p class="mt-2 text-sm text-gray-600">
        Or if you already have an account
        {{ ' ' }}
        <router-link
          to="Login"
          class="font-medium text-indigo-600 hover:text-indigo-500">
          login
        </router-link>
      </p>
      <ul v-if="error" class="mt-2 text-sm text-red-900">
        <li>{{ error }}</li>
      </ul>
    </slot>
  </div>
</template>
<script>
export default {
  props: {
    text: {
      type: String,
      default: 'Create an account',
    },
  },
};
</script>
