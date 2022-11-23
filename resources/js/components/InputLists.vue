<template>
  <div class="flex w-full items-center overflow-auto py-2 px-2">
    <div class="mr-1 flex">
      <div v-for="item in lists" class="mr-2 flex" :key="item.order">
        <div
          class="mr-1 flex items-center justify-between rounded-full border border-gray-200 px-1 text-xs font-medium text-gray-800 hover:bg-gray-50">
          <div class="flex w-full line-clamp-1">
            <span class="mr-1"> {{ item.emoji }}</span>
            <span class="w-14 select-none text-ellipsis text-2xs">{{
              item.name
            }}</span>
          </div>
          <XMarkIcon
            @click="toggleCreatorsFromList(item.creator_id, item.id, true)"
            class="h-3 w-3 cursor-pointer text-gray-400 hover:text-gray-500"></XMarkIcon>
        </div>
      </div>
    </div>

    <JovieDropdownMenu
      :items="lists"
      class="items-center"
      searchText="Find a list...">
      <template #triggerButton>
        <div
          :class="{ 'px-2': lists.length > 0 }"
          class="group cursor-pointer items-center rounded-full border border-transparent px-2 py-0.5 hover:border-gray-200 hover:bg-gray-50">
          <div class="flex items-center">
            <PlusIcon
              class="mr-1 h-3 w-3 text-gray-400 group-hover:text-gray-700" />
            <span
              v-if="!lists.length > 0"
              class="text-2xs font-light text-gray-400 group-hover:text-gray-700"
              >Add to a list</span
            >
          </div>
        </div>
      </template>
    </JovieDropdownMenu>
  </div>
</template>
<script>
import { XMarkIcon, PlusIcon } from '@heroicons/vue/24/solid';
import JovieDropdownMenu from './../components/JovieDropdownMenu.vue';
export default {
  components: {
    XMarkIcon,
    PlusIcon,
    JovieDropdownMenu,
  },
  data() {
    return {
      lists: [],
    };
  },
  props: {
    lists: {
      type: Array,
      default: () => [],
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
