function initialState() {
    return {
        sidebarVisible: "",
        sidebarUnfoldable: false,
    };
}
const getters = {
    sidebarVisible: (state) => state.sidebarVisible,
    sidebarUnfoldable: (state) => state.sidebarUnfoldable,
};
const mutations = {
    toggleSidebar(state) {
        state.sidebarVisible = !state.sidebarVisible;
    },
    toggleUnfoldable(state) {
        state.sidebarUnfoldable = !state.sidebarUnfoldable;
    },
    updateSidebarVisible(state, payload) {
        state.sidebarVisible = payload.value;
    },
};

export { getters, mutations };
