<template>
    <v-dialog v-model="isActive" width="400" scrollable persistent :retain-focus="false">
        <v-card tile>
            <v-toolbar flat dark color="primary" max-height="64">
                <v-toolbar-title>{{ $t('titles.order') }} - {{ order.created_at}}</v-toolbar-title>

                <v-spacer/>

                <v-btn icon :title="$t('buttons.close')" @click="close">
                    <v-icon>fa-solid fa-circle-xmark</v-icon>
                </v-btn>
            </v-toolbar>

            <v-progress-linear
                v-if="isLoading"
                indeterminate
                color="primary"
            ></v-progress-linear>

            <v-card-text class="pa-3">
                <template v-if="order.type === 1">
                    <h5>{{ $t('titles.tour') }}</h5>
                    <div>{{ $t('labels.tourId') }}: {{ order.content.tour?.tour_id }}</div>
                    <div>{{ $t('labels.hotelId') }}: {{ order.content.tour?.hotel_id }}</div>
                    <div>{{ $t('labels.tourName') }}: {{ order.content.tour?.name }}</div>
                    <div>{{ $t('labels.state') }}: {{ order.content.tour?.state }}</div>
                    <div>{{ $t('labels.town') }}: {{ order.content.tour?.town }}</div>
                    <div>{{ $t('labels.price') }}: {{ order.content.tour?.price }}</div>
                    <div>{{ $t('labels.currency') }}: {{ order.content.tour?.currency }}</div>
                    <div>{{ $t('labels.checkin') }}: {{ order.content.tour?.checkin }}</div>
                    <div>{{ $t('labels.nights') }}: {{ order.content.tour?.nights }}</div>
                    <div>{{ $t('labels.townFrom') }}: {{ order.content.tour?.town_from }}</div>

                    <br />

                    <h5>{{ $t('titles.client') }}</h5>
                    <div>{{ $t('labels.userName') }}: {{ order.content.client?.name }}</div>
                    <div>{{ $t('labels.userPhone') }}: {{ order.content.client?.phone }}</div>
                    <div>{{ $t('labels.userEmail') }}: {{ order.content.client?.email }}</div>
                    <div>{{ $t('labels.callTime') }}: {{ order.content.client?.time }}</div>
                    <div>{{ $t('labels.note') }}: {{ order.content.client?.note }}</div>
                </template>

                <template v-if="order.type === 2">
                    <div>{{ $t('labels.userName') }}: {{ order.content.name }}</div>
                    <div>{{ $t('labels.userEmail') }}: {{ order.content.email }}</div>
                    <div>{{ $t('labels.requestText') }}: {{ order.content.text }}</div>
                </template>

                <template  v-if="order.type === 3">
                    <div>{{ $t('labels.userEmail') }}: {{ order.content.email }}</div>
                </template>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import { mapState } from "vuex";

export default {
    name: "ShowOrderComponent",
    props: {
        isActive: {
            type: Boolean,
            default: false
        },
        id: {
            type: Number,
            default: 0
        }
    },
    data() {
        return {

        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.orderStore.isLoading,
            order: state => state.orderStore.order,
        })
    },
    watch: {
        '$props.isActive': function (value) {
            if (value) {
                this.loadOrderData();
            }
        }
    },
    methods: {
        loadOrderData() {
            this.$store.dispatch('orderStore/loadOrder', this.id);
        },
        close() {
            this.$emit('update:isActive', false);
        }
    }
}
</script>

<style scoped>

</style>
