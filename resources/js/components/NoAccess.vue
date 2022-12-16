<template>
  <main
    class="mx-auto flex h-screen w-full flex-grow flex-col items-center justify-center px-4 dark:bg-gray-800 dark:text-gray-300 sm:px-6 lg:px-8">
    <div class="max-w-7xl items-center dark:bg-gray-800">
      <div class="text-center">
        <p
          class="text-sm font-semibold uppercase tracking-wide text-indigo-600 dark:text-indigo-300">
          {{ title }}
        </p>
        <h1
          class="mt-2 text-4xl font-extrabold tracking-tight text-slate-900 dark:text-gray-300 sm:text-5xl">
          Please
          <router-link class="text-indigo-700 dark:text-indigo-300" to="billing"
            >upgrade</router-link
          >
          your account.
        </h1>
        <p class="mt-2 text-base text-slate-500 dark:text-gray-300">
          {{ message }}
        </p>
      </div>
    </div>
  </main>
</template>
<script>
export default {
  props: {
    title: {
      type: String,
      default: "You don't have access to this feature",
    },
    subtitle: {
      type: String,
      default: 'Please upgrade your account to access this feature.',
    },
    message: {
      type: String,
      default: 'Sorry, this feature is not included in your current plan.',
    },
  },
};
</script>
