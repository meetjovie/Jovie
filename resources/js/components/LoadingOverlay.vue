<template>
  <TransitionRoot
    appear
    :show="isShowing"
    enter="transition-opacity duration-75"
    enter-from="opacity-0"
    enter-to="opacity-100"
    leave="transition-opacity duration-150"
    leave-from="opacity-100"
    leave-to="opacity-0">
    <div class="fixed inset-0 bg-black/30" aria-hidden="true" />
  </TransitionRoot>
  <slot></slot>
</template>

<script setup>
import { ref } from 'vue';
import { TransitionRoot } from '@headlessui/vue';

const isShowing = ref(true);
</script>
