import { useToast } from "vue-toastification";
const toast = useToast();
function initialState() {
    return {
        entry: {
            id: null,
            name: "",
            email: null,
            email_verified_at: "",
            password: null,
            role_id: "",
            remember_token: "",
            phone: "",
            account_id: null,
            profile_photo_path: "",
            created_at: "",
            updated_at: "",
            deleted_at: "",
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
    };
}

const route = "users";

const getters = {
    entry: (state) => state.entry,
    lists: (state) => state.lists,
    loading: (state) => state.loading,
    errors: (state) => state.errors,
};

const actions = {
    storeData({ commit, state, dispatch }) {
        commit("setLoading", true);
        return new Promise(async (resolve, reject) => {
            await axios
                .post(route, state.entry)
                .then((response) => {
                    toast.success("تم إضافة المستخدم بنجاح");
                    resolve(response);
                })
                .catch((error) => {
                    state.errors = error.response.data.errors || state.errors;
                    toast.error(error.response.data.message, { timeout: 5000 });
                    reject(error);
                })
                .finally(() => {
                    commit("setLoading", false);
                });
        });
    },
    updateData({ commit, state, dispatch }) {
        commit("setLoading", true);
        return new Promise(async (resolve, reject) => {
            await axios
                .put(`${route}/${state.entry.id}`, state.entry)
                .then((response) => {
                    resolve(response);
                    toast.success("تم تعديل المستخدم بنجاح");
                })
                .catch((error) => {
                    state.errors = error.response.data.errors || state.errors;
                    toast.error(error.response.data.message, { timeout: 5000 });
                    reject(error);
                })
                .finally(() => {
                    commit("setLoading", false);
                });
        });
    },
    fetchCreateData({ commit, state }) {
        axios.get(`${route}/create`).then((response) => {
            commit("setLists", response.data.meta);
        });
    },
    fetchEditData({ commit, dispatch }, id) {
        axios.get(`${route}/${id}/edit`).then((response) => {
            commit("resetState");
            commit("setEntry", response.data.data);
            commit("setLists", response.data.meta);
        });
    },
    fetchShowData({ commit, dispatch }, id) {
        axios.get(`${route}/${id}`).then((response) => {
            commit("resetState");
            commit("setEntry", response.data.data);
            commit("setLists", response.data.meta);

        });
    },

    fetchShowDataProfile({ commit, dispatch }, id) {
        axios.get(`${route}/profile`).then((response) => {
            commit("resetState");
            commit("setLists", response.data.meta);

        });
    },
    resetState({ commit }) {
        commit("resetState");
    },
    stop({ commit }) {
        commit("setLoading", false);
    },
};

const mutations = {
    setEntry(state, entry) {
        state.entry = entry;
    },
    setLists(state, lists) {
        state.lists = lists;
    },
    setLoading(state, loading) {
        state.loading = loading;
    },
    resetState(state) {
        state = Object.assign(state, initialState());
    },
};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations,
};
