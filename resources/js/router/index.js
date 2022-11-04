import * as VueRouter from 'vue-router';
import { routes } from './routes';
import store from '../store';
import { next } from 'lodash/seq';
import AuthService from "../services/auth/auth.service";

const router = VueRouter.createRouter({
  history: VueRouter.createWebHistory(),
  routes,
});
router.beforeEach(async (to, from) => {
    console.log(to.name);
    if (to.meta) {
      let config = null
      if (to.name != 'Extension') {
          config = {
              headers: {
                  Authorization: null
              }
          }
      } else {
          store.state.isExtension = true
          if (to.query.creator != undefined) {
              store.state.extensionQuery = to.query
          }
          let token = localStorage.getItem('jovie_extension')
          if (token) {
              config = {
                  headers: {
                      Authorization: `Bearer ${token}`
                  }
              }
          }
      }
    await store
      .dispatch('me', {config: config})
      .then((response) => {
        const user = response;
        if (to.meta.requiresAuth !== true) {
          if (
            to.name == 'Login' ||
            to.name == 'Create Account' ||
            to.name == 'Home'
          ) {
            return router.push({ name: 'Contacts' });
          } else {
          }
        } else {
          if (to.meta.requiresAdmin && !user.is_admin) {
            return router.push({ name: from.name });
          }
          if (
            to.meta.requiresSubscribe &&
            !user.current_team.subscribed &&
            !user.is_admin
          ) {
            return router.push({ name: from.name });
          }
        }
      })
      .catch(async () => {
          if (to.name != 'Extension') {
            await AuthService.loginUser()
              .then((response) => {
                  response = response.data;
                  localStorage.setItem('jovie_extension', response.token);
                  if (response.status) {
                      store.commit('setAuthStateUser', response.user);
                      router.push({name: 'Contacts'});
                  }
              })
              .catch((error) => {
              });
          } else {
              router.push({name: 'Login'});
          }
      });
  }
});
// router.beforeEach(async (to, from, next) => {
//     return false;
//     if (to.meta && to.meta.requiresAuth) {
//         await store.dispatch('me').then(response => {
//             const user = response
//             if (to.meta.requiresSubscribe && !user.current_team.subscribed) {
//                 router.push({name: from.name})
//             } else {
//                 return next()
//             }
//         }).catch(() => {
//             if (to.name !== 'Login') {
//                 router.push({name: 'Login'})
//             }
//         })
//     }
// });

export default router;
