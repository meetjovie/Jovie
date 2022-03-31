import App from './App.vue';

require('./bootstrap');

import * as Vue from 'vue';
import router from './router/index';
import store from './store/index';
import moment from 'moment';
import InstantSearch from 'vue-instantsearch/vue3/es'; // Vue 3
import VueObserveVisibility from 'vue-observe-visibility';
import VueMousetrapPlugin from 'vue-mousetrap';
const Vapor = require('laravel-vapor');

const myMixin = {};

const app = Vue.createApp({});
app.mixin({
  computed: {
    currentUser() {
      return store.state.AuthState.user;
    },
  },
  methods: {
    asset(path) {
      return Vapor.asset(path);
    },
    unSlugify(value) {
      return value.toString().replaceAll('_', ' ');
    },
    formatCount(value) {
      value = value ? value : 0;
      if (value < 1000) {
        return value.toFixed(0);
      } else if (value >= 1000 && value < 999999) {
        return (value / 1000).toFixed(0) + 'K';
      } else if (value >= 1000000 && value < 999999999) {
        return (value / 1000000).toFixed(0) + 'M';
      } else if (value >= 1000000000 && value < 999999999999) {
        return (value / 1000000000).toFixed(0) + 'B';
      }
    },
    openLink(link, newWindow) {
      if (link) {
        window.open(link, newWindow ? '_blank' : '');
      }
    },
    formatDate(value) {
      if (!value) {
        return moment().format('ddd MMM DD, YYYY [at] HH:mm a');
      }
      return moment(value).format('ddd MMM DD, YYYY [at] HH:mm a');
    },
  },
});

app.use(router);
app.use(store);
app.use(InstantSearch);
app.use(VueObserveVisibility);
app.use(VueMousetrapPlugin);
app.component('App', App);
app.mount('#app');
