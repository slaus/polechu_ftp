<template>
    <v-data-table
        fixed-header
        :items="posts"
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
                    @click="editPost(0)"
                >
                    <v-icon small left>fa-solid fa-plus</v-icon>
                    <span class="no-upper">{{ $t('buttons.add') }}</span>
                </v-btn>
            </v-toolbar>

            <SeoComponent v-bind.sync="postSeo" v-on:save="saveSeo" />
            <EditPostComponent v-bind.sync="postEdit" v-on:reload="loadPosts" />
        </template>

        <template v-slot:item.name="{ item }">
            {{ translation(item.name) }}
        </template>

        <template v-slot:item.visibility="{ item }">
            <v-icon v-if="item.visibility">fa-solid fa-check</v-icon>
        </template>

        <template v-slot:item.actions="{ item }">
            <v-btn icon @click="seoPost(item.id)" color="warning">
                <v-icon small>fa-regular fa-magnifying-glass-dollar</v-icon>
            </v-btn>
            <v-btn icon @click="viewPost(item.slug)" color="info">
                <v-icon small>fa-solid fa-eye</v-icon>
            </v-btn>
            <v-btn icon @click="editPost(item.id)" color="success">
                <v-icon small>fa-solid fa-pen-to-square</v-icon>
            </v-btn>
            <v-btn icon @click="confirmDeletePost(item.id)" color="error">
                <v-icon small>fa-solid fa-trash-can</v-icon>
            </v-btn>
        </template>
    </v-data-table>
</template>

<script>
import { mapState } from "vuex";
import EditPostComponent from "./EditPostComponent";
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
        EditPostComponent,
        SearchInput,
        SeoComponent
    },
    computed: {
        ...mapState({
            isLoading: state => state.postStore.isLoading,
            posts: state => state.postStore.listWithPaginate,
            totalCount: state => state.postStore.totalCount,
            itemsPerPage: state => state.postStore.itemsPerPage,
            currentPage: state => state.postStore.currentPage,
            post: state => state.postStore.post
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
                { text: this.$t('columns.postName'), value: 'name', sortable: true },
                { text: this.$t('columns.createdAt'), value: 'created_at', width: 160, sortable: true, align: 'center' },
                { text: this.$t('columns.visibility'), value: 'visibility', width: 160, sortable: true, align: 'center' },
                { text: '', value: 'actions', width: 240, sortable: false, align: 'right' }
            ],
            postSeo: {
                isActive: false,
                name: null,
                id: 0
            },
            postEdit: {
                isActive: false,
                id: 0
            }
        }
    },
    watch: {
        options: {
            handler() {
                this.loadPosts();
            },
            deep: true
        },
        '$store.state.confirmStore.isConfirmed': function (value) {
            if (value && this.confirmPayload.action && this.confirmPayload.action === 'deletePost') {
                this.deletePost();
            }
        }
    },
    methods: {
        loadPosts() {
            this.$store.dispatch('postStore/listWithPaginate', this.options);
        },
        seoPost(id) {
            this.$store.dispatch('postStore/loadPost', id).then(response => {
                this.postSeo.value = this.post.seo;
                this.postSeo.name = this.post.name;
                this.postSeo.isActive = true;
            });
        },
        viewPost(slug) {
            window.open('/blog/' + slug, '_blank').focus();
        },
        editPost(id) {
            this.postEdit.id = id;
            this.postEdit.isActive = true;
        },
        confirmDeletePost(id) {
            this.setConfirm({
                title: 'confirm.deleteTitle',
                message: 'confirm.deleteMessage',
                payload: { action: 'deletePost', id: id }
            });
        },
        deletePost() {
            this.$store.dispatch('postStore/deletePost', this.confirmPayload?.id ?? 0).finally(() => {
                this.loadPosts();
                this.clearConfirm();
            });
        },
        saveSeo() {
            this.post.seo = this.postSeo.value;
            this.$store.dispatch('postStore/updatePost', this.post).then(response => {
                this.successSaveSeoAction();
            });
        },
        successSaveSeoAction() {
            this.postSeo.value = {};
            this.postSeo.isActive = false;
        }
    }
}
</script>

<style scoped>

</style>
