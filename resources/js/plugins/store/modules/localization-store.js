const state = {
    localizations: [
        { code: 'uk', name: 'UA', icon: '' },
        // { code: 'en', name: 'EN', icon: '' }
    ],
    locale: 'uk',
    fallbackLocale: 'en'
};

const getters = {};
const actions = {};
const mutations = {
    setLocale(state, data) {
        const locale = state.localizations.find(locale => locale.code === data);

        state.locale = locale ? data : state.fallbackLocale;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
