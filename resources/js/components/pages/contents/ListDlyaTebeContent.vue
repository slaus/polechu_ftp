<template>
    <div>
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
import MultiLangEditor from "../../shared/MultiLangEditor";
import localization from "../../../mixins/localization";
import draggable from 'vuedraggable';
import MultiLangCodeEditor from "../../shared/MultiLangCodeEditor.vue";

export default {
    name: "HomeContent",
    mixins: [
        localization
    ],
    components: {
        MultiLangTextField,
        ImageThumb,
        MultiLangTextarea,
        MultiLangEditor,
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
                seo: {
                    title: null,
                    text: null
                }
            }
        }
    },
    computed: {

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
}
</script>

<style lang="scss" scoped>

</style>
