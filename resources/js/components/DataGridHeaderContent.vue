<template>
  <div class="flex w-full items-center">
    <div class="w-10 px-2">
      <JovieSpinner v-if="taskLoading" />
    </div>
    <div class="h-10 items-center px-4">
      <h1
        v-if="!loading"
        class="flex items-center text-sm font-semibold capitalize text-slate-900 dark:text-jovieDark-100">
          <template v-if="list">
              <EmojiPickerModal
                  class="mr-1"
                  :currentEmoji="list.emoji" />
              <div
                  @dblclick="enableEditName(list)"
                  class="w-full cursor-pointer">
                    <span
                        v-if="!list.editName"
                        class="cursor-pointer text-xs line-clamp-1 group-hover/list:text-slate-800 dark:group-hover/list:text-slate-200"
                    >{{ list.name }}</span
                    >
                  <input
                      v-model="list.name"
                      :ref="`list_${list.id}`"
                      @keyup.esc="disableEditName(list)"
                      v-else
                      class="text-xs font-light text-slate-700 group-hover/list:text-slate-800 dark:text-jovieDark-300 dark:group-hover/list:text-slate-200" />
              </div>
          </template>
          <template v-else>
              <component
                  :is="icon"
                  :class="iconColor"
                  class="mr-1 h-4 w-4 rounded-md text-purple-400"
                  aria-hidden="true" />
              {{ headerText + ' Contacts' }}
          </template>
      </h1>
      <h1
        v-else
        class="mr-2 h-4 w-60 animate-pulse rounded-sm bg-slate-300"></h1>
      <p
        v-if="!loading && contactCount !== undefined"
        class="text-2xs font-light text-slate-600">
        {{ contactCount + ' Contacts' }}
      </p>
      <p v-else class="h-3 w-20 animate-pulse rounded-sm bg-slate-300"></p>
    </div>
  </div>
</template>
<script>
import { UserGroupIcon, HeartIcon, UserIcon, ArchiveBoxIcon } from '@heroicons/vue/24/solid';
import JovieSpinner from './JovieSpinner.vue';
import EmojiPickerModal from '../components/EmojiPickerModal.vue';

export default {
  props: {
    header: {
      type: String,
      required: true,
    },
    subheader: {
      type: Object,
      required: true,
    },
    loading: {
      type: Boolean,
      default: false,
    },
    taskLoading: {
      type: Boolean,
      default: false,
    },
    list: {
        type: Object,
        required: false,
    },
  },
  components: {
    UserGroupIcon,
    HeartIcon,
    UserIcon,
    ArchiveBoxIcon,
    JovieSpinner,
    EmojiPickerModal,
  },
    data() {
        return {
            currentEditingList: null,
        }
    },
    methods: {
        async enableEditName(item, fallBackFocus = false) {
            if (!fallBackFocus) {
                this.currentEditingList = JSON.parse(JSON.stringify(item));
            }
            item.editName = true;
            await this.$nextTick(() => {
                if (this.$refs[`list_${item.id}`]) {
                    this.$refs[`list_${item.id}`].focus();
                }
            });
        },
        disableEditName(item) {
            item.editName = false;
            item.name = this.currentEditingList.name;
        }
    },
  computed: {
      icon() {
      if (this.header.includes('all')) {
        return UserGroupIcon;
      } else if (this.header.includes('favourites')) {
        return HeartIcon;
      } else if (this.header.includes('archived')) {
          return ArchiveBoxIcon;
      } else {
        return UserIcon;
      }
    },
    iconColor() {
      if (this.header.includes('favourites')) {
        return 'text-red-400';
      } else if (this.header.includes('archive')) {
        return 'text-blue-400';
      } else {
        return 'text-purple-400';
      }
    },
    contactCount() {
      if (this.header.includes('all')) {
        return `${this.subheader.total}`;
      } else {
        return `${this.subheader[this.header]}`;
      }
    },
    headerText() {
      if (this.header.includes('favourites')) {
        return 'Favorited';
      } else {
        return this.header ?? '';
      }
    },
  },
};
</script>
