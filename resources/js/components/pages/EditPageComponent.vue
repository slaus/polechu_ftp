<template>
    <v-dialog v-model="isActive" fullscreen scrollable persistent :retain-focus="false">
        <v-card tile>
            <v-toolbar flat dark color="primary" max-height="64">
                <v-toolbar-title>{{ $t(title, { page: translation(page.name) }) }}</v-toolbar-title>

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
                <v-layout wrap class="mt-4">
                    <v-flex class="xs12 sm8 px-0 px-sm-2 mb-4">
                        <MultiLangTextField
                            :value.sync="page.name"
                            :label="$t('labels.pageName')"
                            :readonly="isLoading"
                            :error-messages="messageFieldError('name')"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm4 px-0 px-sm-2">
                        <v-text-field
                            outlined
                            dense
                            v-model="page.slug"
                            :readonly="isLoading || noEditSlug"
                            :label="$t('labels.postSlug')"
                            @dblclick="noEditSlug=false"
                            @focusout="noEditSlug=true"
                            :error-messages="messageFieldError('slug')"
                        ></v-text-field>
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2">
                        <template v-if="page.slug === 'home'">
                            <HomeContent :value.sync="page.content" />
                        </template>

                        <template v-else-if="page.slug === 'about'">
                            <AboutContent :value.sync="page.content" />
                        </template>

                        <template v-else-if="page.slug === 'blog'">
                            <BlogContent :value.sync="page.content" />
                        </template>

                        <template v-else-if="page.slug === 'komanda'">
                            <TeamContent :value.sync="page.content" />
                        </template>

                        <template v-else-if="page.slug === 'contacts'">
                            <ContactsContent :value.sync="page.content" />
                        </template>

                        <template v-else>
                            <DefaultContent :value.sync="page.content" />
                        </template>
                    </v-flex>
                </v-layout>
            </v-card-text>

            <v-divider />

            <v-card-actions>
                <v-btn
                    color="primary"
                    text
                    @click="savePage"
                    :disabled="isLoading"
                    :loading="isLoading"
                >
                    {{ $t('buttons.save') }}
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import { generateSlug } from "../../helpers/functions";
import { mapState } from "vuex";
import validation from "../../mixins/validation";
import localization from "../../mixins/localization";
import MultiLangTextField from "../shared/MultiLangTextField";
import MultiLangEditor from "../shared/MultiLangEditor";
import HomeContent from "./contents/HomeContent.vue";
import AboutContent from "./contents/AboutContent.vue";
import BlogContent from "./contents/BlogContent.vue";
import ContactsContent from "./contents/ContactsContent.vue";
import DefaultContent from "./contents/DefaultContent.vue";
import TeamContent from "./contents/TeamContent.vue";

export default {
    name: "EditPageComponent",
    mixins: [
        validation,
        localization
    ],
    components: {
        MultiLangTextField,
        MultiLangEditor,
        HomeContent,
        AboutContent,
        BlogContent,
        ContactsContent,
        DefaultContent,
        TeamContent
    },
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
            noEditSlug: true
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.pageStore.isLoading,
            page: state => state.pageStore.page,
            protectPageIds: state => state.pageStore.protectPageIds
        }),
        title() {
            return this.id > 0 ? 'titles.editPage' : 'titles.newPage';
        }
    },
    watch: {
        '$props.isActive': function (value) {
            if (value) {
                if (this.id > 0) {
                    this.loadPageData();
                }
            } else {
                this.slug = null;
                this.$store.commit('pageStore/resetPage');
            }
        },
        'page.name': function (value) {
            this.setSlug(this.translation(value))
        }
    },
    methods: {
        loadPageData() {
            this.$store.dispatch('pageStore/loadPage', this.id);
        },
        savePage() {
            if (this.id > 0) {
                this.$store.dispatch('pageStore/updatePage', this.page).then(response => {
                    this.successSaveAction();
                });
            } else  {
                this.$store.dispatch('pageStore/savePage', this.page).then(response => {
                    this.successSaveAction();
                });
            }
        },
        setSlug(string) {
            if (this.id === 0) {
                this.page.slug = generateSlug(string);
            }
        },
        successSaveAction() {
            this.$emit('reload');
            this.close();
        },
        close() {
            this.cleanErrors();
            this.$emit('update:isActive', false);
        }
    }
}
</script>

<style scoped>

</style>
