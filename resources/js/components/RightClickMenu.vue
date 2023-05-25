<template>
  <teleport to="#crm">
    <div
      ref="rightClickMenu"
      style="z-index: 9999"
      :style="{ top: y + 'px', left: x + 'px' }"
      class="absolute">
      <Menu>
        <TransitionRoot
          :show="show"
          enter-active-class="transition ease-out duration-100"
          enter-from-class="transform opacity-0 scale-95"
          enter-to-class="transform opacity-100 scale-100"
          leave-active-class="transition ease-in duration-75"
          leave-from-class="transform opacity-100 scale-100"
          leave-to-class="transform opacity-0 scale-95">
          <MenuItems as="div" :style="{ top: y + 'px', left: x + 'px' }" static>
            <GlassmorphismContainer
              style="z-index: 9999"
              class="z-10 mt-2 w-48 origin-top-right px-1 py-1 ring-1 ring-black ring-opacity-5 focus-visible:outline-none">
              <div class="py-1">
                <ContactContextMenuItem
                  :contact="contact"
                  :contactMethods="[
                    'email',
                    'phone',
                    'sms',
                    'calendar',
                    'instagram',

                    'twitter',

                    'whatsapp',
                    'separator',
                    'validate',
                  ]">
                  <DropdownMenuItem
                    name="Refresh"
                    color="text-green-600 dark:text-green-400"
                    icon="ArrowPathIcon"
                    v-if="currentUser.is_admin"
                    @click="$emit('refresh', contact)" />

                  <DropdownMenuItem
                    :name="
                      filters.type == 'archived' && contact.archived
                        ? 'Unarchive'
                        : 'Archive'
                    "
                    icon="ArchiveBoxIcon"
                    @blur="$emit('updateContact')"
                    @click="
                      $emit('archive-contacts', contact.id, !contact.archived)
                    "
                    color="text-blue-600
            dark:text-blue-400" />
                  <DropdownMenuItem
                    v-if="filters.list"
                    name="Remove from list"
                    icon="TrashIcon"
                    danger
                    color="text-red-600 dark:text-red-400"
                    @click="
                      $emit(
                        'toggleContactsFromList',
                        contact.id,
                        filters.list,
                        true
                      )
                    " />
                </ContactContextMenuItem>
              </div>
            </GlassmorphismContainer>
          </MenuItems>
        </TransitionRoot>
      </Menu>
    </div>
  </teleport>
</template>
<script>
import ContactContextMenu from './ContactContextMenu.vue';
import ContactContextMenuItem from './ContactContextMenuItem.vue';
import DropdownMenuItem from './DropdownMenuItem.vue';
import { Menu, MenuButton, MenuItems, TransitionRoot } from '@headlessui/vue';
import { CloudArrowDownIcon } from '@heroicons/vue/24/solid';
import GlassmorphismContainer from './GlassmorphismContainer.vue';

export default {
  components: {
    ContactContextMenu,
    ContactContextMenuItem,
    DropdownMenuItem,
    Menu,
    MenuButton,
    MenuItems,
    TransitionRoot,
    CloudArrowDownIcon,
    GlassmorphismContainer,
  },
  mounted() {
    document.addEventListener('click', this.closeMenu);
  },
  beforeUnmount() {
    document.removeEventListener('click', this.closeMenu);
  },
  methods: {
    hideMenu() {
      console.log('hide menu');
      //emit event to parent
      this.$emit('hide-menu');
    },

    closeMenu(event) {
      //if click outside of menu and trigger is not menu-button then hideMenu()
      if (
        !this.$refs.rightClickMenu.contains(event.target) &&
        this.trigger !== 'menu-button'
      ) {
        this.hideMenu();
        console.log('Menu closed' + this.trigger);
      }
    },
  },
  //add props
  props: {
    contact: {
      type: Object,
      required: false,
    },
    show: {
      type: Boolean,
      default: false,
    },
    trigger: {
      type: String,
      default: 'right-click',
    },
    x: {
      type: Number,
      default: 0,
    },
    y: {
      type: Number,
      default: 0,
    },
  },
};
</script>
