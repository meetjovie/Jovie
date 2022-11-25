<template>
  <div
    class="fixed top-4 w-60 justify-center space-y-8 px-4 py-8 text-sm font-bold">
    <div class="w-full space-y-8">
      <span class="text-center text-sm font-bold">Refine your search</span>
      <ais-range-input
        attribute="unique"
        :min="1"
        :max="10000000000000000000"
        style="display: none"></ais-range-input>
      <ais-menu-select searchable attribute="all_to" style="display: none">
        <template v-slot="{ items, refine, sendEvent }">
          <select @change="refine($event.currentTarget.value)">
            <option class="w-full" value="">All</option>
            <option
              class="absolute mt-1 max-h-60 w-60 overflow-auto rounded-md bg-white/90 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-2xl backdrop-filter focus:outline-none sm:text-sm"
              v-for="item in items"
              :key="item.value"
              :value="item.value"
              :selected="item.isRefined">
              {{ item.label }}
            </option>
          </select>
        </template>
      </ais-menu-select>
      <ais-menu-select searchable attribute="selected_to" style="display: none">
        <template v-slot="{ items, refine, sendEvent }">
          <select @change="refine($event.currentTarget.value)">
            <option class="w-full" value="">All</option>
            <option
              class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
              v-for="item in items"
              :key="item.value"
              :value="item.value"
              :selected="item.isRefined">
              {{ item.label }}
            </option>
          </select>
        </template>
      </ais-menu-select>
      <ais-menu-select searchable attribute="rejected_to" style="display: none">
        <template v-slot="{ items, refine, sendEvent }">
          <select @change="refine($event.currentTarget.value)">
            <option class="w-full" value="">All</option>
            <option
              class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
              v-for="item in items"
              :key="item.value"
              :value="item.value"
              :selected="item.isRefined">
              {{ item.label }}
            </option>
          </select>
        </template>
      </ais-menu-select>

      <FollowerCount :min="1000" :max="1000000000" />

      <EngagementFilter
        :min="0"
        :max="100"
        attribute="instagram_engagement_rate" />

      <!-- <CategoryFilter></CategoryFilter> -->

      <!--  <ais-menu-select attribute="city" />
      <ais-menu-select attribute="country" /> -->

      <!--  <ais-menu-select attribute="gender" /> -->
      <!--  <ais-menu-select attribute="tags" /> -->

      <!--  <ais-toggle-refinement
        :class-names="{
          'ais-RefinementList-checkbox': 'rounded-md fill-indigo-700',

          // ...
        }"
        class="rounded-md fill-indigo-700"
        attribute="has_emails"
        label="Email" /> -->
      <ais-toggle-refinement attribute="has_emails" label="Email">
        <template v-slot="{ value, refine, createURL, sendEvent }">
          <input
            v-model="value.isRefined"
            @click="refine(value.isRefined)"
            type="checkbox"
            class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus-visible:ring-indigo-500" />
          <span class="ml-1 text-2xs text-slate-400"
            >Must have contact info</span
          >
        </template>
      </ais-toggle-refinement>
      <ais-clear-refinements>
        <template v-slot="{ canRefine, refine, createURL }">
          <a
            class="px-2 text-xs font-bold text-slate-400 hover:text-slate-600"
            :href="createURL()"
            @click.prevent="refine"
            v-if="canRefine">
            Clear
          </a>
        </template>
      </ais-clear-refinements>
    </div>
  </div>
</template>
<script>
import InputGroup from '../InputGroup.vue';
import ButtonGroup from '../ButtonGroup.vue';
import MultiButton from '../MultiButton.vue';
import RangeFilter from '../RangeFilter.vue';
import LocationSelector from '../LocationSelector.vue';
import { instantMeiliSearch } from '@meilisearch/instant-meilisearch';
import EngagementFilter from '../Search/EngagementFilter.vue';
import FollowerCount from '../Search/FollowerCount.vue';
import CategoryFilter from '../Search/CategoryFilter.vue';

export default {
  components: {
    InputGroup,
    ButtonGroup,
    MultiButton,
    RangeFilter,
    LocationSelector,
    EngagementFilter,
    FollowerCount,
    CategoryFilter,
  },
};
</script>
