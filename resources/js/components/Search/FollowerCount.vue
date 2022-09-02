<template>
  <!-- ... -->
  <ais-range-input attribute="instagram_followers">
    <template
      v-slot="{ currentRefinement, range, canRefine, refine, sendEvent }">
      <div class="grid w-full grid-cols-2"></div>
      <div>
        <div class="relative">
          <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-300" />
          </div>
          <div class="relative flex justify-start">
            <span class="bg-neutral-50 pr-2 text-xs text-gray-500">
              Follower Count</span
            >
          </div>
        </div>
        <div class="grid grid-cols-2">
          <div class="relative mt-1">
            <div
              class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <UserIcon class="h-5 w-5 text-gray-400" />
            </div>
            <input
              class="block w-full rounded-tl-md border-neutral-200 py-2 pl-10 text-2xs text-neutral-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500"
              type="number"
              :min="1000"
              :max="1000000000"
              :placeholder="10000"
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
              <UserGroupIcon class="h-5 w-5 text-gray-400" />
            </div>
            <input
              class="block w-full rounded-tr-md border-neutral-200 py-2 pl-10 text-2xs text-neutral-700 focus-visible:border-indigo-500 focus-visible:ring-indigo-500"
              type="number"
              :min="1000"
              :max="1000000000"
              :placeholder="100000"
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
              @click="refine({ min: 10000, max: 100000 })"
              rounded="bl"
              size="xs"
              design="secondary"
              class="w-full rounded-bl-md border bg-white text-2xs text-neutral-500 hover:bg-neutral-100 active:bg-neutral-200"
              text="Micro">
              Micro
            </button>
            <button
              @click="refine({ min: 100000, max: 1000000 })"
              rounded="none"
              size="xs"
              design="secondary"
              class="w-full border bg-white text-2xs text-neutral-500 hover:bg-neutral-100 active:bg-neutral-200"
              text="Macro">
              Macro
            </button>
            <button
              @click="refine({ min: 1000000, max: 1000000000 })"
              rounded="br"
              size="xs"
              class="w-full rounded-br-md border bg-white text-2xs text-neutral-500 hover:bg-neutral-100 active:bg-neutral-200"
              design="secondary"
              text="1M+">
              1M+
            </button>
          </span>
        </div>
      </div>
    </template>
  </ais-range-input>
</template>

<script>
import ButtonGroup from '../ButtonGroup.vue';
import {
  ArrowUpIcon,
  ArrowDownIcon,
  UserIcon,
  UserGroupIcon,
} from '@heroicons/vue/24/solid';
export default {
  components: {
    ButtonGroup,
    ArrowUpIcon,
    ArrowDownIcon,
    UserIcon,
    UserGroupIcon,
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
