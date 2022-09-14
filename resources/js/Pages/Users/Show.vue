<template>
    <Modal title="عرض بيانات المستخدم" ref="thisModal" maxWidth="fxl" backdrop="true">
        <template #body>
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item"> كود المستخدم : {{ entry.id }}</li>
                        <li class="list-group-item"> اسم المستخدم : {{ entry.name }}</li>
                        <li class="list-group-item"> البريد الالكتروني : {{ entry.email }}</li>
                        <li class="list-group-item"> رقم الهاتف : {{ entry.phone }}</li>
                        <li class="list-group-item" v-if="entry.role"> صلاحية الدخول : {{ entry.role.title }}</li>
                        <li class="list-group-item" v-if="entry.account"> اسم المتجر : {{ entry.account.name }}</li>
                        <li class="list-group-item"> تاريخ الإنشاء : {{ entry.created_at }}</li>
                        <li class="list-group-item"> تاريخ التحديث : {{ entry.updated_at }}</li>
                    </ul>
                </div>

            </div>
        </template>
        <template #footer>

        </template>
    </Modal>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import Modal from "../../components/modals/ModalDiloge.vue";

import { useStore } from "vuex";
import ShowCard from "../../components/widgets/ShowCard.vue";

const store = useStore();
let thisModal = ref(null);

const entry = computed(() => store.getters["UsersSingle/entry"]);
const lists = computed(() => store.getters["UsersSingle/lists"]);
const showModal = computed(() => store.getters["UsersIndex/showModal"]);


watch(showModal, (q) => {
    thisModal.value.show();
}, { deep: true });
</script>

