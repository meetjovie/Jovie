
function loadPage(page) {
    // return () => import(`/${page}.vue`);
    return () => import(`./../views/${page}.vue`);
}

export const routes = [
    {
        path: '/',
        component: loadPage('Home')
    },
    {
        path: '/about',
        component: loadPage('About')
    },
]
