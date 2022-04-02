<template>
  <div class="space-y-4 px-4 py-8 text-sm font-bold">
    <!-- <ais-menu attribute="instagram_category" /> -->
    <ais-range-input
      attribute="instagram_followers"
      :min="0"
      :max="1000000000" />
    <ais-range-input
      class="mt-4"
      attribute="instagram_engagement_rate"
      :min="0"
      :max="1"
      :precision="2" />

    <ais-menu-select
      searchable
      class="flex-auto rounded-md border-0 bg-white/0 py-2 text-base leading-6 text-gray-500 placeholder-gray-500 outline-0 ring-0 focus-visible:border-0 focus-visible:placeholder-gray-400 focus-visible:outline-none focus-visible:outline-none focus-visible:ring-0"
      attribute="instagram_category">
      <template v-slot="{ items, createURL, refine }">
        <ol>
          <li v-for="item in items" :key="item.value">
            <component
              class="w-full rounded-md bg-white/0 text-neutral-400"
              :is="item.isRefined ? 'strong' : 'span'">
              <a
                :href="createURL(item.value)"
                @click.prevent="refine(item.value)">
                {{ item.label }} - {{ item.count }}
              </a>
            </component>
          </li>
        </ol>
      </template>
    </ais-menu-select>
    <ais-menu-select attribute="city" />
    <ais-menu-select attribute="country" />
    <ais-menu-select attribute="gender" />
    <ais-menu-select attribute="tags" />
    <AISRangeInput attribute="instagram_followers" />
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
import AISRangeInput from '../Search/AISRangeInput.vue';

export default {
  components: {
    InputGroup,
    ButtonGroup,
    MultiButton,
    RangeFilter,
    LocationSelector,
    AISRangeInput,
  },
};
</script>
