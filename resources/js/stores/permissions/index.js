import axios from "axios";
import { defineStore } from "pinia";
import { useSinglePermissions } from "./single";
import { useSetting } from "../settings/SettingIndex";

const route = "permissions";
export const usePermissions = defineStore("index-permissions", {
    state: () => ({
        theme: useSetting().theme,
        permissions: [],
        total: 0,
        page: 1,
        query: {
            sortBy: "id",
            sortType: "desc",
            rowsPerPage: 20,
            page: 1,
        },
        loading: false,
        filters: { s: "" },
    }),
    getters: {
        // items: (state) => state.permissions,
        // totalItem: (state) => state.total,
    },
    actions: {
        fetchIndexData() {
            this.loading = true;
            return new Promise(async (resolve, reject) => {
                await axios
                    .get(route, { params: { ...this.filters, ...this.query } })
                    .then((response) => {
                        this.permissions = response.data.data;
                        this.total = response.data.meta.total;
                        this.page = response.data.meta.current_page;
                    })
                    .catch((error) => {})
                    .finally(() => {
                        this.loading = false;
                    });
            });
        },
        setQuery(q) {
            this.query = q;
        },
        setFilters(q) {
            this.filters = q;
        },
        editItem(item) {
            const permissions = useSinglePermissions();
            permissions.showModalEdit = true;
            permissions.fetchEditData(item.id);
        },
        showItem(item) {
            const permissions = useSinglePermissions();
            permissions.showModalShow = true;
            permissions.fetchShowData(item.id);
        },

        deleteItem(item) {
            // Swal.fire({
            //     title: "هل تريد الحذف بالفعل",
            //     icon: "error",
            //     position: "center",
            //     showCancelButton: true,
            //     cancelButtonText: ` إلغاء الأمر`,
            //     confirmButtonText: `تأكيد الحذف`,
            //     confirmButtonColor: "#dd4b39",
            //     showConfirmButton: true,
            //     toast: false,
            // }).then((result) => {
            //     if (result.value) {
            //         axios
            //             .delete(`${route}/${item.id}`)
            //             .then((response) => {
            //                 this.fetchIndexData();
            //             })
            //             .catch((error) => {});
            //     }
            // });
        },
    },
});
