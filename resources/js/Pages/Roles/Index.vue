<template>
    <Loader v-if="role.loading" />
    <Content title="الصلاحيات">

        <template #content>
            <div class="new-item">
                <btn-create color="btn-info mr-2 text-light" icon="fa-refresh" title="تحديث" :disabled="role.loading"
                    @click.prevent="role.fetchIndexData();" />
                <create-role />
            </div>
            <div class="w350 mb-2">
                <search-filter :query="filter" />
            </div>
            <EasyDataTable :server-items-length="role.total" buttons-pagination v-model:server-options="query"
                :headers="headers" :items="role.roles" body-text-direction="right" table-class-name="customize-table"
                theme-color="#0dcaf0" :table-height="500" :loading="role.loading" alternating border-cell>
                <template #loading />
                <template #item-permissions="item">
                    {{item.permissions.length}}
                </template>
                <template #expand="item">
                    <div style="padding: 5px">
                        <span class="badge bg-info font-16 mb-1 p-1 pb-2" v-for="p in item.permissions"
                            :key="p.id">{{p.details}}</span>
                    </div>
                </template>
                <template #item-operation="item">
                    <div class="operation-wrapper text-right">
                        <table-icon @click="role.showItem(item)" icon="eye" color="info" title="عرض الصلاحية" />
                        <table-icon @click="role.editItem(item)" />
                        <table-icon @click="role.deleteItem(item)" icon="trash" color="danger" title="حذف الصلاحية" />
                    </div>
                </template>
            </EasyDataTable>

            <edit-role />
            <show-role />
        </template>
    </Content>

</template>
<script setup lang="ts">

import { ref, computed, watch, reactive } from '@vue/runtime-core';
import { useRoles } from '../../stores/roles/roles';
import type { Header, ServerOptions, Item } from "vue3-easy-data-table";
import EditRole from "./Edit.vue";
import ShowRole from "./Show.vue";
import CreateRole from "./Create.vue";


const headers: Header[] = [
    { text: "اسم الصلاحية", value: "title", width: 200, sortable: true },
    { text: 'عدد الصلاحيات', value: "permissions", width: 200 },
    { text: "تاريخ الإنشاء", value: "created_at", sortable: true },//
    { text: "", value: "operation", width: 100 },
];
const role = useRoles()
const query = ref<ServerOptions>({ sortBy: 'id', sortType: 'desc', rowsPerPage: 20, page: 1 })
role.fetchIndexData();
const filter = ref({ s: '' })

watch(filter, (q) => {
    role.setFilters(q);
    role.fetchIndexData();
}, { deep: true })

watch(query, (q) => {
    role.setQuery(q);
    role.fetchIndexData();
}, { deep: true });
</script>
