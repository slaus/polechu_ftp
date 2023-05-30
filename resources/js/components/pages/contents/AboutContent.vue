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
                        <MultiLangTextarea
                            :value.sync="content.banner.description"
                            :placeholder="$t('labels.description')"
                            rows="2"
                            :no-resize="true"
                        />
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>

        <v-card tile outlined class="mb-6">
            <v-card-title>{{ $t('titles.intro') }}</v-card-title>

            <v-card-text class="pa-4">
                <v-layout wrap align-center>
                    <v-flex class="xs12 sm3 px-0 px-sm-2 mb-6">
                        <ImageThumb
                            :value.sync="content.intro.image"
                            width="290px"
                            height="180px"
                            class="mx-auto"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm9 px-0 px-sm-2 mb-6">
                        <MultiLangTextarea
                            :value.sync="content.intro.description"
                            :placeholder="$t('labels.description')"
                            rows="4"
                            :no-resize="true"
                        />
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>

        <v-card tile outlined class="mb-6">
            <v-card-title>{{ $t('titles.services') }}</v-card-title>

            <v-card-text class="pa-4">
                <v-layout wrap align-center>
                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-6">
                        <MultiLangTextField
                            :value.sync="content.services.title"
                            :label="$t('labels.title')"
                            class="mb-2"
                        />
                        <MultiLangTextarea
                            :value.sync="content.services.description"
                            :placeholder="$t('labels.description')"
                            rows="2"
                            :no-resize="true"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-6">
                        <draggable
                            v-model="content.services.items"
                            group="services"
                            class="d-flex flex-wrap"
                        >
                            <div v-for="(item, i) in content.services.items" :key="i" class="pa-1" style="width: 25%">
                                <div class="brand-item-wrapper pa-3">
                                    <div>
                                        <MultiLangTextField
                                            :value.sync="item.text"
                                            :label="$t('labels.title')"
                                            class="mb-2"
                                        />
                                    </div>

                                    <div class="text-center">
                                        <v-btn icon @click="removeServiceItem(item)" color="error">
                                            <v-icon small>fa-solid fa-trash-can</v-icon>
                                        </v-btn>
                                    </div>
                                </div>
                            </div>
                        </draggable>
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2">
                        <v-btn
                            small
                            color="primary"
                            @click="addServiceItem"
                        >{{ $t('buttons.addServiceItem') }}</v-btn>
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>

        <v-card tile outlined class="mb-6">
            <v-card-title>{{ $t('titles.statistics') }}</v-card-title>

            <v-card-text class="pa-4">
                <v-layout wrap align-center>
                    <v-flex class="xs12 sm3 px-0 px-sm-2 mb-6">
                        <label>{{ $t('labels.background') }}</label>
                        <ImageThumb
                            :value.sync="content.statistics.background"
                            width="290px"
                            height="180px"
                            class="mx-auto"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm9 px-0 px-sm-2 mb-6">
                        <MultiLangTextField
                            :value.sync="content.statistics.title"
                            :label="$t('labels.title')"
                            class="mb-2"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2">
                        <draggable
                            v-model="content.statistics.items"
                            group="statistics"
                        >
                            <v-layout v-for="(item, i) in content.statistics.items" :key="i" wrap align-center class="mb-3">
                                <v-flex class="xs12 sm3 px-0 px-sm-2 mb-6">
                                    <MultiLangTextField
                                        :value.sync="item.title"
                                        :label="$t('labels.title')"
                                    />
                                </v-flex>

                                <v-flex class="xs12 sm2 px-0 px-sm-2 mb-6">
                                    <MultiLangTextField
                                        :value.sync="item.value"
                                        :label="$t('labels.value')"
                                    />
                                </v-flex>

                                <v-flex class="xs12 sm6 px-0 px-sm-2 mb-6">
                                    <MultiLangTextField
                                        :value.sync="item.description"
                                        :label="$t('labels.description')"
                                    />
                                </v-flex>

                                <v-flex class="xs12 sm1 px-0 px-sm-2 mb-6">
                                    <v-btn icon @click="removeStatisticItem(item)" color="error">
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
                            @click="addStatisticItem"
                        >{{ $t('buttons.addStatisticItem') }}</v-btn>
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>

        <v-card tile outlined class="mb-6">
            <v-card-title>{{ $t('titles.brands') }}</v-card-title>

            <v-card-text class="pa-4">
                <v-layout wrap align-center>
                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-6">
                        <MultiLangTextField
                            :value.sync="content.brands.title"
                            :label="$t('labels.title')"
                            class="mb-2"
                        />
                        <MultiLangTextarea
                            :value.sync="content.brands.description"
                            :placeholder="$t('labels.description')"
                            rows="2"
                            :no-resize="true"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-6">
                        <draggable
                            v-model="content.brands.items"
                            group="brands"
                            class="d-flex flex-wrap"
                        >
                            <div v-for="(item, i) in content.brands.items" :key="i" class="pa-1" style="width: 25%">
                                <div class="brand-item-wrapper pa-3">
                                    <div>
                                        <v-autocomplete
                                            outlined
                                            dense
                                            :items="brands"
                                            item-value="id"
                                            item-text="name"
                                            v-model="item.id"
                                            :label="$t('labels.brand')"
                                        >
                                            <template v-slot:selection="data">
                                                <div class="d-flex align-center ma-1">
                                                    <div>
                                                        <v-img :src="data.item.logo" max-width="54" max-height="20"></v-img>
                                                    </div>
                                                    <div class="px-3">
                                                        {{ translation(data.item.name) }}
                                                    </div>
                                                </div>
                                            </template>
                                            <template v-slot:item="data">
                                                <div class="d-flex align-center">
                                                    <div>
                                                        <v-img :src="data.item.logo" max-width="54" max-height="20"></v-img>
                                                    </div>
                                                    <div class="px-3">
                                                        {{ translation(data.item.name) }}
                                                    </div>
                                                </div>
                                            </template>
                                        </v-autocomplete>
                                    </div>

                                    <div>
                                        <MultiLangTextField
                                            :value.sync="item.title"
                                            :label="$t('labels.title')"
                                            class="mb-2"
                                        />
                                    </div>

                                    <div class="text-center">
                                        <v-btn icon @click="removeBrandItem(item)" color="error">
                                            <v-icon small>fa-solid fa-trash-can</v-icon>
                                        </v-btn>
                                    </div>
                                </div>
                            </div>
                        </draggable>
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-12">
                        <v-btn
                            small
                            color="primary"
                            @click="addBrandItem"
                        >{{ $t('buttons.addBrandItem') }}</v-btn>
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-6">
                        <MultiLangTextField
                            :value.sync="content.brands.offices_text"
                            :label="$t('labels.officeDescription')"
                            class="mb-2"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-6">
                        <draggable
                            v-model="content.brands.offices_items"
                            group="offices_items"
                        >
                            <v-layout v-for="(item, i) in content.brands.offices_items" :key="i" wrap align-center class="draggable-element">
                                <v-flex class="xs12 sm4 px-0 mb-6">
                                    <MultiLangTextField
                                        :value.sync="item.text"
                                        :label="$t('labels.button')"
                                    />
                                </v-flex>

                                <v-flex class="xs12 sm7 px-0 px-sm-2 mb-6">
                                    <MultiLangTextField
                                        :value.sync="item.url"
                                        :label="$t('labels.url')"
                                    />
                                </v-flex>

                                <v-flex class="xs12 sm1 px-0 mb-6">
                                    <v-btn icon @click="removeOfficeItem(item)" color="error">
                                        <v-icon small>fa-solid fa-trash-can</v-icon>
                                    </v-btn>
                                </v-flex>
                            </v-layout>
                        </draggable>

                        <v-btn
                            small
                            color="primary"
                            @click="addOfficeItem"
                        >{{ $t('buttons.addOfficeItem') }}</v-btn>
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import { mapState } from "vuex";
import { mergeDeep } from "../../../helpers/functions";
import MultiLangTextField from "../../shared/MultiLangTextField";
import ImageThumb from "../../shared/ImageThumb";
import MultiLangTextarea from "../../shared/MultiLangTextarea";
import localization from "../../../mixins/localization";
import draggable from 'vuedraggable';

export default {
    name: "AboutContent",
    mixins: [
        localization
    ],
    components: {
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
                intro: {
                    image: null,
                    description: null
                },
                services: {
                    title: null,
                    description: null,
                    items: []
                },
                statistics: {
                    title: null,
                    items: [],
                    background: null
                },
                brands: {
                    title: null,
                    description: null,
                    items: [],
                    offices_text: null,
                    offices_items: []
                }
            }
        }
    },
    computed: {
        ...mapState({
            brands: state => state.brandStore.list
        })
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
        this.loadBrandsData();

        this.content = mergeDeep(this.content, this.value);
    },
    methods: {
        loadBrandsData() {
            this.$store.dispatch('brandStore/list');
        },
        addServiceItem() {
            this.content.services.items.push({
                text: null
            });
        },
        removeServiceItem(item) {
            this.content.services.items = this.content.services.items.filter(i => i !== item);
        },
        addStatisticItem() {
            this.content.statistics.items.push({
                title: null,
                value: null,
                description: null
            });
        },
        removeStatisticItem(item) {
            this.content.statistics.items = this.content.statistics.items.filter(i => i !== item);
        },
        addBrandItem() {
            this.content.brands.items.push({
                id: 0,
                title: null
            });
        },
        removeBrandItem(item) {
            this.content.brands.items = this.content.brands.items.filter(i => i !== item);
        },
        addOfficeItem() {
            this.content.brands.offices_items.push({
                text: null,
                url: null
            });
        },
        removeOfficeItem(item) {
            this.content.brands.offices_items = this.content.brands.offices_items.filter(i => i !== item);
        }
    }
}
</script>

<style lang="scss" scoped>
.brand-item-wrapper {
    border: 1px solid #a0aec0;
}
</style>
