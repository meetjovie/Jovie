<template>
  <tr
    class="group h-11 w-full flex-row items-center overflow-y-visible"
    :class="[
      currentContact.id == contact.id
        ? 'bg-slate-100  ring-2 ring-slate-300 dark:bg-jovieDark-700 dark:ring-indigo-400'
        : 'bg-white dark:bg-jovieDark-900',
    ]">
    <DataGridCell
      :visibleColumns="visibleColumns"
      :currentContact="currentContact"
      :contact="contact"
      :row="row"
      freezeColumn
      width="full"
      class="left-0 items-center overflow-auto before:absolute before:left-0 before:top-0 before:h-full before:border-l before:border-slate-300 before:content-['']">
      <div class="group mx-auto w-full items-center">
        <span
          class="group-hover:block"
          :class="[
            {
              hidden: !selectedContactsModel.includes(contact.id),
            },
            'block',
          ]">
          <form>
            <CheckboxInput v-model="selectedContactsModel" :value="contact.id" />
          </form>
        </span>
        <span
          class="text-xs font-light text-slate-600 group-hover:hidden dark:text-jovieDark-400"
          :class="[{ hidden: selectedContactsModel.includes(contact.id) }, 'block']">
          {{ row + 1 }}
        </span>
      </div>
    </DataGridCell>
    <DataGridCell
      :visibleColumns="visibleColumns"
      :currentContact="currentContact"
      :contact="contact"
      :row="row"
      freezeColumn
      width="4"
      class="left-[26.5px] overflow-auto border-slate-300 px-2 text-center text-xs font-bold text-slate-300 group-hover:text-slate-500 dark:border-jovieDark-border dark:text-jovieDark-700 dark:group-hover:text-slate-400">

        {{ ' ---------------- '}}
        {{ contact.enriching }}
        {{ ' ---------------- '}}
        {{ typeof contact.enriching }}
      <div v-if="contact.enriching > 0">
          Enriching
      </div>
      <div v-else @click="checkContactsEnrichable(currentContact.id)">
          Enrich
      </div>

      <div v-if="! contact.enriched_viewed">
          new
      </div>
      <div
        class="hidden cursor-pointer items-center lg:block"
        @click="
          $emit('updateContact', {
            id: contact.id,
            index: row,
            key: `favourite`,
            value: !contact.favourite,
          })
        ">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          :class="{
            'fill-red-500 text-red-500': contact.favourite,
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
      :contact="contact"
      :row="row"
      freezeColumn
      width="60"
      v-on:dblclick="cellActive"
      class="border-seperate overflow-x-noscroll left-[55px] cursor-pointer border-slate-300 pl-2 pr-0.5 after:absolute after:right-[-1px] after:top-0 after:h-full after:border-r-2 after:border-slate-300 after:content-[''] dark:border-jovieDark-border dark:after:border-jovieDark-border">
      <div class="flex items-center justify-between">
        <div
          @click="$emit('openSidebar', { contact: contact, index: row })"
          class="flex w-full items-center">
          <ContactAvatar :contact="contact" class="mr-2" />
          <div
            v-if="cellActive"
            class="items-center text-sm text-slate-900 line-clamp-1 dark:text-jovieDark-100">
            <input
              v-model="contact.full_name"
              @blur="$emit('updateContact', contact)"
              autocomplete="off"
              type="contact-name"
              name="contact-name"
              id="contact-name"
              class="block w-full bg-white/0 px-2 py-1 placeholder-slate-300 focus-visible:border-2 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 dark:bg-jovieDark-900/0 dark:placeholder-slate-700 sm:text-xs"
              placeholder="Name"
              aria-describedby="name-description" />
          </div>
          <div
            v-else
            class="text-sm text-slate-900 line-clamp-1 dark:text-jovieDark-100">
            {{ contact.full_name }}
          </div>
        </div>
        <div
          @click="$emit('openSidebar', { contact: contact, index: row })"
          class="mx-auto h-6 w-6 items-center rounded-full bg-slate-200/0 pr-4 text-center text-slate-400 transition-all active:border active:bg-slate-200 dark:text-jovieDark-300 dark:active:bg-slate-800">
          <ArrowTopRightOnSquareIcon
            v-if="
              !$store.state.ContactSidebarOpen ||
              currentContact.id !== contact.id
            "
            class="mx-auto mt-0.5 ml-0.5 hidden h-4 w-4 group-hover:block" />
          <XMarkIcon
            v-else
            class="mx-auto ml-1 mt-1 hidden h-4 w-4 group-hover:block" />
        </div>
        <div>
          <ContactContextMenu
            :open="contact.showContextMenu"
            :contact="contact">
            <DropdownMenuItem
              :name="
                filters.type == 'archived' &&
                contact.archived
                  ? 'Unarchived'
                  : 'Archive'
              "
              icon="ArchiveBoxIcon"
              @blur="$emit('updateContact')"
              @click="
                $emit(
                  'archive-contacts',
                  contact.id,
                  !contact.archived
                )
              "
              color="text-blue-600
            dark:text-blue-400" />
            <DropdownMenuItem
              name="Refresh"
              color="text-green-600 dark:text-green-400"
              icon="ArrowPathIcon"
              @click="$emit('refresh', contact)" />
            <DropdownMenuItem
              name="Remove from list"
              icon="TrashIcon"
              color="text-red-600 dark:text-red-400"
              @click="
                $emit(
                  'toggleContactsFromList',
                  ...{ id: contact.id, list: filters.list, remove: true }
                )
              " />
              <DropdownMenuItem
                  name="Contact Overview"
                  icon="TrashIcon"
                  color="text-red-600 dark:text-red-400"
                  @click="$router.push({name: 'Contact Overview', params: {id: contact.id}})" />
          </ContactContextMenu>
        </div>
      </div>
    </DataGridCell>

    <template v-for="(column, columnIndex) in otherColumns" :key="row">
      <DataGridCell
          :ref="`gridCell_${currentCell.row}_${columnIndex}`"
          @mouseover="setCurrentCell(columnIndex)"
        :userLists="userLists"
        :visibleColumns="visibleColumns"
        :settings="settings"
        :currentContact="currentContact"
        :contact="contact"
        :cellActive="
          currentCell.row == row && currentCell.column == columnIndex
            ? `active_cell_${currentCell.row}_${currentCell.column}`
            : false
        "
        :currentCell="currentCell"
        :columnIndex="columnIndex"
        :rowIndex="row"
        :networks="networks"
        :stages="stages"
        :column="column"
          @updateContact="$emit('updateContact', $event)"
          @updateContactLists="updateContactLists"
          @blur="$emit('updateContact', contact)"
        v-model="contact[column.key]"
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
    computed: {
        selectedContactsModel: {
            get() {
                return this.selectedContacts;
            },
            set(val) {
                this.$emit('updateSelectedContacts', val);
            },
        },
    },
  methods: {
      checkContactsEnrichable(ids) {
          this.$emit('checkContactsEnrichable', ids)
      },
      setCurrentCell(columnIndex) {
          this.currentCell.row = this.row
          this.currentCell.column = columnIndex
      },
    updateContactLists({ list, add = false }) {
      if (add) {
        this.contact.user_lists.push(list);
      } else {
        this.contact.user_lists = this.contact.user_lists.filter((l) => l.id != list.id);
      }
      this.$emit('updateListCount', {
        count: 1,
        list_id: list.id,
        remove: !add,
        contactIds: [this.contact.id],
      });
    },
    handleCellUpdate(payload) {
      // Handle the "update:currentCell" event emitted by the cell component
      this.$emit('update:currentCell', payload); // Emit a new event to the parent table component
    },
  },
  props: {
    userLists: Array,
    currentCell: Object,
    networks: Array,
    stages: Array,
    visibleColumns: Array,
    settings: Object,
    filters: Object,
    currentContact: Object,
    contact: Object,
    selectedContacts: Array,
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
