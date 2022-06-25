<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Listbox as="div" v-model="selected">
    <div class="relative">
      <ListboxButton
        class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus-visible:border-indigo-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-indigo-500 sm:text-sm">
        <span class="block truncate">{{ selected ?? 'Select' }}</span>
        <span
          class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
          <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </span>
      </ListboxButton>

      <transition
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0">
        <ListboxOptions
          class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus-visible:outline-none sm:text-sm">
          <ListboxOption
            as="template"
            :key="null"
            :value="null"
            v-slot="{ active, selected }">
            <li
              :class="[
                active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                'relative cursor-default select-none py-2 pl-3 pr-9',
              ]">
              <span
                :class="[
                  selected ? 'font-semibold' : 'font-normal',
                  'block truncate',
                ]">
                {{ 'Select' }}
              </span>

              <span
                v-if="selected"
                :class="[
                  active ? 'text-white' : 'text-indigo-600',
                  'absolute inset-y-0 right-0 flex items-center pr-4',
                ]">
                <CheckIcon class="h-5 w-5" aria-hidden="true" />
              </span>
            </li>
          </ListboxOption>
          <ListboxOption
            as="template"
            v-for="column in columnsToMap"
            :key="column"
            :value="column"
            v-slot="{ active, selected }">
            <li
              :class="[
                active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                'relative cursor-default select-none py-2 pl-3 pr-9',
              ]">
              <span
                :class="[
                  selected ? 'font-semibold' : 'font-normal',
                  'block truncate',
                ]">
                {{ column }}
              </span>

              <span
                v-if="selected"
                :class="[
                  active ? 'text-white' : 'text-indigo-600',
                  'absolute inset-y-0 right-0 flex items-center pr-4',
                ]">
                <CheckIcon class="h-5 w-5" aria-hidden="true" />
              </span>
              <span
                v-else-if="mappedColumns.hasOwnProperty(column)"
                :class="[
                  active ? 'text-red-900' : 'text-red-900',
                  'absolute inset-y-0 right-0 flex items-center pr-4',
                ]">
                <BanIcon class="h-5 w-5" aria-hidden="true" />
              </span>
            </li>
          </ListboxOption>
        </ListboxOptions>
      </transition>
    </div>
  </Listbox>
</template>

<script>
import {
  Listbox,
  ListboxButton,
  ListboxLabel,
  ListboxOption,
  ListboxOptions,
} from '@headlessui/vue';
import { CheckIcon, SelectorIcon, BanIcon } from '@heroicons/vue/solid';

export default {
  components: {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    CheckIcon,
    BanIcon,
    SelectorIcon,
  },
  props: {
    columnsToMap: {
      type: Array,
      required: true,
    },
    mappedColumns: {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
      selected: null,
    };
  },
  watch: {
    selected(mapColumn) {
      this.$emit('setMappedColumns', { mapColumn });
    },
  },
};
</script>
