<template>
  <div :class="'h-' + height + ' w-' + height + ' flex-shrink-0'">
    <label :for="`profile_pic_url_${contact.id}`">
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
            :ref="`profile_pic_url_img_${contact.id}`"
            :id="`profile_pic_url_img_${contact.id}`"
            :src="contact.profile_pic_url || defaultImage"
            @error="contact.profile_pic_url = defaultImage"
            :alt="
              contact.full_name
                ? contact.full_name + ' Profile Picture'
                : 'Profile Picture'
            " />
        </div>
      </div>

      <div
        v-else
        class="h-full w-full animate-pulse rounded-full bg-slate-400 p-0.5 dark:bg-jovieDark-600"></div>
    </label>
    <input
      :disabled="updating || !editable"
      type="file"
      :ref="`profile_pic_url_${contact.id}`"
      @change="fileChanged($event)"
      name="profile_pic_url"
      :id="`profile_pic_url_${contact.id}`"
      style="display: none" />
  </div>
</template>

<script>
import { PencilIcon } from '@heroicons/vue/24/solid';

export default {
  name: 'ContactAvatar',
  props: {
    contact: { type: Object, required: true },
    editable: { type: Boolean, default: false },
    height: { type: Number, default: 8 },
  },
  data() {
    return {
      defaultImage: 'img/noimage.webp',
      updating: false,
    };
  },
  components: { PencilIcon },
  methods: {
    fileChanged(e) {
      let self = this;
      this.uploadProgress = 0;
      const src = URL.createObjectURL(e.target.files[0]);
      Vapor.store(e.target.files[0], {
        visibility: 'public-read',
        progress: (progress) => {
          this.uploadProgress = Math.round(progress * 100);
        },
      }).then((response) => {
          if (response.uuid) {
              this.$nextTick(() => {
                  self.$emit('updateAvatar', response.uuid);
              })
          }
          document.getElementById(`profile_pic_url_img_${this.contact.id}`).src =
              src;
      });
    },
  },
};
</script>
