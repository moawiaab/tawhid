<template>
    <v-dialog v-model="model.showModalEdit" persistent max-width="500" scrollable>
        <v-form @submit.prevent="submitForm" ref="form">
            <v-card>
                <v-card-title class="text-h5 text-primary">
                    تعديل بيانات القسم
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <v-text-field clearable label="اسم المنتج" variant="underlined" hint="هنا اسم المنتج "
                        v-model="single.entry.name" :rules="rules.required" :error-messages="single.errors.name"
                        required color="primary" />
                    <v-text-field clearable label="التفاصيل" variant="underlined" hint="هنا التفاصيل المنتج "
                        v-model="single.entry.details" :rules="rules.required" :error-messages="single.errors.details"
                        required color="primary" />

                    <v-select v-model="single.entry.category_id" clearable label="قسم المنتج" :items="single.lists.categories"
                        variant="underlined" item-title="name" item-value="id">
                    </v-select>

                    <v-radio-group label=" حالة المنتج" v-model="single.entry.status" v-if="!single.entry.status">
                        <v-radio label=" منتج خاص" :value="0"></v-radio>
                        <v-radio label=" منتج عام" :value="1"></v-radio>
                    </v-radio-group>

                </v-card-text>

                <v-divider />
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red-darken-1" prepend-icon="mdi-close" variant="tonal"
                        @click="model.showModalEdit = false">
                        إلغاء الأمر
                    </v-btn>
                    <btn-save :loading="single.loading" />
                </v-card-actions>
            </v-card>
        </v-form>
    </v-dialog>
</template>


<script lang="ts">
import { useSingleProducts } from '../../stores/Products/single';
import { useSettingAlert } from '../../stores/settings/SettingAlert';
import { useSinglePage } from '../../stores/pages/pageSingle';
import { watch } from '@vue/runtime-core';

export default {
    name: "EditUser",
    setup() {
        const single = useSingleProducts();
        const model = useSinglePage()
        watch(model, (e) => {
            if (e.showModalEdit) {
                single.setupEntry(model.entry, model.lists)
            }
        })
        const submitForm = () => single.updateData().then(() => {
            if (validation()) {
                single.updateData().then(() => {
                    model.showModalEdit = false;
                    single.$reset();
                    model.entry = {}
                })
            } else {
                useSettingAlert().setAlert("لا تترك حقل فارغ لو سمحت", 'warning', true)
            }
        })

        const rules = {
            required: [
                (val: any) =>
                    (val || "").length > 0 ||
                    "لا تترك هذا الحقل فارغاً لو سمحت",
            ],
        };

        const validation = () => {
            return (single.entry.name && single.entry.details)
        }

        return {
            single,
            submitForm,
            rules,
            model
        }
    },

}
</script>
