import Vue from "vue";

const state = {
    isLoading: false,
    list: {},
};
const getters = {
    isLoading(state) {
        return state.isLoading
    },
    list(state) {
        return state.list
    }
};
const actions = {
    async list({ commit }, group) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.get('v1/settings/' + group).then(response => {
                if (response.data) {
                    const data = {};

                    response.data.forEach(item => {
                        data[item.name] = item.value;
                    });

                    commit('list', data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async saveSettings({ commit, state, dispatch }, payload) {
        try {
            commit('isLoading', true);

            const group = payload.group;
            const data = [];

            for (const setting in payload.settings) {
                data.push({
                    name: setting,
                    value: payload.settings[setting]
                });
            }

            return Vue.prototype.$api.post('v1/settings/' + group, {
                data: data
            }).then(response => {
                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    }
};
const mutations = {
    isLoading(state, payload) {
        state.isLoading = payload;
    },
    list(state, payload) {
        state.list = payload;
    },
    resetSettings(state, payload) {
        state.list = [];
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
