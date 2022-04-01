<template>
  <div class="space-y-4 px-4 py-8 text-sm font-bold">
    <!-- <ais-menu attribute="instagram_category" /> -->
    <ais-range-input
      attribute="instagram_followers"
      :min="0"
      :max="100000000000000" />
    <ais-range-input
      attribute="instagram_engagement_rate"
      :min="0"
      :max="1"
      :precision="2" />
    <ais-menu-select attribute="instagram_category" />
    <ais-menu-select attribute="city" />
    <ais-menu-select attribute="country" />
    <ais-menu-select attribute="gender" />
    <ais-menu-select attribute="tags" />
    <ais-toggle-refinement attribute="has_emails" label="Email" />
    <ais-clear-refinements :included-attributes="['instagram_followers']">
      <template v-slot="{ canRefine, refine, createURL }">
        <a :href="createURL()" @click.prevent="refine" v-if="canRefine">
          <ButtonGroup text="Clear filters"> </ButtonGroup>
        </a>
      </template>
    </ais-clear-refinements>
  </div>
</template>
<script>
import InputGroup from '../InputGroup.vue';
import ButtonGroup from '../ButtonGroup.vue';
import MultiButton from '../MultiButton.vue';
import RangeFilter from '../RangeFilter.vue';
import LocationSelector from '../LocationSelector.vue';
import { instantMeiliSearch } from '@meilisearch/instant-meilisearch';

export default {
  components: {
    InputGroup,
    ButtonGroup,
    MultiButton,
    RangeFilter,
    LocationSelector,
  },
};
</script>
