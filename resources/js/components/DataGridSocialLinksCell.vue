<template>
    <a
        v-for="network in networks"
        :href="creator[`${network}_handler`]"
        target="_blank"
        :key="network"
        class="isolate inline-flex items-center justify-between rounded-full px-1 py-1 text-center text-xs font-bold text-slate-800">
        <div class=".clear-both mx-auto flex-col items-center">
            <div class="mx-auto items-center">
                <SocialIcons
                    :linkDisabled="
                                !creator[`${network}_handler`] &&
                                !creator.meta[`${network}_handler`]
                              "
                    class="mx-auto"
                    height="14px"
                    setting.isVisable
                    :link="
                                creator[`${network}_handler`] ||
                                creator.meta[`${network}_handler`]
                              "
                    :icon="network" />
            </div>
        </div>
    </a>
</template>

<script>
import SocialIcons from "./SocialIcons.vue";

export default {
    name: "DataGridSocialLinksCell",
    components: {SocialIcons},
    props: {
        currentContact: Object,
        creator: Object,
        index: Number,
        selectedCreators: Array,
        freezeColumn: Boolean,
        fieldId: String,
        visibleColumns: Array,
        neverHide: Boolean,
        column: Object,
        rowIndex: Number,
        columnIndex: Number,
        modelValue: String,
        currentCell: Object,
        cellActive: Boolean,
        networks: Array,
    },
}
</script>

<style scoped>

</style>
