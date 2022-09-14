const columns = [
    {
        title: "الرقم",
        field: "id",
        slot: true,
    },
    {
        title: "اسم المنتج",
        field: "name",
        slot: true,
    },
    {
        title: "العدد",
        field: "number",
        slot: true,
        type: "item",
    },
    {
        title: "سعر الشراء",
        field: "purchasing_price",
    },
    {
        title: "نسبة الربح",
        field: "profit_ratio",
        sup: ' % ',
        slot: true,
    },
    {
        title: "سعر البيع",
        field: "selling_price",
        slot: true,
    },
    {
        title: "المستخدم ",
        field: "user.name",
        slot: true,
        type: "item",
    },
    {
        title: "تاريخ الإنشاء",
        field: "created_at",
        slot: true,
    },
];

export default columns;
