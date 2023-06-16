import Vue from "vue";
import Vuetify from 'vuetify';
import store from "./store/store";
import 'vuetify/dist/vuetify.min.css';
import '../../sass/vuetify.sass';
import en from 'vuetify/es5/locale/en';

Vue.use(Vuetify);

const preset = {
    icons: {
        iconfont: 'fa'
    },
    lang: {
        locales: {
            en
        },
        current: store.state.localizationStore.locale,
    },
    theme: {
        themes: {
            light: {
                primary: '#586487',
                body: '#212121',
                sidebar: '#586487',
                secondary: '#858f9e',
                error: '#B00020',
                info: '#2196F3',
                success: '#4CAF50',
                warning: '#FB8C00',
            },
        },
        options: {
            customProperties: true,
        },
    }
};

export default new Vuetify(preset);
