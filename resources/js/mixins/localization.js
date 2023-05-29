import { mapState } from "vuex";

export default {
    computed: {
        ...mapState({
            locale: state => state.localizationStore.locale,
            localizations: state => state.localizationStore.localizations,
        })
    },
    methods: {
        translation(string) {
            if (typeof string === 'string') {
                return string;
            }

            if (typeof string !== 'object' || string === null) {
                return '';
            }

            return string[this.locale]
                ? string[this.locale]
                : (string[Object.keys(string)[0]] ?? '');
        }
    }
}
