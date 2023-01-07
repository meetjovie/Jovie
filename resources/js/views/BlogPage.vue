<template>
  <div class="bg-white px-6 pt-16 pb-20 lg:px-8 lg:pt-24 lg:pb-28">
    <Suspense>
      <template #default>
        <BlogList />
      </template>
      <template #fallback>
        <div class="flex justify-center">Loading...</div>
      </template>
    </Suspense>
  </div>
</template>

<script>
import BlogList from './../components/BlogList.vue';

export default {
  name: 'BlogPage',
  components: {
    BlogList,
  },
};
</script>
