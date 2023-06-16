import Vue from "vue";

const state = {
    isLoading: false,
    listWithPaginate: [],
    totalCount: 0,
    itemsPerPage: 10,
    currentPage: 1,
    post: {
        id: 0,
        slug: '',
        name: null,
        image: '',
        description: null,
        content: null,
        author: null,
        seo: null,
        visibility: true,
        tags: []
    },
    listTags: []
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
    },
    listTags(state) {
        return state.listTags
    }
};
const actions = {
    async listWithPaginate({ commit }, params) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.get('v1/posts', { params: params }).then(response => {
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
    async loadPost({ commit }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.get('v1/posts/' + id).then(response => {
                if (response.data) {
                    commit('post', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async savePost({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.post('v1/posts', data).then(response => {
                if (response.data) {
                    commit('post', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async updatePost({ commit, state, dispatch }, data) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.put('v1/posts/' + data.id, data).then(response => {
                if (response.data) {
                    commit('post', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async deletePost({ commit, state, dispatch }, id) {
        try {
            commit('isLoading', true);

            return Vue.prototype.$api.delete('v1/posts/' + id).then(response => {
                commit('resetPost');

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
    async listTags({ commit }, params) {
        try {
            commit('isLoading', true);

            params.type = 'post';

            return Vue.prototype.$api.get('v1/posts/tags', { params: params }).then(response => {
                if (response.data) {
                    commit('listTags', response.data);
                }

                return response;
            }).finally(() => {
                commit('isLoading', false);
            });
        } catch (error) {
            console.log(error);
        }
    },
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
    post(state, payload) {
        state.post = payload;
    },
    resetPost(state, payload) {
        state.post.id = 0;
        state.post.slug = '';
        state.post.name = null;
        state.post.image = '';
        state.post.description = null;
        state.post.content = null;
        state.post.author = null;
        state.post.seo = null;
        state.post.visibility = true;
        state.post.tags = [];
    },
    listTags(state, payload) {
        state.listTags = payload;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
