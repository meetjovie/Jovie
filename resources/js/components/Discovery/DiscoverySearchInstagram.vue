<template>
  <div class="space-y-4 px-4 py-8 text-sm font-bold">
    <!-- <ais-menu attribute="instagram_category" /> -->
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
