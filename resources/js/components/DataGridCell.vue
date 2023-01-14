<template>
  <td
    v-if="
      freezeColumn ||
      neverHide ||
      (column && visibleColumns.includes(column.key))
    "
    :class="[
      cellActive
        ? ' border-2 border-indigo-500 dark:border-indigo-500'
        : 'border-x border-slate-300  dark:border-jovieDark-border ',
      currentContact.id == creator.id
        ? ' bg-slate-100 text-slate-700 dark:bg-jovieDark-700 dark:text-slate-100'
        : 'bg-white text-slate-600 dark:bg-jovieDark-900 dark:text-slate-200  ',

      freezeColumn
        ? 'fcous:ring-0 sticky isolate z-20 border-none font-bold focus:border-none focus:outline-none'
        : '',

      columnWidth ? `w-${columnWidth}` : '',
    ]"
    class="overflow-auto whitespace-nowrap text-center text-xs font-medium focus:border-none focus:outline-indigo-500 focus:ring-0 before:dark:border-jovieDark-border">
    <slot></slot>
    <!--   <component
        ref="cellInput"
        tabindex="0"
        :is="inputComponent"
        :fieldId="fieldId"
        @blur="onBlur"
        :placeholder="columnName"
        v-model="modelValue" /> -->
    <div @click.prevent="setFocus()" v-if="!freezeColumn">
      <!--  <span v-if="cellActive">Active</span> -->
      <star-rating
        v-if="column.dataType == 'rating'"
        class="mx-auto px-2"
        :star-size="12"
        :increment="0.5"
        v-model:rating="creator.crm_record_by_user.rating"
        @update:rating="
          $emit('updateCreator', {
            id: creator.id,
            index: row,
            key: `crm_record_by_user.rating`,
            value: creator.crm_record_by_user.rating,
          })
        " />
      <CheckboxInput v-else-if="dataType == 'checkbox'" v-model="modelValue" />
      <DataGridCellTextInput
        v-else-if="['text', 'email', 'currency'].includes(column.dataType)"
        :fieldId="fieldId"
        @blur="updateData"
        :dataType="column.dataType"
        :placeholder="column.name"
        v-model="modelValue" />
      <DataGridSocialLinksCell
        :creator="creator"
        :networks="networks"
        :show-count="true"
        v-else-if="column.dataType == 'socialLinks'" />
      <ContactStageMenu
        v-else-if="column.dataType == 'singleSelect'"
        :creator="creator"
        :key="row"
        :open="showContactStageMenu[row]"
        @close="toggleContactStageMenu(row)"
        :stages="stages"
        :index="row"
        @updateCreator="$emit('updateCreator', $event)" />
      <DataGridSocialLinksCell
        :creator="creator"
        :networks="networks"
        :show-count="showFollowersCount"
        v-else-if="column.dataType == 'socialLinks'" />
      <ContactStageMenu
        v-else-if="column.dataType == 'singleSelect'"
        :creator="creator"
        :key="row"
        :open="showContactStageMenu[row]"
        @close="toggleContactStageMenu(row)"
        :stages="stages"
        :index="row"
        @updateCreator="$emit('updateCreator', $event)" />
      <vue-tailwind-datepicker
        v-model="date"
        v-else-if="column.dataType == 'date'" />
      <Suspense v-else-if="column.dataType == 'multiSelect'">
        <template #default>
          <InputLists
            @updateLists="$emit('updateCreatorLists', $event)"
            :creatorId="creator.id ?? 0"
            :lists="creator.lists"
            :currentList="creator.current_list" />
        </template>
        <template #fallback> Loading... </template>
      </Suspense>
      <span v-else
        >Data Type:
        {{ column.dataType }}
      </span>
    </div>
  </td>
</template>

<script>
import CheckboxInput from './CheckboxInput.vue';
import DataGridCellTextInput from './DataGridCellTextInput.vue';
import StarRating from 'vue-star-rating';
import SocialIcons from './SocialIcons.vue';
import DataGridSocialLinksCell from './DataGridSocialLinksCell.vue';
import ContactStageMenu from './ContactStageMenu.vue';
import VueTailwindDatepicker from 'vue-tailwind-datepicker';
import InputLists from './InputLists.vue';
export default {
  name: 'DataGridCell',
  components: {
    InputLists,
    ContactStageMenu,
    DataGridSocialLinksCell,
    SocialIcons,
    DataGridCellTextInput,
    StarRating,
    CheckboxInput,
    VueTailwindDatepicker,
  },
  emits: ['update:modelValue', 'blur', 'move'],
  data() {
    return {
      showContactStageMenu: [],
      date: {},
    };
  },
  watch: {
    date: function (val) {
      this.updateData(
        val.startDate && val.startDate !== '' ? val.startDate : null
      );
    },
  },
  mounted() {
    this.date.startDate = this.modelValue;
    this.date.endDate = this.modelValue;
  },
  methods: {
    updateData(value = null) {
      this.$emit('update:modelValue', this.modelValue);
      if (this.column.meta) {
        this.$emit('updateCrmMeta', this.creator);
      } else {
        this.$emit('updateCreator', {
          id: this.creator.id,
          index: this.row,
          key: this.column.key,
          value: value ?? this.modelValue,
        });
      }
    },
    toggleContactStageMenu(index) {
      this.showContactStageMenu[index] = !this.showContactStageMenu[index];
    },
    onBlur() {
      this.$emit('blur');
    },
    setFocus() {
      this.$emit('update:currentCell', {
        row: this.rowIndex,
        column: this.columnIndex,
      });
    },
  },
  computed: {
    showFollowersCount() {
      try {
        if (!this.settings) {
          return false;
        }
        return this.settings.find((set) => set.key === 'show_follower_count')
          .visible;
      } catch (e) {
        return false;
      }
    },
    inputComponent() {
      switch (this.dataType) {
        case 'rating':
          return 'star-rating';
        case 'checkbox':
          return 'checkbox-input';
        default:
          return 'data-grid-cell-text-input';
      }
    },
    columnWidth() {
      // Find the object in the visibleColumns array that represents the current column
      const column = this.visibleColumns.find((col) =>
        col.name === this.column ? this.column.name : ''
      );
      // If the object was found, return its width. Otherwise, return an empty string.
      return column ? column.width : '';
    },
  },
  props: {
    currentContact: Object,
    creator: Object,
    selectedCreators: Array,
    freezeColumn: Boolean,
    fieldId: String,
    visibleColumns: Array,
    settings: Object,
    neverHide: Boolean,
    row: Number,
    column: {
      type: Object,
      default: {},
    },
    modelValue: String,
    currentCell: Object,
    cellActive: Boolean,
    networks: Array,
    stages: Array,
  },
};
</script>

<style>
.dp__theme_dark {
  --dp-background-color: #191a22;
  --dp-text-color: #ffffff;
  --dp-hover-color: #484848;
  --dp-hover-text-color: #ffffff;
  --dp-hover-icon-color: #959595;
  --dp-primary-color: #005cb2;
  --dp-primary-text-color: #ffffff;
  --dp-secondary-color: #a9a9a9;
  --dp-border-color: #292b41;
  --dp-menu-border-color: #2d2d2d;
  --dp-border-color-hover: #aaaeb7;
  --dp-disabled-color: #737373;
  --dp-scroll-bar-background: #212121;
  --dp-scroll-bar-color: #484848;
  --dp-success-color: #00701a;
  --dp-success-color-disabled: #428f59;
  --dp-icon-color: #959595;
  --dp-danger-color: #e53935;
  --dp-highlight-color: rgba(80, 0, 178, 0.2);
  --dp-row_margin: 0px 0 !default;
  --dp-common_padding: 0px !default;
  --dp-font_size: 0.5rem !default;
  /*
    --dp-font_family: -apple-system, blinkmacsystemfont, 'Segoe UI', roboto,
      oxygen, ubuntu, cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !default;
    --dp-border_radius: 4px !default;
    --dp-cell_border_radius: --dp-border_radius !default;

    --dp-transition_length: 22px !default; // Passed to the translateX in animation
    --dp-transition_duration: 0.1s !default; // Transition duration

    --dp-button_height: 35px !default; // size for buttons in overlays
    --dp-month_year_row_height: 35px !default; // height of the month-year select row
    --dp-month_year_row_button_size: 25px !default; // Specific height for the next/previous buttons
    --dp-button_icon_height: 20px !default; // icon sizing in buttons
    --dp-cell_size: 35px !default; // width and height of calendar cell
    --dp-cell_padding: 5px !default; // padding in the cell

    --dp-input_padding: 6px 6px !default; // padding in the input
    --dp-input_icon_padding: 35px !default; // Padding on the left side of the input if icon is present
    --dp-menu_min_width: 260px !default; // Adjust the min width of the menu
    --dp-action_buttons_padding: 2px 5px !default; // Adjust padding for the action buttons in action row

    --dp-calendar_header_cell_padding: 0.5rem !default; // Adjust padding in calendar header cells
    --dp-two_calendars_spacing: 10px !default; // Space between two calendars if using two calendars
    --dp-overlay_col_padding: 3px !default; // Padding in the overlay column
    --dp-time_inc_dec_button_size: 32px !default; // Sizing for arrow buttons in the time picker */
  /*
    // Font sizes

    --dp-preview_font_size: 0.8rem !default; // font size of the date preview in the action row
    --dp-time_font_size: 2rem !default; // font size in the time picker */
}

.dp__theme_light {
  --dp-background-color: #ffffff;
  --dp-text-color: #212121;
  --dp-hover-color: #f3f3f3;
  --dp-hover-text-color: #212121;
  --dp-hover-icon-color: #959595;
  --dp-primary-color: #1976d2;
  --dp-primary-text-color: #f8f5f5;
  --dp-secondary-color: #c0c4cc;
  --dp-border-color: #ddd;
  --dp-menu-border-color: #ddd;
  --dp-border-color-hover: #aaaeb7;
  --dp-disabled-color: #f6f6f6;
  --dp-scroll-bar-background: #f3f3f3;
  --dp-scroll-bar-color: #959595;
  --dp-success-color: #76d275;
  --dp-success-color-disabled: #a3d9b1;
  --dp-icon-color: #959595;
  --dp-danger-color: #ff6f60;
  --dp-highlight-color: rgba(80, 0, 178, 0.2);
  --dp-row_margin: 0px 0 !default;
  --dp-common_padding: 0px !default;
  --dp-font_size: 0.5rem !default;
}
</style>
