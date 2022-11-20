<template>
    <main-page :headers="headers" role="product" title=" المنتجات" :viewable="false" :editable="false"
        :deletable="false" :deleteAll="false" :expand="true">
        <template #create>
            <create-product />
        </template>

        <template #expand="{ item }">
            <data-table :headers="headersProducts" :items="item.items" body-text-direction="right"
                :hide-footer="true">
            </data-table>
        </template>
        <template #table-operation="{ item }">
            <edit-icon @click="pages.editItem(item.id)" role="product" v-if="!item.deleted_at && item.editable" />
            <delete-icon @click="pages.showDeletedMethod(item.id)" role="product" v-if="item.deletable" />
            <delete-icon @click="pages.restoreItem(item.id)" role="product" v-if="item.deleted_at && item.deletable"
                :resat="true" />
        </template>

        <edit-product />
        <show-product />
    </main-page>
</template>

<script lang="ts">
import CreateProduct from "./Create.vue";
import EditProduct from "./Edit.vue"
import ShowProduct from "./Show.vue"
import { usePageIndex } from '../../stores/pages/pageIndex';

export default {
    components: { CreateProduct, EditProduct, ShowProduct },
    setup() {
        const pages = usePageIndex();
        pages.$reset()
        pages.setup('products');
        const headers: import('vue3-easy-data-table').Header[] = [
            { text: "اسم المنتج", value: "name", width: 200, sortable: true },
            { text: "التفاصيل", value: "details", width: 200, sortable: true },
            { text: "عدد المنتجات", value: "number", width: 100 },
            { text: "قسم المنتج", value: "category", width: 200 },
            { text: "حالة المنتج", value: "status_label" },
            { text: "تاريخ الإنشاء", value: "created_at", sortable: true },
            { text: "إعدادات", value: "operation", width: 150 },
        ];

        const headersProducts: import('vue3-easy-data-table').Header[] = [
            { text: "اسم المخزن", value: "store", width: 200 },
            { text: "عدد الموجود", value: "number", width: 100 },
            { text: "سعر الشراء", value: "price", width: 100 },
            { text: "سعر البيع", value: "amount", width: 100 },
            { text: "نسبة الربح", value: "gain", width: 100 },
            { text: "تاريخ الإنشاء", value: "created_at"},

        ];
        return { headers, pages, headersProducts }
    }
}
</script>

