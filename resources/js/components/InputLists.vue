<template>
  <div class="flex h-6 w-full items-center overflow-auto px-2">
    <div class="mr-1 flex">
      <div v-for="item in lists" class="mr-2 flex" :key="item.order">
        <div
          class="mr-1 flex items-center justify-between rounded-full border border-slate-200 px-2 py-0.5 text-xs font-medium text-slate-800 hover:bg-slate-50 dark:border-jovieDark-border dark:text-jovieDark-200 dark:hover:bg-jovieDark-900">
          <div class="flex w-full items-center">
            <span class="mr-1 text-[8px]"> {{ item.emoji }}</span>
            <span
              class="w-18 select-none items-center truncate text-ellipsis text-2xs"
              >{{ item[nameKey] }}</span
            >
          </div>
          <XMarkIcon
            v-if="isSelect"
            @click="$emit('itemRemoved', item.id)"
            class="ml-1 h-3 w-3 cursor-pointer items-center text-slate-400 hover:text-slate-500 dark:text-jovieDark-400 dark:hover:text-slate-300"></XMarkIcon>
          <XMarkIcon
            v-else
            @click="toggleCreatorsFromList(creatorId, item.id, true)"
            class="ml-1 h-3 w-3 cursor-pointer items-center text-slate-400 hover:text-slate-500 dark:text-jovieDark-400 dark:hover:text-slate-300"></XMarkIcon>
        </div>
      </div>
    </div>
    <div>
      <JovieDropdownMenu
        :createIfNotFound="! isSelect"
        @createItem="createList($event)"
        :placement="'bottom-start'"
        @itemClicked="isSelect ? $emit('itemClicked', $event) : setListAction($event)"
        :items="items"
        :nameKey="nameKey"
        class="items-center"
        :searchText="searchText">
        <template #triggerButton>
          <div
            :class="{ 'px-2': items.length > 0 }"
            class="group cursor-pointer items-center rounded-full border border-transparent px-2 py-1 hover:border-slate-300 hover:bg-slate-50 dark:hover:border-jovieDark-border dark:hover:bg-jovieDark-900">
            <div class="flex items-center">
              <PlusIcon
                class="h-3 w-3 text-slate-400 group-hover:text-slate-700" />
              <span
                v-show="lists.length === 0"
                class="ml-1 text-2xs font-light text-slate-400 group-hover:text-slate-700 dark:text-jovieDark-400 dark:group-hover:text-slate-700">
                {{ isSelect ? 'Select' : 'Add to a list' }}
              </span>
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
      items: [],
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
    nameKey: {
      type: String,
      default: 'name',
    },
    isSelect: {
      Type: Boolean,
      default: false,
    },
    showLabel: {
      type: Boolean,
      default: false,
      required: false,
    },
    options: {
      type: Array,
    },
    searchText: {
      type: String,
      default: 'Find a list...',
      required: false,
    },
  },
  mounted() {
    if (this.isSelect) {
      this.items = this.options;
    } else {
      this.getUserLists();
    }
  },
  methods: {
    createList(name, emoji = undefined) {
      //based on the name make a request to openai to get the emoji
      // {
      // "model": "text-davinci-003",
      // "prompt": "Generate a single emoji based on the list name provided.\n\nList name: People in LA\nEmoji: \n\n\n\n\n\n\n\n 🌴",
      // "temperature": 0.7,
      // "max_tokens": 4,
      // "top_p": 1,
      // "frequency_penalty": 0,
      // "presence_penalty": 0
      // }

      let data = {
        name: name,
        emoji: emoji,
      };
      this.creatingList = true;
      UserService.createList(data)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Created ' + response.list.name,
              text: response.message,
            });
            this.$emit('setFilterList', response.list.id);
            this.enableEditName(response.list);
          } else {
            // show toast error here later
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: Object.values(error.data.errors)[0][0],
            });
          }
        })
        .finally((response) => {
          this.creatingList = false;
          this.$emit('getUserLists');
        });
    },
    getUserLists() {
      UserService.getUserLists().then((response) => {
        response = response.data;
        if (response.status) {
          this.items = [];
          this.items = response.lists;
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
