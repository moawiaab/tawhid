import axios from "axios";
import { defineStore } from "pinia";
import Swal from "sweetalert2";
import { useToast } from "vue-toastification";
import { useSingleRoles } from "./single";

const toast = useToast();
const route = "roles";
export const useRoles = defineStore("roles", {
    state: () => ({
        roles: [],
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
        // items: (state) => state.users,
        // totalItem: (state) => state.total,
    },
    actions: {
        fetchIndexData() {
            this.loading = true;
            return new Promise(async (resolve, reject) => {
                await axios
                    .get(route, { params: { ...this.filters, ...this.query } })
                    .then((response) => {
                        this.roles = response.data.data;
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
        setFilters(q: any) {
            this.filters = q;
        },
        editItem(item: any) {
            const roles = useSingleRoles();
            roles.showModalEdit = true;
            roles.fetchEditData(item.id);
        },
        showItem(item: any) {
            const roles = useSingleRoles();
            roles.showModalShow = true;
            roles.fetchShowData(item.id);
        },
        deleteItem(item: any) {
            Swal.fire({
                title: "حذف الصلاحية",
                text: "هل تريد حذف هذه الصلاحية بالفعل",
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
