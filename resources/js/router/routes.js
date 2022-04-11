import { authenticationGuard } from '../middlewares/auth';
import { publicProfile } from '../middlewares/publicProfile';

import store from '../store';

function loadPage(page) {
  return () => import(`./../views/${page}.vue`);
}

export const routes = [
  {
    name: 'Home',
    path: '/',
    component: loadPage('Home'),
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Pricing',
    path: '/pricing',
    component: loadPage('Pricing'),
    meta: {
      layout: 'default',
      requiresAuth: false,
    },
  },
  {
    name: 'Account',
    path: '/account',
    component: loadPage('Account'),
    meta: {
      layout: 'App',
      requiresAuth: true,
    },
  },
  {
    name: 'Dashboard',
    path: '/dashboard',
    component: loadPage('Dashboard'),
    meta: {
      layout: 'App',
      requiresAuth: true,
    },
  },
  {
    name: 'Contacts',
    path: '/contacts',
    component: loadPage('Crm'),
    meta: {
      layout: 'App',
      requiresAuth: true,
      requiresSubscribe: true,
    },
  },
  {
    about: 'About',
    path: '/about',
    component: loadPage('About'),
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Terms',
    path: '/terms',
    component: loadPage('Terms'),
    meta: {
      layout: 'Default',
      requiresAuth: false,
    },
  },
  {
    name: 'Privacy',
    path: '/privacy',
    component: loadPage('Privacy'),
    meta: {
      layout: 'Default',
      requiresAuth: false,
    },
  },
  {
    name: 'Demo',
    path: '/demo',
    beforeEnter(to, from, next) {
      window.open('https://u3yaoaf518v.typeform.com/to/MSzEeSrT', '_blank');
    },
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Creators',
    path: '/creators',
    beforeEnter(to, from, next) {
      window.open('https://u3yaoaf518v.typeform.com/to/lxFUTGnY', '_blank');
    },
    meta: {
      requiresAuth: true,
      requiresSubscribe: true,
    },
  },
  {
    name: 'Status',
    path: '/status',
    beforeEnter(to, from, next) {
      window.open('https://jovie.statuspage.io/', '_blank');
    },
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Import',
    path: '/import',
    component: loadPage('Import'),
    meta: {
      layout: 'App',
      requiresAuth: true,
      requiresSubscribe: true,
    },
  },
  {
    name: 'Admin Panel',
    path: '/admin',
    component: loadPage('Admin'),
    meta: {
      layout: 'App',
      requiresAuth: true,
      requiresAdmin: true,
    },
  },
  {
    name: 'Outreach',
    path: '/outreach',
    component: loadPage('Outreach'),
    meta: {
      layout: 'App',
      requiresAuth: true,
      requiresSubscribe: true,
    },
  },
  {
    name: 'Discovery',
    path: '/discovery',
    component: loadPage('Search'),
    meta: {
      layout: 'App',
      requiresAuth: true,
      requiresSubscribe: true,
    },
  },
  {
    name: 'Analytics',
    path: '/analytics',
    component: loadPage('Analytics'),
    meta: {
      layout: 'App',
      requiresAuth: true,
    },
  },
  {
    name: 'Campaigns',
    path: '/campaigns',
    component: loadPage('Campaigns'),
    meta: {
      layout: 'App',
      requiresAuth: true,
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
    meta: {
      layout: 'App',
      requiresAuth: true,
      requiresSubscribe: true,
    },
  },
  {
    name: 'Pipeline',
    path: '/pipeline',
    component: loadPage('Pipeline'),
    meta: {
      layout: 'App',
      requiresAuth: true,
      requiresSubscribe: true,
    },
  },
  {
    name: 'Search',
    path: '/search',
    component: loadPage('Search'),
    meta: {
      layout: 'App',
      requiresAuth: true,
      requiresSubscribe: true,
    },
  },
  {
    name: 'Chrome Extension',
    path: '/chrome-extension',
    component: loadPage('ChromeExtension'),
    meta: {
      layout: 'Default',
      requiresAuth: false,
      requiresSubscribe: false,
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
  {
    name: '404',
    path: '/notfound',
    component: loadPage('404Page'),
    meta: {
      layout: 'Minimal',
    },
  },
];
