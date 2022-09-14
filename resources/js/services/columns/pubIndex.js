const amountList = [
    {
        title: "الرقم",
        field: "id",
        slot: true,
    },
    {
        title: "صاحب خزنة",
        field: "name",
    },
    {
        title: "جملة المبلغ",
        field: "on_open",
        slot: true,
    },
    {
        title: "المبلغ المحول",
        field: "amount",
        slot: true,
    },
    {
        title: "الباقي من اخر تحويل",
        field: "problem",
        slot: true,
    },
    {
        title: "المرسل",
        field: "user.name",
        slot: true,
    },
    {
        title: "تاريخ الارسال",
        field: "created_at",
        slot: true,
    },
    {
        title: "المستلم",
        field: "admin.name",
    },
    {
        title: "تاريخ الاستلام",
        field: "updated_at",
        slot: true,
    },
];

export default amountList;
