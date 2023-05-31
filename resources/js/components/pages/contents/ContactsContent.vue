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
            <v-card-title>{{ $t('titles.address') }}</v-card-title>

            <v-card-text class="pa-4">
                <v-layout wrap align-center>
                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-6">
                        <MultiLangTextField
                            :value.sync="content.address.title"
                            :label="$t('labels.title')"
                            class="mb-2"
                        />

                        <MultiLangEditor
                            :value.sync="content.address.text"
                        />
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>

        <v-card tile outlined class="mb-6">
            <v-card-title>{{ $t('titles.contactForm') }}</v-card-title>

            <v-card-text class="pa-4">
                <v-layout wrap align-center>
                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-6">
                        <MultiLangTextField
                            :value.sync="content.contact_form.title"
                            :label="$t('labels.formTitle')"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.contact_form.name_placeholder"
                            :label="$t('labels.namePlaceholder')"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.contact_form.email_placeholder"
                            :label="$t('labels.emailPlaceholder')"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.contact_form.text_placeholder"
                            :label="$t('labels.textPlaceholder')"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.contact_form.button_text"
                            :label="$t('labels.buttonText')"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.contact_form.success_send_text"
                            :label="$t('labels.successSend')"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.contact_form.fail_send_text"
                            :label="$t('labels.failSend')"
                            class="mb-2"
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
    name: "ContactsContent",
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
                    title: null
                },
                address: {
                    title: null,
                    text: null
                },
                contact_form: {
                    title: null,
                    name_placeholder: null,
                    email_placeholder: null,
                    text_placeholder: null,
                    button_text: null,
                    success_send_text: null,
                    fail_send_tex: null
                }
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

</style>
