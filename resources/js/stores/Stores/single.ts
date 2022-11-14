import axios from "axios";
import { defineStore } from "pinia";
import { useToast } from "vue-toastification";
import { useStores } from ".";
const toast = useToast();
const route = "stores";
export const useSingleStores = defineStore("single-stores", {
    state: () => ({
        entry: {
            id: null,
            name: "",
            details: "",
            products : [],
            status: 1,
        },
        lists: {
            roles: [],
            account: [],
        },
        loading: false,
        errors: {
            name: null,
            details: null,
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
            const userIndex = useStores();
            this.loading = true;
            return new Promise(async (resolve, reject) => {
                await axios
                    .post(route, this.entry)
                    .then((response) => {
                        toast.success("تم إضافة المخزن بنجاح");
                        userIndex.fetchIndexData();
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
            const userIndex = useStores();
            return new Promise(async (resolve, reject) => {
                await axios
                    .put(`${route}/${this.entry.id}`, this.entry)
                    .then((response) => {
                        toast.success("تم تعديل المخزن بنجاح");
                        userIndex.fetchIndexData();
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
            axios.get(`stores/create`).then((response) => {
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
