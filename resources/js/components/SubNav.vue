<template>
  <div class="border-slate-200">
    <TabList class="-mb-px flex space-x-8">
      <Tab
        as="template"
        v-for="tab in tabs"
        :key="tab.name"
        v-slot="{ selected }">
        <button
          :class="[
            selected
              ? 'border-indigo-600 text-indigo-600'
              : 'border-transparent text-slate-900',
            'flex-1 whitespace-nowrap border-b-2 px-1 text-xs font-medium',
          ]">
          {{ tab.name }}
        </button>
      </Tab>
    </TabList>
  </div>
</template>

<script>
import { Tab, TabList } from '@headlessui/vue';

export default {
  name: 'SubNav',
  components: {
    Tab,
    TabList,
  },
  props: ['tabs'],
};
</script>
