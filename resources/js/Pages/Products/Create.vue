<template>
    <div class="">
        <btn-create @click="showModal" />
        <form @submit.prevent="submitForm">
            <Modal title="إضافة منتج جديد" ref="thisModal">
                <template #body>
                    <v-text v-model="single.entry.name" type="text" title="اسم المنتج" :error="single.errors.name" />
                    <v-text-area v-model="single.entry.details" type="text" title="التفاصيل"
                        :error="single.errors.details" />

                    <select-text name="category_id" v-model="single.entry.category_id" title="الأقسام"
                        :error="single.errors.category_id">
                        <option v-for="cat in single.lists.category" :key="cat.id" :value="cat.id"> {{ cat.name }}
                        </option>
                    </select-text>
                    <div class="row mb-3 ">
                        <label class="col-sm-3  col-form-label"> حالة المنتج</label>
                        <div class="col-sm-9">

                            <div class="fancy-radio m-0 mb-2">
                                <label>
                                    <input value="0" type="radio" v-model="single.entry.status">
                                    <span><i></i> منتج خاص</span>
                                </label>
                            </div>

                            <div class="fancy-radio m-0 mb-2">
                                <label>
                                    <input value="1" type="radio" v-model="single.entry.status">
                                    <span><i></i> منتج عام</span>
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
import SelectText from "../../components/inputs/VSelect.vue";
import VTextArea from "../../components/inputs/VTextArea.vue";
import Modal from "../../components/modals/ModalDialog.vue";
import { useSingleProducts } from '../../stores/Products/single';

export default {
    name: "CreateProduct",
    components: { VText, SelectText, Modal,VTextArea },
    setup() {
        let thisModal = ref(null);
        const single = useSingleProducts();
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
