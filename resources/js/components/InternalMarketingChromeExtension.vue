<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="mx-auto max-w-lg">
    <ul
      role="list"
      class="space-y-4 divide-slate-200 rounded-lg dark:divide-slate-700">
      <li v-for="(item, itemIdx) in items" :key="itemIdx">
        <div
          v-if="item.visible"
          class="group relative flex h-24 items-center space-x-3 rounded-lg border border-slate-200 px-6 py-4 hover:bg-slate-200 dark:border-jovieDark-border dark:hover:bg-jovieDark-border">
          <div class="flex-shrink-0 items-center">
            <span
              :class="[
                item.iconColor,
                'inline-flex h-10 w-10 items-center justify-center rounded-lg',
              ]">
              <component
                :is="item.icon"
                class="h-6 w-6 text-white dark:text-black"
                aria-hidden="true" />
            </span>
          </div>
          <div class="min-w-0 flex-1">
            <div
              class="text-sm font-medium text-slate-900 dark:text-jovieDark-100">
              <a :href="item.href">
                <span class="absolute inset-0" aria-hidden="true" />
                {{ item.name }}
              </a>
            </div>

            <p class="text-sm text-slate-500 dark:text-jovieDark-400">
              {{ item.description }}
            </p>
          </div>
          <div class="flex-shrink-0 self-center">
            <ChevronRightIcon
              class="h-5 w-5 text-slate-400 group-hover:text-slate-500"
              aria-hidden="true" />
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { CloudArrowDownIcon, ChevronRightIcon } from '@heroicons/vue/24/solid';
import { CloudArrowUpIcon } from '@heroicons/vue/24/outline';
</script>
<script>
export default {
  data() {
    return {
      items: [
        {
          name: 'Download Jovie Chrome Extension',
          description:
            'Save contacts without leaving social media & see enriched contact details inside Gmail.',
          href: '/chrome-extension',
          iconColor: 'bg-pink-500',
          icon: CloudArrowDownIcon,
          visible: true,
        },
        {
          name: 'Bulk Upload Contacts',
          description: 'Upload a CSV File to Jovie.',
          href: '/import',
          iconColor: 'bg-purple-500',
          icon: CloudArrowUpIcon,
          visible: true,
        },
      ],
    };
  },
  mounted() {
    this.checkForJovieChromeExtension();
  },
  methods: {
    checkForJovieChromeExtension() {
      //check if the chrome extension is installed
      //if the document has a body tag that has the cattribute data-jovie-extension-installed and it is true
      //this.isExtensionInstalled = true;
      //check if the the store has chromeExtensionInstalled set to true
      //if it it is true then hide the first item in the array
      //otherwise check if the body has the attribute data-jovie-extension-installed and it is true
      //then set the store chromeExtensionInstalled to true & hide the first item in the array
      //otherwise set the store chromeExtensionInstalled to false
      if (this.$store.state.chromeExtensionInstalled) {
        this.items[0].visible = false;
        console.log('Jovie Chrome Extension is installed');
      } else {
        if (document.body.dataset.jovieExtensionInstalled === 'true') {
          this.$store.commit('setChromeExtensionInstalled', true);
          console.log('Jovie Chrome Extension is installed');
          this.items[0].visible = false;
        } else {
          this.$store.commit('setChromeExtensionInstalled', false);
          console.log('Jovie Chrome Extension is not installed');
        }
      }
    },
  },
};
</script>
