<template>
    <v-list-item-title @click="showModal" > إضافة إذن جديد</v-list-item-title>
    <form @submit.prevent="submitForm">
        <!-- <Modal title="إضافة مستخدم جديد" ref="thisModal">

            <template #body>
                <v-text v-model="single.entry.details" title=" اسم الصلاحية" :error="single.errors.details" />
                <v-text v-model="single.entry.title" title="الرابط" :error="single.errors.title" />
                <div class="row">
                    <div class="col-sm-6">
                        <h5> اسم الصلاحية</h5>
                        <ul class="list-group">
                            <li class="list-group-item" v-for="i in single.details" :key="i">{{i +
                            single.entry.details}}</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <h5>رابط الصلاحية</h5>
                        <ul class="list-group">
                            <li class="list-group-item" v-for="i in single.title" :key="i">{{single.entry.title + i}}
                            </li>
                        </ul>
                    </div>
                </div>
            </template>
            <template #footer>
                <btn-create icon="fa-save" type="submit" :disabled="single.loading" />
            </template>
        </Modal> -->
    </form>
</template>

<script>
import { ref, computed } from "vue";
import { useSinglePermissions } from '../../stores/permissions/single';

export default {
    name: "CreatePermission",
    // components: { VText, Modal },
    setup() {
        let thisModal = ref(null);
        const single = useSinglePermissions();
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
