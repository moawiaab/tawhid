import { h, resolveComponent } from "vue";
import { createRouter, createWebHistory } from "vue-router";

import DefaultLayout from "../layouts/DefaultLayout.vue";
const View = { template: "<router-view></router-view>" };

const routes = [
    {
        path: "/",
        name: "الرئيسية",
        component: DefaultLayout,
        redirect: "/dashboard",
        children: [
            {
                path: "/dashboard",
                name: "dashboard",
                component: () => import("../Pages/Dashboard.vue"),
                meta: { title: "الرئيسية" },
            },
            {
                path: "/users",
                name: "المستخدمين",
                component: View,
                redirect: "/users",
                children: [
                    {
                        path: "/users",
                        name: " users",
                        component: () => import("../Pages/Users/Index.vue"),
                        meta: { title: "المستخدمين" },
                    },
                    {
                        path: "/roles",
                        name: " roles",
                        component: () => import("../Pages/Roles/Index.vue"),
                        meta: { title: "الصلاحيات" },
                    },
                ],
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    mode: "history",
    routes,
    scrollBehavior() {
        // always scroll to top
        return { top: 0 };
    },
});

export default router;
