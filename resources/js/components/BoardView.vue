<template>
  <div
    class="flex h-screen space-x-4 bg-slate-100 px-4 py-2 dark:bg-jovieDark-900">
    <div v-for="list in lists">
      <div class="w-80 overflow-y-auto py-2">
        <div
          class="flex items-center justify-between bg-slate-100 px-2 py-4 dark:bg-jovieDark-900">
          <div
            class="items-center text-sm text-slate-600 dark:text-jovieDark-100">
            <ColorDot class="mr-2" :color="list.color" />
            {{ list.name }}
          </div>
          <div class="flex">
            <div class="font-medium text-slate-500 dark:text-jovieDark-200">
              <div
                class="cursor-pointer rounded p-1 hover:bg-slate-200 dark:hover:bg-jovieDark-700">
                <PlusIcon class="h-4 w-4 rounded text-slate-500" />
              </div>
            </div>
            <div class="font-medium text-slate-500 dark:text-jovieDark-200">
              <div
                class="cursor-pointer rounded p-1 hover:bg-slate-200 dark:hover:bg-jovieDark-700">
                <EllipsisHorizontalIcon
                  class="h-4 w-4 rounded text-slate-500" />
              </div>
            </div>
          </div>
        </div>
        <ul role="list" class="flex w-80 flex-col space-y-4 overflow-y-scroll">
          <li v-for="contact in contacts" :key="contact.id">
            <ContactCard :contact="contact" />
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    lists: {
      type: Array,
      required: true,
    },
    contacts: {
      type: Array,
      required: true,
    },
  },
};
</script>

<script setup>
import { EnvelopeIcon, PhoneIcon } from '@heroicons/vue/20/solid';
import ColorDot from './ColorDot.vue';
import ButtonGroup from './ButtonGroup.vue';
import ContactCard from './ContactCard.vue';
import { PlusIcon, EllipsisHorizontalIcon } from '@heroicons/vue/24/solid';
const lists = [
  {
    name: 'Lead',
    color: 'blue',
    count: 5,
  },
  {
    name: 'Contacted',
    color: 'green',
    count: 2,
  },
  {
    name: 'Qualified',
    color: 'pink',
    count: 1,
  },
];

const people = [
  {
    name: 'Jane Cooper',
    title: 'Regional Paradigm Technician',
    role: 'Admin',
    email: 'janecooper@example.com',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Tom Cook',
    title: 'Senior Integration Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Harvey Wallin',
    title: 'Senior  Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  //add 10 more people
  {
    name: 'Jane Cooper',
    title: 'Regional Paradigm Technician',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Tom Cook',
    title: 'Senior Integration Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Harvey Wallin',
    title: 'Senior  Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Tom Cook',
    title: 'Senior Integration Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Harvey Wallin',
    title: 'Senior  Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Tom Cook',
    title: 'Senior Integration Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Harvey Wallin',
    title: 'Senior  Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Tom Cook',
    title: 'Senior Integration Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Harvey Wallin',
    title: 'Senior  Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Tom Cook',
    title: 'Senior Integration Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Harvey Wallin',
    title: 'Senior  Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Tom Cook',
    title: 'Senior Integration Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Harvey Wallin',
    title: 'Senior  Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Tom Cook',
    title: 'Senior Integration Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Harvey Wallin',
    title: 'Senior  Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Tom Cook',
    title: 'Senior Integration Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Harvey Wallin',
    title: 'Senior  Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Tom Cook',
    title: 'Senior Integration Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },
  {
    name: 'Harvey Wallin',
    title: 'Senior  Specialist',
    role: 'Admin',
    email: '',
    telephone: '+1-202-555-0170',
    imageUrl:
      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwc2hvcHBpbmclMjBzdXJlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
  },

  // More people...
];
</script>
