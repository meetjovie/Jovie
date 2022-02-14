import { authenticationGuard } from '../middlewares/auth';

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
    meta: {
      layout: 'App',
    },
  },
  {
    name: 'CRM',
    path: '/crm',
    component: loadPage('Crm'),
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
    name: 'Import',
    path: '/import',
    component: loadPage('Import'),
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
      layout: 'Creators',
    },
  },
  {
    name: 'Profile',
    path: '/haruki',
    component: loadPage('Haruki'),
    meta: {
      layout: 'Creators',
    },
  },
  {
    name: 'Profile',
    path: '/:username',
    component: loadPage('Profile'),
    props: true,
    meta: {
      layout: 'Creators',
    },
  },
];
