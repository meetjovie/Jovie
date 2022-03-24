<template>
  <div class="mx-auto w-full">
    <ais-instant-search :search-client="searchClient" index-name="creators">
      <ais-search-box
        is="div"
        class="w-full rounded-lg text-neutral-500"
        placeholder="Search for a creator" />
      <ais-hits> </ais-hits>
    </ais-instant-search>
  </div>
</template>

<script>
import { instantMeiliSearch } from '@meilisearch/instant-meilisearch';
import InputGroup from '../components/InputGroup.vue';
export default {
  components: {
    instantMeiliSearch,
    InputGroup,
  },
  data() {
    return {
      searchClient: instantMeiliSearch(process.env.MIX_MEILISEARCH_HOST, '', {
        placeholderSearch: true, // default: true.
        primaryKey: 'id', // default: undefined
        // ...
      }),
    };
  },
};
</script>
