<template>
    <btn-create @click="showModal" />
    <form @submit.prevent="submitForm">
        <Modal title="إضافة صلاحية جديدة" ref="thisModal" maxWidth="lg">
            <template #body>
                <v-text v-model="entry.title" type="text" title=" اسم الصلاحية" :error="errors.title" />
                <h4>الصلاحيات</h4>
                <Multiselect v-model="entry.permissions" :options="lists.permissions" mode="tags"
                    :close-on-select="false" :searchable="true" />

            </template>
            <template #footer>
                <btn-create icon="fa-save" type="submit" :disabled="loading" />
            </template>
        </Modal>
    </form>
</template>

<script setup>
import Multiselect from '@vueform/multiselect'
import { ref, computed } from "vue";
import VText from "../../components/inputs/Input.vue";
import Modal from "../../components/modals/ModalDiloge.vue";

import { useStore } from "vuex";

const options = ['list', 'of', 'options']
const store = useStore();
let thisModal = ref(null);

function showModal() {
    store.dispatch('RolesSingle/resetState')
    store.dispatch('RolesSingle/fetchCreateData')
    thisModal.value.show();
}

const entry = computed(() => store.getters["RolesSingle/entry"]);
const errors = computed(() => store.getters["RolesSingle/errors"]);
const loading = computed(() => store.getters["RolesSingle/loading"]);
const lists = computed(() => store.getters["RolesSingle/lists"]);


const submitForm = () => {
    store.dispatch('RolesSingle/storeData')
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
</script>
<style src="@vueform/multiselect/themes/default.css">
</style>
