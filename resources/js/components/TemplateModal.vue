<template>
  <GlassmorphismContainer size="3xl">
    <div class="px-8 py-2">
      <div
        class="fond-semibold dark:font-white flex flex-col text-xs text-slate-700 dark:text-jovieDark-100">
        <span class="text-xl">Start with a template</span>
        Jumpstart your list with one of these templates created by experts
      </div>

      <div class="relative py-4">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
          <div class="w-full border-t border-gray-300" />
        </div>
        <div class="relative flex justify-start">
          <span
            class="bg-slate-50/90 pr-3 text-base font-semibold leading-6 text-slate-900 dark:text-jovieDark-100 dark:bg-jovieDark-900"
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
