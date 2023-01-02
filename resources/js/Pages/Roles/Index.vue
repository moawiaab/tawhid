<template>
<div class="">
        <Loader v-if="roles.loading" />
    <header-title title="الصلاحيات">
        <create-role />
    </header-title>
    <div>
        <v-row align="center" no-gutters>
            <v-col>
                <search-filter :query="filters" />
            </v-col>
            <v-col class="text-left">
                <v-chip
                    color="blue"
                    size="small"
                    label
                    class="ma-2"
                    prepend-icon="mdi-filter-cog-outline"
                    @click="openItem"
                >
                    بحث متقدم
                </v-chip>
                <v-chip
                    size="small"
                    color="green"
                    label
                    class="ma-2"
                    prepend-icon="mdi-refresh"
                    @click.prevent="roles.fetchIndexData()"
                >
                    تحديث البيانات
                    <template v-slot:append> </template>
                </v-chip>
                <v-chip
                    size="small"
                    color="red"
                    label
                    class="ma-2"
                    prepend-icon="mdi-database-refresh-outline"
                    @click="headerItem.removeAllItem"
                >
                    إعادة الضبط
                </v-chip>
                <!-- mdiDatabaseRefreshOutline -->
                <v-menu :close-on-content-click="false">
                    <template v-slot:activator="{ props }">
                        <v-chip
                            size="small"
                            color="gary"
                            class="ma-2"
                            prepend-icon="mdi-dots-vertical"
                            v-bind="props"
                            label
                        >
                            إعدادات
                        </v-chip>
                    </template>
                    <v-list>
                        <v-list-item-title class="mx-4 text-blue"
                            >الأعمدة المعروضة</v-list-item-title
                        >
                        <v-list-item
                            v-for="(i, index) in headerItem.headerTable"
                            :key="index"
                            prepend-icon="mdi-check"
                        >
                            <v-list-item-title @click="headerItem.addItem(i)">
                                {{ i.text }}</v-list-item-title
                            >
                        </v-list-item>
                        <v-divider />
                        <v-list-item-title class="mx-4 text-red"
                            >الأعمدة الغير معروضة</v-list-item-title
                        >
                        <v-list-item
                            v-for="({ text }, index) in headerItem.menuItem"
                            :key="index"
                            prepend-icon="mdi-close"
                        >
                            <v-list-item-title
                                @click="headerItem.removeItem(index)"
                            >
                                {{ text }}</v-list-item-title
                            >
                        </v-list-item>
                    </v-list>
                </v-menu>
            </v-col>
        </v-row>
    </div>
    <v-expansion-panels v-model="filtersItem">
        <v-expansion-panel value="filtersItem">
            <v-expansion-panel-text>
                <v-row no-gutters>
                    <v-col>
                        <v-radio-group inline v-model="filters.trashed">
                            <v-radio
                                label="عرض البيانات الغير محذوفة"
                                value=""
                                color="info"
                            ></v-radio>
                            <v-radio
                                label="عرض البيانات المحذوف فقط"
                                value="only"
                                color="info"
                            ></v-radio>
                            <v-radio
                                label="عرض جميع البيانات معاً"
                                value="with"
                                color="info"
                            ></v-radio>
                        </v-radio-group>
                    </v-col>
                </v-row>
            </v-expansion-panel-text>
        </v-expansion-panel>
    </v-expansion-panels>
    <data-table
        :server-items-length="roles.total"
        buttons-pagination
        v-model:server-options="query"
        :headers="headerItem.headerTable"
        :items="roles.roles"
        body-text-direction="right"
        :table-class-name="
            theme.theme == 'light' ? 'customize-table' : 'customize-table-small'
        "
        theme-color="#551a8b"
        :table-height="500"
        :loading="roles.loading"
        alternating
        border-cell
        v-model:items-selected="itemsSelected"
        :body-row-class-name="bodyRowClassNameFunction"
    >
        <template #loading />
        <template #item-permissions="item">
            {{ item.permissions.length }}
        </template>
        <template #item-users="item">
            {{ item.users.length }}
        </template>
        <template #expand="item">
            <splitpanes class="default-theme" style="height:100%" :rtl="true">
                <pane>
                    <v-list-item-title
                        >الأذونات لهذه الصلاحية</v-list-item-title
                    >
                    <v-chip
                        color="red"
                        class="ma-1"
                        v-for="{ id, details } in item.permissions"
                        :key="id"
                        size="small"
                        prepend-icon="mdi-link-lock"
                    >
                        {{ details }}
                    </v-chip>
                </pane>
                <v-divider vertical />
                <pane>
                    <v-list-item-title
                        >المستخدمين لهذه الصلاحية</v-list-item-title
                    >
                    <v-chip
                        color="primary"
                        class="ma-1"
                        v-for="{ id, name } in item.users"
                        :key="id"
                        size="small"
                        prepend-icon="mdi-account-circle-outline"
                        >{{ name }}

                    </v-chip>
                </pane>
            </splitpanes>
        </template>
        <template #header-operation>
            <div class="delete-all-items">
                <!-- <import-menu url="roles" /> -->
                <v-spacer />
                <export-menu url="roles" :data="roles.roles" />
                <v-icon
                    icon="mdi-delete-sweep-outline"
                    color="red"
                    @click="roles.showDeletedMethod('delete')"
                    v-if="can('role_delete', 'all')"
                />
            </div>
        </template>
        <template #item-operation="item">
            <div class="operation-wrapper text-left">
                <v-toolbar-title></v-toolbar-title>
                <show-icon role="role" />
                <edit-icon
                    @click="roles.editItem(item)"
                    role="role"
                    v-if="!item.deleted_at"
                />
                <delete-icon
                    @click="roles.showDeletedMethod(item.id)"
                    role="role"
                />
                <delete-icon
                    @click="roles.restoreItem(item.id)"
                    role="role"
                    v-if="item.deleted_at"
                    :resat="true"
                />
            </div>
        </template>
    </data-table>

    <delete-item title="هل تريد الحذف" v-model="roles.showDeleted">
        <template #content>
            <span v-if="roles.itemId == 'delete'">
                هل تريد حذف جميع البيانات المختارة
                <v-chip
                    v-for="(item, index) in itemsSelected"
                    :text="item.title"
                    class="ma-1"
                    :key="index"
                />
            </span>
            <span v-else>هل تريد الحذف بالفعل ستفقد البيانات </span>
        </template>
        <template #footer>
            <v-btn
                color="blue-darken-1"
                prepend-icon="mdi-trash-can"
                variant="tonal"
                @click="roles.deleteAllItem(itemsSelected)"
                v-if="roles.itemId == 'delete'"
            >
                حذف الجميع
            </v-btn>
            <v-btn
                color="blue-darken-1"
                prepend-icon="mdi-trash-can"
                variant="tonal"
                @click="roles.deleteItem()"
                v-else
            >
                تأكيد الحذف
            </v-btn>
            <v-btn
                color="red-darken-1"
                prepend-icon="mdi-close"
                variant="tonal"
                @click="roles.showDeleted = false"
            >
                إلغاء الأمر
            </v-btn>
        </template>
    </delete-item>
    <edit-role />
    <PrintList
        title="الصلاحيات"
        :header="headerItem.headerTable"
        :items="roles.roles"
    />
</div>
</template>
<script lang="ts">
import { ref, watch, onMounted } from "@vue/runtime-core";
import { useAbility } from "@casl/vue";
import { useRoles } from "../../stores/roles/roles";
import { useSettingsHeaderTable } from "../../stores/settings/SettingHeaderTable";
import type {
    Header,
    ServerOptions,
    Item,
    BodyRowClassNameFunction,
} from "vue3-easy-data-table";
import EditRole from "./Edit.vue";
import CreateRole from "./Create.vue";
import { useSetting } from "../../stores/settings/SettingIndex";
import HeaderTitle from "../../components/HeaderTitle.vue";
import SearchFilter from "../../components/SearchFilter.vue";
import PrintList from "../../components/PrintList.vue";
import { Splitpanes, Pane } from "splitpanes";
export default {
    name: "RolesIndex",
    components: {
        EditRole,
        CreateRole,
        HeaderTitle,
        SearchFilter,
        PrintList,
        Splitpanes,
        Pane,
    },
    setup() {
        const { can } = useAbility();
        const theme = useSetting();
        const roles = useRoles();
        const query = ref<ServerOptions>({
            sortBy: "id",
            sortType: "desc",
            rowsPerPage: 20,
            page: 1,
        });
        const filters = ref({ s: "", trashed: "" });
        const filtersItem = ref("");
        const openMenu = ref(false);
        const headerItem = useSettingsHeaderTable();
        const itemsSelected = ref<Item[]>([]);
        roles.fetchIndexData();
        const headers: Header[] = [
            {
                text: "اسم الصلاحية",
                value: "title",
                width: 200,
                sortable: true,
            },
            { text: "عدد الصلاحيات", value: "permissions", width: 200 },
            { text: "عدد المستخدمين", value: "users", width: 200 },
            { text: "تاريخ الإنشاء", value: "created_at", sortable: true }, //
            { text: "إعدادات", value: "operation", width: 100 },
        ];
        const bodyRowClassNameFunction: BodyRowClassNameFunction = (
            item: Item,
            index: number
        ): string => {
            if (item.deleted_at) return "delete-fail-row";
            return "";
        };
        headerItem.setHeaderItems(headers, "roles");

        const openItem = () => {
            if (filtersItem.value) {
                filtersItem.value = "";
            } else {
                filtersItem.value = "filtersItem";
            }
        };

        watch(
            filters,
            (q) => {
                roles.setFilters(q);
                roles.fetchIndexData();
            },
            { deep: true }
        );

        watch(
            query,
            (q) => {
                roles.setQuery(q);
                roles.fetchIndexData();
            },
            { deep: true }
        );
        return {
            can,
            theme,
            headerItem,
            roles,
            query,
            filters,
            openItem,
            filtersItem,
            openMenu,
            itemsSelected,
            bodyRowClassNameFunction,
        };
    },
};
</script>

<style>
/* .text-left-col {} */
</style>
