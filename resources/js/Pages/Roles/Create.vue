<template>
    <btn-create @click="showModal" />
    <form @submit.prevent="submitForm">
        <Modal title="إضافة صلاحية جديدة" ref="thisModal" maxWidth="lg">
            <template #body>
                <v-text v-model="single.entry.title" title=" اسم الصلاحية" :error="single.errors.title" :required="false"
                    col="col-12" />
                <h4>الصلاحيات</h4>
                <Multiselect v-model="single.entry.permissions" :options="single.lists.permissions" mode="tags"
                    :close-on-select="false" :searchable="true" />

            </template>
            <template #footer>
                <btn-create icon="fa-save" type="submit" :disabled="single.loading" />
            </template>
        </Modal>
    </form>
</template>

<script>
import { ref, computed } from "vue";
import Multiselect from '@vueform/multiselect'
import VText from "../../components/inputs/Input.vue";
import Modal from "../../components/modals/ModalDialog.vue";
import { useSingleRoles } from '../../stores/roles/single';

export default {
    name: "CreateRole",
    components: { VText, Multiselect, Modal },
    setup() {
        let thisModal = ref(null);
        const single = useSingleRoles();
        const showModal = () => {
            single.$reset();
            single.fetchCreateData()
            thisModal.value.show();
        }
        const submitForm = () => single.storeData().then(() => thisModal.value.hide())
        return {
            thisModal,
            single,
            showModal,
            submitForm,
        }
    },

}
</script>
<style src="@vueform/multiselect/themes/default.css">

</style>
