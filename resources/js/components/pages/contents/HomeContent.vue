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
    </div>
</template>

<script>
import { mergeDeep } from "../../../helpers/functions";
import MultiLangTextField from "../../shared/MultiLangTextField";
import ImageThumb from "../../shared/ImageThumb";
import MultiLangTextarea from "../../shared/MultiLangTextarea";
import MultiLangEditor from "../../shared/MultiLangEditor";
import {mapState} from "vuex";
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
