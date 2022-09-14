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
        title: "التفاصيل",
        field: "details",
        slot: true,
    },

    {
        title: "المستخدم",
        field: "user.name",
        type : "item",
        slot: true,
    },
    {
        title: "تاريخ الإنشاء",
        field: "created_at",
        slot: true,
    },

    {
        title: "المستلم ",
        field: "admin.name",
        type: 'item',
        slot: true,
    },
    {
        title: "تاريخ الاستلام",
        field: "updated_at",
        slot: true,
    },

    {
        title: "الحالة ",
        field: "status",
        slot: true,
        type: 'check',
    },
];

export default amountList;
