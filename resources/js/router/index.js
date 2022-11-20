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
                name: " الصلاحيات",
                component: () => import("@/Pages/Roles/Index.vue"),
            },
            {
                path: "/permissions",
                name : "الأذونات",
                component: () => import("@/Pages/Permissions/Index.vue"),
            },
            {
                path: "/categories",
                name: " أقسام المنتجات",
                component: () => import("@/Pages/Categories/Index.vue"),
            },
            {
                path: "/products",
                name: " المنتجات",
                component: () => import("@/Pages/Products/Index.vue"),
            },
            {
                path: "/stores",
                name: " المخازن",
                component: () => import("@/Pages/Stores/Index.vue"),
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    mode: "history",
    routes,
});

export default router;
