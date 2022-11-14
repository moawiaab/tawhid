const items = [
    {
        text: "المستخدمين",
        icon: "mdi-account-cog-outline",
        url: ["/users1", "/roles1", "/parmesans1"],
        access: "",
        children: [
            {
                text: "المستخدمين",
                icon: "mdi-dots-horizontal",
                url: "/users1",
                access: "user_access",
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
        access: "",
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
        access: "",
        children: [
            {
                text: "المستخدمين",
                icon: "mdi-account-details-outline",
                url: "/users",
                access: "",
            },
            { text: "الصلاحيات", icon: "mdi-flag", url: "/roles", access: "" },
            {
                text: "الأذونات",
                icon: "mdi-lock",
                url: "/permissions",
                access: "",
            },
        ],
    },
];

export default items;
