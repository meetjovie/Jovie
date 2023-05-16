<template>
  <div class="bg-slate-50 dark:bg-jovieDark-900">
    <div
      class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:flex lg:items-center lg:justify-between lg:px-8 lg:py-24">
      <h2
        class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-jovieDark-100 md:text-4xl">
        <span class="block">Ready to dive in?</span>
        <span class="block text-indigo-600 dark:text-jovieDark-300"
          >See what Jovie can do for you...</span
        >
      </h2>
      <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
        <div class="inline-flex rounded-md shadow">
          <router-link
            to="signup"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">
            Try Jovie free
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>
