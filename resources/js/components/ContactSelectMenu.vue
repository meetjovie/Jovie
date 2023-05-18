<template>
  <Menu
    as="div"
    v-slot="{ open, close }"
    @close="closeMenu()"
    class="relative z-10 inline-block w-full items-center text-left">
    <Float portal :offset="0" shift placement="bottom-start">
      <MenuButton
        ref="menuButton"
        @click="open"
        class="flex w-full justify-between px-2">
        <div
          class="group my-0 -ml-1 line-clamp-1 inline-flex items-center justify-between rounded-full border border-slate-200 px-2 py-0.5 text-2xs font-medium leading-5 dark:border-jovieDark-border dark:bg-jovieDark-800 dark:text-jovieDark-200">
          <ColorDot class="mr-1" color="slate" />
          {{ contact[attributekey] ?? 'Choose one' }}
        </div>
        <div class="items-center">
          <ChevronDownIcon
            class="mt-1 h-4 w-4 text-slate-600 dark:text-jovieDark-400" />
        </div>
      </MenuButton>
      <TransitionRoot
        :show="open"
        enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-75 ease-in"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0">
        <MenuItems @focus="focusInput()" static as="div">
          <GlassmorphismContainer
            class="z-30 mt-2 max-h-80 w-40 origin-top-right px-1 py-1 ring-opacity-5 focus-visible:outline-none">
            <DropdownMenuItem
              :shortcutKey="['s']"
              ref="child"
              v-on:search-query="updateAttributeSearchQuery"
              :searchBox="{
                query: 'attributeSearchQuery',
                placeholder: `Set ${attributekey}...`,
              }" />
            <DropdownMenuItem separator />

            <div class="border-slate-200 dark:border-jovieDark-border">
              <div v-for="option in options" :key="option">
                <DropdownMenuItem
                  :name="option"
                  colorDot="slate"
                  checkable
                  :checked="option == contact[attributekey]"
                  @click="
                    $emit('updateContact', {
                      id: contact.id,
                      index: index,
                      key: attributekey,
                      value: option,
                    })
                  ">
                </DropdownMenuItem>
              </div>
              <DropdownMenuItem
                disabled
                name="No match"
                v-if="options.length === 0" />
              <DropdownMenuItem
                name="Clear search"
                icon="XMarkIcon"
                v-if="attributeSearchQuery"
                :disabled="!attributeSearchQuery"
                @click="attributeSearchQuery = ''" />
            </div>
          </GlassmorphismContainer>
        </MenuItems>
      </TransitionRoot>
    </Float>
  </Menu>
</template>
<script>
import KBShortcut from './../components/KBShortcut.vue';
import ColorDot from './../components/ColorDot.vue';
import DropdownMenuItem from './../components/DropdownMenuItem.vue';
import GlassmorphismContainer from './../components/GlassmorphismContainer.vue';
import {
  Menu,
  MenuButton,
  MenuItems,
  MenuItem,
  TransitionRoot,
} from '@headlessui/vue';
import { ChevronDownIcon, CheckIcon, XMarkIcon } from '@heroicons/vue/24/solid';
import { Float } from '@headlessui-float/vue';

export default {
  components: {
    KBShortcut,
    GlassmorphismContainer,
    DropdownMenuItem,
    TransitionRoot,
    Menu,
    ColorDot,
    XMarkIcon,
    MenuItem,
    ChevronDownIcon,
    CheckIcon,
    Float,
    MenuButton,
    MenuItems,
  },
  mounted() {
    this.$mousetrap.bind('s', () => {
      if (this.currentContact.id == this.contact.id) {
        this.open = true;
      } else {
        console.log('not the same');
      }
    });
  },
  props: {
    contact: {
      type: Object,
      required: true,
    },
    attributekey: {
      type: String,
      required: true,
    },
    key: {
      type: [String, Number],
      required: true,
    },
    options: {
      type: Array,
      required: true,
    },
    index: {
      type: Number,
      required: true,
    },
    open: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      attributeSearchQuery: '',
    };
  },
  methods: {
    logIt() {
      console.log('logIt');
      this.$refs.menuButton.$el.click();
    },
    updateAttributeSearchQuery(query) {
      this.attributeSearchQuery = query;
    },
    closeMenu() {
      this.$emit('closeMenu');
    },
    toggleMenuOpen() {
      if (this.menuOpen) {
        this.menuOpen = false;
      } else {
        this.menuOpen = true;
      }
    },
    focusInput() {
      this.$refs.child.$emit('focus');
    },
  },
};
</script>
