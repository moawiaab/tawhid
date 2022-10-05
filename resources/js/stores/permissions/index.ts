import axios from "axios";
import { defineStore } from "pinia";
import { useToast } from "vue-toastification";
import { useSinglePermissions } from "./single";
import Swal from "sweetalert2";

const route = "permissions";
const toast = useToast();
export const usePermissions = defineStore("index-permissions", {
    state: () => ({
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
                    .get(route, { params: this.query })
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
        setQuery(q: any) {
            this.query = q;
        },
        editItem(item: any) {
            const permissions = useSinglePermissions();
            permissions.showModalEdit = true;
            permissions.fetchEditData(item.id);
        },
        showItem(item: any) {
            const permissions = useSinglePermissions();
            permissions.showModalShow = true;
            permissions.fetchShowData(item.id);
        },

        deleteItem(item: any) {
            Swal.fire({
                title: "هل تريد الحذف بالفعل",
                icon: "error",
                position: "center",
                showCancelButton: true,
                cancelButtonText: ` إلغاء الأمر`,
                confirmButtonText: `تأكيد الحذف`,
                confirmButtonColor: "#dd4b39",
                showConfirmButton: true,
                toast: false,
            }).then((result) => {
                if (result.value) {
                    axios
                        .delete(`${route}/${item.id}`)
                        .then((response) => {
                            this.fetchIndexData();
                        })
                        .catch((error) => {});
                }
            });
        },
    },
});
