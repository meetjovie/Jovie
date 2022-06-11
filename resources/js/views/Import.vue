<template>
  <div>
    <div>
      <div
        v-show="!showMapping"
        class="container mx-auto mt-6 max-w-3xl py-12 px-4 sm:px-6 lg:px-8">
        <div>
          <div class="space-y-6">
            <div class="min-h-screen items-center py-12">
              <div @drop.prevent="drop" @change="getColumnsFromCsv()">
                <div
                  @dragenter.prevent="toggleActive"
                  @dragleave.prevent="toggleActive"
                  @dragover.prevent
                  @drop.prevent="toggleActive"
                  :class="{ 'bg-indigo-100': ActiveDrag }"
                  class="group mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 py-12 hover:border-gray-400">
                  <div class="space-y-1 text-center">
                    <CloudUploadIcon
                      :class="{ 'text-white': ActiveDrag }"
                      class="mx-auto h-12 w-12 text-neutral-200" />
                    <div class="flex text-sm text-gray-600">
                      <label
                        for="dropzoneFile"
                        class="focus-active:underline-indigo-500 focus-active:ring-offset-2 focus-active:outline-none focus-active:ring-2 relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                        <span>Upload a file</span>
                        <input
                          id="dropzoneFile"
                          name="dropzoneFile"
                          ref="file_upload"
                          type="file"
                          @change="getColumnsFromCsv()"
                          class="sr-only" />
                      </label>
                      <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">CSV</p>
                  </div>
                </div>
              </div>
              <span class="file-info">File: {{ dropzoneFile.name }}</span>
              <ProgressBar
                class="mt-4"
                v-if="uploadProgress"
                :percentage="uploadProgress">
                <p
                  v-if="uploadProgress"
                  class="middle-0 absolute mx-auto w-full text-center text-[8px] font-bold transition-all"
                  :class="[
                    { 'text-white': uploadProgress > 50 },
                    { 'text-indigo-700': uploadProgress <= 50 },
                  ]">
                  {{ uploadProgress }}%
                </p>
              </ProgressBar>
              <p v-if="errors.key" class="mt-2 text-sm text-red-600">
                {{ errors.key[0] }}
              </p>
            </div>
            <!--  <div class="flex justify-end">
            <button
              :disabled="importing"
              @click="finishImport({})"
              class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              Import
            </button>
          </div> -->
          </div>
        </div>
      </div>
    </div>
    <!--  <div v-show="showMapping"> -->
    <div>
      <ImportColumnMatching
        @finish="finishImport"
        :columns="columns"
        :fileName="importSet.listName"
        :userLists="userLists"
        @listNameUpdated="updateListName" />
    </div>
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
import ImportService from '../services/api/import.service';
import UserService from '../services/api/user.service';
import ProgressBar from '../components/ProgressBar.vue';
import draggable from 'vuedraggable';
import { CloudUploadIcon } from '@heroicons/vue/solid';
import { ref } from 'vue';

export default {
  name: 'Import',
  components: {
    Switch,
    SwitchDescription,
    SwitchGroup,
    SwitchLabel,
    ImportColumnMatching,
    ProgressBar,
    draggable,
    CloudUploadIcon,
  },

  data() {
    return {
      fetchingColumns: false,
      showMapping: false,
      columns: [],
      ActiveDrag: false,
      errors: [],
      dropzoneFile: [],
      drag: false,
      importSet: {
        instagram: null,
        youtube: null,
        tags: null,
        listName: '',
      },
      importing: false,
      userLists: [],
      bucketResponse: null,
      uploadProgress: 0,
    };
  },
  mounted() {
    this.getUserLists();
  },
  methods: {
    toggleActive() {
      this.ActiveDrag = !this.ActiveDrag;
    },
    drop() {
      this.$refs.file_upload.files[0] = this.dropzoneFile;
    },
    getUserLists() {
      UserService.getUserLists().then((response) => {
        response = response.data;
        if (response.status) {
          this.userLists = response.lists;
        }
      });
    },
    getColumnsFromCsv() {
      this.uploadProgress = 0;
      this.fetchingColumns = true;
      this.errors = [];

      Vapor.store(this.$refs.file_upload.files[0], {
        visibility: 'public-read',
        progress: (progress) => {
          this.uploadProgress = Math.round(progress * 100);
        },
      }).then((response) => {
        this.bucketResponse = response;
        ImportService.getColumnsFromCsv({
          uuid: response.uuid,
          key: response.key,
          bucket: response.bucket,
          name: this.$refs.file_upload.files[0].name,
          content_type: this.$refs.file_upload.files[0].type,
        })
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
      form.append('key', this.bucketResponse ? this.bucketResponse.uuid : '');
      form.append('listName', this.importSet.listName);
      ImportService.import(form)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.currentUser.queued_count = response.queued_count;
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
