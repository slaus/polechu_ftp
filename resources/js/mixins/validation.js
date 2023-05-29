export default {
    computed: {
        errors() {
            return this.$store.state.validationStore.errors;
        }
    },
    methods: {
        messageFieldError(field) {
            if (this.errors[field]) {
                return this.errors[field];
            }

            return '';
        },
        cleanErrors() {
            this.$store.commit('validationStore/cleanErrors');
        }
    }
}
