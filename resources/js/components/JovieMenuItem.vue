<template>
  <JovieTooltip
    v-if="!hideIfEmpty || !hide || count > 0"
    as="template"
    :tooltipText="description">
    <MenuItem
      @mouseover="lockMenuButton()"
      @drop="$emit('onListDrop', id)"
      class="group/menuItem"
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
            'focus:ring-none group flex w-full items-center justify-between rounded px-2 py-1  text-xs focus:border-none  focus:outline-none ',
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
                @emojiSelected="emojiSelected($event)"
                :currentEmoji="emoji" />
              <component
                v-if="icon"
                :is="icon"
                :class="`${iconColor}`"
                class="h-4 w-4"
                aria-hidden="true" />
            </div>
          </div>
          <div class="line-clamp-1 flex w-full">
            <span v-if="!editingName || !editable" class="line-clamp-1">{{
              name
            }}</span>
            <input
              v-else
              :value="name"
              class="rounded-md border px-2 text-xs font-light text-slate-700 group-hover/list:text-slate-800 dark:border-jovieDark-border dark:bg-jovieDark-900 dark:text-jovieDark-300 dark:group-hover/list:text-slate-200" />
          </div>

          <div class="h-4 w-4 items-center rounded">
            <ArrowPathIcon
              v-if="!loading"
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
              :items="subMenuItems"
              :offset="0"
              :searchable="false">
              <template #triggerButton>
                <EllipsisHorizontalIcon
                  v-if="menuItems"
                  :class="[menuButtonlocked ? 'block' : 'hidden']"
                  class="h-3 w-3 hover:text-slate-600 group-hover/menuItem:block hover:dark:text-jovieDark-400" />
              </template>
              <template #menuBottom>
                <DropdownMenuItem
                  name="Enrich"
                  icon="SparklesIcon"
                  @click="checkListsEnrichable(element.id)" />

                <DropdownMenuItem
                  name="Edit"
                  icon="PencilIcon"
                  @click="editList(element)" />
                <DropdownMenuItem
                  name="Duplicate"
                  icon="DocumentDuplicateIcon"
                  @click="duplicateList(element.id)" />

                <DropdownMenuItem
                  name="Delete"
                  icon="TrashIcon"
                  @click="confirmListDeletion(element.id)" />
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
import JovieDropdownMenuVue from './JovieDropdownMenu.vue';

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
    emojiSelected() {
      this.$emit('emoji-selected');
    },
    lockMenuButton() {
      this.menuButtonLocked = true;
    },
    unlockMenuButton() {
      this.menuButtonLocked = false;
    },
  },
  data() {
    return {
      editingName: true,
      menuButtonLocked: false,
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
      required: true,
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
