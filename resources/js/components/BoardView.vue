<template>
  <div class="flex h-screen space-x-6 bg-slate-100 px-4 dark:bg-jovieDark-900">
    <div v-for="list in lists" :key="list.id" class="overflow-y-auto">
      <ListHeader :list="list" />

      <ul role="list" class="mt-14 flex flex-col space-y-2">
        <li class="w-96" v-for="contact in contacts" :key="contact.id">
          <ContactCard
            @contextMenuClicked="handleContextMenu($event, contact)"
            @contextMenuButtonClicked="handleContextMenuButton($event, contact)"
            @click="setCurrentContact($event, element, index)"
            @openSidebar="
              $emit('openSidebar', { contact: element, index: index })
            "
            class="w-80"
            :contact="contact" />
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  methods: {
    handleMenuButton(event, contact) {
      event.preventDefault(); // Prevents the default context menu from showing up
      const coordinates = {
        x: event.pageX, // Extract the x-coordinate from the event
        y: event.pageY, // Extract the y-coordinate from the event
      };

      console.log('context menu clicked ' + contact.full_name);
      this.$emit('contextMenuButtonClicked', contact, coordinates);
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
  },
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
import ListHeader from './ListHeader.vue';
import { EnvelopeIcon, PhoneIcon } from '@heroicons/vue/20/solid';
import ColorDot from './ColorDot.vue';
import ButtonGroup from './ButtonGroup.vue';
import ContactCard from './ContactCard.vue';
import { PlusIcon, EllipsisHorizontalIcon } from '@heroicons/vue/24/solid';
const lists = [
  {
    name: 'Lead',
    color: 'blue',
    count: 1,
  },
  {
    name: 'Contacted',
    color: 'green',
    count: 2,
  },
  {
    name: 'Qualified',
    color: 'pink',
    count: 3,
  },
  {
    name: 'Lead',
    color: 'blue',
    count: 4,
  },
  {
    name: 'Contacted',
    color: 'green',
    count: 5,
  },
  {
    name: 'Qualified',
    color: 'pink',
    count: 6,
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
