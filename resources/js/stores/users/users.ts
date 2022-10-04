import axios from "axios";
import { defineStore } from "pinia";
import { useToast } from "vue-toastification";
import { useSingleUsers } from "./single";

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
        loading: false,
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
                    .get("users", { params: this.query })
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
        editTable(item: any) {
            const users = useSingleUsers();
            users.showModalEdit = true;
            users.fetchEditData(item.id);
        },
        showTable(item: any) {
            const users = useSingleUsers();
            users.showModalShow = true;
            users.fetchShowData(item.id);
        },
    },
});
