<template>
    <div class="">
        <btn-create @click="showModal" />
        <form @submit.prevent="submitForm">
            <Modal title="إضافة قسم منتج جديد" ref="thisModal">
                <template #body>
                    <v-text v-model="single.entry.name" type="text" title="اسم القسم"
                        :error="single.errors.name" />
                    <v-text-area v-model="single.entry.details" type="text" title="التفاصيل"
                        :error="single.errors.details" />

                    <div class="row mb-3 ">
                        <label class="col-sm-3  col-form-label"> حالة القسم</label>
                        <div class="col-sm-9">

                            <div class="fancy-radio m-0 mb-2">
                                <label>
                                    <input value="0" type="radio" v-model="single.entry.status">
                                    <span><i></i> قسم خاص</span>
                                </label>
                            </div>

                            <div class="fancy-radio m-0 mb-2">
                                <label>
                                    <input value="1" type="radio" v-model="single.entry.status">
                                    <span><i></i> قسم عام</span>
                                </label>
                            </div>
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
import VTextArea from "../../components/inputs/VTextArea.vue";
import Modal from "../../components/modals/ModalDialog.vue";
import { useSingleCategories } from '../../stores/Categories/single';

export default {
    name: "CreateCategory",
    components: { VText,Modal,VTextArea },
    setup() {
        let thisModal = ref(null);
        const single = useSingleCategories();
        const showModal = () => {
            single.$reset();
            // single.fetchCreateData()
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
