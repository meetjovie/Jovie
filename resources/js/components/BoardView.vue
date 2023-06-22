<template>
  <div class="flex h-screen space-x-6 bg-slate-100 px-4 dark:bg-jovieDark-900">
    <div
      v-for="(list, listIndex) in lists"
      :key="listIndex"
      class="overflow-y-auto">
      <ListHeader :list="list" />
      <ul role="list" class="mt-14 flex flex-col space-y-2">
        <draggable
          :list="contacts[listIndex]"
          group="people"
          @change="changeStage($event, listIndex)"
          itemKey="name">
          <template #item="{ element, index }">
            <div class="w-96">
              <ContactCard
                @contextMenuClicked="handleContextMenu($event, element)"
                @contextMenuButtonClicked="
                  handleContextMenuButton($event, element)
                "
                @click="setCurrentContact($event, element, index)"
                @openSidebar="
                  $emit('openSidebar', { contact: element, index: index })
                "
                class="w-80"
                :contact="element" />
            </div>
          </template>
        </draggable>
      </ul>
    </div>
  </div>
</template>

<script>
import ListHeader from './ListHeader.vue';
import ContactCard from './ContactCard.vue';
import draggable from 'vuedraggable';

export default {
  components: {
    ListHeader: ListHeader,
    ContactCard: ContactCard,
    draggable: draggable,
  },
  methods: {
    changeStage: function (evt, list) {
      if (evt.added) {
        this.$emit('updateContact', {
          id: evt.added.element.id,
          key: `stage`,
          value: list,
        });
      }
    },
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
