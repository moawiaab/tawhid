const amountList = [
    {
        title: "الرقم",
        field: "id",
        slot: true,
    },
    {
        title: "العدد",
        field: "num",
        back : true,
        slot: true,
    },
    {
        title: "سعر البيع",
        field: "price",
        slot: true,
    },
    {
        title: "جملة المبلغ ",
        field: "all_amount",
        slot: true,
    },
    {
        title: "المضيف",
        field: "user.name",
        slot: true,
        type: "item",
    },
    {
        title: "تاريخ الاضافة",
        field: "created_at",
        slot: true,
    },
    {
        title: "المستلام",
        field: "updated_user.name",
        type: "item",
    },
    {
        title: "تاريخ الاستلام ",
        field: "updated_at",
        slot: true,
    },
];

export default amountList;
