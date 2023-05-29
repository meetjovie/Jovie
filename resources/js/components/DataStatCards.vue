<template>
  <dl class="mt-5 grid w-full grid-cols-1 gap-5 sm:grid-cols-3">
    <template v-if="loading">
      <div
        v-for="n in 3"
        :key="n"
        class="flex animate-pulse flex-col space-y-4 overflow-hidden rounded-lg border border-slate-300 px-4 py-5 dark:border-jovieDark-border sm:p-6">
        <dt class="h-4 w-full rounded bg-slate-200 dark:bg-jovieDark-700"></dt>
        <dd class="h-9 w-full rounded bg-slate-200 dark:bg-jovieDark-700"></dd>
        <div
          class="h-1 w-full rounded bg-slate-200 dark:bg-jovieDark-700"></div>
        <div
          class="h-6 w-full rounded bg-slate-200 dark:bg-jovieDark-700"></div>
      </div>
    </template>
    <template v-else>
      <div
        v-for="item in stats"
        :key="item.name"
        class="flex flex-col space-y-4 overflow-hidden rounded-lg border border-slate-300 px-4 py-5 dark:border-jovieDark-border sm:p-6">
        <dt
          class="truncate text-sm font-medium text-slate-900 dark:text-jovieDark-100">
          {{ item.name }}
        </dt>
        <dd
          class="mt-1 text-3xl font-semibold tracking-tight text-slate-900 dark:text-jovieDark-200">
          {{ formatCount(item.stat) }} /
          {{ formatCount(item.limit) }}
        </dd>
        <ProgressBar size="xs" :color="black" :percentage="item.progressBar" />
        <span
          v-if="item.reached"
          class="text-2xs text-red-600 dark:text-jovieDark-300">
          {{ item.message }}
        </span>
        <span class="text-2xs text-slate-600 dark:text-jovieDark-300">{{
          item.description
        }}</span>
      </div>
    </template>
  </dl>
</template>

<script>
import ProgressBar from './ProgressBar.vue';

export default {
  name: 'Stats',
  components: {
    ProgressBar,
  },
  props: {
    stats: {
      type: Array,
      required: true,
    },
  },
};
</script>
