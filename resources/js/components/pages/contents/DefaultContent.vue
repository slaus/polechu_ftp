<template>
    <div>
        <v-card tile outlined class="mb-6">
            <v-card-title>{{ $t('titles.banner') }}</v-card-title>

            <v-card-text class="pa-4">
                <v-layout wrap align-center>
                    <v-flex class="xs12 sm3 px-0 px-sm-2 mb-6">
                        <ImageThumb
                            :value.sync="content.banner.image"
                            width="290px"
                            height="180px"
                            class="mx-auto"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm9 px-0 px-sm-2 mb-6">
                        <MultiLangTextField
                            :value.sync="content.banner.title"
                            :label="$t('labels.title')"
                            class="mb-2"
                        />
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>

        <v-card tile outlined class="mb-6">
            <v-card-title>{{ $t('titles.seoContent') }}</v-card-title>

            <v-card-text class="pa-4">
                <v-layout wrap align-center>
                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-6">
                        <MultiLangTextField
                            :value.sync="content.seo.title"
                            :label="$t('labels.title')"
                            class="mb-2"
                        />

                        <div class="mt-10">
                            <v-radio-group v-model="content.seo.type" row>
                                <v-radio
                                    v-for="type in contentTypes"
                                    :key="type.value"
                                    :label="type.text"
                                    :value="type.value"
                                ></v-radio>
                            </v-radio-group>
                        </div>

                        <template v-if="content.seo.type === 'editor'">
                            <MultiLangEditor
                                :value.sync="content.seo.text"
                            />
                        </template>

                        <template v-if="content.seo.type === 'textarea'">
                            <MultiLangTextarea
                                :value.sync="content.seo.text"
                            />
                        </template>

                        <template v-if="content.seo.type === 'code'">
                            <MultiLangCodeEditor
                                :value.sync="content.seo.text"
                            />
                        </template>
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import { mergeDeep } from "../../../helpers/functions";
import MultiLangTextField from "../../shared/MultiLangTextField";
import ImageThumb from "../../shared/ImageThumb";
import MultiLangTextarea from "../../shared/MultiLangTextarea";
import localization from "../../../mixins/localization";
import draggable from 'vuedraggable';
import MultiLangEditor from "../../shared/MultiLangEditor.vue";
import MultiLangCodeEditor from "../../shared/MultiLangCodeEditor.vue";

export default {
    name: "DefaultContent",
    mixins: [
        localization
    ],
    components: {
        MultiLangEditor,
        MultiLangTextField,
        ImageThumb,
        MultiLangTextarea,
        draggable,
        MultiLangCodeEditor
    },
    props: {
        value: {
            type: Object,
            default: {}
        }
    },
    data() {
        return {
            content: {
                banner: {
                    image: null,
                    title: null,
                    description: null
                },
                seo: {
                    type: 'editor',
                    title: null,
                    text: null
                }
            },
            contentTypes: [
                { value: 'editor', text: this.$t('labels.editor') },
                { value: 'textarea', text: this.$t('labels.textarea') },
                { value: 'code', text: this.$t('labels.code') }
            ]
        }
    },
    watch: {
        content: {
            handler() {
                this.$emit('update:value', this.content);
            },
            deep: true
        },
        value() {
            this.content = mergeDeep(this.content, this.value);
        }
    }
}
</script>

<style lang="scss" scoped>
.brand-item-wrapper {
    border: 1px solid #a0aec0;
}
</style>

<style lang="scss">
.v-input__slot .v-label {
    margin-bottom: 0!important;
}
</style>
