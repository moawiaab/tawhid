<template>
    <Loader v-if="loading" />
    <Content title="الصلاحيات">
        <template #header>
            <li class="breadcrumb-item">
                <router-link to="/dashboard">الرئيسية</router-link>
            </li>
        </template>
        <template #content>
            <div class="new-item">
                <Create />
            </div>
            <data-table :data="data.data" :columns="columns" :query="query" :xprops="xprops" :total="total" />
            <Edit />
            <Show />
        </template>
    </Content>

</template>
<script setup>

import { computed, onMounted, ref, watch } from "vue";
import { useStore } from "vuex";
import Create from "./Create.vue";
import Edit from "./Edit.vue";
import Show from "./Show.vue";

const store = useStore();
onMounted(() => {
    store.dispatch('RolesIndex/fetchIndexData')
})
const data = computed(() => store.getters["RolesIndex/data"]);
const total = computed(() => store.getters["RolesIndex/total"]);
const loading = computed(() => store.getters["RolesIndex/loading"]);

const query = ref({ sort: 'id', order: 'desc', limit: 10, s: '', offset: 0, type: 'default' })
const xprops = {
    module: 'RolesIndex',
    route: 'roles',
    permission_prefix: 'role_',
    deletable: true,
    editable: true,
    viewable: true,
}

const columns = [
    {
        title: 'الرقم',
        field: 'id',
        slot: true
    },
    {
        title: 'الاسم',
        field: 'title',
        slot: true
    },
    {
        title: 'الصلاحيات',
        field: 'permissions',
        type: 'listCol',
        color: 'success'
    },
    {
        title: 'عدد الصلاحيات',
        field: 'permissions.length',
        type: 'item',
    },
    {
        title: 'الإنشاء',
        field: 'created_at',
    }

]

watch(query, (q) => {
    store.dispatch('RolesIndex/setQuery', q)
    store.dispatch('RolesIndex/fetchIndexData')
}, { deep: true });
</script>

