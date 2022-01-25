import { authenticationGuard } from "./middlewares/auth";

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
