<template>
  <Combobox v-model="selectedItem" v-slot="{ open }">
    <ComboboxInput
      class=""
      @change="query = $event.target.value"
      :displayValue="(item) => item.name" />

    <div v-show="open">
      <!--
          Using the `static` prop, the `ComboboxOptions` are always
          rendered and the `open` state is ignored.
        -->
      <ComboboxOptions static>
        <ComboboxOption
          v-for="item in filteredItems"
          :key="item.id"
          :value="item">
          {{ item.name }}
        </ComboboxOption>
      </ComboboxOptions>
    </div>
  </Combobox>
</template>

<script setup>
import { ref, computed } from 'vue';
import {
  Combobox,
  ComboboxInput,
  ComboboxOptions,
  ComboboxOption,
} from '@headlessui/vue';
defineProps({
  items: Object,
});

const selectedItem = ref(items[0]);
const query = ref('');

const filteredItems = computed(() =>
  query.value === ''
    ? items
    : items.filter((item) => {
        return item.name.toLowerCase().includes(query.value.toLowerCase());
      })
);
</script>
