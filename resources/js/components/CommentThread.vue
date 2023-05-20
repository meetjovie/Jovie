<template>
  <div class="pl-6">
    <div class="pb-2 pt-6">
      <h2 class="text-sm font-semibold">Comments</h2>
    </div>
    <div>
      <ul role="list" class="divide-y divide-slate-200">
        <li v-for="comment in comments" :key="comment.id" class="py-4">
          <div class="flex space-x-3">
            <ContactAvatar :contact="comment.user" :height="10" />
            <div class="flex-1 space-y-1">
              <div class="flex items-center justify-between">
                <h3 class="text-sm font-medium">
                  {{ comment.user.first_name }}
                </h3>
                <p class="text-sm text-slate-500">
                  {{ formatDate(comment.created_at) }}
                </p>
              </div>
              <p class="text-sm text-slate-500">
                {{ comment.comment }}
              </p>
            </div>
          </div>
        </li>
      </ul>
      <div class="border-t border-slate-200 py-4 text-sm">
        <a
          href="#"
          @click="$emit('getComments', -1)"
          class="font-semibold text-indigo-600 hover:text-indigo-900"
          >View more... <span aria-hidden="true">&rarr;</span></a
        >
      </div>
    </div>
  </div>
</template>
<script>
import ContactAvatar from './ContactAvatar.vue';

export default {
  name: 'CommentThread',
  components: { ContactAvatar },
  props: ['comments'],
  data() {
    return {};
  },
};
</script>
