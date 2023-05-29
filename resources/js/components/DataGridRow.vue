<template>
  <tr
    @contextmenu="handleContextMenu($event, contact)"
    class="group h-11 w-full flex-row items-center overflow-y-visible">
    <div
      @click.shift.prevent="toggleRow(contact.id)"
      v-if="shiftDown"
      class="absolute z-50 w-full"></div>
    <div
      :class="[
        selectedContactsModel.includes(contact.id)
          ? currentContact.id === contact.id
            ? 'bg-indigo-100 dark:bg-indigo-600'
            : 'bg-indigo-50 dark:bg-indigo-700'
          : currentContact.id === contact.id
          ? 'bg-slate-100 dark:bg-jovieDark-600'
          : 'bg-slate-50 dark:bg-jovieDark-800',
      ]"
      class="sticky left-0 isolate z-50 h-12 w-full items-center border-r-2 border-slate-300 dark:border-jovieDark-border">
      <div
        class="flex h-full w-full items-center justify-between"
        freezeColumn
        width="full">
        <div class="flex items-center">
          <!--   class="left-0 items-center overflow-auto before:absolute before:left-0 before:top-0 before:h-full before:border-l before:border-slate-300 before:content-[''] before:dark:border-jovieDark-border"> -->
          <div class="group mx-auto w-8 items-center px-2">
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
                class="h-3 w-3 rounded border-slate-300 text-indigo-600 focus:border-none focus:outline-none focus:ring-0 focus-visible:ring-indigo-500 dark:border-jovieDark-border dark:bg-jovieDark-700 dark:text-indigo-400 sm:left-6" />
            </span>
            <span
              class="text-xs font-semibold text-slate-500 group-hover:hidden dark:text-jovieDark-400"
              :class="[
                { hidden: selectedContactsModel.includes(contact.id) },
                'block',
              ]">
              {{ rowCounter(row) }}
            </span>
          </div>
          <div
            class="hidden w-8 cursor-pointer items-center px-2 text-slate-400 dark:text-jovieDark-400 lg:block"
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
        </div>

        <div
          @click="$emit('openSidebar', { contact: contact, index: row })"
          class="flex w-full items-center justify-between truncate text-ellipsis px-2 py-1">
          <div class="flex items-center space-x-2">
            <ContactAvatar
              @updateAvatar="updateAvatar($event)"
              :loading="!contact.id"
              :contact="contact"
              class="" />
            <div
              class="w-20 truncate text-ellipsis text-left text-sm text-slate-900 dark:text-jovieDark-100">
              {{ contact.full_name }}
            </div>
          </div>
          <div v-if="!contact.enriched_viewed">
            <span
              class="inline-flex items-center rounded-full border border-slate-200 bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-slate-700 dark:border-jovieDark-border dark:bg-jovieDark-600 dark:text-jovieDark-300"
              >New</span
            >
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div
            @click="$emit('openSidebar', { contact: contact, index: row })"
            class="mx-auto mt-1 h-6 w-6 items-center rounded-full bg-slate-200/0 pr-4 text-center text-slate-400 transition-all active:scale-95 active:bg-slate-200 dark:text-jovieDark-300 dark:active:bg-slate-800">
            <ArrowTopRightOnSquareIcon
              v-if="
                !$store.state.ContactSidebarOpen ||
                currentContact.id !== contact.id
              "
              class="mx-auto hidden h-4 w-4 cursor-pointer group-hover:block" />
            <XMarkIcon
              v-else
              class="mx-auto hidden h-4 w-4 cursor-pointer group-hover:block" />
          </div>
          <div v-if="contact.enriching > 0">
            <JovieSpinner />
          </div>
          <div v-else @click="checkContactsEnrichable(currentContact.id)">
            <SparklesIcon
              class="h-4 w-4 cursor-pointer rounded-full text-slate-400/0 transition-all active:scale-95 active:bg-slate-200 group-hover:text-slate-400 dark:text-jovieDark-300/0 dark:active:bg-slate-800 group-hover:dark:text-jovieDark-300" />
          </div>

          <div>
            <button
              ref="contextMenuButton"
              @click="handleMenuButton($event, contact)"
              class="flex items-center rounded-full text-slate-400/0 transition-all hover:text-slate-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-100 active:bg-slate-200 group-hover:text-slate-400 dark:hover:text-slate-400 dark:active:bg-slate-800 dark:group-hover:text-slate-600">
              <span class="sr-only">Open options</span>
              <EllipsisVerticalIcon class="z-0 h-4 w-4" aria-hidden="true" />
            </button>
          </div>
        </div>
      </div>
    </div>

    <template
      v-for="(column, columnIndex) in otherColumns"
      :key="`${row}_${columnIndex}`">
      <DataGridCell
        class="relative z-30"
        :class="[
          selectedContactsModel.includes(contact.id)
            ? currentContact.id === contact.id
              ? 'bg-indigo-100 dark:bg-indigo-600'
              : 'bg-indigo-50 dark:bg-indigo-700'
            : currentContact.id === contact.id
            ? 'bg-slate-100 dark:bg-jovieDark-600'
            : 'bg-slate-50 dark:bg-jovieDark-800',
        ]"
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
  EllipsisVerticalIcon,
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
    EllipsisVerticalIcon,
    XMarkIcon,
    SparklesIcon,
  },
  data() {
    return {
      row: 0,
      shiftDown: false,
    };
  },
  mounted() {
    window.addEventListener('keydown', this.onKeyDown);
    window.addEventListener('keyup', this.onKeyUp);
  },
  beforeDestroy() {
    window.removeEventListener('keydown', this.onKeyDown);
    window.removeEventListener('keyup', this.onKeyUp);
  },
  computed: {
    colorClass() {
      return `ring-${this.ringColor}-500 dark:ring-${this.ringColor}-300`;
    },
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
    onKeyDown(event) {
      if (event.key === 'Shift') {
        this.shiftDown = true;
      }
    },
    onKeyUp(event) {
      if (event.key === 'Shift') {
        this.shiftDown = false;
      }
    },
    toggleRow(id) {
      if (this.selectedContactsModel.includes(id)) {
        this.selectedContactsModel.splice(
          this.selectedContactsModel.indexOf(id),
          1
        );
      } else {
        this.selectedContactsModel.push(id);
      }
    },
    handleContextMenu(event, contact) {
      event.preventDefault(); // Prevents the default context menu from showing up
      const coordinates = {
        x: event.pageX, // Extract the x-coordinate from the event
        y: event.pageY, // Extract the y-coordinate from the event
      };

      console.log('context menu clicked ' + contact.full_name);
      this.$emit('contextMenuClicked', contact, coordinates);
    },

    handleMenuButton(event, contact) {
      event.preventDefault(); // Prevents the default context menu from showing up
      const coordinates = {
        x: event.pageX, // Extract the x-coordinate from the event
        y: event.pageY, // Extract the y-coordinate from the event
      };

      console.log('context menu clicked ' + contact.full_name);
      this.$emit('contextMenuButtonClicked', contact, coordinates);
    },

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
    rowCounter(row) {
      return (
        this.contactsMeta.per_page * (this.contactsMeta.current_page - 1) +
        row +
        1
      );
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
    contactsMeta: Object,
    ringColor: {
      type: String,
      default: 'red',
    },
  },
};
</script>
