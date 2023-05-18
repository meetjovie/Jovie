<template>
  <div
    class="relative w-full overflow-hidden bg-slate-200"
    :class="[
      { 'h-2': size === 'sm' },
      { 'h-4': size === 'lg' },
      { 'h-3': size === 'md' },
      { 'h-5': size === 'xl' },
      { 'h-1': size === 'xs' },
      { 'rounded-full': rounded },
      { indeterminate: indeterminate },
    ]">
    <div
      class="h-full"
      :class="[
        { 'bg-red-500': percentage === 100 && invertedColor },
        { 'bg-green-500': percentage === 100 && !invertedColor },
        { 'bg-indigo-400': percentage < 100 && percentage > 0 },
        { 'bg-slate-500': percentage === 0 },
        { 'absolute top-0': indeterminate },
        { 'rounded-full': rounded },
      ]"
      role="progressbar"
      :style="{ width: `${percentage}%` }"
      :aria-valuenow="percentage"
      aria-valuemin="0"
      aria-valuemax="100">
      <span class="mx-auto flex h-full items-center text-center">
        <p
          v-if="percentage && (!size === 'sm' || !size === 'xs')"
          class="middle-0 absolute mx-auto w-full text-center text-[8px] font-bold transition-all"
          :class="[
            { 'text-white': percentage > 50 },
            { 'text-indigo-700': percentage <= 50 },
          ]">
          {{ label || percentage + '%' }}
        </p>
      </span>
    </div>
  </div>
</template>
<script>
export default {
  inheritAttrs: false,
  props: {
    color: {
      type: String,
      default: 'indigo',
    },
    invertedColor: {
      type: Boolean,
      default: false,
    },
    percentage: {
      type: Number,
      default: 0,
    },
    label: {
      type: String,
      default: '',
    },
    size: {
      type: String,
      default: 'md',
    },
    rounded: {
      type: Boolean,
      default: true,
    },
    indeterminate: Boolean,
  },
};
</script>
<style scoped>
@keyframes progress-indeterminate {
  0% {
    width: 30%;
    left: -40%;
  }
  60% {
    left: 100%;
    width: 100%;
  }
  to {
    left: 100%;
    width: 0;
  }
}
.progressbar {
  transition: width 0.25s ease;
}
.indeterminate .progressbar {
  animation: progress-indeterminate 1.4s ease infinite;
}
</style>
