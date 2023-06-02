<template>
  <div
    class="flex h-screen space-x-4 bg-slate-100 px-4 py-2 dark:bg-jovieDark-900">
    <div v-for="(list, index) in lists">
      <div class="w-80 overflow-auto py-2">
        <div
          class="flex items-center justify-between bg-slate-100 px-2 py-4 dark:bg-jovieDark-900">
          <div
            class="items-center text-sm text-slate-600 dark:text-jovieDark-100">
            <ColorDot class="mr-2" :color="list.color" />
            {{ list }}
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
          <li v-for="contact in contacts[index]" :key="contact.id">
              <h1>{{ contact.id }}</h1>
            <ContactCard :contact="contact" />
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
// export default {
//   props: {
//     lists: {
//       type: Array,
//       required: true,
//     },
//     contacts: {
//       type: Array,
//       required: true,
//     },
//   },
// };
import draggable from 'vuedraggable';
import ContactTags from '../components/Contact/ContactTags.vue';
import SocialIcons from '../components/SocialIcons.vue';
import { EnvelopeIcon, PhoneIcon } from '@heroicons/vue/24/solid';
import NoAccess from '../components/NoAccess.vue';
import contactService from '../services/api/contact.service';
import userService from '../services/api/user.service';
import ContactAvatar from '../components/ContactAvatar.vue';
export default {
  name: 'two-lists',
  display: 'Two Lists',
  order: 1,
  components: {
    ContactAvatar,
    draggable,
    EnvelopeIcon,
    PhoneIcon,
    SocialIcons,
    NoAccess,
    ContactTags,
  },
  mounted() {
    //add segment analytics
    this.getStagedContacts();
    window.analytics.page(this.$route.path);
  },
  props: {
    suggestion: {
      type: Array,
    },
  },
  data() {
    return {
      lists: [],
      contacts: [],
    };
  },
  methods: {
    add: function () {
      this.list.push({ name: 'Juan' });
    },
    replace: function () {
      this.list = [{ name: 'Edgard' }];
    },
    clone: function (el) {
      return {
        name: el.name + ' cloned',
      };
    },
    updateStage: function (event, stage) {
      if (event.added) {
        let contact = event.added.element;
        contact.stage = stage;
        userService.updateContact(contact);
      }
    },
    getStagedContacts() {
      contactService
        .getStagedContacts()
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.lists = response.stages;
            this.contacts = response.contacts;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
