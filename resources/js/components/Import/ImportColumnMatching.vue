<template>
  <div class="mx-auto min-h-screen items-center">
    <div
      class="mx-auto mb-8 mt-12 h-full max-w-3xl items-center justify-center rounded-lg bg-white px-4 shadow-lg">
      <CardHeading
        title="Import"
        subtitle="Please select the columns you wish to import into Jovie." />
      <div class="mt-2">
        <InputGroup
          v-model="fileNameModel"
          :error="listExists"
          name="fileName"
          label="List Name"
          placeholder="Enter list name to create"
          type="text" />
        <p>
          <span>To import contacts to existing lists please select one</span>
          <InputLists :lists="lists" @updateLists="updateLists" />
        </p>
      </div>
      <table class="w-full rounded-md px-8 py-2">
        <tr
          class="border-neutrual-400 rounded-md-t border border-b px-4 py-4 text-slate-500">
          <th class="font-medium">
            Columns from <span class="font-bold">{{ fileNameModel }}</span>
          </th>
          <th>Import to...</th>
        </tr>
        <tr
          v-for="(column, index) in columns"
          :key="column"
          class="rounded-md px-4 text-center odd:bg-white even:bg-indigo-100">
          <td
            class="last:rounded-md-br mx-auto items-center px-4 py-2 text-center text-sm font-bold text-indigo-700">
            {{ column }}
          </td>
          <td class="items-center justify-center px-2 py-1">
            <ColumnsDropdown
              :ref="'columnDropdown_' + index"
              @setMappedColumns="setMappedColumns(index, $event)"
              :mappedColumns="mappedColumns"
              :column="column"
              :columnsToMap="columnsToMap"
              class="inline w-72 rounded-md" />
          </td>
        </tr>
      </table>
      <div class="flex items-center justify-between px-4 py-4">
        <div>
          <ButtonGroup text="Back" class="justify-left"></ButtonGroup>
        </div>
        <div>
          <ButtonGroup
            text="Finish"
            :success="importSuccessful"
            :loader="importing"
            class="justify-right"
            :disabled="!Object.keys(mappedColumns).length"
            @click="finish"></ButtonGroup>
        </div>
      </div>
    </div>
    <ModalPopup
      modalType="info"
      :open="autoEnrichmentPopup.open"
      :loading="autoEnrichmentPopup.loading"
      :title="autoEnrichmentPopup.title"
      :description="autoEnrichmentPopup.description"
      :primaryButtonText="autoEnrichmentPopup.primaryButtonText"
      secondaryButtonText="No"
      @primaryButtonClick="autoEnrichment"
      @cancelButtonClick="cancelAutoEnrichment">
      <template #content>
        <CheckboxInput
          :checked="autoEnrichmentSetting"
          v-model="autoEnrichmentSetting"
          name="autoEnirchSetting" />
        <label for="autoEnrichmentSetting">
          Enable auto enrichment on import</label
        >
      </template>
    </ModalPopup>
  </div>
</template>
<script>
import ButtonGroup from '../ButtonGroup.vue';
import CardHeading from '../CardHeading.vue';
import ColumnsDropdown from './ColumnsDropdown.vue';
import InputGroup from '../InputGroup.vue';
import ModalPopup from '../ModalPopup.vue';
import TeamService from '../../services/api/team.service';
import CheckboxInput from '../CheckboxInput.vue';
import InputLists from '../InputLists.vue';
export default {
  name: 'ImportColumnMatching',
  components: {
    InputLists,
    ModalPopup,
    CheckboxInput,
    ColumnsDropdown,
    ButtonGroup,
    CardHeading,
    InputGroup,
  },
  props: {
    columns: {
      type: Array,
      default: [],
    },
    columnsToMap: {
      type: Array,
      default: [],
    },
    fileName: {
      type: String,
      required: true,
    },
    userLists: {
      type: Array,
      default: [],
    },
    importing: {
      type: Boolean,
      default: false,
    },
    importSuccessful: {
      type: Boolean,
      default: false,
    },
    fileCheck: {
      type: Object,
      default: {},
    },
  },
  data() {
    return {
      mappedColumns: {},
      autoEnrichmentSetting: true,
      autoEnrichmentPopup: {
        confirmationMethod: null,
        title: 'Auto contact enrichment',
        open: false,
        primaryButtonText: 'Yes',
        description: 'Do you want to automatically enrich contacts?',
        loading: false,
      },
      lists: [],
    };
  },
  computed: {
    fileNameModel: {
      get() {
        return this.fileName;
      },
      set(val) {
        this.checkDuplicateList();
        this.$emit('listNameUpdated', val);
      },
    },
  },
  mounted() {
    this.checkDuplicateList();
  },
  methods: {
    updateLists(data) {
      if (data.add) {
        this.lists.push(data.list);
      } else {
        this.lists.splice(this.lists.indexOf(data.list), 1);
      }
    },
    autoEnrichment() {
      this.autoEnrichmentPopup.open = false;
      if (this.autoEnrichmentSetting) {
        this.updateEnrichmentSetting({
          teamSettings: { auto_enrich_import: { value: true } },
        });
      }
      this.import(true);
    },
    cancelAutoEnrichment() {
      this.autoEnrichmentPopup.open = false;
      this.import();
    },
    finish() {
      this.autoEnrichmentPopup.open = false;
      this.$nextTick(() => {
        if (!this.currentUser.workspace_preferences.auto_enrich_import) {
          this.autoEnrichmentPopup.open = true;
        } else {
          this.import();
        }
      });
    },
    import(autoEnrich = false) {
      this.$emit('finish', {
        columns: this.mappedColumns,
          lists: this.lists,
        autoEnrich: autoEnrich,
      });
    },
    updateEnrichmentSetting(data) {
      TeamService.updateTeamSettings(data, this.currentUser.current_team.id)
        .then((response) => {
          response = response.data;
          this.currentUser.workspace_preferences.auto_enrich_import =
            response.data.auto_enrich_import.value;
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally(() => {
          console.log('fetched');
        });
    },
    checkDuplicateList() {
      if (
        this.userLists.filter(
          (list) =>
            list.name.toLowerCase().trim() == this.fileName.toLowerCase().trim()
        ).length
      ) {
        this.listExists =
          'A list with same name already exists. Continuing will merge all data in one.';
      } else {
        this.listExists = '';
      }
    },
    setMappedColumns(index, { mapColumn }) {
      if (this.mappedColumns[mapColumn]) {
        this.$refs[`columnDropdown_${index}`][0].selected = null;
        return;
      }
      // remove key from mapped column if its unselected
      for (const [key, value] of Object.entries(this.mappedColumns)) {
        // check if value of mapped column is an object (which refers to emails). Then rather than deleting key splice from array
        if (typeof value === 'object' && value.includes(index)) {
          this.mappedColumns.emails.splice(
            this.mappedColumns.emails.indexOf(index),
            1
          );
        } else if (value === index) {
          delete this.mappedColumns[key];
          break;
        }
      }
      if (mapColumn) {
        // check if mapColumn in email1 or email2 then rather than having a string, have an array with all email keys columns
        if (['email1', 'email2'].includes(mapColumn)) {
          if (this.mappedColumns['emails']) {
            this.mappedColumns['emails'].push(index);
          } else {
            this.mappedColumns['emails'] = [];
            this.mappedColumns['emails'].push(index);
          }
        } else {
          this.mappedColumns[mapColumn] = index;
        }
      }
    },
  },
};
</script>
