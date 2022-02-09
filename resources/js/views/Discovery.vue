
<template>
  <div class="min-h-screen bg-gray-100">
    

    <div class="">
      <div class="mx-auto flex ">
        
        <div v-if="searchopen" class="hidden lg:flex w-60 z-10 bg-white shadow-lg">
          
          <nav aria-label="Searchbar" class="sticky top-0 min-h-screen divide-y divide-gray-300">
            <DiscoverySearch></DiscoverySearch>
          </nav>
        </div>
    
        <main class="flex-auto overflow-hidden overscroll-contain">
          <button @click="searchopen = !searchopen">
            <SearchIcon class="h-5 w-5 text-gray-700 hover:text-indigo-700" aria-hidden="true"></SearchIcon>
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
import DiscoverySearch from '../components/Discovery/DiscoverySearch.vue'
import DiscoverySidebar from '../components/Discovery/DiscoverySidebar.vue'
import DiscoveryMain from '../components/Discovery/DiscoveryMain.vue'
import DiscoveryStats from '../components/Discovery/DiscoveryStats.vue'
import DiscoveryToolbar from '../components/Discovery/DiscoveryToolbar.vue'
import { TabGroup } from '@headlessui/vue'
import { SearchIcon } from '@heroicons/vue/outline'


export default {
    name: 'Discovery',
    components: {
        DiscoverySearch,
        DiscoverySidebar,
        DiscoveryMain,
        DiscoveryStats,
        DiscoveryToolbar,
        TabGroup,
        SearchIcon,
       
        

    },
    data () {
        return {
            searchopen: true,
        }
    },
}
</script>
