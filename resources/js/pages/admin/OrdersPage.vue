<template>
    <v-card flat>
        <v-card-title>
            {{ $t('titles.orders') }}
        </v-card-title>
        <v-card-text>
            <v-tabs v-model="tab" class="px-3">
                <v-tab>{{ $t('tabs.tourForm') }}</v-tab>
                <v-tab>{{ $t('tabs.contactFrom') }}</v-tab>
                <v-tab>{{ $t('tabs.subscribeForm') }}</v-tab>
            </v-tabs>

            <OrdersTableComponent :type="tab + 1" />
        </v-card-text>
    </v-card>
</template>

<script>
import OrdersTableComponent from "../../components/orders/OrdersTableComponent.vue";

export default {
    name: "OrdersPage",
    components: {
        OrdersTableComponent
    },
    data() {
        return {
            tab: 0
        }
    }
}
</script>

<style scoped>

</style>
