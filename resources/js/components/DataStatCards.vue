<template>
  <dl class="mt-5 grid w-full grid-cols-1 gap-5 sm:grid-cols-3">
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
