import Vue from 'vue';
import Vuex from 'vuex';
//import VuexPersistence from 'vuex-persist';
import authStore from "./modules/auth-store";
import alertStore from './modules/alert-store';
import confirmStore from "./modules/confirm-store";
import validationStore from './modules/validation-store';
import userStore from './modules/user-store';
import localizationStore from "./modules/localization-store";
import pageStore from "./modules/page-store";
import settingStore from "./modules/setting-store";

Vue.use(Vuex);

/*
const vuexPersist = new VuexPersistence({
    key: 'fly',
    storage: window.localStorage,
    modules: ['authStore']
});
*/

export default new Vuex.Store({
    state: {},
    mutations: {},
    getters: {},
    modules: {
        authStore,
        alertStore,
        confirmStore,
        validationStore,
        userStore,
        localizationStore,
        pageStore,
        settingStore
    },
    strict: false,
    plugins: [
        //vuexPersist.plugin
    ]
});
