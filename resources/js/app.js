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
import { createHead } from '@vueuse/head';

window.Vapor = require('laravel-vapor');

const myMixin = {};

const app = Vue.createApp({});
app.mixin({
  computed: {
    currentUser() {
      return store.state.AuthState.user;
    },
    creators() {
      return this.$store.state.crmRecords;
    },
  },
  methods: {
    async reconnectPusher() {
      return new Promise(async (resolve, reject) => {
        await Echo.disconnect();
        await Echo.connect();
        resolve();
      });
    },
    listenEvents(
      channel,
      event,
      successCallback = () => {},
      errorCallback = () => {}
    ) {
      Echo.private(channel).listen(event, (e) => {
        if (e.status) {
          if (e.message) {
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 40000,
              title: 'Successful',
              text: e.message,
            });
          }
          successCallback(e.data);
        } else {
          this.$notify({
            group: 'user',
            type: 'error',
            duration: 40000,
            title: 'Error',
            text: e.message,
          });
          errorCallback();
        }
      });
    },
    asset(path) {
      return Vapor.asset(path);
    },
    unSlugify(value) {
      return value.toString().replaceAll('_', ' ');
    },
    formatCount(value) {
      value = value ? value : 0;
      try {
        if (value < 1000) {
          return value.toFixed(0);
        } else if (value >= 1000 && value < 999999) {
          return (value / 1000).toFixed(0) + 'K';
        } else if (value >= 1000000 && value < 999999999) {
          return (value / 1000000).toFixed(0) + 'M';
        } else if (value >= 1000000000 && value < 999999999999) {
          return (value / 1000000000).toFixed(0) + 'B';
        }
      } catch (e) {
        return 0;
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
      let time = moment(value);
      if (unix) {
        time = moment.unix(value);
      }
      if (humanize) {
        let duration = moment.duration(moment().diff(time));
        return duration.humanize(true);
      }
      return time.format('ddd MMM DD, YYYY [at] HH:mm a');
    },
    switchToDefaultImage(e) {
      e.target.src = this.asset('img/noimage.webp');
    },
  },
});

axios.interceptors.request.use(
  function (config) {
    // Do something before request is sent.
    if (router.currentRoute.value.name == undefined) {
      delete config.headers.common['Authorization'];
    }
    if (
      router.currentRoute.value.name != undefined &&
      router.currentRoute.value.name != 'Extension'
    ) {
      delete config.headers.common['Authorization'];
    } else {
      let token = localStorage.getItem('jovie_extension');
      if (token) {
        config.headers.common['Authorization'] = `Bearer ${token}`;
      }
    }
    return config;
  },
  function (error) {
    // Do something with request error
    return Promise.reject(error);
  }
);

app.use(router);
app.use(store);
app.use(InstantSearch);
app.use(VueCookies);
app.use(VueObserveVisibility);
app.use(VueMousetrapPlugin);
app.use(Notifications);
app.use(createHead());
app.component('App', App);
app.mount('#app');
