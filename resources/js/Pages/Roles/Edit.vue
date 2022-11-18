<template>
    <v-dialog v-model="single.showModalEdit" persistent max-width="1200" scrollable>
        <v-form @submit.prevent="submitForm" ref="form">
            <v-card>
                <v-card-title class="text-h5">
                    إضافة صلاحية دخول جديدة
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <v-text-field clearable label="اسم الصلاحية" variant="outlined" hint="هنا اسم الصلاحية "
                        v-model="single.entry.title" :rules="rules.required" :error-messages="single.errors.title"
                        required />
                    <v-autocomplete v-model="single.entry.permissions" :items="single.lists.permissions" clearable
                        variant="underlined" chips closable-chips color="blue-grey-lighten-2" label="الصلاحيات"
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
                    <v-btn color="red-darken-1" prepend-icon="mdi-close" variant="tonal" @click="single.showModalEdit = false">
                        إلغاء الأمر
                    </v-btn>
                    <btn-save :loading="single.loading" />
                </v-card-actions>
            </v-card>
        </v-form>
    </v-dialog>
</template>

<script lang="ts">
import { ref, computed, watch } from "vue";
import { useSingleRoles } from '../../stores/roles/single';
import { useSettingAlert } from '../../stores/settings/SettingAlert';

export default {
    name: "EditRole",
    setup() {
        const single = useSingleRoles();
        const submitForm = () => single.updateData().then(() => {
            if (validation()) {
                single.updateData().then(() => {
                    single.showModalEdit = false;
                    single.$reset();
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
            return (single.entry.title && single.entry.permissions)
        }

        return {
            single,
            submitForm,
            rules

        }
    },
}
</script>
