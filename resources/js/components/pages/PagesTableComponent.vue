<template>
    <v-data-table
        fixed-header
        :items="pages"
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

            <SeoComponent v-bind.sync="pageSeo" v-on:save="saveSeo" />
            <EditPageComponent v-bind.sync="pageEdit" v-on:reload="loadPages" />
        </template>

        <template v-slot:item.name="{ item }">
            {{ translation(item.name) }}
        </template>

        <template v-slot:item.actions="{ item }">
            <v-btn icon @click="seoPage(item.id)" color="warning">
                <v-icon small>fa-regular fa-magnifying-glass-dollar</v-icon>
            </v-btn>
            <v-btn icon @click="viewPage(item.slug)" color="info">
                <v-icon small>fa-solid fa-eye</v-icon>
            </v-btn>
            <v-btn icon @click="editPage(item.id)" color="success">
                <v-icon small>fa-solid fa-pen-to-square</v-icon>
            </v-btn>
        </template>
    </v-data-table>
</template>

<script>
import { mapState } from "vuex";
import EditPageComponent from "./EditPageComponent";
import confirm from "../../mixins/confirm";
import localization from "../../mixins/localization";
import SearchInput from "../shared/SearchInput";
import SeoComponent from "../shared/SeoComponent.vue";

export default {
    name: "PagesTableComponent",
    mixins: [
        confirm,
        localization
    ],
    components: {
        EditPageComponent,
        SearchInput,
        SeoComponent
    },
    computed: {
        ...mapState({
            isLoading: state => state.pageStore.isLoading,
            pages: state => state.pageStore.listWithPaginate,
            totalCount: state => state.pageStore.totalCount,
            itemsPerPage: state => state.pageStore.itemsPerPage,
            currentPage: state => state.pageStore.currentPage,
            page: state => state.pageStore.page
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
                { text: this.$t('columns.pageName'), value: 'name', sortable: false },
                { text: '', value: 'actions', width: 160, sortable: false, align: 'right' }
            ],
            pageSeo: {
                isActive: false,
                value: {}
            },
            pageEdit: {
                isActive: false,
                id: 0
            }
        }
    },
    watch: {
        options: {
            handler() {
                this.loadPages();
            },
            deep: true
        }
    },
    methods: {
        loadPages() {
            this.$store.dispatch('pageStore/listWithPaginate', this.options);
        },
        seoPage(id) {
            this.$store.dispatch('pageStore/loadPage', id).then(response => {
                this.pageSeo.value = this.page.seo;
                this.pageSeo.name = this.page.name;
                this.pageSeo.isActive = true;
            });
        },
        viewPage(slug) {
            window.open('/' + slug, '_blank').focus();
        },
        saveSeo() {
            this.page.seo = this.pageSeo.value;
            this.$store.dispatch('pageStore/updatePage', this.page).then(response => {
                this.successSaveSeoAction();
            });
        },
        successSaveSeoAction() {
            this.pageSeo.value = {};
            this.pageSeo.isActive = false;
        },
        editPage(id) {
            this.pageEdit.id = id;
            this.pageEdit.isActive = true;
        }
    }
}
</script>

<style scoped>

</style>
