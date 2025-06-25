import { createWebHistory, createRouter, type RouteRecordRaw } from 'vue-router';
import NotFound from './pages/NotFound.vue';
import { useUserStore } from './stores/features/custom-persistedstate';
import axios from 'axios';

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
      {
        path: '/contact',
        component: () => import('../js/pages/ContactPage.vue'),
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
    path: '/settings/',
    component: () => import('../js/pages/settingPages/Settings.vue'),
    meta: {
      title: 'Settings',
      requiresAuth: true,
    },
    children: [
      {
        path: '',
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
      title: 'Articles Feed',
    },
    children: [
      {
        path: '',
        redirect: '/feed/foryou',
      },
      {
        path: 'foryou',
        component: () => import('../js/pages/Foryoupage.vue'),
      },
      {
        path: 'following',
        component: () => import('../js/pages/FollowingPage.vue'),
      },
    ],
  },
  {
    path: '/feed/trending',
    component: () => import('../js/pages/TrendingPage.vue'),
    meta: {
      title: 'TrendingPage',
    },
  },
  {
    path: '/article/:id',
    component: () => import('../js/pages/DetailArticlePage.vue'),
    props: true,
    meta: {
      title: 'DetailArticle',
      requiresAuth: true,
    },
  },
  {
    path: '/profile',
    component: () => import('../js/pages/myProfilePage.vue'),
    meta: {
      title: 'My Profile',
      requiresAuth: true,
    },
  },
  /*
  {
    path: '/bookmarks/:id',
    component: () => import('../js/pages/BookmarksPage.vue'),
    meta: {
      title: 'Bookmarks',
    },
  },
  */
  {
    path: '/viewer/:userid',
    component: () => import('../js/pages/userProfilePage.vue'),
    meta: {
      title: 'User Profile',
    },
  },
  {
    path: '/new-article',
    component: () => import('../js/pages/article/NewArticle.vue'),
    meta: {
      title: 'New Article',
      requiresAuth: true,
    },
  },
  {
    path: '/edit-article/:id',
    component: () => import('@/pages/EditArticlePage.vue'),
    name: 'EditArticle',
    meta: {
      title: 'Edit Article',
      requiresAuth: true,
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

router.beforeEach(async (to, from, next) => {
  document.title = (to.meta.title as string) || 'Articles Hosting Site';

  const userStore = useUserStore();

  if (to.meta.requiresAuth && !userStore.user?.token) {
    return next({ path: '/login' });
  }

  if (to.name === 'EditArticle') {
    const articleId = to.params.id;

    if (!articleId) {
      return next({ path: '/new-article' });
    }

    try {
      const response = await axios.get('/api/articles/' + articleId, {
        headers: {
          Authorization: `Bearer ${userStore.user?.token}`,
        },
      });

      const article = response.data;

      if (article.user_id !== userStore.user?.id) {
        return next({ path: '/new-article' });
      }
    // eslint-disable-next-line @typescript-eslint/no-unused-vars
    } catch (error) {
      return next({ name: 'NotFound' });
    }
  }

  next();
});

export default router;
