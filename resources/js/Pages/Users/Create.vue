<template>
    <btn-create @click="showModal" />
    <form @submit.prevent="submitForm">
        <Modal title="إضافة مستخدم جديد" ref="thisModal" maxWidth="lg">
            <template #body>
                <v-text name="name" v-model="entry.name" type="text" title="الاسم بالكامل" :error="errors.name" />
                <v-text name="email" v-model="entry.email" type="email" title="البريد الالكتروني"
                    :error="errors.email" />
                <v-text name="phone" v-model="entry.phone" type="phone" title=" رقم الهاتف" :error="errors.phone" />
                <v-text name="password" v-model="entry.password" type="password" title="كلمة المرور"
                    :error="errors.password" />
                <v-text name="password_confirmation" v-model="entry.password_confirmation" type="password"
                    title="تأكيد كلمة المرور" />
                <select-text name="role_id" v-model="entry.role_id" title="الصلاحية" :error="errors.role_id">
                    <option v-for="role in lists.roles" :key="role.id" :value="role.id"> {{ role.title }} </option>
                </select-text>
            </template>
            <template #footer>
                <btn-create icon="fa-save" type="submit" :disabled="loading" />
            </template>
        </Modal>
    </form>
</template>

<script setup>
import { ref, computed } from "vue";
import VText from "../../components/inputs/VInput.vue";
import SelectText from "../../components/inputs/VSelect.vue";
import Modal from "../../components/modals/ModalDiloge.vue";

import { useStore } from "vuex";
const store = useStore();
let thisModal = ref(null);

function showModal() {
    store.dispatch('UsersSingle/resetState')
    store.dispatch('UsersSingle/fetchCreateData')
    thisModal.value.show();
}

const entry = computed(() => store.getters["UsersSingle/entry"]);
const errors = computed(() => store.getters["UsersSingle/errors"]);
const loading = computed(() => store.getters["UsersSingle/loading"]);
const lists = computed(() => store.getters["UsersSingle/lists"]);
// onMounted(() => store.dispatch('UsersSingle/fetchCreateData'));


const submitForm = () => {
    store.dispatch('UsersSingle/storeData')
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
</script>

<style>
</style>
