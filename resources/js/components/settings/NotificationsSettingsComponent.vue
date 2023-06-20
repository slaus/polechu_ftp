<template>
    <v-card flat>
        <v-card-text class="py-3">
            <v-layout wrap class="my-4">
                <v-flex class="xs12 sm4 mb-6 px-sm-2">
                    <v-text-field
                        outlined
                        dense
                        v-model="settings.emails.request_form"
                        :readonly="isLoading"
                        :label="$t('labels.requestFormEmail')"
                        hide-details="auto"
                    ></v-text-field>
                </v-flex>
                <v-flex class="xs12 sm4 mb-6 px-sm-2">
                    <v-text-field
                        outlined
                        dense
                        v-model="settings.emails.contact_form"
                        :readonly="isLoading"
                        :label="$t('labels.contactFormEmail')"
                        hide-details="auto"
                    ></v-text-field>
                </v-flex>
                <v-flex class="xs12 sm4 mb-6 px-sm-2">
                    <v-text-field
                        outlined
                        dense
                        v-model="settings.emails.order_form"
                        :readonly="isLoading"
                        :label="$t('labels.orderFormEmail')"
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

export default {
    name: "NotificationsSettingsComponent",
    data() {
        return {
            group: 'notifications',
            settings: {
                emails: {
                    request_form: '',
                    contact_form: '',
                    order_form: ''
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
            this.settings = Object.assign(this.settings, this.$store.state.settingStore.list);
        });
    },
    methods: {
        saveSettings() {
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
