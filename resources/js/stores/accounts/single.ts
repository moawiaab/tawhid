import axios from "axios";
import { defineStore } from "pinia";
import { useToast } from "vue-toastification";
import { useAccounts } from ".";
const toast = useToast();
const route = "accounts";
export const useSingleAccounts = defineStore("single-accounts", {
    state: () => ({
        entry: {
            id: null,
            name: "",
            email: "",
            password: "",
            role_id: null,
            phone: "",
        },
        lists: {
            roles: [],
        },
        loading: false,
        errors: {
            id: null,
            name: null,
            email: null,
            password: null,
            role_id: null,
            phone: null,
        },
        showModalEdit: false,
        showModalShow: false,
    }),
    getters: {
        hasErrors: (state) => state.errors,
        // totalItem: (state) => state.total,
    },
    actions: {
        // send data to server in created
        storeData() {
            const accountIndex = useAccounts();
            this.loading = true;
            return new Promise(async (resolve, reject) => {
                await axios
                    .post(route, this.entry)
                    .then((response) => {
                        toast.success("تم إضافة الحساب بنجاح");
                        accountIndex.fetchIndexData();
                        resolve(response);
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors || this.errors;
                        toast.error(error.response.data.message, {
                            timeout: 5000,
                        });
                        reject(error);
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            });
        },
        // send data to server in updated
        updateData() {
            this.loading = true;
            const accountIndex = useAccounts();
            return new Promise(async (resolve, reject) => {
                await axios
                    .put(`${route}/${this.entry.id}`, this.entry)
                    .then((response) => {
                        toast.success("تم تعديل الحساب بنجاح");
                        accountIndex.fetchIndexData();
                        resolve(response);
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors || this.errors;
                        toast.error(error.response.data.message, {
                            timeout: 5000,
                        });
                        reject(error);
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            });
        },

        //start in create
        fetchCreateData() {
            axios.get(`accounts/create`).then((response) => {
                this.lists = response.data.meta;
            });
        },
        //start in edit
        fetchEditData(id: Number) {
            this.showModalEdit = false;
            axios.get(`${route}/${id}/edit`).then((response) => {
                this.entry = response.data.data;
                this.lists = response.data.meta;
            });
        },

        fetchShowData(id: Number) {
            this.showModalShow = false;
            axios.get(`${route}/${id}`).then((response) => {
                this.entry = response.data.data;
                // this.lists = response.data.meta;
            });
        },
    },
});
