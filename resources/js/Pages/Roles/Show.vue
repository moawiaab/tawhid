<template>
    <Modal title="عرض بيانات الصلاحية" ref="thisModal" maxWidth="xl" backdrop="true">
        <template #body>
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item"> كود الصلاحية : {{ single.entry.id }}</li>
                        <li class="list-group-item"> اسم الصلاحية : {{ single.entry.title }}</li>
                        <li class="list-group-item" v-if="single.entry.permissions"> عدد الصلاحيات : {{
                        single.entry.permissions.length }}</li>
                        <li class="list-group-item" v-if="single.entry.users"> عدد المستخدمين : {{
                        single.entry.users.length }}</li>
                        <li class="list-group-item"> تاريخ الانشاء : {{ single.entry.created_at }}</li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <h6>الصلاحيات</h6>
                        <span v-for="i in single.lists.permissions" :key="i.id" class="badge bg-success mb-1 pb-1 w200">{{
                        i.name
                        }}</span>
                    </div>
                    <div class="row">
                        <h6>المستخدمين</h6>
                        <span v-for="i in single.lists.users" :key="i.id" class="badge bg-danger mb-1 pb-1 w200">{{ i.name
                        }}</span>
                    </div>
                </div>
            </div>
        </template>
        <template #footer>

        </template>
    </Modal>
</template>

<script>
import { ref, computed, watch } from "vue";
import Modal from "../../components/modals/ModalDialog.vue";
import { useSingleRoles } from '../../stores/roles/single';

export default {
    name: "ShowRole",
    components: { Modal },
    setup() {
        let thisModal = ref(null);
        const single = useSingleRoles();
        const showModal = computed(() => single.showModalShow);

        watch(showModal, (q) => {
            thisModal.value.show();
        }, { deep: true });
        return {
            thisModal,
            single,
        }
    },

}
</script>
