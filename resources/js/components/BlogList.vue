<template>
  <ul role="list" class="mx-auto max-w-prose divide-y divide-slate-200">
    <li
      v-for="post in posts"
      :key="post.id"
      class="mx-auto mt-6 flex px-4 py-4 text-slate-500 sm:px-0">
      <div class="sticky top-24 w-24 text-2xs">
        <p class="text-sm font-semibold text-slate-600">
          {{ formatDate(post.publish_date) }}
        </p>
      </div>
      <div class="w-full">
        <router-link
          :to="'/blog/' + post.slug"
          as="h2"
          class="text-3xl font-bold tracking-tight text-slate-800"
          >{{ post.title }}</router-link
        >
        <img
          v-if="post.image_url"
          :src="asset(post.image_url)"
          :alt="post.title"
          class="mt-4 rounded-xl border border-neutral-200 py-4 shadow-lg dark:border-neutral-700" />
        <p
          class="prose mt-4 rounded-md bg-slate-100 px-4 px-4 py-2 text-xs dark:bg-jovieDark-800">
          <MapIcon class="mr-1 inline-block h-4 w-4" />
          As always we welcome you vote on new features & contribute your own
          ideas to the
          <a href="https://roadmap.jov.ie">Jovie Roadmap</a>.
        </p>
        <p v-if="post.excerpt" class="prose mt-4" v-html="post.excerpt"></p>
        <p v-else class="prose mt-4" v-html="post.body"></p>
        <router-link
          v-if="post.excerpt"
          :to="'/blog/' + post.slug"
          class="mt-4 py-4 font-semibold text-slate-600 hover:text-slate-800"
          >Read more...</router-link
        >
      </div>
    </li>
  </ul>
</template>
<script setup>
import axios from 'axios';
import { MapIcon } from '@heroicons/vue/24/solid';
import moment from 'moment';
import { ref, onMounted } from 'vue';

const posts = ref([]);
const loading = ref(false);
const error = ref(false);

async function fetchPosts() {
  loading.value = true;
  try {
    let response = await axios.get('/api/blog');
    response = response.data;
    if (response.status) {
      // Sort the posts by publish date, with the newest first
      posts.value = response.data.sort((a, b) => {
        return new Date(b.publish_date) - new Date(a.publish_date);
      });
    } else {
    }
  } catch (err) {
    error.value = true;
  } finally {
    loading.value = false;
  }
}

function formatDate(date) {
  return moment(date).format('YY.MM.DD');
}

onMounted(() => {
  fetchPosts();
});
</script>
