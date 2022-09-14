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
        field: "take",
        slot: true,
    },
    {
        title: "الوارد",
        field: "export",
        slot: true,
    },
    {
        title: "التفاصيل",
        field: "details",
        slot: true,
    },
    {
        title: "طريقة التسليم ",
        field: "type",
        type : 'enum'
    },
    {
        title: "المستخدم",
        field: "user.name",
        type: 'item',
        slot: true,
    },
    {
        title: "التاريخ",
        field: "created_at",
        slot: true,
    },
];

export default amountList;
