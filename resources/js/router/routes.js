import { authenticationGuard } from "../middlewares/auth";

import store from "../store";

function loadPage(page) {
    return () => import(`./../views/${page}.vue`);
}

export const routes = [
    {
        name: "home",
        path: "/",
        component: loadPage("Home"),
    },
    {
        name: "pricing",
        path: "/pricing",
        component: loadPage("Pricing"),
        meta: {
            layout: "default",
        },
    },
    {
        name: "account",
        path: "/account",
        component: loadPage("Account"),
        beforeEnter: authenticationGuard,
        meta: {
            layout: "App",
        },
    },
    {
        name: "dashboard",
        path: "/dashboard",
        component: loadPage("Dashboard"),
        meta: {
            layout: "App",
        },
    },
    {
        name: "crm",
        path: "/crm",
        component: loadPage("Crm"),
        meta: {
            layout: "App",
        },
    },
    {
        about: "about",
        path: "/about",
        component: loadPage("About"),
        beforeEnter: authenticationGuard,
    },
    {
        name: "terms",
        path: "/terms",
        component: loadPage("Terms"),
        meta: {
            layout: "Default",
        },
    },
    {
        name: "privacy",
        path: "/privacy",
        component: loadPage("Privacy"),
        meta: {
            layout: "Default",
        },
    },
    {
        name: "demo",
        path: "/demo",
        beforeEnter(to, from, next) {
            window.open(
                "https://u3yaoaf518v.typeform.com/to/MSzEeSrT",
                "_blank"
            );
        },
    },
    {
        name: "import",
        path: "/import",
        component: loadPage("Import"),
        meta: {
            layout: "App",
        },
    },
    {
        name: "admin",
        path: "/admin",
        component: loadPage("Admin"),
        meta: {
            layout: "App",
        },
    },
    {
        name: "outreach",
        path: "/outreach",
        component: loadPage("Outreach"),
        meta: {
            layout: "App",
        },
    },
    {
        name: "discovery",
        path: "/discovery",
        component: loadPage("Discovery"),
        meta: {
            layout: "App",
        },
    },
    {
        name: "analytics",
        path: "/analytics",
        component: loadPage("Analytics"),
        meta: {
            layout: "App",
        },
    },
    {
        name: "campaigns",
        path: "/campaigns",
        component: loadPage("Campaigns"),
        meta: {
            layout: "App",
        },
    },
    {
        name: "Tim White Profile",
        path: "/tim",
        component: loadPage("Tim"),
        meta: {
            layout: "Default",
        },
    },
    {
        name: "Mackenzie Profile",
        path: "/mackenzie",
        component: loadPage("Mackenzie"),
        meta: {
            layout: "Default",
        },
    },
    {
        name: "Profile",
        path: "/haruki",
        component: loadPage("Haruki"),
        meta: {
            layout: "Default",
        },
    },
];
