<template>
    <form @submit.prevent="submitForm">
        <Modal title=" تعديل الصلاحية " ref="thisModal" maxWidth="lg">
            <template #body>
                <v-text v-model="entry.title" type="text" title=" اسم الصلاحية" :error="errors.title" />
                <h4>الصلاحيات</h4>
                <Multiselect v-model="entry.permissions" :options="lists.permissions" mode="tags"
                    :close-on-select="false" :searchable="true" />
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
import Multiselect from '@vueform/multiselect'
import Modal from "../../components/modals/ModalDiloge.vue";

import { useStore } from "vuex";

const store = useStore();
let thisModal = ref(null);

const entry = computed(() => store.getters["RolesSingle/entry"]);
const errors = computed(() => store.getters["RolesSingle/errors"]);
const loading = computed(() => store.getters["RolesSingle/loading"]);
const lists = computed(() => store.getters["RolesSingle/lists"]);
const showModal = computed(() => store.getters["RolesIndex/showEdit"]);

const submitForm = () => {
    store.dispatch('RolesSingle/updateData')
        .then(() => {
            thisModal.value.hide();
            store.dispatch('RolesIndex/fetchIndexData')
            store.dispatch('RolesSingle/resetState')
        })
        .catch(error => {
            _.delay(() => {
                store.dispatch('RolesSingle/stop')
            }, 2000)
        })
}

watch(showModal, (q) => {
    thisModal.value.show();
}, { deep: true });
</script>
<style src="@vueform/multiselect/themes/default.css">
</style>

