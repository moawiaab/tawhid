const items = [
    {
        text: "لوحة التحكم",
        icon: "mdi-home-outline",
        url: "/dashboard",
        access: "dashboard",
    },
    {
        text: "العملاء",
        icon: "mdi-account-details-outline",
        url: "/clients",
        access: "client",
    },
    {
        url: ["/stores", "/categories", "/products"],
        text: "إدارة المنتجات",
        icon: "mdi-window-shutter-cog",
        access: "product_management",
        children: [
            {
                url: "/stores",
                text: "المخازن",
                access: "store",
                icon: "mdi-storefront-minus-outline",
            },
            {
                text: "أقسام المنتجات",
                url: "/categories",
                access: "category",
                icon: "mdi-tune-vertical",
            },
            {
                url: "/products",
                text: "المنتجات",
                access: "product",
                icon: "mdi-format-list-checkbox",
            },
        ],
    },
    {
        text: "المستخدمين",
        icon: "mdi-account-cog-outline",
        url: ["/users", "/roles", "/permissions"],
        access: "user_management",
        children: [
            {
                text: "المستخدمين",
                icon: "mdi-account-details-outline",
                url: "/users",
                access: "user",
            },
            {
                text: "الصلاحيات",
                icon: "mdi-account-lock-outline",
                url: "/roles",
                access: "role",
            },
            {
                text: "الأذونات",
                icon: "mdi-lock-outline",
                url: "/permissions",
                access: "permission",
            },
        ],
    },
];

export default items;
