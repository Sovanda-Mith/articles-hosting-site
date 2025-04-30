import {
    createWebHistory,
    createRouter,
    type RouteRecordRaw,
} from "vue-router";
import NotFound from "./pages/NotFound.vue";

const routes: RouteRecordRaw[] = [
    //specify type of route
    {
        path: "/",
        // component: () => import("./pages/LandingPage.vue"),
        component: () => import("../js/pages/Landing_layout.vue"),
        meta: {
            title: "Home",
        },
        children: [
            {
                path: "",
                component: () => import("../js/pages/LandingPage.vue"),
            },
            {
                path: "/aboutus",
                component: () => import("../js/pages/AboutusPage.vue"),
            },
        ],
    },
    {
        path: "/login",
        component: () => import("../js/pages/LoginPage.vue"),
        meta: {
            title: "Login",
        },
    },
    {
        path: "/signin",
        component: () => import("../js/pages/SigninPage.vue"),
        meta: {
            title: "Signin",
        },
    },
    {
        path: "/settings",
        component: () => import("../js/pages/settingPages/Settings.vue"),
        meta: {
            title: "Settings",
        },
        children: [
            {
                path: "account",
                component: () => import("../js/pages/settingPages/Account.vue"),
                meta: {
                    title: "Account | Settings",
                },
            },
            {
                path: "notifications",
                component: () =>
                    import("../js/pages/settingPages/Notifications.vue"),
                meta: {
                    title: "Notifications | Settings",
                },
            },
            {
                path: "security",
                component: () =>
                    import("../js/pages/settingPages/Security.vue"),
                meta: {
                    title: "Security | Settings",
                },
            },
        ],
    },
    {
        path: "/:pathMatch(.*)",
        component: NotFound,
        meta: {
            title: "Not Found",
        },
    },
    {
        path: "/feed",
        component: () => import("../js/pages/FeedPage.vue"),
        meta: {
            title: "FeedPage",
        }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    document.title = (to.meta.title as string) || "Articles Hosting Site";
    next();
});

export default router;
