<template>
    <main-page :headers="headers" role="store" title="المخازن" :deletable="false" :deleteAll="false" :expand="true"
        :addSelected="false">
        <template #create>
            <create-store />
        </template>

        <template #expand="{ item }">
            <data-table :headers="headersProducts" :items="item.products" body-text-direction="right"
                :hide-footer="true">
            </data-table>
        </template>

        <edit-store />
        <show-store />
    </main-page>
</template>

<script lang="ts">
import CreateStore from "./Create.vue";
import EditStore from "./Edit.vue"
import ShowStore from "./Show.vue"
import { usePageIndex } from '../../stores/pages/pageIndex';

export default {
    components: { CreateStore, EditStore, ShowStore },
    setup() {
        const pages = usePageIndex();
        pages.$reset()
        pages.setup('stores');
        const headers: import('vue3-easy-data-table').Header[] = [
            { text: "اسم المخزن", value: "name", width: 200, sortable: true },
            { text: "التفاصيل", value: "details", width: 200, sortable: true },
            { text: "عدد المنتجات", value: "productCount", width: 200 },
            // { text: "حالة المخزن", value: "status" },
            { text: "تاريخ الإنشاء", value: "created_at", sortable: true },
            { text: "إعدادات", value: "operation", width: 150 },
        ];

        const headersProducts: import('vue3-easy-data-table').Header[] = [
            { text: "اسم المنتج", value: "name", width: 200, sortable: true },
            { text: "التفاصيل", value: "details", width: 200, sortable: true },
            { text: "قسم المنتج", value: "category", width: 200 },
            { text: "تاريخ الإنشاء", value: "created_at", sortable: true },
            // { text: "", value: "operation", width: 100 },
        ];
        return { headers, headersProducts }
    }
}
</script>

