const amountList = [
    {
        title: "الرقم",
        field: "id",
        slot: true,
    },
    {
        title: "تاريخ المعاملة",
        field: "created_at",
        slot: true,
    },
    {
        title: "المبلغ",
        field: "amount",
        slot: true,
    },
    {
        title: "عدد الاسهم",
        field: "num",
        // slot: true,
    },
    {
        title: "تاريخ البداية",
        field: "start_date",
        slot: true,
    },
    {
        title: "تاريخ النهاية ",
        field: "end_date",
        slot: true,
        // type: "enum",
    },
    {
        title: "عدد الايام",
        field: "all_date",
        // type: "item",
        // slot: true,
    },
    {
        title: "الارباح",
        field: "gain",
        slot: true,
    },
    {
        title: " المستخدم",
        field: "user",
        // type: "item",
        // slot: true,
    },
];

export default amountList;
