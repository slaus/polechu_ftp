import Vue from "vue";

const state = {
    isLoading: false
};
const getters = {};
const actions = {
    async clearCache({ commit, state, dispatch }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.delete('v1/system/cache').then(response => {
                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    }
};
const mutations = {};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
