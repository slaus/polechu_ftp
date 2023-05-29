export default {
    computed: {
        confirmPayload() {
            return this.$store.state.confirmStore.payload;
        }
    },
    methods: {
        setConfirm(data) {
            this.$store.commit('confirmStore/setConfirm', data);
        },
        clearConfirm() {
            this.$store.commit('confirmStore/cancel');
        }
    }
}
