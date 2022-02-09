<template>
    <div class="items-center mx-auto min-h-screen">
        <div class="mx-auto bg-white rounded-lg shadow-lg max-w-3xl mt-12 mb-8 items-center h-full justify-center ">
            <CardHeading title="Import" subtitle="Please select the columns you wish to import into Jovie." />
            <table class="w-full rounded-md px-8">
                <tr class="border-b border border-neutrual-400 text-neutral-500 rounded-md-t">
                    <th class="font-medium">Columns from <span class="font-bold">imports.csv</span></th>
                    <th>Import to...</th>
                </tr>
                <tr v-for="column in columns" :key="column" class="text-center rounded-md odd:bg-white even:bg-indigo-100">
                    <td class="text-sm last:rounded-md-br text-indigo-700 font-bold py-2 text-center mx-auto items-center">
                        {{ unSlugify(column) }}
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
                <ButtonGroup text="Finish" class="justify-right" :disabled="!Object.keys(mappedColumns).length" @click="$emit('finish')"></ButtonGroup>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import ButtonGroup from "../ButtonGroup.vue";
import CardHeading from "../CardHeading.vue";
import ColumnsDropdown from "./ColumnsDropdown";

export default {
    name: "ImportColumnMatching",
    components: {
        ColumnsDropdown,
        ButtonGroup,
        CardHeading,
    },
    props: {
        columns: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            columnsToMap: [
                'instagram',
                'youtube',
                'twitter',
                'onlyFans',
                'twitch',
                'tiktok',
                'instagramFollowersCount',
                'youtubeFollowersCount',
                'youtubeFollowersCount',
                'twitterFollowersCount',
                'onlyFansFollowersCount',
                'twitchFollowersCount',
                'tiktokFollowersCount',
                'email1',
                'email2',
            ],
            mappedColumns: {}
        }
    },
    methods: {
        setMappedColumns({mapColumn, column}) {
            if (this.mappedColumns.hasOwnProperty(mapColumn)) {
                this.$refs[`columnDropdown_${column}`][0].selected = null
                return
            }
            for (const [key, value] of Object.entries(this.mappedColumns)) {
                if (value === column) {
                    delete this.mappedColumns[key]
                    break
                }
            }
            if (mapColumn) {
                this.mappedColumns[mapColumn] = column;
            }
        },
    }
}
</script>
