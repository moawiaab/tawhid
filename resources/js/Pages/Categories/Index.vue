<template>
    <main-page :headers="headers" role="category" title="أقسام المنتجات" :viewable="false" :editable="false"
        :deletable="false">
        <template #create>
            <create-category />
        </template>

        <template #table-operation="{ item }">
            <edit-icon @click="pages.editItem(item.id)" role="category" v-if="!item.deleted_at && item.editable" />
            <delete-icon @click="pages.showDeletedMethod(item.id)" role="category" v-if="item.deletable" />
            <delete-icon @click="pages.restoreItem(item.id)" role="category" v-if="item.deleted_at && item.deletable"
                :resat="true" />
        </template>

        <edit-category />
        <show-category />
    </main-page>
</template>

<script lang="ts">
import CreateCategory from "./Create.vue";
import EditCategory from "./Edit.vue"
import ShowCategory from "./Show.vue"
import { usePageIndex } from '../../stores/pages/pageIndex';

export default {
    components: { CreateCategory, EditCategory, ShowCategory },
    setup() {
        const pages = usePageIndex();
        pages.$reset()
        pages.setup('categories');
        const headers: import('vue3-easy-data-table').Header[] = [
            { text: "اسم القسم", value: "name", width: 200, sortable: true },
            { text: "التفاصيل", value: "details", width: 200, sortable: true },
            { text: "حالة القسم", value: "status" },
            { text: "تاريخ الإنشاء", value: "created_at", sortable: true },
            { text: "إعدادات", value: "operation", width: 150 },
        ];
        return { headers, pages }
    }
}
</script>

