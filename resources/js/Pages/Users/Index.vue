<template>
    <Loader v-if="user.loading" />
    <Content title="المستخدمين">

        <template #content>
            <div class="new-item">
                <btn-create color="btn-info mr-2 text-light" icon="fa-refresh" title="تحديث" :disabled="user.loading"
                    @click.prevent="user.fetchIndexData();" />
                <create-user />
            </div>
            <div class="w350 mb-2">
                <search-filter :query="filter" />
            </div>
            <EasyDataTable :server-items-length="user.total" buttons-pagination v-model:server-options="query"
                :headers="headers" :items="user.users" body-text-direction="right" table-class-name="customize-table"
                theme-color="#0dcaf0" :table-height="550" :loading="user.loading" alternating border-cell>
                <template #loading />
                <template #item-role="item">
                    {{item.role?item.role.title:'لا توجد صلاحية'}}
                </template>
                <template #item-operation="item">
                    <div class="operation-wrapper text-right">
                        <table-icon @click="user.showItem(item)" icon="eye" color="info" title="عرض المستخدم" />
                        <table-icon @click="user.editItem(item)" />
                        <!-- <table-icon @click="user.deleteItem(item)" icon="trash" color="danger" title="حذف المستخدم" /> -->
                        <table-icon @click="user.lockItem(item)" icon="lock" color="danger" title="فتح الحساب"
                            v-if="!item.status" />
                        <table-icon @click="user.lockItem(item)" icon="unlock" color="success" title="قفل الحساب"
                            v-else />
                    </div>
                </template>
            </EasyDataTable>
            <edit-user />
            <show-user />
        </template>
    </Content>

</template>
<script setup lang="ts">

import { ref, computed, watch, reactive } from '@vue/runtime-core';
import { useUsers } from '../../stores/users/users';
import type { Header, ServerOptions, Item } from "vue3-easy-data-table";
import EditUser from "./Edit.vue";
import ShowUser from "./Show.vue";
import CreateUser from "./Create.vue";


const headers: Header[] = [
    { text: "اسم المستخدم", value: "name", width: 200, sortable: true },
    { text: "البريد", value: "email", width: 200 },
    { text: "رقم الهاتف", value: "phone", sortable: true },
    { text: "الصلاحية", value: "role", sortable: true },
    { text: "تاريخ الإنشاء", value: "created_at", sortable: true },//
    { text: "", value: "operation", width: 100 },
];
const user = useUsers()
const query = ref<ServerOptions>({ sortBy: 'id', sortType: 'desc', rowsPerPage: 20, page: 1 })
const filter = ref({ s: '' })
user.fetchIndexData();


watch(query, (q) => {
    user.setQuery(q);
    user.fetchIndexData();
}, { deep: true });

watch(filter, (q) => {
    user.setFilter(q);
    user.fetchIndexData();
}, { deep: true });
</script>

