<template>
  <ais-menu-select searchable attribute="instagram_category">
    <template v-slot="{ items, refine, sendEvent }">
      <select @change="refine($event.currentTarget.value)">
        <option class="w-full" value="">All</option>
        <option
          class="absolute mt-1 max-h-60 w-40 overflow-auto rounded-md bg-white/90 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-xs"
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
