import {authenticationGuard} from '../middlewares/auth';
import {publicProfile} from '../middlewares/publicProfile';


import store from '../store';

function loadPage(page) {
    return () => import(`./../views/${page}.vue`);
}

export const routes = [
    {
        name: 'Home',
        path: '/',
        component: loadPage('Home'),
    },
    {
        name: 'Pricing',
        path: '/pricing',
        component: loadPage('Pricing'),
        meta: {
            layout: 'default',
        },
    },
    {
        name: 'Account',
        path: '/account',
        component: loadPage('Account'),
        beforeEnter: authenticationGuard,
        meta: {
            layout: 'App',
        },
    },
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: loadPage('Dashboard'),
        beforeEnter: authenticationGuard,
        meta: {
            layout: 'App',
        },
    },
    {
        name: 'CRM',
        path: '/crm',
        component: loadPage('Crm'),
        beforeEnter: authenticationGuard,
        meta: {
            layout: 'App',
        },
    },
    {
        about: 'About',
        path: '/about',
        component: loadPage('About'),
        beforeEnter: authenticationGuard,
    },
    {
        name: 'Terms',
        path: '/terms',
        component: loadPage('Terms'),
        meta: {
            layout: 'Default',
        },
    },
    {
        name: 'Privacy',
        path: '/privacy',
        component: loadPage('Privacy'),
        meta: {
            layout: 'Default',
        },
    },
    {
        name: 'Demo',
        path: '/demo',
        beforeEnter(to, from, next) {
            window.open('https://u3yaoaf518v.typeform.com/to/MSzEeSrT', '_blank');
        },
    },
    {
        name: 'Creators',
        path: '/creators',
        beforeEnter(to, from, next) {
            window.open('https://u3yaoaf518v.typeform.com/to/lxFUTGnY', '_blank');
        },
    },
    {
        name: 'Status',
        path: '/status',
        beforeEnter(to, from, next) {
            window.open('https://jovie.statuspage.io/', '_blank');
        },
    },
    {
        name: 'Import',
        path: '/import',
        component: loadPage('Import'),
        beforeEnter: authenticationGuard,
        meta: {
            layout: 'App',
        },
    },
    {
        name: 'Admin Panel',
        path: '/admin',
        component: loadPage('Admin'),
        meta: {
            layout: 'App',
        },
    },
    {
        name: 'Outreach',
        path: '/outreach',
        component: loadPage('Outreach'),
        meta: {
            layout: 'App',
        },
    },
    {
        name: 'Discovery',
        path: '/discovery',
        component: loadPage('Discovery'),
        meta: {
            layout: 'App',
        },
    },
    {
        name: 'Analytics',
        path: '/analytics',
        component: loadPage('Analytics'),
        meta: {
            layout: 'App',
        },
    },
    {
        name: 'Campaigns',
        path: '/campaigns',
        component: loadPage('Campaigns'),
        meta: {
            layout: 'App',
        },
    },
    {
        name: 'Tim White Profile',
        path: '/tim',
        component: loadPage('Tim'),
        meta: {
            layout: 'Minimal',
        },
    },
    {
        name: 'Profile',
        path: '/haruki',
        component: loadPage('Haruki'),
        meta: {
            layout: 'Minimal',
        },
    },
    {
        name: 'Create Account',
        path: '/signup',
        component: loadPage('Signup'),
        meta: {
            layout: 'Minimal',
        },
    },
    {
        name: 'Forgot Password',
        path: '/forgot-password',
        component: loadPage('ForgotPassword'),
        meta: {
            layout: 'Minimal',
        },
    },
    {
        name: 'Login',
        path: '/login',
        component: loadPage('Login'),
        meta: {
            layout: 'Minimal',
        },
    },
    {
        name: 'Creator Overview',
        path: '/creator-overview/:id',
        component: loadPage('CreatorOverview'),
        props: true,
        beforeEnter: authenticationGuard,
        meta: {
            layout: 'App',
        },
    },
    {
        name: 'Pipeline',
        path: '/pipeline',
        component: loadPage('Pipeline'),
        meta: {
            layout: 'App',
        },
    },


    {
        name: 'Profile',
        path: '/:username',
        component: loadPage('Profile'),
        beforeEnter: publicProfile,
        props: true,
        meta: {
            layout: 'Minimal',
        },
    },

];
