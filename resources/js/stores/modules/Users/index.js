const set = (key) => (state, val) => {
    state[key] = val;
};
import { useToast } from "vue-toastification";
const toast = useToast();
function initialState() {
    return {
        data: [],
        total: 0,
        query: {},
        loading: false,
        showEdit: null,
        showModal: null,
    };
}

const route = "users";

const getters = {
    data: (state) => state.data,
    total: (state) => state.total,
    loading: (state) => state.loading,
    showEdit: (state) => state.showEdit,
    showModal: (state) => state.showModal,
};

const actions = {
    fetchIndexData({ commit, state }) {
        commit("setLoading", true);
        axios
            .get(route, { params: state.query })
            .then((response) => {
                commit("setData", response.data);
                commit("setTotal", response.data.meta.total);
            })
            .catch((error) => {
                toast.error(error.response.data.message, { timeout: 5000 });
            })
            .finally(() => {
                commit("setLoading", false);
            });
    },
    destroyData({ commit, state, dispatch }, id) {
        axios
            .delete(`${route}/${id}`)
            .then((response) => {
                dispatch("fetchIndexData");
            })
            .catch((error) => {
                toast.error(error.response.data.message, { timeout: 5000 });
            });
    },
    setQuery({ commit }, value) {
        commit("setQuery", _.cloneDeep(value));
    },
    resetState({ commit }) {
        commit("resetState");
    },
    editData({ commit }, value) {
        this.dispatch("UsersSingle/fetchEditData", value);
        commit("setShowModalEdit", value);
    },
    fetchShowData({ commit }, id) {
        this.dispatch("UsersSingle/fetchShowData", id);
        commit("setShowModal", id);
    },
};

const mutations = {
    setShowModalEdit(state, value) {
        state.showEdit = value;
        state.showEdit = null;
    },
    setShowModal(state, value) {
        state.showModal = value;
        state.showModal = null;
    },
    setData: set("data"),
    setTotal: set("total"),
    setQuery(state, query) {
        query.page = (query.offset + query.limit) / query.limit;
        state.query = query;
    },
    setLoading: set("loading"),
    resetState(state) {
        Object.assign(state, initialState());
    },
};

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations,
};
