<template>
  <MenuItem disabled v-if="searchBox" v-slot="{ active }" as="div">
    <div
      class="relative flex items-center border-b border-slate-300 dark:border-jovieDark-border">
      <input
        tabindex="0"
        @input="$emit('search-query', $event.target.value)"
        ref="searchInput"
        :v-model="searchBox.query"
        :placeholder="searchBox.placeholder"
        class="w-full border-0 border-none border-transparent bg-transparent px-1 py-2 text-xs font-semibold text-slate-500 outline-0 ring-0 placeholder:font-light placeholder:text-slate-400 focus-visible:border-transparent focus-visible:ring-0 focus-visible:ring-transparent focus-visible:ring-offset-0 dark:text-jovieDark-300" />
      <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
        <KBShortcut hasBg :shortcutKey="['s']" />
      </div>
    </div>
  </MenuItem>
  <MenuItem disabled v-else-if="separator">
    <div class="inset-0 flex items-center" aria-hidden="true">
      <div
        class="w-full border-t border-gray-300 dark:border-jovieDark-border" />
    </div>
  </MenuItem>
  <MenuItem v-else-if="submenu" as="div" v-slot="{ active }">
    <Menu>
      <Float :offset="4" shift placement="right-start">
        <MenuButton as="template">
          <div
            :class="{
              'cursor-not-allowed opacity-50 saturate-0': disabled,
              'bg-slate-150 text-slate-700 dark:bg-jovieDark-500 dark:text-jovieDark-100':
                active && !danger,
              'bg-red-100 text-slate-700 dark:bg-red-900 dark:text-red-100':
                active && danger,
            }"
            class="group mt-1 flex w-full cursor-pointer items-center rounded px-2 py-1.5 text-xs text-slate-500 dark:text-jovieDark-200">
            <div class="flex w-full items-center">
              <slot>
                <div class="flex w-full items-center justify-between">
                  <div class="flex w-full items-center">
                    <div
                      v-if="checkable"
                      class="mr-2 w-3 text-xs font-bold opacity-50">
                      <CheckIcon
                        v-if="checked"
                        class="h-4 w-4 font-bold text-slate-500 hover:text-slate-700 dark:text-jovieDark-300 dark:hover:text-slate-200" />
                    </div>

                    <div v-if="emoji" class="mr-2 text-xs font-bold">
                      {{ emoji }}
                    </div>
                    <div
                      v-else-if="colorDot"
                      class="mr-2 text-xs font-bold opacity-50">
                      <!--  <span
                  class="inline-block h-2 w-2 flex-shrink-0 rounded-full"
                  :class="dotClass"></span> -->
                      <ColorDot :color="colorDot" />
                    </div>
                    <div
                      v-else-if="icon"
                      class="mr-2 items-center text-xs font-bold">
                      <component
                        :is="icon"
                        class="h-3 w-3"
                        :class="{
                          'text-slate-500 dark:text-jovieDark-200': !color,
                          [color]: color,
                        }" />
                    </div>
                    <div v-else></div>

                    <div
                      class="line-clamp-1 text-xs font-medium tracking-wider antialiased"
                      :class="{
                        'text-red-500':
                          color === 'text-red-500 dark:text-red-700',
                        'text-slate-500 dark:text-white': !color,
                        [color]: color,
                      }">
                      {{ name }}
                    </div>
                  </div>
                  <div class="flex">
                    <KBShortcut
                      v-if="shortcutKey"
                      :sequence="shortcutSequence"
                      :shortcutKey="shortcutKey" />

                    <ChevronRightIcon class="h-4 w-4 text-slate-500" />
                  </div>
                </div>
              </slot>
            </div>
          </div>
        </MenuButton>
        <MenuItems class="">
          <GlassmorphismContainer
            class="w-40 px-2 py-1.5 text-xs text-slate-500 dark:text-jovieDark-200">
            Add to list
            <MenuItem disabled>
              <div class="inset-0 flex items-center" aria-hidden="true">
                <div
                  class="w-full border-t border-gray-300 dark:border-jovieDark-border" />
              </div>
            </MenuItem>
            <!--  <MenuItem :disabled="disabled" as="div" v-slot="{ active }">
              <div
                :class="{
                  'cursor-not-allowed opacity-50 saturate-0': disabled,
                  'bg-slate-150 text-slate-700 dark:bg-jovieDark-500 dark:text-jovieDark-100':
                    active && !danger,
                  'bg-red-100 text-slate-700 dark:bg-red-900 dark:text-red-100':
                    active && danger,
                }"
                class="group mt-1 flex w-full cursor-pointer items-center rounded px-2 py-1.5 text-xs text-slate-500 dark:text-jovieDark-200">
                <div class="flex w-full items-center">
                  <slot>
                    <div class="flex w-full items-center justify-between">
                      <div class="flex w-full items-center">
                        <div
                          v-if="checkable"
                          class="mr-2 w-3 text-xs font-bold opacity-50">
                          <CheckIcon
                            v-if="checked"
                            class="h-4 w-4 font-bold text-slate-500 hover:text-slate-700 dark:text-jovieDark-300 dark:hover:text-slate-200" />
                        </div>

                        <div v-if="emoji" class="mr-2 text-xs font-bold">
                          {{ emoji }}
                        </div>
                        <div
                          v-else-if="colorDot"
                          class="mr-2 text-xs font-bold opacity-50">
                        
                          <ColorDot :color="colorDot" />
                        </div>
                        <div
                          v-else-if="icon"
                          class="mr-2 items-center text-xs font-bold">
                          <component
                            :is="icon"
                            class="h-3 w-3"
                            :class="{
                              'text-slate-500 dark:text-jovieDark-200': !color,
                              [color]: color,
                            }" />
                        </div>
                        <div v-else></div>

                        <div
                          class="text-xs font-medium tracking-wider antialiased"
                          :class="{
                            'text-red-500':
                              color === 'text-red-500 dark:text-red-700',
                            'text-slate-500 dark:text-white': !color,
                            [color]: color,
                          }">
                          {{ name }}
                        </div>
                      </div>
                      <div class="flex">
                        <KBShortcut
                          v-if="shortcutKey"
                          :sequence="shortcutSequence"
                          :shortcutKey="shortcutKey" />

                        <slot name="toggle"> </slot>
                      </div>
                    </div>
                  </slot>
                </div>
              </div>
            </MenuItem> -->
          </GlassmorphismContainer>
        </MenuItems>
      </Float>
    </Menu>
  </MenuItem>
  <MenuItem v-else :disabled="disabled" as="div" v-slot="{ active }">
    <!--   Tooltip is breaking buttons. Need to fix this. -->
    <!--   <JovieTooltip :disabled="!tooltip" :tooltipText="name" /> -->
    <div
      :class="{
        'cursor-not-allowed opacity-50 saturate-0': disabled,
        'bg-slate-150 text-slate-700 dark:bg-jovieDark-500 dark:text-jovieDark-100':
          active && !danger,
        'bg-red-100 text-slate-700 dark:bg-red-900 dark:text-red-100':
          active && danger,
      }"
      class="group mt-1 flex w-full cursor-pointer items-center rounded px-2 py-1.5 text-xs text-slate-500 dark:text-jovieDark-200">
      <div class="flex w-full items-center">
        <slot>
          <div class="flex w-full items-center justify-between">
            <div class="flex w-full items-center">
              <div
                v-if="checkable"
                class="mr-2 w-3 text-xs font-bold opacity-50">
                <CheckIcon
                  v-if="checked"
                  class="h-4 w-4 font-bold text-slate-500 hover:text-slate-700 dark:text-jovieDark-300 dark:hover:text-slate-200" />
              </div>

              <div v-if="emoji" class="mr-2 text-xs font-bold">
                {{ emoji }}
              </div>
              <div
                v-else-if="colorDot"
                class="mr-2 text-xs font-bold opacity-50">
                <!--  <span
                  class="inline-block h-2 w-2 flex-shrink-0 rounded-full"
                  :class="dotClass"></span> -->
                <ColorDot :color="colorDot" />
              </div>
              <div v-else-if="icon" class="mr-2 items-center text-xs font-bold">
                <component
                  :is="icon"
                  class="h-3 w-3"
                  :class="{
                    'text-slate-500 dark:text-jovieDark-200': !color,
                    [color]: color,
                  }" />
              </div>
              <div v-else></div>

              <div
                class="line-clamp-1 text-xs font-medium tracking-wider antialiased"
                :class="{
                  'text-red-500': color === 'text-red-500 dark:text-red-700',
                  'text-slate-500 dark:text-white': !color,
                  [color]: color,
                }">
                {{ name }}
              </div>
            </div>
            <div class="flex">
              <KBShortcut
                v-if="shortcutKey"
                :sequence="shortcutSequence"
                :shortcutKey="shortcutKey" />

              <slot name="toggle">
                <!-- <Switch
                    v-if="toggle"
                    :name="name"
                    v-bind="toggle"
                    as="template"
                    @checked="emit('checked', $event)"
                    v-slot="{ checked }">
                    <button
                      :class="
                        checked
                          ? 'bg-indigo-600 dark:bg-indigo-400'
                          : 'bg-slate-150 dark:bg-jovieDark-800'
                      "
                      class="relative inline-flex h-4 w-6 items-center rounded-full border border-slate-300 dark:border-jovieDark-border">
                      <span class="sr-only">{{ name }}</span>
                      <span
                        :class="checked ? 'translate-x-3' : 'translate-x-0'"
                        class="inline-block h-3 w-3 transform rounded-full bg-white transition transition duration-200 ease-in-out dark:bg-jovieDark-900" />
                    </button>
                  </Switch> -->
              </slot>
            </div>
          </div>
        </slot>
      </div>
    </div>
  </MenuItem>
</template>
<script>
import { ref } from 'vue';
import KBShortcut from './KBShortcut.vue';
import { Float } from '@headlessui-float/vue';
import JovieTooltip from './JovieTooltip.vue';
import GlassmorphismContainer from './GlassmorphismContainer.vue';
import {
  PencilIcon,
  CakeIcon,
  ChatBubbleLeftIcon,
  ArrowLeftOnRectangleIcon,
  ChartBarIcon,
  WrenchScrewdriverIcon,
  ComputerDesktopIcon,
  SunIcon,
  MoonIcon,
  QueueListIcon,
  EnvelopeIcon,
  ChatBubbleOvalLeftEllipsisIcon,
  PhoneIcon,
  CalendarDaysIcon,
  ChatBubbleLeftEllipsisIcon,
  CheckIcon,
  ArrowPathIcon,
  TrashIcon,
  ArchiveBoxIcon,
  EllipsisVerticalIcon,
  ArrowSmallLeftIcon,
  PlusIcon,
  BriefcaseIcon,
  NoSymbolIcon,
  StarIcon,
  HeartIcon,
  MagnifyingGlassIcon,
  ChevronUpIcon,
  Bars3BottomLeftIcon,
  AtSymbolIcon,
  CurrencyDollarIcon,
  LinkIcon,
  ListBulletIcon,
  ArrowDownCircleIcon,
  ArrowUpCircleIcon,
  ChevronRightIcon,
  ViewfinderCircleIcon,
  SparklesIcon,
  CloudArrowUpIcon,
  ChevronDownIcon,
  DocumentDuplicateIcon,
  CloudArrowDownIcon,
  AdjustmentsHorizontalIcon,
  XMarkIcon,
  UserGroupIcon,
  UserIcon,
  ArrowTopRightOnSquareIcon,
} from '@heroicons/vue/24/solid';
import {
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  Switch,
  SwitchLabel,
  SwitchGroup,
} from '@headlessui/vue';
import ColorDot from './../components/ColorDot.vue';

export default {
  components: {
    KBShortcut,
    MenuItem,
    Switch,
    SwitchLabel,
    SwitchGroup,
    ColorDot,
    Float,
    GlassmorphismContainer,
    Menu,
    MenuButton,
    MenuItems,
    JovieTooltip,

    ArchiveBoxIcon,
    PhoneIcon,
    QueueListIcon,
    CakeIcon,
    TrashIcon,
    SunIcon,
    MoonIcon,
    CalendarDaysIcon,
    ChatBubbleOvalLeftEllipsisIcon,
    EnvelopeIcon,
    ComputerDesktopIcon,
    WrenchScrewdriverIcon,
    CheckIcon,
    DocumentDuplicateIcon,
    ArrowPathIcon,
    ChatBubbleLeftEllipsisIcon,
    ChatBubbleLeftIcon,
    ChartBarIcon,
    ArrowLeftOnRectangleIcon,
    EllipsisVerticalIcon,
    ArrowSmallLeftIcon,
    ChevronDownIcon,
    CloudArrowUpIcon,
    PlusIcon,
    ViewfinderCircleIcon,
    PencilIcon,
    BriefcaseIcon,
    NoSymbolIcon,
    StarIcon,
    HeartIcon,
    MagnifyingGlassIcon,
    ChevronUpIcon,
    Bars3BottomLeftIcon,
    SparklesIcon,
    AtSymbolIcon,
    CurrencyDollarIcon,
    LinkIcon,
    ListBulletIcon,
    ArrowDownCircleIcon,
    ArrowUpCircleIcon,
    ChevronRightIcon,
    CloudArrowDownIcon,
    AdjustmentsHorizontalIcon,
    XMarkIcon,
    UserIcon,
    UserGroupIcon,
    ArrowTopRightOnSquareIcon,
  },
  directives: {
    // enables v-focus in template
    focus,
  },
  props: {
    name: {
      type: String,
      required: true,
    },
    color: {
      type: String,
      required: false,
    },
    colorDot: {
      type: String,
      required: false,
    },
    emoji: {
      type: String,
      required: false,
    },
    icon: {
      type: String,
      required: false,
    },
    toggle: {
      type: Boolean,
      required: false,
      default: false,
    },
    tooltip: {
      type: Boolean,
      required: false,
      default: false,
    },
    numbered: {
      type: Boolean,
      required: false,
      default: false,
    },
    checked: {
      type: Boolean,
      required: false,
      default: false,
    },
    shortcutKey: {
      type: Array,
      required: false,
      default: () => [],
    },
    disabled: {
      type: Boolean,
      required: false,
      default: false,
    },
    tooltip: {
      type: Boolean,
      required: false,
      default: false,
    },
    submenu: {
      type: Boolean,
      required: false,
      default: false,
    },
    separator: {
      type: Boolean,
      required: false,
      default: false,
    },
    checkable: {
      type: Boolean,
      required: false,
      default: false,
    },
    danger: {
      type: Boolean,
      required: false,
      default: false,
    },
    shortcutSequence: {
      type: Boolean,
      required: false,
      default: false,
    },
    searchBox: {
      type: Object,
      required: false,
      default: () => {},
    },
  },
};
</script>
