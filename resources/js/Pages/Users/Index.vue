<template>
    <Loader v-if="loading" />
    <Content title="المستخدمين">
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
    store.dispatch('UsersIndex/fetchIndexData')
})
const data = computed(() => store.getters["UsersIndex/data"]);
const total = computed(() => store.getters["UsersIndex/total"]);
const loading = computed(() => store.getters["UsersIndex/loading"]);

const query = ref({ sort: 'id', order: 'desc', limit: 10, s: '', offset: 0, type: 'default' })
const xprops = {
    module: 'UsersIndex',
    route: 'users',
    permission_prefix: 'user_',
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
        field: 'name',
        slot: true
    },
    {
        title: 'البريد',
        field: 'email',
        slot: true
    },
    {
        title: 'الهاتف',
        field: 'phone',
    },

    {
        title: 'الصلاحية',
        field: 'role.title',
        type: 'item',
    },
    {
        title: 'الإنشاء',
        field: 'created_at',
    }

]

watch(query, (q) => {
    store.dispatch('UsersIndex/setQuery', q)
    store.dispatch('UsersIndex/fetchIndexData')
}, { deep: true });
</script>

