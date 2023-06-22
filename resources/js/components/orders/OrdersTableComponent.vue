<template>
    <v-data-table
        fixed-header
        :items="orders"
        :headers="headers"
        :options.sync="options"
        :footer-props="footerProps"
        :server-items-length="totalCount"
        :loading="isLoading"
        :loader-height="1"
        class="elevation-0 bordered-td"
    >
        <template v-slot:top>
            <v-toolbar flat class="rounded-t-lg">
                <SearchInput
                    :value.sync="options.search"
                    :placeholder="$t('placeholders.search')"
                />
            </v-toolbar>

            <ShowOrderComponent v-bind.sync="orderShow" />
        </template>

        <template v-slot:item.actions="{ item }">
            <v-btn icon @click="viewOrder(item.id)" color="info">
                <v-icon small>fa-solid fa-eye</v-icon>
            </v-btn>
        </template>
    </v-data-table>
</template>

<script>
import { mapState } from "vuex";
import SearchInput from "../shared/SearchInput";
import ShowOrderComponent from "./ShowOrderComponent.vue";
import SeoComponent from "../shared/SeoComponent.vue";

export default {
    name: "OrdersTableComponent",
    props: {
        type: Number,
        default: 0
    },
    components: {
        SeoComponent,
        SearchInput,
        ShowOrderComponent
    },
    computed: {
        ...mapState({
            isLoading: state => state.orderStore.isLoading,
            orders: state => state.orderStore.listWithPaginate,
            totalCount: state => state.orderStore.totalCount,
            itemsPerPage: state => state.orderStore.itemsPerPage,
            currentPage: state => state.orderStore.currentPage,
        })
    },
    data() {
        return {
            search: '',
            options: {
                itemsPerPage: 10,
            },
            footerProps: {
                itemsPerPageOptions: [10, 15, 30]
            },
            headers: [
                { text: this.$t('columns.title'), value: 'title', sortable: true },
                { text: this.$t('columns.createdAt'), value: 'created_at', sortable: true },
                { text: '', value: 'actions', width: 240, sortable: false, align: 'right' }
            ],
            orderShow: {
                isActive: false,
                id: 0
            }
        }
    },
    watch: {
        options: {
            handler() {
                this.loadOrders();
            },
            deep: true
        },
        '$props.type'() {
            this.loadOrders();
        }
    },
    methods: {
        loadOrders() {
            this.options.type = this.type;
            this.$store.dispatch('orderStore/listWithPaginate', this.options);
        },
        viewOrder(id) {
            this.orderShow.id = id;
            this.orderShow.isActive = true;
        }
    }
}
</script>

<style scoped>

</style>
