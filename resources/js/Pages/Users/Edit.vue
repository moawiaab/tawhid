<template>
    <form @submit.prevent="submitForm">
        <Modal title=" تعديل المستخدم " ref="thisModal" maxWidth="lg">
            <template #body>
                <v-text v-model="entry.name" type="text" title="الاسم بالكامل" :error="errors.name" />
                <v-text v-model="entry.email" type="email" title="البريد الالكتروني" :error="errors.email" />
                <v-text v-model="entry.phone" type="number" title=" رقم الهاتف" :error="errors.phone"
                    :required="false" />
                <select-text v-model="entry.role_id" title="الصلاحية" :error="errors.role_id">
                    <option v-for="role in lists.roles" :key="role.id" :value="role.id"> {{ role.title }} </option>
                </select-text>
            </template>
            <template #footer>
                <btn-create icon="fa-save" type="submit" :disabled="loading" title="تعديل" />
            </template>
        </Modal>
    </form>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import VText from "../../components/inputs/VInput.vue";
import SelectText from "../../components/inputs/VSelect.vue";
import Modal from "../../components/modals/ModalDiloge.vue";

import { useStore } from "vuex";

const store = useStore();
let thisModal = ref(null);

const entry = computed(() => store.getters["UsersSingle/entry"]);
const errors = computed(() => store.getters["UsersSingle/errors"]);
const loading = computed(() => store.getters["UsersSingle/loading"]);
const lists = computed(() => store.getters["UsersSingle/lists"]);
const showModal = computed(() => store.getters["UsersIndex/showEdit"]);

const submitForm = () => {
    store.dispatch('UsersSingle/updateData')
        .then(() => {
            thisModal.value.hide();
            store.dispatch('UsersIndex/fetchIndexData')
            store.dispatch('UsersSingle/resetState')
        })
        .catch(error => {
            _.delay(() => {
                store.dispatch('UsersSingle/stop')
            }, 2000)
        })
}

watch(showModal, (q) => {
    thisModal.value.show();
}, { deep: true });
</script>
