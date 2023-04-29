<template>
  <div :class="'h-' + height + ' w-' + height + ' flex-shrink-0'">
    <div
      class="rounded-full bg-slate-400 p-0.5 dark:bg-jovieDark-600"
      v-if="contact.profile_pic_url || defaultImage">
      <div class="rounded-full bg-white p-0 dark:bg-jovieDark-900">
        <img
          :class="
            'h- rounded-full object-cover object-center' +
            height +
            ' w-' +
            height
          "
          :src="contact.profile_pic_url || defaultImage"
          @error="contact.profile_pic_url = defaultImage"
          :alt="
            contact.full_name
              ? contact.full_name + ' Profile Picture'
              : 'Profile Picture'
          " />
        <div v-if="editable" class="absolute bottom-0 right-0">
          <div class="rounded-full bg-white/0 p-0.5">
            <PencilIcon
              class="h-4 w-4 text-slate-900 dark:text-jovieDark-100" />
          </div>
        </div>
      </div>
    </div>

    <div
      v-else
      class="h-full w-full animate-pulse rounded-full bg-slate-400 p-0.5 dark:bg-jovieDark-600"></div>
  </div>
</template>

<script>
import { PencilIcon } from '@heroicons/vue/24/solid';

export default {
  props: {
    contact: { type: Object, required: true },
    editable: { type: Boolean, default: false },
    height: { type: Number, default: 8 },
  },
  data: () => ({ defaultImage: 'img/noimage.webp' }),
  components: { PencilIcon },
};
</script>
