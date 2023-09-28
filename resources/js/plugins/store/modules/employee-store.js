import Vue from "vue";

const state = {
    isLoading: false,
    listWithPaginate: [],
    totalCount: 0,
    itemsPerPage: 10,
    currentPage: 1,
    employee: {
        id: 0,
        name: null,
        position: null,
        description: null,
        details: null,
        image: '',
        order: 0,
        visibility: true
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

            return Vue.prototype.$api.get('v1/employees', { params: params }).then(response => {
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
    async loadEmployee({ commit }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.get('v1/employees/' + id).then(response => {
                if (response.data) {
                    commit('employee', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async saveEmployee({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.post('v1/employees', data).then(response => {
                if (response.data) {
                    commit('employee', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async updateEmployee({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.put('v1/employees/' + data.id, data).then(response => {
                if (response.data) {
                    commit('employee', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async deleteEmployee({ commit, state, dispatch }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.delete('v1/employees/' + id).then(response => {
                commit('resetEmployee');

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
    employee(state, payload) {
        state.employee = payload;
    },
    resetEmployee(state, payload) {
        state.employee.id = 0;
        state.employee.name = null;
        state.employee.position = null;
        state.employee.description = null;
        state.employee.details = null;
        state.employee.image = '';
        state.employee.order = 0;
        state.employee.visibility = true;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
