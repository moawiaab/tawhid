<template>
    <Loader v-if="account.loading" />
    <Content title="الحسابات">

        <template #content>
            <div class="new-item">
                <btn-create color="btn-info mr-2 text-light" icon="fa-refresh" title="تحديث" :disabled="account.loading"
                    @click.prevent="account.fetchIndexData();" />
                <create-account />
            </div>
            <EasyDataTable :server-items-length="account.total" buttons-pagination v-model:server-options="query"
                :headers="headers" :items="account.accounts" body-text-direction="right"
                table-class-name="customize-table" theme-color="#0dcaf0" :table-height="550" :loading="account.loading"
                alternating border-cell>

                <template #item-operation="item">
                    <div class="operation-wrapper text-right">
                        <table-icon @click="account.lockItem(item)" icon="lock" color="danger" title="فتح الحساب"
                            v-if="!item.status && item.id != 1" />
                        <table-icon @click="account.lockItem(item)" icon="unlock" color="success" title="قفل الحساب"
                            v-if="item.status && item.id != 1" />
                    </div>
                </template>
            </EasyDataTable>
            <edit-account />
            <show-account />
        </template>
    </Content>

</template>
<script setup lang="ts">

import { ref, computed, watch, reactive } from '@vue/runtime-core';
import { useAccounts } from '../../stores/accounts';
import type { Header, ServerOptions, Item } from "vue3-easy-data-table";
import EditAccount from "./Edit.vue";
import ShowAccount from "./Show.vue";
import CreateAccount from "./Create.vue";
import ability from '../../services/ability';


const headers: Header[] = [
    { text: "اسم الحساب", value: "name", width: 200, sortable: true },
    { text: "التفاصيل", value: "details", width: 200 },
    { text: "تاريخ الإنشاء", value: "created_at", sortable: true },//
    { text: "", value: "operation", width: 100 },
];
const account = useAccounts()
const query = ref<ServerOptions>({ sortBy: 'id', sortType: 'desc', rowsPerPage: 20, page: 1 })
account.fetchIndexData();


watch(query, (q) => {
    account.setQuery(q);
    account.fetchIndexData();
}, { deep: true });
</script>

