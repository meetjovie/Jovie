<template>
  <input
    type="search"
    v-model="query"
    submit-title="Let's go!"
    reset-title="Reset"
    autofocus="true"
    placeholder="Search for a creator, hashtag, or keyword..."
    class="flex-auto rounded-md border-0 bg-white/0 py-2 text-base leading-6 text-gray-500 placeholder-gray-500 outline-0 ring-0 focus-visible:border-0 focus-visible:placeholder-gray-400 focus-visible:outline-none focus-visible:outline-none focus-visible:ring-0" />
</template>

<script>
import { connectSearchBox } from 'instantsearch.js/es/connectors';
import { createWidgetMixin } from 'vue-instantsearch/vue3/es';

export default {
  mixins: [createWidgetMixin({ connector: connectSearchBox })],
  props: {
    delay: {
      type: Number,
      default: 200,
      required: false,
    },
  },
  data() {
    return {
      timerId: null,
      localQuery: '',
    };
  },
  destroyed() {
    if (this.timerId) {
      clearTimeout(this.timerId);
    }
  },
  computed: {
    query: {
      get() {
        return this.localQuery;
      },
      set(val) {
        this.localQuery = val;
        if (this.timerId) {
          clearTimeout(this.timerId);
        }
        this.timerId = setTimeout(() => {
          this.state.refine(this.localQuery);
        }, this.delay);
      },
    },
  },
};
</script>
