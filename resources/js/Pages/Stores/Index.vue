<template>
    <Loader v-if="store.loading" />
    <Content title="المنتجات">

        <template #content>
            <div class="new-item">
                <btn-create color="btn-info mr-2 text-light" icon="fa-refresh" title="تحديث" :disabled="store.loading"
                    @click.prevent="store.fetchIndexData();" />
                <create-store />
            </div>
            <div class="w350 mb-2">
                <SearchFilter :query="filter" />
            </div>
            <EasyDataTable :server-items-length="store.total" buttons-pagination v-model:server-options="query"
                :headers="headers" :items="store.stores" body-text-direction="right" table-class-name="customize-table"
                theme-color="#0dcaf0" :table-height="550" :loading="store.loading" alternating border-cell>
                <template #loading />
                <template #item-operation="item">
                    <div class="operation-wrapper text-right">
                        <table-icon @click="store.showItem(item)" icon="eye" color="info" title="عرض المنتجات" />
                        <table-icon @click="store.editItem(item)" v-if="item.editable && this.$can('store_edit')" />
                        <table-icon @click="store.deleteItem(item)" icon="trash" color="danger" title="حذف المنتج"
                            v-if="item.deletable && this.$can('store_delete')" />
                    </div>
                </template>
                <template #expand="item">
                    <div style="padding: 5px">
                        <EasyDataTable
                        :headers="headersProducts"
                        :items="item.products"
                        alternating body-text-direction="right"
                        table-class-name="customize-table-small"
                        />
                    </div>
                </template>
            </EasyDataTable>
            <edit-store />
            <show-store />
        </template>
    </Content>

</template>
<script setup lang="ts">

import { ref, computed, watch, reactive } from '@vue/runtime-core';
import { useStores } from '../../stores/Stores';
import type { Header, ServerOptions, Item } from "vue3-easy-data-table";
import SearchFilter from '../../components/table/SearchFilter.vue';
import EditStore from "./Edit.vue";
import ShowStore from "./Show.vue";
import CreateStore from "./Create.vue";


const headers: Header[] = [
    { text: "اسم المخزن", value: "name", width: 200, sortable: true },
    { text: "التفاصيل", value: "details", width: 200, sortable: true },
    { text: "عدد المنتجات", value: "productCount", width: 200 },
    { text: "حالة المخزن", value: "status" },
    { text: "تاريخ الإنشاء", value: "created_at", sortable: true },
    { text: "", value: "operation", width: 100 },
];
const headersProducts: Header[] = [
{ text: "اسم المنتج", value: "name", width: 200, sortable: true },
    { text: "التفاصيل", value: "details", width: 200, sortable: true },
    { text: "قسم المنتج", value: "category", width: 200 },
    { text: "تاريخ الإنشاء", value: "created_at", sortable: true },
    // { text: "", value: "operation", width: 100 },
];
const store = useStores()
const query = ref<ServerOptions>({ sortBy: 'id', sortType: 'desc', rowsPerPage: 20, page: 1 })
store.fetchIndexData();
const filter = ref({ s: '' })
watch(filter, (q) => {
    store.setFilter(q);
    store.fetchIndexData();
}, { deep: true });
watch(query, (q) => {
    store.setQuery(q);
    store.fetchIndexData();
}, { deep: true });
</script>

