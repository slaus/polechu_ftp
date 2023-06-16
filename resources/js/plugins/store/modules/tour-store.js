import Vue from "vue";

const state = {
    isLoading: false,
    listWithPaginate: [],
    totalCount: 0,
    itemsPerPage: 10,
    currentPage: 1,
    tour: {
        id: 0,
        slug: '',
        name: null,
        image: '',
        gallery: [],
        price: null,
        description: null,
        content: null,
        seo: null,
        visibility: true,
        order: 0
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

            return Vue.prototype.$api.get('v1/tours', { params: params }).then(response => {
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
    async loadTour({ commit }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.get('v1/tours/' + id).then(response => {
                if (response.data) {
                    commit('tour', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async saveTour({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.post('v1/tours', data).then(response => {
                if (response.data) {
                    commit('tour', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async updateTour({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.put('v1/tours/' + data.id, data).then(response => {
                if (response.data) {
                    commit('tour', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async deleteTour({ commit, state, dispatch }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.delete('v1/tours/' + id).then(response => {
                commit('resetTour');

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
    tour(state, payload) {
        state.tour = payload;
    },
    resetTour(state, payload) {
        state.tour.id = 0;
        state.tour.slug = '';
        state.tour.name = null;
        state.tour.image = '';
        state.tour.gallery = [];
        state.tour.price = null;
        state.tour.description = null;
        state.tour.content = null;
        state.tour.seo = null;
        state.tour.visibility = true;
        state.tour.order = 0;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
