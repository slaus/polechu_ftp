<template>
    <v-data-table
        fixed-header
        :items="tours"
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
                    @click="editTour(0)"
                >
                    <v-icon small left>fa-solid fa-plus</v-icon>
                    <span class="no-upper">{{ $t('buttons.add') }}</span>
                </v-btn>
            </v-toolbar>

            <SeoComponent v-bind.sync="tourSeo" v-on:save="saveSeo" />
            <EditTourComponent v-bind.sync="tourEdit" v-on:reload="loadTours" />
        </template>

        <template v-slot:item.name="{ item }">
            {{ translation(item.name) }}
        </template>

        <template v-slot:item.visibility="{ item }">
            <v-icon v-if="item.visibility">fa-solid fa-check</v-icon>
        </template>

        <template v-slot:item.actions="{ item }">
            <v-btn icon @click="seoTour(item.id)" color="warning">
                <v-icon small>fa-regular fa-magnifying-glass-dollar</v-icon>
            </v-btn>
            <v-btn icon @click="viewTour(item.slug)" color="info">
                <v-icon small>fa-solid fa-eye</v-icon>
            </v-btn>
            <v-btn icon @click="editTour(item.id)" color="success">
                <v-icon small>fa-solid fa-pen-to-square</v-icon>
            </v-btn>
            <v-btn icon @click="confirmDeleteTour(item.id)" color="error">
                <v-icon small>fa-solid fa-trash-can</v-icon>
            </v-btn>
        </template>
    </v-data-table>
</template>

<script>
import { mapState } from "vuex";
import EditTourComponent from "./EditTourComponent.vue";
import confirm from "../../mixins/confirm";
import localization from "../../mixins/localization";
import SearchInput from "../shared/SearchInput";
import SeoComponent from "../shared/SeoComponent.vue";

export default {
    name: "ToursTableComponent",
    mixins: [
        confirm,
        localization
    ],
    components: {
        EditTourComponent,
        SearchInput,
        SeoComponent
    },
    computed: {
        ...mapState({
            isLoading: state => state.tourStore.isLoading,
            tours: state => state.tourStore.listWithPaginate,
            totalCount: state => state.tourStore.totalCount,
            itemsPerPage: state => state.tourStore.itemsPerPage,
            currentPage: state => state.tourStore.currentPage,
            tour: state => state.tourStore.tour
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
                { text: this.$t('columns.tourName'), value: 'name', sortable: true },
                { text: this.$t('columns.order'), value: 'order', width: 160, sortable: true, align: 'center' },
                { text: this.$t('columns.visibility'), value: 'visibility', width: 160, sortable: true, align: 'center' },
                { text: '', value: 'actions', width: 240, sortable: false, align: 'right' }
            ],
            tourSeo: {
                isActive: false,
                id: 0
            },
            tourEdit: {
                isActive: false,
                id: 0
            }
        }
    },
    watch: {
        options: {
            handler() {
                this.loadTours();
            },
            deep: true
        },
        '$store.state.confirmStore.isConfirmed': function (value) {
            if (value && this.confirmPayload.action && this.confirmPayload.action === 'deleteTour') {
                this.deleteTour();
            }
        }
    },
    methods: {
        loadTours() {
            this.$store.dispatch('tourStore/listWithPaginate', this.options);
        },
        seoTour(id) {
            this.$store.dispatch('tourStore/loadTour', id).then(response => {
                this.tourSeo.value = this.tour.seo;
                this.tourSeo.name = this.tour.name;
                this.tourSeo.isActive = true;
            });
        },
        viewTour(slug) {
            window.open('/tours/' + slug, '_blank').focus();
        },
        editTour(id) {
            this.tourEdit.id = id;
            this.tourEdit.isActive = true;
        },
        confirmDeleteTour(id) {
            this.setConfirm({
                title: 'confirm.deleteTitle',
                message: 'confirm.deleteMessage',
                payload: { action: 'deleteTour', id: id }
            });
        },
        deleteTour() {
            this.$store.dispatch('tourStore/deleteTour', this.confirmPayload?.id ?? 0).finally(() => {
                this.loadTours();
                this.clearConfirm();
            });
        },
        saveSeo() {
            this.tour.seo = this.tourSeo.value;
            this.$store.dispatch('tourStore/updateTour', this.tour).then(response => {
                this.successSaveSeoAction();
            });
        },
        successSaveSeoAction() {
            this.tourSeo.value = {};
            this.tourSeo.isActive = false;
        },
    }
}
</script>

<style scoped>

</style>
