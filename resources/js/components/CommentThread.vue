<template>
  <div class="pl-6">
    <div class="pt-6 pb-2">
      <h2 class="text-sm font-semibold">Comment</h2>
    </div>
    <div>
      <ul role="list" class="divide-y divide-gray-200">
        <li v-for="comment in comments" :key="comment.id" class="py-4">
          <div class="flex space-x-3">
            <img
              class="h-6 w-6 rounded-full"
              src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=256&h=256&q=80"
              alt="" />
            <div class="flex-1 space-y-1">
              <div class="flex items-center justify-between">
                <h3 class="text-sm font-medium">{{ comment.user.name }}</h3>
                <p class="text-sm text-gray-500">{{ comment.time }}</p>
              </div>
              <p class="text-sm text-gray-500">
                {{ comment.text }}
              </p>
            </div>
          </div>
        </li>
      </ul>
      <div
        v-if="comments.length > 3"
        class="border-t border-gray-200 py-4 text-sm">
        <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-900"
          >View all comments <span aria-hidden="true">&rarr;</span></a
        >
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'CommentThread',
  data() {
    return {
      comments: [
        {
          id: 1,
          text: 'This is a comment',
          time: '5 minutes ago',
          user: {
            name: 'John Doe',
            avatar:
              'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=256&h=256&q=80',
          },
        },
        {
          id: 2,
          text: 'This is also a comment',
          time: '2 hours ago',
          user: {
            name: 'Jane Doe',
            avatar:
              'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=256&h=256&q=80',
          },
        },
      ],
    };
  },
};
</script>
