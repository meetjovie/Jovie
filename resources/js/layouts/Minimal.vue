<template>
  <div class="" id="app">
    <router-view />
    <NotificationGroup group="user">
      <!-- Global notification live region, render this permanently at the end of the document -->
      <div
        aria-live="assertive"
        class="pointer-events-none absolute right-0 top-0 z-50 mr-4 mt-4 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
          <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->

          <Notification
            v-slot="{ notifications }"
            enter="transform ease-out duration-300 transition"
            enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
            enter-to="translate-y-0 opacity-100 sm:translate-x-0"
            leave="transition ease-in duration-500"
            leave-from="opacity-100"
            leave-to="opacity-0"
            move="transition duration-500"
            move-delay="delay-300">
            <div
              class="mx-auto mt-4 flex w-80 max-w-sm overflow-hidden rounded-lg border border-slate-200 bg-white/60 bg-clip-padding shadow-md backdrop-blur-2xl backdrop-saturate-150 dark:border-jovieDark-border dark:bg-jovieDark-900/60"
              v-for="notification in notifications"
              :key="notification.id">
              <button
                class="absolute right-0 top-0 m-2"
                @click="notification.close">
                <XMarkIcon
                  class="h-5 w-5 text-slate-400 dark:text-jovieDark-100" />
              </button>
              <div
                class="flex w-10 items-center justify-center bg-slate-200 dark:bg-jovieDark-800">
                <XMarkIcon
                  v-if="notification.type === 'error'"
                  class="h-4 w-4 text-red-500" />
                <ExclamationTriangleIcon
                  v-else-if="notification.type === 'warning'"
                  class="h-4 w-4 text-amber-500" />
                <CheckCircleIcon
                  v-else
                  class="h-4 w-4"
                  :class="[
                    { 'text-red-500': notification.type === 'error' },
                    { 'text-green-500': notification.type === 'success' },
                    { 'text-amber-500': notification.type === 'warning' },
                  ]" />
              </div>

              <div class="-mx-3 px-4 py-2">
                <div class="mx-3">
                  <span
                    class="text-xs font-semibold text-slate-600 dark:text-jovieDark-100"
                    >{{ notification.title }}</span
                  >
                  <p class="text-xs text-slate-400 dark:text-jovieDark-100">
                    {{ notification.text }}
                  </p>
                </div>
              </div>
            </div>
          </Notification>
        </div>
      </div>
    </NotificationGroup>
  </div>
</template>

<script>
import {
  CheckCircleIcon,
  ExclamationTriangleIcon,
  XMarkIcon,
} from '@heroicons/vue/24/outline';

export default {
  name: 'Minimal',
  components: { ExclamationTriangleIcon, CheckCircleIcon, XMarkIcon },
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
