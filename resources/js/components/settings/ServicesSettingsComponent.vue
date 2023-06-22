<template>
    <v-card flat>
        <v-card-text class="py-3">
            <v-layout wrap class="my-4">
                <v-flex class="xs12 sm6 mb-6 px-sm-2">
                    <label class="mb-4 title">{{ $t('labels.joinUpServices') }}</label>

                    <v-text-field
                        outlined
                        dense
                        v-model="settings.api.join_up.token"
                        :readonly="isLoading"
                        :label="$t('labels.apiToken')"
                        hint=""
                    ></v-text-field>

                    <v-text-field
                        outlined
                        dense
                        v-model="settings.api.join_up.base_url"
                        :readonly="isLoading"
                        :label="$t('labels.apiUrl')"
                    ></v-text-field>

                    <v-text-field
                        outlined
                        dense
                        v-model="settings.api.join_up.exclude_countries"
                        :readonly="isLoading"
                        :label="$t('labels.excludeCountries')"
                        :hint="$t('labels.excludeCountriesHint')"
                    ></v-text-field>

                    <v-text-field
                        outlined
                        dense
                        v-model="settings.api.join_up.exclude_towns"
                        :readonly="isLoading"
                        :label="$t('labels.excludeTowns')"
                        :hint="$t('labels.excludeTownsHint')"
                    ></v-text-field>
                </v-flex>
            </v-layout>

            <v-layout wrap class="my-4">
                <v-flex class="xs12 sm6 mb-6 px-sm-2">
                    <label class="mb-4 title">{{ $t('labels.googleServices') }}</label>

                    <v-text-field
                        outlined
                        dense
                        v-model="settings.api.google_map.api_key"
                        :readonly="isLoading"
                        :label="$t('labels.googleMapApiKey')"
                        hide-details="auto"
                    ></v-text-field>
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
import { mergeDeep } from "../../helpers/functions";

export default {
    name: "ServicesSettingsComponent.vue",
    data() {
        return {
            group: 'services',
            settings: {
                api: {
                    join_up: {
                        token: '',
                        base_url: '',
                        exclude_countries: '',
                        exclude_towns: ''
                    },
                    google_map: {
                        api_key: ''
                    }
                }
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
            this.settings = mergeDeep(this.settings, this.$store.state.settingStore.list);
        });
    },
    methods: {
        saveSettings() {
            console.log(this.settings)
            this.$store.dispatch('settingStore/saveSettings', {
                group: this.group,
                settings: this.settings
            });
        }
    }
}
</script>

<style scoped>

</style>
