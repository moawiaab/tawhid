import axios from "axios";
import { defineStore } from "pinia";
import { useSettingAlert } from "../settings/SettingAlert";
import { usePageIndex } from "../pages/pageIndex";
import { useRouter, useRoute } from "vue-router";
import { useSettingsItem } from "../settings/SettingItem";

interface entryData {
    id: Number | null;
    name: String;
    userName: String;
    email: String;
    phone: String;
    password: String;
    password_confirmation: String;
    terms: false;
    details: String;
    type: Number;
}

const route = "clients";
export const useSingleRegister = defineStore("single-register", {
    state: () => ({
        entry: <entryData>{},
        lists: {
            type: [],
            items: [
                {
                    id: 1,
                    title: "محلات دواجن",
                },
                {
                    id: 2,
                    title: "مغلق",
                },
            ],
        },
        loading: false,
        showModalCreate: false,
        token: {},
        errors: {
            userName: "",
            name: "",
            email: "",
            amount: "",
            password: "",
            phone: "",
            password_confirmation: "",
            details: "",
        },
    }),
    getters: {
        hasErrors: (state) => state.errors,
    },
    actions: {
        // send data to server in created
        storeData() {
            this.loading = true;
            return new Promise(async (resolve, reject) => {
                await axios

                    .request({
                        baseURL: "/",
                        url: "register",
                        method: "post",
                        params: this.entry,
                    })
                    .then((response) => {
                        useSettingsItem().getRoles();
                        resolve(response);
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors || this.errors;
                        useSettingAlert().setAlert(
                            error.response.data.message,
                            "warning",
                            true
                        );
                        reject(error);
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            });
        },

        resetPassword() {
            this.loading = true;
            return new Promise(async (resolve, reject) => {
                await axios
                    // .post('login', this.entry)
                    .request({
                        baseURL: "/",
                        url: "reset-password",
                        method: "post",
                        params: {
                            ...this.token,
                            ...this.entry,
                        },
                    })
                    .then((response) => {
                        useSettingsItem().getRoles();
                        resolve(response);
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors || this.errors;
                        console.log(error.response.data);
                        reject(error);
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            });
        },

        fetchCreateData() {
            axios.get(`${route}/create`).then((response) => {
                this.lists = response.data.meta;
            });
        },
        setupEntry(entry: any, lists: any) {
            this.entry = entry;
            this.lists = lists;
        },
    },
});
