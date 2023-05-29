const state = {
    isActive: false,
    title: '',
    message: '',
    isError: true,
    width: 300,
};

const getters = {};
const actions = {};
const mutations = {
    setAlert(state, data) {
        state.isActive = true;
        state.isError = data.is_error ?? true;
        state.title = data.title;
        state.message = data.message;
        state.width = data.width ?? 300;
    },
    closeAlert(state) {
        state.isActive = false;
        state.title = '';
        state.message = '';
        state.isError = true;
        state.width = 300;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
