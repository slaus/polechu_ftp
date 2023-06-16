import Vue from "vue";

const state = {
    isLoading: false,
    listWithPaginate: [],
    totalCount: 0,
    itemsPerPage: 10,
    currentPage: 1,
    user: {
        id: 0,
        name: '',
        email: ''
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

            return Vue.prototype.$api.get('v1/users', { params: params }).then(response => {
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
    async loadUser({ commit }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.get('v1/users/' + id).then(response => {
                if (response.data) {
                    commit('user', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async saveUser({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.post('v1/users', data).then(response => {
                if (response.data) {
                    commit('user', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async updateUser({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.put('v1/users/' + data.id, data).then(response => {
                if (response.data) {
                    commit('user', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async deleteUser({ commit, state, dispatch }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.delete('v1/users/' + id).then(response => {
                commit('resetUser');

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
    user(state, payload) {
        state.user = payload;
    },
    resetUser(state, payload) {
        state.user.id = 0;
        state.user.name = '';
        state.user.email = '';
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
