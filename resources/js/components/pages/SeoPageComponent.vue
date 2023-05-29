<template>
    <v-dialog v-model="isActive" width="900" scrollable persistent :retain-focus="false">
        <v-card tile>
            <v-toolbar flat dark color="primary" max-height="64">
                <v-toolbar-title>{{ $t('titles.editSeoPageData', { page: translation(page.name) }) }}</v-toolbar-title>

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
                <div class="px-2">
                    <v-tabs v-model="tab" class="mb-6">
                        <v-tab>{{ $t('tabs.seo') }}</v-tab>
                        <v-tab>{{ $t('tabs.openGraph') }}</v-tab>
                    </v-tabs>
                </div>

                <v-tabs-items v-model="tab">
                    <v-tab-item>
                        <v-layout wrap class="pt-2">
                            <v-flex class="xs12 sm8 px-0 px-sm-2 mb-4">
                                <MultiLangTextField
                                    :value.sync="seo.title"
                                    :label="$t('labels.metaTitle')"
                                    :readonly="isLoading"
                                />
                            </v-flex>
                            <v-flex class="xs12 sm4 px-0 px-sm-2 mb-4">
                                <v-select
                                    :items="indexes"
                                    v-model="seo.indexes"
                                    :label="$t('labels.indexes')"
                                    :readonly="isLoading"
                                    dense
                                    outlined
                                />
                            </v-flex>
                            <v-flex class="xs12 sm12 px-0 px-sm-2 mb-4">
                                <label>{{ $t('labels.metaDescription') }}</label>
                                <MultiLangTextarea
                                    :value.sync="seo.description"
                                    :readonly="isLoading"
                                />
                            </v-flex>
                        </v-layout>
                    </v-tab-item>

                    <v-tab-item>
                        <v-layout wrap class="pt-2">
                            <v-flex class="xs12 sm8 px-0 px-sm-2 mb-4">
                                <MultiLangTextField
                                    :value.sync="seo.og.title"
                                    :label="$t('labels.title')"
                                    :readonly="isLoading"
                                />
                            </v-flex>
                            <v-flex class="xs12 sm4 px-0 px-sm-2 mb-4">
                                <v-select
                                    :items="ogTypes"
                                    v-model="seo.og.type"
                                    :label="$t('labels.type')"
                                    :readonly="isLoading"
                                    dense
                                    outlined
                                />
                            </v-flex>
                            <v-flex class="xs12 sm4 px-0 px-sm-2 mb-4">
                                <label>{{ $t('labels.background') }}</label>
                                <ImageThumb
                                    :value.sync="seo.og.image"
                                    width="290px"
                                    height="180px"
                                    class="mx-auto"
                                />
                            </v-flex>
                            <v-flex class="xs12 sm8 px-0 px-sm-2 mb-4">
                                <label>{{ $t('labels.description') }}</label>
                                <MultiLangTextarea
                                    :value.sync="seo.og.description"
                                    :readonly="isLoading"
                                    rows="4"
                                />
                            </v-flex>
                        </v-layout>
                    </v-tab-item>
                </v-tabs-items>
            </v-card-text>

            <v-divider />

            <v-card-actions>
                <v-btn
                    color="primary"
                    text
                    @click="saveData"
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
import { mapState } from "vuex";
import { mergeDeep } from "../../helpers/functions";
import validation from "../../mixins/validation";
import localization from "../../mixins/localization";
import MultiLangTextField from "../shared/MultiLangTextField";
import MultiLangTextarea from "../shared/MultiLangTextarea";
import ImageThumb from "../shared/ImageThumb";

export default {
    name: "SeoPageComponent",
    mixins: [
        validation,
        localization
    ],
    components: {
        MultiLangTextarea,
        MultiLangTextField,
        ImageThumb
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
            tab: null,
            indexes: [
                { value: 'all', text: 'all' },
                { value: 'noindex', text: 'noindex' },
                { value: 'nofollow', text: 'nofollow' },
                { value: 'noindex,nofollow', text: 'noindex,nofollow' }
            ],
            ogTypes: [
                { value: 'article', text: 'Article' },
                { value: 'website', text: 'Website' }
            ],
            seo: {
                title: null,
                description: null,
                indexes: 'all',
                og: {
                    title: null,
                    description: null,
                    image: null,
                    type: 'website'
                }
            }
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.pageStore.isLoading,
            page: state => state.pageStore.page
        })
    },
    watch: {
        '$props.isActive': function (value) {
            if (value) {
                this.loadPageData();
            } else {
                this.$store.commit('pageStore/resetPage');
            }
        }
    },
    methods: {
        loadPageData() {
            this.$store.dispatch('pageStore/loadPage', this.id).then(response => {
                this.seo = mergeDeep(this.seo, this.page.seo);
            });
        },
        saveData() {
            this.page.seo = this.seo;

            this.$store.dispatch('pageStore/updatePage', this.page).then(response => {
                this.successSaveAction();
            });
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
