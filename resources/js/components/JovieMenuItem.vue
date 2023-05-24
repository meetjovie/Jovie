<template>
  <JovieTooltip
    v-if="!hideIfEmpty || !hide || count > 0"
    as="template"
    :disabled="tooltipDisabled"
    :tooltipText="description">
    <MenuItem
      @dblclick="enableEditName(id)"
      @keyup.enter="handleClick()"
      @mouseover="lockMenuButton()"
      @drop="handleDrop(id)"
      class="group/menuItem focus:border-none focus:outline-none focus:ring-0"
      v-slot="{ active }">
      <component
        :is="routerLink ? 'router-link' : 'div'"
        @click="handleClick()"
        class="w-full"
        active-class="bg-slate-100  w-full dark:bg-jovieDark-500 rounded dark:text-jovieDark-200"
        :to="{ name: component }">
        <div
          :class="[
            active || selected
              ? 'bg-slate-100 dark:bg-jovieDark-500 dark:text-jovieDark-200 '
              : 'text-slate-900 dark:text-jovieDark-100',
            'group flex h-8 w-full items-center justify-between rounded px-2 text-xs  focus:border-none focus:outline-none  focus:ring-0 ',
          ]">
          <div class="flex items-center">
            <div v-if="draggable" class="flex h-4 w-6 items-center">
              <Bars3Icon
                class="hidden h-3 w-3 cursor-grab text-slate-400 active:cursor-grabbing active:text-slate-700 group-hover/menuItem:block dark:text-jovieDark-400 active:dark:text-jovieDark-300" />
            </div>
            <div class="flex w-6 items-center space-x-2">
              <EmojiPickerModal
                v-if="emoji"
                class=""
                xs
                @emojiSelected="emojiSelected"
                :currentEmoji="emoji" />
              <component
                v-if="icon"
                :is="icon"
                :class="`${iconColor}`"
                class="h-4 w-4"
                aria-hidden="true" />
            </div>
          </div>
          <div class="line-clamp-1 flex w-full text-left">
            <span v-if="!editingName || !editable" class="line-clamp-1">{{
              name
            }}</span>
            <input
              ref="menuItemInput"
              @keyup.esc="disableEditName(list)"
              @keyup.enter="updateValue(name)"
              @blur="updateList(name)"
              v-else
              :value="name"
              class="rounded-md border px-2 text-xs font-light text-slate-700 group-hover/list:text-slate-800 dark:border-jovieDark-border dark:bg-jovieDark-900 dark:text-jovieDark-300 dark:group-hover/list:text-slate-200" />
          </div>

          <div class="h-4 w-4 items-center rounded">
            <ArrowPathIcon
              v-if="loading"
              :class="[
                { hidden: menuButtonlocked },
                { 'group-hover/menuItem:hidden': menuItems },
              ]"
              class="mx-auto h-3 w-3 animate-spin-slow items-center group-hover/list:hidden group-hover/list:text-slate-800 dark:group-hover/list:text-slate-200" />
            <span
              v-else-if="count"
              :class="[
                { hidden: menuButtonlocked },
                { 'group-hover/menuItem:hidden': menuItems },
              ]"
              class="text-xs font-light text-slate-700 group-hover:text-slate-900 dark:text-jovieDark-300 dark:group-hover:text-slate-100"
              >{{ count }}</span
            >
            <JovieDropdownMenu
              v-if="menuItems"
              placement="bottom-end"
              @item-clicked="handleSubmenuClick($event, id)"
              :items="subMenuItems"
              :offset="0"
              :searchable="false">
              <template #triggerButton>
                <EllipsisHorizontalIcon
                  v-if="menuItems"
                  :class="[menuButtonlocked ? 'opacity-100' : 'opacity-0']"
                  class="h-4 w-4 rounded p-0.5 hover:bg-slate-300 hover:text-slate-600 group-hover/menuItem:opacity-100 hover:dark:bg-jovieDark-400 hover:dark:text-jovieDark-700" />
              </template>
            </JovieDropdownMenu>
          </div>
        </div>
      </component>
    </MenuItem>
  </JovieTooltip>
</template>

<script>
import { MenuItem, Menu, MenuButton } from '@headlessui/vue';
import EmojiPickerModal from './EmojiPickerModal.vue';
import { Float } from '@headlessui-float/vue';
import JovieDropdownMenu from './JovieDropdownMenu.vue';
import DropdownMenuItem from './DropdownMenuItem.vue';
import JovieTooltip from './JovieTooltip.vue';
import {
  UserPlusIcon,
  SparklesIcon,
  ArrowPathIcon,
  CloudArrowUpIcon,
  GlobeAltIcon,
  CreditCardIcon,
  Bars3Icon,
  UserIcon,
  EllipsisHorizontalIcon,
  DocumentDuplicateIcon,
  HeartIcon,
  CogIcon,
  CakeIcon,
  LockClosedIcon,
  ArchiveBoxIcon,
} from '@heroicons/vue/24/solid';

export default {
  components: {
    MenuItem,
    MenuButton,
    Menu,
    JovieTooltip,
    Float,
    EmojiPickerModal,
    JovieDropdownMenu,
    DropdownMenuItem,
    EllipsisHorizontalIcon,
    CakeIcon,
    ArchiveBoxIcon,
    CogIcon,
    UserPlusIcon,
    DocumentDuplicateIcon,
    HeartIcon,
    Bars3Icon,
    SparklesIcon,
    CloudArrowUpIcon,
    GlobeAltIcon,
    ArrowPathIcon,
    LockClosedIcon,
    CreditCardIcon,
    UserIcon,
  },
  methods: {
    handleClick() {
      this.$emit('button-click');
    },
    handleSubmenuClick(item, id) {
      //log the name of the current component and the item that was clicked
      console.log('Item clicked in JovieMenuItem.vue: ', item);
      this.$emit('subMenuItemClicked', item, id);
    },
    updateValue() {
      //emit the new value to the parent
    },
    emojiSelected(emoji) {
      this.$emit('emoji-selected', emoji);
      this.$notify({
        title: 'Emoji selected',
        text: 'Emoji selected',
        group: 'user',
        type: 'success',
      });
    },
    handleDropdownClick() {
      this.$emit('onListDrop', this.id);
    },

    lockMenuButton() {
      this.menuButtonLocked = true;
      this.tooltipDisabled = true;
      //after 5 seconds unlock the menu button
      setTimeout(() => {
        this.unlockMenuButton();
        this.tooltipDisabled = false;
      }, 5000);
    },
    unlockMenuButton() {
      this.menuButtonLocked = false;
      this.tooltipDisabled = false;
    },
  },
  data() {
    return {
      editingName: false,
      menuButtonLocked: false,
      tooltipDisabled: false,
      subMenuItems: [
        {
          name: 'Enrich',
          icon: 'SparklesIcon',
          id: 1,
        },
        {
          name: 'Edit',
          icon: 'PencilIcon',
          id: 2,
        },
        {
          name: 'Duplicate',
          icon: 'DocumentDuplicateIcon',
          id: 3,
        },
        {
          name: 'Delete',
          icon: 'TrashIcon',
          id: 4,
        },
      ],
    };
  },
  props: {
    draggable: {
      type: Boolean,
      required: false,
      default: false,
    },
    id: {
      type: Number,
      required: false,
    },
    icon: {
      type: String,
      required: false,
    },
    editable: {
      type: Boolean,
      required: false,
      default: false,
    },
    loading: {
      type: Boolean,
      required: false,
      default: false,
    },
    menuItems: {
      type: Boolean,
      required: false,
      default: false,
    },
    disableRouterLink: {
      type: Boolean,
      required: false,
      default: false,
    },
    emoji: {
      type: String,
      required: false,
    },
    header: {
      type: Boolean,
      required: false,
      default: false,
    },
    hideIfEmpty: {
      type: Boolean,
      required: false,
      default: false,
    },
    routerLink: {
      type: Boolean,
      required: false,
      default: true,
    },
    hide: {
      type: Boolean,
      required: false,
      default: false,
    },
    active: {
      type: Boolean,
      required: false,
      default: false,
    },
    count: {
      type: Number,
      required: false,
    },
    name: {
      type: String,
      required: true,
    },
    selected: {
      type: Boolean,
      required: false,
      default: false,
    },
    description: {
      type: String,
      required: false,
      default: null,
    },
    iconColor: {
      type: String,
      required: false,
      default: 'text-slate-400 dark:text-jovieDark-400',
    },
    disabled: {
      type: Boolean,
      required: false,
      default: false,
    },
    component: {
      type: String,
      required: false,
      default: null,
    },
  },
};
</script>
