<template>
  <td
    v-if="showField"
    class="border-1 table-cell w-40 whitespace-nowrap border">
    <div class="text-xs text-slate-900 line-clamp-1">
      <input
        v-model="creator.meta.platform_employer"
        @blur="$emit('updateCrmMeta', creator)"
        autocomplete="off"
        :type="field"
        :name="field"
        :id="field"
        class="block w-full bg-white/0 px-2 py-1 placeholder-slate-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 sm:text-xs"
        :placeholder="field"
        :aria-describedby="field" />
    </div>
  </td>
</template>
<script>
export default {
  data() {
    return {
      showField: false,
    };
  },
  methods: {
    toggleField() {
      this.showField = !this.showField;
    },
  },
  props: {
    field: {
      type: String,
      required: true,
    },
    creator: {
      type: Object,
      required: true,
    },
    visibleColumns: {
      type: Array,
      required: true,
    },
  },
};
</script>
