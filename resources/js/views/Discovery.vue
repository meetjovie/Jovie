
<template>
  <div class="min-h-screen bg-gray-100">
    

    <div class="py-6">
      <div class="max-w-3xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-12 lg:gap-8">
        <div class="hidden lg:block lg:col-span-3 xl:col-span-2">
          <nav aria-label="Searchbar" class="sticky top-6 divide-y divide-gray-300">
            <DiscoverySearch></DiscoverySearch>
          </nav>
        </div>
        <main class="lg:col-span-9 xl:col-span-6">
          <DiscoveryMain></DiscoveryMain>
        </main>
        <aside class="hidden xl:block xl:col-span-4">
          <div class="sticky top-6 space-y-4">
            <DiscoverySidebar></DiscoverySidebar>
          </div>
        </aside>
      </div>
    </div>
  </div>
</template>


<script>
import DiscoverySearch from '../components/Discovery/DiscoverySearch.vue'
import DiscoverySidebar from '../components/Discovery/DiscoverySidebar.vue'
import DiscoveryMain from '../components/Discovery/DiscoveryMain.vue'


export default {
    name: 'Discovery',
    components: {
        DiscoverySearch,
        DiscoverySidebar,
        DiscoveryMain,
    }
}
</script>
