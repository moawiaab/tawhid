<template>
    <form @submit.prevent="submitForm">
        <Modal title=" تعديل المستخدم " ref="thisModal" maxWidth="lg">
            <template #body>
                <v-text v-model="single.entry.name" type="text" title="الاسم بالكامل" :error="single.errors.name" />
                <v-text v-model="single.entry.email" type="email" title="البريد الالكتروني"
                    :error="single.errors.email" />
                <v-text v-model="single.entry.phone" type="number" title=" رقم الهاتف" :error="single.errors.phone"
                    :required="false" />
                <select-text v-model="single.entry.role_id" title="الصلاحية" :error="single.errors.role_id">
                    <option v-for="role in single.lists.roles" :key="role.id" :value="role.id"> {{ role.title }}
                    </option>
                </select-text>
            </template>
            <template #footer>
                <btn-create icon="fa-save" type="submit" :disabled="loading" title="تعديل" />
            </template>
        </Modal>
    </form>
</template>


<script>
import { ref, computed, watch, onMounted } from "vue";
import VText from "../../components/inputs/VInput.vue";
import SelectText from "../../components/inputs/VSelect.vue";
import Modal from "../../components/modals/ModalDialog.vue";
import { useSingleUsers } from '../../stores/users/single';

export default {
    name: "EditUser",
    components: { VText, SelectText, Modal },
    setup() {
        let thisModal = ref(null);
        const single = useSingleUsers();
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
