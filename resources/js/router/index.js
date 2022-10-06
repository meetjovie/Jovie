import * as VueRouter from 'vue-router';
import { routes } from './routes';
import store from '../store';
import { next } from 'lodash/seq';

const router = VueRouter.createRouter({
  history: VueRouter.createWebHistory(),
  routes,
});
router.beforeEach(async (to, from) => {
  if (to.meta) {
      if (to.name != 'Extension') {
          delete axios.defaults.headers.common["Authorization"];
      }
    await store
      .dispatch('me')
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
      .catch(() => {
        if (to.meta.requiresAuth !== true) {
          if (to.name != 'Login') {
          }
        } else if (to.name !== 'Login') {
          return router.push({ name: 'Login' });
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
