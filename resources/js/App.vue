<template>
    <component :is="layout">

    </component>
</template>

<script>
import App from './layouts/App';
import Default from './layouts/Default';
import Minimal from './layouts/Minimal';
import Loading from './layouts/Loading';
import router from './router';

export default {
  components: {
    App,
    Default,
    Minimal,
    Loading,
  },
  data() {
    return {
      layout: null,
    };
  },
  watch: {
    $route: {
      handler: function (to, from) {
        // set layout by route meta

        console.log(to);
        console.log(from);
        if (to != undefined && from == undefined) {
          console.log('123123');
          this.layout = Loading;
        } else {
          if (to.meta.layout !== undefined) {
            this.layout = to.meta.layout;
          } else {
            this.layout = Default; // this is default layout if route meta is not set
          }
        }
      },
      immediate: true,
    },
  },
};
</script>
