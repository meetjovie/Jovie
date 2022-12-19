<template>
  <div class="flex w-full items-center overflow-auto py-2 px-2">
    <div class="mr-1 flex">
      <div v-for="item in lists" class="mr-2 flex" :key="item.order">
        <div
          class="mr-1 flex items-center justify-between rounded-full border border-slate-200 px-1 text-xs font-medium text-slate-800 hover:bg-slate-50 dark:border-jovieDark-border dark:text-jovieDark-200 dark:hover:bg-jovieDark-900">
          <div class="flex w-full items-center">
            <span class="mr-1"> {{ item.emoji }}</span>
            <span class="w-18 select-none truncate text-ellipsis text-2xs">{{
              item.name
            }}</span>
          </div>
          <XMarkIcon
            @click="toggleCreatorsFromList(creatorId, item.id, true)"
            class="h-3 w-3 cursor-pointer text-slate-400 hover:text-slate-500 dark:text-jovieDark-400 dark:hover:text-slate-300"></XMarkIcon>
        </div>
      </div>
    </div>
    <div>
      <JovieDropdownMenu
        createIfNotFound
        @createItem="createList($event, name)"
        :placement="'bottom-start'"
        @itemClicked="setListAction($event)"
        :items="userLists"
        class="items-center"
        searchText="Find a list...">
        <template #triggerButton>
          <div
            :class="{ 'px-2': userLists.length > 0 }"
            class="group cursor-pointer items-center rounded-full border border-transparent px-2 py-0.5 hover:border-slate-200 dark:hover:border-jovieDark-border dark:hover:bg-jovieDark-900">
            <div class="flex items-center">
              <PlusIcon
                class="h-3 w-3 text-slate-400 group-hover:text-slate-700" />
              <span
                v-if="!userLists.length > 0"
                class="ml-1 text-2xs font-light text-slate-400 group-hover:text-slate-700 dark:text-jovieDark-400 dark:group-hover:text-slate-700"
                >Add to a list</span
              >
            </div>
          </div>
        </template>
      </JovieDropdownMenu>
    </div>
  </div>
</template>
<script>
import { XMarkIcon, PlusIcon } from '@heroicons/vue/24/solid';
import JovieDropdownMenu from './../components/JovieDropdownMenu.vue';
import UserService from '../services/api/user.service';
export default {
  components: {
    XMarkIcon,
    PlusIcon,
    JovieDropdownMenu,
  },
  data() {
    return {
      lists: [],
      userLists: [],
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
    creatorId: {
      type: Number,
    },
  },
  mounted() {
    this.getUserLists();
  },
  methods: {
    createList(name) {
      UserService.createList(name).then((response) => {
        response = response.data;
        if (response.status) {
          this.$notify({
            group: 'user',
            type: 'success',
            duration: 15000,
            title: 'Successful',
            text: response.message,
          });
          this.userLists.push(response.list);
          this.setListAction(response.list.id);
        } else {
          this.$notify({
            group: 'user',
            type: 'success',
            duration: 15000,
            title: 'Successful',
            text: response.message,
          });
        }
      });
    },
    getUserLists() {
      UserService.getUserLists().then((response) => {
        response = response.data;
        if (response.status) {
          this.userLists = [];
          this.userLists = response.lists;
        }
      });
    },
    setListAction(id) {
      this.toggleCreatorsFromList(this.creatorId, id, false);
    },
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
            response.list.creator_id = this.creatorId;
            this.$emit('updateLists', { list: response.list, add: !remove });
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
