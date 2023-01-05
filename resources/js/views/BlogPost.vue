<template>
  <div>
    <div v-if="loading">Loading...</div>
    <div v-if="error">Error loading post</div>
    <div v-if="post">
      <h1>{{ post.title }}</h1>
      <p>{{ post.author }}</p>
      <p>{{ post.publish_date }}</p>
      <div v-html="post.html"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BlogPost',
  data() {
    return {
      post: null,
      loading: true,
      error: false,
    };
  },
  created() {
    this.fetchPost();
  },
  methods: {
    fetchPost() {
      axios
        .get('/api/blog/' + this.$route.params.id)
        .then((response) => {
          this.post = response.data;
        })
        .catch((error) => {
          this.error = true;
        })
        .finally(() => (this.loading = false));
    },
  },
};
</script>
