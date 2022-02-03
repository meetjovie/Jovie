<template>
        <div class="border-gray-200">
                <TabList class="-mb-px flex space-x-8">
                  <Tab as="template" v-for="tab in tabs" :key="tab.name" v-slot="{ selected }">
                    <button :class="[selected ? 'text-indigo-600 border-indigo-600' : 'text-gray-900 border-transparent', 'flex-1 whitespace-nowrap px-1 border-b-2 text-xs font-medium']">
                      {{ tab.name }}
                    </button>
                  </Tab>
                </TabList>
        </div>
</template>

<script>
import { Tab, TabList } from '@headlessui/vue'

export default {
    name: 'SubNav',
    components: {
        Tab,
        TabList,
    },
    props: ['tabs']
}
</script>