<template>
    <Modal title="عرض بيانات الصلاحية" ref="thisModal" maxWidth="xl" backdrop="true">
        <template #body>
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item"> كود الصلاحية : {{ entry.id }}</li>
                        <li class="list-group-item"> اسم الصلاحية : {{ entry.title }}</li>
                        <li class="list-group-item" v-if="entry.permissions"> عدد الصلاحيات : {{ entry.permissions.length }}</li>
                        <li class="list-group-item" v-if="entry.users"> عدد المستخدمين : {{ entry.users.length }}</li>
                        <li class="list-group-item"> تاريخ الانشاء : {{ entry.created_at }}</li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <h6>الصلاحيات</h6>
                        <span v-for="i in lists.permissions" :key="i.id"
                            class="badge badge-success mb-2 w200">{{ i.name }}</span>
                    </div>
                    <div class="row">
                        <h6>المستخدمين</h6>
                        <span v-for="i in lists.users" :key="i.id"
                            class="badge badge-danger mb-2 w200">{{ i.name }}</span>
                    </div>
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

const entry = computed(() => store.getters["RolesSingle/entry"]);
const lists = computed(() => store.getters["RolesSingle/lists"]);
const showModal = computed(() => store.getters["RolesIndex/showModal"]);


watch(showModal, (q) => {
    thisModal.value.show();
}, { deep: true });
</script>

