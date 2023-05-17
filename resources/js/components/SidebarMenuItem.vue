<template>
  <MenuItem v-slot="{ active }" as="div">
    <button
      @click="handleItemClick"
      :class="[
        active
          ? 'bg-slate-100 text-slate-700 dark:bg-jovieDark-border dark:text-jovieDark-100'
          : 'text-sm font-light text-slate-900 dark:text-jovieDark-100',
        isActiveFilterType
          ? 'bg-slate-100 text-sm font-semibold text-slate-900 dark:bg-jovieDark-border dark:text-jovieDark-100'
          : '',
      ]"
      class="group mt-4 flex h-8 w-full items-center justify-between rounded px-1 text-left tracking-wide focus:outline-none focus:ring-0">
      <div class="flex items-center text-xs tracking-wide">
        <slot name="icon"></slot>
        <span class="ml-1">{{ label }}</span>
      </div>
      <div
        class="items-center rounded p-1 hover:bg-slate-300 hover:text-slate-50 hover:dark:bg-jovieDark-600 hover:dark:text-jovieDark-900">
        <span
          class="text-xs font-light text-slate-900 group-hover:hidden group-hover:text-slate-900 dark:text-jovieDark-100 group-hover:dark:text-jovieDark-100">
          {{ count }}
        </span>
        <PlusIcon
          v-if="showPlusIcon"
          class="hidden h-3 w-3 text-slate-400 active:text-white group-hover:block"></PlusIcon>
      </div>
    </button>
  </MenuItem>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      required: true,
    },
    count: {
      type: Number,
      default: 0,
    },
    isActiveFilterType: {
      type: Boolean,
      default: false,
    },
    showPlusIcon: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    handleItemClick() {
      this.$emit('click');
    },
  },
};
</script>
