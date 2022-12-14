import axios from "axios";
import { defineStore } from "pinia";
import { useSettingAlert } from "../settings/SettingAlert";
import { useSetting } from "../settings/SettingIndex";
import { useSingleUsers } from "./single";
const route = "users";

export const useUsers = defineStore("index-users", {
    state: () => ({
        theme: useSetting().theme,
        users: [],
        total: 0,
        page: 1,
        query: {
            sortBy: "id",
            sortType: "desc",
            rowsPerPage: 20,
            page: 1,
        },
        loading: false,
        filters: { s: "", trashed: "" },
        showDeleted: false,
        itemId: null,
        itemsSelected: [],
        trashed: false,
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
        setFilters(q: any) {
            this.filters = q;
        },
        editItem(item: any) {
            const single = useSingleUsers();
            single.showModalEdit = true;
            single.fetchEditData(item.id);
            console.log(single.showModalEdit + '  itrms')
        },
        showItem(item: any) {
            const single = useSingleUsers();
            single.showModalShow = true;
            single.fetchShowData(item.id);
        },
        showDeletedMethod(item: any, trash = false) {
            this.itemId = item;
            this.showDeleted = true;
            this.trashed = trash;
        },
        deleteItem() {
            axios
                .delete(`${route}/${this.itemId}`)
                .then((response) => {
                    useSettingAlert().setAlert(
                        "???? ?????? ???????????????? ??????????",
                        "success",
                        true
                    );
                    this.showDeleted = false;
                    this.fetchIndexData();
                    this.itemId = null;
                })
                .catch((error) => {
                    useSettingAlert().setAlert(
                        error.response.data.message,
                        "warning",
                        true
                    );
                });
        },

        deleteAllItem(items: any) {
            const item = { items: items.map((e: any) => e.id) };
            console.log(item);
            axios
                .post(`${route}/delete-all`, item)
                .then((response) => {
                    useSettingAlert().setAlert(
                        "???? ?????? ???????? ???????????????????? ??????????",
                        "success",
                        true
                    );
                    this.showDeleted = false;
                    this.fetchIndexData();
                    this.itemId = null;
                })
                .catch((error) => {
                    useSettingAlert().setAlert(
                        error.response.data.message,
                        "warning",
                        true
                    );
                });
        },
        restoreItem(item: Number) {
            axios
                .put(`${route}/${item}/restore`)
                .then((response) => {
                    useSettingAlert().setAlert(
                        "???? ?????????? ???????????????? ??????????",
                        "success",
                        true
                    );
                    this.showDeleted = false;
                    this.fetchIndexData();
                    this.itemId = null;
                })
                .catch((error) => {
                    useSettingAlert().setAlert(
                        error.response.data.message,
                        "warning",
                        true
                    );
                });
        },
    },
});
