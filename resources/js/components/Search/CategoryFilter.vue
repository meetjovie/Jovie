<template>
  <ais-menu-select searchable attribute="instagram_category">
    <template v-slot="{ items, refine, sendEvent }">
      <select
        class="absolute mt-1 max-h-60 w-40 overflow-auto rounded-md border border-slate-400 outline-none ring-0 focus-visible:outline-none sm:text-xs"
        @change="refine($event.currentTarget.value)">
        <option
          class="absolute mt-1 max-h-60 w-40 overflow-auto rounded-md bg-white/60 py-1 text-base shadow-lg backdrop-blur-2xl backdrop-saturate-150 backdrop-filter hover:bg-indigo-700 focus-visible:outline-none sm:text-xs"
          value="">
          Filter by Category
        </option>
        <option
          class="absolute mt-1 w-40 overflow-auto rounded-md bg-white/60 py-1 text-base shadow-lg backdrop-blur-2xl backdrop-saturate-150 backdrop-filter hover:bg-indigo-700 focus-visible:outline-none sm:text-xs"
          v-for="item in items"
          :key="item.value"
          :value="item.value"
          :selected="item.isRefined">
          {{ item.label }}
        </option>
      </select>
    </template>
  </ais-menu-select>
</template>

<script></script>
