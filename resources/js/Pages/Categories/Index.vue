<template>
    <Loader v-if="category.loading" />
    <Content title="أقسام المنتجات">

        <template #content>
            <div class="new-item">
                <create-category />
            </div>
            <EasyDataTable :server-items-length="category.total" buttons-pagination v-model:server-options="query"
                :headers="headers" :items="category.categories" body-text-direction="right"
                table-class-name="customize-table" theme-color="#0dcaf0" :table-height="550" :loading="category.loading"
                alternating border-cell>
                <template #item-status="item">
                    {{item.status == 1 ? 'قسم عام' : 'قسم خاص'}}  -  {{item.account.name}}
                </template>
                <template #item-operation="item">
                    <div class="operation-wrapper text-right">
                        <table-icon @click="category.showItem(item)" icon="eye" color="info" title="عرض أقسام" />
                        <table-icon @click="category.editItem(item)" />
                    </div>
                </template>
            </EasyDataTable>
            <edit-category />
            <show-category />
        </template>
    </Content>

</template>
<script setup lang="ts">

import { ref, computed, watch, reactive } from '@vue/runtime-core';
import { useCategories } from '../../stores/Categories';
import type { Header, ServerOptions, Item } from "vue3-easy-data-table";
import EditCategory from "./Edit.vue";
import ShowCategory from "./Show.vue";
import CreateCategory from "./Create.vue";

const headers: Header[] = [
    { text: "اسم القسم", value: "name", width: 200, sortable: true },
    { text: "التفاصيل", value: "details", width: 200, sortable: true },
    { text: "حالة القسم", value: "status" },
    { text: "تاريخ الإنشاء", value: "created_at", sortable: true },
    { text: "", value: "operation", width: 100 },
];
const category = useCategories()
const query = ref<ServerOptions>({ sortBy: 'id', sortType: 'desc', rowsPerPage: 20, page: 1 })
category.fetchIndexData();


watch(query, (q) => {
    category.setQuery(q);
    category.fetchIndexData();
}, { deep: true });
</script>

