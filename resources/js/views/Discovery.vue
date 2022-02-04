
<template>
  <div class="min-h-screen bg-gray-100">
    

    <div class="">
      <div class="mx-auto lg:grid lg:grid-cols-12 lg:gap-8">
        <div class="hidden lg:block lg:col-span-3 xl:col-span-2">
          <nav aria-label="Searchbar" class="sticky top-6 divide-y divide-gray-300">
            <DiscoverySearch></DiscoverySearch>
          </nav>
        </div>
        <main class="lg:col-span-9">
          <DiscoveryStats></DiscoveryStats>
          <DiscoveryToolbar></DiscoveryToolbar>
          <DiscoveryMain></DiscoveryMain>
        </main>
        <!-- <aside class="hidden bg-red-500 xl:block xl:col-span-4">
          <div class="sticky top-6 space-y-4">
            <DiscoverySidebar></DiscoverySidebar>
          </div>
        </aside> -->
      </div>
    </div>
  </div>
</template>


<script>
import DiscoverySearch from '../components/Discovery/DiscoverySearch.vue'
import DiscoverySidebar from '../components/Discovery/DiscoverySidebar.vue'
import DiscoveryMain from '../components/Discovery/DiscoveryMain.vue'
import DiscoveryStats from '../components/Discovery/DiscoveryStats.vue'
import DiscoveryToolbar from '../components/Discovery/DiscoveryToolbar.vue'


export default {
    name: 'Discovery',
    components: {
        DiscoverySearch,
        DiscoverySidebar,
        DiscoveryMain,
        DiscoveryStats,
        DiscoveryToolbar,

    }
}
</script>
