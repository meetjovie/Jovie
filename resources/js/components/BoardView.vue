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
import userService from '../services/api/user.service';
import contactService from '../services/api/contact.service';

export default {
  data() {
    return {
      contacts: [],
      lists: [],
    };
  },
  mounted() {
    this.getStagedContacts();
  },
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
  props: {
    listId: {
      type: Number,
      required: true,
    },
  },
};
</script>
