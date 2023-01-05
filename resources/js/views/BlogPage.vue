<template>
  <div class="bg-white px-6 pt-16 pb-20 lg:px-8 lg:pt-24 lg:pb-28">
    <div
      class="relative mx-auto max-w-lg divide-y-2 divide-gray-200 lg:max-w-7xl">
      <div>
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
          Blog
        </h2>
        <div
          class="mt-3 sm:mt-4 lg:grid lg:grid-cols-2 lg:items-center lg:gap-5">
          <p class="text-xl text-gray-500">
            Get weekly articles in your inbox on how to grow your business.
          </p>
          <form class="mt-6 flex flex-col sm:flex-row lg:mt-0 lg:justify-end">
            <div>
              <label for="email-address" class="sr-only">Email address</label>
              <input
                id="email-address"
                name="email-address"
                type="email"
                autocomplete="email"
                required=""
                class="w-full appearance-none rounded-md border border-gray-300 bg-white px-4 py-2 text-base text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 lg:max-w-xs"
                placeholder="Enter your email" />
            </div>
            <div
              class="mt-2 flex w-full flex-shrink-0 rounded-md shadow-sm sm:mt-0 sm:ml-3 sm:inline-flex sm:w-auto">
              <button
                type="button"
                class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:inline-flex sm:w-auto">
                Notify me
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="mt-6 gap-16 pt-10 lg:gap-y-12">
        <div v-if="loading">Loading...</div>
        <div v-if="error">Error loading post</div>
        <div v-if="posts">THeres data heree somewhere</div>
        There are {{ posts.length }} posts
        {{ status }}

        <div v-for="post in posts" :key="post.id">
          <div class="space-y-2">
            <div class="space-y-1 text-lg font-medium leading-6">
              <h3>{{ post.title }}</h3>
              <p class="text-indigo-600">{{ post.author }}</p>
            </div>
            <div class="text-lg">
              <p class="text-gray-500">{{ post.publish_date }}</p>
            </div>
            <div class="prose max-w-none text-gray-500">Stuff</div>
          </div>
        </div>
        Hi
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'BlogList',
  data() {
    return {
      posts: [],
      loading: false,
      error: false,
      status: '',
    };
  },
  created() {
    this.fetchPosts();
  },
  methods: {
    fetchPosts() {
      (this.loading = true),
        axios
          .get('/api/blog')
          .then((response) => {
            this.posts = response.data;
            this.status = response.status;
          })
          .catch((error) => {
            this.error = true;
            this.loading = false;
            this.status = error.response.status;
          })
          .finally(() =>
            (this.loading = false)((this.status = response.status))
          );
    },
  },
};
</script>
