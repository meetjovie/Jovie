<template>
    <a
        v-for="social in socialLinks"
        :href="social.url ?? '#'"
        target="_blank"
        :key="social.network"
        class="isolate inline-flex items-center justify-between rounded-full px-1 py-1 text-center text-xs font-bold text-slate-800">
        <div class=".clear-both mx-auto flex-col items-center">
            <div class="mx-auto items-center">
                <SocialIcons
                    :counts-visible="showCount"
                    :linkDisabled="!social.url"
                    class="mx-auto"
                    height="14px"
                    :followers="social.followers ? formatCount(social.followers) : social.followers"
                    setting.isVisable
                    :link="social.url ?? '#'"
                    :icon="social.network" />
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
        socialLinks: Array,
        showCount: Boolean,
    },
}
</script>

<style scoped>

</style>
