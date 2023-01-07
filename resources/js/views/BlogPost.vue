<template>
  <div class="relative overflow-hidden bg-white py-16">
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
                class="text-gray-200"
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
                class="text-gray-200"
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
                class="text-gray-200"
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
        <h1>
          <span
            class="block text-center text-lg font-semibold text-indigo-600"
            >{{ post.author || 'Author' }}</span
          >
          <span
            class="mt-2 block text-center text-3xl font-bold leading-8 tracking-tight text-gray-900 sm:text-4xl"
            >{{ post.title || 'Title' }}</span
          >
        </h1>
        <p class="mt-8 text-xl leading-8 text-gray-500">
          {{ post.body }}
        </p>

        <figure>
          <img
            v-if="post.image"
            class="w-full rounded-lg"
            :src="asset(post.image)"
            :alt="post.title"
            width="1310"
            height="873" />
        </figure>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment/moment';

export default {
  name: 'BlogPost',
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
