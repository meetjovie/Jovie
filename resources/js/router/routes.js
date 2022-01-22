import { authenticationGuard } from "./middlewares/auth";

function loadPage(page) {
    return () => import(`./../views/${page}.vue`);
}

export const routes = [
    {
        path: '/',
        component: loadPage('Home')
    },
    {
        path: '/about',
        component: loadPage('About'),
        beforeEnter: authenticationGuard
    },
]
