<template>
  <div
    class="mx-auto rounded-lg border border-slate-200 bg-slate-50/60 bg-clip-padding shadow-lg outline-none ring-black backdrop-blur-md backdrop-saturate-200 backdrop-filter focus:border-transparent focus:outline-none focus:ring-0 focus:ring-black focus:ring-transparent focus:ring-offset-0 dark:border-jovieDark-border dark:bg-jovieDark-600/60"
    :class="containerSize">
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    size: {
      type: String,
      default: '7xl',
    },
  },
  computed: {
    containerSize() {
      switch (this.size) {
        case 'sm':
          return 'max-w-sm';
        case 'md':
          return 'max-w-md';
        case 'lg':
          return 'max-w-lg';
        case 'xl':
          return 'max-w-xl';
        case '2xl':
          return 'max-w-2xl';
        case '3xl':
          return 'max-w-3xl';
        case '4xl':
          return 'max-w-4xl';
        case '5xl':
          return 'max-w-5xl';
        case '6xl':
          return 'max-w-6xl';
        case '7xl':
          return 'max-w-7xl';
        case 'full':
          return 'max-w-full';
        default:
          return 'max-w-md';
      }
    },
  },
};
</script>
