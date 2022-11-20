import axios from "axios";
import { defineStore } from "pinia";
import { useSettingAlert } from "../settings/SettingAlert";

export const useSinglePage = defineStore("single-pages", {
    state: () => ({
        entry: {},
        lists: {},
        showModalCreate: false,
        showModalEdit: false,
        showModalShow: false,
        route: String,
    }),

    actions: {

        //start in create
        fetchCreateData() {
            axios.get(`${this.route}/create`).then((response) => {
                this.lists = response.data.meta;
            });
        },
        //start in edit
        fetchEditData(id: Number) {
            axios.get(`${this.route}/${id}/edit`).then((response) => {
                this.entry = response.data.data ?? [];
                this.lists = response.data.meta ?? [];
            });
        },

        fetchShowData(id: Number) {
            axios.get(`${this.route}/${id}`).then((response) => {
                this.entry = response.data.data ?? [];
                this.lists = response.data.meta ?? [];
            });
        },

        setRoute(route: String) {
            this.route = route;
        },
    },
});
