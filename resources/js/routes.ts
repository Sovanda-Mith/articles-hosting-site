import { createWebHistory, createRouter, type RouteRecordRaw } from 'vue-router';
import NotFound from './pages/NotFound.vue';

const routes: RouteRecordRaw[] = [
  //specify type of route
  {
    path: '/',
    // component: () => import("./pages/LandingPage.vue"),
    component: () => import('../js/pages/Landing_layout.vue'),
    meta: {
      title: 'Bloggist',
    },
    children: [
      {
        path: '',
        component: () => import('../js/pages/LandingPage.vue'),
      },
      {
        path: '/aboutus',
        component: () => import('../js/pages/AboutusPage.vue'),
      },
    ],
  },
  {
    path: '/login',
    component: () => import('../js/pages/LoginPage.vue'),
    meta: {
      title: 'Login',
    },
  },
  {
    path: '/signin',
    component: () => import('../js/pages/SigninPage.vue'),
    meta: {
      title: 'Signin',
    },
  },
  {
    path: '/settings',
    component: () => import('../js/pages/settingPages/Settings.vue'),
    meta: {
      title: 'Settings',
    },
    children: [
      {
        path: 'account',
        component: () => import('../js/pages/settingPages/Account.vue'),
        meta: {
          title: 'Account | Settings',
        },
      },
      {
        path: 'notifications',
        component: () => import('../js/pages/settingPages/Notifications.vue'),
        meta: {
          title: 'Notifications | Settings',
        },
      },
      {
        path: 'security',
        component: () => import('../js/pages/settingPages/Security.vue'),
        meta: {
          title: 'Security | Settings',
        },
      },
    ],
  },
  {
    path: '/:pathMatch(.*)',
    component: NotFound,
    meta: {
      title: 'Not Found',
    },
  },
  {
    path: '/feed',
    component: () => import('../js/pages/FeedPage.vue'),
    meta: {
          title: "FeedPage",
    },
    children: [
        {
            path: "", 
            redirect: "/feed/foryou"
        },
        {
            path: "foryou",
            component: () => import("../js/pages/Foryoupage.vue")
        },
        {
            path: "following",
            component: () => import("../js/pages/FollowingPage.vue")
        },
    ]
  },
  {
      path: "/feed/trending",
      component: () => import("../js/pages/TrendingPage.vue"),
      meta: {
          title: "TrendingPage"
      }
  },
  {
    path: '/profile',
    component: () => import('../js/pages/ProfilePage.vue'),
    meta: {
      title: 'My Profile',
    },
  },
  {
    path: '/viewer',
    component: () => import('../js/pages/ViewerPofilePage.vue'),
    meta: {
      title: 'User Profile',
    },
  },

  // Admin routes
  {
    path: '/admin',
    component: () => import('../js/pages/adminPages/Layouts/Layout.vue'),
    meta: {
      title: 'Admin',
    },
    children: [
      {
        path: '',
        component: () => import('../js/pages/adminPages/Dashboard/Dashboard.vue'),
        meta: {
          title: 'Dashboard',
        },
      },
      {
        path: 'user',
        component: () => import('../js/pages/adminPages/User/User.vue'),
        meta: {
          title: 'User',
        },
      },
      {
        path: 'article',
        component: () => import('../js/pages/adminPages/Article/Article.vue'),
        meta: {
          title: 'Article',
        },
      },
      {
        path: 'report',
        component: () => import('../js/pages/adminPages/Report/Report.vue'),
        meta: {
          title: 'Report',
        },
      },
      {
        path: 'account',
        component: () => import('../js/pages/adminPages/Account/Account.vue'),
        meta: {
          title: 'Account',
        },
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  document.title = (to.meta.title as string) || 'Articles Hosting Site';
  next();
});

export default router;
