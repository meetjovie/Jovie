<template>
  <ul role="list" class="mx-auto max-w-prose divide-y divide-slate-200">
    <li class="mx-auto mt-6 flex px-4 py-4 text-slate-500 sm:px-0">
      <div class="sticky top-24 w-24 bg-slate-300 text-2xs">
        <p class="text-sm font-semibold text-slate-600"></p>
      </div>
      <div class="w-full">
        <router-link
          :to="'/blog/' + post.slug"
          as="h2"
          class="bg-slate-300 text-3xl font-bold tracking-tight text-slate-800"></router-link>
        <!--  <img
          :src="post.image_url"
          :alt="post.title"
          class="mt-4 rounded-xl border border-neutral-200 py-4 shadow-lg dark:border-neutral-700" /> -->
        <p
          class="prose mt-4 rounded-md bg-slate-100 px-4 px-4 py-2 text-xs dark:bg-jovieDark-800">
          <MapIcon class="mr-1 inline-block h-4 w-4" />
          As always we welcome you vote on new features & contribute your own
          ideas to the
          <a href="https://roadmap.jov.ie">Jovie Roadmap</a>.
        </p>
        <div class="h-10 bg-slate-300"></div>
      </div>
    </li>
  </ul>
</template>
<script setup>
import { MapIcon } from '@heroicons/vue/24/solid';
</script>
