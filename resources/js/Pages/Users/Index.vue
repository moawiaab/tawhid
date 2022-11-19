<template>
    <main-page :headers="headers" role="user" title="المستخدمين">
        <template #create>
            <create-user />
        </template>

        <edit-user />
        <show-user />
    </main-page>
</template>

<script lang="ts">
import CreateUser from "./Create.vue";
import EditUser from "./Edit.vue"
import ShowUser from "./Show.vue"
import { usePageIndex } from '../../stores/pages/pageIndex';

export default {
    components: { CreateUser, EditUser, ShowUser },
    setup() {
        const pages = usePageIndex();
        pages.$reset()
        pages.setup('users', "users");
        const headers: import('vue3-easy-data-table').Header[] = [
            { text: "اسم المستخدم", value: "name", width: 200, sortable: true },
            { text: "البريد", value: "email", width: 200 },
            { text: "رقم الهاتف", value: "phone", sortable: true },
            { text: "الصلاحية", value: "role", sortable: true },
            { text: "تاريخ الإنشاء", value: "created_at", sortable: true },//
            { text: "إعدادات", value: "operation", width: 150 },
        ];
        return { headers }
    }
}
</script>

