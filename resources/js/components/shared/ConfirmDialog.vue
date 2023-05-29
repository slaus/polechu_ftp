<template>
    <v-dialog v-model="confirm.isActive" persistent :width="confirm.width">
        <v-card>
            <v-toolbar flat dark color="error">
                <v-app-bar-nav-icon><v-icon>fas fa-exclamation-triangle</v-icon></v-app-bar-nav-icon>
                <v-toolbar-title>{{ $t(confirm.title) }}</v-toolbar-title>
            </v-toolbar>
            <v-card-text class="subtitle-1 black--text mt-3">
                {{ $t(confirm.message) }}
            </v-card-text>
            <v-divider class="ma-0" />
            <v-card-actions>
                <v-spacer/>
                <v-btn
                    text
                    color="error"
                    @click="accept"
                >{{ $t('buttons.ok') }}</v-btn>

                <v-btn
                    text
                    color="primary"
                    @click="cancel"
                >{{ $t('buttons.cancel') }}</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "ConfirmDialog",
    computed: {
        confirm() {
            return this.$store.state.confirmStore;
        }
    },
    methods: {
        accept() {
            this.$store.commit('confirmStore/accept');
        },
        cancel() {
            this.$store.commit('confirmStore/cancel');
        }
    }
}
</script>

<style scoped>

</style>
