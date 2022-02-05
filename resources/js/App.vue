<template>
    <component :is="layout" />
</template>

<script>
import App from "./layouts/App";
import Default from "./layouts/Default";

export default {
    components: {
        App,
        Default,
    },
    data() {
        return {
            layout: null,
        };
    },
    watch: {
        $route(to) {
            // set layout by route meta
            if (to.meta.layout !== undefined) {
                this.layout = to.meta.layout
            } else {
                this.layout = Default // this is default layout if route meta is not set
            }
        },
    },
};
</script>
