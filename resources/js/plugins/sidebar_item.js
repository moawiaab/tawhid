const items = [
    {
        text: "المستخدمين",
        icon: "mdi-account-cog-outline",
        url: ["/users1", "/roles1", "/parmesans1"],
        access: "user",
        children: [
            {
                text: "المستخدمين",
                icon: "mdi-dots-horizontal",
                url: "/users1",
                access: "user",
            },
            { text: "الصلاحيات", icon: "mdi-dots-horizontal", url: "/roles1" },
            {
                text: "الأذونات",
                icon: "mdi-dots-horizontal",
                url: "/parmesans1",
                access: "",
            },
        ],
    },
    {
        text: "لوحة التحكم",
        icon: "mdi-home-outline",
        url: "/dashboard",
        access: "dashboard",
    },
    {
        text: " الفروع",
        icon: "mdi-source-branch",
        url: "/accounts",
        access: "",
    },
    {
        text: "المستخدمين",
        icon: "mdi-account-cog-outline",
        url: ["/users", "/roles", "/permissions"],
        access: "user",
        children: [
            {
                text: "المستخدمين",
                icon: "mdi-account-details-outline",
                url: "/users",
                access: "user",
            },
            { text: "الصلاحيات", icon: "mdi-account-lock-outline", url: "/roles", access: "role" },
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
