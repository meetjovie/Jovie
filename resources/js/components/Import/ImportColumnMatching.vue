<template>
    <div class="items-center mx-auto min-h-screen">
        <div class="mx-auto bg-white rounded-lg shadow-lg max-w-3xl mt-12 items-center h-full justify-center ">
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
                        <SelectMenu :items="columnsToMap" name="columnsToMap" class="rounded-md inline w-72"></SelectMenu>
                    </td>
                </tr>
            </table>
            <div class="py-4 px-4 text-left items-center ">
                <ButtonGroup text="Back"></ButtonGroup>
            </div>
            <div class="py-4 px-4 text-right items-center ">
                <ButtonGroup text="Finish"></ButtonGroup>
            </div>
        </div>
    </div>

</template>
<script>
import SelectMenu from "../SelectMenu.vue";
import ButtonGroup from "../ButtonGroup.vue";
import CardHeading from "../CardHeading.vue";

export default {
    name: "ImportColumnMatching",
    components: {
        SelectMenu,
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
                'email',
            ],
        }
    },

}
</script>
