const columns = [
    {
        title: "الرقم",
        field: "id",
        slot: true,
    },
    {
        title: " الاسم",
        field: "name",
        slot: true,
    },
    {
        title: "مبلغ الإجار",
        field: "amount",
        slot: true,
    },
    {
        title: "العدد الكلي",
        field: "number",
    },
    {
        title: "العدد المؤجر",
        field: "num",
        slot: true,
    },
    {
        title: "العدد الموجود",
        field: "numIn",
        type: 'item'
    },
    {
        title: "المسخدم",
        field: "user",
    },
];

export default columns;
