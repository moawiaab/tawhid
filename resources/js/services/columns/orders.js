const columns = [
    {
        title: "الرقم",
        field: "id",
        slot: true,
    },
    {
        title: " الاصناف المضافة ",
        field: "hasProducts",
        type: "product",
    },
    {
        title: " عدد الاصناف ",
        field: "productCount",
    },
    {
        title: " العميل ",
        field: "supplier",
        slot: true,
    },
    {
        title: " مبلغ الفاتورة  ",
        field: "amount",
        slot: true,
    },
    {
        title: " المستخدم ",
        field: "user.name",
        slot: true,
    },
    {
        title: " التاريخ ",
        field: "created_at",
        slot: true,
    },
];

export default columns;
