<template>
    <v-btn variant="text" @click="thisModal = !thisModal"> إضافة صلاحية </v-btn>
    <v-dialog v-model="thisModal" persistent max-width="1200" scrollable>
        <v-form @submit.prevent="submitForm" ref="form">
            <v-card>
                <v-card-title class="text-h5">
                    إضافة صلاحية جديدة
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <v-text-field  label="اسم الصلاحية"  hint="هنا اسم الصلاحية "
                        v-model="single.entry.title" :rules="rules.required" :error-messages="single.errors.title"
                        required />
                    <v-autocomplete v-model="single.entry.permissions" :items="single.lists.permissions" clearable
                        variant="solo" chips closable-chips color="blue-grey-lighten-2" label="الصلاحيات"
                        item-title="label" item-value="value" multiple>
                        <template v-slot:chip="{ props, item }">
                            <v-chip v-bind="props" :text="item.raw.label"></v-chip>
                        </template>
                        <template v-slot:item="{ props, item }">
                            <v-list-item v-if="typeof item.raw !== 'object'" v-bind="props"></v-list-item>
                            <v-list-item v-else v-bind="props" :title="item.raw.label">
                            </v-list-item>
                        </template>
                    </v-autocomplete>

                </v-card-text>

                <v-divider />
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red-darken-1" prepend-icon="mdi-close" variant="tonal" @click="thisModal = false">
                        إلغاء الأمر
                    </v-btn>
                    <btn-save :loading="single.loading" />
                </v-card-actions>
            </v-card>
        </v-form>
    </v-dialog>
</template>

<script lang="ts">
import { ref, watch } from "vue";
import { useSingleRoles } from '../../stores/roles/single';
import { useSettingAlert } from '../../stores/settings/SettingAlert';

export default {
    name: "CreateRole",
    setup() {
        let thisModal = ref(false);
        const single = useSingleRoles();
        const rules = {
            required: [
                (val: any) =>
                    (val || "").length > 0 ||
                    "لا تترك هذا الحقل فارغاً لو سمحت",
            ],
        };
        const submitForm = () => {
            if (validation()) {
                single.storeData().then(() => {
                    thisModal.value = false;
                    single.$reset();
                })
            } else {
                useSettingAlert().setAlert("لا تترك حقل فارغ لو سمحت", 'warning', true)
            }
        }

        watch(thisModal, (e) => {
            single.$reset();
            single.fetchCreateData()
        })
        const validation = () => {
            return (single.entry.title && single.entry.permissions)
        }
        return {
            thisModal,
            single,
            submitForm,
            rules
        }
    },

}
</script>
