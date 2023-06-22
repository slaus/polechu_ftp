import Vue from "vue";

const state = {
    isLoading: false,
    listWithPaginate: [],
    totalCount: 0,
    itemsPerPage: 10,
    currentPage: 1,
    country: {
        id: 0,
        plugin_id: null,
        name: null,
        gallery: []
    }
};
const getters = {
    isLoading(state) {
        return state.isLoading
    },
    listWithPaginate(state) {
        return state.listWithPaginate
    },
    totalCount(state) {
        return state.totalCount
    },
    itemsPerPage(state) {
        return state.itemsPerPage
    },
    currentPage(state) {
        return state.currentPage
    }
};
const actions = {
    async listWithPaginate({ commit }, params) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.get('v1/countries', { params: params }).then(response => {
                if (response.data) {
                    commit('listWithPaginate', response.data.data);
                    commit('totalCount', response.data.meta.total);
                    commit('currentPage', response.data.meta.current_page);
                    commit('itemsPerPage', response.data.meta.per_page);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async loadCountry({ commit }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.get('v1/countries/' + id).then(response => {
                if (response.data) {
                    commit('country', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async saveCountry({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.post('v1/countries', data).then(response => {
                if (response.data) {
                    commit('country', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async updateCountry({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.put('v1/countries/' + data.id, data).then(response => {
                if (response.data) {
                    commit('country', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async deleteCountry({ commit, state, dispatch }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.delete('v1/countries/' + id).then(response => {
                commit('resetCountry');

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
    listWithPaginate(state, payload) {
        state.listWithPaginate = payload;
    },
    totalCount(state, payload) {
        state.totalCount = payload;
    },
    itemsPerPage(state, payload) {
        state.itemsPerPage = payload;
    },
    currentPage(state, payload) {
        state.currentPage = payload;
    },
    country(state, payload) {
        state.country = payload;
    },
    resetCountry(state, payload) {
        state.country.id = 0;
        state.country.plugin_id = 0;
        state.country.name = null;
        state.country.gallery = [];
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
