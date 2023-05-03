<template>
  <!--  @click="toggleSortingOrder()" -->
  <div class="groupd/resize flex" :style="`width: ${column.width}px`">
    <div
      class="z-50 cursor-ew-resize"
      v-if="showResizeable && index > 0"
      @mousedown="handleMouseDown($event, true)">
      ||
    </div>
    <div class="group/header drag-head w-full" v-if="column">
      <JovieDropdownMenu
        :items="filteredDropdownItems"
        size="lg"
        :searchable="false"
        @contextmenu.prevent="openMenu"
        @itemClicked="itemClicked"
        :open="menuOpen"
        placement="bottom-start">
        <template #triggerButton>
          <div class="w-full">
            <div
              class="text-medium group flex h-full w-full items-center justify-between py-2 pl-1 pr-2 tracking-wider">
              <div
                @contextmenu.prevent="openMenu()"
                class="text-medium flex w-full items-center tracking-wider">
                <component
                  class="mr-1 h-4 w-4 text-slate-400 dark:text-jovieDark-200"
                  :is="column.icon"></component>
                <span
                  class="text-medium line-clamp-1 w-24 tracking-wider dark:text-jovieDark-200">
                  {{ column.name }}
                </span>
              </div>
              <div
                @click="
                  $emit('sortData', {
                    sortBy: column.key,
                    sortOrder: column.sortOrder,
                  })
                "
                v-if="column.sortable"
                class="cursor-pointer text-slate-400 dark:text-jovieDark-600">
                <svg
                  v-if="!column.sortOrder"
                  xmlns="http://www.w3.org/2000/svg"
                  class="ml-1 h-3 w-3 text-slate-500/0 group-hover/header:text-slate-500 dark:group-hover/header:text-slate-400"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 320 512">
                  <path
                    d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                </svg>
                <ChevronDownIcon
                  v-else-if="column.sortOrder === 'desc'"
                  class="ml-1 h-3 w-3 text-slate-500/0 group-hover/header:text-slate-500 dark:group-hover/header:text-slate-400" />
                <ChevronUpIcon
                  v-else
                  class="ml-1 h-3 w-3 text-slate-500/0 group-hover/header:text-slate-500 dark:group-hover/header:text-slate-400" />
              </div>
            </div>
          </div>
        </template>
        <!-- <template #menuItem="{ item, nameKey }">
                  <div
                    class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-slate-600 dark:text-jovieDark-200"
                    :class="{
                      'bg-slate-200 text-slate-700 dark:bg-jovieDark-500 dark:text-jovieDark-100':
                        active,
                    }">
                    <div class="flex items-center">
                      <div v-if="item.emoji" class="mr-2 text-xs font-bold">
                        {{ item.emoji }}
                      </div>
                      <div
                        v-else-if="item.icon"
                        class="mr-2 items-center text-xs font-bold">
                        <component :is="item.icon" class="h-3 w-3" />
                      </div>
                      <div v-else></div>

                      <div class="text-xs font-normal tracking-wider">
                        {{ item[nameKey] }}
                        <CustomFieldsMenu
                          :currentField="column"
                          @getHeaders="$emit('getHeaders')" />
                      </div>
                    </div>
                  </div>
                </template> -->
        <template #menuBottom v-if="column.custom">
          <!-- <CustomFieldsMenu
                      :currentField="column"
                      @getHeaders="$emit('getHeaders')" /> -->
          <DropdownMenuItem
            @click="$emit('editField', column)"
            icon="PencilIcon"
            name="Edit Field Type" />
        </template>
      </JovieDropdownMenu>
    </div>
    <div
      v-if="showResizeable && index <= lastColumnIndex"
      class="z-50 cursor-ew-resize"
      @mousedown="handleMouseDown($event, false)">
      ||
    </div>
  </div>
</template>
<script>
import { Float } from '@headlessui-float/vue';
import JovieDropdownMenu from './JovieDropdownMenu.vue';
import DropdownMenuItem from './DropdownMenuItem.vue';
import {
  ChevronDownIcon,
  ChevronUpIcon,
  Bars3BottomLeftIcon,
  AtSymbolIcon,
  CurrencyDollarIcon,
  LinkIcon,
  CalendarDaysIcon,
  ArrowDownCircleIcon,
  StarIcon,
  BriefcaseIcon,
  UserIcon,
  ChartBarIcon,
  EyeSlashIcon,
} from '@heroicons/vue/20/solid';
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  TransitionRoot,
} from '@headlessui/vue';
import CustomFieldsMenu from './CustomFieldsMenu.vue';

export default {
  components: {
    ChevronDownIcon,
    ChevronUpIcon,
    Bars3BottomLeftIcon,
    AtSymbolIcon,
    CurrencyDollarIcon,
    StarIcon,
    CalendarDaysIcon,
    ArrowDownCircleIcon,
    LinkIcon,
    BriefcaseIcon,
    UserIcon,
    ChartBarIcon,
    EyeSlashIcon,
    JovieDropdownMenu,
    DropdownMenuItem,
    Popover,
    PopoverButton,
    PopoverPanel,
    TransitionRoot,
    Float,
    CustomFieldsMenu,
  },
  data() {
    return {
      open: true,
      draggingColumn: null,
      initialX: null,
      columnWidth: null,
      currentDraggingColumn: null,
    };
  },
  computed: {
    filteredDropdownItems() {
      let finalItems = this.dropdownItems;
      if (this.column.name === 'Name') {
        finalItems = finalItems.filter((item) => item.id !== 1);
      }
      if (!this.column.custom) {
        finalItems = finalItems.filter((item) => item.custom !== true);
      }
      if (!this.column.sortable) {
        finalItems = finalItems.filter((item) => item.sortable !== true);
      }

      return finalItems;
    },
  },
  mounted() {
    let self = this;
    window.addEventListener('mouseup', (event) => {
      if (self.draggingColumn !== null) {
        self.$emit('updateColumnWidth', {
          columnId: self.currentDraggingColumn.id,
          width: self.currentDraggingColumn.width,
          custom: self.currentDraggingColumn.custom,
        });
        self.draggingColumn = null;
      }
    });

    window.addEventListener('mousemove', (event) => {
      if (self.draggingColumn !== null) {
        const delta = event.clientX - self.initialX;
        self.currentDraggingColumn.width = Math.max(
          self.columnWidth + delta,
          50
        );
        self.$emit('reflectColumnWidth', self.currentDraggingColumn);
      }
    });
  },
  methods: {
    handleMouseDown(event, previousColumn) {
      if (this.previousColumn) {
        this.draggingColumn = this.index - 1;
      } else {
        this.draggingColumn = this.index;
      }
      if (this.previousColumn && previousColumn) {
        this.currentDraggingColumn = this.previousColumn;
      } else {
        this.currentDraggingColumn = this.column;
      }
      this.initialX = event.clientX;
      this.columnWidth = this.currentDraggingColumn.width;
    },
    // handleMouseUp() {
    //     this.$emit('updateColumnWidth', {columnId: this.column.id, width: this.column.width, custom: this.column.custom})
    //     this.draggingColumn = null
    // },
    // handleMouseMove(event) {
    //     console.log('this.draggingColumn');
    //     console.log(this.draggingColumn);
    //     if (this.draggingColumn !== null) {
    //         const delta = event.clientX - this.initialX
    //         this.column.width = Math.max(this.columnWidth + delta, 50)
    //     }
    // },
    openMenu() {
      this.open = true;
      console.log('open menu');
    },
    itemClicked(id) {
      let item = this.dropdownItems.find((item) => item.id == id);
      if (item.id == 2) {
        this.$emit('sortData', {
          sortBy: this.column.key,
          sortOrder: 'asc',
        });
      } else if (item.id == 3) {
        this.$emit('sortData', {
          sortBy: this.column.key,
          sortOrder: 'desc',
        });
      } else {
        this.$emit(item.emit);
      }
    },
  },
  props: {
    column: {
      type: Object,
    },
    index: {
      type: Number,
    },
    menuOpen: {
      type: Boolean,
      default: false,
    },
    dropdownItems: {
      type: Array,
      default: () => [
        {
          id: 1,
          name: 'Hide Column',
          icon: 'EyeSlashIcon',
          emit: 'hideColumn',
          menu: true,
        },
        {
          id: 2,
          name: 'Sort Ascending',
          icon: 'ChevronUpIcon',
          emit: 'sortAscending',
          sortable: true,
          menu: true,
        },
        {
          id: 3,
          name: 'Sort Descending',
          icon: 'ChevronDownIcon',
          emit: 'sortDescending',
          sortable: true,
          menu: true,
        },
        {
          id: 4,
          name: 'Delete Field',
          icon: 'TrashIcon',
          emit: 'deleteField',
          menu: true,
          custom: true,
          color: 'red',
        },
      ],
    },
    showResizeable: {
      type: Boolean,
      default: true,
    },
    lastColumnIndex: {
      type: Number,
      default: 0,
    },
    previousColumn: {
      default: false,
    },
  },
};
</script>
