import { createWebHistory, createRouter, type RouteRecordRaw } from "vue-router";
import NotFound from "./pages/NotFound.vue";

const routes: RouteRecordRaw[] = [ //specify type of route
    {
        path: "/",
        // component: () => import("./pages/LandingPage.vue"),
        component:() => import("../js/pages/Landing_layout.vue"),
        meta: {
            title: "Home",
        },
        children:[
            {
                path: "",
                component: () => import("../js/pages/LandingPage.vue"),
            },
            {
                path: "/aboutus",
                component: () => import("../js/pages/AboutusPage.vue"),
            }
        ]

    },
    {
        path: "/:pathMatch(.*)",
        component: NotFound,
        meta: {
            title: "Not Found",
        },
    },
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
