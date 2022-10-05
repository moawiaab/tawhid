<template>
    <form @submit.prevent="submitForm">
        <Modal title=" تعديل إذن الدخول " ref="thisModal">
            <template #body>
                <v-text v-model="single.entry.details" title=" اسم الصلاحية" :error="single.errors.details" />
                <v-text v-model="single.entry.title" title="الرابط" :error="single.errors.title" />
            </template>
            <template #footer>
                <btn-create icon="fa-save" type="submit" :disabled="single.loading" title="تعديل" />
            </template>
        </Modal>
    </form>
</template>

<script>
import { ref, computed,watch } from "vue";
import VText from "../../components/inputs/VInput.vue";
import Modal from "../../components/modals/ModalDialog.vue";
import { useSinglePermissions } from '../../stores/permissions/single';

export default {
    name: "EditPermission",
    components: { VText, Modal },
    setup() {
        let thisModal = ref(null);
        const single = useSinglePermissions();

        const showModal = computed(() => single.showModalEdit);

        watch(showModal, (q) => {
            thisModal.value.show();
        }, { deep: true });
        const submitForm = () => single.updateData().then(() => thisModal.value.hide())
        return {
            thisModal,
            single,
            showModal,
            submitForm,
        }
    },

}
</script>
