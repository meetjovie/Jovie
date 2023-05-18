<template>
  <div>
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
      <div class="px-2 py-1" v-if="field.type.description">
        <p
          class="text-2xs font-semibold text-slate-600 dark:text-jovieDark-300">
          {{ field.type.description }}
        </p>
      </div>
      <template v-if="['select', 'multi_select'].includes(field.type.id)">
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
                <ul class="space-y-2 px-2 py-1">
                  <draggable
                    class="list-group relative isolate z-0 h-full w-full divide-y divide-slate-200 overflow-y-scroll bg-slate-50 dark:divide-slate-700 dark:bg-jovieDark-700"
                    :list="field.options"
                    ghost-class="ghost-row"
                    group="fieldOptions"
                    tag="tbody"
                    @change="sortOptions">
                    <template #item="{ element, index }">
                      <li class="flex w-full justify-between">
                        <Bars2Icon
                          class="h-5 w-5 cursor-grab text-slate-600 dark:text-jovieDark-200" />
                        <input
                          v-model="field.options[index].value"
                          placeholder="Option Name"
                          class="inline-flex w-full items-center rounded-md bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800" />
                        <XMarkIcon
                          @click="removeOption(index)"
                          class="h-5 w-5 cursor-pointer rounded-md border border-slate-300 p-0.5 hover:bg-jovieDark-700 hover:bg-slate-200 hover:text-white dark:border-jovieDark-border" />
                      </li>
                    </template>
                  </draggable>
                  <div
                    class="flex w-full cursor-pointer items-center rounded-md border border-slate-300 p-0.5 text-xs font-semibold text-slate-600 hover:bg-jovieDark-700 hover:bg-slate-200 hover:text-white dark:border-jovieDark-border">
                    <PlusIcon @click="addOption()" class="mr-2 h-5 w-5" />
                    Add an option
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </template>
      <div
        v-if="errors.type"
        class="min-h-4 text-xs text-red-600 dark:text-red-300">
        <span>
          {{ errors.type[0] }}
        </span>
      </div>
      <ButtonGroup
        class="mt-4"
        :text="currentField ? 'Update Field' : 'Add Field'"
        :disabled="adding"
        @click="saveCustomField" />
    </GlassmorphismContainer>
    <ModalPopup
      :loading="confirmationPopup.loading"
      @primaryButtonClick="confirmationPopup.confirmationMethod"
      @cancelButtonClick="resetPopup()"
      :open="confirmationPopup.open"
      :primaryButtonText="confirmationPopup.primaryButtonText"
      :description="confirmationPopup.description"
      :title="confirmationPopup.title" />
  </div>
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
import draggable from 'vuedraggable';
import ModalPopup from './ModalPopup.vue';

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
    draggable,
    ModalPopup,
  },
  props: {
    currentField: {
      type: Object,
    },
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
      confirmationPopup: {
        confirmationMethod: null,
        title: null,
        open: false,
        primaryButtonText: null,
        description: '',
        loading: false,
      },
    };
  },
  watch: {
    'field.type': function (val) {
      if (val) {
        if (['select', 'multi_select'].includes(val.id)) {
          this.field.options.push({
            name: '',
            order: this.field.options.length - 1,
          });
        } else {
          this.field.options = [];
        }
      }
    },
  },
  mounted() {
    this.getCustomFieldTypes();
  },
  methods: {
    resetPopup() {
      this.confirmationPopup = {
        confirmationMethod: null,
        title: null,
        open: false,
        description: null,
        primaryButtonText: null,
        loading: false,
      };
    },
    sortOptions() {
      this.field.options = this.field.options.map(function (option, index) {
        return { value: option.value, order: index };
      });
    },
    addOption() {
      this.field.options.push({
        name: '',
        order: this.field.options.length - 1,
      });
    },
    removeOption(index) {
      this.field.options.splice(index, 1);
    },
    updateCustomField() {
      this.confirmationPopup.loading = true;
      this.confirmationPopup.open = false;
      this.adding = true;
      let data = JSON.parse(JSON.stringify(this.field));
      data.type = data.type.id;
      FieldService.updateCustomField(data)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$store.state.crmPage.showCustomFieldsModal = false;
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
            this.$emit('getCrmCreators');
            this.$emit('getFields');
            this.$emit('getHeaders');
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
          console.log('error');
          console.log(error);
          if (error.response && error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        })
        .finally((response) => {
          this.confirmationPopup.loading = false;
          this.adding = false;
        });
    },
    saveCustomField() {
      let data = JSON.parse(JSON.stringify(this.field));
      data.type = data.type.id;
      if (data.id) {
        this.confirmationPopup = {
          title: 'Update Custom Field',
          primaryButtonText: 'Update',
          description:
            'If you are updating the type or field or removing any options, the existing data will be removed. Are you sure you want to continue ?',
        };
        this.$nextTick(() => {
          this.confirmationPopup.confirmationMethod = () => {
            this.updateCustomField();
          };
          this.confirmationPopup.open = true;
        });
        return;
      } else {
        this.adding = true;
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
              this.$emit('getFields');
              this.$emit('getHeaders');
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
            console.log('error');
            console.log(error);
            if (error.response && error.response.status == 422) {
              this.errors = error.response.data.errors;
            }
          })
          .finally((response) => {
            this.adding = false;
          });
      }
    },
    getCustomFieldTypes() {
      FieldService.getCustomFieldTypes()
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.customFieldTypes = response.data;
            if (this.currentField) {
              this.field = {
                id: this.currentField.id,
                name: this.currentField.name,
                type: this.customFieldTypes.find(
                  (type) => type.id === this.currentField.type
                ),
                description: this.currentField.description,
                options: [],
              };
              this.$nextTick(() => {
                this.field.options = this.currentField.custom_field_options;
              });
            }
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
          console.log('error');
          console.log(error);
        })
        .finally((response) => {});
    },
    closeDialog() {
      this.isOpen = false;
    },
    setIsOpen(value) {
      this.isOpen = value;
    },
    addCustomField(field) {
      this.fieldType = field.name;
      isOpen = true;
    },
  },
};
</script>
