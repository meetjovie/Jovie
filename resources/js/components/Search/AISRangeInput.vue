<template>
  <!-- ... -->
  <ais-range-input :attribute="attribute">
    <template
      v-slot="{ currentRefinement, range, canRefine, refine, sendEvent }">
      <input
        class="border-1 flex-auto rounded-l-md bg-white/0 py-1 text-base leading-6 text-gray-500 placeholder-gray-500 outline-0 ring-0 focus-visible:border-0 focus-visible:placeholder-gray-400 focus-visible:outline-none focus-visible:outline-none focus-visible:ring-0"
        type="number"
        :min="range.min"
        :max="range.max"
        :placeholder="range.min"
        :disabled="!canRefine"
        :value="formatMinValue(currentRefinement.min, range.min)"
        @input="
          refine({
            min: $event.currentTarget.value,
            max: formatMaxValue(currentRefinement.max, range.max),
          })
        " />
      →
      <input
        class="border-1 flex-auto rounded-r-md bg-white/0 py-1 text-base leading-6 text-gray-500 placeholder-gray-500 outline-0 ring-0 focus-visible:border-0 focus-visible:placeholder-gray-400 focus-visible:outline-none focus-visible:outline-none focus-visible:ring-0"
        type="number"
        :min="range.min"
        :max="range.max"
        :placeholder="range.max"
        :disabled="!canRefine"
        :value="formatMaxValue(currentRefinement.max, range.max)"
        @input="
          refine({
            min: formatMinValue(currentRefinement.min, range.min),
            max: $event.currentTarget.value,
          })
        " />
    </template>
  </ais-range-input>
</template>

<script>
export default {
  props: {
    attribute: {
      type: String,
      required: true,
    },
  },
  methods: {
    formatMinValue(minValue, minRange) {
      return minValue !== null && minValue !== minRange ? minValue : '';
    },
    formatMaxValue(maxValue, maxRange) {
      return maxValue !== null && maxValue !== maxRange ? maxValue : '';
    },
  },
};
</script>
