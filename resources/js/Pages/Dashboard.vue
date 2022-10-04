<script lang="ts" setup>
import { ref, computed, watch, reactive } from '@vue/runtime-core';
import { useUsers } from '../stores/users/users';
import type { Header } from "vue3-easy-data-table";


const headers: Header[] = [
    { text: "اسم المستخدم", value: "name", width: 200, sortable: true },
    { text: "البريد", value: "email", width: 200 },
    { text: "رقم الهاتف", value: "phone", sortable: true },
    { text: "الصلاحية", value: "role", sortable: true },
    { text: "تاريخ الإنشاء", value: "created_at", sortable: true },//
    { text: "", value: "operation", width: 100 },
];
const user = useUsers()
const query = ref({ sortBy: 'id', sortType: 'desc', rowsPerPage: 20, page: 1, type: 3 })
user.fetchIndexData();

watch(query, (q) => {
    user.setQuery(q);
    user.fetchIndexData();
}, { deep: true });
</script>

<template>
    <Loader v-if="user.loading" />
    <Content title="الرئيسية">
        <template #content>
            <EasyDataTable :server-items-length="user.total" buttons-pagination v-model:server-options="query"
                :headers="headers" :items="user.users" body-text-direction="right" table-class-name="customize-table"
                theme-color="#0dcaf0" :table-height="500" :loading="user.loading" alternating border-cell>
                <template #item-role="item">
                    {{item.role.title}}
                </template>
                <template #item-operation="item">
                    <div class="operation-wrapper text-right">
                        <table-icon @click="user.editTable(item)" />
                        <table-icon @click="user.editTable(item)" />
                        <table-icon @click="user.editTable(item)" icon="trash" color="danger" />
                    </div>
                </template>
            </EasyDataTable>
        </template>
    </Content>
</template>

