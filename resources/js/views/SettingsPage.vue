<template>
  <div class="flex min-h-full flex-col bg-white dark:bg-jovieDark-900">
    <div class="mx-auto flex w-full items-start">
      <aside class="sticky top-8 hidden shrink-0 lg:block">
        <JovieSidebar menu="Settings">
          <template #main>
            <SettingsMenu class="mt-8" />
          </template>
        </JovieSidebar>
      </aside>

      <main class="flex-1">
        <div class="mx-auto mt-8 max-w-3xl px-4 sm:px-6 lg:px-8">
          <router-view></router-view>
        </div>
      </main>

      <!--   <aside class="sticky top-8 hidden w-96 shrink-0 xl:block">
       
      </aside> -->
    </div>
  </div>
</template>
<script>
import JovieSidebar from '../components/JovieSidebar.vue';

import SettingsMenu from './SettingsMenu.vue';

export default {
  components: {
    SettingsMenu,

    JovieSidebar,
  },
  data() {
    return {};
  },
};
</script>
