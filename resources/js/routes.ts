import { createWebHistory, createRouter } from "vue-router";
import NotFound from "./pages/NotFound.vue";

const routes = [
    {
        path: "/",
        component: () => import("./pages/LandingPage.vue"),
        meta: {
            title: "Home",
        },
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
