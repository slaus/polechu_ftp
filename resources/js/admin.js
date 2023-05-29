import Vue from "vue";
import axios from "axios";
import store from "./plugins/store/store";
import vuetify from "./plugins/vuetify";
import router from "./plugins/router";
import VueRouter from "vue-router";
import App from "./AppComponent";
import VueI18n from 'vue-i18n';
import localizations from "../../lang/vue/localizations";

window.Vue = Vue;

Vue.use(VueRouter);
Vue.use(VueI18n);

Vue.prototype.$api = axios;
Vue.prototype.$api.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Vue.prototype.$api.defaults.headers.common['Content-Type'] = 'application/json';
Vue.prototype.$api.defaults.headers.common['Accept'] = 'application/json';
Vue.prototype.$api.defaults.baseURL = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port + "/api/";
Vue.prototype.$api.interceptors.response.use(
    function (response) {
        store.commit('validationStore/cleanErrors');

        return response;
    },
    function (error) {
        if (error.response.status === 401 || error.response.status === 419) {
            store.commit('authStore/cleanUser');
            window.localStorage.clear();
            window.location = '/login';
        } else if (error.response.status === 422) {
            store.commit('validationStore/setErrors', error.response.data.errors);
        } else {
            store.commit('alertStore/setAlert', {
                title: 'alerts.serverError',
                message: error.response.data.message,
                width: 400
            });
        }

        return Promise.reject(error)
    }
);

Vue.mixin({
    directives: {
        ripple: {
            inserted: () => {}
        }
    }
});

const i18n = new VueI18n({
    locale: 'uk',
    fallbackLocale: 'en',
    messages: localizations
});

new Vue({
    components: { App },
    i18n,
    vuetify,
    router,
    store
}).$mount('#app');
