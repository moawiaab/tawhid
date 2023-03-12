<template>
    <main-page :headers="headers" role="user" title="المستخدمين">
        <template #create>
            <v-btn variant="text" @click="model.showModalCreate = true">
                إضافة</v-btn
            >
            <create-user v-if="model.showModalCreate" />
        </template>

        <template #table-operation="{ item }">
            <edit-icon
                @click="showPhote(item.id)"
                role="user"
                icon="mdi-image-edit-outline"
            />
        </template>
        <edit-user />
        <show-user />

        <v-dialog v-model="showModel" width="500" :persistent="loading">
            <v-card>
                <v-card-title>تحميل صورة للمنتج</v-card-title>
                <v-card-text>
                    <Image :id="myId" v-model="files" :loading="loading" />
                </v-card-text>
                <v-card-actions v-if="files">
                    <v-btn
                        class="mx-10"
                        variant="tonal"
                        prepend-icon="mdi-upload-network"
                        color="success"
                        @click.stop="uploadImage"
                        :disabled="loading"
                        >تحميل الصورة</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </main-page>
</template>

<script lang="ts" setup>
import Image from "../../components/media/UploadIamge.vue";
import CreateUser from "./Create.vue";
import EditUser from "./Edit.vue";
import ShowUser from "./Show.vue";
import { usePageIndex } from "../../stores/pages/pageIndex";
import { useSinglePage } from "../../stores/pages/pageSingle";
import { ref } from "vue";
import axios from "axios";

const myId = ref<Number | null | String>(null);
const loading = ref(false);
const files = ref();
const showModel = ref(false);

const pages = usePageIndex();
const model = useSinglePage();
pages.$reset();
pages.setup("users");
const headers: import("vue3-easy-data-table").Header[] = [
    { text: "اسم المستخدم", value: "name", width: 200, sortable: true },
    { text: "البريد", value: "email", width: 200 },
    { text: "رقم الهاتف", value: "phone", sortable: true },
    { text: "الصلاحية", value: "role", sortable: true },
    { text: "الفرع", value: "account" },
    { text: "تاريخ الإنشاء", value: "created_at", sortable: true }, //
    { text: "إعدادات", value: "operation", width: 150 },
];

const showPhote = (id: Number) => {
    showModel.value = !showModel.value;
    myId.value = id;
};
const uploadImage = () => {
    return new Promise(async (resolve, reject) => {
        loading.value = true;
        const formData = new FormData();
        formData.append("id", myId.value);
        formData.append("file", files.value);
        formData.append("model_id", myId.value);
        formData.append("collection_name", "userPhoto");
        await axios
            .post(`/users/media`, formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                // alert.value = true;
                pages.fetchIndexData();
                showModel.value = false;
            });
        loading.value = false;
    });
};
</script>
