<template>
  <div class="flex h-screen space-x-6 bg-slate-100 px-4 dark:bg-jovieDark-900">
    <div v-for="(list, listIndex) in lists" :key="listIndex" class="overflow-y-auto">
      <ListHeader :list="list" />

      <ul role="list" class="mt-14 flex flex-col space-y-2">
        <li class="w-96" v-for="contact in contacts[listIndex]" :key="contact.id">
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
import ListHeader from './ListHeader.vue';
import ContactCard from './ContactCard.vue';
export default {
  components: {
    ListHeader: ListHeader,
    ContactCard: ContactCard,
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
