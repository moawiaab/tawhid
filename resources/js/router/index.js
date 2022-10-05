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
            },
            {
                path: "/users",
                name: " users.index",
                component: () => import("../Pages/Users/Index.vue"),
            },
            {
                path: "/accounts",
                name: " accounts.index",
                component: () => import("../Pages/Accounts/Index.vue"),
            },
            {
                path: "/roles",
                name: " roles.index",
                component: () => import("../Pages/Roles/Index.vue"),
            },
            {
                path: "/permissions",
                name: " permissions.index",
                component: () => import("../Pages/Permissions/Index.vue"),
            },
            {
                path: "/categories",
                name: " categories.index",
                component: () => import("../Pages/Categories/Index.vue"),
            },
            {
                path: "/products",
                name: " products.index",
                component: () => import("../Pages/Products/Index.vue"),
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
