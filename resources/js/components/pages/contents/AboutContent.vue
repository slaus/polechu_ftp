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

                        <MultiLangEditor
                            :value.sync="content.seo.text"
                        />
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

export default {
    name: "AboutContent",
    mixins: [
        localization
    ],
    components: {
        MultiLangEditor,
        MultiLangTextField,
        ImageThumb,
        MultiLangTextarea,
        draggable
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
                    title: null,
                    text: null
                },
            }
        }
    },
    watch: {
        content: {
            handler() {
                this.$emit('update:value', this.content);
            },
            deep: true
        }
    },
    mounted() {
        this.content = mergeDeep(this.content, this.value);
    },
    methods: {

    }
}
</script>

<style lang="scss" scoped>
.brand-item-wrapper {
    border: 1px solid #a0aec0;
}
</style>
