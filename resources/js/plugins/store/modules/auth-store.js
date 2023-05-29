import Vue from "vue";

const state = {
    isAuthed: false,
    id: 0,
    name: '',
    email: '',
    token: '',
    locale: ''
};

const getters = {};
const actions = {
    async user({ commit }) {
        try {
            const response = await Vue.prototype.$api.get('v1/user');
            commit('setUser', response.data)
        } catch (error) {
            console.log(error);
        }
    }
};
const mutations = {
    setUser(state, user) {
        state.isAuthed = true;
        state.id = user.id;
        state.name = user.name;
        state.email = user.email;
        state.token = user.token;
        state.locale = user.locale;
    },
    cleanUser(state) {
        state.isAuthed = false;
        state.id = 0;
        state.name = '';
        state.email = '';
        state.token = '';
        state.locale = '';
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
