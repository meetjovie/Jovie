<template>
  <div>
    <div
      v-show="!showMapping"
      class="container mx-auto mt-6 max-w-3xl py-12 px-4 sm:px-6 lg:px-8">
      <div>
        <div class="space-y-6">
          <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                  Import
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                  Import lists of creators into Jovie.
                </p>
              </div>
              <div class="mt-5 md:col-span-2 md:mt-0">
                <form class="space-y-6">
                  <div>
                    <label
                      for="instagram"
                      class="block text-sm font-medium text-gray-700">
                      Instagram Users
                    </label>
                    <div class="mt-1">
                      <textarea
                        id="instagram"
                        name="instagram"
                        rows="3"
                        v-model="importSet.instagram"
                        class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="@username" />
                      <p
                        v-if="errors.instagram"
                        class="mt-2 text-sm text-red-600">
                        {{ errors.instagram[0] }}
                      </p>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                      A list of instagram usernames, one per line.
                    </p>
                  </div>
                  <div>
                    <label
                      for="youtube"
                      class="block text-sm font-medium text-gray-700">
                      Youtube Users
                    </label>
                    <div class="mt-1">
                      <textarea
                        id="youtube"
                        name="youtube"
                        rows="3"
                        v-model="importSet.youtube"
                        class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="https://youtube.com/timwhite" />
                      <p
                        v-if="errors.youtube"
                        class="mt-2 text-sm text-red-600">
                        {{ errors.youtube[0] }}
                      </p>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                      A list of youtube channel urls/vanity urls, one per line.
                    </p>
                  </div>
                  <div>
                    <label
                      for="youtube"
                      class="block text-sm font-medium text-gray-700">
                      Tags
                    </label>
                    <div class="mt-1">
                      <textarea
                        id="tags"
                        name="tags"
                        rows="3"
                        v-model="importSet.tags"
                        class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Fashion" />
                      <p v-if="errors.tags" class="mt-2 text-sm text-red-600">
                        {{ errors.tags[0] }}
                      </p>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                      A list of tags to associate to users, one per line.
                    </p>
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700">
                      Upload list
                    </label>
                    <div
                      class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                        <DropZone class="drop-area" @files-dropped="addFiles" #default="{ dropZoneActive }">
                            <div class="space-y-1 text-center">
                                <svg
                                    class="mx-auto h-12 w-12 text-gray-400"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 48 48"
                                    aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <div v-if="dropZoneActive">
                                    <div>Drop To Upload</div>
                                </div>
                                <div v-else>
                                    <label
                                        for="file-upload"
                                        class="focus-active:underline-indigo-500 focus-active:ring-offset-2 focus-active:outline-none focus-active:ring-2 relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">
                                        <span>Upload a file</span>
                                        <input
                                            id="file-upload"
                                            name="file-upload"
                                            ref="file_upload"
                                            type="file"
                                            @change="getColumnsFromCsv()"
                                            class="sr-only" />
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">CSV</p>
                            </div>
                        </DropZone>
                    </div>
                    inputGr
                    <p v-if="errors.file" class="mt-2 text-sm text-red-600">
                      {{ errors.file[0] }}
                    </p>
                  </div>
                  <SwitchGroup
                    as="div"
                    class="flex items-center justify-between">
                    <span class="flex flex-grow flex-col">
                      <SwitchLabel
                        as="span"
                        class="text-sm font-medium text-gray-900"
                        passive
                        >Update social data</SwitchLabel
                      >
                    </span>
                    <Switch
                      v-model="enabled"
                      :class="[
                        enabled ? 'bg-indigo-600' : 'bg-gray-200',
                        'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2',
                      ]">
                      <span
                        aria-hidden="true"
                        :class="[
                          enabled ? 'translate-x-5' : 'translate-x-0',
                          'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                        ]" />
                    </Switch>
                  </SwitchGroup>
                </form>
              </div>
            </div>
          </div>
          <div class="flex justify-end">
            <button
              @click="finishImport({})"
              class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              Import
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-show="showMapping">
    <ImportColumnMatching
      @finish="finishImport"
      :columns="columns"
      :fileName="importSet.listName"
      :userLists="userLists"
      @listNameUpdated="updateListName" />
  </div>
</template>
<script>
import {
  Switch,
  SwitchDescription,
  SwitchGroup,
  SwitchLabel,
} from '@headlessui/vue';
import ImportColumnMatching from '../components/Import/ImportColumnMatching.vue';
import ImportService from '../services/api/admin/import.service';
import UserService from '../services/api/user.service';

export default {
  name: 'Import',
  components: {
    Switch,
    SwitchDescription,
    SwitchGroup,
    SwitchLabel,
    ImportColumnMatching,
  },
  data() {
    return {
      fetchingColumns: false,
      showMapping: false,
      columns: [],
      errors: [],
      importSet: {
        instagram: null,
        youtube: null,
        tags: null,
        listName: '',
      },
      importing: false,
      userLists: [],
    };
  },
  mounted() {
    this.getUserLists();
  },
  methods: {
    addFiles(newFiles) {
      this.getColumnsFromCsv(newFiles);
    },
    getUserLists() {
      UserService.getUserLists().then((response) => {
        response = response.data;
        if (response.status) {
          this.userLists = response.lists;
        }
      });
    },
    getColumnsFromCsv(file = null) {
      this.fetchingColumns = true;
      this.errors = [];
      let form = new FormData();
      form.append('import',file[0] || this.$refs.file_upload.files[0]);
      ImportService.getColumnsFromCsv(form)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.columns = response.columns;
            this.showMapping = true;
            this.importSet.listName =
              this.$refs.file_upload.files[0].name.replace(/\.[^/.]+$/, '');
          } else {
            // show toast error here later
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally((response) => {
          this.fetchingColumns = false;
        });
    },
    updateListName(listName) {
      this.importSet.listName = listName;
    },
    finishImport(mappedColumns = {}) {
      this.importing = true;
      this.errors = [];
      var form = new FormData();
      form.append('instagram', this.importSet.instagram ?? '');
      form.append('youtube', this.importSet.youtube ?? '');
      form.append('tags', this.importSet.tags ?? '');
      form.append('mappedColumns', JSON.stringify(mappedColumns));
      form.append('file', this.$refs.file_upload.files[0] ?? '');
      form.append('listName', this.importSet.listName);
      ImportService.import(form)
        .then((response) => {
          response = response.data;
          if (response.status) {
            alert(response.message);
          } else {
            // show toast error here later
          }
        })
        .catch((error) => {
          error = error.response;
          if (error.status == 422) {
            this.errors = error.data.errors;
          }
        })
        .finally((response) => {
          this.importing = false;
        });
    },
  },
};
</script>

<script setup>import DropZone from "../components/DropZone";</script>

<style>
.drop-area{
    width: 100% !important;
}
</style>
