<template>
  <div class="flex items-center">
    <JovieSpinner class="mr-1" spinnerSize="xs" v-if="loading" />
    <EmojiPickerModal
      v-else
      class="mr-1"
      @emojiSelected="emojiSelected($event)"
      :currentEmoji="list.emoji" />
    <div
      @dblclick="enableEditName(list)"
      class="w-full cursor-pointer items-center">
      <span
        v-if="!list.editName"
        class="line-clamp-1 cursor-pointer text-xs group-hover/list:text-slate-800 dark:text-slate-200 dark:group-hover/list:text-slate-200"
        >{{ list.name }}</span
      >
      <input
        v-model="list.name"
        :ref="`list_${list.id}`"
        @keyup.esc="disableEditName(list)"
        @keyup.enter="updateList(list)"
        @blur="updateList(list)"
        v-else
        class="rounded-md border px-2 text-xs font-light text-slate-700 group-hover/list:text-slate-800 dark:border-jovieDark-border dark:bg-jovieDark-900 dark:text-jovieDark-200 dark:text-jovieDark-300 dark:group-hover/list:text-slate-200" />
    </div>
  </div>
</template>

<script>
import EmojiPickerModal from '../../components/EmojiPickerModal.vue';
import UserService from '../../services/api/user.service';
import JovieSpinner from '../../components/JovieSpinner.vue';

export default {
  name: 'UserListEditable',
  components: {
    EmojiPickerModal,
    JovieSpinner,
  },
  props: {
    list: {
      type: Object,
      required: true,
    },

    loading: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      currentEditingList: null,
    };
  },
  methods: {
    emojiSelected(emoji) {
      this.list.emoji = emoji;
      this.updateList(this.list);
      //if triggered from an item set the item emoji to the selected emoji if triggered from an element  set the element emoji to the selected emoji
    },
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
    },
    updateList(item) {
      item.updating = true;
      UserService.updateList({ name: item.name, emoji: item.emoji }, item.id)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
            this.$emit('updateUserList', response.data);
            // if (this.$refs[`list_${item.id}`]) {
            //     this.$refs[`list_${item.id}`].blur();
            // }
            item.editName = false;
            this.currentEditingList = null;
          } else {
            // show toast error here later
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
            this.enableEditName(item, true);
          }
        })
        .catch((error) => {
          console.log('errorerrorerrorerror');
          console.log(error);
          error = error.response;
          if (error.status == 422) {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: Object.values(error.data.errors)[0][0],
            });
            this.enableEditName(item, true);
          }
        })
        .finally((response) => {
          item.updating = false;
        });
    },
  },
};
</script>

<style scoped></style>
