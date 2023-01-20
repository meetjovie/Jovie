<template>
  <Popover class="relative">
    <Float shift portal placement="left-start">
      <PopoverButton class="">
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
          <div class="px-2 py-1" v-if="field.type">
            <p
              class="text-2xs font-semibold text-slate-600 dark:text-jovieDark-300">
              {{ field.type.description }}
            </p>
          </div>
          <div class="flex justify-end">
            <ButtonGroup
              text="Alphabatize Options"
              @click="alphabatizeOptions"
              design="secondary"
              size="xs"
              class="text-2xs font-medium text-white dark:text-jovieDark-200">
              <BarsArrowUpIcon class="nl-2 h-4 w-4" />
            </ButtonGroup>
          </div>
          <div class="border-t border-slate-200 dark:border-jovieDark-border">
            <div>
              <div class="flex flex-col space-y-4">
                <div>
                  <ul class="space-y-2 py-1 px-2">
                    <template v-for="(option, index) in field.options">
                      <li class="flex justify-between">
                        <Bars2Icon
                          class="h-5 w-5 text-slate-600 dark:text-jovieDark-200" />
                        <input
                            v-model="field.options[index]"
                          placeholder="Option Name"
                          class="inline-flex w-full items-center rounded-md bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800" />
                        <XMarkIcon
                          @click="removeOption(index)"
                          class="h-5 w-5 cursor-pointer rounded-md border border-slate-300 p-0.5 hover:bg-slate-200 hover:bg-jovieDark-700 hover:text-white dark:border-jovieDark-border" />
                      </li>
                    </template>
                    <div
                      class="flex w-full cursor-pointer items-center rounded-md border border-slate-300 p-0.5 text-xs font-semibold hover:bg-slate-200 hover:bg-jovieDark-700 hover:text-white dark:border-jovieDark-border">
                      <PlusIcon @click="addOption()" class="h-5 w-5" />
                      Add an option
                    </div>
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
import {
  PlusIcon,
  XMarkIcon,
  Bars2Icon,
  BarsArrowUpIcon,
} from '@heroicons/vue/24/solid';
import InputGroup from './InputGroup.vue';
import ButtonGroup from './ButtonGroup.vue';
import FieldService from '../services/api/field.service';
import DropdownMenuItem from './DropdownMenuItem.vue';
import ComboboxMenu from './ComboboxMenu.vue';

export default {
  name: 'CustomFieldsMenu',
  components: {
    PlusIcon,
    XMarkIcon,
    Bars2Icon,
    JovieDropdownMenu,
    GlassmorphismContainer,
    Popover,
    PopoverButton,
    BarsArrowUpIcon,
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
        options: [],
      },
      adding: false,
    };
  },
  watch: {
    'field.type': function (val) {
      if (['select', 'multi_select'].includes(val.id)) {
        this.field.options.push('Option Name');
      } else {
        this.field.options = [];
      }
    },
  },
  mounted() {
    this.getCustomFieldTypes();
  },
  methods: {
    addOption() {
      this.field.options.push('Option Name');
      //clear the input
      this.field.options[this.field.options.length - 1] = '';
    },
    removeOption(index) {
      this.field.options.splice(index, 1);
    },
    saveCustomField() {
      this.adding = true;
      let data = this.field;
      data.type = this.field.type.id
      FieldService.saveCustomField(data)
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
              description: '',
              options: [],
            };
            close();
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
