<template>
  <div class="bg-white dark:bg-jovieDark-900">
    <div class="relative min-h-screen overflow-hidden py-16">
      <div
        class="hidden lg:absolute lg:inset-y-0 lg:block lg:h-full lg:w-full lg:[overflow-anchor:none]">
        <div
          class="relative mx-auto h-full max-w-prose text-lg"
          aria-hidden="true">
          <svg
            class="absolute top-12 left-full translate-x-32 transform"
            width="404"
            height="384"
            fill="none"
            viewBox="0 0 404 384">
            <defs>
              <pattern
                id="74b3fd99-0a6f-4271-bef2-e80eeafdf357"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse">
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-gray-200 dark:text-jovieDark-600"
                  fill="currentColor" />
              </pattern>
            </defs>
            <rect
              width="404"
              height="384"
              fill="url(#74b3fd99-0a6f-4271-bef2-e80eeafdf357)" />
          </svg>
          <svg
            class="absolute top-1/2 right-full -translate-y-1/2 -translate-x-32 transform"
            width="404"
            height="384"
            fill="none"
            viewBox="0 0 404 384">
            <defs>
              <pattern
                id="f210dbf6-a58d-4871-961e-36d5016a0f49"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse">
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-gray-200 dark:text-jovieDark-600"
                  fill="currentColor" />
              </pattern>
            </defs>
            <rect
              width="404"
              height="384"
              fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)" />
          </svg>
          <svg
            class="absolute bottom-12 left-full translate-x-32 transform"
            width="404"
            height="384"
            fill="none"
            viewBox="0 0 404 384">
            <defs>
              <pattern
                id="d3eb07ae-5182-43e6-857d-35c643af9034"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse">
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-gray-200 dark:text-jovieDark-600"
                  fill="currentColor" />
              </pattern>
            </defs>
            <rect
              width="404"
              height="384"
              fill="url(#d3eb07ae-5182-43e6-857d-35c643af9034)" />
          </svg>
        </div>
      </div>
      <div class="relative px-6 lg:px-8">
        <div class="mx-auto max-w-prose text-lg">
          <div class="mx-auto">
            <h1
              class="mt-2 block text-3xl font-bold leading-8 tracking-tight text-gray-900 dark:text-jovieDark-100 sm:text-4xl">
              {{ post.title || 'Title' }}
            </h1>
            <span
              v-if="post.author"
              class="block text-sm font-semibold text-indigo-600 dark:text-indigo-400"
              >{{ post.author }}</span
            >
            <span
              v-else
              class="block w-40 rounded-md bg-slate-300 text-sm font-semibold text-indigo-600 dark:bg-jovieDark-700 dark:text-indigo-400"
              >{{ post.author }}</span
            >
          </div>

          <figure>
            <img
              v-if="post.image"
              class="w-full rounded-lg"
              :src="asset(post.image)"
              :alt="post.title"
              width="1310"
              height="873" />
          </figure>
          <p
            v-html="post.body"
            class="mt-8 text-xl leading-8 text-gray-500 dark:text-jovieDark-400"></p>
        </div>
      </div>
    </div>

    <HomeCTA4 />
  </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment/moment';
import HomeCTA4 from '../components/Home/HomeCTA4.vue';

export default {
  name: 'BlogPost',
  components: {
    HomeCTA4,
  },
  data() {
    return {
      loading: false,
      post: {},
      error: false,
    };
  },
  methods: {
    async getBlogPost() {
      try {
        const slug = this.$route.params.slug;
        let response = await axios.get(`/api/blog/${slug}`);
        response = response.data;
        if (response.status) {
          this.post = response.data;
        }
      } catch (err) {
        this.error = true;
      } finally {
        this.loading = false;
      }
    },
  },
  mounted() {
    this.getBlogPost();
  },
};
</script>
