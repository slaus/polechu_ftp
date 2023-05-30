<template>
    <v-card flat>
        <v-card-text class="py-3">
            <v-layout wrap class="my-4">
                <v-flex class="xs12 sm2 mb-6">
                    <label class="d-block font-weight-bold mb-4">{{ $t('labels.logoLight') }}</label>
                    <ImageThumb
                        :value.sync="settings.logo.light"
                        width="150px"
                        height="100px"
                        class="mx-auto"
                    />
                </v-flex>
                <v-flex class="xs12 sm2 mb-6">
                    <label class="d-block font-weight-bold mb-4">{{ $t('labels.logoDark') }}</label>
                    <ImageThumb
                        :value.sync="settings.logo.dark"
                        width="150px"
                        height="100px"
                        class="mx-auto"
                    />
                </v-flex>
                <v-flex class="xs12 sm2 mb-6">
                    <label class="d-block font-weight-bold mb-4">{{ $t('labels.logoWhite') }}</label>
                    <ImageThumb
                        :value.sync="settings.logo.white"
                        width="150px"
                        height="100px"
                        class="mx-auto"
                    />
                </v-flex>
                <v-flex class="xs12 sm6 px-0 px-sm-2 mb-6">
                    <MultiLangTextarea
                        :value.sync="settings.company.description"
                        :placeholder="$t('labels.description')"
                        rows="6"
                        :no-resize="true"
                    />
                </v-flex>

                <v-flex class="xs12 sm6 mb-6 px-sm-2">
                    <v-text-field
                        outlined
                        dense
                        v-model="settings.company.email"
                        :readonly="isLoading"
                        :label="$t('labels.email')"
                        hide-details="auto"
                    ></v-text-field>
                </v-flex>
                <v-flex class="xs12 sm6 mb-6 px-sm-2">
                    <v-text-field
                        outlined
                        dense
                        v-model="settings.company.phone"
                        :readonly="isLoading"
                        :label="$t('labels.phone')"
                        hide-details="auto"
                    ></v-text-field>
                </v-flex>

                <v-flex class="xs12 sm12 mb-6 px-sm-2">
                    <label class="d-block font-weight-bold mb-4">{{ $t('labels.social') }}</label>

                    <div v-for="(item, i) in settings.socials" :key="i" class="d-flex flex-wrap mb-4">
                        <div class="name">
                            <MultiLangTextField
                                :value.sync="item.name"
                                :label="$t('labels.name')"
                                :readonly="isLoading"
                            />
                        </div>
                        <div class="mx-1"></div>
                        <div class="url flex-grow-2">
                            <v-text-field
                                outlined
                                dense
                                v-model="item.icon"
                                :readonly="isLoading"
                                :label="$t('labels.icon')"
                                hide-details="auto"
                            ></v-text-field>
                        </div>
                        <div class="mx-1"></div>
                        <div class="url flex-grow-1">
                            <v-text-field
                                outlined
                                dense
                                v-model="item.url"
                                :readonly="isLoading"
                                :label="$t('labels.url')"
                                hide-details="auto"
                            ></v-text-field>
                        </div>
                        <div class="px-2">
                            <v-btn icon @click="removeOffice(item)" color="error">
                                <v-icon small>fa-solid fa-trash-can</v-icon>
                            </v-btn>
                        </div>
                    </div>

                    <v-btn
                        color="primary"
                        @click="addSocial"
                        small
                    >
                        {{ $t('buttons.addSocial')}}
                    </v-btn>
                </v-flex>
            </v-layout>

            <v-divider />

            <v-card-actions>
                <v-btn
                    color="primary"
                    text
                    @click="saveSettings"
                    :disabled="isLoading"
                    :loading="isLoading"
                >
                    {{ $t('buttons.save') }}
                </v-btn>
            </v-card-actions>
        </v-card-text>
    </v-card>
</template>

<script>
import { mapState } from "vuex";
import MultiLangTextField from "../shared/MultiLangTextField";
import ImageThumb from "../shared/ImageThumb.vue";
import MultiLangTextarea from "../shared/MultiLangTextarea.vue";

export default {
    name: "MainSettingsComponent",
    components: {
        MultiLangTextarea,
        ImageThumb,
        MultiLangTextField
    },
    data() {
        return {
            group: 'main',
            settings: {
                logo: {
                    light: null,
                    dark: null,
                },
                company: {
                    phone: '',
                    email: '',
                    description: null
                },
                socials: []
            }
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.settingStore.isLoading
        })
    },
    mounted() {
        this.$store.dispatch('settingStore/list', this.group).then(response => {
            this.settings = Object.assign(this.settings, this.$store.state.settingStore.list);
        });
    },
    methods: {
        saveSettings() {
            this.$store.dispatch('settingStore/saveSettings', {
                group: this.group,
                settings: this.settings
            });
        },
        addSocial() {
            this.settings.socials.push({
                name: null,
                icon: '',
                url: ''
            });
        },
        removeOffice(office) {
            this.settings.socials = this.settings.socials.filter(item => item !== office);
        }
    }
}
</script>

<style scoped>

</style>
