<template>
    <v-card flat>
        <v-card-text class="py-3">
            <v-layout wrap class="my-4">
                <v-flex class="xs12 sm12 mb-6">
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

export default {
    name: "MainSettingsComponent",
    components: {
        MultiLangTextField
    },
    data() {
        return {
            group: 'main',
            settings: {
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
                name: {},
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
