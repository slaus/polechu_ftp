const state = {
    hasErrors: false,
    errors: []
};

const getters = {};
const actions = {};
const mutations = {
    setErrors(state, errors) {
        state.errors = [];
        state.hasErrors = true;

        for (const field in errors) {
            state.errors[field] = errors[field][0];
        }
    },
    cleanErrors(state) {
        state.hasErrors = false;
        state.errors = [];
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
