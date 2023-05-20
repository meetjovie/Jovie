<template>
  <div :class="'h-' + height + ' w-' + height + ' flex-shrink-0'">
    <label :for="`profile_pic_url_${contact.id}`">
      <div
        class="rounded-full bg-slate-400 p-0.5 dark:bg-jovieDark-600"
        v-if="updating">
        <div class="dark:bg-jovieDark-950 rounded-full bg-white p-1">
          <img
            class="rounded-full object-cover object-center"
            :class="'h-' + height + ' w-' + height"
            :ref="`profile_pic_url_img_${contact.id}`"
            :id="`profile_pic_url_img_${contact.id}`"
            :src="contact.profile_pic_url"
            @error="imageLoadError = true"
            :alt="
              contact.full_name
                ? contact.full_name + ' Profile Picture'
                : 'Profile Picture'
            " />
          {{ uploadProgress }}
        </div>
      </div>
      <div
        v-else-if="loading"
        :class="'h-' + height + ' w-' + height"
        class="animate-pulse rounded-full bg-slate-400 p-0.5 dark:bg-jovieDark-600"></div>
      <div
        class="rounded-full bg-slate-400 p-0.5 dark:bg-jovieDark-600"
        v-else-if="contact.profile_pic_url && !imageLoadError">
        <div class="dark:bg-jovieDark-950 rounded-full bg-white p-0">
          <img
            :class="
              'h- rounded-full object-cover object-center' +
              height +
              ' w-' +
              height
            "
            :ref="`profile_pic_url_img_${contact.id}`"
            :id="`profile_pic_url_img_${contact.id}`"
            :src="contact.profile_pic_url"
            @error="imageLoadError = true"
            :alt="
              contact.full_name
                ? contact.full_name + ' Profile Picture'
                : 'Profile Picture'
            " />
        </div>
      </div>
      <span
        v-else
        :class="'h-' + height + ' w-' + height"
        class="inline-flex items-center justify-center rounded-full bg-gray-500">
        <span
          :class-name="[
            height < 8
              ? 'text-xs'
              : height < 12
              ? 'text-sm'
              : height < 18
              ? 'text-xl'
              : 'text-4xl',
          ]"
          class="font-medium capitalize leading-none text-white"
          >{{ intials }}</span
        >
      </span>
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
    loading: { type: Boolean, default: true },
  },
  data() {
    return {
      defaultImage: 'img/noimage.webp',
      updating: false,
      imageLoadError: false,
    };
  },
  components: { PencilIcon },
  computed: {
    intials() {
      return this.contact.full_name
        ? this.contact.full_name
            .split(' ')
            .map((n) => n[0])
            .join('')
        : 'A';
    },
  },
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
          });
        }
        document.getElementById(`profile_pic_url_img_${this.contact.id}`).src =
          src;
      });
    },
  },
};
</script>
