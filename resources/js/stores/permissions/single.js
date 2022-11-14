import axios from "axios";
import { defineStore } from "pinia";
import { usePermissions } from ".";
const route = "permissions";
export const useSinglePermissions = defineStore("single-permissions", {
    state: () => ({
        entry: {
            id: null,
            title: "",
            details: "",
            created_at: "",
            updated_at: "",
        },
        lists: {
            roles: [],
            account: [],
        },
        loading: false,
        errors: {
            name: null,
            email: null,
            password: null,
            role_id: null,
            phone: null,
        },
        details: [" عرض ", " إنشاء ", " تعديل ", " حذف "],
        title: ["_access", "_create", "_edit", "_delete"],
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
            const userIndex = usePermissions();
            this.loading = true;
            return new Promise(async (resolve, reject) => {
                await axios
                    .post(route, this.entry)
                    .then((response) => {
                        // toast.success("تم إضافة الإذن بنجاح");
                        userIndex.fetchIndexData();
                        resolve(response);
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors || this.errors;
                        // toast.error(error.response.data.message, {
                        //     timeout: 5000,
                        // });
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
            const userIndex = usePermissions();
            return new Promise(async (resolve, reject) => {
                await axios
                    .put(`${route}/${this.entry.id}`, this.entry)
                    .then((response) => {
                        // toast.success("تم تعديل الإذن بنجاح");
                        userIndex.fetchIndexData();
                        resolve(response);
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors || this.errors;
                        // toast.error(error.response.data.message, {
                        //     timeout: 5000,
                        // });
                        reject(error);
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            });
        },

        //start in create
        fetchCreateData() {
            axios.get(`permissions/create`).then((response) => {
                this.lists = response.data.meta;
            });
        },
        //start in edit
        fetchEditData(id) {
            this.showModalEdit = false;
            axios.get(`${route}/${id}/edit`).then((response) => {
                this.entry = response.data.data;
                this.lists = response.data.meta;
            });
        },

        fetchShowData(id) {
            this.showModalShow = false;
            axios.get(`${route}/${id}`).then((response) => {
                this.entry = response.data.data;
                // this.lists = response.data.meta;
            });
        },
    },
});
