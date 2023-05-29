<template>
    <v-dialog v-model="alert.isActive" :width="alert.width">
        <v-card :width="alert.width">
            <v-toolbar :color="alert.isError ? 'error' : 'success'" flat dense dark>
                <v-toolbar-title>
                    {{ $t(alert.title) }}
                </v-toolbar-title>
            </v-toolbar>
            <v-card-text class="pt-3 mh-100">
                <span>{{ $t(alert.message) }}</span>
            </v-card-text>
            <v-divider/>
            <v-card-actions class="justify-center h-47">
                <v-btn text color="primary" @click="close">
                    <span class="no-upper">{{ $t('buttons.ok') }}</span>
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "AlertDialog",
    computed: {
        alert() {
            return this.$store.state.alertStore;
        }
    },
    methods: {
        close() {
            this.$store.commit('alertStore/closeAlert');
        }
    }
}
</script>

<style scoped>
.mh-100 {
    min-height: 100px;
}
.h-47 {
    height: 47px;
}
</style>
