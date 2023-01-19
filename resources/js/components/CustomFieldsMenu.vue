<template>
  <Popover class="relative">
    <Float shift portal placement="left-start">
      <PopoverButton>
        <slot>
          <PlusIcon
            class="h-4 w-4 text-slate-600 dark:text-jovieDark-200"></PlusIcon>
        </slot>
      </PopoverButton>

      <PopoverPanel v-slot="{ close }" class="z-10">
        <GlassmorphismContainer class="w-80 px-4 py-2" size="3xl">
          <div class="flex flex-col space-y-4">
            <InputGroup
              tabindex="0"
              v-model="field.name"
              placeholder="Field Name"
              label="Field Name"
              type="text"
              :error="errors.name ? errors.name[0] : null"
              class="w-full border-0 border-none border-transparent bg-transparent px-1 py-2 text-xs font-medium text-slate-600 outline-0 ring-0 placeholder:font-light placeholder:text-slate-400 focus:border-transparent focus:ring-0 focus:ring-transparent focus:ring-offset-0" />
            <ComboboxMenu :items="customFieldTypes" v-model="field.type" />
          </div>
          <div v-if="field.type">
            <p
              class="text-xs font-semibold text-slate-600 dark:text-jovieDark-300">
              {{ field.type.description }}
            </p>
          </div>

          <div class="border-t border-slate-200 dark:border-jovieDark-border">
            <div
              v-if="
                field.type.name === 'Single Select' ||
                field.type.name === 'Multi Select'
              ">
              <div class="flex flex-col space-y-4">
                <div class="relative mt-1 flex items-center">
                  <input
                    type="text"
                    name="search"
                    id="search"
                    class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                  <div
                    class="absolute inset-y-0 right-0 flex items-center py-1.5 pr-1.5">
                    <PlusIcon
                      class="h-5 w-5 cursor-pointer rounded-md border border-slate-300 p-0.5 hover:bg-slate-200 hover:bg-jovieDark-700 hover:text-white dark:border-jovieDark-border" />
                  </div>
                </div>
                <!--  <div class="flex items-center">
                  <InputGroup
                    placeholder="Option"
                    label="Option"
                    type="text"
                    class="w-full border-0 border-none border-transparent bg-transparent px-1 py-2 text-xs font-medium text-slate-600 outline-0 ring-0 placeholder:font-light placeholder:text-slate-400 focus:border-transparent focus:ring-0 focus:ring-transparent focus:ring-offset-0" />
                  <ButtonGroup
                    class="w- h-8"
                    icon="PlusIcon"
                    :disabled="adding" />
                </div> -->
                <div>
                  <ul>
                    <!-- v-for on the li element -->
                    <li>
                      <span
                        class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800"
                        >Option Name</span
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div
            v-if="errors.type"
            class="min-h-4 text-xs text-red-600 dark:text-red-300">
            <span>
              {{ errors.type[0] }}
            </span>
          </div>
          <ButtonGroup
            class="mt-4"
            text="Add Field"
            :disabled="adding"
            @click="saveCustomField" />
        </GlassmorphismContainer>
      </PopoverPanel>
    </Float>
  </Popover>
</template>

<script>
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  Menu,
  MenuItems,
} from '@headlessui/vue';
import GlassmorphismContainer from './GlassmorphismContainer.vue';
import { Float } from '@headlessui-float/vue';
import JovieDropdownMenu from './JovieDropdownMenu.vue';
import { PlusIcon } from '@heroicons/vue/24/solid';
import InputGroup from './InputGroup.vue';
import ButtonGroup from './ButtonGroup.vue';
import FieldService from '../services/api/field.service';
import DropdownMenuItem from './DropdownMenuItem.vue';
import ComboboxMenu from './ComboboxMenu.vue';

export default {
  name: 'CustomFieldsMenu',
  components: {
    PlusIcon,

    JovieDropdownMenu,
    GlassmorphismContainer,
    Popover,
    PopoverButton,
    PopoverPanel,
    Float,
    InputGroup,
    ButtonGroup,
    DropdownMenuItem,
    Menu,
    MenuItems,
    ComboboxMenu,
  },
  data() {
    return {
      isOpen: true,

      fieldType: '',
      customFieldTypes: [],
      errors: {},
      field: {
        name: '',
        type: '',
        description: '',
      },
      adding: false,
    };
  },
  mounted() {
    this.getCustomFieldTypes();
  },
  methods: {
    saveCustomField() {
      this.adding = true;
      FieldService.saveCustomField(this.field)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 40000,
              title: 'Successful',
              text: response.message,
            });
            this.field = {
              name: '',
              type: '',
            };
          } else {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          if (error.response && error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        })
        .finally((response) => {
          this.adding = false;
          close();
        });
    },
    getCustomFieldTypes() {
      FieldService.getCustomFieldTypes()
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.customFieldTypes = response.data;
          } else {
            this.$notify({
              group: 'user',
              type: 'error',
              duration: 15000,
              title: 'Error',
              text: response.message,
            });
          }
        })
        .catch((error) => {})
        .finally((response) => {});
    },
    closeDialog() {
      this.isOpen = false;
    },
    setIsOpen(value) {
      this.isOpen = value;
    },
    addCustomField(field) {
      console.log('field');
      this.fieldType = field.name;
      isOpen = true;
      console.log(field);
    },
  },
};
</script>
