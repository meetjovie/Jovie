<template>
  <div class="min-h-screen bg-gray-100">
    <div class="">
      <div class="mx-auto flex">
        <div
          v-if="searchopen"
          class="z-10 hidden w-60 shrink-0 bg-neutral-50 shadow-lg lg:flex">
          <nav
            aria-label="Searchbar"
            class="min-h-screen divide-y divide-gray-300">
            <transition
              enter-active-class="transition duration-300 ease-out"
              enter-from-class="-translate-x-48 opacity-95"
              enter-to-class="translate-x-0 opacity-100"
              leave-active-class="transition duration-300 ease-in"
              leave-from-class="scale-100 opacity-100"
              leave-to-class="scale-95 opacity-0">
              <DiscoverySearch :searchopen="searchopen"></DiscoverySearch>
            </transition>
          </nav>
        </div>
        <main class="flex-auto">
          <button @click="searchopen = !searchopen">
            <ChevronLeftIcon
              v-if="searchopen"
              class="ml-2 mt-1 h-5 w-5 text-gray-700 hover:text-indigo-700"
              :class="{ 'text-indigo-700': searchopen }"
              aria-hidden="true"></ChevronLeftIcon>
            <FunnelIcon
              v-if="searchopen == false"
              class="ml-2 mt-1 h-5 w-5 text-gray-700 hover:text-indigo-700"></FunnelIcon>
          </button>

          <DiscoveryStats></DiscoveryStats>
          <TabGroup :defaultIndex="0">
            <DiscoveryToolbar class="px-4"></DiscoveryToolbar>
            <DiscoveryMain></DiscoveryMain>
          </TabGroup>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import DiscoverySearch from '../components/Discovery/DiscoverySearch.vue';
import DiscoverySidebar from '../components/Discovery/DiscoverySidebar.vue';
import DiscoveryMain from '../components/Discovery/DiscoveryMain.vue';
import DiscoveryStats from '../components/Discovery/DiscoveryStats.vue';
import DiscoveryToolbar from '../components/Discovery/DiscoveryToolbar.vue';
import { TabGroup } from '@headlessui/vue';
import { FunnelIcon, ChevronLeftIcon } from '@heroicons/vue/24/outline';

export default {
  name: 'Discovery',
  components: {
    DiscoverySearch,
    DiscoverySidebar,
    DiscoveryMain,
    DiscoveryStats,
    DiscoveryToolbar,
    TabGroup,
    FunnelIcon,
    ChevronLeftIcon,
  },
};
</script>
