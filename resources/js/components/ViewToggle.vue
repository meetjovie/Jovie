<template>
  <Switch
    v-model="enabled"
    :class="[
      enabled ? 'bg-slate-100' : 'bg-slate-100',
      'relative inline-flex h-6 w-16 flex-shrink-0 cursor-pointer items-center rounded border border-transparent transition-colors duration-300 ease-in-out hover:bg-slate-150 focus-visible:outline-none focus-visible:ring-0 focus-visible:ring-slate-600 focus-visible:ring-offset-2 dark:bg-jovieDark-700 dark:hover:bg-jovieDark-600',
    ]">
    <Bars4Icon class="mx-auto h-5 w-4 text-slate-500 dark:text-jovieDark-100" />

    <span class="sr-only">Board view</span>
    <JovieTooltip
      class="z-10"
      tooltipPlacement="bottom"
      :tooltipText="enabled ? 'Table View' : 'Board View'">
      <span
        aria-hidden="true"
        :class="[
          enabled ? '-translate-x-8' : 'translate-x-0',
          'pointer-events-none z-10 mt-1.5 inline-block h-6 w-8 transform items-center justify-center rounded border border-slate-200  bg-white px-1 shadow ring-0 transition duration-200 ease-in-out dark:border-jovieDark-border dark:bg-jovieDark-700',
        ]">
        <Bars4Icon
          v-if="enabled"
          class="mx-auto h-5 w-4 text-slate-600 dark:text-jovieDark-100" />

        <Squares2X2Icon
          v-else
          class="mx-auto h-5 w-4 text-slate-600 dark:text-jovieDark-100" />
      </span>
    </JovieTooltip>
    <Squares2X2Icon
      class="absolute z-0 mx-auto ml-10 h-5 w-4 text-slate-500 dark:text-jovieDark-100" />
  </Switch>
</template>

<script setup>
import JovieTooltip from './JovieTooltip.vue';
import { Squares2X2Icon, Bars4Icon } from '@heroicons/vue/20/solid';
import { ref } from 'vue';
import { Switch } from '@headlessui/vue';

const enabled = ref(false);
</script>
<script>
export default {
  components: {
    JovieTooltip,
    Squares2X2Icon,
    Bars4Icon,
    Switch,
  },
  setup() {
    return {
      enabled,
    };
  },
};
</script>
