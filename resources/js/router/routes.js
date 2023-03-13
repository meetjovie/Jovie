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
      layout: 'default',
    },
  },
  {
    name: 'Changelog',
    path: '/changelog',
    component: loadPage('ChangeLog'),
    meta: {
      requiresAuth: false,
      layout: 'default',
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
    name: 'Support',
    path: '/support',
    beforeEnter(to, from, next) {
      window.open('https://support.jov.ie/', '_self');
    },
  },
  {
    name: 'Careers',
    path: '/careers',
    component: loadPage('Careers'),
    meta: {
      layout: 'default',
      requiresAuth: false,
    },
  },
  {
    name: 'Relationship Management',
    path: '/relationship-management',
    component: loadPage('RelationshipManagement'),
    meta: {
      layout: 'default',
      requiresAuth: false,
    },
  },
  {
    name: 'Invest in Jovie',
    path: '/invest',
    beforeEnter(to, from, next) {
      window.open('https://stack.angellist.com/s/qo9maosy1o', '_self');
    },
  },
  {
    name: 'YC Demo Video',
    path: '/yc-demo-video',
    beforeEnter(to, from, next) {
      window.open(
        'https://www.loom.com/share/621ed0f9a53848c4858b3b9f8f9d22c6',
        '_self'
      );
    },
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Data',
    path: '/data',
    component: loadPage('OurData'),
    meta: {
      layout: 'default',
      requiresAuth: false,
    },
  },
  {
    name: 'Enrichment',
    path: '/enrichment',
    component: loadPage('Enrichment'),
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
    children: [
      {
        path: 'team',
      },
    ],
  },
  {
    name: 'Billing',
    path: '/billing',
    component: loadPage('Account'),
    props: { defaultTab: 2 },
    meta: {
      layout: 'App',
      requiresAuth: true,
    },
  },
  {
    name: 'password',
    path: '/password',
    component: loadPage('Account'),
    props: { defaultTab: 1 },
    meta: {
      layout: 'App',
      requiresAuth: true,
    },
  },
  {
    name: 'Team',
    path: '/team',
    component: loadPage('Account'),
    props: { defaultTab: 3 },
    meta: {
      layout: 'App',
      requiresAuth: true,
    },
  },
  {
    name: 'Extension',
    path: '/extension',
    component: loadPage('AppExtension'),
    meta: {
      layout: 'Minimal',
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
      requiresSubscribe: false,
    },
    beforeRouteLeave(to, from, next) {
      document.ontouchstart = (e) => e.preventDefault();
      next();
    },
  },

  {
    name: 'Contact Card',
    path: '/:username/contact-card',
    component: loadPage('ContactCard'),
    meta: {
      layout: 'Minimal',
      requiresAuth: false,
      requiresSubscribe: false,
    },
  },
  {
    name: 'Edit Profile',
    path: '/edit-profile',
    component: loadPage('ProfileSetup'),
    meta: {
      layout: 'App',
      requiresAuth: true,
      requiresSubscribe: false,
    },
  },
  {
    name: 'Meet Jovie',
    path: '/meet-jovie',
    component: loadPage('MeetJovie'),
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Request A Feature',
    path: '/request-a-feature',
    beforeEnter(to, from, next) {
      window.open('https://roadmap.jov.ie/feature-requests', '_self');
    },
  },
  {
    name: 'Roadmap',
    path: '/roadmap',
    beforeEnter(to, from, next) {
      window.open('https://roadmap.jov.ie', '_self');
    },
  },
  {
    name: 'Jovie Profile',
    path: '/profiles',
    component: loadPage('JovieProfile'),
    meta: {
      layout: 'Default',
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
    name: 'Legal',
    path: '/legal',
    component: loadPage('Legal'),
    meta: {
      layout: 'Default',
      requiresAuth: false,
    },
  },
  {
    name: 'Privacy',
    path: '/privacy',
    component: loadPage('Legal'),
    props: { defaultTab: 0 },
    meta: {
      layout: 'Default',
      requiresAuth: false,
    },
  },
  {
    name: 'Terms',
    path: '/terms',
    component: loadPage('Legal'),
    props: { defaultTab: 1 },
    meta: {
      layout: 'Default',
      requiresAuth: false,
    },
  },
  {
    path: '/blog/:slug',
    name: 'BlogPost',
    component: loadPage('BlogPost'),
    meta: {
      layout: 'Default',
      requiresAuth: false,
    },
  },
  {
    path: '/blog/',
    name: 'Blog',
    component: loadPage('BlogPage'),
    props: true,
    meta: {
      layout: 'Default',
      requiresAuth: false,
    },
  },
  {
    name: 'Demo',
    path: '/demo',
    beforeEnter(to, from, next) {
      window.open('mailto:sales@jov.ie', '_blank');
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
      requiresSubscribe: false,
    },
  },
  {
    name: 'Admin Dashboard',
    path: '/admin',
    component: loadPage('AdminDashboard'),
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
    name: 'Create Account',
    path: '/signup',
    component: loadPage('Signup'),
    meta: {
      layout: 'Minimal',
    },
  },
  {
    name: 'forget-password',
    path: '/forgot-password',
    component: loadPage('ForgotPassword'),
    meta: {
      layout: 'Minimal',
    },
  },
  {
    name: 'reset-password',
    path: '/reset-password',
    component: loadPage('ResetPassword'),
    meta: {
      layout: 'Minimal',
    },
  },
  {
    name: 'reset-password',
    path: '/reset-password',
    component: loadPage('ResetPassword'),
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
    name: 'onboarding',
    path: '/onboarding',
    component: loadPage('OnboardingScreen'),
    meta: {
      layout: 'Minimal',
      requiresAuth: true,
    },
  },
  {
    name: 'Contact Overview',
    path: '/overview/:id',
    component: loadPage('ContactOverview'),
    props: true,
    meta: {
      layout: 'App',
      requiresAuth: true,
      requiresSubscribe: false,
    },
  },
  {
    name: 'Pipeline',
    path: '/pipeline',
    component: loadPage('Pipeline'),
    meta: {
      layout: 'App',
      requiresAuth: true,
      requiresAdmin: true,
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
    name: 'Brand',
    path: '/brand',
    component: loadPage('MarketingAssets'),
    meta: {
      layout: 'Default',
      requiresAuth: false,
      requiresSubscribe: false,
    },
  },
  {
    name: 'Chrome Extension',
    path: '/chrome-extension',

    beforeEnter(to, from, next) {
      window.location.href =
        'https://chrome.google.com/webstore/detail/jovie/daeopelnocmnhbkjbjmhckgjgheioafj';
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
    name: 'API',
    path: '/api',
    beforeEnter(to, from, next) {
      window.open(
        'https://u3yaoaf518v.typeform.com/to/pngWHiwK?typeform-source=admin.typeform.com',
        '_blank'
      );
    },
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Slack Community',
    path: '/slack-community',
    beforeEnter(to, from, next) {
      window.open(
        'https://join.slack.com/t/joviecommunity/shared_invite/zt-1gdffx9bp-gjhCk1ihRUOnv54Pc5sm5Q',
        '_blank'
      );
    },
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Jovie Instagram',
    path: '/jovie-instagram',
    beforeEnter(to, from, next) {
      window.open('http://instagram.com/meetjovie', '_blank');
    },
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Jovie Twitter',
    path: '/jovie-twitter',
    beforeEnter(to, from, next) {
      window.open('http://twitter.com/meetjovie', '_blank');
    },
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Jovie Github',
    path: '/jovie-github',
    beforeEnter(to, from, next) {
      window.open('https://github.com/meetjovie', '_blank');
    },
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Jovie Facebook',
    path: '/jovie-facebook',
    beforeEnter(to, from, next) {
      window.open('https://facebook.com/meetjovie', '_blank');
    },
    meta: {
      requiresAuth: false,
    },
  },
  {
    name: 'Jovie LinkedIn',
    path: '/jovie-linkedin',
    beforeEnter(to, from, next) {
      window.open('https://www.linkedin.com/company/meetjovie/', '_blank');
    },
    meta: {
      requiresAuth: false,
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
