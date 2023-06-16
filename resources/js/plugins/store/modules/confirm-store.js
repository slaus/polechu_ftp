const state = {
    isActive: false,
    isConfirmed: false,
    payload: {},
    title: '',
    message: '',
    width: 450,
};

const getters = {};
const actions = {};
const mutations = {
    setConfirm(state, data) {
        state.isActive = true;
        state.payload = data.payload;
        state.title = data.title;
        state.message = data.message;
        state.width = data.width ?? 450;
    },
    accept(state, data) {
        state.isConfirmed = true;
        state.isActive = false;
    },
    cancel(state) {
        state.isActive = false;
        state.isConfirmed = false;
        state.payload = {};
        state.title = '';
        state.message = '';
        state.width = 450;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
