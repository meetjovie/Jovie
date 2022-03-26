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
      onlyAdmin: false,
    },
  },
  {
    name: 'Pricing',
    path: '/pricing',
    component: loadPage('Pricing'),
    meta: {
      layout: 'default',
      requiresAuth: false,
      onlyAdmin: false,
    },
  },
  {
    name: 'Account',
    path: '/account',
    component: loadPage('Account'),
    beforeEnter: authenticationGuard,
    meta: {
      layout: 'App',
      requiresAuth: true,
      onlyAdmin: false,
    },
  },
  {
    name: 'Dashboard',
    path: '/dashboard',
    component: loadPage('Dashboard'),
    beforeEnter: authenticationGuard,
    meta: {
      layout: 'App',
      requiresAuth: true,
      onlyAdmin: false,
    },
  },
  {
    name: 'CRM',
    path: '/crm',
    component: loadPage('Crm'),
    beforeEnter: authenticationGuard,
    meta: {
      layout: 'App',
      requiresAuth: true,
      onlyAdmin: true,
    },
  },
  {
    about: 'About',
    path: '/about',
    component: loadPage('About'),
    beforeEnter: authenticationGuard,
    meta: {
      requiresAuth: false,
      onlyAdmin: false,
    },
  },
  {
    name: 'Terms',
    path: '/terms',
    component: loadPage('Terms'),
    meta: {
      layout: 'Default',
      requiresAuth: false,
      onlyAdmin: false,
    },
  },
  {
    name: 'Privacy',
    path: '/privacy',
    component: loadPage('Privacy'),
    meta: {
      layout: 'Default',
      requiresAuth: false,
      onlyAdmin: false,
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
      onlyAdmin: false,
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
      onlyAdmin: false,
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
      onlyAdmin: false,
    },
  },
  {
    name: 'Import',
    path: '/import',
    component: loadPage('Import'),
    beforeEnter: authenticationGuard,
    meta: {
      layout: 'App',
      requiresAuth: true,
      onlyAdmin: true,
    },
  },
  {
    name: 'Admin Panel',
    path: '/admin',
    component: loadPage('Admin'),
    beforeEnter: authenticationGuard,
    meta: {
      layout: 'App',
      requiresAuth: true,
      onlyAdmin: true,
    },
  },
  {
    name: 'Outreach',
    path: '/outreach',
    component: loadPage('Outreach'),
    beforeEnter: authenticationGuard,
    meta: {
      layout: 'App',
    },
  },
  {
    name: 'Discovery',
    path: '/discovery',
    component: loadPage('Search'),
    beforeEnter: authenticationGuard,
    meta: {
      layout: 'App',
      requiresAuth: true,
      onlyAdmin: true,
    },
  },
  {
    name: 'Analytics',
    path: '/analytics',
    component: loadPage('Analytics'),
    beforeEnter: authenticationGuard,
    meta: {
      layout: 'App',
      requiresAuth: true,
      onlyAdmin: true,
    },
  },
  {
    name: 'Campaigns',
    path: '/campaigns',
    component: loadPage('Campaigns'),
    beforeEnter: authenticationGuard,
    meta: {
      layout: 'App',
      requiresAuth: true,
      onlyAdmin: true,
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
    beforeEnter: authenticationGuard,
    meta: {
      layout: 'App',
    },
  },
  {
    name: 'Search',
    path: '/search',
    component: loadPage('Search'),
    beforeEnter: authenticationGuard,
    meta: {
      layout: 'App',
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
