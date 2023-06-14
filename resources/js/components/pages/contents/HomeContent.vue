<template>
    <div>
        <v-card tile outlined class="mb-6">
            <v-card-title>{{ $t('titles.banner') }}</v-card-title>

            <v-card-text class="pa-4">
                <v-layout wrap align-center>
                    <v-flex class="xs12 sm12 px-0 px-sm-2">
                        <draggable
                            v-model="content.banner.items"
                            group="banner"
                        >
                            <v-layout v-for="(item, i) in content.banner.items" :key="i" wrap align-center>
                                <v-flex class="xs12 sm3 px-0 px-sm-2 mb-6">
                                    <ImageThumb
                                        :value.sync="item.image"
                                        width="290px"
                                        height="180px"
                                        class="mx-auto"
                                    />
                                </v-flex>

                                <v-flex class="xs12 sm8 px-0 px-sm-2 mb-6">
                                    <MultiLangTextField
                                        :value.sync="item.title"
                                        :label="$t('labels.title')"
                                        class="mb-2"
                                    />
                                    <MultiLangTextField
                                        :value.sync="item.subtitle"
                                        :label="$t('labels.subtitle')"
                                        class="mb-2"
                                    />
                                    <div class="d-flex">
                                        <div>
                                            <v-text-field
                                                dense
                                                outlined
                                                type="number"
                                                min="0"
                                                step="1"
                                                max="5"
                                                class="mb-2 mr-2"
                                                :label="$t('labels.stars')"
                                                v-model="item.stars"
                                                hide-details="auto"
                                            ></v-text-field>
                                        </div>
                                        <div class="flex-grow-1">
                                            <MultiLangTextField
                                                :value.sync="item.name"
                                                :label="$t('labels.name')"
                                                class="mb-2"
                                            />
                                        </div>
                                    </div>
                                </v-flex>

                                <v-flex class="xs12 sm1 px-0 px-sm-2 mb-6">
                                    <v-btn icon @click="removeBannerItem(item)" color="error">
                                        <v-icon small>fa-solid fa-trash-can</v-icon>
                                    </v-btn>
                                </v-flex>
                            </v-layout>
                        </draggable>
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2">
                        <v-btn
                            small
                            color="primary"
                            @click="addBannerItem"
                        >{{ $t('buttons.addBannerItem') }}</v-btn>
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>

        <v-card tile outlined class="mb-6">
            <v-card-title>{{ $t('titles.recentPosts') }}</v-card-title>

            <v-card-text class="pa-4">
                <v-layout wrap align-center>
                    <v-flex class="xs12 sm6 px-0 px-sm-2 mb-6">
                        <MultiLangTextField
                            :value.sync="content.posts.title"
                            :label="$t('labels.title')"
                            class="mb-2"
                        />
                    </v-flex>
                    <v-flex class="xs12 sm4 px-0 px-sm-2 mb-6">
                        <MultiLangTextField
                            :value.sync="content.posts.subtitle"
                            :label="$t('labels.subtitle')"
                            class="mb-2"
                        />
                    </v-flex>
                    <v-flex class="xs12 sm2 px-0 px-sm-2 mb-6">
                        <v-text-field
                            dense
                            outlined
                            type="number"
                            min="0"
                            step="1"
                            :label="$t('labels.countShow')"
                            v-model="content.posts.count"
                            hide-details="auto"
                            class="mb-2"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>

        <v-card tile outlined class="mb-6">
            <v-card-title>{{ $t('titles.feedbackForm') }}</v-card-title>

            <v-card-text class="pa-4">
                <v-layout wrap align-center>
                    <v-flex class="xs12 sm3 px-0 px-sm-2 mb-6">
                        <ImageThumb
                            :value.sync="content.feedback_form.background_image"
                            width="290px"
                            height="180px"
                            class="mx-auto"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm9 px-0 px-sm-2 mb-6">
                        <MultiLangTextarea
                            :value.sync="content.feedback_form.text"
                            :placeholder="$t('labels.text')"
                            rows="4"
                            :no-resize="true"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.feedback_form.form_title"
                            :label="$t('labels.formTitle')"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.feedback_form.form_subtitle"
                            :label="$t('labels.formSubtitle')"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.feedback_form.email_placeholder"
                            :label="$t('labels.emailPlaceholder')"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.feedback_form.button_text"
                            :label="$t('labels.buttonText')"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.feedback_form.success_send_text"
                            :label="$t('labels.successSend')"
                            class="mb-2"
                        />

                        <MultiLangTextField
                            :value.sync="content.feedback_form.fail_send_text"
                            :label="$t('labels.failSend')"
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
import MultiLangEditor from "../../shared/MultiLangEditor";
import localization from "../../../mixins/localization";
import draggable from 'vuedraggable';

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
                    items: []
                },
                posts: {
                    title: null,
                    subtitle: null,
                    count: 0
                },
                seo: {
                    title: null,
                    text: null
                },
                feedback_form: {
                    background_image: null,
                    text: null,
                    form_title: null,
                    form_subtitle: null,
                    email_placeholder: null,
                    button_text: null,
                    success_send_text: null,
                    fail_send_text: null
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
    methods: {
        addBannerItem() {
            this.content.banner.items.push({
                image: null,
                title: null,
                subtitle: null,
                stars: 0,
                name: null
            });
        },
        removeBannerItem(item) {
            this.content.banner.items = this.content.banner.items.filter(i => i !== item);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
