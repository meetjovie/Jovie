<template>
  <div
    class="rounded-lg border-b border-jovieDark-200 px-4 py-5 dark:border-jovieDark-border sm:px-6">
    <div
      class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
      <div class="ml-4 mt-4">
        <h3
          v-if="title"
          class="text-md font-medium leading-6 text-slate-900 dark:text-jovieDark-100">
          {{ title }}
        </h3>
        <p
          v-if="subtitle"
          class="mt-1 text-xs text-slate-500 dark:text-jovieDark-300">
          {{ subtitle }}
        </p>
      </div>
      <div v-if="buttontext" class="ml-4 mt-4 flex-shrink-0">
        <a :href="buttonlink">
          <ButtonGroup
            @click="this.$emit('button-click')"
            :design="buttonstyle"
            :size="buttonsize"
            :icon="buttonicon"
            :text="buttontext" />
        </a>
      </div>
    </div>
  </div>
</template>
<script>
import ButtonGroup from '../components/ButtonGroup.vue';

export default {
  name: 'CardHeading',
  components: {
    ButtonGroup,
  },
  props: {
    title: {
      type: String,
      default: null,
    },
    subtitle: {
      type: String,
      default: null,
    },
    buttonlink: {
      type: String,
      default: null,
    },
    buttontext: {
      type: String,
      default: null,
    },
    buttonstyle: {
      type: String,
      default: 'primary',
    },
    buttonsize: {
      type: String,
      default: 'md',
    },
    buttonicon: {
      type: String,
      default: null,
    },
    buttonClick: {
      type: Function,
      default: null,
    },
  },
};
</script>
