<template>
    <Loader v-if="permission.loading" />
    <header-title title="الأذونات">
        <create-permission />
    </header-title>
    <div>
        <v-row align="center" no-gutters>
            <v-col>
                <search-filter :query="filters" />
            </v-col>
            <v-col class="text-left">
                <v-chip color="blue" class="mx-2" prepend-icon="mdi-filter-cog-outline" @click="openItem">
                    بحث متقدم
                </v-chip>
                <v-chip color="green" class="mr-2" prepend-icon="mdi-refresh"
                    @click.prevent="permission.fetchIndexData();">
                    تحديث البيانات
                    <template v-slot:append>
                    </template>
                </v-chip>
            </v-col>
        </v-row>
    </div>
    <v-expansion-panels v-model="filtersItem">
        <v-expansion-panel value="filtersItem">
            <v-expansion-panel-text>
                <v-container class="bg-surface-variant">
                    <v-row no-gutters>
                        <v-col v-for="n in 3" :key="n" cols="12" sm="4">
                            <v-sheet class="ma-2 pa-2">
                                One of three columns
                            </v-sheet>
                        </v-col>
                    </v-row>
                </v-container>
            </v-expansion-panel-text>
        </v-expansion-panel>
    </v-expansion-panels>

    <data-table :server-items-length="permission.total" buttons-pagination v-model:server-options="query"
        :headers="headers" :items="permission.permissions" body-text-direction="right"
        :table-class-name="theme.theme == 'light' ? 'customize-table' : 'customize-table-small'" theme-color="#551a8b"
        :table-height="550" :loading="permission.loading" alternating border-cell>
        <template #loading />
        <template #item-operation="item">
            <div class="operation-wrapper text-left">
                <v-icon icon="mdi-pencil-outline" @click="permission.editItem(item)" color="green" class="mx-1" />
                <v-icon icon="mdi-trash-can" @click="permission.deleteItem(item)" color="error" title="حذف الإذن"
                    class="mx-1" />
            </div>
        </template>
    </data-table>
    <edit-permission />

</template>
<script lang="ts">
import { ref, watch } from '@vue/runtime-core';
import { usePermissions } from '../../stores/permissions';
import type { Header, ServerOptions } from "vue3-easy-data-table";
import EditPermission from "./Edit.vue";
import CreatePermission from "./Create.vue";
import { useSetting } from '../../stores/settings/SettingIndex';
import HeaderTitle from '../../components/HeaderTitle.vue';
import SearchFilter from '../../components/SearchFilter.vue';
export default {
    components: { EditPermission, CreatePermission, HeaderTitle, SearchFilter },
    setup() {
        const theme = useSetting();
        const headers: Header[] = [
            { text: "اسم الصلاحية", value: "details", width: 200, },
            { text: "ربط الصلاحية", value: "title", width: 200 },
            { text: "تاريخ الإنشاء", value: "created_at", sortable: true },//
            { text: "ربط الصلاحية", value: "title", width: 200 },
            { text: "", value: "operation", width: 100 },
        ];
        const permission = usePermissions()
        const query = ref<ServerOptions>({ sortBy: 'id', sortType: 'desc', rowsPerPage: 20, page: 1 })
        permission.fetchIndexData();
        const filters = ref({ s: '' })
        const filtersItem = ref('')
        const openItem = () => {
            // filtersItem.value = !filtersItem.valueI
            if (filtersItem.value) {
                filtersItem.value = "";
            } else {
                filtersItem.value = "filtersItem";
            }
        }

        watch(filters, (q) => {
            permission.setFilters(q);
            permission.fetchIndexData();
        }, { deep: true });

        watch(query, (q) => {
            permission.setQuery(q);
            permission.fetchIndexData();
        }, { deep: true });
        return { theme, headers, permission, query, filters, openItem, filtersItem }
    }
}
</script>

<style>
/* .text-left-col {} */
</style>
