<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <Listbox as="div" v-model="selected">
        <ListboxLabel v-if="label" :for="name" class="block text-sm font-medium text-gray-700"> {{ label }}
        </ListboxLabel>
        <div class="mt-1 relative">
            <ListboxButton
                class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <span class="block truncate">{{ selected.name }}</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
          <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
        </span>
            </ListboxButton>

            <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100"
                        leave-to-class="opacity-0">
                <ListboxOptions
                    class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                    <ListboxOption as="template" v-for="item in items" :key="item.id" :value="item"
                                   v-slot="{ active, selected }">
                        <li :class="[active ? 'text-white bg-indigo-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
              <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">
                {{ item.name }}
              </span>

                            <span v-if="selected"
                                  :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                <CheckIcon class="h-5 w-5" aria-hidden="true"/>
              </span>
                        </li>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </div>
    </Listbox>
</template>

<script>
import {Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions} from '@headlessui/vue'
import {CheckIcon, SelectorIcon} from '@heroicons/vue/solid'

export default {
    components: {
        Listbox,
        ListboxButton,
        ListboxLabel,
        ListboxOption,
        ListboxOptions,
        CheckIcon,
        SelectorIcon,
    },
    data() {
        return {
            items: [
                {id: 1, name: 'first_name'},
                {id: 2, name: 'last_name'},
                {id: 3, name: 'email'},
                {id: 4, name: 'phone'},
                {id: 5, name: 'address'},
                {id: 6, name: 'city'},
                {id: 7, name: 'state'},
                {id: 8, name: 'zip'},
                {id: 9, name: 'country'},
                {id: 10, name: 'company'},
                {id: 11, name: 'job_title'},
                {id: 12, name: 'website'},
                {id: 13, name: 'twitter'},
                {id: 14, name: 'facebook'},
                {id: 15, name: 'instagram'},
                {id: 16, name: 'linkedin'},
                {id: 17, name: 'github'},
                {id: 18, name: 'skype'},
                {id: 19, name: 'birthday'},

            ],
            selected: {id: 19, name: 'birthday'}
        }
    },
    watch: {
        selected(val) {
            console.log(val);
        }
    }
}
</script>
