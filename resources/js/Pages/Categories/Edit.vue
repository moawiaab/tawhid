<template>
    <form @submit.prevent="submitForm">
        <Modal title=" تعديل قسم المنتج " ref="thisModal">
            <template #body>
                <v-text v-model="single.entry.name" type="text" title="اسم القسم" :error="single.errors.name" />
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
                <btn-create icon="fa-save" type="submit" :disabled="loading" title="تعديل" />
            </template>
        </Modal>
    </form>
</template>


<script>
import { ref, computed, watch, onMounted } from "vue";
import VText from "../../components/inputs/VInput.vue";
import VTextArea from "../../components/inputs/VTextArea.vue";
import Modal from "../../components/modals/ModalDialog.vue";
import { useSingleCategories } from '../../stores/Categories/single';

export default {
    name: "EditCategory",
    components: { VText, VTextArea, Modal },
    setup() {
        let thisModal = ref(null);
        const single = useSingleCategories();
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
