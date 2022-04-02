<template>
  <div
    class="fixed top-8 w-60 justify-center space-y-8 px-4 py-8 text-sm font-bold">
    <div class="w-full">
      <span class="text-center text-sm font-bold">Refine your search</span>

      <FollowerCount :min="1000" :max="1000000000" />

      <EngagementFilter
        :min="0"
        :max="100"
        attribute="instagram_engagement_rate" />
    </div>
    <span class="text-xs font-bold text-neutral-700">Instagram Category</span>
    <CategoryFilter></CategoryFilter>

    <!--  <ais-menu-select attribute="city" />
    <ais-menu-select attribute="country" /> -->
    <span class="text-xs font-bold text-neutral-700">Gender</span>
    <ais-menu-select attribute="gender" />
    <!--  <ais-menu-select attribute="tags" /> -->

    <ais-toggle-refinement
      :class-names="{
        'ais-RefinementList-checkbox': 'rounded-md',

        // ...
      }"
      attribute="has_emails"
      label="Email" />
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
