<template>
  <Menu
    v-bind:open="open"
    v-slot="{ close }"
    as="div"
    class="relative inline-block text-left">
    <Float
      enter="transition duration-200 ease-out"
      enter-from="scale-95 opacity-0"
      enter-to="scale-100 opacity-100"
      leave="transition duration-150 ease-in"
      leave-from="scale-100 opacity-100"
      leave-to="scale-95 opacity-0"
      tailwindcss-origin-class
      flip
      :offset="10"
      shift
      portal
      arrow
      placement="right-start">
      <MenuButton
        @click="open = !open"
        class="flex items-center rounded-full text-slate-400/0 transition-all hover:text-slate-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-100 active:bg-slate-200 group-hover:text-slate-400 dark:hover:text-slate-400 dark:active:bg-slate-800 dark:group-hover:text-slate-600">
        <span class="sr-only">Open options</span>
        <EllipsisVerticalIcon class="z-0 mt-0.5 h-5 w-5" aria-hidden="true" />
      </MenuButton>
      <TransitionRoot
        :show="open"
        enter-active-class="transition ease-out duration-100"
        enter-from-class="transform opacity-0 scale-95"
        enter-to-class="transform opacity-100 scale-100"
        leave-active-class="transition ease-in duration-75"
        leave-from-class="transform opacity-100 scale-100"
        leave-to-class="transform opacity-0 scale-95">
        <MenuItems>
          <GlassmorphismContainer
            class="z-10 mt-2 w-48 origin-top-right py-1 px-1 ring-1 ring-black ring-opacity-5 focus-visible:outline-none">
            <div class="py-1">
              <ContactContextMenuItem
                :creator="creator"
                :contactMethods="[
                  'email',
                  'sms',
                  'instagram',
                  'calendar',
                  'separator',
                  'twitter',
                  'phone',
                  'whatsapp',
                  'validate',
                ]">
              </ContactContextMenuItem>

              <!-- Work in progress -->
              <!--  <MenuItem
                                      v-slot="{ active }"
                                      class="cursor-pointer items-center">
                                      <button
                                        @click="downloadVCF(this.creator)"
                                        :class="[
                                          active
                                            ? 'bg-slate-100 text-slate-900 dark:bg-jovieDark-700 dark:text-jovieDark-100'
                                            : 'text-slate-700 dark:text-jovieDark-200',
                                          'group  flex w-full items-center rounded-md px-2 py-2 text-xs disabled:cursor-not-allowed disabled:opacity-50',
                                        ]">
                                        <CloudArrowDownIcon
                                          class="mr-2 inline h-4 w-4 text-violet-400" />
                                        Download VCard
                                      </button>
                                    </MenuItem> -->
              <slot></slot>
            </div>
          </GlassmorphismContainer>
        </MenuItems>
      </TransitionRoot>
    </Float>
  </Menu>
</template>
<script>
import GlassmorphismContainer from './../components/GlassmorphismContainer.vue';
import { Float } from '@headlessui-float/vue';
import { Menu, MenuButton, MenuItems, TransitionRoot } from '@headlessui/vue';
import ContactContextMenuItem from './../components/ContactContextMenuItem.vue';
import { EllipsisVerticalIcon } from '@heroicons/vue/24/solid';

export default {
  components: {
    ContactContextMenuItem,
    GlassmorphismContainer,
    Float,
    Menu,
    MenuButton,
    MenuItems,
    TransitionRoot,
    EllipsisVerticalIcon,
  },
  props: {
    creator: {
      type: Object,
      required: true,
    },
    open: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
  methods: {
    close() {
      //close
    },
  },
};
</script>
