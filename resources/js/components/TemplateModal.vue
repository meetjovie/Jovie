<template>
  <GlassmorphismContainer class="dark:bg-jovieDark-900" size="3xl">
    <div class="px-8 py-2">
      <div
        class="fond-semibold dark:font-white flex flex-col text-xs text-slate-700 dark:text-jovieDark-300">
        <span class="text-xl dark:text-jovieDark-200"
          >Start with a template</span
        >
        Jumpstart your list with one of these templates created by experts
      </div>

      <div class="relative py-4">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
          <div
            class="w-full border-t border-gray-300 dark:border-jovieDark-border" />
        </div>
        <div class="relative flex justify-start">
          <span
            class="bg-slate-50/90 pr-3 text-base font-semibold leading-6 text-slate-900 dark:bg-jovieDark-900 dark:text-jovieDark-200"
            >Popular templates</span
          >
        </div>
      </div>
      <ActionListGrid />
    </div>
  </GlassmorphismContainer>
</template>

<script>
import GlassmorphismContainer from './GlassmorphismContainer.vue';
import ActionListGrid from './ActionListGrid.vue';

export default {
  components: {
    GlassmorphismContainer,
    ActionListGrid,
  },
};
</script>
