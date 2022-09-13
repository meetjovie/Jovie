<template>
  <div class="bg-neutral-50">
    <div
      class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-24 lg:px-8">
      <h2
        class="text-3xl font-extrabold tracking-tight text-gray-900 md:text-4xl">
        <span class="block">{{ title }}</span>
        <span class="block text-indigo-600">{{ subtitle }}</span>
      </h2>
      <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
        <div class="inline-flex rounded-md shadow">
          <ButtonGroup type="submit" :text="cta" design="hero"></ButtonGroup>
          <router-link
            to="signup"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">
            {{ cta }}
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ButtonGroup from './ButtonGroup.vue';
export default {
  name: 'CallToAction',
  data() {
    return {};
  },
  props: {
    title: {
      type: String,
      default: 'Ready to dive in?',
    },
    subtitle: {
      type: String,
      default: 'See what Jovie can do for you...',
    },
    cta: {
      type: String,
      default: 'Try Jovie free',
    },
  },
  methods: {},
  components: { ButtonGroup },
};
</script>

<style scoped></style>
