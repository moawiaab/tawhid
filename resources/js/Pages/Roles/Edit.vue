<template>
    <form @submit.prevent="submitForm">
        <Modal title=" تعديل الصلاحية " ref="thisModal" maxWidth="lg">
            <template #body>
                <v-text v-model="single.entry.title" type="text" title=" اسم الصلاحية" :error="single.errors.title" />
                <h4>الصلاحيات</h4>
                <Multiselect v-model="single.entry.permissions" :options="single.lists.permissions" mode="tags"
                    :close-on-select="false" :searchable="true" />
            </template>
            <template #footer>
                <btn-create icon="fa-save" type="submit" :disabled="single.loading" title="تعديل" />
            </template>
        </Modal>
    </form>
</template>

<script>
import { ref, computed, watch } from "vue";
import VText from "../../components/inputs/VInput.vue";
import Multiselect from '@vueform/multiselect'
import Modal from "../../components/modals/ModalDialog.vue";
import { useSingleRoles } from '../../stores/roles/single';

export default {
    name: "EditRole",
    components: { VText, Modal, Multiselect },
    setup() {
        let thisModal = ref(null);
        const single = useSingleRoles();
        const submitForm = () => single.updateData().then(() => thisModal.value.hide())
        const showModal = computed(() => single.showModalEdit);

        watch(showModal, (q) => {
            thisModal.value.show();
        }, { deep: true });
        return {
            thisModal,
            single,
            submitForm,
        }
    },
}
</script>
<style src="@vueform/multiselect/themes/default.css">

</style>

