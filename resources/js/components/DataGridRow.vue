<template>
  <tr
    class="group w-full flex-row overflow-y-visible focus-visible:ring-indigo-700"
    :class="[
      currentContact.id == creator.id
        ? 'border border-jovieDark-300 bg-slate-100 dark:border-jovieDark-border dark:bg-jovieDark-700'
        : 'bg-white dark:bg-jovieDark-900',
    ]">
    <DataGridCell
      :visibleColumns="visibleColumns"
      :currentContact="currentContact"
      :creator="creator"
      :row="row"
      freezeColumn
      type="checkbox"
      width="6"
      class="left-0 before:absolute before:left-0 before:top-0 before:h-full before:border-l before:border-slate-300 before:content-['']">
      <div class="group mx-auto w-6 items-center">
        <span
          class="group-hover:block"
          :class="[
            {
              hidden: !selectedCreators.includes(creator.id),
            },
            'block',
          ]">
          <form>
            <CheckboxInput v-model="selectedCreators" :value="creator.id" />
          </form>
        </span>
        <span
          class="text-xs font-light text-slate-600 group-hover:hidden dark:text-jovieDark-400"
          :class="[{ hidden: selectedCreators.includes(creator.id) }, 'block']">
          {{ row + 1 }}
        </span>
      </div>
    </DataGridCell>
    <DataGridCell
      :visibleColumns="visibleColumns"
      :currentContact="currentContact"
      :creator="creator"
      :row="row"
      freezeColumn
      width="4"
      class="left-[26.5px] overflow-auto border-y border-slate-300 px-2 text-center text-xs font-bold text-slate-300 group-hover:text-slate-500 dark:border-jovieDark-border dark:text-jovieDark-700 dark:group-hover:text-slate-400">
      <div
        class="hidden cursor-pointer items-center lg:block"
        @click="
          $emit('updateCreator', {
            id: creator.id,
            index: row,
            key: `crm_record_by_user.favourite`,
            value: !creator.crm_record_by_user.favourite,
          })
        ">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          :class="{
            'fill-red-500 text-red-500': creator.crm_record_by_user.favourite,
          }"
          class="-mt-.5 h-3 w-3 hover:fill-red-500 hover:text-red-500"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
      </div>
    </DataGridCell>
    <DataGridCell
      :visibleColumns="visibleColumns"
      :currentContact="currentContact"
      :creator="creator"
      :row="row"
      freezeColumn
      width="60"
      v-on:dblclick="cellActive"
      class="border-seperate left-[55px] cursor-pointer border-y border-slate-300 pl-2 pr-0.5 after:absolute after:right-[-1px] after:top-0 after:h-full after:border-r-2 after:border-slate-300 after:content-[''] dark:border-jovieDark-border dark:after:border-jovieDark-border">
      <div class="flex items-center justify-between">
        <div
          @click="$emit('openSidebar', { contact: creator, index: row })"
          class="flex w-full items-center">
          <ContactAvatar :creator="creator" class="mr-2" />
          <div
            v-if="cellActive"
            class="items-center text-sm text-slate-900 line-clamp-1 dark:text-jovieDark-100">
            <input
              v-model="creator.meta.name"
              @blur="$emit('updateCrmMeta', creator)"
              autocomplete="off"
              type="creator-name"
              name="creator-name"
              id="creator-name"
              class="block w-full bg-white/0 px-2 py-1 placeholder-slate-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 dark:bg-jovieDark-900/0 dark:placeholder-slate-700 sm:text-xs"
              placeholder="Name"
              aria-describedby="name-description" />
          </div>
          <div
            v-else
            class="text-sm text-slate-900 line-clamp-1 dark:text-jovieDark-100">
            {{ creator.meta.name }}
          </div>
        </div>
        <div
          @click="$emit('openSidebar', { contact: creator, index: row })"
          class="mx-auto h-6 w-6 items-center rounded-full bg-slate-200/0 pr-4 text-center text-slate-400 transition-all active:border active:bg-slate-200 dark:text-jovieDark-300 dark:active:bg-slate-800">
          <ArrowTopRightOnSquareIcon
            v-if="
              !$store.state.ContactSidebarOpen ||
              currentContact.id !== creator.id
            "
            class="mx-auto mt-0.5 ml-0.5 hidden h-4 w-4 group-hover:block" />
          <XMarkIcon
            v-else
            class="mx-auto ml-1 mt-1 hidden h-4 w-4 group-hover:block" />
        </div>
        <div>
          <ContactContextMenu
            :open="creator.showContextMenu"
            :creator="creator">
            <DropdownMenuItem
              :name="
                filters.type == 'archived' &&
                creator.crm_record_by_user.archived
                  ? 'Unarchived'
                  : 'Archive'
              "
              icon="ArchiveBoxIcon"
              @blur="$emit('updateCrmMeta')"
              @click="
                $emit(
                  'archive-creators',
                  creator.id,
                  !creator.crm_record_by_user.archived
                )
              "
              color="text-blue-600
            dark:text-blue-400" />
            <DropdownMenuItem
              name="Refresh"
              color="text-green-600 dark:text-green-400"
              icon="ArrowPathIcon"
              @click="$emit('refresh', creator)" />
            <DropdownMenuItem
              name="Remove from list"
              icon="TrashIcon"
              color="text-red-600 dark:text-red-400"
              @click="
                $emit(
                  'toggleCreatorsFromList',
                  ...{ id: creator.id, list: filters.list, remove: true }
                )
              " />
          </ContactContextMenu>
        </div>
      </div>
    </DataGridCell>

    <template v-for="(column, columnIndex) in otherColumns" :key="row">
      <DataGridCell
        v-if="column.custom"
        :visibleColumns="visibleColumns"
        :settings="settings"
        :currentContact="currentContact"
        :creator="creator"
        :cellActive="
          currentCell.row == row && currentCell.column == columnIndex
        "
        :currentCell="currentCell"
        :columnIndex="columnIndex"
        :rowIndex="row"
        :networks="networks"
        :stages="stages"
        :column="column"
        @updateCreator="$emit('updateCreator', $event)"
        v-model="creator.crm_record_by_user[column.key]"
        :row="row" />
      <DataGridCell
        v-else-if="column.meta"
        :visibleColumns="visibleColumns"
        :settings="settings"
        :currentContact="currentContact"
        :creator="creator"
        :cellActive="
          currentCell.row == row && currentCell.column == columnIndex
        "
        @update:currentCell="handleCellUpdate"
        :currentCell="currentCell"
        :columnIndex="columnIndex"
        :rowIndex="row"
        :networks="networks"
        :stages="stages"
        :column="column"
        @updateCreator="$emit('updateCreator', $event)"
        @updateCrmMeta="$emit('updateCrmMeta', creator)"
        @updateCreatorLists="updateCreatorLists"
        @blur="$emit('updateCrmMeta', creator)"
        v-model="creator.meta[column.key]"
        :row="row" />
      <DataGridCell
        v-else
        :visibleColumns="visibleColumns"
        :settings="settings"
        :currentContact="currentContact"
        :creator="creator"
        :cellActive="
          currentCell.row == row && currentCell.column == columnIndex
        "
        @update:currentCell="handleCellUpdate"
        :currentCell="currentCell"
        :columnIndex="columnIndex"
        :rowIndex="row"
        :networks="networks"
        :stages="stages"
        :column="column"
        @updateCreator="$emit('updateCreator', $event)"
        @updateCrmMeta="$emit('updateCrmMeta', creator)"
        @updateCreatorLists="updateCreatorLists"
        @blur="$emit('updateCrmMeta', creator)"
        v-model="creator[column.key.split('.')[0]][column.key.split('.')[1]]"
        :row="row" />
    </template>
  </tr>
</template>
<script>
import DataGridCell from './DataGridCell.vue';
import ContactContextMenu from './ContactContextMenu.vue';
import ContactAvatar from './ContactAvatar.vue';
import DropdownMenuItem from './DropdownMenuItem.vue';
import CheckboxInput from './CheckboxInput.vue';
import {
  ArrowTopRightOnSquareIcon,
  XMarkIcon,
} from '@heroicons/vue/24/outline';

export default {
  name: 'DataGridRow',
  components: {
    DataGridCell,
    ContactContextMenu,
    DropdownMenuItem,
    ContactAvatar,
    CheckboxInput,
    ArrowTopRightOnSquareIcon,
    XMarkIcon,
  },
  mounted() {},
  methods: {
    updateCreatorLists({ list, add = false }) {
      if (add) {
        this.creator.lists.push(list);
      } else {
        this.creator.lists = this.creator.lists.filter((l) => l.id != list.id);
      }
      this.$emit('updateListCount', {
        count: 1,
        list_id: list.id,
        remove: !add,
        creatorIds: [this.creator.id],
      });
    },
    handleCellUpdate(payload) {
      // Handle the "update:currentCell" event emitted by the cell component
      this.$emit('update:currentCell', payload); // Emit a new event to the parent table component
    },
  },
  props: {
    currentCell: Object,
    networks: Array,
    stages: Array,
    visibleColumns: Array,
    settings: Object,
    filters: Object,
    currentContact: Object,
    creator: Object,
    selectedCreators: Array,
    row: Number,
    column: Number,
    freezeColumn: Boolean,
    width: String,
    columnName: String,
    neverHide: Boolean,
    cellActive: Boolean,
    otherColumns: Array,
    columnIndex: Number,
  },
};
</script>
