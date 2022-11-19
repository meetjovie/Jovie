<template>
  <!-- ... -->
  <ais-range-input :attribute="attribute">
    <template
      v-slot="{ currentRefinement, range, canRefine, refine, sendEvent }">
      <div class="grid w-full grid-cols-2"></div>
      <div>
        <div class="relative">
          <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-300" />
          </div>
          <div class="relative flex justify-start">
            <span class="bg-gray-50 pr-2 text-xs text-gray-500">
              Engagement Rate</span
            >
          </div>
        </div>
        <div class="grid grid-cols-2">
          <div class="relative mt-1">
            <div
              class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <ArrowDownIcon class="h-5 w-5 text-gray-400" />
            </div>
            <input
              class="block w-full rounded-tl-md border-gray-200 py-2 pl-10 text-sm text-gray-500 focus-visible:border-indigo-500 focus-visible:ring-indigo-500"
              type="number"
              :min="0"
              :max="100"
              :placeholder="0"
              :value="formatMinValue(currentRefinement.min, range.min)"
              @input="
                refine({
                  min: $event.currentTarget.value,
                  max: formatMaxValue(currentRefinement.max, range.max),
                })
              " />
          </div>
          <div class="relative mt-1">
            <div
              class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <ArrowUpIcon class="h-5 w-5 text-gray-400" />
            </div>
            <input
              class="block w-full rounded-tr-md border-gray-200 py-2 pl-10 text-sm text-gray-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500"
              type="number"
              :min="0"
              :max="100"
              :placeholder="100"
              :value="formatMaxValue(currentRefinement.max, range.max)"
              @input="
                refine({
                  min: formatMinValue(currentRefinement.min, range.min),
                  max: $event.currentTarget.value,
                })
              " />
          </div>
        </div>
        <div class="flex items-center justify-between">
          <span class="relative z-0 mx-auto inline-flex w-full text-center">
            <button
              @click="refine({ min: 1, max: 100 })"
              rounded="bl"
              size="xs"
              class="w-full rounded-bl-md border bg-white text-2xs text-gray-500 hover:bg-gray-100 active:bg-gray-200"
              design="secondary"
              text="1%">
              1%
            </button>
            <button
              @click="refine({ min: 2, max: 100 })"
              rounded="none"
              size="xs"
              class="w-full border bg-white text-2xs text-gray-500 hover:bg-gray-100 active:bg-gray-200"
              design="secondary"
              text="2%">
              2%
            </button>
            <button
              @click="refine({ min: 5, max: 100 })"
              rounded="br"
              size="xs"
              class="w-full rounded-br-md border bg-white text-2xs text-gray-500 hover:bg-gray-100 active:bg-gray-200"
              design="secondary"
              text="5%">
              5%
            </button>
          </span>
        </div>
      </div>
    </template>
  </ais-range-input>
</template>

<script>
import ButtonGroup from '../ButtonGroup.vue';
import { ArrowUpIcon, ArrowDownIcon } from '@heroicons/vue/24/solid';
export default {
  components: {
    ButtonGroup,
    ArrowUpIcon,
    ArrowDownIcon,
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
