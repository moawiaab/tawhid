const amountList = [
    {
        title: "الرقم",
        field: "id",
        slot: true,
    },
    {
        title: "المبلغ",
        field: "amount",
        slot: true,
    },
    {
        title: "الصادر",
        field: "take_amount",
        slot: true,
    },
    {
        title: "الوارد",
        field: "add_amount",
        slot: true,
    },
    {
        title: "التفاصيل",
        field: "details",
        slot: true,
    },
    {
        title: "رقم البنكك",
        field: "num",
        slot: true,
    },
    {
        title: "طريقة التسليم ",
        field: "type",
        type: "enum",
    },
    {
        title: "المستخدم",
        field: "user.name",
        type: "item",
        slot: true,
    },
    {
        title: "التاريخ",
        field: "created_at",
        slot: true,
    },
];

export default amountList;
