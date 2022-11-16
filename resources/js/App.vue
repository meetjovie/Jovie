<template>
  <component :is="layout" />
</template>

<script>
import App from './layouts/App';
import Default from './layouts/Default';
import Minimal from './layouts/Minimal';
import router from './router';

export default {
  components: {
    App,
    Default,
    Minimal,
  },
  data() {
    return {
      layout: null,
    };
  },
  watch: {
    $route: {
      handler: function (to) {
        // set layout by route meta
        if (to.meta.layout !== undefined) {
          this.layout = to.meta.layout;
        } else {
          this.layout = Minimal; // this is default layout if route meta is not set
        }
      },
      immediate: true,
    },
  },
};
</script>
