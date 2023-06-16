import Vue from "vue";
import store from "./plugins/store/store";
import axios from "axios";
import VueI18n from 'vue-i18n';
import localizations from "../../lang/vue/site.localizations.js";
import FindToursComponent from "./components/tours/FindToursComponent.vue";

window.Vue = Vue;

Vue.use(VueI18n);

Vue.prototype.$api = axios;
Vue.prototype.$api.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Vue.prototype.$api.defaults.headers.common['Content-Type'] = 'application/json';
Vue.prototype.$api.defaults.headers.common['Accept'] = 'application/json';
Vue.prototype.$api.defaults.baseURL = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port + "/api/";

Vue.mixin({
    directives: {
        ripple: {
            inserted: () => {}
        }
    }
});

Vue.component('find-tours-component', FindToursComponent);

const i18n = new VueI18n({
    locale: 'uk',
    fallbackLocale: 'en',
    messages: localizations
});

new Vue({
    i18n,
    store
}).$mount('#app');
