import axios from "axios";
import { defineStore } from "pinia";
import { useToast } from "vue-toastification";
import { useSingleRoles } from "./single";

const toast = useToast();
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
                    .get("roles", { params: this.query })
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
        editTable(item: any) {
            const roles = useSingleRoles();
            roles.showModalEdit = true;
            roles.fetchEditData(item.id);
        },
        showTable(item: any) {
            const roles = useSingleRoles();
            roles.showModalShow = true;
            roles.fetchShowData(item.id);
        },
    },
});
