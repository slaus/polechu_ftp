<template>
    <v-dialog v-model="isActive" width="900" scrollable persistent :retain-focus="false">
        <v-card tile>
            <v-toolbar flat dark color="primary" max-height="64">
                <v-toolbar-title>{{ $t('titles.editSeoData', { page: translation(name) }) }}</v-toolbar-title>

                <v-spacer/>

                <v-btn icon :title="$t('buttons.close')" @click="close">
                    <v-icon>fa-solid fa-circle-xmark</v-icon>
                </v-btn>
            </v-toolbar>

            <v-card-text class="pa-3">
                <v-layout wrap class="pt-2">
                    <v-flex class="xs12 sm8 px-0 px-sm-2 mb-4">
                        <MultiLangTextField
                            :value.sync="seo.title"
                            :label="$t('labels.metaTitle')"
                        />
                    </v-flex>
                    <v-flex class="xs12 sm4 px-0 px-sm-2 mb-4">
                        <v-select
                            :items="indexes"
                            v-model="seo.indexes"
                            :label="$t('labels.indexes')"
                            dense
                            outlined
                        />
                    </v-flex>
                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-4">
                        <label>{{ $t('labels.metaDescription') }}</label>
                        <MultiLangTextarea
                            :value.sync="seo.description"
                        />
                    </v-flex>
                </v-layout>
            </v-card-text>

            <v-divider />

            <v-card-actions>
                <v-btn
                    color="primary"
                    text
                    @click="saveData"
                >
                    {{ $t('buttons.save') }}
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import { mergeDeep } from "../../helpers/functions";
import validation from "../../mixins/validation";
import localization from "../../mixins/localization";
import MultiLangTextField from "../shared/MultiLangTextField";
import MultiLangTextarea from "../shared/MultiLangTextarea";

export default {
    name: "SeoComponent",
    mixins: [
        validation,
        localization
    ],
    components: {
        MultiLangTextarea,
        MultiLangTextField
    },
    props: {
        isActive: {
            type: Boolean,
            default: false
        },
        name: {
            type: Object,
            default: () => {}
        },
        value: {
            type: Object,
            default: () => {}
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
            seo: {
                title: null,
                description: null,
                indexes: 'all'
            }
        }
    },
    watch: {
        '$props.isActive': function (value) {
            if (value) {
                this.seo = mergeDeep(this.seo, this.value);
            } else {
                this.clearData();
            }
        }
    },
    methods: {
        saveData() {
            this.$emit('update:value', this.seo);
            this.$emit('save');
        },
        clearData() {
            this.seo = {
                title: null,
                description: null,
                indexes: 'all'
            };
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
