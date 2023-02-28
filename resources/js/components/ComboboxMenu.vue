<template>
  <Combobox as="div" class="h-60" v-model="selectedItem">
    <ComboboxInput
        @focusin="open = true"
        @focusout="query = ''; open = false;"
      class="w-full rounded-md border border-slate-200 py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0 dark:border-jovieDark-border dark:bg-jovieDark-800 dark:text-jovieDark-200"
      @change="query = $event.target.value"
      placeholder="Find a field type"
      :displayValue="(item) => item.name" />

    <div
      class="h-48 overflow-y-scroll rounded-md border border-slate-300 bg-slate-50 dark:border-jovieDark-border"
      v-show="open">
      <!--
                Using the `static` prop, the `ComboboxOptions` are always
                rendered and the `open` state is ignored.
              -->
      <ComboboxOptions static class="h-full">
        <div
          v-if="filteredItems.length === 0 && query !== ''"
          class="relative h-full cursor-default select-none items-center py-2 px-4 text-slate-700 dark:text-jovieDark-300">
          Nothing found.
        </div>
        <ComboboxOption
          v-slot="{ active, selected, disabled }"
          v-for="item in filteredItems"
          :key="item.id"
          as="template"
          :value="item">
          <li
            class="relative w-full cursor-pointer items-center rounded-md py-2 pl-10 pr-4 text-xs text-slate-600 dark:text-jovieDark-200"
            :class="{
              'cursor-not-allowed opacity-50 saturate-0': disabled,
              ' bg-slate-200 text-slate-700 dark:bg-jovieDark-500 dark:text-jovieDark-100':
                active,
            }">
            <span
              class="absolute inset-y-0 left-0 flex items-center pl-3"
              :class="{
                'text-white': active,
                'text-indigo-600 dark:text-jovieDark-400': !active,
              }">
              <CheckIcon v-if="selected" class="h-5 w-5" aria-hidden="true" />
              <component
                v-else
                :is="item.icon"
                class="h-5 w-5"
                :class="{
                  'text-indigo-500': active,
                  'text-indigo-600 dark:text-jovieDark-400': !active,
                  'font-medium text-indigo-500': selected,
                  'font-normal': !selected,
                }"
                aria-hidden="true" />
            </span>
            <span
              class="block truncate"
              :class="{ 'font-medium': selected, 'font-normal': !selected }">
              {{ item.name }}
            </span>
          </li>
        </ComboboxOption>
      </ComboboxOptions>
    </div>
  </Combobox>
</template>

<script>
import {
  AdjustmentsHorizontalIcon,
  ArchiveBoxIcon,
  ArrowDownCircleIcon,
  ArrowPathIcon,
  ArrowSmallLeftIcon,
  ArrowTopRightOnSquareIcon,
  ArrowUpCircleIcon,
  AtSymbolIcon,
  CalendarDaysIcon,
  CheckIcon,
  ChevronDownIcon,
  ChevronUpIcon,
  CloudArrowDownIcon,
  CloudArrowUpIcon,
  CurrencyDollarIcon,
  EllipsisVerticalIcon,
  EnvelopeIcon,
  HeartIcon,
  HashtagIcon,
  Bars3BottomLeftIcon,
  LinkIcon,
  ListBulletIcon,
  MagnifyingGlassIcon,
  NoSymbolIcon,
  PlusIcon,
  StarIcon,
  TrashIcon,
  UserGroupIcon,
  UserIcon,
  XMarkIcon,
} from '@heroicons/vue/24/solid';
import {
  Combobox,
  ComboboxInput,
  ComboboxOptions,
  ComboboxOption,
} from '@headlessui/vue';
export default {
  components: {
    Combobox,
    ComboboxOption,
    ComboboxOptions,
    ComboboxInput,
    CheckIcon,
    AdjustmentsHorizontalIcon,
    ArchiveBoxIcon,
    ArrowDownCircleIcon,
    ArrowPathIcon,
    ArrowSmallLeftIcon,
    ArrowTopRightOnSquareIcon,
    ArrowUpCircleIcon,
    AtSymbolIcon,

    CalendarDaysIcon,
    HashtagIcon,
    Bars3BottomLeftIcon,
    ChevronDownIcon,
    ChevronUpIcon,
    CloudArrowDownIcon,
    CloudArrowUpIcon,
    CurrencyDollarIcon,
    EllipsisVerticalIcon,
    EnvelopeIcon,
    HeartIcon,
    LinkIcon,
    ListBulletIcon,
    MagnifyingGlassIcon,
    NoSymbolIcon,
    PlusIcon,
    StarIcon,
    TrashIcon,
    UserGroupIcon,
    UserIcon,
    XMarkIcon,
  },
  props: {
    items: {
      type: Array,
      required: true,
    },
    modelValue: {},
  },
  data() {
    return {
      query: '',
      open: false,
    };
  },
  computed: {
    filteredItems() {
      return this.query === ''
        ? this.items
        : this.items.filter((item) => {
            return item.name.toLowerCase().includes(this.query.toLowerCase());
          });
    },
    selectedItem: {
      get() {
        return this.modelValue;
      },
      set(val) {
        this.$emit('update:modelValue', val);
      },
    },
  },
};
</script>
