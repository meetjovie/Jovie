<template>
  <div>
    <SectionHeader
      header="Custom Fields"
      subheader="Manage your custom field settings." />
    <div v-for="(field, index) in customFields">
      <ActionPanel
        :title="field.name"
        :description="field.description"
        button-text="Edit"
        button-style="primary"
        @action-click="editFeild(field)"
        :action-two="true"
        button-two-text="Remove"
        button-two-style="danger"
        @action-two-click="deleteField(field)" />
    </div>
    <ModalPopup customContent :open="editing">
      <template v-slot:content>
        <CustomFieldsMenu
          :current-field="editingField"
          @closeModel="closeModel" />
      </template>
    </ModalPopup>
  </div>
</template>

<script>
import ModalPopup from '../components/ModalPopup.vue';
import CustomFieldsMenu from '../components/CustomFieldsMenu.vue';
import SectionHeader from '../components/SectionHeader.vue';
import ActionPanel from './../components/ActionPanel.vue';
import FieldService from '../services/api/field.service';
import ButtonGroup from '../components/ButtonGroup.vue';

export default {
  name: 'SettingsWorkspaceCustomFields',

  components: {
    ButtonGroup,
    ModalPopup,
    ActionPanel,
    CustomFieldsMenu,
    SectionHeader,
  },
  data() {
    return {
      loading: {
        updating: false,
        inviting: false,
        deleting: false,
        addingTeam: false,
      },
      errors: {},
      editing: false,
      editingField: null,
      customFields: [],
    };
  },
  watch: {},
  mounted() {
    this.getCustomFields();
  },
  methods: {
    getCustomFields() {
      FieldService.getCustomFields()
        .then((response) => {
          response = response.data;
          this.customFields = response;
          console.log(response, 'RESPONSE DATA');
        })
        .catch((error) => {
          console.log('error');
          console.log(error);
        })
        .finally((response) => {});
    },
    deleteField(field) {
      this.$store
        .dispatch('deleteField', {
          self: this,
          itemId: field.id,
        })
        .then(() => {
          this.getCustomFields();
        });
    },
    closeModel() {
      this.editing = false;
      this.getCustomFields();
    },
    editFeild(field) {
      this.editing = false;
      this.editing = true;
      this.editingField = field;
    },
  },
};
</script>
