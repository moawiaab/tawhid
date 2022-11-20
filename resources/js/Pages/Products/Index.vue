<template>
    <main-page :headers="headers" role="product" title=" المنتجات" :viewable="false" :editable="false"
        :deletable="false">
        <template #create>
            <create-product />
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
            { text: "قسم المنتج", value: "category", width: 200 },
            { text: "حالة المنتج", value: "status_label" },
            { text: "تاريخ الإنشاء", value: "created_at", sortable: true },
            { text: "إعدادات", value: "operation", width: 150 },
        ];
        return { headers, pages }
    }
}
</script>

