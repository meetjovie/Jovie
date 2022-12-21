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
          class="group my-0 -ml-1 inline-flex items-center justify-between rounded-full border border-slate-200 px-2 py-0.5 text-2xs font-medium leading-5 line-clamp-1 dark:border-jovieDark-border dark:bg-jovieDark-800 dark:text-jovieDark-200">
          <ColorDot
            class="mr-1"
            :color="color(creator.crm_record_by_user.stage_name)" />
          {{ creator.crm_record_by_user.stage_name }}
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
            <!-- <div class="px-1"> -->
            <!-- <MenuItem @focus="focusStageInput()" v-slot="{ active }" as="div">
                <div class="relative flex items-center">
                  <input
                    ref="stageInput"
                    v-model="stageSearchQuery"
                    placeholder="Set stage..."
                    class="w-full border-0 border-none border-transparent bg-transparent py-2 pl-1 pr-4 text-xs font-medium text-slate-600 outline-0 ring-0 placeholder:font-light placeholder:text-slate-400 focus:border-transparent focus:ring-0 focus:ring-transparent focus:ring-offset-0 dark:text-jovieDark-200" />
                  <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                    <KBShortcut hasBg :shortcutKey="['s']" />
                  </div>
                </div>
              </MenuItem> -->
            <!--  </div> -->
            <DropdownMenuItem
              :shortcutKey="['s']"
              ref="child"
              v-on:search-query="updateStageSearchQuery"
              :searchBox="{
                query: 'stageSearchQuery',
                placeholder: 'Set stage...',
              }" />
            <DropdownMenuItem separator />

            <div class="border-slate-200 dark:border-jovieDark-border">
              <div v-for="(stage, key) in filteredStage" :key="stage">
                <DropdownMenuItem
                  :name="stage"
                  :colorDot="color(stage)"
                  checkable
                  :checked="stage === creator.crm_record_by_user.stage_name"
                  @click="
                    $emit('updateCreator', {
                      id: creator.id,
                      index: index,
                      key: `crm_record_by_user.stage`,
                      value: key,
                    })
                  ">
                </DropdownMenuItem>
              </div>
              <DropdownMenuItem
                disabled
                name="No match"
                v-if="filteredStage.length === 0" />
              <!--  <MenuItem
                as="div"
                v-slot="{ active }"
                :class="{ 'text-slate-700': active }"
                v-if="stageSearchQuery"
                :disabled="!stageSearchQuery"
                @click="stageSearchQuery = ''"
                class="hover: group mt-1 flex w-full cursor-pointer items-center border-t border-slate-200 px-2 py-1 text-xs text-slate-600 hover:text-slate-600 dark:border-jovieDark-border dark:text-jovieDark-400 dark:text-jovieDark-400">
                <div class="mx-auto flex items-center text-center">
                  <div class="mr-2 w-3 text-xs font-bold opacity-50">
                    <XMarkIcon
                      class="h-3 w-3 text-slate-600 dark:text-jovieDark-400" />
                  </div>
                  <div class="text-center text-xs font-semibold text-slate-400">
                    Clear search
                  </div>
                </div>
              </MenuItem> -->
              <DropdownMenuItem
                name="Clear search"
                icon="XMarkIcon"
                v-if="stageSearchQuery"
                :disabled="!stageSearchQuery"
                @click="stageSearchQuery = ''" />
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
      //if  currentContact.id == creator.id set open to true
      if (this.currentContact.id == this.creator.id) {
        this.open = true;
      } else {
        console.log('not the same');
      }
    });
  },
  props: {
    creator: {
      type: Object,
      required: true,
    },
    key: {
      type: String,
      required: true,
    },
    stages: {
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
      stageSearchQuery: '',
    };
  },
  computed: {
    filteredStage() {
      return this.stages.filter((stage) =>
        stage.toLowerCase().includes(this.stageSearchQuery.toLowerCase())
      );
    },
  },
  methods: {
    color(stageName) {
      switch (stageName) {
        case 'Lead':
          return 'indigo';
        case 'Interested':
          return 'green';
        case 'Negotiating':
          return 'blue';
        case 'In Progress':
          return 'pink';
        case 'Complete':
          return 'purple';
        case 'Not Interested':
          return 'red';
        default:
          return 'slate';
      }
    },
    logIt() {
      console.log('logIt');
      //click the menu bitton
      this.$refs.menuButton.$el.click();
    },
    updateStageSearchQuery(query) {
      this.stageSearchQuery = query;
    },
    closeMenu() {
      //emit close menu
      this.$emit('closeMenu');
    },
    toggleMenuOpen() {
      //if menu open is true, close it
      if (this.menuOpen) {
        this.menuOpen = false;
      } else {
        //if menu open is false, open it
        this.menuOpen = true;
      }
    },
    focusInput() {
      this.$refs.child.$emit('focus');
    },
  },
};
</script>
