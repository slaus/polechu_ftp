<template>
    <v-dialog v-model="isActive" fullscreen scrollable persistent :retain-focus="false">
        <v-card tile>
            <v-toolbar flat dark color="primary" max-height="64">
                <v-toolbar-title>{{ $t(title, { tour: translation(tour.name) }) }}</v-toolbar-title>

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
                    <v-flex class="xs12 sm5 px-0 px-sm-2 mb-4">
                        <MultiLangTextField
                            :value.sync="tour.name"
                            :label="$t('labels.tourName')"
                            :readonly="isLoading"
                            :error-messages="messageFieldError('name')"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm3 px-0 px-sm-2">
                        <v-text-field
                            outlined
                            dense
                            v-model="tour.slug"
                            :readonly="isLoading || noEditSlug"
                            :label="$t('labels.tourSlug')"
                            @dblclick="noEditSlug=false"
                            @focusout="noEditSlug=true"
                            :error-messages="messageFieldError('slug')"
                        ></v-text-field>
                    </v-flex>

                    <v-flex class="xs12 sm2 px-0 px-sm-2">
                        <v-text-field
                            v-model="tour.order"
                            :label="$t('labels.order')"
                            dense
                            outlined
                            :readonly="isLoading"
                            :error-messages="messageFieldError('order')"
                            type="number"
                            min="0"
                            step="1"
                        ></v-text-field>
                    </v-flex>

                    <v-flex class="xs12 sm2 px-0 px-sm-2">
                        <v-switch
                            v-model="tour.visibility"
                            inset
                            :readonly="isLoading"
                            :label="$t('labels.visibility')"
                            :error-messages="messageFieldError('visibility')"
                            class="mt-0"
                        ></v-switch>
                    </v-flex>

                    <!--
                    <v-flex class="xs12 sm4 px-0 px-sm-2 mb-6">
                        <ImageThumb
                            :value.sync="tour.image"
                            :label="$t('labels.mainImage')"
                            :disabled="isLoading"
                            :error-messages="messageFieldError('image')"
                            class="mx-auto"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm8 px-0 px-sm-2 align-self-center">
                        <MultiLangTextarea
                            :value.sync="tour.description"
                            :placeholder="$t('labels.description')"
                            :error-messages="messageFieldError('description')"
                            rows="3"
                            :no-resize="true"
                            class="mb-3"
                        />

                        <MultiLangTextField
                            :value.sync="tour.price"
                            :label="$t('labels.tourPrice')"
                            :readonly="isLoading"
                            :error-messages="messageFieldError('price')"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2 my-8">
                        <label>{{ $t('labels.gallery') }}</label>

                        <draggable
                            v-model="tour.gallery"
                            group="gallery"
                            class="d-flex flex-wrap mb-3"
                        >
                            <div v-for="(image, i) in tour.gallery" :key="i" class="pa-3">
                                <ImageThumb
                                    :value.sync="tour.gallery[i]"
                                    :disabled="isLoading"
                                    width="150px"
                                    height="100px"
                                    v-on:remove="removeImageFromGallery"
                                />
                            </div>
                        </draggable>

                        <v-btn small color="primary" @click="addImageToGallery">
                            {{ $t('buttons.addImage') }}
                        </v-btn>
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2">
                        <MultiLangEditor
                            :value.sync="tour.content"
                            :label="$t('labels.tourContent')"
                            :readonly="isLoading"
                            :error-messages="messageFieldError('content')"
                        />
                    </v-flex>
                    -->

                    <v-flex class="xs12 sm12 px-0 px-sm-2">
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
                            <v-card-title>{{ $t('titles.content') }}</v-card-title>

                            <v-card-text class="pa-4">
                                <v-layout wrap align-center>
                                    <v-flex class="xs12 sm6 px-0 px-sm-2 mb-6">
                                        <MultiLangTextField
                                            :value.sync="content.content.title"
                                            :label="$t('labels.title')"
                                            class="mb-2"
                                        />
                                    </v-flex>
                                    <v-flex class="xs12 sm6 px-0 px-sm-2 mb-6">
                                        <MultiLangTextField
                                            :value.sync="content.content.subtitle"
                                            :label="$t('labels.subtitle')"
                                            class="mb-2"
                                        />
                                    </v-flex>
                                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-6">
                                        <MultiLangCodeEditor
                                            :value.sync="content.content.text"
                                        ></MultiLangCodeEditor>
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
                    </v-flex>
                </v-layout>
            </v-card-text>

            <v-divider />

            <v-card-actions>
                <v-btn
                    color="primary"
                    text
                    @click="saveTour"
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
import {generateSlug, mergeDeep} from "../../helpers/functions";
import { mapState } from "vuex";
import validation from "../../mixins/validation";
import localization from "../../mixins/localization";
import MultiLangTextField from "../shared/MultiLangTextField";
import MultiLangEditor from "../shared/MultiLangEditor";
import ImageThumb from "../shared/ImageThumb.vue";
import MultiLangTextarea from "../shared/MultiLangTextarea.vue";
import draggable from "vuedraggable";
import MultiLangCodeEditor from "../shared/MultiLangCodeEditor.vue";

export default {
    name: "EditTourComponent",
    mixins: [
        validation,
        localization
    ],
    components: {
        MultiLangCodeEditor,
        MultiLangTextarea,
        MultiLangTextField,
        MultiLangEditor,
        ImageThumb,
        draggable
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
            noEditSlug: true,
            content: {
                banner: {
                    items: []
                },
                content: {
                    title: null,
                    subtitle: null,
                    text: null
                },
                posts: {
                    title: null,
                    subtitle: null,
                    count: 0
                },
                seo: {
                    title: null,
                    text: null
                }
            }
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.tourStore.isLoading,
            tour: state => state.tourStore.tour
        }),
        title() {
            return this.id > 0 ? 'titles.editTour' : 'titles.newTour';
        }
    },
    watch: {
        '$props.isActive': function (value) {
            if (value) {
                if (this.id > 0) {
                    this.loadTourData();
                }
            } else {
                this.slug = null;
                this.$store.commit('tourStore/resetTour');
            }
        },
        'tour.name': function (value) {
            this.setSlug(this.translation(value))
        }
    },
    methods: {
        loadTourData() {
            this.$store.dispatch('tourStore/loadTour', this.id).then(() => {
                this.content = mergeDeep(this.content, this.tour.content);
            });
        },
        saveTour() {
            this.tour.content = this.content;

            if (this.id > 0) {
                this.$store.dispatch('tourStore/updateTour', this.tour).then(response => {
                    this.successSaveAction();
                });
            } else  {
                this.$store.dispatch('tourStore/saveTour', this.tour).then(response => {
                    this.successSaveAction();
                });
            }
        },
        setSlug(string) {
            if (this.id === 0) {
                this.tour.slug = generateSlug(string);
            }
        },
        successSaveAction() {
            this.$emit('reload');
            this.close();
        },
        addImageToGallery() {
            this.tour.gallery.push(null);
        },
        removeImageFromGallery() {
            this.tour.gallery = this.tour.gallery.filter(item => item !== null);
        },
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
        },
        close() {
            this.content = {
                banner: {
                    items: []
                },
                content: {
                    title: null,
                    subtitle: null,
                    text: null
                },
                posts: {
                    title: null,
                    subtitle: null,
                    count: 0
                },
                seo: {
                    title: null,
                    text: null
                }
            };

            this.cleanErrors();
            this.$emit('update:isActive', false);
        }
    }
}
</script>

<style scoped>

</style>
