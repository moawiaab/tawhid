import { createRouter, createWebHistory } from "vue-router";

import DefaultLayout from "@/layouts/DefaultLayout.vue";
const routes = [
    {
        path: "/",
        name: "Main Dashboard",
        component: DefaultLayout,
        redirect: "/dashboard",
        children: [
            {
                path: "/dashboard",
                name: "لوحة التحكم",
                component: () => import("@/Pages/DashboardPage.vue"),
            },
            {
                path: "/users",
                name: " المستخدمين",
                component: () => import("@/Pages/Users/Index.vue"),
            },
            // {
            //     path: "/accounts",
            //     name: " accounts.index",
            //     component: () => import("@/Pages/Accounts/Index.vue"),
            // },
            {
                path: "/roles",
                name: " roles.index",
                component: () => import("@/Pages/Roles/Index.vue"),
            },
            {
                path: "/permissions",
                name: " permissions.index",
                component: () => import("@/Pages/Permissions/Index.vue"),
            },
            // {
            //     path: "/categories",
            //     name: " categories.index",
            //     component: () => import("@/Pages/Categories/Index.vue"),
            // },
            // {
            //     path: "/products",
            //     name: " products.index",
            //     component: () => import("@/Pages/Products/Index.vue"),
            // },
            // {
            //     path: "/stores",
            //     name: " stores.index",
            //     component: () => import("@/Pages/Stores/Index.vue"),
            // },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    mode: "history",
    routes,
});

export default router;
