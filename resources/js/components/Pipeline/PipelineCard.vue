<template>
  <div class="rounded bg-white px-3 pt-3 pb-5 shadow-md">
    <div class="flex justify-between">
      <p class="font-sans text-sm font-semibold tracking-wide text-slate-700">
        {{ task.title }}
      </p>

      <img
        class="ml-3 h-6 w-6 rounded-full"
        src="https://pickaface.net/gallery/avatar/unr_sample_161118_2054_ynlrg.png"
        alt="Avatar" />
    </div>
    <div class="mt-4 flex items-center justify-between">
      <span class="text-sm text-slate-600">{{ task.date }}</span>
      <badge v-if="task.type" :color="badgeColor">{{ task.type }}</badge>
    </div>
  </div>
</template>
<script>
import PipelineBadge from '../Pipeline/PipelineBadge.vue';
export default {
  components: {
    PipelineBadge,
  },
  props: {
    task: {
      type: Object,
      default: () => ({}),
    },
  },
  computed: {
    badgeColor() {
      const mappings = {
        Design: 'purple',
        'Feature Request': 'teal',
        Backend: 'blue',
        QA: 'green',
        default: 'teal',
      };
      return mappings[this.task.type] || mappings.default;
    },
  },
};
</script>
