<template>
  <MenuItem :to="path" as="router-link" v-slot="{ active }">
    <div
      :class="[
        active
          ? 'bg-slate-100 dark:bg-jovieDark-500 dark:text-jovieDark-200'
          : 'text-slate-900 dark:text-jovieDark-100',
        'group flex w-full items-center rounded px-2 py-1 text-xs',
      ]">
      <component
        :is="icon"
        :active="active"
        class="mr-2 h-3 w-3 text-slate-400 dark:text-jovieDark-600"
        aria-hidden="true" />
      {{ name }}
    </div>
  </MenuItem>
</template>

<script>
import { MenuItem } from '@headlessui/vue';
export default {
  components: {
    MenuItem,
  },
  props: {
    icon: {
      type: String,
      required: true,
    },
    active: {
      type: Boolean,
      required: false,
      default: false,
    },
    name: {
      type: String,
      required: true,
    },
    path: {
      type: String,
      required: false,
      default: null,
    },
  },
};
</script>
