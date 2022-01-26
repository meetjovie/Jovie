import { authenticationGuard } from "./middlewares/auth";

import store from "../store";

function loadPage(page) {
    return () => import(`./../views/${page}.vue`);
}

export const routes = [
    {
        name: 'home',
        path: '/',
        component: loadPage('Home')
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: loadPage('Dashboard'),
        meta: {
            layout: 'App'
        }
    },
    {
        name: 'crm',
        path: '/crm',
        component: loadPage('Crm'),
        meta: {
            layout: 'App'
        }
    },
    {
        about: 'about',
        path: '/about',
        component: loadPage('About'),
        beforeEnter: authenticationGuard
    },
]
