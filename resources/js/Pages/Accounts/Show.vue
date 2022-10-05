<template>
    <Modal title="عرض بيانات المستخدم" ref="thisModal" maxWidth="xl" backdrop="true">
        <template #body>
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item"> كود المستخدم : {{ single.entry.id }}</li>
                        <li class="list-group-item"> اسم المستخدم : {{ single.entry.name }}</li>
                        <li class="list-group-item"> البريد الالكتروني : {{ single.entry.email }}</li>
                        <li class="list-group-item"> رقم الهاتف : {{ single.entry.phone }}</li>
                        <li class="list-group-item" v-if="single.entry.role"> صلاحية الدخول : {{ single.entry.role.title
                        }}</li>
                        <li class="list-group-item" v-if="single.entry.account"> اسم المتجر : {{
                        single.entry.account.name }}</li>
                        <li class="list-group-item"> تاريخ الإنشاء : {{ single.entry.created_at }}</li>
                        <li class="list-group-item"> تاريخ التحديث : {{ single.entry.updated_at }}</li>
                    </ul>
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
import { useSingleUsers } from '../../stores/users/single';

export default {
    name: "ShowUser",
    components: {  Modal },
    setup() {
        let thisModal = ref(null);
        const single = useSingleUsers();
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

