<template>
    <div class="">
        <btn-create @click="showModal" />
        <form @submit.prevent="submitForm">
            <Modal title="إضافة مستخدم جديد" ref="thisModal" maxWidth="lg">
                <template #body>
                    <v-text name="name" v-model="single.entry.name" type="text" title="الاسم بالكامل"
                        :error="single.errors.name" />
                    <v-text name="email" v-model="single.entry.email" type="email" title="البريد الالكتروني"
                        :error="single.errors.email" />
                    <v-text name="phone" v-model="single.entry.phone" type="phone" title=" رقم الهاتف"
                        :error="single.errors.phone" />
                    <v-text name="password" v-model="single.entry.password" type="password" title="كلمة المرور"
                        :error="single.errors.password" />
                    <v-text name="password_confirmation" v-model="single.entry.password_confirmation" type="password"
                        title="تأكيد كلمة المرور" />
                    <select-text name="role_id" v-model="single.entry.role_id" title="الصلاحية"
                        :error="single.errors.role_id">
                        <option v-for="role in single.lists.roles" :key="role.id" :value="role.id"> {{ role.title }}
                        </option>
                    </select-text>
                </template>
                <template #footer>
                    <btn-create icon="fa-save" type="submit" :disabled="single.loading" />
                </template>
            </Modal>
        </form>
    </div>
</template>

<script>
import { ref, computed } from "vue";
import VText from "../../components/inputs/VInput.vue";
import SelectText from "../../components/inputs/VSelect.vue";
import Modal from "../../components/modals/ModalDialog.vue";
import { useSingleUsers } from '../../stores/users/single';

export default {
    name: "CreateUser",
    components: { VText, SelectText, Modal },
    setup() {
        let thisModal = ref(null);
        const single = useSingleUsers();
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
