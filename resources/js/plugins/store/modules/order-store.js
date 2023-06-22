import Vue from "vue";

const state = {
    isLoading: false,
    listWithPaginate: [],
    totalCount: 0,
    itemsPerPage: 10,
    currentPage: 1,
    order: {
        id: 0,
        type: 0,
        title: '',
        content: []
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

            return Vue.prototype.$api.get('v1/orders', { params: params }).then(response => {
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
    async loadOrder({ commit }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.get('v1/orders/' + id).then(response => {
                if (response.data) {
                    commit('order', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async saveOrder({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.post('v1/orders', data).then(response => {
                if (response.data) {
                    commit('order', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async updateOrder({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.put('v1/orders/' + data.id, data).then(response => {
                if (response.data) {
                    commit('order', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async deleteOrder({ commit, state, dispatch }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.delete('v1/orders/' + id).then(response => {
                commit('resetOrder');

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
    order(state, payload) {
        state.order = payload;
    },
    resetOrder(state, payload) {
        state.order.id = 0;
        state.order.type = 0;
        state.order.title = '';
        state.order.content = [];
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
