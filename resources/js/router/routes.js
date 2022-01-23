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
        about: 'about',
        path: '/about',
        component: loadPage('About'),
        beforeEnter: authenticationGuard
    },
]
