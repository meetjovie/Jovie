<template>
  <main
    class="mx-auto flex h-screen w-full max-w-7xl flex-grow flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="items-center">
      <div class="text-center">
        <p
          class="text-sm font-semibold uppercase tracking-wide text-indigo-600">
          {{ title }}
        </p>
        <h1
          class="mt-2 text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
          Please
          <router-link class="text-indigo-700" to="billing"
            >upgrade</router-link
          >
          your account.
        </h1>
        <p class="mt-2 text-base text-gray-500">
          Sorry, this feature is not included in your current plan.
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
  },
};
</script>
