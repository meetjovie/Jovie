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
      class="left-0 items-center overflow-auto before:absolute before:left-0 before:top-0 before:h-full before:border-l before:border-slate-300 before:content-[''] before:dark:border-jovieDark-border">
      <div class="group mx-auto w-full items-center">
        <span
          class="group-hover:block"
          :class="[
            {
              hidden: !selectedContactsModel.includes(contact.id),
            },
            'block',
          ]">
          <input
            type="checkbox"
            :id="`checkbox_${contact.id}`"
            name="`checkbox_contact`"
            :value="contact.id"
            v-model="selectedContactsModel"
            class="h-3 w-3 rounded border-slate-300 text-indigo-600 focus-visible:ring-indigo-500 dark:border-jovieDark-border dark:text-indigo-400 sm:left-6" />
        </span>
        <span
          class="text-xs font-light text-slate-600 group-hover:hidden dark:text-jovieDark-400"
          :class="[
            { hidden: selectedContactsModel.includes(contact.id) },
            'block',
          ]">
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
          <ContactAvatar
            @updateAvatar="updateAvatar($event)"
            :loading="!contact.id"
            :contact="contact"
            class="mr-2" />
          <div
            v-if="cellActive"
            class="line-clamp-1 items-center text-sm text-slate-900 dark:text-jovieDark-100">
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
            class="line-clamp-1 text-sm text-slate-900 dark:text-jovieDark-100">
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
            class="mx-auto ml-0.5 mt-0.5 hidden h-4 w-4 group-hover:block" />
          <XMarkIcon
            v-else
            class="mx-auto ml-1 mt-1 hidden h-4 w-4 group-hover:block" />
        </div>
        <div v-if="contact.enriching > 0">
          <JovieSpinner />
        </div>
        <div v-else @click="checkContactsEnrichable(currentContact.id)">
          <SparklesIcon
            class="h-4 w-4 cursor-pointer rounded-full text-slate-400/0 transition-all active:border active:bg-slate-200 group-hover:text-slate-400 dark:text-jovieDark-300/0 dark:active:bg-slate-800 group-hover:dark:text-jovieDark-300" />
        </div>
        <div v-if="!contact.enriched_viewed">
          <span
            class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800"
            >New</span
          >
        </div>
        <div>
          <ContactContextMenu
            :open="contact.showContextMenu"
            :contact="contact">
            <!--  Kill this option til we fix the Contact Overview page -->
            <!--  <DropdownMenuItem
              name="Open Contact"
              icon="ViewfinderCircleIcon"
              color="text-blue-600 dark:text-blue-400"
              @click="
                $router.push({
                  name: 'Contact Overview',
                  params: { id: contact.id },
                })
              " /> -->
            <DropdownMenuItem
              name="Refresh"
              color="text-green-600 dark:text-green-400"
              icon="ArrowPathIcon"
              v-if="currentUser.is_admin"
              @click="$emit('refresh', contact)" />

            <DropdownMenuItem
              :name="
                filters.type == 'archived' && contact.archived
                  ? 'Unarchive'
                  : 'Archive'
              "
              icon="ArchiveBoxIcon"
              @blur="$emit('updateContact')"
              @click="$emit('archive-contacts', contact.id, !contact.archived)"
              color="text-blue-600
            dark:text-blue-400" />
            <DropdownMenuItem
              v-if="filters.list"
              name="Remove from list"
              icon="TrashIcon"
              danger
              color="text-red-600 dark:text-red-400"
              @click="
                $emit('toggleContactsFromList', contact.id, filters.list, true)
              " />
          </ContactContextMenu>
        </div>
      </div>
    </DataGridCell>

    <template
      v-for="(column, columnIndex) in otherColumns"
      :key="`${row}_${columnIndex}`">
      <DataGridCell
        :ref="`gridCell_${currentCell.row}_${columnIndex}`"
        @mouseover="setCurrentCell(columnIndex)"
        :userLists="userLists"
        :visibleColumns="visibleColumns"
        :settings="settings"
        :currentContact="currentContact"
        :contact="contact"
        :fieldId="`${otherColumns[columnIndex].id}_${otherColumns[columnIndex].key}`"
        :cellActive="
          currentCell.row == row && currentCell.column == columnIndex
            ? `active_cell_${currentCell.row}_${currentCell.column}`
            : ''
        "
        :currentCell="currentCell"
        :networks="networks"
        :stages="stages"
        :column="otherColumns[columnIndex]"
        @updateContact="$emit('updateContact', $event)"
        @updateContactLists="updateContactLists"
        @blur="$emit('updateContact', contact)"
        v-model="contact[otherColumns[columnIndex].key]"
        :row="row">
      </DataGridCell>
    </template>
  </tr>
</template>
<script>
import DataGridCell from './DataGridCell.vue';
import ContactContextMenu from './ContactContextMenu.vue';
import ContactAvatar from './ContactAvatar.vue';
import DropdownMenuItem from './DropdownMenuItem.vue';
import {
  ArrowTopRightOnSquareIcon,
  XMarkIcon,
  SparklesIcon,
} from '@heroicons/vue/24/outline';
import JovieSpinner from './JovieSpinner.vue';

export default {
  name: 'DataGridRow',
  components: {
    JovieSpinner,
    DataGridCell,
    ContactContextMenu,
    DropdownMenuItem,
    ContactAvatar,
    ArrowTopRightOnSquareIcon,
    XMarkIcon,
    SparklesIcon,
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
    updateAvatar(pic) {
      console.log('hello');
      this.$emit('updateContact', {
        id: this.contact.id,
        index: this.contact.index,
        key: 'profile_pic_url',
        value: pic,
      });
    },
    checkContactsEnrichable(ids) {
      this.$emit('checkContactsEnrichable', ids);
    },
    setCurrentCell(columnIndex) {
      this.currentCell.row = this.row;
      this.currentCell.column = columnIndex;
    },
    updateContactLists({ list, add = false }) {
      if (add) {
        this.contact.user_lists.push(list);
      } else {
        this.contact.user_lists = this.contact.user_lists.filter(
          (l) => l.id != list.id
        );
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
    loading: Boolean,
    cellActive: Boolean | String,
    otherColumns: Array,
    columnIndex: Number,
  },
};
</script>
