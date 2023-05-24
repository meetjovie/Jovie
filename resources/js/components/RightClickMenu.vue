<template>
  <button
    class="cursor-pointer rounded bg-slate-200 px-4 py-2 text-slate-700 active:scale-95"
    @click="hideMenu()">
    {{ show ? 'Hide' : 'Show' }} Menu
  </button>
  <teleport to="#crm">
    <div>jooooooofd</div>
    <Menu>
      <TransitionRoot
        :show="show"
        enter-active-class="transition ease-out duration-100"
        enter-from-class="transform opacity-0 scale-95"
        enter-to-class="transform opacity-100 scale-100"
        leave-active-class="transition ease-in duration-75"
        leave-from-class="transform opacity-100 scale-100"
        leave-to-class="transform opacity-0 scale-95">
        <MenuItems>
          <GlassmorphismContainer
            :style="{ top: y + 'px', left: x + 'px' }"
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
              </ContactContextMenuItem>

              <slot></slot>
            </div>
          </GlassmorphismContainer>
        </MenuItems>
      </TransitionRoot>
    </Menu>
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
  methods: {
    hideMenu() {
      console.log('hide menu');
      //emit event to parent
      this.$emit('hide-menu');
    },
    showMenu(e) {
      this.x = e.pageX;
      this.y = e.pageY;
      this.show = true;
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
