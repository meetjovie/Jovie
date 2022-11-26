<template>
  <Menu
    as="div"
    v-slot="{ open }"
    class="relative z-10 inline-block w-full items-center text-left">
    <Float portal :offset="0" shift placement="bottom-start">
      <MenuButton
        ref="menuButton"
        @click="open"
        class="flex w-full justify-between px-2">
        <div
          class="group my-0 -ml-1 inline-flex items-center justify-between rounded-full px-2 py-0.5 text-2xs font-medium leading-5 line-clamp-1"
          :class="[
            {
              'bg-indigo-50 text-indigo-600':
                creator.crm_record_by_user.stage_name === 'Lead',
            },
            {
              'bg-sky-50 text-sky-600':
                creator.crm_record_by_user.stage_name === 'Interested',
            },
            {
              'bg-pink-50 text-pink-600':
                creator.crm_record_by_user.stage_name === 'Negotiating',
            },
            {
              'bg-fuchsia-50 text-fuchsia-600':
                creator.crm_record_by_user.stage_name === 'In Progress',
            },
            {
              'bg-red-50 text-red-600':
                creator.crm_record_by_user.stage_name === 'Complete',
            },
          ]">
          {{ creator.crm_record_by_user.stage_name }}
        </div>

        <div class="items-center">
          <ChevronDownIcon class="mt-1 h-4 w-4 text-slate-600" />
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
        <MenuItems
          static
          @focus="focusStageInput()"
          as="div"
          class="dark:bg-border-500 z-30 mt-2 max-h-80 w-40 origin-top-right divide-y divide-slate-100 rounded-lg border border-slate-200 bg-white/60 bg-clip-padding pb-2 pt-1 shadow-lg ring-1 ring-black ring-opacity-5 backdrop-blur-xl backdrop-saturate-150 backdrop-filter focus-visible:outline-none dark:border-slate-500 dark:bg-slate-900/60">
          <div class="px-1">
            <MenuItem v-slot="{ active }" as="div">
              <div class="relative flex items-center">
                <input
                  ref="stageInput"
                  v-model="stageSearchQuery"
                  placeholder="Set stage..."
                  class="w-full border-0 border-none border-transparent bg-transparent px-1 py-2 text-xs font-medium text-slate-600 outline-0 ring-0 placeholder:font-light placeholder:text-slate-400 focus:border-transparent focus:ring-0 focus:ring-transparent focus:ring-offset-0 dark:text-slate-200" />
                <!-- <div class="absolute inset-y-0 right-0 flex py-2 pr-1.5">
                  <kbd
                    class="inline-flex items-center rounded border border-slate-200 px-1 font-sans text-2xs font-medium text-slate-400"
                    >S</kbd
                  >
                </div> -->
              </div>
            </MenuItem>
          </div>

          <div class="border-t border-slate-200 px-2">
            <MenuItem
              as="div"
              v-slot="{ active }"
              v-for="(stage, key) in filteredStage"
              :key="stage"
              @click="
                $emit('updateCreator', {
                  id: creator.id,
                  index: index,
                  key: `crm_record_by_user.stage`,
                  value: key,
                })
              ">
              <div
                class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-slate-600"
                :class="{
                  'bg-slate-200 text-slate-700 dark:bg-slate-700 dark:text-slate-200':
                    active,
                }">
                <div class="flex">
                  <div class="mr-2 w-3 text-xs font-bold opacity-50">
                    <CheckIcon
                      v-if="stage === creator.crm_record_by_user.stage_name"
                      class="h-4 w-4 font-bold text-slate-600 hover:text-slate-700" />
                  </div>
                  <div class="mr-2 text-xs font-bold opacity-50">
                    <span
                      class="inline-block h-2 w-2 flex-shrink-0 rounded-full"
                      :class="[
                        {
                          'bg-indigo-600 text-indigo-600 dark:bg-indigo-400':
                            stage == 'Lead',
                        },
                        {
                          'bg-sky-600 text-sky-600 dark:bg-sky-400':
                            stage == 'Interested',
                        },
                        {
                          'bg-pink-600 text-pink-600 dark:bg-pink-400':
                            stage == 'Negotiating',
                        },
                        {
                          'bg-fuchsia-600 text-fuchsia-600 dark:bg-fuchsia-400':
                            stage == 'In Progress',
                        },
                        {
                          'bg-red-600 text-red-600 dark:bg-red-400':
                            stage == 'Complete',
                        },
                        {
                          'bg-slate-600 text-slate-600 dark:bg-slate-400':
                            stage == 'Not Interested',
                        },
                      ]"></span>
                  </div>

                  <div class="text-xs font-medium">
                    {{ stage }}
                  </div>
                </div>
              </div>
            </MenuItem>

            <MenuItem
              disabled
              as="div"
              v-slot="{ active }"
              v-if="filteredStage.length === 0">
              <div
                :class="{ 'bg-slate-200 dark:bg-slate-700': active }"
                class="group mt-1 flex w-full cursor-pointer items-center rounded-md px-2 py-1 text-xs text-slate-600">
                <div class="mx-auto flex">
                  <div class="text-center text-xs font-medium text-slate-300">
                    No match
                  </div>
                </div>
              </div>
            </MenuItem>

            <MenuItem
              as="div"
              v-slot="{ active }"
              :class="{ 'text-slate-700': active }"
              v-if="stageSearchQuery"
              :disabled="!stageSearchQuery"
              @click="stageSearchQuery = ''"
              class="group mt-1 flex w-full cursor-pointer items-center border-t border-slate-200 px-2 py-1 text-xs text-slate-600 hover:text-slate-600 dark:border-slate-700/40">
              <div class="mx-auto flex items-center text-center">
                <div class="mr-2 w-3 text-xs font-bold opacity-50">
                  <XMarkIcon class="h-3 w-3 text-slate-600" />
                </div>
                <div class="text-center text-xs font-semibold text-slate-400">
                  Clear search
                </div>
              </div>
            </MenuItem>
          </div>
        </MenuItems>
      </TransitionRoot>
    </Float>
  </Menu>
</template>
<script>
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
    TransitionRoot,
    Menu,
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
  },
  data() {
    return {
      open: false,
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
    logIt() {
      console.log('logIt');
      //click the menu bitton
      this.$refs.menuButton.$el.click();
    },
    closeMenu() {
      //after 2 seconds close the menu
      setTimeout(() => {
        this.menuOpen = false;
      }, 2000);
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
    focusStageInput() {
      this.$nextTick(() => {
        this.$refs.stageInput.focus();
      });
    },
  },
};
</script>
