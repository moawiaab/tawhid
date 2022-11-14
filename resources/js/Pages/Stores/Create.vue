<template>
    <div class="">
        <btn-create @click="showModal" />
        <form @submit.prevent="submitForm">
            <Modal title="إضافة مخزن جديد" ref="thisModal" maxWidth="lg">
                <template #body>
                    <v-text v-model="single.entry.name" type="text" title="اسم المخزن" :error="single.errors.name" />
                    <v-text-area v-model="single.entry.details" type="text" title="التفاصيل المخزن"
                        :error="single.errors.details" />

                    <div class="row mb-3 ">
                        <label class="col-sm-3  col-form-label"> المنتجات</label>
                        <div class="col-sm-9">

                            <Multiselect v-model="single.entry.products" :options="single.lists.products" mode="tags"
                                :close-on-select="false" :searchable="true" />
                        </div>
                    </div>
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
import Multiselect from '@vueform/multiselect'
import VTextArea from "../../components/inputs/VTextArea.vue";
import Modal from "../../components/modals/ModalDialog.vue";
import { useSingleStores } from '../../stores/Stores/single';

export default {
    name: "CreateStore",
    components: { VText, Multiselect, Modal, VTextArea },
    setup() {
        let thisModal = ref(null);
        const single = useSingleStores();
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
