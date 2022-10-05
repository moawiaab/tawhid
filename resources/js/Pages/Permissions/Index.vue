<template>
    <Loader v-if="permission.loading" />
    <Content title="أذن دخول">
        <template #content>
            <div class="new-item">
                <create-permission />
            </div>
            <EasyDataTable :server-items-length="permission.total" buttons-pagination v-model:server-options="query"
                :headers="headers" :items="permission.permissions" body-text-direction="right" table-class-name="customize-table"
                theme-color="#0dcaf0" :table-height="550" :loading="permission.loading" alternating border-cell>
                <template #item-operation="item">
                    <div class="operation-wrapper text-right">
                        <table-icon @click="permission.editItem(item)" />
                        <table-icon @click="permission.deleteItem(item)" icon="trash" color="danger" title="حذف الإذن" />
                    </div>
                </template>
            </EasyDataTable>
            <edit-permission />
        </template>
    </Content>

</template>
<script setup lang="ts">

    import { ref, computed, watch, reactive } from '@vue/runtime-core';
    import { usePermissions } from '../../stores/permissions';
    import type { Header, ServerOptions, Item } from "vue3-easy-data-table";
    import EditPermission from "./Edit.vue";
    import CreatePermission from "./Create.vue";


    const headers: Header[] = [
        { text: "اسم الصلاحية", value: "details", width: 200, sortable: true },
        { text: "ربط الصلاحية", value: "title", width: 200 },
        { text: "تاريخ الإنشاء", value: "created_at", sortable: true },//
        { text: "", value: "operation", width: 100 },
    ];
    const permission = usePermissions()
    const query = ref<ServerOptions>({ sortBy: 'id', sortType: 'desc', rowsPerPage: 20, page: 1 })
    permission.fetchIndexData();


    watch(query, (q) => {
        permission.setQuery(q);
        permission.fetchIndexData();
    }, { deep: true });
    </script>
