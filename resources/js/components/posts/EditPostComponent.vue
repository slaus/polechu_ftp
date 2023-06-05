<template>
    <v-dialog v-model="isActive" fullscreen scrollable persistent :retain-focus="false">
        <v-card tile>
            <v-toolbar flat dark color="primary" max-height="64">
                <v-toolbar-title>{{ $t(title, { post: translation(post.name) }) }}</v-toolbar-title>

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
                    <v-flex class="xs12 sm6 px-0 px-sm-2 mb-4">
                        <MultiLangTextField
                            :value.sync="post.name"
                            :label="$t('labels.postName')"
                            :readonly="isLoading"
                            :error-messages="messageFieldError('name')"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm4 px-0 px-sm-2">
                        <v-text-field
                            outlined
                            dense
                            v-model="post.slug"
                            :readonly="isLoading || noEditSlug"
                            :label="$t('labels.postSlug')"
                            @dblclick="noEditSlug=false"
                            @focusout="noEditSlug=true"
                            :error-messages="messageFieldError('slug')"
                        ></v-text-field>
                    </v-flex>

                    <v-flex class="xs12 sm2 px-0 px-sm-2">
                        <v-switch
                            v-model="post.visibility"
                            inset
                            :readonly="isLoading"
                            :label="$t('labels.visibility')"
                            :error-messages="messageFieldError('visibility')"
                            class="mt-0"
                        ></v-switch>
                    </v-flex>

                    <v-flex class="xs12 sm4 px-0 px-sm-2 mb-6">
                        <ImageThumb
                            :value.sync="post.image"
                            :label="$t('labels.mainImage')"
                            :disabled="isLoading"
                            :error-messages="messageFieldError('image')"
                            class="mx-auto"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm8 px-0 px-sm-2 align-self-center">
                        <MultiLangTextarea
                            :value.sync="post.description"
                            :placeholder="$t('labels.description')"
                            :error-messages="messageFieldError('description')"
                            rows="3"
                            :no-resize="true"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2 mt-10">
                        <v-combobox
                            v-model="post.tags"
                            :filter="filter"
                            :hide-no-data="!tagSearch"
                            :items="tags"
                            :search-input.sync="tagSearch"
                            hide-selected
                            :label="$t('labels.tags')"
                            multiple
                            small-chips
                            dense
                            outlined
                        >
                            <template v-slot:no-data>
                                <v-list-item>
                                    <span class="subheading mr-2">Create</span>
                                    <v-chip
                                        label
                                        small
                                    >
                                        {{ tagSearch }}
                                    </v-chip>
                                </v-list-item>
                            </template>

                            <template v-slot:selection="{ attrs, item, parent, selected }">
                                <v-chip
                                    v-if="item === Object(item)"
                                    v-bind="attrs"
                                    :input-value="selected"
                                    label
                                    small
                                >
                                    <span class="pr-2">
                                        {{ item.text }}
                                    </span>
                                    <v-icon
                                        small
                                        @click="parent.selectItem(item)"
                                    >
                                        $delete
                                    </v-icon>
                                </v-chip>
                            </template>

                            <template v-slot:item="{ index, item }">
                                <v-text-field
                                    v-if="tagEditing === item"
                                    v-model="tagEditing.text"
                                    autofocus
                                    flat
                                    background-color="transparent"
                                    hide-details
                                    solo
                                    @keyup.enter="editTag(index, item)"
                                ></v-text-field>
                                <v-chip
                                    v-else
                                    dark
                                    label
                                    small
                                >
                                    {{ item.text }}
                                </v-chip>
                                <v-spacer></v-spacer>
                                <v-list-item-action @click.stop>
                                    <v-btn
                                        icon
                                        @click.stop.prevent="editTag(index, item)"
                                    >
                                        <v-icon>{{ tagEditing !== item ? 'mdi-pencil' : 'mdi-check' }}</v-icon>
                                    </v-btn>
                                </v-list-item-action>
                            </template>
                        </v-combobox>
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2">
                        <MultiLangEditor
                            :value.sync="post.content"
                            :label="$t('labels.postContent')"
                            :readonly="isLoading"
                            :error-messages="messageFieldError('content')"
                        />
                    </v-flex>
                </v-layout>
            </v-card-text>

            <v-divider />

            <v-card-actions>
                <v-btn
                    color="primary"
                    text
                    @click="savePost"
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
import ImageThumb from "../shared/ImageThumb.vue";
import MultiLangTextarea from "../shared/MultiLangTextarea.vue";

export default {
    name: "EditPostComponent",
    mixins: [
        validation,
        localization
    ],
    components: {
        MultiLangTextarea,
        MultiLangTextField,
        MultiLangEditor,
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
            noEditSlug: true,
            tagEditing: null,
            tagEditingIndex: -1,
            nonce: 1,
            tagSearch: null
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.tourStore.isLoading,
            post: state => state.postStore.post,
            tags: state => state.postStore.listTags
        }),
        title() {
            return this.id > 0 ? 'titles.editPost' : 'titles.newPost';
        }
    },
    watch: {
        '$props.isActive': function (value) {
            if (value) {
                if (this.id > 0) {
                    this.loadPostData();
                }

                this.$store.dispatch('postStore/listTags', {});
            } else {
                this.slug = null;
                this.$store.commit('postStore/resetPost');
            }
        },
        'post.name': function (value) {
            this.setSlug(this.translation(value))
        },
        'post.tags': function (value, prev) {
            if (value.length === prev.length) {
                return;
            }

            this.post.tags = value.map(v => {
                if (typeof v === 'string') {
                    v = {
                        text: v,
                    }

                    this.post.tags.push(v)

                    this.nonce++
                }

                return v;
            })
        }
    },
    methods: {
        loadPostData() {
            this.$store.dispatch('postStore/loadPost', this.id);
        },
        savePost() {
            if (this.id > 0) {
                this.$store.dispatch('postStore/updatePost', this.post).then(response => {
                    this.successSaveAction();
                });
            } else  {
                this.$store.dispatch('postStore/savePost', this.post).then(response => {
                    this.successSaveAction();
                });
            }
        },
        setSlug(string) {
            if (this.id === 0) {
                this.post.slug = generateSlug(string);
            }
        },
        successSaveAction() {
            this.$emit('reload');
            this.close();
        },
        close() {
            this.cleanErrors();
            this.$emit('update:isActive', false);
        },
        editTag(index, item) {
            if (!this.tagEditing) {
                this.tagEditing = item
                this.tagEditingIndex = index
            } else {
                this.tagEditing = null
                this.tagEditingIndex = -1
            }
        },
        filter(item, queryText, itemText) {
            if (item.header) {
                return false;
            }

            const hasValue = val => val != null ? val : '';

            const text = hasValue(itemText);
            const query = hasValue(queryText);

            return text.toString()
                .toLowerCase()
                .indexOf(query.toString().toLowerCase()) > -1;
        }
    }
}
</script>

<style scoped>

</style>
