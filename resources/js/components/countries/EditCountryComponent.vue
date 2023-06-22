<template>
    <v-dialog v-model="isActive" width="580" scrollable persistent :retain-focus="false">
        <v-card tile>
            <v-toolbar flat dark color="primary" max-height="64">
                <v-toolbar-title>{{ $t(title, { country: translation(country.name) }) }}</v-toolbar-title>

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
                    <v-flex class="xs12 sm8 px-0 px-sm-2 mb-4">
                        <MultiLangTextField
                            :value.sync="country.name"
                            :label="$t('labels.countryName')"
                            :readonly="isLoading"
                            :error-messages="messageFieldError('name')"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm4 px-0 px-sm-2">
                        <v-text-field
                            outlined
                            dense
                            v-model="country.plugin_id"
                            :readonly="isLoading"
                            :label="$t('labels.apiId')"
                            :error-messages="messageFieldError('plugin_id')"
                            type="number"
                            min="0"
                            step="1"
                        ></v-text-field>
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2 my-8">
                        <label>{{ $t('labels.gallery') }}</label>

                        <draggable
                            v-model="country.gallery"
                            group="gallery"
                            class="d-flex flex-wrap mb-3"
                        >
                            <div v-for="(image, i) in country.gallery" :key="i" class="pa-3">
                                <ImageThumb
                                    :value.sync="country.gallery[i]"
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
                </v-layout>
            </v-card-text>

            <v-divider />

            <v-card-actions>
                <v-btn
                    color="primary"
                    text
                    @click="saveCountry"
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
import { mapState } from "vuex";
import validation from "../../mixins/validation";
import localization from "../../mixins/localization";
import MultiLangTextField from "../shared/MultiLangTextField";
import ImageThumb from "../shared/ImageThumb.vue";
import draggable from "vuedraggable";

export default {
    name: "EditCountryComponent",
    mixins: [
        validation,
        localization
    ],
    components: {
        MultiLangTextField,
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

        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.countryStore.isLoading,
            country: state => state.countryStore.country
        }),
        title() {
            return this.id > 0 ? 'titles.editCountry' : 'titles.newCountry';
        }
    },
    watch: {
        '$props.isActive': function (value) {
            if (value) {
                if (this.id > 0) {
                    this.loadCountryData();
                }
            } else {
                this.$store.commit('countryStore/resetCountry');
            }
        }
    },
    methods: {
        loadCountryData() {
            this.$store.dispatch('countryStore/loadCountry', this.id);
        },
        saveCountry() {
            if (this.id > 0) {
                this.$store.dispatch('countryStore/updateCountry', this.country).then(response => {
                    this.successSaveAction();
                });
            } else  {
                this.$store.dispatch('countryStore/saveCountry', this.country).then(response => {
                    this.successSaveAction();
                });
            }
        },
        successSaveAction() {
            this.$emit('reload');
            this.close();
        },
        addImageToGallery() {
            this.country.gallery.push(null);
        },
        removeImageFromGallery() {
            this.country.gallery = this.country.gallery.filter(item => item !== null);
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
