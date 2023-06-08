import Vue from "vue";

const state = {
    isLoading: false,
    treeList: [],
    menu: {
        id: 0,
        layout: 1,
        name: null,
        properties: [],
        visibility: true
    }
};
const getters = {
    isLoading(state) {
        return state.isLoading
    },
    treeList(state) {
        return state.treeList
    }
};
const actions = {
    async treeList({ commit }, params) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.get('v1/menus', { params: params }).then(response => {
                if (response.data) {
                    commit('treeList', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async loadMenu({ commit }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.get('v1/menus/' + id).then(response => {
                if (response.data) {
                    commit('menu', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async saveMenu({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.post('v1/menus', data).then(response => {
                if (response.data) {
                    commit('menu', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async updateMenu({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.put('v1/menus/' + data.id, data).then(response => {
                if (response.data) {
                    commit('menu', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async rebuildMenu({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.put('v1/menus/rebuild', data).then(response => {
                if (response.data) {
                    dispatch('treeList', {});
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async deleteMenu({ commit, state, dispatch }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.delete('v1/menus/' + id).then(response => {
                commit('resetMenu');

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
    treeList(state, payload) {
        state.treeList = payload;
    },
    menu(state, payload) {
        state.menu = payload;
    },
    resetMenu(state, payload) {
        state.menu.id = 0;
        state.menu.layout = 1;
        state.menu.name = null;
        state.menu.properties = [];
        state.menu.visibility = true;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
