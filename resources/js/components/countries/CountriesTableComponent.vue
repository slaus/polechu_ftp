<template>
    <v-data-table
        fixed-header
        :items="countries"
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

                <v-btn
                    depressed
                    color="primary"
                    @click="editCountry(0)"
                >
                    <v-icon small left>fa-solid fa-plus</v-icon>
                    <span class="no-upper">{{ $t('buttons.add') }}</span>
                </v-btn>
            </v-toolbar>

            <EditCountryComponent v-bind.sync="countryEdit" v-on:reload="loadCountries" />
        </template>

        <template v-slot:item.name="{ item }">
            {{ translation(item.name) }}
        </template>

        <template v-slot:item.actions="{ item }">
            <v-btn icon @click="editCountry(item.id)" color="success">
                <v-icon small>fa-solid fa-pen-to-square</v-icon>
            </v-btn>
            <v-btn icon @click="confirmDeleteCountry(item.id)" color="error">
                <v-icon small>fa-solid fa-trash-can</v-icon>
            </v-btn>
        </template>
    </v-data-table>
</template>

<script>
import { mapState } from "vuex";
import EditCountryComponent from "./EditCountryComponent";
import confirm from "../../mixins/confirm";
import localization from "../../mixins/localization";
import SearchInput from "../shared/SearchInput";

export default {
    name: "CountriesTableComponent",
    mixins: [
        confirm,
        localization
    ],
    components: {
        EditCountryComponent,
        SearchInput
    },
    computed: {
        ...mapState({
            isLoading: state => state.countryStore.isLoading,
            countries: state => state.countryStore.listWithPaginate,
            totalCount: state => state.countryStore.totalCount,
            itemsPerPage: state => state.countryStore.itemsPerPage,
            currentPage: state => state.countryStore.currentPage
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
                { text: this.$t('columns.countryName'), value: 'name', sortable: true },
                { text: '', value: 'actions', width: 240, sortable: false, align: 'right' }
            ],
            countryEdit: {
                isActive: false,
                id: 0
            }
        }
    },
    watch: {
        options: {
            handler() {
                this.loadCountries();
            },
            deep: true
        },
        '$store.state.confirmStore.isConfirmed': function (value) {
            if (value && this.confirmPayload.action && this.confirmPayload.action === 'deleteCountry') {
                this.deleteCountry();
            }
        }
    },
    methods: {
        loadCountries() {
            this.$store.dispatch('countryStore/listWithPaginate', this.options);
        },
        editCountry(id) {
            this.countryEdit.id = id;
            this.countryEdit.isActive = true;
        },
        confirmDeleteCountry(id) {
            this.setConfirm({
                title: 'confirm.deleteTitle',
                message: 'confirm.deleteMessage',
                payload: { action: 'deleteCountry', id: id }
            });
        },
        deleteCountry() {
            this.$store.dispatch('countryStore/deleteCountry', this.confirmPayload?.id ?? 0).finally(() => {
                this.loadCountries();
                this.clearConfirm();
            });
        }
    }
}
</script>

<style scoped>

</style>
