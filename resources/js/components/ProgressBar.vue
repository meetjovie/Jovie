<template>
  <div
    class="relative h-3 w-full overflow-hidden bg-gray-200"
    :class="[{ 'rounded-full': rounded }, { indeterminate: indeterminate }]">
    <div
      class="progressbar h-full"
      :class="[
        { 'bg-green-500': percentage === 100 },
        { 'bg-indigo-400': percentage < 100 && percentage > 0 },
        { 'bg-neutral-500': percentage === 0 },
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
          v-if="percentage"
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
    percentage: {
      type: Number,
      default: 0,
    },
    label: {
      type: String,
      default: '',
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
