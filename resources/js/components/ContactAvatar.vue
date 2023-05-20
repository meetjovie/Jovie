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
        v-else-if="hasProfilePic">
        <div class="dark:bg-jovieDark-950 rounded-full bg-white p-0">
          <span class="relative inline-block">
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
            <span
              v-if="editable"
              class="mx-auto hidden h-full w-full items-center rounded-full group-hover:block">
              <PencilIcon
                class="mx-auto h-1/2 w-1/2 items-center text-slate-400/50 dark:text-jovieDark-300" />
            </span>
          </span>
        </div>
      </div>
      <span
        v-else
        :class="'h-' + height + ' w-' + height"
        class="group inline-flex items-center justify-center rounded-full bg-slate-500 dark:bg-jovieDark-600">
        <span class="relative inline-block">
          <span
            :class="[
              editable
                ? 'block group-hover:hidden'
                : height == 8
                ? 'text-xs'
                : height == 12
                ? 'text-sm'
                : height == 18
                ? 'text-xl'
                : height == 24
                ? 'text-2xl'
                : height == 32
                ? 'text-3xl'
                : height == 40
                ? 'text-4xl'
                : height == 48
                ? 'text-5xl'
                : height == 56
                ? 'text-6xl'
                : height == 64
                ? 'text-7xl'
                : 'text-xs',
            ]"
            class="font-medium capitalize leading-none text-white"
            >{{ intials }}</span
          >
          <span
            v-if="editable"
            class="mx-auto hidden h-full w-full items-center rounded-full group-hover:block">
            <PencilIcon
              class="mx-auto h-1/3 w-1/3 items-center text-white/50 dark:text-jovieDark-300/50" />
          </span>
        </span>
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
    loading: { type: Boolean, default: false },
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
    hasProfilePic() {
      return this.contact.profile_pic_url && !this.imageLoadError;
    },
    hasErrorOrNoProfilePic() {
      return !this.hasProfilePic || this.imageLoadError;
    },
    intials() {
      if (this.contact.full_name) {
        return this.contact.full_name
          .split(' ')
          .map((n) => n[0])
          .join('');
      } else {
        const firstInitial = this.contact.first_name[0];
        const lastInitial = this.contact.last_name[0];
        return firstInitial + lastInitial;
      }
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
