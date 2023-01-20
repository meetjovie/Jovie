<template>
  <div class="h-8 w-8 flex-shrink-0">
    <div class="rounded-full bg-slate-400 p-0.5 dark:bg-jovieDark-600">
      <div class="rounded-full bg-white p-0 dark:bg-jovieDark-900">
        <div v-if="editable" class="relative inline-block">
          <img
            v-if="creator.profile_pic_url"
            class="rounded-full object-cover object-center"
            :src="creator.profile_pic_url"
            @error="setDefaultImage"
            alt="Profile Image" />
          <img
            v-else
            class="rounded-full object-cover object-center"
            :src="defaultImage"
            alt="Default profile image" />
          <div class="absolute bottom-0 right-0">
            <div class="rounded-full bg-white/0 p-0.5">
              <PencilIcon
                class="h-4 w-4 text-slate-900 dark:text-jovieDark-100" />
            </div>
          </div>
        </div>
        <div v-else>
          <img
            v-if="creator.profile_pic_url"
            class="rounded-full object-cover object-center"
            :src="creator.profile_pic_url"
            @error="setDefaultImage"
            alt="Profile Image" />
          <img
            v-else
            class="rounded-full object-cover object-center"
            :src="defaultImage"
            alt="Default profile image" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { PencilIcon } from '@heroicons/vue/24/solid';
export default {
  components: {
    PencilIcon,
  },
  props: {
    creator: {
      type: Object,
      required: true,
    },
    editable: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      defaultImage: this.asset('img/noimage.webp'),
    };
  },
  methods: {
    setDefaultImage() {
      this.creator.profile_pic_url = this.defaultImage;
    },
  },
};
</script>
