<template>
    <Loader v-if="product.loading" />
    <Content title="المنتجات">

        <template #content>
            <div class="new-item">
                <btn-create color="btn-info mr-2 text-light" icon="fa-refresh" title="تحديث" :disabled="product.loading"
                    @click.prevent="product.fetchIndexData();" />
                <create-product />
            </div>
            <div class="w350 mb-2">
                <SearchFilter :query="filter" />
            </div>
            <EasyDataTable :server-items-length="product.total" buttons-pagination v-model:server-options="query"
                :headers="headers" :items="product.products" body-text-direction="right"
                table-class-name="customize-table" theme-color="#0dcaf0" :table-height="550" :loading="product.loading"
                alternating border-cell>
                <template #loading />
                <template #item-operation="item">
                    <div class="operation-wrapper text-right">
                        <table-icon @click="product.showItem(item)" icon="eye" color="info" title="عرض المنتجات" />
                        <table-icon @click="product.editItem(item)" v-if="item.editable && this.$can('product_edit')" />
                        <table-icon @click="product.deleteItem(item)" icon="trash" color="danger" title="حذف المنتج"
                            v-if="item.deletable && this.$can('product_delete')" />
                    </div>
                </template>
            </EasyDataTable>
            <edit-product />
            <show-product />
        </template>
    </Content>

</template>
<script setup lang="ts">

import { ref, computed, watch, reactive } from '@vue/runtime-core';
import { useProducts } from '../../stores/Products';
import type { Header, ServerOptions, Item } from "vue3-easy-data-table";
import SearchFilter from '../../components/table/SearchFilter.vue';
import EditProduct from "./Edit.vue";
import ShowProduct from "./Show.vue";
import CreateProduct from "./Create.vue";


const headers: Header[] = [
    { text: "اسم المنتج", value: "name", width: 200, sortable: true },
    { text: "التفاصيل", value: "details", width: 200, sortable: true },
    { text: "قسم المنتج", value: "category", width: 200 },
    { text: "حالة المنتج", value: "status" },
    { text: "تاريخ الإنشاء", value: "created_at", sortable: true },
    { text: "", value: "operation", width: 100 },
];
const product = useProducts()
const query = ref<ServerOptions>({ sortBy: 'id', sortType: 'desc', rowsPerPage: 20, page: 1 })
product.fetchIndexData();
const filter = ref({ s: '' })
watch(filter, (q) => {
    product.setFilter(q);
    product.fetchIndexData();
}, { deep: true });
watch(query, (q) => {
    product.setQuery(q);
    product.fetchIndexData();
}, { deep: true });
</script>

