<template>
  <div
    class="flex w-full overflow-x-scroll rounded-md border-2 border-gray-200 bg-gray-50 px-2 py-1">
    <div class="flex overflow-x-scroll" v-if="lists.length > 0">
      <div v-for="item in lists" class="mr-2 flex">
        <div
          class="mr-1 flex items-center justify-between rounded bg-gray-200 px-1 text-xs font-medium text-gray-800 shadow-md hover:bg-gray-200">
          <div class="flex">
            <span class="mr-1 select-none text-2xs">{{ item.emoji }}</span>
            <span class="select-none text-2xs line-clamp-1">{{
              item.name
            }}</span>
          </div>
          <XMarkIcon
            @click="toggleCreatorsFromList(item.creator_id, item.id, true)"
            class="h-3 w-3 cursor-pointer text-gray-400 hover:text-gray-500"></XMarkIcon>
        </div>
      </div>
    </div>
    <div
      v-else
      class="mr-1 flex select-none items-center justify-between rounded px-1 text-xs font-medium text-gray-400">
      <div class="flex">
        <span class="mr-1 text-2xs"><PlusIcon /></span>
        <span class="text-2xs line-clamp-1">Not in any lists...</span>
      </div>
    </div>
  </div>
</template>
<script>
import { XMarkIcon, PlusIcon } from '@heroicons/vue/24/solid';
export default {
  components: {
    XMarkIcon,
    PlusIcon,
  },
  data() {
    return {
      lists: [],
    };
  },
  props: {
    lists: {
      type: Array,
      default: [],
    },
    currentList: {
      type: String,
    },
  },
  methods: {
    toggleCreatorsFromList(ids, list, remove) {
      this.$store
        .dispatch('toggleCreatorsFromList', {
          creator_ids: ids,
          list: list,
          remove: remove,
        })
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
            if (list == this.currentList) {
              this.$store.commit(
                'setCrmRecords',
                this.$store.state.crmRecords.filter(
                  (creator) => creator.id != ids
                )
              );
              this.$store.state.ContactSidebarOpen = false;
            }
          } else {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {});
    },
  },
};
</script>
