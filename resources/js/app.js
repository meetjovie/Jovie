import App from './App.vue';

require('./bootstrap');

import * as Vue from 'vue';
import router from './router/index';
import store from './store/index';
import moment from 'moment';
import InstantSearch from 'vue-instantsearch/vue3/es'; // Vue 3
import VueObserveVisibility from 'vue-observe-visibility';
import VueMousetrapPlugin from 'vue-mousetrap';
import VueCookies from 'vue-cookies';
import Notifications from 'notiwind';

window.Vapor = require('laravel-vapor');

const myMixin = {};

const app = Vue.createApp({});
app.mixin({
  computed: {
    currentUser() {
        console.log(process.env.MIX_STRIPE_KEY);
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
    formatDate(value, unix = false, humanize = false) {
      if (!value) {
        return moment().format('ddd MMM DD, YYYY [at] HH:mm a');
      }
      let time = moment(value)
        if (unix) {
            time = moment.unix(value)
        }
        if (humanize) {
            let duration = moment.duration(moment().diff(time))
            return duration.humanize(true)
        }
      return time.format('ddd MMM DD, YYYY [at] HH:mm a');
    },
  },
});

app.use(router);
app.use(store);
app.use(InstantSearch);
app.use(VueCookies);
app.use(VueObserveVisibility);
app.use(VueMousetrapPlugin);
app.use(Notifications);
app.component('App', App);
app.mount('#app');
