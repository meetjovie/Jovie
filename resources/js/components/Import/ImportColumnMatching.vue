<template>
    <div class="items-center mx-auto min-h-screen">
        <div class="mx-auto bg-white rounded-lg shadow-lg max-w-3xl mt-12 mb-8 items-center h-full justify-center ">
            <CardHeading title="Import" subtitle="Please select the columns you wish to import into Jovie." />
            <InputGroup
                v-model="fileName"
                :error="listExists"
                name="fileName"
                label="List Name"
                placeholder="Enter list name to create"
                type="text" />
            <table class="w-full rounded-md px-8">
                <tr class="border-b border border-neutrual-400 text-neutral-500 rounded-md-t">
                    <th class="font-medium">Columns from <span class="font-bold">{{ csvFileName }}</span></th>
                    <th>Import to...</th>
                </tr>
                <tr v-for="column in columns" :key="column" class="text-center rounded-md odd:bg-white even:bg-indigo-100">
                    <td class="text-sm last:rounded-md-br text-indigo-700 font-bold py-2 text-center mx-auto items-center">
                        {{ column }}
                    </td>
                    <td class="px-2 py-1 justify-center items-center">
                        <ColumnsDropdown :ref="'columnDropdown_'+column" @setMappedColumns="setMappedColumns" :mappedColumns="mappedColumns" :column="column" :columnsToMap="columnsToMap" class="rounded-md inline w-72" />
                    </td>
                </tr>
            </table>
            <div class="flex py-4 px-4 justify-between items-center ">
                <div>
                    <ButtonGroup text="Back" class="justify-left"></ButtonGroup>
                </div>
                <div>
                <ButtonGroup text="Finish" class="justify-right" :disabled="!Object.keys(mappedColumns).length" @click="$emit('finish', mappedColumns)"></ButtonGroup>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import ButtonGroup from "../ButtonGroup.vue";
import CardHeading from "../CardHeading.vue";
import ColumnsDropdown from "./ColumnsDropdown";
import InputGroup from '../InputGroup';

export default {
    name: "ImportColumnMatching",
    components: {
        ColumnsDropdown,
        ButtonGroup,
        CardHeading,
        InputGroup
    },
    props: {
        columns: {
            type: Array,
            default: []
        },
        fileName: {
            type: String,
            required: true
        },
        userLists: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            columnsToMap: [
                'firstName',
                'lastName',
                'city',
                'country',
                'instagram',
                'youtube',
                'twitter',
                'onlyFans',
                'twitch',
                'tiktok',
                'linkedin',
                'snapchat',
                'instagramFollowersCount',
                'youtubeFollowersCount',
                'youtubeFollowersCount',
                'twitterFollowersCount',
                'onlyFansFollowersCount',
                'twitchFollowersCount',
                'tiktokFollowersCount',
                'email1',
                'email2',
                'wikiId',
            ],
            mappedColumns: {},
            csvFileName: ''
        }
    },
    watch: {
        fileName: function (val) {
            this.checkDuplicateList()
            this.$emit('listNameUpdated', val)
        }
    },
    mounted() {
        this.csvFileName = this.fileName
        this.checkDuplicateList()
    },
    methods: {
        checkDuplicateList() {
            if (this.userLists.filter(list => list.name.toLowerCase().trim() == this.fileName.toLowerCase().trim()).length) {
                this.listExists = 'A list with same name already exists. Continuing will merge all data in one.'
            } else {
                this.listExists = ''
            }
        },
        setMappedColumns({mapColumn, column}) {
            if (this.mappedColumns.hasOwnProperty(mapColumn)) {
                this.$refs[`columnDropdown_${column}`][0].selected = null
                return
            }
            // remove key from mapped column if its unselected
            for (const [key, value] of Object.entries(this.mappedColumns)) {
                // check if value of mapped column is an object (which refers to emails). Then rather than deleting key splice from array
                if (typeof value === "object" && value.includes(column)) {
                    this.mappedColumns.emails.splice(this.mappedColumns.emails.indexOf(column), 1)
                } else if (value === column) {
                    delete this.mappedColumns[key]
                    break
                }
            }
            if (mapColumn) {
                // check if mapColumn in email1 or email2 then rather than having a string, have an array with all email keys columns
                if (['email1', 'email2'].includes(mapColumn)) {
                    if (this.mappedColumns['emails']) {
                        this.mappedColumns['emails'].push(column)
                    } else {
                        this.mappedColumns['emails'] = []
                        this.mappedColumns['emails'].push(column)
                    }
                } else {
                    this.mappedColumns[mapColumn] = column;
                }
            }
        },
    }
}
</script>
