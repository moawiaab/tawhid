import axios from "axios";
import { defineStore } from "pinia";
import { useToast } from "vue-toastification";
import { useSingleUsers } from "./single";
import Swal from "sweetalert2";

const route = "users";
const toast = useToast();
export const useUsers = defineStore("index-users", {
    state: () => ({
        users: [],
        total: 0,
        page: 1,
        query: {
            sortBy: "id",
            sortType: "desc",
            rowsPerPage: 20,
            page: 1,
        },
        filter: { s: "" },
        loading: false,
        errors: null,
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
                    .get(route, { params: { ...this.filter, ...this.query } })
                    .then((response) => {
                        this.users = response.data.data;
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
        setFilter(q: any) {
            this.filter = q;
        },
        editItem(item: any) {
            const users = useSingleUsers();
            users.showModalEdit = true;
            users.fetchEditData(item.id);
        },
        showItem(item: any) {
            const users = useSingleUsers();
            users.showModalShow = true;
            users.fetchShowData(item.id);
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

        lockItem(item: any) {
            Swal.fire({
                confirmButtonText: ` تغيرالحالة`,
                cancelButtonText: ` إلغاء الأمر`,
                title: "هل تريد تغيير الحالة بالفعل",
                text: "يتم تغير الحالة من الفتح الى الإغلاق والعكس",
                icon: "question",
                position: "center",
                showCancelButton: true,
                confirmButtonColor: "rgb(21, 99, 221)",
                showConfirmButton: true,
                toast: false,
            }).then((result) => {
                if (result.value) {
                    axios
                        .put(`${route}/${item.id}/toggle`)
                        .then((response) => {
                            this.fetchIndexData();
                        })
                        .catch((error) => {
                            this.errors =
                                error.response.data.errors || this.errors;
                            toast.error(error.response.data.message, {
                                timeout: 5000,
                            });
                            // reject(error);
                        });
                }
            });
        },
    },
});
